<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$trangthai = addslashes($_POST['trangthai']);
	$bang= addslashes($_POST['bang']);
	$cot= addslashes($_POST['cot']);
	$id= addslashes($_POST['id']);
	
	$d->o_que("update ".$bang." set ".$cot." = ".$trangthai." where id = ".$id);

?>