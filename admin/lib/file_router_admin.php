<?php
	$p = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
	if($p == ''){
		$source = "";
		$template = "index";
	}else if($p=='out'){
		session_destroy();
		$d->redirect("login.php");
	}
	else{
		$source = $p;
	}
	if(!empty($p) && $d->checkUserPermission($_SESSION['id_user'],$p) <= 0 && $_SESSION['is_admin'] != 1 ){
		$d->redirect("index.php");
	}
	if($source!="") @include "sources/".$source.".php";
?>