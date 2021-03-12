<?php
	class doctorsController
	{
		//登录信息
		public $auth;


		/*********************对外接口*************************/


		//构造函数
		public function __construct(){
			if(!$_SESSION){
				session_start();
			}
			if(!isset($_SESSION['auth']) && (Engine::$method!='login')){
				$this->showmessage('请登录后在操作！', 'index.php?controller=users&method=login');
			}
			else{
				$this->auth = isset($_SESSION['auth'])? $_SESSION['auth']:array();
			}
			if($this->auth['role']<2){
				$this->showmessage('您没有权限进入此页面', 'index.php?controller=appointment&method=QueryAppointment');
			}
		}

		//为一个医生新增一个项目
		public function addProjectForDoc(){
			if(isset($_POST['addPro'])){
				$doctorid=$_POST['doctorid'];
				$projectid=$_POST['projectid'];
			}
			else if(isset($_GET['doctorid'])){
				$doctorid=$_GET['doctorid'];
				$projectid=$_GET['projectid'];
			}
			$param=array(
				'doctorId' => $doctorid,
				'projectId' => $projectid
			);
			$proObj=M('project');
			$successOrNot=0;

			var_dump($projectid);
			var_dump($doctorid);
			
			if(empty($this->checkProRepeat($doctorid,$projectid))){
				$successOrNot=$proObj->addSupportDoc($param);
			}
			$this->judgeSuccess($successOrNot,'添加','index.php?controller=users&method=showMyInfo');
		}

		//为一个医生删除一个项目
		public function delProjectForDoc(){
			$doctorid=$_GET['doctorid'];
			$projectid=$_GET['projectid'];
			$param=array(
				'where'=>array(
					'doctorId' => $doctorid,
					'projectId' => $projectid
				)
			);
			$proObj=M('project');
			$successOrNot=$proObj->delSupportDoc($param);
			$this->judgeSuccess($successOrNot,'删除','index.php?controller=users&method=showMyInfo');
		}


		/**************私有方法*******************/
		//检查添加项目是否重复了
		private function checkProRepeat($doctorid,$projectid){
			$param=array(
				'where' => array(
					'doctorId' => $doctorid,
					'projectId' => $projectid
				) 
			);
			$proObj=M('project');
			return $proObj->selectDocPro($param);
		}

		//显示信息框
		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}

		//弹出成功与否的信息框
		private function judgeSuccess($successOrNot,$operation,$direction){
			if($successOrNot){
				$this->showmessage($this->showmessage($operation.'成功',$direction));
			}
			else{
				$this->showmessage($this->showmessage($operation.'失败',$direction));
			}
		}

	}