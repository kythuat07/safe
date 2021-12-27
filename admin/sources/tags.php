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
function show_menu_tags_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
{
      foreach ($menus as $val)
      {
          if ($val['id_loai'] == $parrent)
          {
             $chuoi .= $val['id'].',';
              show_menu_tags_hd($menus, $val['id'],$chuoi);
          }
      }
      return $chuoi;
}
function showdulieu(){
	global $d, $items, $paging, $loai, $soluong;
	$loai = $d->array_category(0,'',$_GET['loaitin'],2);
	if($_REQUEST['a'] == 'man'){
	
		 if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_tags where id = '".$key."'");
			}else{
				$key = $d->bodautv($key);
				$items = $d->o_fet("select * from #_tags where alias_vn like '%$key%' order by so_thu_tu asc, ngay_dang desc, id desc");
			}
		}
		else $items = $d->o_fet("select * from #_tags order by id desc");


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
			$items = $d->o_fet("select * from #_tags where id =  '".$id."'");
			$loai = $d->array_category(0,'',$items[0]['id_loai'],2);
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

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){

			$hinhanh = $d->o_fet("select * from #_tags where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);
			}
			$data['hinh_anh'] = $file;
		}
		$data['id_loai'] = addslashes($_POST['id_loai']);

		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));
		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));
		$data['noi_dung_vn'] = $d->clear(addslashes($_POST['noi_dung_vn']));
		$data['noi_dung_us'] = $d->clear(addslashes($_POST['noi_dung_us']));
		$data['noi_dung_ch'] = $d->clear(addslashes($_POST['noi_dung_ch']));
		
		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if($d->checkLink($data['alias_vn'],"alias_vn",$id ) && $data['alias_vn']!='') {
			$data['alias_vn'].="-".rand(10,999);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if($d->checkLink($data['alias_us'],"alias_us",$id ) && $data['alias_us']!='') {
			$data['alias_us'].="-".rand(10,999);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(10,999);
		}
		
		
		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);
		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select ten_vn, id from #_tags where ten_vn = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		$dataInsert = array(
		   			'id' => '',
		   			'ten_vn' => trim($value),
		   			'alias' => $d->bodautv($value),
		   		);
		   		$d->setTable('#_tags');
		   		if($idTags = $d->insert($dataInsert)){
		   			$id_tag  .= $idTags.",";
		   		}
		   }else{
	   			$id_tag  .= @$kiemtra_tags[0]['id'].",";
	   		}
		}
		$data['tags'] = trim($id_tag,",");
		//end tags
		$data['des'] = addslashes($_POST['des']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		//$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		if(!empty($_POST['hen_ngay'])){
			$str_ngay = $_POST['hen_ngay'].' '.$_POST['hen_gio'].':0:0';
			$edate=strtotime($_POST['hen_ngay']); 
			$edate=date("Y-m-d",$edate);
			$hen_ngay_dang = strtotime($str_ngay);
			$data['hen_ngay'] =$edate;
			$data['hen_gio'] = addslashes($_POST['hen_gio']);
			$data['hen_ngay_dang'] = $hen_ngay_dang;
		}

		$d->setTable('#_tags');
		$d->setWhere('id',$id);
		if($d->update($data)){
			
			/////up hinh
	    	for ($i=1; $i <= 15; $i++) { 
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			$file_name=$d->fns_Rand_digit(0,9,12);
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['hinh_anh'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_baiviet'] = $id;
						$d->reset();
						$d->setTable('#_baiviet_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}

	    	// SITEMAP
	    	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset
				    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				    xsi:schemaLocation="
				            http://www.sitemaps.org/schemas/sitemap/0.9
				            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
					<url>
				       <loc>'.@URLPATH.'</loc>
				       <priority>1</priority>
				  	</url>';

	

	
			$tintuc = $d->o_fet("select * from #_tags where hien_thi = 1 order by id desc");
			foreach ($tintuc as $item) {
				if(!empty($item['alias_vn'])){
					$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';
				}

			}


			$category = $d->o_fet("select * from #_category where hien_thi = 1 order by so_thu_tu asc,id desc");
			foreach ($category as $item) {

				$sitemap .= '
					<url>
					 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
					 <priority>'.((float)rand(500, 800)/1000).'</priority>
					</url>';	

			}


			$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 order by so_thu_tu asc, id desc");
			foreach ($sanpham as $item) {
				

				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}



			$sitemap .= '
			</urlset>';

			$file = fopen("../sitemap.xml","w+");
			fwrite($file, $sitemap);
			fclose($file);

			
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{

			$d->alert("Cập nhật dữ liệu bị lỗi!");
			$d->redirect("Cập nhật dữ liệu bị lỗi", "index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
	else
	{


		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			
			$data['hinh_anh'] = $file;
		}
		
		$data['id_loai'] = addslashes($_POST['id_loai']);
		
		$data['ten_vn'] = $d->clear(addslashes($_POST['ten_vn']));
		$data['ten_us'] = $d->clear(addslashes($_POST['ten_us']));
		$data['ten_ch'] = $d->clear(addslashes($_POST['ten_ch']));
		$data['mo_ta_vn'] = $d->clear(addslashes($_POST['mo_ta_vn']));
		$data['mo_ta_us'] = $d->clear(addslashes($_POST['mo_ta_us']));
		$data['mo_ta_ch'] = $d->clear(addslashes($_POST['mo_ta_ch']));
		$data['noi_dung_vn'] = $d->clear(addslashes($_POST['noi_dung_vn']));
		$data['noi_dung_us'] = $d->clear(addslashes($_POST['noi_dung_us']));
		$data['noi_dung_ch'] = $d->clear(addslashes($_POST['noi_dung_ch']));
		
		$data['alias_vn'] = $d->clear(addslashes($_POST['alias_vn']));
		if($d->checkLink($data['alias_vn'],"alias_vn",$id ) && $data['alias_vn']!='') {
			$data['alias_vn'].="-".rand(10,999);
		}

		$data['alias_us'] = $d->clear(addslashes($_POST['alias_us']));
		if($d->checkLink($data['alias_us'],"alias_us",$id ) && $data['alias_us']!='') {
			$data['alias_us'].="-".rand(10,999);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(10,999);
		}
		
		
		$data['title_vn'] = $d->clear(addslashes($_POST['title_vn']));
		$data['title_us'] = $d->clear(addslashes($_POST['title_us']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);

		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select ten_vn, id from #_tags where ten_vn = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		$dataInsert = array(
		   			'id' => '',
		   			'ten_vn' => trim($value),
		   			'alias' => $d->bodautv($value),
		   		);
		   		$d->setTable('#_tags');
		   		if($idTags = $d->insert($dataInsert)){
		   			$id_tag  .= $idTags.",";
		   		}
		   		
		   }else{
	   			$id_tag  .= @$kiemtra_tags[0]['id'].",";
	   		}
		}
		$data['tags'] = trim($id_tag,",");
		//end tags
		$data['des'] = addslashes($_POST['des']);
		$data['ngay_dang'] = time();
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		//$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		if(!empty($_POST['hen_ngay'])){
			$str_ngay = $_POST['hen_ngay'].' '.$_POST['hen_gio'].':0:0';
			$edate=strtotime($_POST['hen_ngay']); 
			$edate=date("Y-m-d",$edate);
			$hen_ngay_dang = strtotime($str_ngay);
			$data['hen_ngay'] =$edate;
			$data['hen_gio'] = addslashes($_POST['hen_gio']);
			$data['hen_ngay_dang'] = $hen_ngay_dang;
		}
		// var_dump($data['hen_ngay']); die;
		$d->setTable('#_tags');
		if($idsp = $d->insert($data))
		{
			/////up hinh
			
	    	for ($i=1; $i <= 15; $i++) { 
	    		$file_name=$d->fns_Rand_digit(0,9,12);
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['hinh_anh'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_baiviet'] = $idsp;
						$d->reset();
						$d->setTable('#_baiviet_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}	

	    	// SITEMAP
	    	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset
				    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				    xsi:schemaLocation="
				            http://www.sitemaps.org/schemas/sitemap/0.9
				            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
					<url>
				       <loc>'.@URLPATH.'</loc>
				       <priority>1</priority>
				  	</url>';

	

	
			$tintuc = $d->o_fet("select * from #_tags where hien_thi = 1 order by id desc");
			foreach ($tintuc as $item) {
				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}


			$category = $d->o_fet("select * from #_category where hien_thi = 1 order by so_thu_tu asc,id desc");
			foreach ($category as $item) {

				$sitemap .= '
					<url>
					 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
					 <priority>'.((float)rand(500, 800)/1000).'</priority>
					</url>';	

			}


			$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 order by so_thu_tu asc, id desc");
			foreach ($sanpham as $item) {
				

				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vn'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}



			$sitemap .= '
			</urlset>';

			$file = fopen("../sitemap.xml","w+");
			fwrite($file, $sitemap);
			fclose($file);
					
			$d->redirect("index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Thêm dữ liệu bị lỗi!");
			$d->redirect("Thêm dữ liệu bị lỗi", "index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_tags where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['hinh_anh']);
		
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet = '".$id."'");
		$d->o_que("delete from #_baiviet_hinhanh where id_baiviet = '".$id."'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/'.$hact['hinh_anh']);
		}
		// end		
		$d->reset();
		$d->setTable('#_tags');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}else{
			$d->alert("Xóa dữ liệu bị lỗi!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
		}
	}else {
		$d->alert("Không nhận được dữ liệu!");
		$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
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
		$hinhanh = $d->o_fet("select * from #_tags where id in ($chuoi)");
		if($d->o_que("delete from #_tags where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['hinh_anh']);

			}
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet in ($chuoi)");
			$d->o_que("delete from #_baiviet_hinhanh where id_baiviet in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['hinh_anh']);
			}			
			
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Không nhận được dữ liệu!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man&loaitin=".@$_GET['loaitin']);
		} 
	}else $d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
}
?>