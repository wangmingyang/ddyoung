<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/11/30
 * Time: 23:07
 */
require_once dirname(__FILE__) . '/Base/BaseModel.php';
class StockPickModel {

    function __construct(){
        $this->db = BaseModel::getInstance();
    }

    public function getData($period,$type){
        $stTime = time();
        $maxDate = $this->_getMaxDate();
        $minDate = $this->_getMinDate($period,$type,$maxDate);
        $nowAndMaxPrice = $this->_getNowAndMaxPrice($maxDate,$minDate);
        $caluteResult = $this->caluteResult($nowAndMaxPrice);
        $detail = $this->_getDetailData($nowAndMaxPrice,$maxDate,$minDate);
        $res = $this->_resetResult($caluteResult,$detail);
        return $res;
    }

    private function _resetResult($caluteResult,$detail){
        if(!empty($caluteResult) && !empty($detail)){
            $return = array();
            $thscodesCodes = array_keys($caluteResult);
            $resThscodes = array_flip($thscodesCodes);
            foreach($thscodesCodes as $key=>$thscode){
                $return[$key] = array('THSCODE'=>$thscode);
            }
            foreach($detail as $dataKey=>$item){
                $resultKey = $resThscodes[$dataKey];
                $return[$resultKey]['STOCK_NAME'] = json_encode(array($item['STOCK_NAME']));
                $return[$resultKey]['data'] = json_encode($item['data']);
                $return[$resultKey]['date'] = json_encode($item['date']);
            }
            return $return;
        }
        return false;
    }

    private function _getDetailData($data,$maxDate,$minDate){
         $thscodeArr = array();
        $result = array();
        if(empty($data)){
           return $result;
        }
        foreach($data as $item){
            $thscodeArr[]= $item['THSCODE'];
        }
        $thscodeStr = '\''.implode("','",$thscodeArr).'\'';
        unset($thscodeArr);
        $sql = "SELECT stk.THSCODE,stk.HIGH_PRICE,TRADEDATE,stock_code.STOCK_NAME from stock_001 stk
left join stock_code on stk.THSCODE = stock_code.THSCODE and stock_code.isvalid = 1
 WHERE stk.THSCODE in ($thscodeStr) and stk.ISVALID = 1
and stk.TRADEDATE BETWEEN '{$minDate}' and '{$maxDate}' ORDER BY stk.TRADEDATE ASC";
        $res = $this->db->query($sql);
        checkMysqlRes($res);
        if(empty($res)){
            return $result;
        }
        foreach($res as $item){
            //这边循环暂时只考虑同市场的，后期可以改进
            $result[$item['THSCODE']]['data'][] = $item['HIGH_PRICE'];
            $result[$item['THSCODE']]['date'][] = $item['TRADEDATE'];
            $result[$item['THSCODE']]['STOCK_NAME'] = $item['STOCK_NAME'];
        }
        return $result;
    }

    private function _getMinDate($period,$type='212001',$maxDate){
        $SQL = "SELECT MIN(market_date) minDate from (SELECT market_date from market_date where
market_date.MARKET_DATE <= '{$maxDate}'
and market_date.MARKET_STATUS=1 and MARKET_CODE= $type ORDER BY MARKET_DATE desc limit $period) A";
        $data = $this->db->query($SQL);
        checkMysqlRes($data);
        return $data[0]['minDate'];
    }

    private function _getNowAndMaxPrice($maxDate,$minDate){
        $sql = "SELECT A.THSCODE,A.MAXPRICE,B.NOWPrice from (SELECT THSCODE,MAX(HIGH_PRICE) MAXPRICE  from stock_001 where stock_001.TRADEDATE BETWEEN '{$minDate}' and '{$maxDate}' GROUP BY THSCODE)
A LEFT JOIN (SELECT THSCODE , HIGH_PRICE NOWPrice from stock_001 where TRADEDATE = '{$maxDate}')	B
on A.THSCODE = B.THSCODE limit 3";
        $data = $this->db->query($sql);
        checkMysqlRes($data);
        return $data;
    }

    private function _getMaxDate(){
        $sql = 'select MAX(tradedate)   maxDate from stock_001 limit 1';
        $date = $this->db->query($sql);
        checkMysqlRes($date);
        return $date[0]['maxDate'];
    }

    public function caluteResult($data){
        $return = array();
        if(!empty($data)){
            foreach($data as $item){
                if(empty($item['MAXPRICE']) || empty($item['NOWPrice'])){
                    $return[$item['THSCODE']] = 0;
                }else{
                    $return[$item['THSCODE']]['PERCENT'] = ( $item['MAXPRICE']-$item['NOWPrice'])/$item['MAXPRICE'];
                    $return[$item['THSCODE']]['MAXPRICE'] = $item['MAXPRICE'];
                    $return[$item['THSCODE']]['NOWPrice'] = $item['NOWPrice'];
                }
            }
        }
        array_multisort($return,SORT_DESC);
        return $return;
    }
}