<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/12/15
 * WIN：php D:\xampp\xampp\htdocs\ddyoung\application\core\script\class.php -f getStockHighPrice
 * LIN GIT: php /usr/local/git/ddyoung/application/core/script/class.php -f  getStockHighPrice
 * LIN Work: php /usr/local/Apace2.2/htdocs/application/core/script/class.php -f  getStockHighPrice
 * Time: 22:01
 */ 

class GetStockHighPrice extends StockPic{
    public $db;
    private $thscodes;//同花顺代码
    private $baseThsUrl = 'http://stockpage.10jqka.com.cn/spService/:THSCODE/Header/realHeader';
    private $insertData = array();
    public function __construct(){
    }

    public function init(){
        $this->getDB();
        $this->getThscodes();
        $tradeDate = $this->_getLastTradeDate();
        $this->getSpjFromThs();
        $this->inputData();
    }
    //获取同花顺代码
    private function getThscodes(){
        $sql = 'select DISTINCT(THSCODE) from stock_code where ISVALID = 1 and THSCODE is not null';
        $this->thscodes = $this->db->query($sql);
    }

    private function getSpjFromThs(){
        if(empty($this->thscodes)){
            exit('thscode is empty');
        }
        $i = 1;
        printInCmd('开始取数据');
        foreach($this->thscodes as $thscodeArr){
            sleep(0.1);
            $this->_getSpj($thscodeArr['THSCODE']);
            $i++;
        }
        printInCmd('结束取数据，一共取了'.$i."个数据");
    }
    //获取收盘价
    private function _getSpj($thscode){
        $url = str_replace(":THSCODE",substr($thscode,0,-3),$this->baseThsUrl);
        $contents = curl($url);
        if(empty($contents)){
            RecodeLog(array('url'=>$url,'data'=>$contents),'getStockPick');
        }

        $contents = json_decode($contents,true);
        if(isset($contents['xj'])){
            $this->insertData[$thscode] = $contents['xj'];
        }else{
            RecodeLog(array('url'=>$url,'data'=>$contents),'getStockPick');
        }
    }

    private function inputData(){
        if(!empty($this->insertData)){
            $date = getFormateDate();
            $i=0;
            $tradeDate = $this->_getLastTradeDate();
            foreach($this->insertData as $thscode => $xj){
                $sql="select count(1) ct from stock_001 where THSCODE='$thscode' and TRADEDATE='$tradeDate'";
                $isExists = $this->db->query($sql);
                if(isset($isExists[0]['ct']) && $isExists[0]['ct']==1){
                    continue;
                }
                $insertData = array(
                    'THSCODE'=>"$thscode",
                    'TRADEDATE'=>"$tradeDate",
                    'CTIME'=>"$date",
                    'MTIME'=>"$date",
                    'HIGH_PRICE'=>$xj,
                    'ISVALID'=>1
                );
                $this->db->insert('stock_001',$insertData);
                $i++;
            }
            printInCmd('一共导入'.$i.'条数据');
        }
    }

    private function _getLastTradeDate(){
        $sql= 'SELECT MARKET_DATE from MARKET_DATE t1 where t1.MARKET_CODE = \'212100\'  and MARKET_STATUS=1 and  t1.market_date <=  \'2015-12-20\' ORDER BY MARKET_DATE desc limit 1';
        $res = $this->db->query($sql);
        return $res[0]['MARKET_DATE'];
    }
}