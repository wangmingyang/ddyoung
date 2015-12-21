<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/12/1
 * Time: 0:04
 */

function checkMysqlRes($res){
    if($res === false){
        RecodeLog(mysqli_error(),'sqlError');
    }
    return true;
}

function curl($url,$data=''){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $output = curl_exec($ch);
    if($output ===false){
        RecodeLog(array('url'=>$url,'data'=>curl_error($ch)),'curlError');
    }
    curl_close($ch);
    return $output;
}
//日志记录
function RecodeLog($data,$file){
    $tmpFile = '/tmp/'.$file;
    // $tmpFile = '/tmp/'.$file;
    if(!is_string($data)){
        $data = serialize($data);
    }
    file_put_contents($tmpFile,date('Y-m-d H:i:s',time()).':'.$data."\n",FILE_APPEND);
}

function printInCmd($str){
    $date = getFormateDate();
    $str = iconv('UTF-8','GBK',$str);
    echo $date.": ".$str.'Mem:'.memory_get_usage(true)."\n";
}

function getFormateDate($date='',$style = 'Y-m-d H:i:s'){
    if(empty($date)){
        $date = time();
    }
    return date($style,$date);
}

function _p($arr,$arr1=array(),$arr2=array()){
    print_r($arr);
    if(!empty($arr1)){
        print_r($arr1);
    }
    if(!empty($arr2)){
        print_r($arr2);
    }
    exit();
}

function _v($arr,$arr1=array(),$arr2=array()){
    var_dump($arr);
    if(!empty($arr1)){
        var_dump($arr1);
    }
    if(!empty($arr2)){
        var_dump($arr2);
    }
    exit;
}

