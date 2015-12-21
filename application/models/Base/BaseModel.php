<?php
include_once dirname(__FILE__).'/interface/BaseDaoInterface.php';
include_once dirname(__FILE__).'/../../config/function.php';
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/10
 * Time: 10:42
 */
class BaseModel implements  BaseDaoInterface{
    private static $instance;
    private static $allowDbType = array('mysql'=>'/BaseDaoMysql.class.php','mysqli'=>'/BaseDaoMysqli.class.php','pdo'=>'/BaseDaoPdo.class.php');
    public $db;//操作实体类
    public $testBL;
    private static $defultDbType = 'mysqli';
    private function __construct($type){
        require_once dirname(__FILE__).self::$allowDbType[$type];
        $class = 'BaseDao'.ucfirst($type);
        $this->db = call_user_func("$class::getInstance");
        $this->connectDB();
    }
    public function connectDB(){
        $this->db->connectDB();
    }
    public static function getInstance($type=''){
        $type = empty($type) ? self::$defultDbType : $type;
        if(!isset($type,self::$allowDbType)){
            return false;
        }
        if(is_null(self::$instance)){
            self::$instance = new BaseModel($type);
        }
        return self::$instance;
    }

    //获取一条数据
    public function getOne($sql){
        return $this->db->getOne($sql);
    }
    //获取所有数据 并以Array数组返回
    public function getAll($where,$filed='*'){
        return $this->db->getAll($where,$filed);
    }
    //最简单的执行SQL
    public function query($sql){
        return $this->db->query($sql);
    }
    //修改
    public function update($table,$array, $where){
        return $this->db->update($table,$array, $where);
    }
    //插入
    public function insert($table,$array) {
        return $this->db->insert($table,$array);
    }
}