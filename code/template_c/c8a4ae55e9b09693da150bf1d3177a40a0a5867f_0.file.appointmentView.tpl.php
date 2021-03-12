<?php
/* Smarty version 3.1.30, created on 2017-02-18 15:11:48
  from "C:\wamp64\www\hospital\tpl\appointmentView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58a7f3b43a0dc8_90605340',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8a4ae55e9b09693da150bf1d3177a40a0a5867f' => 
    array (
      0 => 'C:\\wamp64\\www\\hospital\\tpl\\appointmentView.tpl',
      1 => 1487401901,
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
function content_58a7f3b43a0dc8_90605340 (Smarty_Internal_Template $_smarty_tpl) {
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
	<?php echo '<script'; ?>
 type="text/javascript" src="js/appointment.js"><?php echo '</script'; ?>
>
  	<title>AppointmentView</title>
  	<?php echo '<script'; ?>
>
  	function setProject1 (id){
        var selectObj=document.getElementById("selectProject1");
        selectObj.options.length=0; 
        var doc_pro=<?php echo $_smarty_tpl->tpl_vars['json1']->value;?>
;
        var projects=<?php echo $_smarty_tpl->tpl_vars['json2']->value;?>
;
        for(var i=0;i<doc_pro.length;i++){
            for(var key in doc_pro[i]){
                if(key=="doctorid"&&doc_pro[i][key]==id){
                    var projectid=doc_pro[i]['projectid']//从doc_pro表里找到doctorid对应的projectid
                    for(var j=0;j<projects.length;j++){  //从projects表里找到对应projectid的projectname
                        for(var key2 in projects[j]){
                            if(key2=="projectid"&&projects[j][key2]==projectid){
                                //将名字和projectid注入options
                                selectObj.options.add(new Option(projects[j]['projectname'], projectid));
                            }
                        }
                    }
                }
            }
        }
    }

    function setProject2 (id){
        var selectObj=document.getElementById("selectProject2");
        var LabelObj=document.getElementById("show_time");

        selectObj.options.length=0; 
        var doc_pro=<?php echo $_smarty_tpl->tpl_vars['json1']->value;?>
;
        var projects=<?php echo $_smarty_tpl->tpl_vars['json2']->value;?>
;
        for(var i=0;i<doc_pro.length;i++){
            for(var key in doc_pro[i]){
                if(key=="doctorid"&&doc_pro[i][key]==id){
                    var projectid=doc_pro[i]['projectid']//从doc_pro表里找到doctorid对应的projectid
                    for(var j=0;j<projects.length;j++){  //从projects表里找到对应projectid的projectname
                        for(var key2 in projects[j]){
                            if(key2=="projectid"&&projects[j][key2]==projectid){
                                //将名字和projectid注入options
                                selectObj.options.add(new Option(projects[j]['projectname'], projectid));
                                LabelObj.innerText=projects[j]['time']+"分钟";
                            }
                        }
                    }
                }
            }
        }
    }

    function setTimeLabel(id){
         var LabelObj=document.getElementById("show_time");
         var projects=<?php echo $_smarty_tpl->tpl_vars['json2']->value;?>
;
         for(var i=0;i<projects.length;i++){
            for(var key in projects[i]){
                if(key=="doctorid"&&key==id){
                    LabelObj.innerText="该项目时间为:"+projects[i]['time'];
                }
            }
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
 			<header class="text-center headline">预约系统</header>

            <!--查询表单-->
 			<form name="query" class="form top form-inline" role="form" action="index.php?controller=appointment&method=QueryAppointment" method="post">
 			
                <div class="row">

                <div class="form-group col-md-2">
 				<select name="doctorid" id="select" onchange="setProject1(this.value)"  class="form-control">
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
                <div class="form-group col-md-2">
 				<select name="projectid" id="selectProject1"  class="form-control" style="width:120px">
                     <option value="">请选择项目</option>
 				</select>
                </div>
                <div class="form-group col-md-5">
	 				<label class="control-label" style="color:grey;font-size:16px">时间:</label>
	 				<input type="time" class="Text form-control" id="starttime" name="starttime" style="width:100px">
                    ~
 				    <input type="time" class="Text form-control" id="endtime" name="endtime" style="width:100px">
                    <select name="date" class="form-control">
                        <option value="0">日期</option>
                        <option value="1">今天</option>
                        <option value="2">明天</option>
                        <option value="3">后天</option>
                    </select>
                </div>

				<div class="col-md-1">
 				<input type="submit" class="btn btn-info " value=" 查询 "  >
                </div>

			</form>
             <!--查询表单结束-->

             <div class="col-md-2">
            <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" value="点击进行预约">
            </div>

            </div><!-- end of row--><br>

            <!-- 提示问字 -->
            <label class="notice" style="color:grey;font-size:15px">
                当前预约状况：
            </label>
             <label class="notice" style="color:grey;font-size:12px">
                （小提示：预约之前先查询想要预约的医师和项目在想预约的时间内是否空闲会更方便）
            </label>

            <!--预约表单结束-->

            <br>
			<table id="mytable" class="table table-striped">
            <thread>
	 			<th>医师</th>
	 			<th>项目</th>
	 			<th>起始时间</th>
	 			<th>结束时间</th>
            </thread>
		
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['querydatas']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>

            <?php if ($_smarty_tpl->tpl_vars['data']->value['endtime'] > $_smarty_tpl->tpl_vars['currentTime']->value) {?>   <!--过期的项目不显示-->
			<tr>
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
			</tr>
            <?php }?>

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
		<!--下面是它专门的模态框按钮-->
		
		<?php $_smarty_tpl->_subTemplateRender("file:page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
		</article>

	</div>
    </div>
	

<!--modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><!--右上角的 X 关闭-->
			<h4 class="modal-title" id="myModalLabel">填写预约信息</h4>
		</div>
		<div class="modal-body"><!--in body-->

		<form name="appointment" class="form-horizontal" action="index.php?controller=appointment&method=Appointment" method="post" role="form">

			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<label for="doctor">医生:</label>
						 <select name="doctorid" id="select" onchange="setProject2(this.value)"  class="form-control">
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
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
				<label for="project">项目:</label>
					<select name="projectid" id="selectProject2" class="form-control"
	                     onchange="setTimeLabel(this.value)">    <!--动态设置时间标签-->       
	                    <option value="">请选择项目</option>
	 				</select>
				</div>
			</div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                    <label for="time" >项目时长:</label>
                    <label class="form-control" id="show_time" style="background-color:#f8f8f8">请先选择医师和项目</label>
                </div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-5">
					<label for="starttime">预约起始时间:</label>	
                         <select name="date" class="form-control">
                            <option value="0">日期</option>
                            <option value="1">今天</option>
                            <option value="2">明天</option>
                            <option value="3">后天</option>
                         </select>
				</div>
                <div class="form-group">
                <div class=" col-sm-5">
                    <label for="starttime">时分：</label>
                    <input type="time" class="Text form-control" id="starttime" name="starttime">
                </div>
            </div>
             <label class="col-sm-offset-8" style="font-size:14px color:grey" >工作时间：6:00-22:00</label>
			</div>
			<label class="col-sm-offset-1" style="color:red;font-size:13px" >*请确认填写所有条件</label>
		</div><!--modal body-->
		<div class="modal-footer"> 
			<button type="submit" class="btn btn-primary">预约</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
			</form>          
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->



 </body>
</html>
<?php }
}
