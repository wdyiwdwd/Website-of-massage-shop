<?php

	class AppointmentModel{
		private static $db;
		public function __construct(){
			if(is_null(self::$db)){
				self::$db=DB::getInstance();
			}
		}

		public function query($param=array()){    //*******查询*******
			
			$where=array();
			$where['order']="starttime DESC";
			if(empty($param)){
				return self::$db->select("appointments",array('*'),$where);
			}
			else{
				$where['where']=$this->parseParams($param);
				return self::$db->select("appointments",array('*'),$where);
			}
		}

		//解析时间
		public function praseTime($param){
			date_default_timezone_set('Asia/Shanghai');
			$currentDate= date('Y/m/d',time());
			$currentDate=date_create($currentDate);

			$message=array();
			if(!empty($param["projectid"]))
				$message['projectid']=$param['projectid'];
			if(!empty($param["doctorid"]))	
				$message['doctorid']=$param["doctorid"];
			if(!empty($param['date'])){
				$day=$param['date'];
				if($day==1)
					date_add($currentDate,date_interval_create_from_date_string("1 days"));
				if($day==2)
					date_add($currentDate,date_interval_create_from_date_string("2 days"));
				if($day==3)
					date_add($currentDate,date_interval_create_from_date_string("3 days"));
				if($day!=0){
					$message['date']=date_format($currentDate,"Y/m/d");

					date_sub($currentDate,date_interval_create_from_date_string("1 days"));
					$message['lastdate']=date_format($currentDate,"Y/m/d");
					$currentDate=date_format($currentDate,"Y/m/d");
					//if starttime/endtime not null
					if(!empty($param["starttime"])){
						$message['starttime']=$currentDate." ".$param['starttime'];

					}
					if(!empty($param["endtime"])){
						$message['endtime']=$currentDate." ".$param['endtime'];
					}
				}
				
			}
			else{
				if(!empty($param["starttime"])){
					$message['starttime']=date_format($currentDate,"Y/m/d")." ".$param["starttime"];
				}
					
				if(!empty($param["endtime"])){
					//date_add($currentDate,date_interval_create_from_date_string("2 days"));
					$message['endtime']=date_format($currentDate,"Y/m/d")." ".$param["endtime"];
				}
			}
			return $message;
		}

		//判断预约时间是否过期
		public function overdue($param){
			$currentTime=date('Y/m/d H:i:s',time());
			if($param['starttime']<$currentTime)
				return true;//过期
			else
				return false;
		}

		//判断预约时间是否在工作时间
		public function not_work_time($param){
			$early=date_create("06:00:00");
			$early=date_format($early,"H:i:s");
			$late=date_create("22:00:00");
			$late=date_format($late,"H:i:s");
			$starttime=date_format(date_create($param['starttime']),"H:i:s");
			$endtime=date_format(date_create($param['endtime']),"H:i:s");
			
			if(($endtime<$early)||($starttime<$early)||($starttime>$late)||($endtime>$late))
			{
				return true;
			}
			else
				return false;
		}


		//判断时间冲突
		public function isConflict($param=array()){
			$where1=array();	$where2=array();	$where3=array();	$where4=array();
			$where5=array();	$where6=array();	$where7=array();	
			if(isset($param['starttime'])&&isset($param['endtime'])){
				//冲突的情况
				// 1、起始时间不冲突，结束时间冲突
				$temp="unix_timestamp(starttime) > unix_timestamp('".$param[starttime]."') AND unix_timestamp(starttime) < unix_timestamp('".$param[endtime]."')";
				$where1['where']=array($temp);
				$temp="unix_timestamp(starttime) > unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) = unix_timestamp('".$param[endtime]."')";
				$where2['where']=array($temp);
				$temp="unix_timestamp(starttime) > unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) < unix_timestamp('".$param[endtime]."')";
				$where3['where']=array($temp);
				//起始时间重合
				$temp="unix_timestamp(starttime) = unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) > unix_timestamp('".$param[endtime]."')";
				$where4['where']=array($temp);
				$temp="unix_timestamp(starttime) = unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) = unix_timestamp('".$param[endtime]."')";
				$where5['where']=array($temp);
				$temp="unix_timestamp(starttime) = unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) < unix_timestamp('".$param[endtime]."')";
				$where6['where']=array($temp);
				//起始时间冲突
				$temp="unix_timestamp(starttime) < unix_timestamp('".$param[starttime]."') AND unix_timestamp(endtime) > unix_timestamp('".$param[starttime]."')";
				$where7['where']=array($temp);

				if(empty(self::$db->select("appointments",array("*"),$where1))&&empty(self::$db->select("appointments",array("*"),$where2))
					&&empty(self::$db->select("appointments",array("*"),$where3))&&empty(self::$db->select("appointments",array("*"),$where4)) 
					&&empty(self::$db->select("appointments",array("*"),$where5))&&empty(self::$db->select("appointments",array("*"),$where6))
					&&empty(self::$db->select("appointments",array("*"),$where7))	)

					return false;
				else
					return true;
			}
		}

		//向表中添加数据
		public function addAppointment($_param=array()){
			if(!empty($_param)){
				self::$db->add("appointments",$_param);
			}
		}

		//取消预约
		public function D_reservation($param=array()){
			$where=array();
			$where['where']=$this->parseParams($param);

			self::$db->delete("appointments",$this->parseParams($param));
		}

		//解析参数，将where变为数组
		public function parseParams($_param=array()){
			$where=array();
			//$params=array();
			if(empty($_param)){return $where;}

			if(isset($_param["clientid"])){				//客户id
				$where[] ="`clientid` =" .$_param['clientid'];
			}
			if(isset($_param["projectid"])){			//项目id
				$where[] ="`projectid` =" .$_param['projectid'];
			}
			if(isset($_param['doctorid'])){				//医生id
				$where[] ="`doctorid` =". $_param['doctorid'];
			}
			if(isset($_param['appointmentid'])){				
				$where[] = "`appointmentid` = ".$_param['appointmentid'];
			}
			if(isset($_param['date'])){				
				$where[] = "unix_timestamp(starttime) <= unix_timestamp('".$_param['date']."') AND 
							unix_timestamp(starttime) >= unix_timestamp('".$_param['lastdate']."')";

			}
			if(isset($_param['starttime'])){				
				$where[] = "unix_timestamp(starttime) >= unix_timestamp('".$_param['starttime']."')";
			}
			if(isset($_param['endtime'])){			
				$where[] ="unix_timestamp(endtime) <= unix_timestamp('".$_param['endtime']."')";
			}
			return $where;
		}


	}

?>