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
	global $d, $items, $paging, $loai,$soluong,$parent;
	$parent=$d->o_fet("select * from #_category where module=1 and hien_thi=1 and id_loai=0");

	
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['loaitin']) && $_GET['loaitin'] <> ''){
			
			if($_GET['loaitin'] == 0){
				$items = $d->o_fet("select * from #_gallery order by stt desc");
			}else{
			    $idloai = @addslashes($_GET['loaitin']);
			    $items = $d->o_fet("select * from #_gallery where FIND_IN_SET(parent,'$idloai') <> 0 order by stt desc");
			}
		}else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_gallery where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_gallery where title_vn like '%".$key."%'");
			}
		}
		else  $items = $d->o_fet("select * from #_gallery order by stt asc");

		if(isset($_GET['hide'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hide']));
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
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_gallery where id =  '".$id."'");
		}
		$soluong = $d->o_fet("select * from #_gallery");
	}
}

function luudulieu(){
	global $d,$d;
	@include('resize_img.php');
	$image = new SimpleImage();
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$hinhanh = $d->o_fet("select * from #_gallery where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['picture']);
			}
			$data['picture'] = $file;
		}

		if(@$file_1 = $d->upload_image("file_1", '', '../img_data/icon/',$file_name)){
			$hinhanh_1 = $d->o_fet("select * from #_gallery where id = '".$id."'");
			foreach ($hinhanh_1 as $ha1) {
				@unlink('../img_data/icon/'.$ha1['favicon']);
			}
			$data['favicon'] = $file_1;
		}

		if(@$file_2 = $d->upload_image("file_2", '', '../img_data/icon/',$file_name)){
			$hinhanh_2 = $d->o_fet("select * from #_gallery where id = '".$id."'");
			foreach ($hinhanh_2 as $ha2) {
				@unlink('../img_data/icon/'.$ha2['ic_share']);
			}
			$data['ic_share'] = $file_2;
		}

		$data['parent'] = addslashes($_POST['parent']);
		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['body_vn'] = $d->clear(addslashes($_POST['body_vn']));
		$data['body_us'] = $d->clear(addslashes($_POST['body_us']));
		$data['body_ch'] = $d->clear(addslashes($_POST['body_ch']));
		$data['link'] = $d->clear(addslashes($_POST['link']));
		$data['stt'] = addslashes($_POST['stt']);
		$data['hide'] = isset($_POST['hide']) ? 1 : 0;

		$d->setTable('#_gallery');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=gallery&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=gallery&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){			
			$data['picture'] = $file;
		}
		if(@$file_1 = $d->upload_image("file_1", '', '../img_data/icon/',$file_name)){			
			$data['favicon'] = $file_1;
		}

		if(@$file_2 = $d->upload_image("file_1", '', '../img_data/icon/',$file_name)){			
			$data['ic_share'] = $file_2;
		}


		$data['parent'] = addslashes($_POST['parent']);
		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['body_vn'] = $d->clear(addslashes($_POST['body_vn']));
		$data['body_us'] = $d->clear(addslashes($_POST['body_us']));
		$data['body_ch'] = $d->clear(addslashes($_POST['body_ch']));
		$data['link'] = $d->clear(addslashes($_POST['link']));
		$data['stt'] = addslashes($_POST['stt']);
		$data['hide'] = isset($_POST['hide']) ? 1 : 0;
		
		$d->setTable('#_gallery');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=gallery&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=gallery&a=man");
		}
	}
}

function xoadulieu(){
	global $d, $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_gallery where id = '".$id."'");

		@unlink('../img_data/images/'.$hinhanh[0]['picture']);

		$d->reset();
		$d->setTable('#_gallery');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=gallery&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=gallery&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=gallery&a=man");
}

function xoadulieu_mang(){
	global $d, $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');
		//lay danh sách idsp theo chuoi
		$hinhanh = $d->o_fet("select * from #_gallery where id in ($chuoi)");
		if($d->o_que("delete from #_gallery where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['picture']);

			}
			$d->redirect("index.php?p=gallery&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=gallery&a=man");
	}else $d->redirect("index.php?p=gallery&a=man&page=".@$_REQUEST['page']."");
}
?>