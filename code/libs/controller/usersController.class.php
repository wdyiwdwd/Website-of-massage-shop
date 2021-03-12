<?php
	class usersController
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
		}

		//登陆方法
		public function login(){
			//未登录
			if(!isset($_POST['login'])){
				VIEW::getInstance()->display('login.html');
			}
			//点击登陆按钮
			else{
				$this->checklogin();
			}
		}

		//注销
		public function logout(){
			unset($_SESSION['auth']);
			$this->showmessage(null, 'index.php?controller=users&method=login');
		}

		//个人中心
		public function showMyInfo(){
			$auth=$_SESSION['auth'];
			$userid=$auth['userid'];
			$userObj=M('users');
			$staObj=M('Statistics');
			$doctorsObj=M('doctors');
			$projectsObj=M('project');

			
			$role=$userObj->roleOfUserid($userid);
			//找到个人信息以及用户信息
			$personInfo=$this->operateUserInfo($role,$userid,"findByUserid");
			$userInfo=$userObj->findByid($userid);
			
			$proInfo=($role==2)?($doctorsObj->getProInfoByUserid($userid)):array();
			
			//$allprojects=($role==2)?($projectsObj->selectPro()):array();
			$allprojects=$projectsObj->selectPro();
			//$projectsObj->getProjects();

			//

			$detailInfo=array();
			$detailInfo['userId']=$userInfo[0]['userid'];
			$detailInfo['userName']=$userInfo[0]['username'];
			switch ($userInfo[0]['role']) {
				case 1:
					$detailInfo['role']="客户";
					//var_dump($personInfo[0]['cleintid']);
					$detailInfo['appointmentAmount']=$staObj->getNotesAmount(array("where"=>array("cleintId"=>$personInfo[0]['cleintid'])));
					break;
				case 2:
					$detailInfo['role']="医生";
					//var_dump($personInfo[0]['doctorid']);
					$detailInfo['appointmentAmount']=$staObj->getNotesAmount(array("where"=>array("doctorId"=>$personInfo[0]['doctorid'])));
					break;
				case 3:
					$detailInfo['role']="管理员";
					$detailInfo['appointmentAmount']=$staObj->getNotesAmount();
					break;
				default:
					$detailInfo['role']="未知";
					$detailInfo['appointmentAmount']=0;
					break;
			}
			//var_dump($detailInfo['role']);
			$detailInfo['lastTime']=is_null($userInfo[0]['lasttime'])?"空":$userInfo[0]['lasttime'];
			$detailInfo['WX']=is_null($userInfo[0]['wxOpenId'])?"空":$userInfo[0]['wxOpenId'];
			$detailInfo['realName']=is_null($personInfo[0]['name'])?"空":$personInfo[0]['name'];
			$detailInfo['tel']=is_null($personInfo[0]['tel'])?"空":$personInfo[0]['tel'];
			$detailInfo['gender']=is_null($personInfo[0]['gender'])?"空":$personInfo[0]['gender'];
			$detailInfo['email']=is_null($personInfo[0]['email'])?"空":$personInfo[0]['email'];
			$detailInfo['fax']=is_null($personInfo[0]['fax'])?"空":$personInfo[0]['fax'];
			$detailInfo['location']=is_null($personInfo[0]['location'])?"空":$personInfo[0]['location'];
			$detailInfo['verified']=$personInfo[0]['verified']==1?"是":"否";
			switch ($_SESSION['auth']) {
				case 1:
					$roleName="客户";
					break;
				case 2:
					$roleName="医生";
					break;
				case 1:
					$roleName="管理员";
					break;
				default:
					$roleName="游客";
					break;
			}
			//var_dump($allprojects);
			$statisticsObj=M('Statistics');
			$data=array(
				'auth' => $_SESSION['auth'],
				'access' => $roleName,
				'user' => $userInfo[0],
				'doc_pro' =>  $proInfo,
				'allpros' => $allprojects,
				'person' => $personInfo[0],
				'detail'=>$detailInfo,
				'unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid']),
				'whichPage' => 'personalCenter'
			);
			$this->assignProjects();
			$this->assignDoctors();
			$this->assignAppointments();
			VIEW::getInstance()->assign($data);
			//VIEW::getInstance()->display('personalCenter.html');
			VIEW::getInstance()->display('pc.html');
		}

		//修改个人信息
		public function updateMyInfo(){
			$showWhat=$_GET['showWhat'];
			$userid=$_GET['userid'];
			$userObj=M('users');
			$clientData=$this->getClientPostInfo();
			$role=$userObj->roleOfUserid($userid);
			//删除个人信息以及用户信息
			$successOrNot=$this->operateUserInfo($role,$userid,"updateByUserid",$clientData);
			$this->judgeSuccess($successOrNot,'更新','index.php?controller=users&method=showMyInfo');
		}

		//修改新密码
		public function updatePassword(){
			$data=array();
			$successOrNot=0;
			$userid=$_GET['userid'];
			if(isset($_POST['password'])){
				if($_POST['password1']==$_POST['password2']){
					$data['password']=$_POST['password1'];
					$where=array('userid='.$userid);
					$userObj=M('users');
					$successOrNot=$userObj->updateUser($where,$data);
				}
			}
			else{
				$data['password']="123456";
				$where=array('userid='.$userid);
				$userObj=M('users');
				$successOrNot=$userObj->updateUser($where,$data);
			}
			$this->judgeSuccess($successOrNot,'修改','index.php?controller=users&method=showMyInfo');
		}

		/**************私有方法*******************/


		//得到对client表的操作的POST的信息
		private function getClientPostInfo(){
			$information=array();
			if(isset($_POST['update'])){
				$information['name']=$_POST['name'];
				$information['gender']=$_POST['gender'];
				$information['tel']=$_POST['tel'];
				$information['email']=$_POST['email'];
				$information['fax']=$_POST['fax'];
				$information['location']=$_POST['location'];
			}
			return $information;
		}
		public function assignDoctors(){
			C('appointment','assignDoctor');
		}
		public function assignProjects(){
			C('appointment','assignProject');
		}

		public function assignAppointments(){
			$docObj=M('doctors');
			$proObj=M('project');
			$result=$this->queryAppointment();
			$notes=array();
			$single=array();
			foreach ($result as $value) {
				$single['appointmentId']=$value['appointmentid'];
				$temp=$docObj->findWeNeed(array(" `doctorid` = $value[doctorid]"));
				$single['doctorName']=$temp[0]['name'];
				$temp=$proObj->selectPro(array("where"=>array("projectId"=>$value['projectid'])));
				$single['projectName']=$temp[0]['projectname'];
				$single['startTime']=$value['starttime'];
				$single['endTime']=$value['endtime'];
				$single['isOut']=$value['starttime']>date('Y-m-d H:i:s',time())?0:1;
				$notes[]=$single;
			}
			VIEW::getInstance()->assign(array("notes"=>$notes));
		}
		public function queryAppointment(){
			$message=array();
			if(!empty($_POST["theProjectId"]))
				$message['projectId']=$_POST['theProjectId'];
			if(!empty($_POST["theDoctorId"]))	
				$message['doctorId']=$_POST["theDoctorId"];
			if(!empty($_POST["theAppointmentId"]))	
				$message['appointmentId']=$_POST["theAppointmentId"];

			if(!empty($_POST['date'])){
				$message['rightDate']=date('Y-m-d');//今天
				switch ($_POST['date']) {
					case '全部':
						$message['leftDate']=date('Y-m-d' , strtotime('-30 year'));
						break;
					case '今天':
						$message['leftDate']=date('Y-m-d');
						break;
					case '近一个月':
						$message['leftDate']=date('Y-m-d' , strtotime('-1 month'));
						break;
					case '近一年':
						$message['leftDate']=date('Y-m-d' , strtotime('-1 year'));
						break;
				}
			}
			$param['order']=" `starttime` DESC";
			if(!empty($message))
				$param['where']=$message;
			$result=M('Statistics')->getNotesList($param);
			//var_dump($result);
			return $result;
		}

		public function DeleteAppointment(){
			if(!empty($_GET['appointmentid'])){
				M('appointment')->D_reservation(array("appointmentid"=>$_GET['appointmentid']));
			}
			$this->showMyInfo();
		}

		//根据role userid 和操作（函数）名称 进行对doctor或client表的操作
		private function operateUserInfo($role,$userid,$operation,$data=NULL){
			$successOrNot=0;
			$secondIndex=(!empty($data))?',$data':'';
			if($role>1){
				$doctorsObj=M('doctors');
				eval('$successOrNot=$doctorsObj->'.$operation.'($userid'.$secondIndex.');');
			}
			else{
				$clientsObj=M('clients');
				eval('$successOrNot=$clientsObj->'.$operation.'($userid'.$secondIndex.');');
			}
			return $successOrNot;
		}

		//检查用户名密码是否匹配
		private function checklogin(){
			if(empty($_POST['username'])||empty($_POST['password'])){
				$this->showmessage('用户名或密码为空！', 'index.php?controller=users&method=login');
			}
			$username = daddslashes($_POST['username']);
			$password = daddslashes($_POST['password']);
			$authobj = M('users');
			//var_dump($authobj->checkAuth($username, $password));
			$auth = $authobj->checkAuth($username, $password);
			if($auth && $this->checkVerified($auth['role'],$auth['userid'])==1){
				$_SESSION['auth'] = $auth;
				$this->updateTime();
				echo "<script>window.location.href='index.php?controller=appointment&method=QueryAppointment'</script>";
			}else{
				$this->showmessage('用户名或密码错误！', 'index.php?controller=users&method=login');
			}
		}

		//检查该用户是医生还是客户 返回值是它已注册与否
		private function checkVerified($role,$userid){
			//var_dump($userid);
			if($role>1){
				$Obj=M('doctors');
			}
			else{
				$Obj=M('clients');
			}
			$Info=$Obj->findByUserid($userid);
			return $Info[0]['verified'];
		}

		//更新登录时间
		private function updateTime(){
			date_default_timezone_set("Asia/Shanghai");
			$auth=$_SESSION['auth'];
			$userid=$auth['userid'];
			$where=array('userid='."'".$userid."'");
			$data=array(
				'lasttime' => date("Y-m-d H:i:s")
			);
			$authobj = M('users');
			return $authobj->updateUser($where,$data);
		}

		//显示信息框
		private function showmessage($info, $url){
			if(is_null($info))
				echo "<script>window.location.href='$url'</script>";
			else
				echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}

		private function judgeSuccess($successOrNot,$operation,$direction){
			if($successOrNot){
				$this->showmessage($this->showmessage($operation.'成功',$direction));
			}
			else{
				$this->showmessage($this->showmessage($operation.'失败 或者更新无改动',$direction));
			}
		}

	}
?>