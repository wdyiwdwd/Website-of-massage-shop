<?php
	class clientsModel
	{
		//表名
		public $_table;

		//构造函数
		public function __construct(){
			$this->_table = 'clients';
		}

		//通过userid提取信息
		public function findByUserid($userid){
			$select=array(
				'where' => array(
					'userid='.$userid
				)
			);
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}

		//找到所有客户
		public function findWeNeed($information){
			$select=array(
				'order' => 'verified'
			);
			if(!empty($information))
				$select['where']=$information;
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}

		/*/找到所有未注册的客户
		public function findUnverified(){
			$select=array(
				'where' => array(
					'verified=0'
				)
			);
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}*/

		//返回客户信息
		public function getClientsInfo($information){
			$usersobj=M('users');
			$clisInfo=$this->findWeNeed($information);
			$finalInfo=array();
			foreach ($clisInfo as $key => $cliInfo) {
				$userInfo=$usersobj->findById($cliInfo['userid']);
				$cliInfo['username']=$userInfo[0]['username'];
				$cliInfo['role']=$userInfo[0]['role'];
				$cliInfo['lasttime']=$userInfo[0]['lasttime'];
				$finalInfo[]=$cliInfo;
			}
			return $finalInfo;
		}

		//加入新的客户
		public function addDoctor(Array $information){
			return DB::getInstance()->add($this->_table,$information);
		}

		//删除已有客户通过userid
		public function delByUserid($userid){
			$where=array(
				"userid=".$userid
			);
			return DB::getInstance()->delete($this->_table,$where);
		}

		//更新客户信息
		public function updateByUserid($userid,$data){
			$where=array('userid='.$userid);
			return DB::getInstance()->update($this->_table,$where,$data);
		}
		
	}
?>