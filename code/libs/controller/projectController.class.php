<?php
class projectController{
	private $proModel=null;
	private $staModel=null;
	private static $smarty=null;
	private $currentPage;
	public function __construct(){
		$this->currentPage=1;
		$this->proModel=M('project');//用做成单例类吗
		$this->proModel->init();
		$this->staModel=M('Statistics');
		self::$smarty=VIEW::getInstance();

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
		self::$smarty->assign(array("auth"=>$_SESSION['auth']));
	}
	private function showmessage($info,$url){
		if(is_null($info)){
			echo "<script>window.location.href='$url'</script>";
		}
		else
			echo "<script>alert('$info');window.location.href='$url'</script>";
		exit;
	}
	private function parsePOST(){
		//var_dump($_POST);
		$_param=array();//没the的POST键
		$_where=array();//带the的POST键
		if(isset($_POST['theProjectId'])&&$_POST['theProjectId']!=''){
			$_where['projectId']=$_POST['theProjectId'];
		}
		if(isset($_POST['theProjectName'])&&$_POST['theProjectName']!=''){
			$_where['projectName']=$_POST['theProjectName'];
		}
		if(isset($_POST['leftProjectPrice'])&&$_POST['leftProjectPrice']!=''){
			$_where['leftProjectPrice']=$_POST['leftProjectPrice'];
		}
		if(isset($_POST['rightProjectPrice'])&&$_POST['rightProjectPrice']!=''){
			$_where['rightProjectPrice']=$_POST['rightProjectPrice'];
		}
		if(isset($_POST['leftLastTime'])&&$_POST['leftLastTime']!=''){
			$_where['leftLastTime']=$_POST['leftLastTime'];
		}
		if(isset($_POST['rightLastTime'])&&$_POST['rightLastTime']!=''){
			$_where['rightLastTime']=$_POST['rightLastTime'];
		}
		if(isset($_POST['order'])&&$_POST['order']!=''){
			$_param['order']=$_POST['order'];
		}
		if(isset($_POST["newProjectName"])&&$_POST['newProjectName']!=''){
			echo "hrllo";
			$_param["projectName"]=$_POST["newProjectName"];
		}
		if(isset($_POST["newProjectPrice"])&&$_POST['newProjectPrice']!=''){
			$_param["projectPrice"]=$_POST["newProjectPrice"];
		}
		if(isset($_POST["newLastTime"])&&$_POST['newLastTime']!=''){
			$_param["lastTime"]=$_POST["newLastTime"];
		}
		if(isset($_POST["newIntroduction"])&&$_POST['newIntroduction']!=''){
			$_param["Introduction"]=$_POST["newIntroduction"];
		}
		$_param["where"]=$_where;
		//var_dump($_POST);
		//var_dump($_param);
		return $_param;

	}
	private function display(){
		self::$smarty->display("proManagement.tpl");
	}
	public function showProjects(){
		$this->getProjects();
		$this->display();
	}
	
	public function addProject(){
		$Info=$this->parsePOST();
		//var_dump($Info);
		if(!isset($Info["projectName"])){
			$this->showmessage("缺少必要参数,添加项目失败",'index.php?controller=project&method=showProjects');
		}else{
			self::$smarty->assign(array("affectedRows"=>$this->proModel->registePro($Info)));
			//$this->display();
			$this->showmessage(null,'index.php?controller=project&method=showProjects');
		}		
	}
	public function delProject(){
		//仅支持通过这两种删除
		if(!empty($temp=$this->proModel->selectPro($_GET['ID']))){
			self::$smarty->assign(array("affectedRows"=>$this->proModel->deletePro(array("where"=>array("projectId"=>$_GET['ID'])))));
			$this->showmessage(null,'index.php?controller=project&method=showProjects');
			//$this->display();
		}

	}

	public function getProjects(){//看来还得来个parsePost()
		//var_dump($this->proModel->selectPro($this->parsePOST()));
		//var_dump($this->model->selectPro($this->parsePOST()));
		$proAmount=$this->staModel->getProjectsAmount();
		$statisticsObj=M('Statistics');
		self::$smarty->assign(array('unfinished' => $statisticsObj->getUnfinishedAppointments($_SESSION['auth']['userid'])));
		self::$smarty->assign(array("proAmount"=>$proAmount));
		self::$smarty->assign(array("whichPage"=>'projectsInfo'));
		//$finalParam=array_merge($this->parsePOST(),array("limit"=>"$head,$once"));//每次显示十条
		self::$smarty->assign(array("proList"=>$this->proModel->selectPro($this->parsePOST())));
		self::$smarty->assign(array("proURL"=>"index.php?controller=project&method=jumpTo&detail=edit&ID="));
		//$this->display();
		//echo "in procts()";
	}

	public function alterProject(){//先不支持修改支持技师
		$_param=array();
		$_where=array();
		//var_dump($_POST);
		if(!isset($_POST['projectId'])){
			echo "缺少必要参数";
			return;
			//想办法停止啊得...并且还得让前台知道错了
		}
		else{
			$_where["projectId"]=$_POST['projectId'];
		}

		if(isset($_POST['projectName'])){
			$_param['projectName']=$_POST['projectName'];
		}
		if(isset($_POST['projectPrice'])){						//要判断输入参数类型
			$_param['projectPrice']=$_POST['projectPrice'];
		}
		if(isset($_POST['lastTime'])){
			$_param['lastTime']=$_POST['lastTime'];
		}
		if(isset($_POST['Introduction'])){
			$_param['Introduction']=$_POST['Introduction'];
		}
		if(empty($this->proModel->selectPro(array("where"=>array("projectId"=>$_POST['theProjectId']))))){
			//不存在这条记录时 直接变为add
			//echo "该项目不存在，将自动添加入数据库";
			self::$smarty->assign(array("affectedRows"=>$this->proModel->registePro($_param)));
		}
		else{
			self::$smarty->assign(array("affectedRows"=>$this->proModel->alterPro($_where,$_param)));
		}
		$this->showmessage(null,'index.php?controller=project&method=showProjects');
		//$this->display();
	}

}

?>