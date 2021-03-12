<?php
	class adminController
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
			if($this->auth['role']<3){
				$this->showmessage('您没有权限进入此页面', 'index.php?controller=appointment&method=QueryAppointment');
			}
		}

		//显示客户信息
		public function showClientsInfo(){
			$clientsObj=M('clients');
			$information=$this->returnInfoArray();
			$clisInfo=$clientsObj->getClientsInfo($information);
			$statisticsObj=M('Statistics');
			$data=array(
				'showWhat' => 'clients',
				'data' => $clisInfo,
				'auth' => $_SESSION['auth'],
				'verified' => $_POST['verified'],
				'unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid']),
				'whichPage' => 'clientsInfo'
			);
			VIEW::getInstance()->assign($data);
			VIEW::getInstance()->display('userInformation.html');
		}

		//显示医生信息
		public function showDoctorsInfo(){
			$doctorsObj=M('doctors');
			$information=$this->returnInfoArray();
			$docsInfo=$doctorsObj->getDoctorsInfo($information);
			$statisticsObj=M('Statistics');
			//var_dump('data',$docsInfo);
			$data=array(
				'showWhat' => 'doctors',
				'data' => $docsInfo,
				'auth' => $_SESSION['auth'],
				'verified' => $_POST['verified'],
				'unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid']),
				'allpros' => M('project')->selectPro(),
				'whichPage' => 'doctorsInfo'
			);
			VIEW::getInstance()->assign($data);
			VIEW::getInstance()->display('userInformation.html');
		}

		//注册一个用户
		public function registerUser(){
			$userid=$_GET['userid'];
			$showWhat=$_GET['showWhat'];
			//$showWhat不是doctors就是clients
			$usersObj=M('users');
			$role=$usersObj->roleOfUserid($userid);
			if($role>1)
				$Obj=M('doctors');
			else
				$Obj=M('clients');
			$data=array(
				'verified' => 1
			);
			$successOrNot=$Obj->updateByUserid($userid,$data);
			$this->judgeSuccess($successOrNot,'注册','index.php?controller=admin&method=show'.ucfirst($showWhat).'Info');
		}

		//删除一个用户
		public function delUser(){
			$showWhat=$_GET['showWhat'];
			if(!isset($_GET['userid'])){
				$this->showmessage('未选定显示对象','index.php?controller=admin&method=show'.ucfirst($showWhat).'Info');
			}
			$userid=$_GET['userid'];
			$userObj=M('users');
			$role=$userObj->roleOfUserid($userid);
			//删除d_p表格的所有东西
			$dpdel=1;
			if($role==2){
				$theInfos=$this->operateUserInfo($role,$userid,"findByUserid");
				$projectObj=M('project');
				$param=array(
					'where' => array(
						'doctorId' => $theInfos[0]['doctorid']
					)
				);
				$dpdel=$projectObj->delSupportDoc($param);
			}
			//删除个人信息以及用户信息
			$successOrNot=$this->operateUserInfo($role,$userid,"delByUserid")&&$userObj->delUserById($userid)&&$dpdel;
			$this->judgeSuccess($successOrNot,'删除','index.php?controller=admin&method=show'.ucfirst($showWhat).'Info');
		}


		/**************私有方法*******************/


		/*//显示一个用户的详细信息
		private function showOneInfo($userid){
			$doctorsObj=M('doctors');
			$proInfo=($role==2)?($doctorsObj->getProInfoByUserid($userid)):array();
			$data=array(
				'projects' =>  $proInfo
			);
			VIEW::getInstance()->assign($data);
		}*/


		//根据提交表单得到查找的信息，并生成查找数组
		private function returnInfoArray(){
			$information=array();
			if(isset($_POST['userid'])&&!empty($_POST['userid'])){
				$information[]="userid=".intval($_POST['userid']);
			}
			if(isset($_POST['username'])&&!empty($_POST['username'])){
				$userObj=M('users');
				$userInfo=$userObj->findByUsername($_POST['username']);
				if(!empty($userInfo)){
					$information[]="userid=".$userInfo[0]['userid'];
				}
				else{
					$information[]='userid=-1';
				}
			}
			if(isset($_POST['name'])&&!empty($_POST['name'])){
				$information[]="name like"."'%".$_POST['name']."%'";
			}
			if(isset($_POST['tel'])&&!empty($_POST['tel'])){
				$information[]="tel="."'".$_POST['tel']."'";
			}
			if(isset($_POST['verified'])&&!empty($_POST['verified'])){
				$information[]="verified=".$_POST['verified'];
			}
			//var_dump($information);
			return $information;
		}

		//根据role userid 和操作（函数）名称 进行对doctor或client表的操作
		private function operateUserInfo($role,$userid,$operation){
			$successOrNot=0;
			if($role>1){
				$doctorsObj=M('doctors');
				eval('$successOrNot=$doctorsObj->'.$operation.'($userid);');
			}
			else{
				$clientsObj=M('clients');
				eval('$successOrNot=$clientsObj->'.$operation.'($userid);');
			}
			return $successOrNot;
		}

		//显示信息框
		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}

		private function judgeSuccess($successOrNot,$operation,$direction){
			if($successOrNot){
				$this->showmessage($this->showmessage($operation.'成功',$direction));
			}
			else{
				$this->showmessage($this->showmessage($operation.'失败',$direction));
			}
		}

	}
?>