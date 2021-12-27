<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/hienthi";
		// $template = @$_REQUEST['p']."/them_noidung";
		break;
	case "sua-noi-dung":
		showdulieu();
		$template = @$_REQUEST['p']."/them_noidung";
		break;
	case "edit":
		showdulieu();
		luudulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "delete":
		xoadulieu();
		break;
	case "save_noidung":
		luunoidung_lien_he();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}
function luunoidung_lien_he(){
	global $d;
	$id = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
	if($id != '')
	{

		$d->reset();
		$d->setWhere('id',$id );
		$d->setTable('#_setting');
		$d->delete();
		//

		$data['id'] = $id;
		$data['title_vn'] =  $data['ten_vn'] = addslashes($_POST['ten_vn']);
		$data['title_us'] =  $data['ten_us'] = addslashes($_POST['ten_us']);
		$data['title_jp'] =  $data['ten_jp'] = addslashes($_POST['ten_jp']);
		$data['title_cn'] =  $data['ten_cn'] = addslashes($_POST['ten_cn']);

		$data['noi_dung_vn'] = addslashes($_POST['noi_dung_vn']);
		$data['noi_dung_us'] = addslashes($_POST['noi_dung_us']);
		$data['noi_dung_jp'] = addslashes($_POST['noi_dung_jp']);
		$data['noi_dung_cn'] = addslashes($_POST['noi_dung_cn']);

		$d->reset();
		$d->setTable('#_setting');
		if($d->insert($data)){
			$d->alert("Cập nhật dữ liệu thành công");
			$d->redirect("index.php?p=".$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->alert("Cập nhật dữ liệu không thành công");
			$d->redirect("index.php?p=".$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}
	}
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang;
	if($_REQUEST['a'] == 'man'){

		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		if($id!=null){
			$cot = (isset($_GET['b'])) ? addslashes($_GET['b']) : "";
			$trangthai = (isset($_GET['TT'])) ? addslashes($_GET['TT']) : "";

			$d->reset();
			$d->setTable('#_lienhe');
			$d->setWhere('id',$id);
			if($trangthai == '0') $data['hien_thi'] = 0;
			else  $data['hien_thi'] = 1;
			if($d->update($data)){}
			$d->redirect("index.php?p=lien-he&a=man&page=".@$_REQUEST['page']."");
		}

		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_lienhe where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_lienhe where ten_vn like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_lienhe order by id desc");


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
	}elseif($_REQUEST['a'] == 'edit'){
	
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_lienhe where id =  '".$id."'");
		}
	}
	else 
	if($_REQUEST['a'] == 'sua-noi-dung'){
		$id = addslashes($_REQUEST['p']);
		$items = $d->o_fet("select * from #_setting where id =  '".$id."'");
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	if($id != '')
	{
		$data['trang_thai'] = '1';
		$d->reset();
		$d->setWhere('id', $id);
		$d->setTable('#_lienhe');
		if($d->update($data)){}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_lienhe where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_lienhe');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=lien-he&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=lien-he&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=lien-he&a=man");
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
		$hinhanh = $d->o_fet("select * from #_lienhe where id in ($chuoi)");
		if($d->o_que("delete from #_lienhe where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=lien-he&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=lien-he&a=man");
	}else $d->redirect("index.php?p=lien-he&a=man&page=".@$_REQUEST['page']."");
}
?>