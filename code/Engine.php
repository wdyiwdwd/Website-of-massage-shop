<?php
	//需要的路径
	$paths=array(
		"function/function.php",
		"config/config.php",
		"libs/core/DB.class.php",
		"libs/core/VIEW.class.php",
		"libs/ORG/smarty/Smarty.class.php"
	);
	//这个引擎的绝对路径
	$currentdir = dirname(__FILE__);
	//循环包含文件
	foreach ($paths as $path) {
		require_once($currentdir.'/'.$path);
	}

	class Engine{
		public static $controller;
		public static $method;
		//两个配置文件
		public static $dbconfig;
		public static $viewconfig;

		//初始化DB操作类
		private static function init_db(){
			DB::init(self::$dbconfig);
		}

		//初始化VIEW操作类
		private static function init_view(){
			VIEW::init(self::$viewconfig);
		}


		//初始化控制器
		private static function init_controller(){
			//index是主页的意思
			self::$controller = isset($_GET['controller'])?daddslashes($_GET['controller']):'index';

		}


		//初始化控制器方法
		private static function init_method(){
			//
			self::$method = isset($_GET['method'])?daddslashes($_GET['method']):'index';
		}

		//运行引擎
		public static function run($dbconfig,$viewconfig){
			self::$dbconfig = $dbconfig;
			self::$viewconfig = $viewconfig;
			self::init_db();
			self::init_view();
			self::init_controller();
			self::init_method();
			//运行Controller
			C(self::$controller,self::$method);
		}

	}
	
?>