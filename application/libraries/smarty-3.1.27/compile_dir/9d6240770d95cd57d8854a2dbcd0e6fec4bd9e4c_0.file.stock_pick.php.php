<?php /* Smarty version 3.1.27, created on 2015-11-22 18:05:48
         compiled from "D:\xampp\xampp\htdocs\ddyoung\application\views\stock_pick.php" */ ?>
<?php
/*%%SmartyHeaderCode:264215651f5ec0d2213_74821538%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d6240770d95cd57d8854a2dbcd0e6fec4bd9e4c' => 
    array (
      0 => 'D:\\xampp\\xampp\\htdocs\\ddyoung\\application\\views\\stock_pick.php',
      1 => 1448208183,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '264215651f5ec0d2213_74821538',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5651f5ec188064_12769741',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5651f5ec188064_12769741')) {
function content_5651f5ec188064_12769741 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '264215651f5ec0d2213_74821538';
echo '<?php
';?>defined('BASEPATH') OR exit('No direct script access allowed');
<?php echo '?>';?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<?php echo $_smarty_tpl->tpl_vars['data']->value;?>

	</div>

	
</div>

</body>
</html><?php }
}
?>