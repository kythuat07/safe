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
	case "delete_image":
		xoadulieu_image();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang,$loaibv,$soluong,$module;
	$module = $d->o_fet("select * from #_module where hide = 1 order by stt asc,id desc");

	if($_REQUEST['a'] == 'man'){
		$loaibv = $d->array_category(0,'','',0);
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_category where id = '".$key."'");
			}else{
				$key = $d->bodautv($key);
				$items = $d->o_fet("select * from #_category where alias_vn like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_category where id_loai = 0 order by so_thu_tu asc, id desc");


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
			$items = $d->o_fet("select * from #_category where id =  '".$id."'");
		}
		$loaibv = $d->array_category(0,'',$items[0]['id_loai'],0,$items[0]['id']);

		
		$soluong = $loai = $d->o_fet("select * from #_category");
		
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

			$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
			@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);
			$data['hinh_anh'] = $file;
		}


		$level=$d->simple_fetch("select * from #_category where id={$_POST['id_loai']}");
		$data['level'] = ($level['level']!='') ? $level['level']+1 : 0;
		
		$data['id_loai'] = addslashes($_POST['id_loai']);

		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));
		
		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if($d->checkLink($data['alias_vn'],"alias_vn",$id ) && $data['alias_vn']!='') {
			$data['alias_vn'].="-".rand(0,99);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if($d->checkLink($data['alias_us'],"alias_us",$id ) && $data['alias_us']!='') {
			$data['alias_us'].="-".rand(0,99);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(0,99);
		}

		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));
		
		$data['noi_dung_vn'] = $d->clear(addslashes($_POST['noi_dung_vn']));
		$data['noi_dung_us'] = $d->clear(addslashes($_POST['noi_dung_us']));
		$data['noi_dung_ch'] = $d->clear(addslashes($_POST['noi_dung_ch']));
		
		
		$data['module'] = addslashes($_POST['module']);
		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
                $data['top'] = isset($_POST['top']) ? 1 : 0;
		// $data['ordering'] = addslashes($_POST['ordering']);


		$data['title_vn'] =$d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] =$d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] =$d->clear(addslashes($_POST['title_ch']));		
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['hinh_anh'] = $file;
		}
		$level=$d->simple_fetch("select * from #_category where id={$_POST['id_loai']}");
		$data['level'] = ($level['level']!='') ? $level['level']+1 : 0;
		
		$data['id_loai'] = addslashes($_POST['id_loai']);

		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));
		
		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if($d->checkLink($data['alias_vn'],"alias_vn",$id ) && $data['alias_vn']!='') {
			$data['alias_vn'].="-".rand(0,9);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if($d->checkLink($data['alias_us'],"alias_us",$id ) && $data['alias_us']!='') {
			$data['alias_us'].="-".rand(0,9);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(0,9);
		}

		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));
		
		$data['noi_dung_vn'] = $d->clear(addslashes($_POST['noi_dung_vn']));
		$data['noi_dung_us'] = $d->clear(addslashes($_POST['noi_dung_us']));
		$data['noi_dung_ch'] = $d->clear(addslashes($_POST['noi_dung_ch']));
		

		
		$data['module'] = addslashes($_POST['module']);
		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		// $data['ordering'] = addslashes($_POST['ordering']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
                $data['top'] = isset($_POST['top']) ? 1 : 0;


		$data['title_vn'] =$d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] =$d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] =$d->clear(addslashes($_POST['title_ch']));		
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$d->setTable('#_category');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=category&a=man");
		}
		else{
			echo $d->sql; echo mysql_error();
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=category&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=category&a=man");
}

function xoadulieu_image(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);
		$datahinh['hinh_anh'] = '';
		$d->reset();
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->update($datahinh)){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=category&a=man");
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
		$hinhanh = $d->o_fet("select * from #_category where id in ($chuoi)");

		if($d->o_que("delete from #_category where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
	}else $d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
}
?>