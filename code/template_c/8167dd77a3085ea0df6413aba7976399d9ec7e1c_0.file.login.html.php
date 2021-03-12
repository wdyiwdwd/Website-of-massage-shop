<?php
/* Smarty version 3.1.30, created on 2017-02-18 06:52:16
  from "C:\wamp64\www\hospital\tpl\login.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a7ef2052c418_94980763',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8167dd77a3085ea0df6413aba7976399d9ec7e1c' => 
    array (
      0 => 'C:\\wamp64\\www\\hospital\\tpl\\login.html',
      1 => 1486111536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58a7ef2052c418_94980763 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>首页登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/supersized.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <?php echo '<script'; ?>
 src="http://html5shim.googlecode.com/svn/trunk/html5.js"><?php echo '</script'; ?>
>
        <![endif]-->

    </head>

    <body>
        <div class="page-container">
            <div class="connect">
                <p>预约系统</p>
            </div>
            <h1>登录</h1>
            <form action="index.php?controller=users&method=login" method="post">
                <input type="text" name="username" class="username" placeholder="用户名:">
                <input type="password" name="password" class="password" placeholder="密码:">
                <button type="submit" name="login">点击登录</button>
                <div  class="error"><span>+</span></div>
            </form>
        </div>
        <!-- Javascript -->
        <?php echo '<script'; ?>
 src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/supersized.3.2.7.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/supersized-init.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/scripts.js"><?php echo '</script'; ?>
>

    </body>

</html><?php }
}
