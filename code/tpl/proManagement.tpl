<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/project.js"></script>
	<title>项目管理首页</title>
</head>
<body>
{include file='topmenu.html'}
<div class="content">
<div class="row">
{include file='leftmenu.html'}
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
			<!--<input type="hidden" name="theProjectId" value="{$proList[customer].projectid}" >-->
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目名称:<label for="newProjectName" class="text-danger">*必填！</label>
										<input type="text" name="newProjectName" id="newProjectName" class="form-control" placeholder="填入项目名称" value=''>
						<!--<span class="label label-danger">*必填!</span>         因为目前还没有输入正确性检查-->
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目价格:<label for="newProjectPrice" class="text-danger">*必填！</label>
										<input type="number" id="newProjectPrice" min="0" name="newProjectPrice" class="form-control" placeholder="填入项目价格">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										项目时长:<label for="newProjectTime" class="text-danger">*必填！</label>
										<input type="number" id="newLastTime" min="0" name="newLastTime" placeholder="填入项目时长" class="form-control">
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
									<thead align="center">
										<tr>
											<th>项目编号</th>
											<th>项目名称</th>
											<th>项目价格</th>
											<th>项目时长</th>
											<th>功能</th>
										</tr>
									</thead>
								
									{section name=customer loop=$proList}
										<tr hidden>
											<td>{$proList[customer].projectid}</td>
											<td>{$proList[customer].projectname}</td> 
											<td>{$proList[customer].price}</td> 
											<td>{$proList[customer].time}</td>
											<td><input type="button" class="btn btn-info" data-toggle="modal" data-target="#{$proList[customer].projectid}" value="编辑">
											<input type="button" class="btn btn-warning" value="删除" onclick="confirmDel({$proList[customer].projectid})"></td>
										</tr>
									{/section}
								</table>
							</div>
						</div>
					</div>
				</form>
			<!--</div>select-->
			
			<button class="btn btn-info "  data-toggle="modal" data-target="#addModal"><span class="glyphicon glyphicon-plus"></span> 添加</button>


			{section name=customer loop=$proList}<!--循环创建不同的模态框-->
	<!--modal 模态框 -->
				<div class="modal fade" id="{$proList[customer].projectid}" tabindex="-1" role="dialog" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                				<h4 class="modal-title" id="myModalLabel">编辑项目</h4>
            				</div>
            				<div class="modal-body">
        <!--in body-->
								<form role="form" action="index.php?controller=project&method=alterProject" method="post" class="form-horizontal">
			<!--<input type="hidden" name="theProjectId" value="{$proList[customer].projectid}" >-->
									<input type="hidden" name="projectId" value="{$proList[customer].projectid}">
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="projectName">项目名称:</label>
											<input type="text" name="projectName" id="projectName" class="form-control" placeholder="填入项目名称" value="{$proList[customer].projectname}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="projectPrice">项目价格:</label>
											<input type="text" name="projectPrice" class="form-control" placeholder="填入项目价格" value="{$proList[customer].price}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="lastTime">项目时长:</label>
											<input type="text" name="lastTime" placeholder="填入项目时长" class="form-control" value="{$proList[customer].time}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="Introduction">项目简介:</label>
											<textarea class="form-control" name="Introduction" id="Introduction" cols="30" rows="10" placeholder="在此填入项目简介">{$proList[customer].introduction}</textarea>
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
			{/section}

<!--<script>
	function confirmDel(projectid){
		if(confirm("确认删除吗？")){
			window.location.href="index.php?controller=project&method=delProject&ID="+projectid;
		}
	}
	function checkAdd(){
		if(document.getElementById("newProjectName").value==''){
			alert("请至少填入项目名称！");
			return false;
		}
		return true;
	}
</script>-->
	{include file='page.html'}

		</article><!--content-->
	</div><!--col-md-10-->
</div><!--row-->
</body>
</html>