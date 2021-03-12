<?php
/* Smarty version 3.1.30, created on 2017-02-13 15:11:19
  from "D:\Apache\Apache24\htdocs\hospital\tpl\personalCenter.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a1cc979b4cf2_52959700',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '851092cfdf3523d808b8f8cc974914679ad1f309' => 
    array (
      0 => 'D:\\Apache\\Apache24\\htdocs\\hospital\\tpl\\personalCenter.html',
      1 => 1486995497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftmenu.html' => 1,
  ),
),false)) {
function content_58a1cc979b4cf2_52959700 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_capitalize')) require_once 'D:\\Apache\\Apache24\\htdocs\\hospital\\libs\\ORG\\smarty\\plugins\\modifier.capitalize.php';
?>
<!doctype html>
<html lang="en">
 <head>
  	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Dappointment.css">
	<link rel="stylesheet" href="css/rightcontent.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
  	<title>AppointmentView</title>
 </head>
 <body>
 	<div class="row">
 		<?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 		<div class=" col-md-10 content">
			<header class="headline text-center">
				<?php if ($_smarty_tpl->tpl_vars['access']->value == 'admin') {?>
				个人信息展示
				<?php } elseif ($_smarty_tpl->tpl_vars['access']->value == 'user') {?>
				个人中心
				<?php }?>
			</header>
			<div class="row">
				<p>	用户名:<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</p>
				<p>	角色:<?php echo $_smarty_tpl->tpl_vars['user']->value['role'];?>
</p>
				<p>	上一次登录时间:<?php echo $_smarty_tpl->tpl_vars['user']->value['lasttime'];?>
</p>
				<p>	微信号：<?php echo $_smarty_tpl->tpl_vars['user']->value['wxOpenId'];?>
</p>

				<p>	真实姓名：<?php echo $_smarty_tpl->tpl_vars['person']->value['name'];?>
</p>
				<p>	联系方式：<?php echo $_smarty_tpl->tpl_vars['person']->value['tel'];?>
</p>
				<p>	性别：<?php echo $_smarty_tpl->tpl_vars['person']->value['gender'];?>
</p>
				<p>	email：<?php echo $_smarty_tpl->tpl_vars['person']->value['email'];?>
</p>
				<p>	传真：<?php echo $_smarty_tpl->tpl_vars['person']->value['fax'];?>
</p>
				<p>	家庭住址：<?php echo $_smarty_tpl->tpl_vars['person']->value['location'];?>
</p>
				<p>是否已注册：<?php echo $_smarty_tpl->tpl_vars['person']->value['verified'];?>
</p>

				<?php if ($_smarty_tpl->tpl_vars['user']->value['role'] == 2) {?>
					<p>支持项目:</p>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['projects']->value, 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
						<p><?php echo $_smarty_tpl->tpl_vars['project']->value['projectname'];?>
</p>
						<?php if ($_smarty_tpl->tpl_vars['access']->value == 'user') {?>
						<button name="delPro" onclick="confirm('确定要放弃此项目吗？')?window.location.href='index.php?controller=doctors&method=delProjectForDoc&doctorid=<?php echo $_smarty_tpl->tpl_vars['person']->value['doctorid'];?>
&projectid=<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>
':pass">删除该项目</button>
						<?php }?>
					<?php
}
} else {
?>

						<p>暂无支持项目</p>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


					<?php if ($_smarty_tpl->tpl_vars['access']->value == 'user') {?>
						<form action="index.php?controller=doctors&method=addProjectForDoc" method="post">
							<select name="projectid">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['allpros']->value, 'pro');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pro']->value) {
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['pro']->value['projectid'];?>
"><?php echo $_smarty_tpl->tpl_vars['pro']->value['projectname'];?>
</option>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							</select>
							<input name="doctorid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['doctorid'];?>
">
							<button name="addPro" type="submit">点击添加项目</button>
						</form>
					<?php }?>
				<?php }?>

			</div>
			<?php if ($_smarty_tpl->tpl_vars['access']->value == 'admin') {?>
			<div class="buttons">
				<button  onclick="confirm('是否要删除此用户？')?window.location.href='index.php?controller=admin&method=delUser&userid=<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
&showWhat=<?php echo $_smarty_tpl->tpl_vars['showWhat']->value;?>
':pass"">删除</button>
				<button onclick="window.location.href='index.php?controller=admin&method=show<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['showWhat']->value);?>
Info'"">返回</button>
			</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['access']->value == 'user') {?>
			<div class="button">
				<button data-toggle="modal" data-target="#<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
" >编辑</button>
			</div>
			<div>
				<button data-toggle="modal" data-target="#changepassword" >修改密码</button>
			</div>
			<?php }?>
 		</div>
 	</div>

 	<!--两个框 一个是修改个人信息，一个是修改密码-->
<!--modal 模态框 -->
<div class="modal fade" id="<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                <h4 class="modal-title" id="myModalLabel">编辑个人信息</h4>
            </div>
            <div class="modal-body">
        <!--in body-->
				<form role="form" action='index.php?controller=users&method=updateMyInfo&userid=<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
&showWhat=<?php echo $_smarty_tpl->tpl_vars['showWhat']->value;?>
' method="post" class="form-horizontal">
			<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="projectName">姓名:</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="填入姓名" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['name'];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="projectPrice">性别:</label>
							<input type="text" name="gender" class="form-control" placeholder="填入性别" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['gender'];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="lastTime">联系方式:</label>
							<input type="text" name="tel" placeholder="填入联系方式" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['tel'];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="lastTime">传真:</label>
							<input type="text" name="fax" placeholder="填入传真" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['fax'];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="lastTime">email:</label>
							<input type="text" name="email" placeholder="填入email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['email'];?>
">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="lastTime">住址:</label>
							<input type="text" name="location" placeholder="填入住址" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['location'];?>
">
						</div>
					</div>
            </div><!--modal body-->
            <div class="modal-footer"> 
            	<button type="submit" name="update" class="btn btn-primary">修改成功</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
    			</form>          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!--modal-->

 <!--modal 模态框 -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                <h4 class="modal-title" id="myModalLabel">编辑个人信息</h4>
            </div>
            <div class="modal-body">
        <!--in body-->
				<form role="form" action='index.php?controller=users&method=updatePassword&userid=<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
' method="post" class="form-horizontal">
			<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="projectName">新密码:</label>
							<input type="password" name="password1" id="name" class="form-control" placeholder="填入新密码">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<label for="projectPrice">重复输入:</label>
							<input type="password" name="password2" class="form-control" placeholder="填入新密码">
						</div>
            </div><!--modal body-->
            <div class="modal-footer"> 
            	<button type="submit" name="password" class="btn btn-primary">修改成功</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
    			</form>          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!--modal-->
 </body>
 </html><?php }
}
