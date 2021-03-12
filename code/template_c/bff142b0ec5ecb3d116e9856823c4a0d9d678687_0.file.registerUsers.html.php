<?php
/* Smarty version 3.1.30, created on 2017-01-23 11:46:07
  from "D:\Apache\Apache24\htdocs\hospital\tpl\registerUsers.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5885ecff322ad2_46654304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bff142b0ec5ecb3d116e9856823c4a0d9d678687' => 
    array (
      0 => 'D:\\Apache\\Apache24\\htdocs\\hospital\\tpl\\registerUsers.html',
      1 => 1485171927,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5885ecff322ad2_46654304 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootscrap.min.css">
	<title>用户信息管理系统</title>
</head>
<body>
	<header>
		<h1 class='siteTitle'>用户信息管理系统</h1>
	</header>

	

	<section id="main" class="column">
		
		<article class="wholeTable">
		<header><h3 class="sectionTitle">用户信息管理列表</h3>
		</header>
		<div class="table">
			<div id="table1" class="table">
				<table class="tablesorter" cellspacing="0" style="margin:0"> 
					<thead> 
						<tr>  
			    				<th>ID</th>
			    				<th>用户名</th>
			    				<th>姓名</th>
			    				<th>联系方式</th>
			    				<th>操作</th>
						</tr> 
					</thead>
					<tbody>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
						<tr>
			    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
</td> 
			    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['username'];?>
</td> 
			    				<td><?php echo $_smarty_tpl->tpl_vars['value']->value['name'];?>
</td> 
								<td><?php echo $_smarty_tpl->tpl_vars['value']->value['tel'];?>
</td>
			    				<td><input type="submit"  name="delUser" value="删除" onclick="window.location.href='index.php?controller=admin&method=delUser&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
'"><input type="submit"  name="registerUser" value="注册" onclick="window.location.href='index.php?controller=admin&method=registerUser&userid=<?php echo $_smarty_tpl->tpl_vars['value']->value['userid'];?>
'"></td>
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
			
			<div id="table2" class="class">

			</div><!-- end of #table2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
	</section>
</body>

</html><?php }
}
