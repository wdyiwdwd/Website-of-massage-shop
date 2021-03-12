<!doctype html>
<html lang="en">
 <head>
  	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/about.css">

	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
  	<title>AppointmentView</title>
 </head>
<script>
$(function(){
     $('label').click(function(){
         $('.event_year>li').removeClass('current');
         $(this).parent('li').addClass('current');
         var year = $(this).attr('for');
        $('#'+year).parent().prevAll('div').slideUp(800);
         $('#'+year).parent().slideDown(800).nextAll('div').slideDown(800);
     });
 });
function checkContent(){
    if(confirm("确认预约吗？")){
        var time = document.getElementById("theStarttime").value;
        if(document.getElementById("theDoctorid").value==-1||time=="00:00"||document.getElementById("theProjectid").value==0){
            alert("信息填写不完整！");
            return false;
        }
        return true;
    } 
    return false;
}
function setTimeLine(doctorid){
   window.location.href="index.php?controller=appointment&method=QueryAppointment&doctorid="+doctorid;
}
function setSelect(doctorid){
    //alert(doctorid);
    var selectObj=document.getElementById("theProjectid");
    selectObj.options.length=0;
    var options={$json_doc_pro};
    for (var i = options.length - 1; i >= 0; i--) {
        if(options[i]['doctorId']==doctorid){
            //selectObj.options.add(new Option("文本", i));
            selectObj.options.add(new Option(options[i]['projectName'], options[i]['projectId']));// ("文本"，"值")
        } 
    };
}

</script>
<body>
{include file='topmenu.html'}
<div class="content">
    <div class="row">
    {include file='leftmenu.html'}
        <div class="col-md-10">
 			<!--<header class="text-center headline">预约系统</header>-->
            
            <div class="row">
                <div class="col-md-7">
                    <div class="box">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="doctorSelect" id="doctorSelect" class="form-control" style="width:30%;margin-left:3%" onchange="setTimeLine(this.value)">
                                            <option value="-1">选择医师</option>
                                            {foreach $doctors as $doctor}
                                                {if $selectedDoctor eq $doctor.doctorid}
                                                <option value="{$doctor.doctorid}" selected="selected">{$doctor.name}</option>
                                                {else}
                                                <option value="{$doctor.doctorid}">{$doctor.name}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="event_year" style="margin-left:9%">
                                            <li class="current" ><label for="today" >今天</label></li>
                                            <li><label for="tomorrow">明天</label></li>
                                            <li><label for="afterTomorrow">后天</label></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-7">
                                <ul class="event_list">
                                    <div>
                                        <h3 id="today">today</h3> 
                                        {foreach $todayAppointments as $today}
                                            <li>
                                            <span>{$today.startTime}</span>
                                            <p><span style="width: 40%">{$today.proName} (至 {$today.endTime})</span></p>
                                            </li>
                                        {foreachelse}
                                        {if $appointmentAmount eq -1}
                                            <li>
                                            <span>8:30</span>
                                            <p><span style="width: 35%">这条时间轴代表某位医生的工作日程哦~</span></p>
                                            </li>
                                            <li>
                                            <span>12:10</span>
                                            <p><span style="width: 35%">选择好医生后可根据其日程来制定妥善的预约时间</span></p>
                                            </li>
                                            <li>
                                            <span>1:30</span>
                                            <p><span style="width: 35%">左侧的时间即为本项目的预约时间</span></p>
                                            </li>
                                        {else}
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(今天暂无预约哦)</span></p>
                                            </li>
                                        {/if}
                                        {/foreach}
                                    </div>
                                    
                                    <div>
                                        <h3 id="tomorrow">tomorrow</h3>
                                        {foreach $tomorrowAppointments as $tomorrow}
                                            <li>
                                            <span>{$tomorrow.startTime}</span>
                                            <p><span style="width: 40%">{$tomorrow.proName}  (至 {$tomorrow.endTime})</span></p>
                                            </li>
                                        {foreachelse}
                                        {if $appointmentAmount eq -1}
                                            <li>
                                            <span>9:00</span>
                                            <p><span style="width: 35%">第二天的预约会显示在这里哦</span></p>
                                            </li>
                                            <li>
                                            <span>14:00</span>
                                            <p><span style="width: 35%">营业时间为： 8:00 ~ 20:00</span></p>
                                            </li>
                                        {else}
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(明天暂无预约哦)</span></p>
                                            </li>
                                        {/if}
                                        {/foreach}
                                    </div>
                                    <div>
                                        <h3 id="afterTomorrow">day after tomorrow</h3>
                                        {foreach $afterTomorrowAppointments  as $afterTomorrow}
                                            <li>
                                            <span>{$afterTomorrow.startTime}</span>
                                            <p><span style="width: 40%">{$afterTomorrow.proName} (至 {$afterTomorrow.endTime})</span></p>
                                            </li>
                                        {foreachelse}
                                            {if $appointmentAmount eq -1}
                                            <li>
                                                <span>18:00</span>
                                                <p><span style="width: 35%">别忘了，最多只可提前三天进行预约哦！</span></p>
                                            </li>
                                            {else}
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(后天暂无预约哦)</span></p>
                                            </li>
                                            {/if}
                                        {/foreach}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    在线预约
                                </div>
                                <div class="panel-body">
                                    <form action="index.php?controller=appointment&method=Appointment" class="form-horizontal" method="post" role="form" style="margin-left:10%" onsubmit="return checkContent()">
                                        <div class="form-group" >
                                            <label for="theDoctorid" class="col-md-3 control-label">预约医生</label>
                                            <div class="col-md-9">
                                                <select name="theDoctorid" id="theDoctorid" class="form-control" style="width:70%" onchange="setSelect(this.value)">
                                                <option value="-1">请选择预约医生</option>
                                                {foreach $doctors as $doctor}
                                                    <option value="{$doctor.doctorid}">{$doctor.name} 医生</option>
                                                {/foreach}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="theDate" class="col-md-3 control-label">预约时间</label>
                                            <div class="col-md-9">
                                                <div class="input-group" style="width:70%">
                                                    <div class="input-group-btn" style="width:80%" >
                                                        <select name="theDate" id="theDate" class="form-control" >
                                                            <option value="1">今天</option>
                                                            <option value="2">明天</option>
                                                            <option value="3">后天</option>
                                                        </select>
                                                    </div>
                                                <input type="time" class="Text form-control" id="theStarttime" value="{$currentTime}" name="theStarttime" style="width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="theProjectid" class="col-md-3 control-label">项目</label>
                                            <div class="col-md-9">
                                                <select name="theProjectid" id="theProjectid" class="form-control" style="width:70%">
                                                    <option value="0">请先选择医师</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="预约" class="btn btn-info" style="margin-left:35%">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    项目一览
                                </div>
                                <div class="panel-body">
                                    <table name="projectsTable" id="mytable" class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <th>编号</th>
                                                <th>名称</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                    
                                        {section name=customer loop=$projects}
                                            <tr>
                                                <td >{$projects[customer].projectid}</td>
                                                <td>{$projects[customer].projectname}</td> 
                                                <td><button class="btn btn-link" data-toggle="modal" data-target="#{$projects[customer].projectid}">查看</button></td>
                                            </tr>
                                        {/section}
                                    </table>
                                    {include file='page.html'}
                                    <script >
                                        pageSize=4;
                                    </script>
                                    <link rel="stylesheet" href="css/appointmentView.css">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>


            

            {section name=customer loop=$projects}<!--循环创建不同的模态框-->
                <div class="modal fade" id="{$projects[customer].projectid}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                                <h4 class="modal-title" id="myModalLabel">项目信息</h4>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="projectName" class="control-label">项目名称:</label><label id="projectName"  class="control-label" style="margin-left:15%">{$projects[customer].projectname}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="projectPrice" class="control-label">项目价格:</label><label id="projectPrice"  class="control-label" style="margin-left:15%">{$projects[customer].price}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="lastTime" class="control-label">项目时长:</label><label id="lastTime"  class="control-label" style="margin-left:15%">{$projects[customer].time}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="Introduction" class="control-label">项目简介:</label><label id="Introduction"  class="control-label" style="margin-left:15%;width:50%">{$projects[customer].introduction}</label>
                                    </div>
                                </div>
    

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!--modal-->
            {/section}

            <!--<label for="projectName" class="col-offset-2 col-md-4 control-label">项目名称:</label>
                            <div class="col-md-6">
                                <label class="control-label" name="projectName">{$projects[customer].projectname}</label>
                            </div>

                            <div class="col-sm-offset-1 col-md-10">
                                <label for="projectPrice">项目价格:</label>
                                <label name="projectPrice">{$projects[customer].price}</label>
                            </div>
                            <div class="col-sm-offset-1 col-sm-10">
                                <label for="lastTime">项目时长:</label>
                                <label name="lastTime">{$projects[customer].time}</label>
                            </div>
                            <div class="col-sm-offset-1 col-sm-10">
                                <label for="Introduction">项目简介:</label>
                                <textarea class="form-control" name="Introduction" id="Introduction" cols="30" rows="10" placeholder="暂无介绍" readonly="readonly">{$projects[customer].introduction}</textarea>
                            </div>-->

        </div>
    </div>
</div>
</body>
</html>
