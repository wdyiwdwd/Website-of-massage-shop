<?php
/* Smarty version 3.1.30, created on 2017-04-10 16:22:38
  from "D:\Apache\Apache24\htdocs\hospital\tpl\userInformation.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58ebb14ed437a1_90432701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5e9e1201a94af4d5cb33c4d7335cc5a147c652f' => 
    array (
      0 => 'D:\\Apache\\Apache24\\htdocs\\hospital\\tpl\\userInformation.html',
      1 => 1491841356,
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
function content_58ebb14ed437a1_90432701 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
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
	<title>用户信息管理系统</title>
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:topmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content">
<div class="row">
<?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<article class="col-md-10">
		<header class="text-center headline">
		 	<?php if ($_smarty_tpl->tpl_vars['showWhat']->value == 'clients') {?>
		 		客户信息管理列表
		 	<?php } elseif ($_smarty_tpl->tpl_vars['showWhat']->value == 'doctors') {?>
		 		医生信息管理列表
		 	<?php }?>
	 	</header>
		<div class="row text-center" style="margin-top:20px;margin-bottom:15px;">
			<form 
			<?php if ($_smarty_tpl->tpl_vars['showWhat']->value == 'clients') {?>
			action="index.php?controller=admin&method=showClientsInfo"
			<?php } elseif ($_smarty_tpl->tpl_vars['showWhat']->value == 'doctors') {?>
			action="index.php?controller=admin&method=showDoctorsInfo" 
			<?php }?>
			method="post"
			class="form-inline" role="form"
			>
				<div class="form-group col-md-2">
				<input type="text" name="userid" placeholder="用户ID" class="form-control" style="width:100%">
				</div>
				<div class="form-group col-md-2">
				<input type="text" name="username" placeholder="用户名" class="form-control" style="width:100%">
				</div>
				<div class="form-group col-md-2">
                <input type="text" name="name" placeholder="真实姓名" class="form-control" style="width:100%">
                </div>
				<div class="form-group col-md-2">	
                <input type="text" name="tel" placeholder="联系方式" class="form-control" style="width:100%">
				</div>
                <div class="form-group col-md-2">
                <select name="verified" id="selector" class="form-control" style="width:100%">
                	<option value="0">全部</option>
                	<option value="00">未注册</option>                	
                	<option value="1">已注册</option>
                </select>
                <?php echo '<script'; ?>
 type="text/javascript">$('#selector').val("<?php echo $_smarty_tpl->tpl_vars['verified']->value;?>
")<?php echo '</script'; ?>
>
                </div>
                <div class="form-group col-md-2 ">
                <button type="submit" class="btn btn-info" style="width:60%;">查询</button>
                </div>
			</form>
		</div>
		<div id="usertable" class="usertable">
			<table class="table table-striped" id="mytable"> 
				<thead> 
					<tr>  
	    				<th>ID</th>
	    				<th>用户名</th>
	    				<th>姓名</th>
	    				<th>联系方式</th>
	    				<?php if ($_smarty_tpl->tpl_vars['showWhat']->value == 'doctors') {?>
					 	<th>角色</th>
					 	<?php }?>
	    				<th>注册</th>
	    				<th>操作1</th>
	    				<th>操作2</th>
					</tr> 
				</thead>
				<tbody>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
					<tr hidden>
	    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
</td> 
	    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['username'];?>
</td> 
	    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</td> 
						<td><?php echo $_smarty_tpl->tpl_vars['value']->value['tel'];?>
</td>
						<?php if ($_smarty_tpl->tpl_vars['showWhat']->value == 'doctors') {?>
							<?php if ($_smarty_tpl->tpl_vars['value']->value['role'] == 2) {?>
					 	<td>医生</td>
					 		<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['role'] == 3) {?>
					 	<td>管理员</td>	
					 		<?php } else { ?>
					 	<td>未知</td>
					 		<?php }?>
					 	<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['value']->value['verified'] == 0) {?>
						<td><button  name="registerUser" class="btn btn-primary" onclick="window.location.href='index.php?controller=admin&method=registerUser&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
&showWhat=<?php echo $_smarty_tpl->tpl_vars['showWhat']->value;?>
'">注册</button></td>
						<?php } else { ?>
						<td><label name="registered" class="btn btn-success">已注册</label></td>
						<?php }?>
	    				<td><button  name="delUser" class="btn btn-warning" onclick="confirm('是否要删除此用户？')?window.location.href='index.php?controller=admin&method=delUser&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
&showWhat=<?php echo $_smarty_tpl->tpl_vars['showWhat']->value;?>
':pass">删除</button>
	    				</td>
	    				<td><button name="check" class="btn btn-link"  data-toggle="modal" data-target="#<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
" >查看</button>
	    				</td>
					</tr>
				<?php
}
} else {
?>

					<tr>
						<td  colspan=4>
							暂无用户
						</td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</tbody>
			</table>
		</div><!-- end of #table1 -->
		<?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		
		</article><!-- end of content manager article -->
	</div>
	</div>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
	<!--modal 模态框 -->
	<div class="modal fade" id="<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
	                <h4 class="modal-title" id="myModalLabel">个人信息</h4>
	            </div>
	            <div class="modal-body">
	        <!--in body-->
					<form id="updateForm" role="form" action="index.php?controller=users&method=updateMyInfo&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
" method="post" class="form-horizontal" onsubmit="return confirm('确认修改吗？')">
				<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="username" class="col-md-3 control-label">用户名:</label>
								<div class="col-md-9">
									<input type="text" name="username" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['username'];?>
" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="role" class="col-md-3 control-label">角色:</label>
								<div class="col-md-9">
									<input type="text" name="role" class="form-control" value="<?php if ($_smarty_tpl->tpl_vars['value']->value['role'] == 1) {?>客户<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['role'] == 2) {?>医生<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['role'] == 3) {?>管理员<?php } else { ?> 未知<?php }?>"  readonly="readonly">
								</div>
								<!--label name="role" class="form-control"><?php if ($_smarty_tpl->tpl_vars['value']->value['role'] == 1) {?>客户<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['role'] == 2) {?>医生<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['role'] == 3) {?>管理员<?php } else { ?> 未知<?php }?></label-->
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="name" class="col-md-3 control-label">姓名:</label>
								<div class="col-md-9">
									<input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="gender" class="col-md-3 control-label">性别:</label>
								<div class="col-md-9">
									<select name="gender" class="form-control">
										<?php if ($_smarty_tpl->tpl_vars['value']->value['gender'] == 0) {?>
											<option value="0">女</option>
											<option value="1">男</option>
										<?php } else { ?>
											<option value="0">男</option>
											<option value="1">女</option>
										<?php }?>
									</select>
								</div>
								<!--label name="gender" class="form-control" ><?php if ($_smarty_tpl->tpl_vars['value']->value['gender'] == 1) {?>男<?php } elseif ($_smarty_tpl->tpl_vars['value']->value['gender'] == 0) {?>女<?php } else { ?>未知<?php }?></label-->
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="tel" class="col-md-3 control-label">联系方式:</label>
								<div class="col-md-9">
									<input type="text" name="tel" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['tel'];?>
">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="fax" class="col-md-3 control-label">传真:</label>
								<div class="col-md-9">
									<input type="text" name="fax" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['fax'];?>
">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="email" class="col-md-3 control-label">email:</label>
								<div class="col-md-9">
									<input type="text" name="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['email'];?>
">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="location" class="col-md-3 control-label">住址:</label>
								<div class="col-md-9">
									<input type="text" name="location" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['location'];?>
">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="lastTime" class="col-md-3 control-label">上一次登录时间:</label>
								<div class="col-md-9">
									<input type="text" name="lasttime" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['lasttime'];?>
" readonly="readonly">
								</div>
							</div>
						</div>
						<?php if ($_smarty_tpl->tpl_vars['value']->value['role'] == 2) {?>
						<div class="form-group">
							<div class="col-sm-offset-1 col-sm-10">
								<label for="project" class="col-md-3 control-label">支持项目:</label>
								<div class="col-md-9"></div>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value['projects'], 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
								<div class="col-md-3"></div>
								<div class="col-md-8">
									<label name="<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>
" class="form-control"><?php echo $_smarty_tpl->tpl_vars['project']->value['projectname'];?>
</label>
								</div>
								<div class="col-md-1">
									<button class="glyphicon glyphicon-remove btn-link form-control-feedback" type="button" style="pointer-events: auto" onclick="confirm('确定要放弃此项目吗？')?window.location.href='index.php?controller=doctors&method=delProjectForDoc&doctorid=<?php echo $_smarty_tpl->tpl_vars['value']->value['doctorid'];?>
&projectid=<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>
':pass"></button>
								</div>
								<?php
}
} else {
?>

								<p name="noProject" class="form-control-static">暂无项目</p>
								<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


								<label for="project" class="col-md-3 control-label">添加项目:</label>
								<div class="col-md-8">
									<input name="doctorid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['doctorid'];?>
">
									<select name="projectid" id="proSelect" class="form-control">
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
								</div>
								<div class="col-md-1">
									<button name="addPro" type="button" class="glyphicon glyphicon-ok btn-link form-control-feedback" style="pointer-events: auto" onclick="window.location.href='index.php?controller=doctors&method=addProjectForDoc&doctorid=<?php echo $_smarty_tpl->tpl_vars['value']->value['doctorid'];?>
&projectid='+$('#proSelect').val()"></button>
								</div>
							</div>
						</div>
						<?php }?>
	            </div><!--modal body-->
	            <div class="modal-footer"> 
	            	<button type="submit" name="update" class="btn btn-warning">确认修改</button>
	    			</form> 
	    			<button class="btn btn-success" onclick="confirm('是否要重置密码？')?window.location.href='index.php?controller=users&method=updatePassword&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
':pass"">重置密码</button>   
	            	<button class="btn btn-primary" onclick="confirm('是否要删除此用户？')?window.location.href='index.php?controller=admin&method=delUser&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
&showWhat=<?php echo $_smarty_tpl->tpl_vars['showWhat']->value;?>
':pass"">删除</button>
			        <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
	            </div>      
	        </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	</div><!--modal-->
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


</body>

</html><?php }
}
