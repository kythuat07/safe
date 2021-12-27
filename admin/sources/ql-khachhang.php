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
function show_menu_khachhang_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
{
      foreach ($menus as $val)
      {
          if ($val['id_loai'] == $parrent)
          {
             $chuoi .= $val['id'].',';
              show_menu_khachhang_hd($menus, $val['id'],$chuoi);
          }
      }
      return $chuoi;
}
function showdulieu(){
	global $d, $items, $paging, $loai,$loai_tin,$loai_tin_show , $soluong;
	$loai_tin = $d->o_fet("select * from #_danhmuc_khachhang where hien_thi = 1 order by so_thu_tu asc");
	$loai_tin_show = $d->o_fet("select * from #_danhmuc_khachhang");
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		//show du lieu
		if(isset($_GET['loaitin']) && $_GET['loaitin'] <> ''){
			
			if($_GET['loaitin'] == 0){
				$items = $d->o_fet("select * from #_khachhang order by so_thu_tu asc");
			}else{
			    $loaitin = $d->o_fet("select id, id_loai from #_danhmuc_khachhang where hien_thi = 1");
			    $id_loai = show_menu_khachhang_hd($loaitin,@addslashes($_GET['loaitin']));
			    $id_loai = trim($id_loai,',');
			    $id_loai = @addslashes($_GET['loaitin']) .','.$id_loai;
			    $items = $d->o_fet("select * from #_khachhang where FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc");
			}
		}else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_khachhang where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_khachhang where ten_vn like '%$key%'");
			}
		}
		else $items = $d->o_fet("select * from #_khachhang order by id desc");


		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP= $maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_khachhang where id =  '".$id."'");
		}
		$soluong =  $d->o_fet("select * from #_khachhang");
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
			$hinhanh = $d->o_fet("select * from #_khachhang where id = '".$id."'");
			foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['hinh_anh']);
			}//end img
		}

		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		if($_POST['mat_khau'] <> '') $data['mat_khau'] =addslashes(md5(trim($_POST['mat_khau'])));
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		$data['so_dien_thoai'] = addslashes($_POST['so_dien_thoai']);
		$data['email'] = addslashes($_POST['email']);
		$data['dia_chi'] = addslashes($_POST['dia_chi']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;



		$d->setTable('#_khachhang');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['hinh_anh'] = $file;
		}

		$data['ten_vn'] =addslashes($_POST['ten_vn']);
		$data['mat_khau'] =addslashes(md5(trim($_POST['mat_khau'])));
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		$data['so_dien_thoai'] = addslashes($_POST['so_dien_thoai']);
		$data['email'] = addslashes($_POST['email']);
		$data['dia_chi'] = addslashes($_POST['dia_chi']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;



		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$d->setTable('#_khachhang');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=".@$_GET['p']."&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=".@$_GET['p']."&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_khachhang where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_khachhang');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=".@$_GET['p']."&a=man");
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
		$hinhanh = $d->o_fet("select * from #_khachhang where id in ($chuoi)");
		if($d->o_que("delete from #_khachhang where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
	}else $d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
}
?>