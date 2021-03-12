<?php
	class doctorsModel
	{
		//表名
		public $_table;

		//构造函数
		public function __construct(){
			$this->_table = 'doctors';
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

		//找到所有医生
		public function findWeNeed($information){
			$select=array(
				'order' => 'verified'
			);
			if(!empty($information))
				$select['where']=$information;
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}

		/*/找到所有未注册的医生
		public function findUnverified(){
			$select=array(
				'where' => array(
					'verified=0'
				)
			);
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}*/

		//返回全部的医生和管理员信息
		public function getDoctorsInfo($information){
			$usersobj=M('users');
			$docsInfo=$this->findWeNeed($information);
			$finalInfo=array();
			foreach ($docsInfo as $key => $docInfo) {
				$userInfo=$usersobj->findById($docInfo['userid']);
				$docInfo['username']=$userInfo[0]['username'];
				$docInfo['role']=$userInfo[0]['role'];
				$docInfo['lasttime']=$userInfo[0]['lasttime'];
				$docInfo['projects']=$this->getProInfoByUserid($docInfo['userid']);
				$finalInfo[]=$docInfo;
			}
			//var_dump($userInfo);
			return $finalInfo;
		}

		//加入新的医生
		public function addDoctor(Array $information){
			return DB::getInstance()->add($this->_table,$information);
		}

		//删除已有医生通过userid
		public function delByUserid($userid){
			$where=array(
				"userid=".$userid
			);
			return DB::getInstance()->delete($this->_table,$where);
		}

		//更新医生信息
		public function updateByUserid($userid,$data){
			$where=array('userid='.$userid);
			return DB::getInstance()->update($this->_table,$where,$data);
		}

				//根据userid得到这个医生的全部项目信息
		public function getProInfoByUserid($userid){
			$prosInfo=array();
			$doctorInfo=$this->findByUserid($userid);
			$proObj=M('project');
			$select1=array(
				'where' => array(
					'doctorId' => $doctorInfo[0]['doctorid']
				)
			);
			$projects=$proObj->selectDocPro($select1);
			foreach ($projects as $project) {
				$select2=array(
					'where' => array(
						'projectId' => $project['projectid']
					)
				);
				$proInfo=$proObj->selectPro($select2);
				$prosInfo[]=$proInfo[0];
			}
			return $prosInfo;
		}
		
	}
?>