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
	$id = addslashes($_POST['id']);
	if(isset($_POST['alias_vn'])){
		$col = "alias_vn";
		$val = addslashes($_POST['alias_vn']);
	}else{
		$col = "alias_us";
		$val = addslashes($_POST['alias_us']);
	}


	$sql = "select id from ".$bang." where ".$col." = '".trim($val,"-")."' and id <> '$id'";
	$result = $d->o_fet($sql);
	if(count($result) == 0){
		echo trim($val,"-");
	} 
	else{
		if($id == ''){
			$r_c = $d->o_fet("select MAX(id) from ".$bang);	
			echo trim($val,"-").'-'.($r_c[0]['MAX(id)'] + 1);
		}
		else{
			echo trim($val,"-").'-'.$id;
		}
	} 

	// echo count($result);
?>