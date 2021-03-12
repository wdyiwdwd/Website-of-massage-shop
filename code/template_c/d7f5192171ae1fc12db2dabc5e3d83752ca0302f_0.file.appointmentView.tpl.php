<?php
/* Smarty version 3.1.30, created on 2017-02-23 23:56:18
  from "C:\wamp64\www\hos\tpl\appointmentView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58af06229dbc25_14374023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7f5192171ae1fc12db2dabc5e3d83752ca0302f' => 
    array (
      0 => 'C:\\wamp64\\www\\hos\\tpl\\appointmentView.tpl',
      1 => 1487865373,
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
function content_58af06229dbc25_14374023 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html lang="en">
 <head>
  	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/about.css">

	<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
  	<title>AppointmentView</title>
 </head>
<?php echo '<script'; ?>
>
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
    var options=<?php echo $_smarty_tpl->tpl_vars['json_doc_pro']->value;?>
;
    for (var i = options.length - 1; i >= 0; i--) {
        if(options[i]['doctorId']==doctorid){
            //selectObj.options.add(new Option("文本", i));
            selectObj.options.add(new Option(options[i]['projectName'], options[i]['projectId']));// ("文本"，"值")
        } 
    };
}

<?php echo '</script'; ?>
>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:topmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="content">
    <div class="row">
    <?php $_smarty_tpl->_subTemplateRender("file:leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['doctors']->value, 'doctor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['doctor']->value) {
?>
                                                <?php if ($_smarty_tpl->tpl_vars['selectedDoctor']->value == $_smarty_tpl->tpl_vars['doctor']->value['doctorid']) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['doctor']->value['doctorid'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['doctor']->value['doctorid'];?>
"><?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
</option>
                                                <?php }?>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['todayAppointments']->value, 'today');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['today']->value) {
?>
                                            <li>
                                            <span><?php echo $_smarty_tpl->tpl_vars['today']->value['startTime'];?>
</span>
                                            <p><span style="width: 40%"><?php echo $_smarty_tpl->tpl_vars['today']->value['proName'];?>
 (至 <?php echo $_smarty_tpl->tpl_vars['today']->value['endTime'];?>
)</span></p>
                                            </li>
                                        <?php
}
} else {
?>

                                        <?php if ($_smarty_tpl->tpl_vars['appointmentAmount']->value == -1) {?>
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
                                        <?php } else { ?>
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(今天暂无预约哦)</span></p>
                                            </li>
                                        <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div>
                                    
                                    <div>
                                        <h3 id="tomorrow">tomorrow</h3>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tomorrowAppointments']->value, 'tomorrow');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['tomorrow']->value) {
?>
                                            <li>
                                            <span><?php echo $_smarty_tpl->tpl_vars['tomorrow']->value['startTime'];?>
</span>
                                            <p><span style="width: 40%"><?php echo $_smarty_tpl->tpl_vars['tomorrow']->value['proName'];?>
  (至 <?php echo $_smarty_tpl->tpl_vars['tomorrow']->value['endTime'];?>
)</span></p>
                                            </li>
                                        <?php
}
} else {
?>

                                        <?php if ($_smarty_tpl->tpl_vars['appointmentAmount']->value == -1) {?>
                                            <li>
                                            <span>9:00</span>
                                            <p><span style="width: 35%">第二天的预约会显示在这里哦</span></p>
                                            </li>
                                            <li>
                                            <span>14:00</span>
                                            <p><span style="width: 35%">营业时间为： 8:00 ~ 20:00</span></p>
                                            </li>
                                        <?php } else { ?>
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(明天暂无预约哦)</span></p>
                                            </li>
                                        <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div>
                                    <div>
                                        <h3 id="afterTomorrow">day after tomorrow</h3>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['afterTomorrowAppointments']->value, 'afterTomorrow');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['afterTomorrow']->value) {
?>
                                            <li>
                                            <span><?php echo $_smarty_tpl->tpl_vars['afterTomorrow']->value['startTime'];?>
</span>
                                            <p><span style="width: 40%"><?php echo $_smarty_tpl->tpl_vars['afterTomorrow']->value['proName'];?>
 (至 <?php echo $_smarty_tpl->tpl_vars['afterTomorrow']->value['endTime'];?>
)</span></p>
                                            </li>
                                        <?php
}
} else {
?>

                                            <?php if ($_smarty_tpl->tpl_vars['appointmentAmount']->value == -1) {?>
                                            <li>
                                                <span>18:00</span>
                                                <p><span style="width: 35%">别忘了，最多只可提前三天进行预约哦！</span></p>
                                            </li>
                                            <?php } else { ?>
                                            <li>
                                            <span>空闲</span>
                                            <p><span style="width: 35%">(后天暂无预约哦)</span></p>
                                            </li>
                                            <?php }?>
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success" >
                                <div class="panel-heading">
                                    在线预约
                                </div>
                                <div class="panel-body">
                                    <form action="index.php?controller=appointment&method=Appointment" class="form-horizontal" method="post" role="form" style="margin-left:5%" onsubmit="return checkContent()">
                                        <div class="form-group" >
                                            <label for="theDoctorid" class="col-md-3 control-label">预约医生</label>
                                            <div class="col-md-9">
                                                <select name="theDoctorid" id="theDoctorid" class="form-control" style="width:80%" onchange="setSelect(this.value)">
                                                <option value="-1">请选择预约医生</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['doctors']->value, 'doctor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['doctor']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['doctor']->value['doctorid'];?>
"><?php echo $_smarty_tpl->tpl_vars['doctor']->value['name'];?>
 医生</option>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="theDate" class="col-md-3 control-label">预约时间</label>
                                            <div class="col-md-9">
                                                <div class="input-group" style="width:80%">
                                                    <div class="input-group-btn" style="width:80%" >
                                                        <select name="theDate" id="theDate" class="form-control" >
                                                            <option value="1">今天</option>
                                                            <option value="2">明天</option>
                                                            <option value="3">后天</option>
                                                        </select>
                                                    </div>
                                                <input type="time" class="Text form-control" id="theStarttime" value="<?php echo $_smarty_tpl->tpl_vars['currentTime']->value;?>
" name="theStarttime" style="width:100%">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="theProjectid" class="col-md-3 control-label">项目</label>
                                            <div class="col-md-9">
                                                <select name="theProjectid" id="theProjectid" class="form-control" style="width:80%">
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
                                    
                                        <?php
$__section_customer_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_customer']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer'] : false;
$__section_customer_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['projects']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_customer_0_total = $__section_customer_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = new Smarty_Variable(array());
if ($__section_customer_0_total != 0) {
for ($__section_customer_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] = 0; $__section_customer_0_iteration <= $__section_customer_0_total; $__section_customer_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']++){
?>
                                            <tr>
                                                <td ><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectname'];?>
</td> 
                                                <td><button class="btn btn-link" data-toggle="modal" data-target="#<?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
">查看</button></td>
                                            </tr>
                                        <?php
}
}
if ($__section_customer_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = $__section_customer_0_saved;
}
?>
                                    </table>
                                    <?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                                    <?php echo '<script'; ?>
 >
                                        pageSize=4;
                                    <?php echo '</script'; ?>
>
                                    <link rel="stylesheet" href="css/appointmentView.css">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>


            

            <?php
$__section_customer_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_customer']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer'] : false;
$__section_customer_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['projects']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_customer_1_total = $__section_customer_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_customer'] = new Smarty_Variable(array());
if ($__section_customer_1_total != 0) {
for ($__section_customer_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] = 0; $__section_customer_1_iteration <= $__section_customer_1_total; $__section_customer_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']++){
?><!--循环创建不同的模态框-->
                <div class="modal fade" id="<?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectid'];?>
" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
                                <h4 class="modal-title" id="myModalLabel">项目信息</h4>
                            </div>
                            
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="projectName" class="control-label">项目名称:</label><label id="projectName"  class="control-label" style="margin-left:15%"><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['projectname'];?>
</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="projectPrice" class="control-label">项目价格:</label><label id="projectPrice"  class="control-label" style="margin-left:15%"><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['price'];?>
</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="lastTime" class="control-label">项目时长:</label><label id="lastTime"  class="control-label" style="margin-left:15%"><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['time'];?>
</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <label for="Introduction" class="control-label">项目简介:</label><label id="Introduction"  class="control-label" style="margin-left:15%;width:50%"><?php echo $_smarty_tpl->tpl_vars['projects']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_customer']->value['index'] : null)]['introduction'];?>
</label>
                                    </div>
                                </div>
    

                            </div>
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

        </div>
    </div>
</div>
</body>
</html>
<?php }
}
