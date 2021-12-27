<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	default:
		$template = "index";
}
function showdulieu(){
	global $d, $item;
	if(isset($_REQUEST['p'])){
		$item = $d->o_fet("select * from #_seo where id=1 ");	}
}

function luudulieu(){
	global $d;
	// xóa trước
	$d->reset();
	$d->setTable('#_seo');


	$data['title_vn'] = addslashes($_POST['title_vn']);
	$data['title_us'] = addslashes($_POST['title_us']);

	$data['keyword_vn'] = addslashes($_POST['keyword_vn']);
	$data['keyword_us'] = addslashes($_POST['keyword_us']);
	
	$data['description_vn'] = addslashes($_POST['description_vn']);
	$data['description_us'] = addslashes($_POST['description_us']);

	$d->reset();
	$d->setTable('#_seo');
	$d->setWhere('id',1);
	if($d->update($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		echo $d->redirect("index.php?p=seo-co-ban&a=man");
	}else{
		echo $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=seo-co-ban&a=man");
	}
}
?>