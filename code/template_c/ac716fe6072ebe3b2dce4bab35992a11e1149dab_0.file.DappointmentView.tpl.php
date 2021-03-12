<?php
/* Smarty version 3.1.30, created on 2017-02-23 18:01:58
  from "D:\PHP_tools\Apache 2.4.23\Apache24\htdocs\hospital\tpl\DappointmentView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aeb31625ba43_16108248',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac716fe6072ebe3b2dce4bab35992a11e1149dab' => 
    array (
      0 => 'D:\\PHP_tools\\Apache 2.4.23\\Apache24\\htdocs\\hospital\\tpl\\DappointmentView.tpl',
      1 => 1487844116,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:topmenu.html' => 1,
    'file:leftmenu.html' => 1,
    'file:page.html' => 1,
  ),
),false)) {
function content_58aeb31625ba43_16108248 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html lang="en">
 <head>
  	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
  	<title>AppointmentView</title>
  	<?php echo '<script'; ?>
>
  		function del(id){
			if(confirm("确定要取消预约吗?")){
				window.location.href="index.php?controller=appointment&method=DeleteAppointment&appointmentid="+id;
				return true;
			}
			else{
				return false;
			}
		}
  	<?php echo '</script'; ?>
>
 </head>
 <body>
<?php $_smarty_tpl->_subTemplateRender("file:topmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content">
<div class="row">
<?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<article class="col-md-10">

	<header class="headline text-center">当前预约信息列表</header>

	<!--查询表单-->
 	 <form name="query" class="form top form-inline" action="index.php?controller=appointment&method=Query_D_Appointment" method="post">

 	 	<div class="col-md-10">
 	 	<div class="row">

 	 	<div class="form-group col-md-3">
 			<select class="form-control" name="date" id="date" style="width:180px">
      					<option>距今时间</option>
      					<option>今天</option>
    					<option>近一个月</option>
    					<option>近三个月</option>
    					<option>近一年</option>
   			</select>
 		</div>

 		<div class="form-group col-md-3">
 			<select name="doctorid" id="select"  class="form-control" style="width:180px">
 				<option value="">请选择项目</option>
 					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projects']->value, 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
 						<option value="<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>
"><?php echo $_smarty_tpl->tpl_vars['project']->value['projectname'];?>
</option>
 					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

 			</select>
 		</div>

 		<div class="form-group col-md-3">
 				<select name="doctorid" id="select" onchange="setProject1(this.value)"  class="form-control" style="width:180px">
                    <option value="">请选择医师</option>
 					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['doctors']->value, 'doctor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['doctor']->value) {
?>
 						<option value="<?php echo $_smarty_tpl->tpl_vars['doctor']->value['doctorid'];?>
"><?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
</option>
 					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

 				</select>
        </div>

 		<div class="form-group col-md-3">
 		<input type="text" class="form-control" id="appointmentid" name="appointmentid" placeholder="订单号" style="width:170px">
 		</div>

 	</div><!--二级格栅结束-->
 	</div>

 		<input type="submit" class="form-control btn btn-info col-md-2" value="查询条件信息">
 		
	</form>
	<!--查询表单结束-->

	<br><br>

	<!--输出列表-->
	<table class="table table-striped" id="mytable">
		<div class="table">
		<thread>
	 		<th>订单号</th>
	 		<th>医师</th>
	 		<th>项目</th>
	 		<th>起始时间</th>
	 		<th>结束时间</th>
	 		<th>操作</th>
	 	</thread>
	 	</div>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['querydatas']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
	    <tr hidden>
		 	<td><?php echo $_smarty_tpl->tpl_vars['data']->value['appointmentid'];?>
</td>
		 	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['doctors']->value, 'doctor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['doctor']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['doctorid'] == $_smarty_tpl->tpl_vars['doctor']->value['doctorid']) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
</td>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projects']->value, 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['projectid'] == $_smarty_tpl->tpl_vars['project']->value['projectid']) {?>
                        <td><?php echo $_smarty_tpl->tpl_vars['project']->value['projectname'];?>
</td>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			<td><?php echo $_smarty_tpl->tpl_vars['data']->value['starttime'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['data']->value['endtime'];?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['data']->value['starttime'] > $_smarty_tpl->tpl_vars['currentTime']->value) {?>
					<button 
					class="btn btn-warning"  name="delAppointment"  onclick="del('<?php echo $_smarty_tpl->tpl_vars['data']->value['appointmentid'];?>
')" >取消预约
					</button>
				<?php } else { ?>
					<button 
					class="btn btn-success"  name="delAppointment"  onclick="" >&nbsp已 过 期&nbsp
					</button>
				<?php }?>
			
			</td>
		</tr>
		<?php
}
} else {
?>

			<tr>
				<td>无预约信息</td>
			</tr>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</table>

	<!--输出结束-->

	<?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	</article>
	</div>
	</div>
	
 </body>
</html>
<?php }
}
