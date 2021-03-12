<?php
/* Smarty version 3.1.30, created on 2017-01-15 06:15:01
  from "D:\Apache\Apache24\htdocs\hospital\tpl\first.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_587b1365562943_17586649',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a4ef31a743dcaaf677d982eab99a04a6ab26295' => 
    array (
      0 => 'D:\\Apache\\Apache24\\htdocs\\hospital\\tpl\\first.html',
      1 => 1484460898,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_587b1365562943_17586649 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
  <head>
    <title> I am Gong </title>
    <style type="text/css">
      body{
           background-color: #d2b48c;
	   margin-left: 20%;
	   margin-right: 20%;
	   border: 2px dotted black;
	   padding: 10px 10px 10px 10px;
	   font-family: sans-serif; 
      }
    </style>
  </head>
  <body>
    <h1> I am Gong </h1>
    <p>
      Today I am very happy,
    </p>
    <h2> Yan Song </h2>
    <p>
      <?php echo $_smarty_tpl->tpl_vars['heiheihei']->value;?>

    </p>
  </body>
</html>  <?php }
}
