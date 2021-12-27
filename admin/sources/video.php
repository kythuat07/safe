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
	global $d, $items, $paging,$soluong,$loai;
	$loai = $d->array_category(0,'',$_GET['loaitin'],4);
	
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['loaitin']) && $_GET['loaitin'] <> ''){
			
			if($_GET['loaitin'] == 0){
				$items = $d->o_fet("select * from #_video order by so_thu_tu asc, id desc");
			}else{
			    $id_loai = $_GET['loaitin'].$d->findIdSub($_GET['loaitin']);
			    $items = $d->o_fet("select * from #_video where FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc, id desc");
			}
		}
		else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_video where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_video where ten_vn like '%$key%' order by id desc");
			}
		}
		else $items = $d->o_fet("select * from #_video order by id desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=25;
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
			$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_video where id =  '".$id."'");
		}
		$loai = $d->array_category(0,'',$items[0]['id_loai'],4);
		$soluong = $d->o_fet("select * from #_video");
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['hinh_anh'] = $file;
			$hinhanh = $d->o_fet("select * from #_video where id = '".$id."'");
			foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['hinh_anh']);
			}//end img
		}

		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['id_loai'] = addslashes($_POST['id_loai']);
		$data['ten_us'] = addslashes($_POST['ten_us']);
		$data['link'] = addslashes($_POST['link']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$d->setTable('#_video');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=video&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=video&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['hinh_anh'] = $file;
		}

		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['ten_us'] = addslashes($_POST['ten_us']);
		$data['id_loai'] = addslashes($_POST['id_loai']);
		$data['link'] = addslashes($_POST['link']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$d->setTable('#_video');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=video&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=video&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_video where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_video');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=video&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=video&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=video&a=man");
}

function xoadulieu_mang(){
	global $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');


		$hinhanh = $d->o_fet("select * from #_video where id in ($chuoi)");
		if($d->o_que("delete from #_video where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=video&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=video&a=man");
	}else $d->redirect("index.php?p=video&a=man&page=".@$_REQUEST['page']."");
}
?>