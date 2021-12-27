<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Danh mục</a></li>
  <li class="active"><a href="index.php?p=question&a=man">question</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa câu hỏi"; else echo "Thêm câu hỏi" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=question&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">

	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				
				
				<tr>
					<td class="td_left">
						Tên:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="ten" value="<?php echo $items[0]['ten']?>"  />
					</td>
				</tr>

				
				<tr>
					<td class="td_left">
						Câu hỏi:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="cau_hoi" id="cau_hoi"><?=@$items[0]['cau_hoi']?></textarea>
						<?php $ckeditor->replace('cau_hoi'); ?>
					</td>
				</tr>
				
				<tr>
					<td class="td_left">
						Trả lời:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="tra_loi" id="tra_loi"><?=@$items[0]['tra_loi']?></textarea>
						<?php $ckeditor->replace('tra_loi'); ?>
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
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=question&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
		<!-- end -->
		</div>

		
		
	</div>
</div>

</form>
</div>