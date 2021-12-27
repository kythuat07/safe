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
	case "save":
		luudulieu();
		break;
	case "edit":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "editbh":
		showdulieubh();
		$template = @$_REQUEST['p']."/them";
		break;
	case "view":
		view();
		$template = @$_REQUEST['p']."/view";
		break;
	case "delete":
		xoadulieu();
	 	break;
	case "deletebh":
		xoadulieu_dh();
	 	break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang;
	if($_REQUEST['a'] == 'man'){
		//update cot
		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		if($id!=null){
			$cot = (isset($_GET['b'])) ? addslashes($_GET['b']) : "";
			$trangthai = (isset($_GET['TT'])) ? addslashes($_GET['TT']) : "";

			$d->reset();
			$d->setTable('#_dathang');
			$d->setWhere('id',$id);
			$data[$cot] = $trangthai;
			$data['ngay_giao_hang'] = time();
			if($d->update($data)){}
			$d->redirect("index.php?p=danh-sach-don-hang&a=man&page=".@$_REQUEST['page']."");
		}
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_dathang where id = '".$key."' and trang_thai = 1 ");
			}else{
				$items = $d->o_fet("select * from #_dathang where ho_ten like '%".$key."%' and trang_thai = 1 ");

			}
		}
		else $items = $d->o_fet("select * from #_dathang order by id desc");


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
	}
}
function showdulieubh(){
	global $d, $items, $paging, $loai,$hang;
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_baohanh where id = '".$key."' and trang_thai = 1 ");
			}else{
				$items = $d->o_fet("select * from #_baohanh where ho_ten like '%".$key."%' and trang_thai = 1 ");

			}
		}
		

	}else $items = $d->o_fet("select * from #_baohanh where id=$_GET[id]");
}
function luudulieu(){
	global $d;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	
	if($id != '')
	{


		$data['id_sp'] = $d->clear(addslashes($_POST['id_sp']));
		$data['ma_dh'] = $d->clear(addslashes($_POST['ma_dh']));
		$data['noi_dung'] = $d->clear(addslashes($_POST['noi_dung']));
		$iddh	=  ($_POST['id_sp']);
		
		$data['ngay_sua'] = time();

		
		$d->setTable('#_baohanh');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=danh-sach-don-hang&a=view&id=$iddh");
		}
		else{
			//echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=danh-sach-don-hang&a=view&id=$iddh");
		}
	}
	else
	{


		$data['id_sp'] = $_POST['id_sp'];
		$data['ma_dh'] = $d->clear(addslashes($_POST['ma_dh']));
		$data['noi_dung'] = $d->clear(addslashes($_POST['noi_dung']));
		
		$data['ngay_sua'] = time();
		
		$iddh	=  ($_POST['id_sp']);
		

		$d->setTable('#_baohanh');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=danh-sach-don-hang&a=view&id=$iddh");
		}
		else{
			echo $d->sql; echo mysql_error();
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=danh-sach-don-hang&a=view&id=$iddh");
		}
	}
	
}
function view(){
	global $d, $items,$dh;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	if($id == '')
	{
		$d->alert("Không nhận được dữ liệu");
		$d->redirect("index.php?p=danh-sach-don-hang&a=man&page=".@$_REQUEST['page']."");
	}
	else
	{		
		$data['trang_thai'] = '1';
		$d->reset();
		$d->setWhere('id', $id);
		$d->setTable('#_dathang');
		$d->update($data);

		$dh = $d->o_fet("select * from #_dathang where id = '".$id."'");
		$items = $d->o_fet("select * from #_chitietdathang where id_dh = '".@$dh[0]['id']."'");
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_dathang');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->reset();
			$d->setTable('#_chitietdathang');
			$d->setWhere('id_dh',$id);
			$d->delete();

			$d->redirect("index.php?p=danh-sach-don-hang&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=danh-sach-don-hang&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=danh-sach-don-hang&a=man");
}

function xoadulieu_dh(){
	global $d;
	
	$id_dh = $_GET['dh'];
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_baohanh');
		$d->setWhere('id',$id);
		if($d->delete()){

			$d->redirect("index.php?p=danh-sach-don-hang&a=view&id=$id_dh");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=danh-sach-don-hang&a=view");
		}
	}
}

function xoadulieu_mang(){
	global $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');
		$hinhanh = $d->o_fet("select * from #_dathang where id in ($chuoi)");
		if($d->o_que("delete from #_dathang where id in ($chuoi)")){
			$d->o_que("delete from #_chitietdathang where id in ($chuoi)");
			$d->redirect("index.php?p=danh-sach-don-hang&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=danh-sach-don-hang&a=man");
	}else $d->redirect("index.php?p=danh-sach-don-hang&a=man&page=".@$_REQUEST['page']."");
}
?>