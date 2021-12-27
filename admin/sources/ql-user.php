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
		$template = @$_REQUEST['p']."/sua";
		break;
	case "edit":
		showdulieu();
		$template = @$_REQUEST['p']."/sua";
		break;
	case "change-pass":
		showdulieu();
		$template = @$_REQUEST['p']."/doipass";
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
	case "savepass":
		savepass();
		break;
	default:
		$template = "index";
}

function savepass(){
	global $d;

	$id = $_SESSION["id_user"];
	$data['ho_ten'] = addslashes($_POST['ho_ten']);	
	$data['pass_hash'] = sha1($d->clean(addslashes($_POST['password'])));

	$d->reset();
	$d->setTable('#_user');
	$d->setWhere('id',$id);
	
	if($d->update($data))
	{
		$d->redirect("index.php?p=ql-user&a=man");
	}
	else{
		$d->transfer("Lưu dữ liệu bị lỗi", "index.php?p=ql-user&a=man");
	}
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang;
	if($_REQUEST['a'] == 'man'){
		//update cot
		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		if($id!=null){

		if($_SESSION['quyen'] == 1){
			$cot = (isset($_GET['b'])) ? addslashes($_GET['b']) : "";
			$trangthai = (isset($_GET['TT'])) ? addslashes($_GET['TT']) : "";

			$d->reset();
			$d->setTable('#_user');
			$d->setWhere('id',$id);
			if($trangthai == '0') $data[$cot] = 0;
			else  $data[$cot] = 1;
			if($id <> 'admin'){
				if($d->update($data)){}
				}
		}else $d->alert("Quản trị viên không thể thực hiện thao tác này!");
			$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
		}
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_user where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_user where ho_ten like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_user order by id desc");


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
	}else if($_REQUEST['a'] == 'edit'){
		//lay noi dung theo id
		if($_SESSION['is_admin'] != 1){
			$d->redirect("index.php");
		}
		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		$items = $d->o_fet("select * from #_user where id =  '".$id."'");
		
		
	}else if($_REQUEST['a'] == 'change-pass'){
		//lay noi dung theo id
		$id = isset($_GET['id']) ? addslashes($_GET['id']) : "";
		$items = $d->o_fet("select * from #_user where id =  '".$_SESSION['id_user']."'");
		
		
	}
}

function luudulieu(){
	global $d;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	if($id != '')
	{

		$data['tai_khoan'] = $d->clean(addslashes($_POST['tai_khoan']));
		$data['user_hash'] = sha1($data['tai_khoan']);
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		if(isset($_POST['password']) && !empty($_POST['password'])){
			$data['pass_hash'] = sha1($d->clean(addslashes($_POST['password'])));
		}
		
		$data['quyen_han'] = addslashes($_POST['quyen_han']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$d->setTable('#_user');
		$d->setWhere('id',$id);

		if($d->update($data)){
			$d->o_que("delete from #_user_permission_group where id_user = '".$_POST['id_user']."'");
			if(isset($_POST['permission'])){
				$permission = $_POST['permission'];
				foreach ( $permission as $key => $value) {
					$data_permission['id_user'] = $_POST['id_user'];
					$data_permission['id_permission'] = $value;
					$d->reset();
					$d->setTable('#_user_permission_group');
					$d->insert($data_permission);
				}
				
				
			}
			$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']);
		}
		else{
			$d->alert("Cập nhật dữ liệu bị lỗi!");
			$d->redirect("Cập nhật dữ liệu bị lỗi", "index.php?p=ql-user&a=man");
		}
	}
	else{
		$data['tai_khoan'] = $d->clean(addslashes($_POST['tai_khoan']));
		$data['user_hash'] = sha1($data['tai_khoan']);
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		$data['pass_hash'] = sha1($d->clean(addslashes($_POST['password'])));
		$data['quyen_han'] = addslashes($_POST['quyen_han']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$d->reset();
		$d->setTable('#_user');
		if($id_u = $d->insert($data))
		{
			if(isset($_POST['permission'])){
				$permission = $_POST['permission'];
				foreach ( $permission as $key => $value) {
					$data_permission['id_user'] = $id_u;
					$data_permission['id_permission'] = $value;
					$d->reset();
					$d->setTable('#_user_permission_group');
					$d->insert($data_permission);
				}							
			}
			$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			$d->transfer("Tên tài khoản đã tồn tại!", "index.php?p=ql-user&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if($_SESSION['is_admin'] != 1){
		$d->redirect("index.php");
	}
	if($_SESSION['quyen'] == 1){
		if(isset($_GET['id'])){
			$id =  addslashes($_GET['id']);
			$d->reset();
			$d->setTable('#_user');
			$d->setWhere('id',$id);
			$d->setWhereOrther('id','admin');
			if($d->delete()){
				$d->o_que("delete from #_user_permission_group where id_user = '".$id."'");
				@$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
			}else
				$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-user&a=man");
		}else $d->transfer("Không nhận được dữ liệu", "index.php?p=ql-user&a=man");
	}else {
		$d->alert("Quản trị viên không thể thực hiện thao tác này!");
		@$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
	} 
}

function xoadulieu_mang(){
	global $d, $d;
	if($_SESSION['quyen'] == 1){
		if(isset($_POST['chk_child'])){
			$chuoi = "";
			foreach ($_POST['chk_child'] as $val) {
				if($val <> 'admin')
				$chuoi .=$val.",";
			}
			$chuoi = trim($chuoi,',');
			//lay danh sách idsp theo chuoi
			$hinhanh = $d->o_fet("select * from #_user where id in ($chuoi)");
			if($d->o_fet("delete from #_user where id in ($chuoi)")){
				//xoa hình ảnh
				foreach ($hinhanh as $ha) {
					@unlink('../img_data/images/'.$ha['hinh_anh']);

				}
				$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
			}
			else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=ql-user&a=man");
		}else $d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
	}else {
		$d->alert("Quản trị viên không thể thực hiện thao tác này!");
		@$d->redirect("index.php?p=ql-user&a=man&page=".@$_REQUEST['page']."");
	} 
}
?>