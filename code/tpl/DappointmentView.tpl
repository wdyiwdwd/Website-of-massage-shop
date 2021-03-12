<!doctype html>
<html lang="en">
 <head>
  	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  	<title>AppointmentView</title>
  	<script>
  		function del(id){
			if(confirm("确定要取消预约吗?")){
				window.location.href="index.php?controller=appointment&method=DeleteAppointment&appointmentid="+id;
				return true;
			}
			else{
				return false;
			}
		}
  	</script>
 </head>
 <body>
{include file='topmenu.html'}
<div class="content">
<div class="row">
{include file='leftmenu.html'}
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
 					{foreach $projects as $project}
 						<option value="{$project.projectid}">{$project.projectname}</option>
 					{/foreach}
 			</select>
 		</div>

 		<div class="form-group col-md-3">
 				<select name="doctorid" id="select" onchange="setProject1(this.value)"  class="form-control" style="width:180px">
                    <option value="">请选择医师</option>
 					{foreach $doctors as $doctor}
 						<option value="{$doctor.doctorid}">{$doctor.name}</option>
 					{/foreach}
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
		{foreach $querydatas as $data}
	    <tr hidden>
		 	<td>{$data.appointmentid}</td>
		 	{foreach $doctors as $doctor}
                {if $data.doctorid eq $doctor.doctorid}
                        <td>{$doctor.name}</td>
                {/if}
            {/foreach}

            {foreach $projects as $project}
                {if $data.projectid eq $project.projectid}
                        <td>{$project.projectname}</td>
                {/if}
            {/foreach}
			<td>{$data.starttime}</td>
			<td>{$data.endtime}</td>
			<td>
				{if $data.starttime > $currentTime }
					<button 
					class="btn btn-warning"  name="delAppointment"  onclick="del('{$data.appointmentid}')" >取消预约
					</button>
				{else}
					<button 
					class="btn btn-success"  name="delAppointment"  onclick="" >&nbsp已 过 期&nbsp
					</button>
				{/if}
			
			</td>
		</tr>
		{foreachelse}
			<tr>
				<td>无预约信息</td>
			</tr>
		{/foreach}
	</table>

	<!--输出结束-->

	{include file='page.html'}	
	</article>
	</div>
	</div>
	
 </body>
</html>
