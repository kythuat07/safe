<?php	
	if($source=="tin-tuc-detail") {
		$seo=$d->simple_fetch("select * from #_tintuc where alias_{$_SESSION['lang']} = '$com' ");
		$seo_title=$seo['title_'.$_SESSION['lang']];
		$seo_keyword=$seo['keyword'];
		$seo_description=$seo['des'];
	}
	else if($source=="san-pham-detail") {
		$seo=$d->simple_fetch("select * from #_sanpham where alias_{$_SESSION['lang']} = '$com' ");
		$seo_title=$seo['title_'.$_SESSION['lang']];
		$seo_keyword=$seo['keyword'];
		$seo_description=$seo['des'];
	}
	else if($source=="tin-tuc" || $source=="gallery" || $source=="san-pham" || $source=="lien-he" || $source=="video" || $source=="gio-hang") {
		$seo=$d->simple_fetch("select * from #_category where alias_{$_SESSION['lang']} = '$com' ");
		$seo_title=$seo['title_'.$_SESSION['lang']];
		$seo_keyword=$seo['keyword'];
		$seo_description=$seo['des'];
		if($com=="tags") {
			$query = $d->simple_fetch("select * from #_tags where alias = '$alias'");
			$seo_title = "Từ khóa: ".$query['ten_vn'];
			$seo_keyword = "Từ khóa: ".$query['ten_vn'];
			$seo_description = "Từ khóa: ".$query['ten_vn'];
		}
	}
	else {
		$seo=$d->simple_fetch("select * from #_seo where id=1");
		$seo_title=$seo['title_'.$_SESSION['lang']];
		$seo_keyword=$seo['keyword_'.$_SESSION['lang']];
		$seo_description=$seo['description_'.$_SESSION['lang']];
	}
	
	//hinh anh
	if($source == 'tin-tuc'){
		$img_canol = $d->o_sel("hinh_anh","#_category","alias_{$_SESSION['lang']} = '".addslashes($com)."'");
	}
	if($source == 'san-pham'){
		$img_canol = $d->o_sel("hinh_anh","#_category","alias_{$_SESSION['lang']} = '".addslashes($com)."'");
	}
	if($source == 'tin-tuc-detail'){
		$img_canol = $d->o_sel("hinh_anh","#_tintuc","alias_{$_SESSION['lang']} = '".addslashes($com)."'");
	}
	if($source == 'san-pham-detail'){
		$img_canol = $d->o_sel("hinh_anh","#_sanpham","alias_{$_SESSION['lang']} = '".addslashes($com)."'");
	}
	if(!empty($img_canol)) $img_cn = URLPATH."img_data/images/".$img_canol[0]['hinh_anh'];
	else $img_cn = $logo;	
	
?>
<title><?=$seo_title?></title>
<meta name="keywords" content="<?=$seo_keyword?>" />
<meta name="description" content="<?=$seo_description?>" />
<!-- google -->
<meta itemprop="name" content="<?=$seo_title ?>">
<meta itemprop="description" content="<?=$seo_description ?>">
<meta itemprop="image" content="<?=$img_cn ?>">
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="<?=$seo_title ?>">
<meta name="twitter:description" content="<?=$seo_description ?>">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image:src" content="<?=$img_cn ?>">
<!-- facebook -->
<meta property="og:title" content="<?=$seo_title ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?=$d->fullAddress() ?>" />
<meta property="og:image" content="<?=$img_cn ?>" />
<meta property="og:description" content="<?=$seo_description ?>" />
<meta property="og:site_name" content="hutoglobal" />
<meta property="fb:page_id" content="<?= $info_map['id_facebook'] ?>" />
<?php 
$seo2=$d->simple_fetch("select * from #_seo where id=1");
?>
<?= $seo2['g_a'] ?>


