function confirmDel(projectid){
		if(confirm("确认删除吗？")){
			window.location.href="index.php?controller=project&method=delProject&ID="+projectid;
		}
	}
	function checkAdd(){
		if(document.getElementById("newProjectName").value==''||document.getElementById("newProjectPrice").value==''||document.getElementById("newLastTime").value==''){
			alert("信息填写不完整！");
			return false;
		}
		return true;
	}