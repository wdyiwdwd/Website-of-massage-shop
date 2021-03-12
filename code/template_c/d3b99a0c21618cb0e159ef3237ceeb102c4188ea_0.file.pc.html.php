<?php
/* Smarty version 3.1.30, created on 2017-02-23 15:42:00
  from "C:\wamp64\www\hos\tpl\pc.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58af02c86badf8_47878165',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3b99a0c21618cb0e159ef3237ceeb102c4188ea' => 
    array (
      0 => 'C:\\wamp64\\www\\hos\\tpl\\pc.html',
      1 => 1487864433,
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
function content_58af02c86badf8_47878165 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Dappointment.css">
	<link rel="stylesheet" href="css/pc.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<title>个人中心</title>
</head>
<body>
	<?php echo '<script'; ?>
 language="javascript" type="text/javascript">
		function con(){
			var pw1=document.getElementById("password1");
			var pw2=document.getElementById("password2");
			if(pw1.value==''||pw2.value==''){
				alert("密码不能为空！");
				return false;
			}
			else if(pw1.value!=pw2.value){
				alert("两次密码不同，请检查输入！");
				return false;
			}
			return confirm("确认修改吗？");
		}

		function cancelApp(id , method){
			if(method=="cancel"){
				var message="确定要取消预约吗?";
			}
			else{
				var message="确认删除该记录吗？"
			}
			if(confirm(message)){
				window.location.href="index.php?controller=users&method=DeleteAppointment&appointmentid="+id;
				return true;
			}
			else{
				return false;
			}
		}
	<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:topmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content">
<div class="row">
<?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<article class="col-md-10">
				<header class="headline text-center">
					个人信息
				</header>
				<!--
				<label >用户名：</label><label class="form-control"><?php echo $_smarty_tpl->tpl_vars['detail']->value['userName'];?>
</label>
				<label >身份：</label><label class="form-control"><?php echo $_smarty_tpl->tpl_vars['detail']->value['role'];?>
</label>-->
				<div class="panel panel-success">
				    <div class="panel-heading">
				       <h5>基本信息</h5>
				    </div>
				    <div class="panel-body">
				    	<div class="row" style="text-align: center">
				    		<div class="col-md-3 form" style="color:grey;font-size:16px;margin-top:1.7% ">
				    			用户名：<font color="black"><?php echo $_smarty_tpl->tpl_vars['detail']->value['userName'];?>
</font>
				    		</div>
				    		<div class="col-md-2  form" style="color:grey;font-size:16px;margin-top:1.7% ">
				    			身份：<font color="black"><?php echo $_smarty_tpl->tpl_vars['detail']->value['role'];?>
</font>
				    		</div>
				    		<div class="col-md-2 form" style="color:grey;font-size:16px;margin-top:1.7% ">
				    			微信：<font color="black"><?php echo $_smarty_tpl->tpl_vars['detail']->value['WX'];?>
</font>
				    		</div>
				    		<div class="col-md-2 form" style="color:grey;font-size:16px;margin-top:1.7% ">
				    			<?php if ($_smarty_tpl->tpl_vars['detail']->value['role'] == "客户") {?>
				    					消费次数：
				    				<?php } elseif ($_smarty_tpl->tpl_vars['detail']->value['role'] == "医生") {?>
				    					工作次数：
				    				<?php } else { ?>
				    					预约数量：
				    			<?php }?>
				    			<font color="black"><?php echo $_smarty_tpl->tpl_vars['detail']->value['appointmentAmount'];?>
</font>
				    		</div>
				    		<div class="col-md-3 form">
				    			<button data-toggle="modal" data-target="#details" class="btn btn-info" >详细信息</button>
				    		
				    			<button data-toggle="modal" data-target="#changePW" class="btn btn-info" >修改密码</button>
				    		</div>
				    		
				    	</div>
				    </div>
				</div>
				
				<div class="modal fade" id="changePW" tabindex="-1" role="dialog" aria-hidden="true">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
						                <h4 class="modal-title" id="myModalLabel">修改密码</h4>
						            </div>
						            <div class="modal-body">
										<form role="form" action='index.php?controller=users&method=updatePassword&userid=<?php echo $_smarty_tpl->tpl_vars['user']->value['userid'];?>
' method="post" class="form-horizontal" onsubmit="return con()">
													<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
										<div class="form-group">
											<div class="col-sm-offset-1 col-sm-10">
												<label for="password1">新密码:</label>
												<input type="password" name="password1" id="password1" class="form-control" placeholder="填入新密码" value=''>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-1 col-sm-10">
												<label for="password2">重复输入:</label>
												<input type="password" name="password2"id="password2" class="form-control" placeholder="再次填入密码" value=''>
											</div>
										</div>													
						            </div><!--modal body-->
						            <div class="modal-footer"> 
						            		<button type="submit" name="password" class="btn btn-primary">修改</button>
                							<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>	
                						</form>
						            </div>
						        </div><!-- /.modal-content -->
						    </div><!-- /.modal-dialog -->
						</div><!--modal-->
				
				
				<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                				<h4 class="modal-title" id="myModalLabel">编辑信息</h4>
            				</div>
            				<div class="modal-body">
        					<!--in body-->
								<form role="form" action="index.php?controller=users&method=updateMyInfo&userid=<?php echo $_smarty_tpl->tpl_vars['detail']->value['userId'];?>
" method="post" class="form-horizontal" onsubmit="return confirm('确认修改吗？')">
									<div class="form-group">
										<label for="userName" class="col-md-3 control-label">用户名:</label>
										<div class="col-md-9">
											<input type="text" name="userName" id="projectName" class="form-control" placeholder="填入用户名" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['userName'];?>
" readonly="readonly" style="width:80%">
										</div>
									</div>
									<div class="form-group">
										<label for="gender" class="col-md-3 control-label">性别:</label>
										<div class="col-md-9">
											<select name="gender" id="gender" class="form-control" style="width:80%">
												<?php if ($_smarty_tpl->tpl_vars['detail']->value['gender'] == 1) {?>
													<option value="1" selected="selected">男</option>
													<option value="0" >女</option>
												<?php } else { ?>
													<option value="1" >男</option>
													<option value="0" selected="selected">女</option>
												<?php }?>
											</select>
											<!--<input type="text" name="gender" placeholder="填入性别" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['gender'];?>
">-->
										</div>
									</div>
									
									<div class="form-group">
										<label for="realName" class="col-md-3 control-label">真实姓名:</label>
										<div class="col-md-9">
											<input type="text" name="name"style="width:80%" placeholder="填入您的真实姓名" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['realName'];?>
">
										</div>
									</div>
									<div class="form-group">
										<label for="tel" class="col-md-3 control-label">联系方式:</label>
										<div class="col-md-9">
											<input type="number" name="tel" style="width:80%" placeholder="填入您的联系方式" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['tel'];?>
">
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-md-3 control-label">email:</label>
										<div class="col-md-9">
											<input type="email" name="email" style="width:80%" placeholder="填入您的email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['email'];?>
">
										</div>
									</div>
									<div class="form-group">
										<label for="location" class="col-md-3 control-label">家庭住址:</label>
										<div class="col-md-9">
											<input type="text" name="location" style="width:80%" placeholder="填入您的家庭住址" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['location'];?>
">
										</div>
									</div>
									<div class="form-group">
										<label for="fax" class="col-md-3 control-label">传真:</label>
										<div class="col-md-9">
											<input type="text" name="fax" style="width:80%" placeholder="填入您的传真" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['fax'];?>
">
										</div>
									</div>
									<div class="form-group">
										<label for="role" class="col-md-3 control-label">身份:</label>
										<div class="col-md-9">
											<input type="text" name="role" style="width:80%" class="form-control" placeholder="您的权限" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['role'];?>
" readonly="readonly">
										</div>
									</div>
									<div class="form-group">
										<label for="wxOpenId" class="col-md-3 control-label">微信:</label>
										<div class="col-md-9">
											<input type="text" name="wxOpenId" style="width:80%" placeholder="您的微信账号" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['WX'];?>
" readonly="readonly">
										</div>
									</div>
									<div class="form-group">
										<label for="lastTime" class="col-md-3 control-label">上次登录时间:</label>
										<div class="col-md-9">
											<input type="text" name="lastTime" style="width:80%" placeholder="最近登录时间" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['detail']->value['lastTime'];?>
" readonly="readonly">
										</div>
									</div>
									<?php if ($_smarty_tpl->tpl_vars['detail']->value['verified'] == "是") {?>
									<div class="form-group">
										<div class="form-group has-success">
												<label class="control-label" for="inputSuccess" style="margin-left:30%">已注册!</label>
										</div>
									</div>
									<?php } else { ?>
									<div class="form-group">
										<div class="form-group has-error">
											<div class="col-sm-offset-1 col-sm-10">
												<label class="col-sm-2 control-label" for="inputError">未注册!</label>
											</div>
										</div>
									</div>
									<?php }?>
            				</div><!--modal body-->
            			<div class="modal-footer"> 
            				<button type="submit" name="update" class="btn btn-warning">确认修改</button>
            					</form>
                			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            			</div>
        				</div><!-- /.modal-content -->
    				</div><!-- /.modal-dialog -->
				</div><!--modal-->
				<?php if ($_smarty_tpl->tpl_vars['detail']->value['role'] == "医生") {?>
				<div class="panel panel-success">
					<div class="panel-heading">
				        支持项目
				    </div>
					<div class="panel-body">
						
						<table class="table table-striped" id="mytable">
							<thead>
								<tr>
									<th>
										项目编号
									</th>
									<th>
										项目名称
									</th>
									<th>
										操作
									</th>
								</tr>
							</thead>
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['doc_pro']->value, 'project');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
?>
							<tr>
								<td>
									<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>

								</td>
								<td>
									<?php echo $_smarty_tpl->tpl_vars['project']->value['projectname'];?>

								</td>
								<td>
									<button name="delPro" class="btn btn-danger" onclick="confirm('确定要放弃此项目吗？')?window.location.href='index.php?controller=doctors&method=delProjectForDoc&doctorid=<?php echo $_smarty_tpl->tpl_vars['person']->value['doctorid'];?>
&projectid=<?php echo $_smarty_tpl->tpl_vars['project']->value['projectid'];?>
':pass">删除 <!--<span class="glyphicon glyphicon-remove"></span>--></button>
								</td>
							</tr>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
	
						</table>
						<button class="btn btn-info "  data-toggle="modal" data-target="#addSupport" style="margin-left:2%"><span class="glyphicon glyphicon-plus"></span> 添加</button>
						<div class="modal fade" id="addSupport" tabindex="-1" role="dialog" aria-hidden="true">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
						                <h4 class="modal-title" id="myModalLabel">添加您所支持的项目</h4>
						            </div>
						            <div class="modal-body">
										<form action="index.php?controller=doctors&method=addProjectForDoc" method="post" class="form-inline" role="form">
											<input name="doctorid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['person']->value['doctorid'];?>
">
											<div class="form-group">
												<select name="projectid" id="proSelect" class="form-control" style="width: 300%">
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
											<div class="form-group">
												<button name="addPro" type="submit" class="btn btn-warning" style="margin-left:500%">确定</button>
											</div>
											
						            	</form>														
						            </div><!--modal body-->
						            <div class="modal-footer"> 
						            			
						            </div>
						        </div><!-- /.modal-content -->
						    </div><!-- /.modal-dialog -->
						</div><!--modal-->
						<!---->
						
					</div>
				</div>
				<?php }?>

				<div class="panel panel-success">
				    <div class="panel-heading">
				        <h5>预约记录</h5>
				    </div>
				    <div class="panel-body">
			                <div class="row">
			                	<form name="query" class="form top form-inline" action="index.php?controller=users&method=showMyInfo" method="post">
			                		<div class="form-group col-md-2">
			                			<input type="text" class="form-control" id="appointmentid" name="theAppointmentId" placeholder="订单号" style="width:90%;margin-left:15%">
			                		</div>
			                	 	<div class="form-group col-md-2">
			                			<select class="form-control" name="date" id="date" style="width:90%;margin-left:15%">
			                     				<option>全部</option>
			                     				<option>今天</option>
			                   					<option>近一个月</option>
			                   					<option>近一年</option>
			                  			</select>
			                		</div>
			                		<div class="form-group col-md-3">
			                				<select name="theDoctorId" id="select" onchange="setProject1(this.value)"  class="form-control" style="width:70%;margin-left:10%">
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
			                			<select name="theProjectId" id="select"  class="form-control" style="width:70%;margin-left:10%">
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
			                		<div class="form-group col-md-2">
			                			<input type="submit" class="form-control btn btn-info" value="查询" style="margin-left: 15%">
			                		</div>			                		
			                		
			            	 	</form>
			                </div>
				    	<table name="projectsTable" id="mytable" class="table table-striped" style="margin-top: 1%">
				    		<thead>
				    			<tr>
				    				<th>订单号</th>
				    				<th>医生</th>
				    				<th>项目</th>
				    				<th>起始时间</th>
				    				<th>结束时间</th>
				    				<th>操作</th>
				    			</tr>
				    		</thead>
				    		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notes']->value, 'app');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['app']->value) {
?>
				    		<tr>
				    			<td><?php echo $_smarty_tpl->tpl_vars['app']->value['appointmentId'];?>
</td>
				    			<td><?php echo $_smarty_tpl->tpl_vars['app']->value['doctorName'];?>
</td>
				    			<td><?php echo $_smarty_tpl->tpl_vars['app']->value['projectName'];?>
</td>
				    			<td><?php echo $_smarty_tpl->tpl_vars['app']->value['startTime'];?>
</td>
				    			<td><?php echo $_smarty_tpl->tpl_vars['app']->value['endTime'];?>
</td>
				    			<td>
				    				<?php if ($_smarty_tpl->tpl_vars['app']->value['isOut'] == 0) {?>
				    				<button class="btn btn-warning"  name="delAppointment"  onclick="cancelApp('<?php echo $_smarty_tpl->tpl_vars['app']->value['appointmentId'];?>
','cancel')" > 取消预约 
				    					 
				    				</button>
				    				<?php } else { ?>
				    				<button class="btn btn-success"  name="delAppointment"  onclick="cancelApp('<?php echo $_smarty_tpl->tpl_vars['app']->value['appointmentId'];?>
','delete')" >&nbsp 已过期 &nbsp 
				    				</button>
				    				<?php }?>
				    			</td>
				    		</tr>
				    		<?php
}
} else {
?>

				    		<tr>
				    			<td>无预约记录</td>
				    		</tr>
				    		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				    	</table>
				    	<?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

				    </div>
				</div>

				<!--每个项目的模态框！！！-->
				<?php
$__section_customer_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_customer']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer'] : false;
$__section_customer_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['allpros']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_customer_0_total = $__section_customer_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = new Smarty_Variable(array());
if ($__section_customer_0_total != 0) {
for ($__section_customer_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] = 0; $__section_customer_0_iteration <= $__section_customer_0_total; $__section_customer_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']++){
?><!--循环创建不同的模态框-->
				<div class="modal fade" id="<?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" tabindex="-1" role="dialog" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                				<h4 class="modal-title" id="myModalLabel">项目信息</h4>
            				</div>
            				
								<div class="col-sm-offset-1 col-sm-10">
									<label for="projectName">项目名称:</label>
									<label name="projectName"><?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectname'];?>
</label>
								</div>
								<div class="col-sm-offset-1 col-sm-10">
									<label for="projectPrice">项目价格:</label>
									<label name="projectPrice"><?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
</label>
								</div>
								<div class="col-sm-offset-1 col-sm-10">
									<label for="lastTime">项目时长:</label>
									<label name="lastTime"><?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['time'];?>
</label>
								</div>
								<div class="col-sm-offset-1 col-sm-10">
									<label for="Introduction">项目简介:</label>
										<!--<label name="Introduction"><?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['introduction'];?>
</label>-->
									<textarea class="form-control" name="Introduction" id="Introduction" cols="30" rows="10" placeholder="在此填入项目简介" readonly="readonly"><?php echo $_smarty_tpl->tpl_vars['allpros']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['introduction'];?>
</textarea>
								</div>
            				
            				<div class="modal-footer"> 
                			<!--<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>-->
            				</div>
        				</div><!-- /.modal-content -->
    				</div><!-- /.modal-dialog -->
				</div><!--modal-->
				<?php
}
}
if ($__section_customer_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = $__section_customer_0_saved;
}
?>
				<!--模态框循环结束-->
			</div>
		</div>
	</div>

</body>
</html><?php }
}
