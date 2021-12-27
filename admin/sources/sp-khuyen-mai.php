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
	global $d, $items, $paging, $loai,$soluong,$parent;

	
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['seach'])){
                    $seach = addslashes($_GET['seach']);
                    $key = (isset($_GET['key']))? addslashes($_GET['key']):"";
                    if($seach == 'id'){
                            $items = $d->o_fet("select * from #_sp_khuyen_mai where id = '".$key."'");
                    }else{
                            $items = $d->o_fet("select * from #_sp_khuyen_mai where ten like '%".$key."%'");
                    }
		}
		else  $items = $d->o_fet("select * from #_sp_khuyen_mai order by id asc");

		if(isset($_GET['hide'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hide']));
		}
		else $maxR=25;
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
                    $items = $d->o_fet("select * from #_sp_khuyen_mai where id =  '".$id."'");
		}
	}
}

function luudulieu(){
	global $d,$d;
	@include('resize_img.php');
	$image = new SimpleImage();
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
            if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
                $hinhanh = $d->o_fet("select * from #_sp_khuyen_mai where id = '".$id."'");
                foreach ($hinhanh as $ha) {
                    @unlink('../img_data/images/'.$ha['hinh_anh']);
                }
                $data['hinh_anh'] = $file;
            }
            $data['ten'] = $d->clear(addslashes($_POST['ten']));
            $data['gia_tri'] = $d->clear(addslashes($_POST['gia_tri']));
            $data['mo_ta'] = $d->clear(addslashes($_POST['mo_ta']));
            $data['trang_thai'] = isset($_POST['trang_thai']) ? 1 : 0;

            $d->setTable('#_sp_khuyen_mai');
            $d->setWhere('id',$id);
            if($d->update($data)){
                $d->redirect("index.php?p=sp-khuyen-mai&a=man&page=".@$_REQUEST['page']."");
            }
            else{
                $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=sp-khuyen-mai&a=man");
            }
	}
	else
	{

            if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){			
                $data['hinh_anh'] = $file;
            }
            $data['ten'] = $d->clear(addslashes($_POST['ten']));
            $data['gia_tri'] = $d->clear(addslashes($_POST['gia_tri']));
            $data['mo_ta'] = $d->clear(addslashes($_POST['mo_ta']));
            $data['trang_thai'] = isset($_POST['trang_thai']) ? 1 : 0;

            $d->setTable('#_sp_khuyen_mai');
            if($d->insert($data))
            {
                $d->redirect("index.php?p=sp-khuyen-mai&a=man");
            }
            else{
                $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=sp-khuyen-mai&a=man");
            }
	}
}

function xoadulieu(){
	global $d, $d;
	if(isset($_GET['id'])){
            $id =  addslashes($_GET['id']);
            $hinhanh = $d->o_fet("select * from #_sp_khuyen_mai where id = '".$id."'");

            @unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);

            $d->reset();
            $d->setTable('#_sp_khuyen_mai');
            $d->setWhere('id',$id);
            if($d->delete()){
                $d->redirect("index.php?p=sp-khuyen-mai&a=man&page=".@$_REQUEST['page']."");
            }else{
                $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=sp-khuyen-mai&a=man");
            }
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=sp-khuyen-mai&a=man");
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
            $hinhanh = $d->o_fet("select * from #_sp_khuyen_mai where id in ($chuoi)");
            if($d->o_que("delete from #_sp_khuyen_mai where id in ($chuoi)")){
                    //xoa hình ảnh
                    foreach ($hinhanh as $ha) {
                            @unlink('../img_data/images/'.$ha['hinh_anh']);

                    }
                    $d->redirect("index.php?p=sp-khuyen-mai&a=man&page=".@$_REQUEST['page']."");
            }
            else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=sp-khuyen-mai&a=man");
	}else $d->redirect("index.php?p=sp-khuyen-mai&a=man&page=".@$_REQUEST['page']."");
}
?>