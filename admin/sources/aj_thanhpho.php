<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	
	$thanhpho = $d->o_sel("*","#_quan","hien_thi = 1 and id_loai = '".$id."'","so_thu_tu asc");
	echo '<option value="">Chọn Quận - Huyện</option>';
	foreach ($thanhpho as $tp) {
?>
<option value="<?=$tp['id'] ?>"><?=$tp['ten_vn'] ?></option>
<?php } ?>