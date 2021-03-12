<?php
	
	class usersModel
	{
		//表名
		public $_table;

		//构造函数
		public function __construct(){
			$this->_table = 'users';
		}

		//通过用户名提取信息
		public function findByUsername($username){
			$select=array(
				'where' => array(
					'username='.'"'.$username.'"'
				)
			);
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}

		//通过id提取用户信息
		public function findById($id){
			$select=array(
				'where' => array(
					'userid='.$id
 				)
			);
			$field=array('*');
			return DB::getInstance()->select($this->_table,$field,$select);
		}


		//根据用户名返回他的角色
		public function roleOfUserid($userid){
			$userInfo=$this->findById($userid);
			return $userInfo[0]['role'];
		}

		//加入新的用户
		public function addUser(Array $information){
			return DB::getInstance()->add($this->_table,$information);
		}

		//删除已有用户
		public function delUserById($id){
			$where=array(
				"userid=".$id
			);
			return DB::getInstance()->delete($this->_table,$where);
		}

		//更新用户信息
		public function updateUser($where,$data){
			return DB::getInstance()->update($this->_table,$where,$data);
		}

		//核对用户名密码
		public function checkAuth($username,$password){
			$auth=$this->findByUsername($username);
			//var_dump($auth);
			$auth=$auth[0];
			if(!empty($auth) && $auth['password']==$password){
				return $auth;
			}
			else{
				return false;
			}
		}
	}
?>
