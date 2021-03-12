<?php
	//require_once('../../config/config.php');

	class testController
	{
		public function show(){
			//var_dump(DB::getInstance());
			echo "我能跑啦我能跑啦！！！！";
			$arr=array(
				'heiheihei'=>'sghdfakjs'
			);
			VIEW::getInstance()->assign($arr);
			VIEW::getInstance()->display('test.html');
		}
	}
?>