<?php

	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	
	
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION["user_hash"]))
    {
        header("location: login.php");die;
    }
    @define('_template','/templates/');
    @define('_source','/sources/');
    @define('_lib','/lib/');
	
	
	
    @include "lib/config.php";
    @include "lib/function.php";
	
    global $d;
    $d = new func_index($config['database']);
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    @include "lib/file_router_admin.php";
	
    
	// if(@$_SESSION['quyen']==2 && ( $_REQUEST['p']!='san-pham' && $_REQUEST['p']!='ql-user' && $_REQUEST['p']!='danh-sach-don-hang' && $_REQUEST['p']!='')) {
	// 	$d->redirect("index.php");
	// }
	
?>

    <?php @include('templates/header_tpl.php'); ?>
    <?php @include('templates/navbar_tpl.php'); ?>
    <div class="clearfix" style="min-height: 471px;">
        <div id="sidebar-bg"></div>
        <div id="sidebar" role="navigation">
            <?php @include('templates/sidebar_tpl.php'); ?>
       </div>
        <div id="main" style="min-height: 471px;">
            <?php @include "templates/".$template."_tpl.php"; ?>
        </div>
    </div>

<?php @include('templates/footer_tpl.php'); ?>
<?php $d->disconnect() ?>