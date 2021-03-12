<?php	
	class StatisticsModel{
		private static $db=null;//数据库操作类对象
		//private $currentUser;
		//private $theProject;
		//private $theDate;
		public function __construct(){
			self::$db=DB::getInstance();//获取单例类
		}
		

		public function parseParams($_param=array()){//只解析where字段。。 和project的不太一样
			//统一对所有可能出现的参数进行解析  上面是独立参数解析 下面是范围参数解析
			$where=array();//重置where参数数组;
			$param=array();
			//$params=array();
			if(empty($_param)){return $where;}

			if(isset($_param['order'])){
				$param['order']=$_param['order'];
			}
			if(isset($_param['limit'])){
				$param['limit']=$_param['limit'];
			}
		if(isset($_param['where'])){
			$temp=$_param['where'];
			//var_dump($_param);
			if(isset($temp['gender']))				//性别
				$where[]="`gender` = '$temp[gender]'";

			if(isset($temp['appointmentId']))			//唯一订单号
				$where[]="`appointmentid` = $temp[appointmentId]";
			

			if(isset($temp['age']))					//年龄 
				$where[]="`age` = {$temp['age']}";

			if(isset($temp['regYear']))				//注册年
				$where[]="year(`regtime`) = {$_regYear}";
			if(isset($temp['regMonth']))				//注册月
				$where[]="month(`regtime`) = {$_regMonth}";
			if(isset($temp['regDay']))				//注册日
				$where[]="day(`regtime`) = {$_regDay}";

			if(isset($temp["rank"])){					//等级 医生职位等级 （将来可能支持客户等级 大会员小会员..）
				$where[]="`rank` LIKE '%{$temp[rank]}%'";
			}

			if(isset($temp['proPrice'])){				//项目价格
				$where[]="`price` = {$temp['proPrice']}";
			}

			if(isset($temp["clientId"])){				//客户id
				$where[]="`clientid` = {$temp['clientId']}";
			}
			if(isset($temp["projectId"])){			//项目id
				$where[]="`projectid` = {$temp['projectId']}";
			}
			/*if(isset($temp["userId"])){			//项目id
				$where[]="`userid` = {$temp['userId']}";
			}*/
			if(isset($temp['doctorId'])){				//医生id
				$where[]="`doctorid` = {$temp['doctorId']}";
			}
			if(isset($temp['proyear'])){				//预约项目年
				$where[]="year(`starttime`) = {$temp['year']}";
			}
			if(isset($temp['promonth'])){				//预约项目月
				$where[]="month(`starttime`) = {$temp['month']}";
			}
			if(isset($temp['proday'])){				//预约项目日
				$where[]="day(`starttime`) = {$temp['day']}";
			}
							//范围解析

			if(isset($temp['left_age'])&&isset($temp['right_age'])){			//年龄范围
				$_age="`age` between {$temp['left_age']} AND {$temp['right_age']}";
				$where[]=$_age;
			}
			elseif(isset($temp['left_age'])){
				$_age="`age` > {$temp['left_age']}";
				$where[]=$_age;
			}
			elseif(isset($temp['left_age'])){
				$_age="`age` < {$temp['right_age']}";
				$where[]=$_age;
			}


			if(isset($temp['leftPrice'])&&isset($temp['rightPrice'])){			//价格范围
				$where[]="`price` BETWEEN {$temp['leftPrice']} AND {$temp['rightPrice']}";
			}
			elseif(isset($temp['leftPrice'])){
				$where[]="`price` > {$temp['leftPrice']}";
			}
			elseif(isset($temp['rightPrice'])){
				$where[]="`price` < {$temp['rightPrice']}";
			}

			if(isset($temp['leftTime'])&&isset($temp['rightTime'])){			//项目时长范围
				$_lastTime="`time` BETWEEN {$temp['leftTime']} AND {$temp['rightTime']}";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['leftTime'])){
				$_lastTime="`time` > {$temp['leftTime']}";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['rightTime'])){
				$_lastTime="`time` < {$temp['rightTime']}";
				$where[]=$_lastTime;
			}

			if(isset($temp['leftDate'])&&isset($temp['rightDate'])){			//预约日期范围 不含具体时间
				$_lastTime="date(`starttime`) BETWEEN '{$temp[leftDate]}' AND '{$temp[rightDate]}'";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['leftDate'])){
				$_lastTime="date(`starttime`) > '{$temp[leftDate]}'";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['rightDate'])){
				$_lastTime="date(`starttime`) < '{$temp[rightDate]}'";
				$where[]=$_lastTime;
			}

			if(isset($temp['leftStartTime'])&&isset($temp['rightStartTime'])){			//预约时间范围
				$left=date('Y-m-d H:i:s',$temp['leftStartTime']);
				$right=date('Y-m-d H:i:s',$temp['rightStartTime']);
				$_lastTime="`starttime` BETWEEN {$left} AND {$right}";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['leftStartTime'])){
				$left=date('Y-m-d H:i:s',$temp['leftStartTime']);
				$_lastTime="`starttime` > {$left}";
				$where[]=$_lastTime;
			}
			elseif(isset($temp['rightStartTime'])){
				$right=date('Y-m-d H:i:s',$temp['rightStartTime']);
				$_lastTime="`starttime` < {$right}";
				$where[]=$_lastTime;
			}
			if(!empty($where))
				$param['where']=$where;
			}
			return $param;
		}


		public function getClientAmount($_param=array()){//注册客户数  具体某天的顾客数从getNotesAmount查找
			$param=$this->parseParams($_param);
			if(empty($param['where'])){
				return self::$db->total("clients");
			}
			return self::$db->total("clients",$param);
		}
		public function getDocAmount($_param=array()){//注册医师数
			$param=$this->parseParams($_param);
			if(empty($param['where'])){
				return self::$db->total("doctors");
			}
			return self::$db->total("doctors",$param);
		}
		public function getProjectsAmount($_param=array()){//注册项目数
			$param=$this->parseParams($_param);
			if(empty($param['where'])){
				return self::$db->total("projects");
			}
			return self::$db->total("projects",$param);
		}
		public function getNotesAmount($_param=array()){//可根据 客户 医师 项目 预约日期综合查找指定记录总数 与下面的独立查找不同
			$param=$this->parseParams($_param);
			if(empty($param['where'])){
				return self::$db->total("appointments");
			}
			return self::$db->total("appointments",$param);
		}

		//以下是单信息查找 (参数形式简单)
		public function getNotesAmountByPro($projectId){
			return self::$db->total("appointments",array("where"=>array("`projectid` = {$projectId}")));
		}
		public function getNotesAmountByDoc($doctorId){
			return self::$db->total("appointments",array("where"=>array("`doctorid` = {$doctorId}")));
		}
		public function getNotesAmountByClient($clientId){
			return self::$db->total("appointments",array("where"=>array("`clientid` = {$clientId}")));
		}
		public function getNotesAmountByYear($date){
			return self::$db->total("appointments",array("where"=>array("year(`appointmentStartTime`) = {$date}")));
		}
		public function getNotesAmountByMonth($date){
			return self::$db->total("appointments",array("where"=>array("month(`appointmentStartTime`) = {$date}")));
		}
		public function getNotesAmountByDay($date){
			return self::$db->total("appointments",array("where"=>array("day(`appointmentStartTime`) = {$date}")));
		}

		//列出预约： 项目 医师 客户 的列表(而不是之前的总数)
		public function getNotesList($_param=array()){//$groupby=''可以得到某个客户的消费次数 某个医师的工作次数 某个项目的预约次数
			$param=array();//比where多了groupby 或limit
			$param=$this->parseParams($_param);
			//var_dump($param);
			return empty($param)?self::$db->select("appointments",array("*")):self::$db->select("appointments",array("*"),$param);
			//return self::$db->select("appointments",array("*"),$params);//还能不能用原来的字段了?
		}
		public function getClientsList($orderby=null){
			is_null($orderby)?self::$db->select("clients",array(" * ")):self::$db->select("clients",array(" * "),array("order"=>"{$orderby}"));
		}
		public function getDoctorsList($orderby=null){//怎么用rank排序？
			is_null($orderby)?self::$db->select("doctors",array(" * ")):self::$db->select("doctors",array(" * "),array("order"=>"{$orderby}"));
		}
		public function getProjectsList($orderby=null){
			is_null($orderby)?self::$db->select("projects",array(" * ")):self::$db->select("doctors",array(" * "),array("order"=>"{$orderby}"));
		}

		public function getUnfinishedAppointments($userid){
			$clientsObj=M('clients');
			if(!empty($userid)){
				$param=array(
					'where' => array(
						'clientid='.$userid,
						'unix_timestamp(starttime) >'.time()
					)
				);
				return self::$db->total('appointments',$param);
			}
			else return null;
		}
	}
?>