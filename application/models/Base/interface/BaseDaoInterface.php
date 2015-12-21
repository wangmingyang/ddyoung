<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/10
 * Time: 11:07
 */
interface BaseDaoInterface{
    public function getAll($where,$filed);
    public function query($sql);
    public static function getInstance();
    public function connectDB();
    public function insert($table,$array);
    /** 更新一条记录，参数为数组(数组的key必须是和表中列名一致)，第二个参数是where条件表达式(不含where)*/
    public function update($table,$array, $where) ;
}