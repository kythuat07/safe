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
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_binhluan where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_binhluan where ten_vn like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_binhluan order by ngay_dang asc");


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


		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){

			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);

			$hinhanh = $d->o_fet("select * from #_binhluan where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
			}
			$data['hinh_anh'] = $img_resize;
		}

		$data['id_loai'] = addslashes($_POST['id_loai']);

		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['ten_us'] = addslashes($_POST['ten_us']);


		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['alias_vn'] = addslashes(trim($_POST['alias_vn'],"-"));
		$data['alias_us'] = addslashes(trim($_POST['alias_us'],"-"));
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;

		$data['title_vn'] =addslashes($_POST['title_vn']);
		$data['title_us'] =addslashes($_POST['title_us']);

		$data['mo_ta_vn'] =addslashes($_POST['mo_ta_vn']);

		
		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);
		$d->setTable('#_binhluan');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=ql-binhluan&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=ql-binhluan&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			
			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);
			$data['hinh_anh'] = $img_resize;
		}

		$data['id_loai'] = addslashes($_POST['id_loai']);

		$data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['ten_us'] = addslashes($_POST['ten_us']);


		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['alias_vn'] = addslashes(trim($_POST['alias_vn'],"-"));
		$data['alias_us'] = addslashes(trim($_POST['alias_us'],"-"));
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$data['title_vn'] =addslashes($_POST['title_vn']);
		$data['title_us'] =addslashes($_POST['title_us']);

		$data['mo_ta_vn'] =addslashes($_POST['mo_ta_vn']);

		
		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);

		$d->setTable('#_binhluan');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=ql-binhluan&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=ql-binhluan&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_binhluan where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_binhluan');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=ql-binhluan&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-binhluan&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=ql-binhluan&a=man");
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
		$hinhanh = $d->o_fet("select * from #_binhluan where id in ($chuoi)");

		if($d->o_que("delete from #_binhluan where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=ql-binhluan&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-binhluan&a=man");
	}else $d->redirect("index.php?p=ql-binhluan&a=man&page=".@$_REQUEST['page']."");
}
?>