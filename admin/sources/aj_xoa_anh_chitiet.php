<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	include @"../lib/config.php";
	include_once @"../lib/function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	$idsp = addslashes($_POST['idsp']);
	$id_mau = addslashes($_POST['id_mau']);
	$anh = addslashes($_POST['anh']);
	$anh_thumb = addslashes($_POST['anh_thumb']);

	



	
	if($d->o_que("delete from #_sanpham_hinhanh where id = '".$id."'")){
		@unlink("../../img_data/images/".$anh);
		@unlink("../../img_data/images/".$anh_thumb);
	}

	$hinh_anh = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".$idsp."' and id_mau = '".$id_mau."' order by id desc");
	foreach ($hinh_anh as $ha) {
?>

<a onclick="if(!confirm('Xác nhận xóa ?')) return false;" href="javascript:xoa_img_chitiet('<?=$ha['id'] ?>','<?=$ha['hinh_anh'] ?>','<?=$ha['hinh_anh_thumb'] ?>','<?=$idsp ?>','<?=$id_mau ?>')"><img src="../img_data/images/<?=$ha['hinh_anh_thumb'] ?>"></a>
<?php } ?>