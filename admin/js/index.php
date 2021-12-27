<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
    ob_start();
    error_reporting(0);
	define('_source','./sources/');
	define('_lib','./admin/lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
    global $d;
	$d = new func_index($config['database']);


	@include _source."file_router_index.php";

    $_SESSION['lang'] = "vn";

    include _source."language_".$_SESSION['lang'].".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?=URLPATH?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="./img/icon.png" rel="shortcut icon" type="image/x-icon" />
	<?php @include _source."seo.php" ?>

	<link href="./css/style.css" rel="stylesheet">
	<link href="./css/reponsive.css" rel="stylesheet">

	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<link href="./css/owl.carousel.css" rel="stylesheet">
    <link href="./css/owl.theme.css" rel="stylesheet">

    <!-- toptip -->
    <link rel="stylesheet" type="text/css" href="./css/tooltips.css" />
	<script type="text/javascript" src="./css/tooltips.js"></script>
    <!-- //menu -->
	<link rel="stylesheet" type="text/css" href="./menu/ddsmoothmenu.css" />
	<link rel="stylesheet" type="text/css" href="./menu/ddsmoothmenu-v.css" />
	<script type="text/javascript" src="./menu/ddsmoothmenu.js"></script>
	<script type="text/javascript" src="./menu/common.js"></script>
    <!-- end -->
</head>
<body>
	<div style="  z-index: 99999;  position: fixed;  width: 100%;  height: 32px;  line-height: 30px;  ">
		<section class="container" style=" background-color: #6C6C6C;  border-bottom: 1px solid rgba(0, 0, 0, 0.3);   padding: 0px;  color: #fff;  text-align: center;  font-size: 16px;box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.49); font-weight:700">
			Liên hệ: 0908 246 494
			<?php if(!isset($_GET['p']) || $_GET['p'] == 'index'){ ?><h1 style="display:none">Đồ chơi xe ô tô</h1> <?php } ?>
		</section>	
	</div>
	<div id="container" style="padding-top:30px">
		<header class="nav_fix ">
			<!-- //menu -->
			<section class="container">
				<div class="row">
				<?php @include "./sources/header.php" ?>
				</div>
			</section>	
			<!-- end -->
		</header>

		<div id="main" role="main">
			<section class="container">

				<?php @include _source."menu.php" ?>
				<?php @include "./sources/n-slider.php" ?>
				<div style="margin:7px">
					<?php @include _source.$source.".php" ?>
				</div>
				<footer>
			 		 <section class="container">
			 		 	<?php //include "./sources/like_share_left_right.php" ?>
			 		 	<?php @include "./sources/footer.php" ?>
					</section>
			 	</footer>
			</section>
		</div>

	 	
	</div>
</body>
</html>

