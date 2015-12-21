<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/12/15
 * Time: 22:00
 */
require_once dirname(__FILE__).'/../../models/Base/BaseModel.php';
class StockPic extends BaseModel{
    private $debug = true;
    public $db ;
    function __construct($p){
        if(!isset($p['f'])){
            return false;
        }else{
            $file = dirname(__FILE__).'/include/'.ucfirst($p['f']).'.php';
            $this->debug('file:'.$file);
            require_once $file;
        }
        $class = ucfirst($p['f']);
        $this->start($class,$p);
    }
    public function start($class,$p){
        $obj = new $class;
        $obj -> init($p);
    }

    public function getDB(){
        $this->db = BaseModel::getInstance('mysqli');
    }

    public function RecodeLog($data,$file){
        $tmpFile = 'D:/'.$file;
        // $tmpFile = '/tmp/'.$file;
        file_put_contents($tmpFile,$data."\n",FILE_APPEND);
    }
    /**
     * @param $data
     * @param string $type
     * 打印调试信息
     */
    protected function debug($data,$type='p'){
        if($this->debug){
            echo date('Y-m-d H:i:s',time());exit;
            $data = date('Y-m-d H:i:s',time()).' : '.$data."\n";
            $type=='p'?print_r($data):var_dump($data);
        }
    }
}

$argv = $_SERVER['argv'];
$params = array(
    '-f'=> 'f',//后面跟具体脚本文件名
    '-d'=>'d',//几天
);
$p = array();
foreach($argv as $key=>$item){
    if(isset($params[$item])){
        $p[$params[$item]] = $argv[$key+1];
    }
}
$obj = new StockPic($p);