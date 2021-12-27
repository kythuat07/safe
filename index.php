<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	ob_start();
	error_reporting(0);
	define('_source','./sources/');
	define('_lib','./admin/lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	global $d;
	global $lang;
	$d = new func_index($config['database']);
	date_default_timezone_set('Asia/Krasnoyarsk');

	if ($_REQUEST['lang']) {
		$_SESSION['lang'] = $_REQUEST['lang'];
		header("Location:".URLPATH);
	}
	elseif(!isset($_SESSION['lang'])) {
		$_SESSION['lang']='vn';
	}
	$lang = $_SESSION['lang'];
	$website = $d->showthongtin();
	include _source."website.php";
	include _source."lang.php";
	include _source."language_".$_SESSION['lang'].".php";
	include _source."file_router_index.php";
	$information_1 = $d->simple_fetch("select * from #_gallery where id = 103 limit 0,1");
	$information = $d->simple_fetch("select * from #_thongtin limit 0,1");
	$url_page=$d->fullAddress();
	unset($_SESSION['nav']);
	$d->getActive($com,$_SESSION['lang']);
        
	//include _source."xl_dangnhap.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" class="metaview">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="format-detection" content="telephone=no">
<base href="<?=URLPATH?>" />
<?php 
if(empty($_GET['com']) || $source == 'index'){
echo '<link rel="canonical" href="'.URLPATH.'" />';
}
else{
$exp_cal = explode("&", $d->fullAddress());
$exp_cal = explode("?", $exp_cal[0]);
echo '<link rel="canonical" href="'.$exp_cal[0].'" />';
}
?>

<link href="<?= $favicon ?>" rel="shortcut icon" type="image/x-icon" />
<?php include _source."module/seo.php" ?>

<?php include _source."templates/css.php" ?>

</head>
<body>
    <?php // echo $source; //include 'limit.php'; ?>
    <?php include _source."header.php"; ?>
    <?php include _source.$source.".php"; ?>
    <?php include _source."footer.php";?>
    <?php //include _source."alert.php" ?>
    <?php include _source."templates/js.php" ?>
</body>
</html>
<?php $d->disconnect() ?>