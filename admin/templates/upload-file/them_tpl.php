<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="./index.php">Danh mục</a></li>
  <li class="active"><a href="./index.php?p=upload-file&a=man">Upload file</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa file"; else echo "Thêm file" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=upload-file&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="ar_admin">
<div class="title_thongtinchung">Thông tin chung</div>
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Tên:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="ten_vn" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Tải file:
			</td>
			<td class="td_right">
				<input type="file" name="file" class="input width400 form-control"/>
			</td>
		</tr>
	</tbody>
</table>
</div>
<div class="ar_admin">
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tr>
			<td class="td_left">
				Tác vụ: 
			</td>
			<td class="td_right">
				<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
			</td>
		</tr>
		<tr>
			<td class="td_left">
			</td>
			<td class="td_right">
				<input type="submit" value="Lưu" class="btn btn-primary"/>
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=upload-file&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</table>
</div>
</form>
</div>