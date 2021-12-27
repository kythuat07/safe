<?php
	if(!isset($_SESSION)){
		session_start();
	} 
	error_reporting(0);
	include @"../lib/config.php";
	include_once @"../lib/function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	$title = addslashes($_POST['title']);
	$stt = addslashes($_POST['stt']);

	if($d->o_que("update #_sanpham_hinhanh set title='".$title."',stt='".$stt."' where id = '".$id."'")){
		echo 1;
	}
	
?>
