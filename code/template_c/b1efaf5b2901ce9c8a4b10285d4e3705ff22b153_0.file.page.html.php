<?php
/* Smarty version 3.1.30, created on 2017-02-23 17:16:39
  from "D:\PHP_tools\Apache 2.4.23\Apache24\htdocs\hospital\tpl\page.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aea877e06129_08550167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1efaf5b2901ce9c8a4b10285d4e3705ff22b153' => 
    array (
      0 => 'D:\\PHP_tools\\Apache 2.4.23\\Apache24\\htdocs\\hospital\\tpl\\page.html',
      1 => 1487242008,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58aea877e06129_08550167 (Smarty_Internal_Template $_smarty_tpl) {
?>
<meta charset="UTF-8">
<?php echo '<script'; ?>
 type="text/javascript" src="js/page.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="css/page.css">
<div id="page" class="page text-center">
	<ul class="pagination pagination">
		<li>
			<a href="#mytable" id="firstpage" class="likebutton">
				<span class="glyphicon glyphicon-fast-backward"></span>
			</a>
		</li>
		<li>
			<a href='#mytable' id="frontpage" class="likebutton">
				<span class="glyphicon glyphicon-arrow-left"></span>
			</a>
		</li>
		<li>
			<a id="pageInfo" class="likebutton text"></a>
		</li>
		<li>
			<a id="dataInfo" class="likebutton text"></a>
		</li>
		<li>
			<a href='#mytable' id="nextpage" class="likebutton">
				<span class="glyphicon glyphicon-arrow-right"></span>
			</a>
		</li>
		<li>
			<a href="#mytable" id="lastpage" class="likebutton">
				<span class="glyphicon glyphicon-fast-forward"></span>
			</a>
		</li> 
		<li>
			<a style="height:32px;" class="likebutton">
				<input type="text" id="thepage" style="width:28px;" class="likebutton"/>
			</a>
		</li>
		<li>
			<a href="#mytable" id="changepage" class="likebutton">跳转</a>
		</li>
	</ul>
</div><!-- end of #page -->
<?php }
}
