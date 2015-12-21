<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/12/1
 * Time: 0:16
 */
require_once dirname(__FILE__) . '../models/Base/BaseDaoMysql.class.php';
class prepareMax_D_value extends BaseDAO{

    function __construct(){
        $tradeDate = $this->_getMaxDate();
        $weekInfo = $this->_getWeekList($tradeDate);
        $monthInfo = $this->_getMonthList($tradeDate);

    }

    private function _getMaxDate(){
        $sql = 'select MAX(tradedate)   maxDate from stock_001 limit 1';
        $date = $this->getRow($sql);
        if($date===false){
            recodeErrorMsg(mysql_error());
            return false;
        }else{
            return $date['maxDate'];
        }
    }

    private function _getWeekList(){

    }

    private function _getMonthList(){

    }
}