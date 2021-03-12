
<?php
	class appointmentController
	{
		//
		
		private $model=NULL;
		private static $smarty=null;
		public function __construct(){
			$this->model=M('appointment');
			if(!$_SESSION){
				session_start();
			}
			if(!isset($_SESSION['auth']) && (Engine::$method!='login')){
				$this->showmessage('请登录后在操作！', 'index.php?controller=users&method=login');
			}
			else{
				$this->auth = isset($_SESSION['auth'])? $_SESSION['auth']:array();
			}
			self::$smarty=VIEW::getInstance();
			self::$smarty->assign(array('auth'=>$_SESSION['auth']));
			
		}
		

		//查询预约
		public function QueryAppointment(){
			//查询时，列表可以为空
			$message=array();
			if(!empty($_POST["projectid"]))
				$message['projectid']=$_POST['projectid'];
			if(!empty($_POST["doctorid"]))	
				$message['doctorid']=$_POST["doctorid"];
			if(!empty($_POST["date"]))
				$message['date']=$_POST["date"];
			if(!empty($_POST["starttime"]))
				$message['starttime']=$_POST["starttime"];
			if(!empty($_POST["endtime"]))
				$message['endtime']=$_POST["endtime"];
			$message=$this->model->praseTime($message);
			$this->assignDoctor();
			$this->assignProject();
			$datas=$this->model->query($message);
			//注册当前时间
			date_default_timezone_set('Asia/Shanghai');
			$currentTime= date('Y-m-d H:i:s',time());
			$statisticsObj=M('Statistics');
			self::$smarty->assign(array('unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid'])));
			self::$smarty->assign(array("currentTime"=>$currentTime));

			self::$smarty->assign(array("querydatas"=>$datas));
			self::$smarty->assign(array("whichPage"=>'appointmentsInfo'));
			self::$smarty->display("appointmentView.tpl");
		}

		//预约
		public function Appointment(){
			
			if(!empty($_POST["projectid"])&&!empty($_POST["doctorid"])&&!empty($_POST["starttime"])&&!empty($_POST["date"]) ){
				$projectid=$_POST["projectid"];
				$doctorid=$_POST["doctorid"];
				$starttime=$_POST["starttime"];
				$date=$_POST["date"];
				
				$time=$this->getProjectTime($projectid);
				$endtime=date_create($starttime);//将所有时间按分钟计算，endtime=starttime+$time(projecttime)的值
				date_add($endtime,date_interval_create_from_date_string("$time minutes"));
				$endtime=date_format($endtime,"H:i:s");

				$temp=array("projectid"=>"$projectid","doctorid"=>"$doctorid","starttime"=>"$starttime","endtime"=>"$endtime","date"=>"$date");

				$temp=$this->model->praseTime($temp);

				$message=array();
				$message['projectid']=$temp['projectid'];
				$message['doctorid']=$temp['doctorid'];
				$message['starttime']=$temp['starttime'];
				$message['endtime']=$temp['endtime'];
				$auth=$_SESSION['auth'];
				$message['clientid']=$auth['userid'];
				
				if($this->model->overdue($message)){
					$this->showmessage('请检查您填写的时间，填写将来的时间','index.php?controller=appointment&method=QueryAppointment');
				}
				elseif($this->model->not_work_time($message)){
					$this->showmessage('该时间不在工作时间内','index.php?controller=appointment&method=QueryAppointment');
				}
				elseif($this->model->isConflict($message)){
					$this->showmessage('时间填写冲突，该时间已经被预约','index.php?controller=appointment&method=QueryAppointment');
				}
				else{
					$this->model->addAppointment($message);
					$this->showmessage('添加成功','index.php?controller=appointment&method=QueryAppointment');
				}
			}
			else{
				$this->showmessage('信息填写不全','index.php?controller=appointment&method=QueryAppointment');
			}
		}

		public function Query_D_Appointment(){
			$message=array();
			if(!empty($_POST['appointmentid']))
				$message['appointmentid']=$_POST['appointmentid'];
			if(!empty($_POST["projectid"]))
				$message['projectid']=$_POST['projectid'];
			if(!empty($_POST["doctorid"]))	
				$message['doctorid']=$_POST["doctorid"];
			if(!empty($_POST['date'])){
				switch ($_POST['date']) {
					case '全部':
					$message['starttime']=date('Y-m-d' , strtotime('-30 year'));
						break;
					case '今天':
					$message['starttime']=date('Y-m-d');
						break;
					case '近一个月':
					$message['starttime']=date('Y-m-d' , strtotime('-1 month'));
						break;
					case '近三个月':
					$message['starttime']=date('Y-m-d' , strtotime('-3 month'));
						break;
					case '近一年':
					$message['starttime']=date('Y-m-d' , strtotime('-1 year'));
						break;
				}
			}

			$auth=$_SESSION['auth'];
			$message['clientid']=$auth['userid'];
			$datas=$this->model->query($message);
			$this->assignDoctor();
			$this->assignProject();
			$statisticsObj=M('Statistics');
			self::$smarty->assign(array('unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid'])));
			self::$smarty->assign(array("querydatas"=>$datas));
			self::$smarty->assign(array("whichPage"=>'dappointmentsInfo'));
			date_default_timezone_set('Asia/Shanghai');
			$currentTime= date('Y-m-d H:i:s',time());
			self::$smarty->assign(array("currentTime"=>$currentTime));
			self::$smarty->display("DappointmentView.tpl");
		}

		//删除对应当前预约
		public function DeleteAppointment(){
			if(!empty($_GET['appointmentid'])){
				$this->model->D_reservation(array("appointmentid"=>$_GET['appointmentid']));
			}
			$this->Query_D_Appointment();
		}

		//注册医生信息
		public function assignDoctor(){
			$doctorModel=M('doctors');
			$doctors=$doctorModel->findWeNeed(NULL);
			self::$smarty->assign(array("doctors"=>$doctors));
			
		}

		//注册医生对应的项目
		public function assignProject(){
			$projectModel=M('project');
			$doc_pro=$projectModel->selectDocPro(array());
			$projects=$projectModel->selectPro(array());
			$json1=json_encode($doc_pro);
			$json2=json_encode($projects);
			//var_dump($projects);
			self::$smarty->assign(array("doc_pro"=>$doc_pro,"projects"=>$projects));
			self::$smarty->assign(array("json1"=>$json1,"json2"=>$json2));
		}

		//获得项目时间
		public function getProjectTime($projectid){
			$projectModel=M('project');
			$where['projectId']=$projectid;
			$temp['where']=$where;
			$project=$projectModel->getProjectTime($temp);
			$time=$project[0];
			return $time['time'];
		}

	
		//显示信息框
		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}

	}

?>