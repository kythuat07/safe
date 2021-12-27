<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Hiển thị</a></li>
  <li class="active"><a href="index.php?p=<?=@$_REQUEST['p']?>&a=man">Seo cơ bản</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_REQUEST['p']?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Title (vn):
			</td>
			<td class="td_right">
				<input type="text" class="input width400 form-control"  name="title_vn" value="<?=@$item[0]['title_vn']?>">
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Keyword (vn):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control"  style="height:70px" name="keyword_vn" id=""><?=@$item[0]['keyword_vn']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Description (vn):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control"  style="height:70px" name="description_vn" id=""><?=@$item[0]['description_vn']?></textarea>
			</td>
		</tr>
		<!-- <tr>
			<td class="td_left">
				Title (us):
			</td>
			<td class="td_right">
				<input type="text" class="input width400 form-control"  name="title_us" value="<?=@$item[0]['title_us']?>">
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Keyword (us):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control"  style="height:70px" name="keyword_us" id=""><?=@$item[0]['keyword_us']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Description (us):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control"  style="height:70px" name="description_us" id=""><?=@$item[0]['description_us']?></textarea>
			</td>
		</tr> -->
		<tr>
			<td class="td_left" style="text-align:right">
				<input type="submit" value="Lưu" class="btn btn-primary" />
			</td>
			<td class="td_right">
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>