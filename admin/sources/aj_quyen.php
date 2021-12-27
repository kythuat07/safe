<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$va = addslashes($_POST['va']);
	$id= addslashes($_POST['id']);
	
	if($d->o_que("update #_user set quyen_han = ".$va." where id = '".$id."'")){
		echo 1;
	}else echo 0;

?>