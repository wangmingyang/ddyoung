<?php
/**
 * Created by PhpStorm.
 * User: jax
 * Date: 2015/11/30
 * Time: 23:32
 */
require_once dirname(__FILE__).'/../../config/function.php';
class BaseController extends MY_Controller{
    private $params;
    function __construct(){
        parent::__construct();
        $this->_initParams();
    }

    private function _initParams(){
        $this->params = $_REQUEST;
    }

    protected function _getParam($key,$default=''){
        if(isset($this->params[$key])){
            return $this->params[$key];
        }else{
            return $default;
        }
    }

    protected function _getAllparams(){
        return $this->params;
    }
}