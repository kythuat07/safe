<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Liên kết</a></li>
  <li class="active"><a href="index.php?p=lien-ket-doi-tac&a=man">Liên kết đối tác</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=lien-ket-doi-tac&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<?php if(isset($_GET['id'])){ ?>
		<tr>
			<td class="td_left">
				Hình hiện tại:
			</td>
			<td class="td_right">
				<img src="../img_data/images/<?php echo @$items[0]['hinh_anh']?>"  width="120" alt="NO PHOTO" />
			</td>
		</tr>
		<?php }?>
		<tr>
			<td class="td_left">
				Hình ảnh:
			</td>
			<td class="td_right">
				 <input type="file" name="file" />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Liên kết:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="lien_ket" value="<?php echo @$items[0]['lien_ket']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Số thứ tự
			</td>
			<td class="td_right">
				<input type="text" name="so_thu_tu" value="<?php if(isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Hiển thị:
			</td>
			<td class="td_right">
				<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])){	if(@$items[0]['hien_thi']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
			</td>
		</tr>
		<tr>
			<td class="td_left" style="text-align:right">
				<input type="submit" value="Lưu" class="btn btn-primary" />
			</td>
			<td class="td_right">
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=lien-ket-doi-tac&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>