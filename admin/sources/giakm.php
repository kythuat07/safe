<?php
	function vnd($money)
	{
		return @number_format($money,0,'.','.'). ' VNĐ';
	}
	$gia = addslashes($_POST['gia']);
	$khuyenmai = addslashes($_POST['khuyenmai']);
	$return = $gia - $gia *  $khuyenmai / 100;
	$giamgia = $gia *  $khuyenmai / 100;

	// echo "<p style='margin-top:5px;color:red'>Giá gốc: (".vnd($gia).') - Khuyến mãi: ('.$khuyenmai.'%) - Giảm giá: ('.vnd($giamgia).') - Thành tiền: ('.vnd($return).')</p>';
	echo "<p style='margin-top:5px;color:red'>Giá: ".vnd($gia).'</p>';

?>