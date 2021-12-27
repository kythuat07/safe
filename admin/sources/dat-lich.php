<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/hienthi";
		break;
	case "view":
		showdulieu();
		$template = @$_REQUEST['p']."/view";
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
	global $d, $items, $paging;
	if($_REQUEST['a'] == 'man'){
		
		$items = $d->o_fet("select * from #_datlich  order by id desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=135;
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
			$items = $d->o_fet("select * from #_datlich where id =  '".$id."'");
			
			$data['view']=1;
			$d->reset();
			$d->setTable('#_datlich');
			$d->setWhere('id',$id);
			$d->update($data);
		}
			
	}
}


function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_datlich where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

		$d->reset();
		$d->setTable('#_datlich');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=dat-lich&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=dat-lich&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=dat-lich&a=man");
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
		$hinhanh = $d->o_fet("select * from #_datlich where id in ($chuoi)");
		if($d->o_que("delete from #_datlich where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			$d->redirect("index.php?p=dat-lich&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=dat-lich&a=man");
	}else $d->redirect("index.php?p=dat-lich&a=man&page=".@$_REQUEST['page']."");
}
?>