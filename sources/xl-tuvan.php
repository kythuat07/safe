<?php
	if(!isset($_SESSION)){
		session_start();
	}
	error_reporting(0); 
	define('_source','../sources/');
	define('_lib','../admin/lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	include "./smtp/index.php";
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	if(isset($_POST['btn_tuvan']) && !empty($_POST['ho_ten'])){
		$d->reset();
		$data['ho_ten'] = addslashes($_POST['ho_ten']);
		$data['email'] = addslashes($_POST['email']);
		$data['sdt'] = addslashes($_POST['dien_thoai']);
		$data['ngay_hoi'] = date('d-m-Y H:i:s');
		$data['trang_thai'] = '0';

		$d->setTable('#_lienhe');
		$noidung = "<div style='margin-bottom:5px;'>Bạn nhận được tin nhắn từ website: ".URLPATH." : </div>";
		$noidung .= "<div style='margin-bottom:5px;'>Thông tin: </div>";
		$noidung .= "<div style='margin-bottom:5px;'>Họ tên: ".$_POST['ho_ten']."</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Địa chỉ: ".$_POST['dia_chi']."</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Số điện thoại: ".$_POST['so_dien_thoai']."</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Email: ".$_POST['mail']."</div>";
		// $noidung .= "<div style='margin-bottom:5px;'>Tiêu đề: ".$_POST['tieu_de']."</div>";
		$noidung .= "<div style='margin-bottom:5px;    line-height: 1.5;'>Content: ".$_POST['noi_dung']."</div>";
		$noidung .= "<div style='margin-bottom:5px;'>Date: ".date('d-m-Y h:i:s', time())."</div>";
		$noidung .= "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
		if($d->insert($data)) {
			$d->alert("Gửi thành công!");
			$d->location(URLPATH);
		}
		else {
			$d->alert("Error!");
		}
	}
	$d->redirect(URLPATH);
?>
