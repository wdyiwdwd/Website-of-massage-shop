 <?php
	//require('../core/DB.class.php');
	class projectModel{
		public static $db=null;
		public static function init(){
			if(is_null(self::$db)){
				self::$db=DB::getInstance();
			}
		}
		public function __construct(){
			self::$db=DB::getInstance();
		}

		private function parseParam($_param=array()){
			$where=array();
			$allParams=array();
			if(isset($_param['where'])){
				$_temp=$_param['where'];
				if(isset($_temp['projectId'])){
					$where[]="`projectid` = ".$_temp['projectId'];
				}
				if(isset($_temp['projectName'])){
					$where[]="`projectname` LIKE '%{$_temp[projectName]}%'";
				}
				if(isset($_temp['projectPrice'])){
					$where[]="`price` = ".$_temp['projectPrice'];
				}

				if(isset($_temp['leftProjectPrice'])&&isset($_temp['rightProjectPrice'])){
					$where[]="`price` between ".$_temp['leftProjectPrice']." and ".$_temp['rightProjectPrice'];
				}
				elseif(isset($_temp['rightProjectPrice'])){
					$where[]="`price` < ".$_temp['rightProjectPrice'];
				}
				elseif(isset($_temp['leftProjectPrice'])){
					$where[]="`price` > ".$_temp['leftProjectPrice'];
				}

				if(isset($_temp['lastTime'])){
					$where[]="`time` = ".$_temp['lastTime'];
				}
				if(isset($_temp['leftLastTime'])&&isset($_temp['rightLastTime'])){
					$where[]="`time` between ".$_temp['leftLastTime']." and ".$_temp['rightLastTime'];
				}
				elseif(isset($_temp['rightLastTime'])){
					$where[]="`time` < ".$_temp['rightLastTime'];
				}
				elseif(isset($_temp['leftLastTime'])){
					$where[]="`time` > ".$_temp['leftLastTime'];
				}
				if(isset($_temp['doctorId'])){
					$where[]="`doctorid` = ".$_temp['doctorId'];
				}
			}
			if(isset($_param['limit'])){
				$allParams['limit']=$_param['limit'];
			}
			if(isset($_param['group'])){
				$allParams['group']=$_param['group'];
			}
			if(isset($_param['Introduction'])){
				$allParams['Introduction']=$_param['Introduction'];
			}
			if(isset($_param['order'])){
				$allParams['order']=$_param['order'];
			}
			if(isset($_param['projectId'])){
				$allParams["projectid"]=$_param['projectId'];
			}
			if(isset($_param['projectName'])){
				$allParams['projectname']=$_param['projectName'];
			}
			if(isset($_param['projectPrice'])){
				$allParams['price']=$_param['projectPrice'];
			}
			if(isset($_param['lastTime'])){
				$allParams['time']=$_param['lastTime'];
			}
			if(isset($_param['doctorId'])){
				$allParams['doctorid']=$_param['doctorId'];
			}
			if(!empty($where)){
				$allParams['where']=$where;
			}
			return $allParams;
		}
		//以下是对 "projects"的操作
		public function registePro($_param=array()){
			if(!isset($_param['projectName'])){
				//报错 
			}//其他的无所谓
			return self::$db->add("projects",$this->parseParam($_param));//返回受影响条数
		}

		public function deletePro($_param=array()){
			if(!empty($_param)&&isset($_param['where'])){
				self::$db->delete("projects",$this->parseParam($_param)['where']);
				self::$db->delete("doctor_project",$this->parseParam($_param)['where']);
			}
			else return 0;//0行受影响
		}
		public function alterPro($_where=array(),$_newData=array()){
			if(!empty($_where)&&!empty($_newData)){
				foreach ($_where as $key => $value) {
					$_temp[]="`$key` = $value";
				}
				return self::$db->update("projects",$_temp,$this->parseParam($_newData));
			}
			else {
				echo "缺少必要参数";
			}
			
		}
		public function selectPro($_param=array()){
			if(empty($_param))
				return self::$db->select("projects",array(" * "));
			return self::$db->select("projects",array(" * "),$this->parseParam($_param));
		}

		public function getProjectTime($_param=array()){
			if(empty($_param))
				return self::$db->select("projects",array(" * "));
			return self::$db->select("projects",array(" time "),$this->parseParam($_param));
		}

		//以下是对 "doctor_project"的操作
		public function addSupportDoc($_param=array()){
			if(!empty($_param)){
				return self::$db->add("doctor_project",$this->parseParam($_param));
			}
		}
		public function delSupportDoc($_param=array()){//一定要有  "where"
			if(!empty($_param)){
				//var_dump($this->parseParam($_param)["where"]);
				return self::$db->delete("doctor_project",$this->parseParam($_param)["where"]);
			}
		}


		public function selectDocPro($_param=array()){
			if(empty($_param)){
				return self::$db->select("doctor_project",array(" * "));
			}
			else{
				return self::$db->select("doctor_project",array(" * "),$this->parseParam($_param));
			}
		}
		
	}

?>