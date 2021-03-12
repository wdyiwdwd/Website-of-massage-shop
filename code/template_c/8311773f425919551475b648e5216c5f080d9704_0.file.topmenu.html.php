<?php
/* Smarty version 3.1.30, created on 2017-02-23 17:16:39
  from "D:\PHP_tools\Apache 2.4.23\Apache24\htdocs\hospital\tpl\topmenu.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aea877de6d18_04171766',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8311773f425919551475b648e5216c5f080d9704' => 
    array (
      0 => 'D:\\PHP_tools\\Apache 2.4.23\\Apache24\\htdocs\\hospital\\tpl\\topmenu.html',
      1 => 1487407228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58aea877de6d18_04171766 (Smarty_Internal_Template $_smarty_tpl) {
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/topmenu.css">
<?php echo '<script'; ?>
 type="text/javascript">
	 $(function(){
            whichPage=$('#whichPage').val()
            $('.'+whichPage).css("font-weight","bolder");  
            $('.'+whichPage).css("text-decoration","underline");
            //$('#'+whichPage).css("font-style","oblique");
            //$('#'+whichPage).css("border-bottom","solid","1px");
            //$('#'+whichPage).css("border-color","#a6d7ff");
      });
<?php echo '</script'; ?>
>
<nav class="navbar navbar-default" role="navigation" style="margin-bottom:0px;">
<div class="row">
<input type="hidden" id="whichPage" value="<?php echo $_smarty_tpl->tpl_vars['whichPage']->value;?>
" />
<aside class="container-fluid">
	<header class="navbar-header col-md-3">
		<div class="row">
			<div class="col-md-3"></div>
	        <div class="col-md-9"><a class="navbar-brand headname">XX医院</a></div>
	        <div class="col-md-3"></div>
	        <div class="col-md-9"><a class="navbar-brand headname">微信预约系统</a></div>
        <div>
	</header>
	<div class="col-md-9">
	<div class="row">
		<div class="col-md-6"></div>
		<div class="col-md-5">
		 	<ul class="nav navbar-nav navbar-right" style="margin-right:1px;">
		 		<li>
					<a href="index.php?controller=users&method=showMyInfo" id="username" class="listname">
						<span class="glyphicon glyphicon-user"> <?php echo $_smarty_tpl->tpl_vars['auth']->value['username'];?>
</span>
					</a>
				</li>
			 	<li>
					<a href="#" id="logout" class="listname" onclick="confirm('确定要注销吗?')?window.location.href='index.php?controller=users&method=logout':pass">
						<span class="glyphicon glyphicon-log-out"> 注销</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-3"></div>
		<div class="col-md-4">
			<ul class="nav navbar-nav">
				<li><a id="appointmentsInfo" href="index.php?controller=appointment&method=QueryAppointment" class="listname appointmentsInfo">预约系统</a></li>
				<li><a id="dappointmentsInfo" href="index.php?controller=appointment&method=Query_D_Appointment" class="listname dappointmentsInfo">当前预约</a></li>
				<li><a id="personalCenter" href="index.php?controller=users&method=showMyInfo" class="listname personalCenter">个人中心</a></li>
			</ul>
		</div>
		<div class="col-md-4">
			<ul class="nav navbar-nav navbar-right" style="margin-right:1px;">
				<li><a id="projectsInfo" href="index.php?controller=project&method=showProjects" class="listname projectsInfo">项目管理</a></li>
				<li><a id="doctorsInfo" href="index.php?controller=admin&method=showDoctorsInfo" class="listname doctorsInfo">医生管理</a></li>
				<li><a id="clientsInfo" href="index.php?controller=admin&method=showClientsInfo" class="listname clientsInfo">客户管理</a></li>
			</ul>
		</div>
		<div class="col-md-1"></div>
	</div>
	</div>		
</aside><!-- end of sidebar -->
</div>
</nav><?php }
}
