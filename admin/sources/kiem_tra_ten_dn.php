<?php
	if(!isset($_SESSION)){
		session_start();
	}

	@define('_template','../templates/');
	@define('_source','../sources/');
	@define('_lib','../lib/');

	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);


	$bang = addslashes($_POST['bang']);
	$ten_vn = addslashes($_POST['ten_vn']);

	$sql = "select id from ".$bang." where ten_vn = '".trim($ten_vn," ")."'";
	if(count($d->o_fet($sql)) == 0) echo 1;
	else echo 0;
?>