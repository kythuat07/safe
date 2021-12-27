<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/hienthi";
		break;
	case "add":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "edit":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	case "delete":
		xoadulieu();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang,$loaibv,$soluong;
	$loaibv = $d->o_fet("select * from #_hinhthucthanhtoan order by so_thu_tu asc");
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_hinhthucthanhtoan where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_hinhthucthanhtoan where ten_vn like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_hinhthucthanhtoan  order by so_thu_tu asc");


		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP = $maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_hinhthucthanhtoan where id =  '".$id."'");
		}
		$soluong = $loai = $d->o_fet("select * from #_hinhthucthanhtoan");
	}
}

function luudulieu(){
	global $d;
	@include('resize_img.php');
	$image = new SimpleImage();
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
		


		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['ten_us'] = addslashes($_POST['ten_us']);

		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$data['noi_dung_vn'] =addslashes($_POST['noi_dung_vn']);

		$d->setTable('#_hinhthucthanhtoan');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=hinh-thuc-thanh-toan&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=hinh-thuc-thanh-toan&a=man");
		}
	}
	else
	{

		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['ten_us'] = addslashes($_POST['ten_us']);

		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$data['noi_dung_vn'] =addslashes($_POST['noi_dung_vn']);

		$d->setTable('#_hinhthucthanhtoan');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=hinh-thuc-thanh-toan&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=hinh-thuc-thanh-toan&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_hinhthucthanhtoan');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=hinh-thuc-thanh-toan&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=hinh-thuc-thanh-toan&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=hinh-thuc-thanh-toan&a=man");
}

function xoadulieu_mang(){
	global $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');
		//lay danh sách idsp theo chuoi

		if($d->o_que("delete from #_hinhthucthanhtoan where id in ($chuoi)")){
			//xoa hình ảnh

			$d->redirect("index.php?p=hinh-thuc-thanh-toan&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=hinh-thuc-thanh-toan&a=man");
	}else $d->redirect("index.php?p=hinh-thuc-thanh-toan&a=man&page=".@$_REQUEST['page']."");
}
?>