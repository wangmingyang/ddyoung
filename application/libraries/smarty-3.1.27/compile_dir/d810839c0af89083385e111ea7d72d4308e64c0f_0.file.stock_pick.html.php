<?php /* Smarty version 3.1.27, created on 2015-12-08 13:50:34
         compiled from "C:\xampp\htdocs\ddyoung\application\views\stock\stock_pick.html" */ ?>
<?php
/*%%SmartyHeaderCode:2408056666faac7ef13_04439211%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd810839c0af89083385e111ea7d72d4308e64c0f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ddyoung\\application\\views\\stock\\stock_pick.html',
      1 => 1449505029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2408056666faac7ef13_04439211',
  'variables' => 
  array (
    'detailData' => 0,
    'k' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56666faad03c33_26876988',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56666faad03c33_26876988')) {
function content_56666faad03c33_26876988 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2408056666faac7ef13_04439211';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>escharts Test</title>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<?php
$_from = $_smarty_tpl->tpl_vars['detailData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
<div id="main_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" style="height:400px"></div>
<?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>


<?php echo '<script'; ?>
 src="http://echarts.baidu.com/build/dist/echarts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">

require.config({
	paths: {
		echarts: 'http://echarts.baidu.com/build/dist'
	}
});
<?php
$_from = $_smarty_tpl->tpl_vars['detailData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
var thscodes_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['value']->value['STOCK_NAME'];?>
;
console.log(thscodes_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
);
var dates_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['value']->value['date'];?>
;
var detail_data_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['value']->value['data'];?>
;

// 使用
require(
		[
			'echarts',
			'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
		],
		function (ec) {
			// 基于准备好的dom，初始化echarts图表
			
			var myChart = ec.init(document.getElementById('main_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'));
			var option_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
 = {
				tooltip : {
					trigger: 'axis'
				},
				legend: {
					data:thscodes_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>

				},
			
				toolbox: {
					show : true,
					feature : {
						mark : {show: true},
						dataView : {show: true, readOnly: false},
						magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
						restore : {show: true},
						saveAsImage : {show: true}
					}
				},
				calculable : true,
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
					
						data :dates_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>


					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : [
					{
						name:thscodes_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
,
						type:'line',
						stack: '总量',
						data:detail_data_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>

					}
				]
			};
			console.log(option_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
);
			// 为echarts对象加载数据
			myChart.setOption(option_<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
);
		}
);

<?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>

<?php echo '</script'; ?>
>

</body>
</html><?php }
}
?>