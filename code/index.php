<?php
	header("Content-type:text/html; charset=utf-8");
	session_start();
	require_once('config/config.php');
	require_once('Engine.php');
	//var_dump($DBConfig);
	Engine::run($DBConfig,$viewConfig);
?>