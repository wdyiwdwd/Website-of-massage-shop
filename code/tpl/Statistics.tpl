<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<title>Statistics</title>
</head>
<body>
<div class="row">
{include file='leftmenu.html'}
{*include file='topmenu.html'*}
	<div class=" col-md-9">
		<div class="content">
	<!--本站共有 技师：<a href="index.php?controller=Statistics&method=doctorList">{$doctorAmount}</a>  名
	活跃客户： <a href="index.php?controller=Statistics&method=clientList">{$clientAmount}</a> 名 
	按摩项目总数 ：<a href="index.php?controller=Statistics&method=projectList">{$projectAmount}</a> 项  {*跳转到项目管理那里？*}
</br>
	总消费次数：{$notesAmount} 次-->
			<form action="index.php?controller=Statistics&method=showRecentPage" role="form" class="form-inline" method="post">
				<div class="form-group">
			<!--<label for="date">近期记录</label>-->
    				<select class="form-control" name="date" id="date">
      					<option>全部</option>
      					<option>今天</option>
    					<option>近一个月</option>
    					<option>近三个月</option>
    					<option>近一年</option>
   					</select>
   				</div>
   				<div class="form-group">
			<!--<label for="name">项目名称</label>-->
    				<input type="text" class="form-control" placeholder="项目名称" name="projectName">
    			</div>
   				<div class="form-group">
			<!--<label for="name">预约人</label>-->
    				<input type="text" class="form-control" placeholder="预约人姓名" name="clientName">
    			</div>
    			<div class="form-group">
			<!--<label for="name">技师</label>-->
    				<input type="text" class="form-control" placeholder="技师姓名" name="doctorName">
    			</div>
    			<input type="submit" class="btn btn-primary" value="查询">
				</div>
			</form>

			<div class="table-responsive">
				<table name="recentNotes" class="table table-striped">
					<tr>
						<td>项目名称</td>
						<td>预约人</td>
						<td>技师</td>
						<td>预约时间</td>
						<td>功能</td>
					</tr>
					{section name=customer loop=$notesList}
					<tr>
						<td>{$notesList[customer].projectName}</td>
						<td>{$notesList[customer].clientName}</td>
						<td>{$notesList[customer].doctorName}</td>
						<td>{$notesList[customer].startTime}</td>
						<td><input type="button" value="查看"  data-toggle="modal" data-target="#{$notesList[customer].appointmentId}" class="btn btn-info"></td>
					</tr>
					{/section}
				</table>
			</div>
			{section name=customer loop=$notesList}
		<!--循环建立模态框-->
				<div class="modal fade" id="{$notesList[customer].appointmentId}" tabindex="-1" role="dialog" aria-hidden="true">
			    	<div class="modal-dialog">
			        	<div class="modal-content">
			            	<div class="modal-header">
			                	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
			                	<h4 class="modal-title" id="myModalLabel">预约信息</h4>
			            	</div>
			            	<div class="modal-body">
			        <!--in body-->
								<form role="form" action="#" method="post" class="form-horizontal"><!-- 之后提交到 取消预约函数-->
						<!--<input type="hidden" name="theProjectId" value="{$proList[customer].projectid}" >-->
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="appointmentId">订单号:</label>
											<input type="text" name="appointmentId" id="appointmentId" class="form-control" readonly="readonly" value="{$notesList[customer].appointmentId}">
									<!--<span class="label label-danger">*必填!</span>         因为目前还没有输入正确性检查-->
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="projectName">项目名称:</label>
											<input type="text" name="projectName" id="projectName" class="form-control" readonly="readonly" value="{$notesList[customer].projectName}">
									<!--<span class="label label-danger">*必填!</span>         因为目前还没有输入正确性检查-->
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="clientName">预约人:</label>
											<input type="text" id="clientName" name="clientName" class="form-control" readonly="readonly" value="{$notesList[customer].clientName}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="doctorName">技师:</label>
											<input type="text" id="doctorName" name="doctorName"  class="form-control"readonly="readonly" value="{$notesList[customer].doctorName}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="startTime">预约时间:</label>
											<input type="text" id="startTime" name="startTime"  class="form-control"readonly="readonly" value="{$notesList[customer].startTime}">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-1 col-sm-10">
											<label for="endTime">结束时间:</label>
											<input type="text" id="endTime" name="endTime"  class="form-control"readonly="readonly" value="{$notesList[customer].endTime}">
										</div>
									</div>
			            	</div><!--modal body-->
			            	<div class="modal-footer"> 
			            		<button type="button" class="btn btn-danger" onclick="confirmCancel({$notesList[customer].appointmentId})">取消预约</button>
			                	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			            	</div>
			    				</form>          
			        	</div><!-- /.modal-content -->
			    	</div><!-- /.modal-dialog -->
				</div><!--modal-->
			{/section}

			<ul class="pagination pagination-lg"><!--分页-->
				<li><a href="index.php?controller=Statistics&method=showRecentPage&page={$currentPage-1}">&laquo;</a></li>
				{if $currentPage-1 > 1} 		<!--不是第一页时前面用...代替-->
    			<li class="disabled"><a href="#">...</a></li>
    			{/if}

    			{if $currentPage-1 > 0}
    			<li><a href="index.php?controller=Statistics&method=showRecentPage&page={$currentPage-1}">{$currentPage-1}</a></li>
				{/if}

    			<li><a class="active" href="index.php?controller=Statistics&method=showRecentPage&page={$currentPage}">{$currentPage}</a></li>

    			{if $currentPage < $pageAmount} 					<!--最后一页同，但总数超过3页时才会有...-->
    			<li><a href="index.php?controller=Statistics&method=showRecentPage&page={$currentPage+1}">{$currentPage+1}</a></li>
    			{/if}

    			{if $currentPage+1 < $pageAmount}
    			<li class="disabled"><a href="#">...</a></li>
    			{/if}

    			<li><a href="index.php?controller=Statistics&method=showRecentPage&page={$currentPage+1}">&raquo;</a></li>
			</ul>
		</div><!--content-->
	</div><!--col-md-9-->
</div><!--row-->
</body>
<script language="javascript" type="text/javascript">
	function confirmCancel(appointmentid){
		if(confirm("确认取消该预约吗？")){
			alert("index.php?controller=project&method=delProject&ID="+appointmentid);
			window.location.href="index.php?controller=Statistics&method=cancelAppointment&ID="+appointmentid;
		}
	}
</script>
</html>