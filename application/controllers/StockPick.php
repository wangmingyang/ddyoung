<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__).'/Base/BaseController.php';
class StockPick extends BaseController {

	/**
	 * url ddyoung/index.php/StockPick
	 */
	public function index()
	{
		$this->load->model('StockPickModel');

		$arr = array('week'=>7,'month'=>30);
		$period = $this->_getParam('period','month');
		$type = $this->_getParam('type','212001');
		$this->load->model('StockPickModel');
		$data = $this->StockPickModel->getData($arr[$period],$type);
		$this->assign('detailData',$data);
		$this->display('stock/stock_pick.html');
	}

	public function getData(){
		$arr = array('short'=>7);
		$period = $this->_getParam('period','short');
		$type = $this->_getParam('type','212001');
		$this->load->model('StockPickModel');
		$data = $this->StockPickModel->getData($arr[$period],$type);
		echo json_encode($data);
		exit;
	}

	public function test(){
		$a = array('X');
		echo json_encode($a);exit;
		$file = 'stock/escharts.html';
		$this->assign('hello','hello world');
		$this->display($file);
		exit;
	}
}
