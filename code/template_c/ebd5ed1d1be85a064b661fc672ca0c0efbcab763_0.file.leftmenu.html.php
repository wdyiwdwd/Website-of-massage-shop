<?php
/* Smarty version 3.1.30, created on 2017-02-23 21:00:23
  from "D:\PHP_tools\Apache 2.4.23\Apache24\htdocs\hospital\tpl\leftmenu.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58aedce7606558_17958522',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebd5ed1d1be85a064b661fc672ca0c0efbcab763' => 
    array (
      0 => 'D:\\PHP_tools\\Apache 2.4.23\\Apache24\\htdocs\\hospital\\tpl\\leftmenu.html',
      1 => 1487854820,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58aedce7606558_17958522 (Smarty_Internal_Template $_smarty_tpl) {
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/leftmenu.css">
<?php echo '<script'; ?>
>
        $(function(){
            $(".panel-heading").click(function(e){
                /*切换折叠指示图标*/
                $(this).find("span").toggleClass("glyphicon-chevron-down");
                $(this).find("span").toggleClass("glyphicon-chevron-up");
            });
            $(".panel-group").height($(".content").height());
            $(document).on("click","#leftmenuFold",function(){
                $(".panel-heading").click();
            });
        });
<?php echo '</script'; ?>
>
<div class="col-md-2">
<div class="wholeleftmenu">
<nav class="leftmenu menuborder" role="navigation">
<aside id="sidebar" class="panel-group table-responsive" role="tablist">
	<!-- 出现标题吗
	<header class="panel panel-primary leftmenu">
        <h4 id="title">XX医院<br>微信预约系统</h4>
	</header> -->
	<div class="panel panel-primary leftmenu">
        <!-- 利用data-target指定要折叠的分组列表 -->
        <div class="panel-user" style="text-align:right;margin-right:10px">
        	<a href="#" id="leftmenuFold" class="menu-item-left">
				<span class="glyphicon glyphicon-th-list"></span>
			</a>
		</div>
        <div class="panel-user">
        	<a href="index.php?controller=users&method=showMyInfo" id="username" class="menu-item-left">
				<span class="glyphicon glyphicon-user "> <?php echo $_smarty_tpl->tpl_vars['auth']->value['username'];?>
</span>
			</a>
		</div>
		<div class="panel-user">
			<a href="index.php?controller=users&method=logout" id="logout" class="menu-item-left">
					<span class="glyphicon glyphicon-log-out "> 注销</span>
			</a>
		</div>
	</div>
	<div class="panel panel-primary leftmenu">
        <div class="panel-heading" id="collapseListGroupHeading1" data-toggle="collapse" data-target="#collapseListGroup1" role="tab" >
            <h4 class="panel-title">
                核心功能
                <span class="glyphicon glyphicon-chevron-up right"></span>
            </h4>
        </div>
        <!-- .panel-collapse和.collapse标明折叠元素 .in表示要显示出来 -->
        <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <ul class="list-group">
              <li class="list-group-item">
                <!-- 利用data-target指定URL -->
                <a class="menu-item-left appointmentsInfo" href="index.php?controller=appointment&method=QueryAppointment">
                    <span class="glyphicon glyphicon-triangle-right"></span>预约系统
                </a>
              </li>
              <!--<li class="list-group-item">
                <a class="menu-item-left dappointmentsInfo" href="index.php?controller=appointment&method=Query_D_Appointment">
                    <span class="glyphicon glyphicon-triangle-right"></span>当前预约
                </a>
              </li>-->
              <li class="list-group-item">
                <a class="menu-item-left personalCenter" href="index.php?controller=users&method=showMyInfo">
                    <span class="glyphicon glyphicon-triangle-right"></span>个人中心
                    <span class="badge pull-right" style="background-color:white;color:#a6a6a6"><?php echo $_smarty_tpl->tpl_vars['unfinished']->value;?>
</span>
                </a>
              </li>
            </ul>
        </div>
    </div><!--panel end-->
     <div class="panel panel-primary leftmenu">
        <div class="panel-heading" id="collapseListGroupHeading2" data-toggle="collapse" data-target="#collapseListGroup2" role="tab" >
            <h4 class="panel-title">
                管理员管理
                <span class="glyphicon glyphicon-chevron-up right"></span>
            </h4>
        </div>
        <div id="collapseListGroup2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
            <ul class="list-group">
              <li class="list-group-item">
                <a class="menu-item-left projectsInfo" href="index.php?controller=project&method=showProjects">
                    <span class="glyphicon glyphicon-triangle-right"></span>项目管理
                </a>
              </li>
              <li class="list-group-item">
                <a class="menu-item-left doctorsInfo" href="index.php?controller=admin&method=showDoctorsInfo">
                    <span class="glyphicon glyphicon-triangle-right"></span>医生管理
                </a>
              </li>
              <li class="list-group-item clientsInfo">
                <a class="menu-item-left" href="index.php?controller=admin&method=showClientsInfo">
                	<span class="glyphicon glyphicon-triangle-right"></span>客户管理
                </a>
              </li>
            </ul>
        </div>
    </div> 
</aside><!-- end of sidebar -->
</nav>
</div>
</div><?php }
}
