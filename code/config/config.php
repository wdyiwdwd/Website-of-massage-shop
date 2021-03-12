<?php
	/*
		config.php
		配置文件
	*/

	//smarty配置数组
	$viewConfig=array(
		"left_delimiter" => "{",
		"right_delimiter" => "}",
		"template_dir" => "tpl",
		"compile_dir" => "template_c",
		"cache_dir" => "cache"
	);

	//DB配置数组
	$DBConfig=array(
		"dbhost" => "localhost",
		"dbuser" => "root",
		"dbpassword" => "",
		"dbname" => "hospital",
		"dbcharset" => "UTF8" 
	);
?>