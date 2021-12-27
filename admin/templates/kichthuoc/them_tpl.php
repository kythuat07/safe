<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=kichthuoc&a=man">Kích thước</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=kichthuoc&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
	
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Kích thước:
					</td>
					<td class="td_right">
						<input class="input width400 form-control"  name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Số thứ tự:
					</td>
					<td class="td_right">
						<input type="text" name="so_thu_tu" value="<?php if(isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Tác vụ: 
					</td>
					<td class="td_right">


						<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu"  class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=kichthuoc&a=man'" class="btn btn-primary" />
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