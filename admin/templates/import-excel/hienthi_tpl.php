<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=import-excel&a=man">Import Excel</a></li>
</ol>

<div class="col-xs-12">
<div class="form-group">
	<div class="btn-group">
		<select id="action" name="action" onclick="form_submit(this)" class="form-control">
			<option selected>Tác vụ</option>
			<option value="delete">Xóa</option>
		</select>
	</div>

	<div class="btn-group">
		<input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
	</div>
	<div class="btn-group">
		<select id="action" onchange="seach(this,'san-pham')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="3">Mã SP</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'san-pham')" name="action" class="form-control">
			<option value="0" selected>Số hiển thị</option>
			<option value="1" <?php if(@$_GET['hienthi'] == 1) echo 'selected'; ?>>15</option>
			<option value="2" <?php if(@$_GET['hienthi'] == 2) echo 'selected'; ?>>25</option>
			<option value="3" <?php if(@$_GET['hienthi'] == 3) echo 'selected'; ?>>50</option>
			<option value="4" <?php if(@$_GET['hienthi'] == 4) echo 'selected'; ?>>75</option>
			<option value="5" <?php if(@$_GET['hienthi'] == 5) echo 'selected'; ?>>100</option>
			<option value="6" <?php if(@$_GET['hienthi'] == 6) echo 'selected'; ?>>200</option>
			<option value="7" <?php if(@$_GET['hienthi'] == 7) echo 'selected'; ?>>300</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="loc_tin(this,'san-pham')" name="action" class="form-control">
			<option value="0" selected>Xem tất cả sản phẩm</option>
			<?=$loai?>
		</select>
	</div>
<a href="index.php?p=import-excel&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Import Excel</a>&nbsp;
	<a href="index.php?p=san-pham&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>

</div>

<form id="form" method="post" action="index.php?p=san-pham&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input  type="checkbox" name="chk" value="0" class=" chk_box checkall" id="check_all"></th>
			<th style="width:5%">STT</th>
			<!-- <th style="width:8%">Mã SP</th> -->
			<th style="width:20%; text-align:left">Danh mục</th>
			<th style="width:35%; text-align:left">Tiêu đề</th>
			
			<th style="width:8%">Ảnh</th>
			<!-- <th style="width:8%">SP mới</th> -->
			<!-- <th style="width:8%">Bán chạy</th> -->
			<th style="width:8%">SP mới</th>
			<th style="width:8%">Hiển thị</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><input type="number" value="<?=$items[$i]['so_thu_tu']?>" class="a_stt" data-table="#_sanpham" data-col="so_thu_tu" data-id="<?=$items[$i]['id']?>" /></td>
			
			<!-- <td><?=$items[$i]['ma_sp']?></td> -->
			<td style="text-align:left">
				<?php 
					$query = $d->simple_fetch("select * from #_category where id={$items[$i]['id_loai']}");					
					$str = ""; for($k=0;$k<$query['level'];$k++) { $str.="= "; }	
					echo $str.$query['ten_vn'] 
				
				?>
			</td>
			<td style="text-align:left">
				<a href="index.php?p=san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?></a>
				<!--br/>
				<a href="index.php?p=san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_us']?></a>
				<br/>
				<a href="index.php?p=san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_ch']?></a-->
			</td>
			</td>
			<td>
				<a href="index.php?p=san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=($items[$i]['hinh_anh'] <> '')?"<img src='".URLPATH."thumb.php?src=".URLPATH."img_data/images/".$items[$i]['hinh_anh']."&w=70&h=50'>":""; ?></a>
			</td>

			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','sp_moi','<?=$items[$i]['id']?>')" <?php if($items[$i]['sp_moi'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','sp_hot','<?=$items[$i]['id']?>')" <?php if($items[$i]['sp_hot'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','tieu_bieu','<?=$items[$i]['id']?>')" <?php if($items[$i]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>

			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_sanpham','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=san-pham&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</form>
</div>
<div class="pagination">
  <?php echo @$paging['paging']?>
</div>
<script type="text/javascript">
function loc_tin (obj,tenp) {
	var show = $(obj).val();
	window.location.href = "index.php?p="+tenp+"&a=man&id_loai="+show;
}
</script>