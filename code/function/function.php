<?php
	//function Model
	function M($name){
		require_once('libs/Model/'.$name.'Model.class.php');
		eval('$obj=new '.$name.'Model();');
		return $obj;
	}

	//function View
	function V($name){
		require_once('libs/View/'.$name.'View.class.php');
		eval('$obj=new '.$name.'View();');
		return $obj;
	}

	//function Controller
	function C($name, $method){
		require_once('libs/Controller/'.$name.'Controller.class.php');
		eval('$obj=new '.$name.'Controller(); $obj->'.$method.'();');
	}

	//function ORG
	function ORG($path, $name, $params=array()){
		/*
			$path->路径
			$name->第三方类名
			$params->配置属性和信息（字典）
		*/
		//var_dump($params);
		require_once('libs/ORG/'.$path.$name.'.class.php');
		eval('$obj=new '.$name.'();');
		if(!empty($params)){
			foreach ($params as $key => $value) {
				$obj->$key=$value;
				//eval('$obj->'.$key.'=$value;');
			}
			//var_dump($obj);
			return $obj;
		}
	}

	//去掉非法字符串的函数
	function daddslashes($str){
		return (!get_magic_quotes_gpc())?addslashes($str):$str;
	}
?>