<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Hiển thị</a></li>
  <li class="active"><a href="index.php?p=lien-he&a=man">Liên hệ</a></li>
  <li class="active"><a href="#">Nội dung liên hệ</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=lien-he&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="ar_admin">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Họ tên:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['ho_ten']?>
				</div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Địa chỉ:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['dia_chi']?>
				</div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Email:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['email']?></div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Số điện thoại:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['sdt']?></div>
			</td>
		</tr>

		<tr>
			<td class="td_left">
				Ngày liên hệ:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['ngay_hoi']?></div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Tiêu đề liên hệ:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['tieu_de']?></div>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Nội dung liên hệ:
			</td>
			<td class="td_right">
				<div  style="line-height:1.8;border:1px solid #ccc;padding:5px; border-radius:4px"><?=@$items[0]['noi_dung']?></div>
			</td>
		</tr>
	</tbody>
</table>
</div>
<div class="ar_admin">
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tr>
			<td class="td_left" style="text-align:right">
			</td>
			<td class="td_right">
				<input type="button" value="Quay lại" onclick="javascript:window.location='index.php?p=lien-he&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</table>
</div>
</div>
</form>
</div>