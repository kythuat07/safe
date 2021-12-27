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
	global $d, $items, $paging,$loai;
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_file where id = '".$key."'");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_file where ten_vn like '%".$key."%'");
			}else{
				$items = $d->o_fet("select * from #_file where ten_vn like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_file  order by id desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP=$maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_file where id =  '".$id."'");
		}
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	if($id != '')
	{
		if(@$file = $d->upfile('file','../img_data/', $file_name)){
			$data['link'] = $file;
			$hinhanh = $d->o_fet("select * from #_file where id = '".$id."'");
			foreach ($hinhanh as $ha) {
			@unlink('../img_data/'.$ha['link']);
			}//end img
			$data['size'] = (float)($_FILES['file']['size'])/1024;
		}

		
		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		$data['ngay_dang'] = date("d-m-y H:m:s"); 
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['id_code'] = md5(date("d-m-y H:m:s").RAND('10','100'));
		
		$d->reset();
		$d->setTable('#_file');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=upload-file&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=upload-file&a=man");
		}
	}
	else
	{
		if(@$file = $d->upfile('file','../img_data/', $file_name))
		{
			$data['link'] = $file;
			$data['size'] = (float)($_FILES['file']['size'])/1024;
		}

		

		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		$data['ngay_dang'] = date("d-m-y H:m:s"); 
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['id_code'] = md5(date("d-m-y H:m:s").RAND('10','100'));
		
		

		$d->setTable('#_file');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=upload-file&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=upload-file&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_file where id = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/'.$ha['link']);
		}
		// end
		if($d->o_que("delete from #_file where id='".$id."'")){
			$d->redirect("index.php?p=upload-file&a=man&page=".@$_REQUEST['page']."");
		}else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=upload-file&a=man");
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=upload-file&a=man");
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
		$hinhanh = $d->o_fet("select * from #_file where id in ($chuoi)");
		if($d->o_que("delete from #_file where id in ($chuoi)")){
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/'.$ha['link']);
			}
			$d->redirect("index.php?p=upload-file&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=upload-file&a=man");
	}else $d->redirect("index.php?p=upload-file&a=man&page=".@$_REQUEST['page']."");
}
?>