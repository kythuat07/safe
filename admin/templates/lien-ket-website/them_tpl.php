<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Liên kết</a></li>
  <li class="active"><a href="index.php?p=lien-ket-website&a=man">Liên kết website</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa Liên kết website"; else echo "Thêm Liên kết website" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=lien-ket-website&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Tiêu đề:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="title" value="<?php echo @$items[0]['title']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Link liên kết:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="link" value="<?php echo @$items[0]['link']?>"  />
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
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=lien-ket-website&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>