<?php
	/* for test */
	//phpinfo();
	require_once('../libs/core/DB.class.php');
	require_once('../config/config.php');
	$arr = array(
		"username" => "chenqixiang",
	);
	DB::init($DBConfig);
	DB::getInstance()->add("users" , $arr);

?>