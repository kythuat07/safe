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
	$loai = $d->o_fet("select * from #_loaitour where hien_thi =1  order by so_thu_tu asc");
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['lammoi'])){
			$d->o_que("update #_tour set ngay_dang = '".time()."' where id = '".addslashes($_GET['id'])."'");
		}
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_tour where id = '".$key."'");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_tour where ten_vn like '%".$key."%'");
			}else{
				$items = $d->o_fet("select * from #_tour where ma_sp like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_tour  order by ngay_dang desc");

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
			$items = $d->o_fet("select * from #_tour where id =  '".$id."'");
		}
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
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){

			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);

			$hinhanh = $d->o_fet("select * from #_tour where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
				@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			}
			$data['hinh_anh'] = $file;
			$data['hinh_anh_thumb'] = $img_resize;
		}



		$id_loai = "";
		foreach ($_POST['id_loai'] as $vl) {
			$id_loai .= addslashes($vl).",";

		}


		$data['id_loai'] = trim($id_loai);



		$data['ma_tour'] = addslashes($_POST['ma_tour']);

		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		$data['ten_us'] =addslashes($_POST['ten_us']);

		$data['alias_vn'] = addslashes(trim($_POST['alias_vn'],"-"));
		$data['alias_us'] = addslashes(trim($_POST['alias_us'],"-"));

		$data['gia'] = addslashes($_POST['gia']);

		$data['thoi_gian_vn'] =addslashes($_POST['thoi_gian_vn']);
		$data['thoi_gian_us'] =addslashes($_POST['thoi_gian_us']);

		

		$data['phuong_tien_vn'] = addslashes($_POST['phuong_tien_vn']);
		$data['phuong_tien_us'] = addslashes($_POST['phuong_tien_us']);

		$data['khach_san_vn'] =addslashes($_POST['khach_san_vn']);
		$data['khach_san_us'] =addslashes($_POST['khach_san_us']);

		$data['khoi_hanh_vn'] =addslashes($_POST['khoi_hanh_vn']);
		$data['khoi_hanh_us'] =addslashes($_POST['khoi_hanh_us']);

		$data['diem_den_vn'] =addslashes($_POST['diem_den_vn']);
		$data['diem_den_us'] =addslashes($_POST['diem_den_us']);

		$data['diem_di_us'] =addslashes($_POST['diem_di_us']);
		$data['diem_di_vn'] =addslashes($_POST['diem_di_vn']);

		$data['lich_trinh_vn'] =addslashes($_POST['lich_trinh_vn']);
		$data['lich_trinh_us'] =addslashes($_POST['lich_trinh_us']);

		$data['chuong_trinh_us'] =addslashes($_POST['chuong_trinh_us']);
		$data['chuong_trinh_vn'] =addslashes($_POST['chuong_trinh_vn']);

		$data['chi_tiet_vn'] =addslashes($_POST['chi_tiet_vn']);
		$data['chi_tiet_us'] =addslashes($_POST['chi_tiet_us']);

		$data['quy_dinh_vn'] =addslashes($_POST['quy_dinh_vn']);
		$data['quy_dinh_us'] =addslashes($_POST['quy_dinh_us']);

		$data['title_vn'] =addslashes($_POST['title_vn']);
		$data['title_us'] =addslashes($_POST['title_us']);

		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);
	
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;


		$d->reset();
		$d->setTable('#_tour');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=tour&a=man");
		}
	}
	else
	{
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){
			
			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);

			$data['hinh_anh'] = $file;
			$data['hinh_anh_thumb'] = $img_resize;
		}


		$id_loai = "";
		foreach ($_POST['id_loai'] as $vl) {
			$id_loai .= addslashes($vl).",";

		}


		$data['id_loai'] = trim($id_loai);



		$data['ma_tour'] = addslashes($_POST['ma_tour']);

		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		$data['ten_us'] =addslashes($_POST['ten_us']);

		$data['alias_vn'] = addslashes(trim($_POST['alias_vn'],"-"));
		$data['alias_us'] = addslashes(trim($_POST['alias_us'],"-"));

		$data['gia'] = addslashes($_POST['gia']);

		$data['thoi_gian_vn'] =addslashes($_POST['thoi_gian_vn']);
		$data['thoi_gian_us'] =addslashes($_POST['thoi_gian_us']);

		

		$data['phuong_tien_vn'] = addslashes($_POST['phuong_tien_vn']);
		$data['phuong_tien_us'] = addslashes($_POST['phuong_tien_us']);

		$data['khach_san_vn'] =addslashes($_POST['khach_san_vn']);
		$data['khach_san_us'] =addslashes($_POST['khach_san_us']);

		$data['khoi_hanh_vn'] =addslashes($_POST['khoi_hanh_vn']);
		$data['khoi_hanh_us'] =addslashes($_POST['khoi_hanh_us']);

		$data['diem_den_vn'] =addslashes($_POST['diem_den_vn']);
		$data['diem_den_us'] =addslashes($_POST['diem_den_us']);

		$data['diem_di_us'] =addslashes($_POST['diem_di_us']);
		$data['diem_di_vn'] =addslashes($_POST['diem_di_vn']);

		$data['lich_trinh_vn'] =addslashes($_POST['lich_trinh_vn']);
		$data['lich_trinh_us'] =addslashes($_POST['lich_trinh_us']);

		$data['chuong_trinh_us'] =addslashes($_POST['chuong_trinh_us']);
		$data['chuong_trinh_vn'] =addslashes($_POST['chuong_trinh_vn']);

		$data['chi_tiet_vn'] =addslashes($_POST['chi_tiet_vn']);
		$data['chi_tiet_us'] =addslashes($_POST['chi_tiet_us']);

		$data['quy_dinh_vn'] =addslashes($_POST['quy_dinh_vn']);
		$data['quy_dinh_us'] =addslashes($_POST['quy_dinh_us']);

		$data['title_vn'] =addslashes($_POST['title_vn']);
		$data['title_us'] =addslashes($_POST['title_us']);

		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);
	
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;

		$data['ngay_dang'] = time();


		$d->setTable('#_tour');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=tour&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=tour&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_tour where id = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['hinh_anh']);
			@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
		}
		//xoa size
			$d->o_que("delete from #_tour_detail where id_sp = '".$id."'");
		//
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_tour_hinhanh where id_sp = '".$id."'");
		$d->o_que("delete from #_tour_hinhanh where id_sp = '".$id."'");
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
		if($d->o_que("delete from #_tour where id='".$id."'")){
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=tour&a=man");
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=tour&a=man");
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
		$hinhanh = $d->o_fet("select * from #_tour where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_chitietsanpham where id_loai in ($chuoi)");
		if($d->o_que("delete from #_tour where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
				@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			}
			//xoa size
			$d->o_que("delete from #_tour_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_tour_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_tour_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['hinh_anh']);
				@unlink('../img_data/images/'.$hact['hinh_anh_thumb']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
			}
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=tour&a=man");
	}else $d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
}
?>