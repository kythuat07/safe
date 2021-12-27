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
				$items = $d->o_fet("select * from #_cauhoi where id = '".$key."'");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_cauhoi where tieu_de like '%".$key."%'");
			}else{
				$items = $d->o_fet("select * from #_cauhoi where ma_sp like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_cauhoi  order by id desc");

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
			$items = $d->o_fet("select * from #_cauhoi where id =  '".$id."'");
		}
	}
}

function luudulieu(){
	global $d;
	@include('resize_img.php');
	$image = new SimpleImage();

	$mau = $d->o_fet("select * from #_mau where hien_thi = 1 order by so_thu_tu asc");
	$size = $d->o_fet("select * from #_size where hien_thi = 1 order by so_thu_tu asc");

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{

		$data['ho_ten'] = addslashes($_POST['ho_ten']);

		$data['so_dien_thoai'] = addslashes($_POST['so_dien_thoai']);

		$data['email'] =addslashes($_POST['email']);
		$data['dia_chi'] =addslashes($_POST['dia_chi']);
		$data['tieu_de'] =addslashes($_POST['tieu_de']);


		$data['noi_dung'] = addslashes($_POST['noi_dung']);
		$data['noi_dung_tra_loi'] = addslashes($_POST['noi_dung_tra_loi']);

		$data['ngay_tra_loi'] = time();
		$data['nguoi_tra_loi'] =addslashes($_SESSION['name']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		
		$d->reset();
		$d->setTable('#_cauhoi');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=ql-tuvan&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=ql-tuvan&a=man");
		}
	}
	else
	{
		$d->redirect("index.php?p=ql-tuvan&a=man");
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_cauhoi where id = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['hinh_anh']);
			@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
		}
		//xoa size
			$d->o_que("delete from #_cauhoi_detail where id_sp = '".$id."'");
		//
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_cauhoi_hinhanh where id_sp = '".$id."'");
		$d->o_que("delete from #_cauhoi_hinhanh where id_sp = '".$id."'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/'.$hact['hinh_anh']);
			@unlink('../img_data/images/'.$hact['hinh_anh_thumb']);
		}
		// end
		//xoa hinhanh
		$hinhanh = $d->o_fet("select * from #_chitietsanpham where id_sp = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['hinh_anh']);
			@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			
		}
		// end
		if($d->o_que("delete from #_cauhoi where id='".$id."'")){
			$d->redirect("index.php?p=ql-tuvan&a=man&page=".@$_REQUEST['page']."");
		}else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-tuvan&a=man");
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=ql-tuvan&a=man");
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
		$hinhanh = $d->o_fet("select * from #_cauhoi where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_chitietsanpham where id_loai in ($chuoi)");
		if($d->o_que("delete from #_cauhoi where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
				@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			}
			//xoa size
			$d->o_que("delete from #_cauhoi_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_cauhoi_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_cauhoi_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['hinh_anh']);
				@unlink('../img_data/images/'.$hact['hinh_anh_thumb']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
			}
			$d->redirect("index.php?p=ql-tuvan&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-tuvan&a=man");
	}else $d->redirect("index.php?p=ql-tuvan&a=man&page=".@$_REQUEST['page']."");
}
?>