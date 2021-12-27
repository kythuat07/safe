<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d,$robots,$sitemap,$item;

	$item = $d->o_fet("select * from #_seo where id=1 ");

	$robots ='';
	$file = fopen("../robots.txt", "r") or exit("Không mở được file!");
	while(!feof($file))
	{
	  	$robots .= fgets($file);
	}
	fclose($file);
	$file = fopen("../sitemap.xml", "r") or exit("Không mở được file!");
	while(!feof($file))
	{
	  	$sitemap .= fgets($file);
	}
	fclose($file);
	

}

function luudulieu(){
	global $d;
	// xóa trước
	$robots = addslashes($_POST['robots']);

	$file = fopen("../robots.txt","w+");
	fwrite($file, $robots);
	fclose($file);

	@$d->upload_image("file", 'xml', '../','sitemap');
	$d->alert("Cập nhật dữ liệu thành công");
	
	if(isset($_POST['sm_sp'])){
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

	

	
		$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 order by id desc");
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
	}




	@$d->upload_image("file_2", '', '../','');

	

	$data['g_a'] = addslashes($_POST['g_a']);
	$d->reset();
	$d->setTable('#_seo');
	$d->setWhere('id',1);
	if($d->update($data)){
		echo $d->redirect("index.php?p=seo-nang-cao&a=man");
	}else{
		echo $d->redirect("index.php?p=seo-nang-cao&a=man");
	}

}
?>