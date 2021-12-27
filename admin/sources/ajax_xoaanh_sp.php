<?php
	if(!isset($_SESSION)){
		session_start();
	} 
	error_reporting(0);
	include @"../lib/config.php";
	include_once @"../lib/function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	$idsp = addslashes($_POST['idsp']);

	$hinh_anh = $d->o_fet("select * from #_sanpham_hinhanh where id = '".$id."'");
	if($d->o_que("delete from #_sanpham_hinhanh where id = '".$id."'")){
		foreach ($hinh_anh as $ha) {
			@unlink("../../img_data/images/".$ha['hinh_anh']);
		}
	}
	
?>
<?php 
	$hinhanh =  $d->o_fet("select * from #_sanpham_hinhanh where id_sp ='".$idsp."'");
	foreach ($hinhanh as $val) {
?>
<div class="dv-img-ad">
	<img src="../img_data/images/<?php echo @$val['hinh_anh']?>" style="width:70px;height:70px;"/>
	<a style="margin-top:3px; display:block; position:absolute; bottom:5px; padding-left:15px;right: 10px;" href="javascript:xoa_anh_sp('<?=$val['id']?>','<?=$val['id_sp']?>')" onclick="if(!confirm('Xác nhận xóa?')) return false;"> Xóa ảnh </a>
</div>
<?php } ?>