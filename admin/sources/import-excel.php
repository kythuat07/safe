
<?php

if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/hienthi";
		break;
	case "add":
		$extra=getExtra();
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "edit":
		$extra=getExtra();
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

function getExtra() {
	global $d;
	$str['thuonghieu'] = $d->o_fet("select * from #_extra where type = 0 and hide=1 order by stt asc,id desc");
	$str['model'] = $d->o_fet("select * from #_extra where type = 1 and hide=1 order by stt asc,id desc");
	$str['nam'] = $d->o_fet("select * from #_extra where type = 2 and hide=1 order by stt asc,id desc");
	return $str;
}

function showdulieu(){
	global $d, $items, $paging,$loai;
	$loai = $d->array_category(0,'',$_GET['id_loai'],3);
	
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['id_loai']) && $_GET['id_loai'] <> ''){
			
			if($_GET['id_loai'] == 0){
				$items = $d->o_fet("select * from #_sanpham where style=0 order by so_thu_tu asc, id desc");
			}else{
				$id_loai = $_GET['id_loai'].$d->findIdSub($_GET['id_loai']);	
			    $items = $d->o_fet("select * from #_sanpham where FIND_IN_SET(id_loai,'$id_loai') <> 0 and style=0 order by so_thu_tu asc, id desc");
			}
		}
		else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_sanpham where id = '".$key."' and style=0");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_sanpham where ten_vn like '%".$key."%' and style=0");
			}else{
				$items = $d->o_fet("select * from #_sanpham where ma_sp like '%".$key."%' and style=0");
			}
		}
		else $items = $d->o_fet("select * from #_sanpham where style=0 order by ngay_dang desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=20;
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
			$items = $d->o_fet("select * from #_sanpham where id =  '".$id."'");
			$loai = $d->array_category(0,'',$items[0]['id_loai'],3);
		}
	}

}


?>