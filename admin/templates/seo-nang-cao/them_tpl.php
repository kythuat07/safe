<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Hiển thị</a></li>
  <li class="active"><a href="index.php?p=<?=@$_REQUEST['p']?>&a=man">Giới thiệu</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_REQUEST['p']?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Nội dung file robots:
			</td>
			<td class="td_right">
				<textarea class="input form-control" style="width:100%;min-height:200px;border:1px solid #ccc;padding:5px; border-radius:4px" name="robots"><?= @$robots ?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Up file sitemap.xml:
			</td>
			<td class="td_right">
				<input type="file" name="file" />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Nội dung file sitemap:
			</td>
			<td class="td_right">
				<textarea class="input form-control" style="width:100%;min-height:200px;border:1px solid #ccc;padding:5px; border-radius:4px" name=""><?=@$sitemap?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Cập nhật site map tự động:
			</td>
			<td class="td_right">
				<input type="checkbox" value="1" name="sm_sp" id="sm_sp" style="width:15px; height:15px;"> <label for="sm_sp" style="  position: absolute;  margin-top: 4px;">Auto</label><br/>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Google Analytics:
			</td>
			<td class="td_right">
				<textarea class="input form-control" placeholder="Nhập mã xác minh Google Analytics..." rows="8" onclick="this.placeholder=''" onblur="this.placeholder='Nhập mã xác minh Google Analytics...'" name="g_a"><?=$item[0]['g_a']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Google Webmaster Tools:
			</td>
			<td class="td_right">
				<input type="file" name="file_2" />
			</td>
		</tr>
		<tr>
			<td class="td_left" style="text-align:right">
				
			</td>
			<td class="td_right">
				<div class="luu-thoat">
					<input type="submit" value="Lưu" class="btn btn-primary" />
					<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-primary" />
				</div>
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<style type="text/css">
	.luu-thoat{ margin-left: -4px; margin-top: 10px; }
</style>