<?php
/* Smarty version 3.1.30, created on 2017-02-23 21:17:36
  from "D:\PHP_tools\Apache 2.4.23\Apache24\htdocs\hospital\tpl\proManagement.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aee0f050c1a9_40491176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1c248df8a30cf73f8b49e7d96ae8cb899ed6245' => 
    array (
      0 => 'D:\\PHP_tools\\Apache 2.4.23\\Apache24\\htdocs\\hospital\\tpl\\proManagement.tpl',
      1 => 1487841638,
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
function content_58aee0f050c1a9_40491176 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/proManagement.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
	<title>项目管理首页</title>
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:topmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content">
<div class="row">
<?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<article class="col-md-10">
			<!--<div class="select">-->
	<!--<input type="button" name="addPro" value="添加新项目" class="btn btn-info" onclick="window.location.href='index.php?controller=project&method=jumpTo&detail=add'">-->
				<header class="text-center headline">项目管理</header>
<!--modal-->
				<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                				<h4 class="modal-title" id="myModalLabel">添加新项目</h4>
            				</div>
            				<div class="modal-body">
        <!--in body-->
								<form role="form" action="index.php?controller=project&method=addProject" method="post" class="form-horizontal" onsubmit="return checkAdd()">
			<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目名称:<label for="newProjectName" class="text-danger">*必填！</label>
										<input type="text" name="newProjectName" id="newProjectName" class="form-control" placeholder="填入项目名称" value=''>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目价格:<label for="newProjectPrice" class="text-danger">*必填！</label>
										<input type="number" name="newProjectPrice" class="form-control" placeholder="填入项目价格(限数字)" min="0" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
										<!--<input type="text" id="newProjectPrice" name="newProjectPrice" class="form-control" placeholder="填入项目价格">-->
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目时长:<label for="newLastTime" class="text-danger">*必填！</label>
										<input type="number" name="newLastTime" class="form-control" placeholder="填入项目时长" min="0" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['time'];?>
" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
										<!--<input type="text" id="newLastTime" name="newLastTime" placeholder="填入项目时长" class="form-control">-->
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<label for="newIntroduction">项目简介:</label>
										<textarea class="form-control" id="newIntroduction" name="newIntroduction" id="Introduction" cols="30" rows="10" placeholder="在此填入项目简介"></textarea>
									</div>
								</div>
            				</div><!--modal body-->
            				<div class="modal-footer"> 
            					<button type="submit" class="btn btn-primary">添加</button>
                				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            				</div>
    							</form>          
    					</div><!-- /.modal-content -->
    				</div><!-- /.modal-dialog -->
				</div><!--modal-->

				<form method="post" class="form-inline" role="form" action="index.php?controller=project&method=showProjects">
				<div class="form-group">
						<div class="row" style="margin-top:20px;margin-bottom:15px">
							<div class="col-md-2">
								<!--<label for="theProjectId">项目编号:</label>-->
								<input type="text" class="form-control" id="theProjectId" name="theProjectId" placeholder="编号" style="width: 100%">
							</div>
							<div class="col-md-2">
								<!--<label for="theProjectName">项目名称:</label>-->
								<input type="text" class="form-control" id="theProjectName" name="theProjectName" placeholder="名称关键字" style="width: 100%">
							</div>
							<div class="col-md-3">
								<!--<label for="leftProjectPrice">价格区间:</label>-->
								<input type="text" class="form-control" id="leftProjectPrice" name="leftProjectPrice"  placeholder="价格" style="width: 45%">-<input type="text" class="form-control" name="rightProjectPrice" placeholder="区间" style="width: 45%">
							</div>
							<div class="col-md-3">
								<!--<label for="leftLastTime">时长区间:</label>-->
								<input type="text" class="form-control" id="leftLastTime" name="leftLastTime" placeholder="时长" style="width: 45%">-<input type="text" class="form-control" name="rightLastTime" placeholder="区间" style="width: 45%">
							</div>
							<div class="col-md-2">
								<input type="submit" class="btn btn-info" name="selectButton" value="查询" style="width: 60%">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table name="projectsTable" id="mytable" class="table table-striped">
									<thead>
										<tr>
											<th>项目编号</th>
											<th>项目名称</th>
											<th>项目价格</th>
											<th>项目时长</th>
											<th>功能</th>
										</tr>
									</thead>
								
									<?php
$__section_customer_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_customer']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer'] : false;
$__section_customer_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['proList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_customer_0_total = $__section_customer_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = new Smarty_Variable(array());
if ($__section_customer_0_total != 0) {
for ($__section_customer_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] = 0; $__section_customer_0_iteration <= $__section_customer_0_total; $__section_customer_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']++){
?>
										<tr>
											<td><?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectname'];?>
</td> 
											<td><?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
</td> 
											<td><?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['time'];?>
</td>
											<td><input type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" value="编辑">
											<input type="button" class="btn btn-warning" value="删除" onclick="confirmDel(<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
)"></td>
										</tr>
									<?php
}
}
if ($__section_customer_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = $__section_customer_0_saved;
}
?>
								</table>
							</div>
						</div>
					</div>
				</form>
			<!--</div>select-->
			
			<button class="btn btn-info "  data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> 添加</button>


			<?php
$__section_customer_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_customer']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer'] : false;
$__section_customer_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['proList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_customer_1_total = $__section_customer_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = new Smarty_Variable(array());
if ($__section_customer_1_total != 0) {
for ($__section_customer_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] = 0; $__section_customer_1_iteration <= $__section_customer_1_total; $__section_customer_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']++){
?><!--循环创建不同的模态框-->
	<!--modal 模态框 -->
				<div class="modal fade" id="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" tabindex="-1" role="dialog" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                				<h4 class="modal-title" id="myModalLabel">编辑项目</h4>
            				</div>
            				<div class="modal-body">
        <!--in body-->
								<form role="form" action="index.php?controller=project&method=alterProject" method="post" class="form-horizontal" onsubmit="return confirm('确认修改吗？')">
			<!--<input type="hidden" name="theProjectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" >-->
									<input type="hidden" name="projectId" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
">
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="projectName">项目名称:</label>
											<input type="text" name="projectName" id="projectName" class="form-control" placeholder="填入项目名称" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectname'];?>
">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="projectPrice">项目价格:</label>
											<input type="text" name="projectPrice" class="form-control" placeholder="填入项目价格(限数字)" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />
											<!--<input type="text" name="projectPrice" class="form-control" placeholder="填入项目价格" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
">-->
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="lastTime">项目时长:</label>
											<input type="text" name="lastTime" placeholder="填入项目时长(限数字)" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['time'];?>
">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="Introduction">项目简介:</label>
											<textarea class="form-control" name="Introduction" id="Introduction" cols="30" rows="10" placeholder="在此填入项目简介"><?php echo $_smarty_tpl->tpl_vars['proList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['introduction'];?>
</textarea>
										</div>
									</div>
            				</div><!--modal body-->
            			<div class="modal-footer"> 
            				<button type="submit" class="btn btn-warning">确定</button>
                			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            			</div>
    							</form>          
        				</div><!-- /.modal-content -->
    				</div><!-- /.modal-dialog -->
				</div><!--modal-->
			<?php
}
}
if ($__section_customer_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = $__section_customer_1_saved;
}
?>

<?php echo '<script'; ?>
 language="javascript" type="text/javascript">
	function confirmDel(projectid){
		if(confirm("确认删除吗？")){
			window.location.href="index.php?controller=project&method=delProject&ID="+projectid;
		}
	}
	function checkAdd(){
		if(document.getElementById("newProjectName").value==''||document.getElementById("newProjectPrice").value==''||document.getElementById("newLastTime").value==''){
			alert("信息填写不完整！"));
			return false;
		}
		return true;
	}
<?php echo '</script'; ?>
>
	<?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

		</article><!--content-->
	</div><!--col-md-10-->
</div><!--row-->
</body>
</html><?php }
}
