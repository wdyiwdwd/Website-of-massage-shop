<!DOCTYPE html>
<html lang="en">
<head>
	{*include file='topmenu.html'*}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<title>项目管理-编辑</title>
</head>
<body>
	<!--<script language="javascript" type="text/javascript">
		function checkInput(){
			var proName=document.getElementsByName("projectName");
			if(proName.value=null||proName.value=""){
				alert("至少要输入项目名称！");
				return false;
			}
			else{
				alert("sd");
				alert(proName.value);
				return true;
			}
		}
	</script>-->
	<form role="form" action="{$jumpURL}" method="post" onsubmit="return checkInput()" class="form-horizontal">
		<div class="form-group">
			<!--<input type="hidden" name="theProjectId" value="{$detailInfo.proId}" >-->
			<table>
				<tr>
				<div class="form-group">
					<td><label for="projectName" >项目名称:</label></td>
					<td><input type="text" name="projectName" id="projectName" class="form-control" placeholder="填入项目名称" value="{$detailInfo.proName}"><span class="label label-danger">*必填!</span>
				</div>	
					</td>
				</tr>
				<tr>
				<div class="form-group">
					<td><label for="projectPrice" >项目价格:</label></td>
					<td><input type="text" name="projectPrice" class="form-control" placeholder="填入项目价格" value="{$detailInfo.proPrice}"> </td>
				</div>
				</tr>
				<tr>
				<div class="form-group">
					<td><label for="lastTime">项目时长:</label></td>
					<td><input type="text" name="lastTime" placeholder="填入项目时长" class="form-control" value="{$detailInfo.lastTime}"></td>
				</div>
				</tr>
				<tr>
				<div class="form-group">
					<td><label for="Introduction" >项目简介:</label></td>
					<td><textarea class="form-control" id="Introduction" cols="30" rows="10">{$detailInfo.introduction}</textarea></td>
				</div>
				</tr>
			</table>
			<div class="form-group">
			<input type="submit" name="submit" value="确定" class="btn btn-primary" onclick="checkInput()">
			<input type="button" name="backButton" value="返回" class="btn btn-info" onclick="window.location.href='index.php?controller=project&method=getProjects'">
			</div>
		</div>
	</form><input type="button" name="testButton" value="测试" onclick="checkInput()"><!--为什么说未定义啊？  输入检查-->
	
</body>
</html>