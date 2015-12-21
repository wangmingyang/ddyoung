<?php
date_default_timezone_set('Asia/Shanghai'); //设置时区

class BaseDaoMysqli implements BaseDaoInterface{
    private $mysql_server_name = "localhost"; //数据库服务器名称
    private $mysql_username = "root"; // 连接数据库用户名
    private $mysql_password = "516370"; // 连接数据库密码
    private $mysql_database = "stock"; // 数据库的名字
    public $table = ''; //当前操作的表名，由子类覆写
    public $fields = array(); // 当前表的字段名，由子类覆写
    public $con;//链接句柄
    private static $instance;

    /** 构造函数，负责连接指定数据库 */
    private function __construct() {
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new BaseDaoMysqli();
        }
        return self::$instance;
    }

    /**
     * @param $mysql_server_name
     * @param $mysql_username
     * @param $mysql_password
     * @param $mysql_database
     * 连接数据库
     */
    public function connectDB(){
        $this->con = mysqli_connect ( $this->mysql_server_name, $this->mysql_username, $this->mysql_password, $this->mysql_database) or exit("mysql connection error:".mysql_error());
        $this->doSql ( "set names utf8" );
    }

    public function doSql($sql){
        if(isset($_GET['debug'])){
            echo $sql."\n";
        }
        $res = mysqli_query ( $this->con,$sql );
        if(!$res){
            print_r(mysqli_error($this->con));exit;
        }
        return $res;
    }

    /** 执行SQL */
    public function query($sql) {
        $result = $this->doSql ( $sql );
        while (( $row = mysqli_fetch_assoc ( $result )) != NULL ) {
            $rows [] = $row;
        }
        return $rows;
    }

    /** 根据PK查询某张表的一条记录，返回一维数组 */
    public function getAll($where,$filed = '*') {

        return;
    }

    /** 插入一条记录，参数为数组(数组的key必须是和表中列名一致) array("title"=>"title的值", "content=>"content的值") */
    public function insert($table,$array) {
        $fields = array();
        $values = array();
        foreach($array as $k => $v) {
            $fields[] = "{$k}";
            $values[] = "'".mysqli_real_escape_string($this->con,$v)."'";
        }
        $fields = implode(',', $fields);
        $values = implode(',', $values);
        $sql = "INSERT INTO {$table} ({$fields}) VALUES({$values})";
        return $this->doSql($sql);
    }

    /** 更新一条记录，参数为数组(数组的key必须是和表中列名一致)，第二个参数是where条件表达式(不含where)*/
    public function update($table,$array, $where) {
        $values = array();
        foreach($array as $k => $v) {
            $values[] = "{$k}='".mysqli_real_escape_string($v)."'";
        }
        $values = implode(',', $values);
        $sql = "UPDATE {$this->table} SET {$values} WHERE {$where}";
        return $this->doSql($sql);
    }
}
?>