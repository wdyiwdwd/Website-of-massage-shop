
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
			$message=array();
			
			$message['doctorid']=isset($_GET['doctorid'])?$_GET['doctorid']:-1;//-1 只是一个一定查询无结果的id

			$message=$this->model->praseTime($message);
			$message['order']=' `starttime`';
			$this->assignDoctor();
			$this->assignProject();
			$datas=$this->model->query($message);
			//var_dump($datas);
			//注册当前时间
			date_default_timezone_set('Asia/Shanghai');
			$currentTime= date('H:i',time());
			$statisticsObj=M('Statistics');
			self::$smarty->assign(array('unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid'])));
			self::$smarty->assign(array("currentTime"=>$currentTime));

			self::$smarty->assign(array("querydatas"=>$datas));
			self::$smarty->assign(array("selectedDoctor"=>isset($_GET['doctorid'])?$_GET['doctorid']:-1));
			$afterParse=$this->parseAppointment($datas);
			self::$smarty->assign(array("todayAppointments"=>$afterParse['today']));
			/*var_dump($this->parseAppointment($datas)['today']);
			echo "</br>";
			echo "</br>";
			var_dump((date_diff(date_create("2013-02-15"),date_create("2013-02-16")))->format('%a')) ;
			echo "</br>";
			echo "</br>";*/

			self::$smarty->assign(array("tomorrowAppointments"=>$afterParse['tomorrow']));
			//var_dump($this->parseAppointment($datas)['tomorrow']);
			self::$smarty->assign(array("afterTomorrowAppointments"=>$afterParse['afterTomorrow']));
			self::$smarty->assign(array("appointmentAmount"=>isset($_GET['doctorid'])?$afterParse['appointmentAmount']:-1));
			//self::$smarty->assign(array("json_appointments"=>json_encode($this->parseAppointment($datas))));
			self::$smarty->assign(array("whichPage"=>'appointmentsInfo'));
			//$this->showmessage(null,"index.php?controller=appointment&method=QueryAppointment#doctorSelect");
			self::$smarty->display("appointmentView.tpl");
		}
		function parseAppointment($datas){//appointments表的二维数组
			$recent=array();//近三天的预约数组
			$today=array();
			$tomorrow=array();
			$afterTomorrow=array();
			$proObj=M('project');
			$todayDate=date_create(date("Y-m-d"));
			$appAmount=0;//有效的预约数量
			foreach ($datas as $single) {
				//var_dump($single);
				
				$each=array();
				$date=date_create(date("Y-m-d",strtotime($single['starttime'])));
				$diff=1;
				//$diff=(date_diff($todayDate,$date))->format('%a');//后者减前者
//				echo date("Y-m-d",strtotime($single['starttime']));
				$temp=$proObj->selectPro(array("where"=>array("projectId"=>$single['projectid'])));
				$theProject=$temp[0];
				//var_dump($proObj->selectPro(array("where"=>array("projectid"=>$single['projectid'])))[0]);
				//echo "</br>";
				//echo "</br>";
				$each['proName']=$theProject['projectname'];
				$each['startTime']=date("H:i",strtotime($single['starttime']));
				$each['endTime']=date("H:i",strtotime($single['endtime']));
				$each['time']=$theProject['time'];
				$each['doctorId']=$single['doctorid'];
				switch ($diff) {
					case "0":
						$today[]=$each;
						$appAmount++;
						break;
					case "1":
						$tomorrow[]=$each;
						$appAmount++;
						break;
					case "2":
						$afterTomorrow[]=$each;
						$appAmount++;
						break;
					default:
					echo "$diff ,";
						break;
				}
			}
			if(!empty($today)||!empty($tomorrow)||!empty($afterTomorrow)){
				$recent['today']=$today;
				$recent['tomorrow']=$tomorrow;
				$recent['afterTomorrow']=$afterTomorrow;
			}
			$recent['appointmentAmount']=$appAmount;
			//echo "<script>alert($today[0])</script>";
			return $recent;
		}

		//预约
		public function Appointment(){
			
			if(!empty($_POST["theProjectid"])&&!empty($_POST["theDoctorid"])&&!empty($_POST["theStarttime"])&&!empty($_POST["theDate"]) ){
				$projectid=$_POST["theProjectid"];
				$doctorid=$_POST["theDoctorid"];
				$starttime=$_POST["theStarttime"];
				$date=$_POST["theDate"];
				//var_dump($_POST);
				
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
					$this->showmessage('时间填写错误','index.php?controller=appointment&method=QueryAppointment');
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

		/*public function onchangeProject(){
			$this->assignProject();
			$this->showmessage(null,'index.php?controller=appointment&method=QueryAppointment#theDoctorid');
		}*/
		//注册医生对应的项目
		public function assignProject(){
			$projectModel=M('project');
			$doctorModel=M('doctors');
			$projects=$projectModel->selectPro(array());
			
			$doc_pro=$projectModel->selectDocPro(array());

			$docPro=array();
			foreach ($doc_pro as $single) {
				$pro=array();
				$pro['projectId']=$single['projectid'];
				$pro['doctorId']=$single['doctorid'];
				$pro['projectName']=$projectModel->selectPro(array("where"=>array("projectId"=>$single['projectid'])))[0]['projectname'];
				$docPro[]=$pro;
			}
			self::$smarty->assign(array("doc_pro"=>$docPro,"projects"=>$projects));
			self::$smarty->assign(array("json_doc_pro"=>json_encode($docPro)));
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
			if(is_null($info))
				echo "<script>window.location.href='$url'</script>";
			else
				echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}

	}

?>