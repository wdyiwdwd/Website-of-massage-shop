<?php
class StatisticsController{	
	private $staModel=null;
	private $docModel=null;
	private $clientModel=null;
	private $proModel=null;
	private static $smarty=null;
	private $currentPage=1;
	private $oriList=array();
	private $notesList=array();
	private $roleID;//userid
	public function __construct(){
		$this->staModel=M('Statistics');
		$this->docModel=M('doctors');
		$this->clientModel=M('clients');
		$this->proModel=M('project');
		self::$smarty=VIEW::getInstance();
		$auth=$_SESSION['auth'];
		//$this->roleID=$auth["userid"];
		$this->roleID=1;
	}
	public function parsePOST(){
		$_param=array();
		$_where=array();
		if(!empty($_POST['userid'])&&isset($_POST['userid'])){
			$_where['userId']=$_POST['userid'];
		}
		else{
			$_where['userId']=$this->roleID;
		}

		/*if(!empty($_POST['rightDate'])&&isset($_POST['rightDate'])){
			$_where['rightDate']=$_POST['rightDate'];
		}
		if(!empty($_POST['leftDate'])&&isset($_POST['leftDate'])){
			$_where['leftDate']=$_POST['leftDate'];
		}*/
		if(!empty($_POST['appointmentId'])&&isset($_POST['appointmentId'])){
			$_where['appointmentId']=$_POST['appointmentId'];
		}
		if(isset($_POST['projectId'])&&!empty($_POST['projectId'])){
			$_where["projectId"]=$_POST['projectId'];		//$result=array_intersect($result, self::$model->getNotesList(array("where"=>$where)));//取交集
		}
		if(isset($_POST['projectName'])&&!empty($_POST['projectName'])){
			$InfoGroup=$this->proModel->selectPro(array('where'=>array("projectName")));
			$IDGroup=array();//模糊查询到多个信息  
			foreach ($InfoGroup as $value) {
				$IDGroup[]=$value['projectid'];
			}
			if(!empty($IDGroup)){
				$IDString=implode(" or `clientid` = ", $IDGroup);
			}
			else return null;
			if(isset($IDString)){
				$_where["projectId"]=$IDString;
			}
		}
		
		if(isset($_POST['clientName'])&&!empty($_POST['clientName'])){
			//echo "`name` LIKE '%$_POST[clientName]%'";
			$InfoGroup=$this->clientModel->findWeNeed(array("`name` LIKE '%$_POST[clientName]%'"));
			$IDGroup=array();
			foreach ($InfoGroup as $value) {
				$IDGroup[]=$value['clientid'];
			}
			if(!empty($IDGroup)){
				$IDString=implode(" or `clientid` = ", $IDGroup);
			}
			else return null;
			if(isset($IDString)){
				$_where["clientId"]=$IDString;
			}
			//var_dump($InfoGroup);
			//var_dump($IDGroup);
			//var_dump($IDString);
			//var_dump($_where);
		}

		if(isset($_POST['doctorName'])&&!empty($_POST['doctorName'])){
			$InfoGroup=$this->docModel->findWeNeed(array("`name` LIKE '%$_POST[doctorName]%'"));
			$IDGroup=array();
			foreach ($InfoGroup as $value) {
				$IDGroup[]=$value['doctorid'];
			}
			if(!empty($IDGroup)){
				$IDString=implode(" or `doctorid` = ", $IDGroup);
			}
			else return null;
			if(isset($IDString)){
				$_where["doctorId"]=$IDString;
			}
		}

		if(isset($_POST['date'])&&!empty($_POST['date'])){
			$_where=array_merge($_where,$this->parseDate($_POST['date']));//并集
		}
		//$_where=array_merge($_where,$this->parseDate());
		$_param["where"]=$_where;
		return $_param;
	}

	public function parseDate($from){
		$_param=array();
		$_param["rightDate"]=date('Y-m-d');//今天
		switch ($from){
			case '今天':
				$_param['leftDate']=$_param['rightDate'];
				break;
			case '近一个月':
				$_param['leftDate']=date('Y-m-d' , strtotime('-1 month'));
				break;
			case '近三个月':
				$_param['leftDate']=date('Y-m-d' , strtotime('-3 month'));
				break;
			case '近一年':
				$_param['leftDate']=date('Y-m-d' , strtotime('-1 year'));
				break;
			default:
				//$_param['leftDate']=date('Y-m-d' , strtotime('-30 year'));
				break;
		}
		return $_param;
	}
/*	public function getClientInfo($userId){
		//用userName 还是 真实姓名
		return $this->clientModel->findByUserid($userId);
	}
	public function getDocInfo($userId){
		return $this->docModel->findByUserid($userId)));
	}

*/

	public function showRecentPage(){//展示个人中心首页
		//$this->getNotesAmount();//注册今天消费次数
		//$this->getNotesAmount(false);//注册总计消费次数
		//var_dump($this->getNotesList());//注册近期记录
		//$smarty->assign("currentUserID",$this->oleID);

		if(true){			//之后是对身份的判别
			$this->getClientAmount();
			$this->getDoctorAmount();
			$this->getProjectAmount();
		}
		//var_dump($this->getNotesList());
		//var_dump($this->parsePOST());
		self::$smarty->assign(array("notesList"=>$this->getNotesList()));
		self::$smarty->assign(array("notesURL"=>"index.php?controller=Statistics&method=showNoteDetails&ID="));
		self::$smarty->assign(array("notesAmount"=>$this->getNotesAmount()));
		self::$smarty->display("Statistics.tpl");
	}

	/*public function showNoteDetails(){
		self::$smarty->assign(array("detailInfo"=>$this->getNoteDetails()));
		self::$smarty->display("noteDetail.tpl");
	}*/
	public function getNotesList(){
		//var_dump($_POST);
		//var_dump($this->parsePOST());
		if(is_null($this->parsePOST())){
			$oriList=array();//空数组
		}
		else 
			$oriList= $this->staModel->getNotesList($this->parsePOST());
		//var_dump($oriList);
		foreach ($oriList as $value) {
			$temp=array();
			$temp["appointmentId"]=$value["appointmentid"];
			$temp["projectName"]=($this->proModel->selectPro(array("where"=>array("projectId"=>$value["projectid"]))))[0]["projectname"];
			//var_dump($temp["projectName"]);
			//var_dump($this->proModel->selectPro(array("where"=>array("projectId"=>$value["projectid"]))));
			$temp["clientId"]=$value["clientid"];
			$temp["clientName"]=($this->clientModel->findByUserid($value["clientid"]))[0]["name"];
			$temp["doctorId"]=$value["doctorid"];
			$temp["doctorName"]=($this->docModel->findByUserid($value["doctorid"]))[0]["name"];
			$temp["startTime"]=$value["starttime"];
			$temp["endTime"]=$value["endtime"];
			$this->notesList[]=$temp;
		}
		//var_dump($this->notesList);
		return $this->notesList;
	}

	public function getNoteDetails(){
		$where=array("appointmentId"=>$_GET['ID']);
		$where=array_merge($where,$this->parsePOST());
		$result=($this->staModel->getNotesList($where))[0];
		$details=array();
		//var_dump($result);
		$details["appointmentId"]=$result["appointmentid"];
		$details["projectName"]=($this->proModel->selectPro(array("where"=>array("projectId"=>$result["projectid"]))))[0]["projectname"];
		$details["clientName"]=($this->clientModel->findByUserid($result["clientid"]))[0]["name"];
		$details["doctorName"]=($this->docModel->findByUserid($result["doctorid"]))[0]["name"];
		$details["startTime"]=$result['starttime'];
		$details["endTime"]=$result['endtime'];
		//var_dump($details);
		return $details;
	}
	public function getNotesAmount(){
		$temp=$this->clientModel->findByUserid($this->roleID);
		$clientID=$temp['clientid'];
		return $this->staModel->getNotesAmount(array('where'=>array("clientid"=>$clientID)));
	}


	public function getClientAmount(){
		self::$smarty->assign(array("clientAmount"=>$this->staModel->getClientAmount()));
	}
	public function getDoctorAmount(){
		self::$smarty->assign(array("doctorAmount"=>$this->staModel->getDocAmount()));
	}
	public function getProjectAmount(){
		self::$smarty->assign(array("projectAmount"=>$this->staModel->getProjectsAmount()));
	}
	/*public function doctorList(){
		self::$smarty->assign(array("doctorList"=>$this->staModel->getDoctorList()));
		//self::$smarty->display("notes")//跳转到 用户管理
	}
	public function clientList(){}
	public function projectList(){
	}*/

}

?>