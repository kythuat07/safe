<?php @include "sources/editor.php";

	$donhang = $d->o_fet("select * from #_chitietdathang where id_dh = '".$_GET['madh']."'");
	$khachhang = $d->o_fet("select * from #_dathang where id = '".$_GET['madh']."'");

?>

<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Bảo hành</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=danh-sach-don-hang&a=man">Bảo hành</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=danh-sach-don-hang&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
	
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Thông tin bảo hành sản phẩm</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
            
            	<tr>
					<td class="td_left">
						ID Sản phẩm:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" readonly  id="id_sp" name="id_sp" 
                        value="<?php if($_GET['a']=='add'){echo $_GET['madh'];} else echo @$items[0]['id_sp']  ?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Mã đơn hàng:
					</td>
					<td class="td_right">
<input class="input width400 form-control" readonly  id="ma_dh" name="ma_dh" 
value="<?php if($_GET['a']=='add'){echo @$donhang[0]['ma_dh'];} else echo @$items[0]['ma_dh'] ?>"  />
					</td>
				</tr>
                <tr>
					<td class="td_left">
						Nội dung bảo hành:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="noi_dung" id="noi_dung">
						<?=@$items[0]['noi_dung']?></textarea>
						<?php $ckeditor->replace('noi_dung'); ?>
					</td>
				</tr>
                
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu"  class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=danh-sach-don-hang&a=man'" class="btn btn-primary" />
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




<script>

function addText(text,target,title) {
	var str=$(text).val();
	var link=locdau(str);
	$(target).val(link);
	$(title).val(str);
}	
	

</script>

