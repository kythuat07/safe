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
	global $d, $items;
	if(isset($_REQUEST['p'])){
		$id = addslashes($_REQUEST['p']);
		$items = $d->o_fet("select * from #_thongtin where id = '1'");
	}
}

function luudulieu(){
	global $d;
	$file_name=$d->fns_Rand_digit(0,9,5);
	if(@$file = $d->upload_image("file", '', '../img_data/icon/',$file_name)){

		$hinhanh = $d->o_fet("select * from #_thongtin where id = '1'");
		@unlink('../img_data/icon/'.$hinhanh[0]['favicon']);
		$data['favicon'] = $file;

	}
	if(@$file2 = $d->upload_image("file_2", '', '../img_data/icon/','')){
		$hinhanh = $d->o_fet("select * from #_thongtin where id = '1'");
		@unlink('../img_data/icon/'.$hinhanh[0]['icon_share']);
		$data['icon_share'] = $file2;

	}

	$data['hotline'] = addslashes($_POST['hotline']);
	$data['company'] = addslashes($_POST['company']);
	$data['address'] = addslashes($_POST['address']);
	$data['twitter'] = addslashes($_POST['twitter']);
	$data['facebook'] = addslashes($_POST['facebook']);
	$data['linkedin'] = addslashes($_POST['linkedin']);
	$data['youtube'] = addslashes($_POST['youtube']);
	$data['pinterest'] = addslashes($_POST['pinterest']);
	$data['instagram'] = addslashes($_POST['instagram']);
	$data['dien_thoai'] = addslashes($_POST['dien_thoai']);
	$data['fax'] = addslashes($_POST['fax']);
	$data['email'] = addslashes($_POST['email']);
	$data['coppy_right'] = addslashes($_POST['coppy_right']);
	$data['map'] = addslashes($_POST['map']);
	$data['id_facebook'] = addslashes($_POST['id_facebook']);
	$data['toa_do'] = addslashes($_POST['toa_do']);

	$d->reset();
	$d->setWhere("id","1");
	$d->setTable('#_thongtin');
	if($d->update($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		$d->redirect("index.php?p=".$_GET['p']."&a=man");
	}else{
		$d->alert("#ERR.");
		$d->redirect("index.php?p=".$_GET['p']."&a=man");
	}
}
?>