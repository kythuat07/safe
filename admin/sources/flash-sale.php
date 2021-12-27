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

function show_menu_tintuc_hd($menus = array(), $parrent = 0 ,&$chuoi = '')

{

      foreach ($menus as $val)

      {

          if ($val['id_loai'] == $parrent)

          {

             $chuoi .= $val['id'].',';

              show_menu_tintuc_hd($menus, $val['id'],$chuoi);

          }

      }

      return $chuoi;

}

function showdulieu(){

	global $d, $items, $paging, $loai, $soluong;

	$loai = $d->array_category('1098');

	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['seach'])){

			$seach = addslashes($_GET['seach']);

			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";

			if($seach == 'id'){

				$items = $d->o_fet("select * from #_flash_sale where id = '".$key."'");

			}else{

				$key = $d->bodautv($key);

				$items = $d->o_fet("select * from #_flash_sale where alias_vn like '%$key%' order by so_thu_tu asc, ngay_dang desc, id desc");

			}

		}

		else $items = $d->o_fet("select * from #_flash_sale order by star_time desc, id desc");





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

			$items = $d->o_fet("select * from #_flash_sale where id =  '".$id ."'");

			$loai = $d->array_category(1098,'',$items[0]['id_category']);

		}

	}

}



function luudulieu(){

	global $d;

	//@include('resize_img.php');

	//$image = new SimpleImage();



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
            $data['id_category']    =   addslashes($_POST['id_category']);
            $data['star_time']      =   $d->clear(addslashes($_POST['star_time']));
            $data['end_time']       =   $d->clear(addslashes($_POST['end_time']));
            $data['ngay_tao']       =   time();
            $data['status']         =   isset($_POST['status']) ? 1 : 0;
            $d->setTable('#_flash_sale');
            $d->setWhere('id',$id);
            $d->update($data);
            $d->redirect("index.php?p=flash-sale&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
	}

	else

	{
            if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){			
                $data['hinh_anh'] = $file;
            }
            $data['id_category']    =   addslashes($_POST['id_category']);
            $data['star_time']      =   $d->clear(addslashes($_POST['star_time']));
            $data['end_time']       =   $d->clear(addslashes($_POST['end_time']));
            $data['ngay_tao']       =   time();
            $data['status']         =   isset($_POST['status']) ? 1 : 0;
            //print_r($data);
            //exit();
            $d->setTable('#_flash_sale');
            $idsp = $d->insert($data);
            $d->redirect("index.php?p=flash-sale&a=man&loaitin=".@$_GET['loaitin']);
	}

}



function xoadulieu(){

	global $d;

	if(isset($_GET['id'])){

		$id =  addslashes($_GET['id']);

		$d->reset();

		$d->setTable('#_flash_sale');

		$d->setWhere('id',$id);

		if($d->delete()){

			$d->redirect("index.php?p=flash-sale&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);

		}else{

			$d->alert("Xóa dữ liệu bị lỗi!");

			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=flash-sale&a=man&loaitin=".@$_GET['loaitin']);

		}

	}else {

		$d->alert("Không nhận được dữ liệu!");

		$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=sale-code&a=man&loaitin=".@$_GET['loaitin']);

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

		//lay danh sách idsp theo chuoi

		if($d->o_que("delete from #_flash_sale where id in ($chuoi)")){

                    $d->redirect("index.php?p=flash-sale&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);

		}

		else{

			$d->alert("Không nhận được dữ liệu!");

			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=flash-sale&a=man&loaitin=".@$_GET['loaitin']);

		} 

	}else $d->redirect("index.php?p=flash-sale&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);

}

?>