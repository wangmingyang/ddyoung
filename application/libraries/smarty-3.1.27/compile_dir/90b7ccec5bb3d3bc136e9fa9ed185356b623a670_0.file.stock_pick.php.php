<?php /* Smarty version 3.1.27, created on 2015-12-06 23:44:22
         compiled from "D:\xampp\xampp\htdocs\ddyoung\application\views\stock\stock_pick.php" */ ?>
<?php
/*%%SmartyHeaderCode:22807566457d667a009_63671951%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90b7ccec5bb3d3bc136e9fa9ed185356b623a670' => 
    array (
      0 => 'D:\\xampp\\xampp\\htdocs\\ddyoung\\application\\views\\stock\\stock_pick.php',
      1 => 1449416592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22807566457d667a009_63671951',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566457d66e2950_09946332',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566457d66e2950_09946332')) {
function content_566457d66e2950_09946332 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '22807566457d667a009_63671951';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>escharts Test</title>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="height:400px"></div>

<?php echo '<script'; ?>
 src="http://echarts.baidu.com/build/dist/echarts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	
	var data = eval('('+$data+')');
	// 路径配置
	
	require.config({
		paths: {
			echarts: 'http://echarts.baidu.com/build/dist'
		}
	});
	// 使用
	require(
			[
				'echarts',
				'echarts/chart/line' // 使用柱状图就加载bar模块，按需加载
			],
			function (ec) {
				// 基于准备好的dom，初始化echarts图表
				var myChart = ec.init(document.getElementById('main'));
				var option = {
					tooltip : {
						trigger: 'axis'
					},
					legend: {
						data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
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
							data : ['周一','周二','周三','周四','周五','周六','周日']
						}
					],
					yAxis : [
						{
							type : 'value'
						}
					],
					series : [
						{
							name:'邮件营销',
							type:'line',
							stack: '总量',
							data:[120, 132, 101, 134, 90, 230, 210]
						},
						{
							name:'联盟广告',
							type:'line',
							stack: '总量',
							data:[220, 182, 191, 234, 290, 330, 310]
						},
						{
							name:'视频广告',
							type:'line',
							stack: '总量',
							data:[150, 232, 201, 154, 190, 330, 410]
						},
						{
							name:'直接访问',
							type:'line',
							stack: '总量',
							data:[320, 332, 301, 334, 390, 330, 320]
						},
						{
							name:'搜索引擎',
							type:'line',
							stack: '总量',
							data:[820, 932, 901, 934, 1290, 1330, 1320]
						}
					]
				};

				// 为echarts对象加载数据
				myChart.setOption(option);
			}
	);
<?php echo '</script'; ?>
>

</body>
</html><?php }
}
?>