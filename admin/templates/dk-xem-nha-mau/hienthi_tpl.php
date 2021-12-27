<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=dk-xem-nha-mau&a=man">Đăng ký xem nhà mẫu</a></li>
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
		<select id="action" onchange="seach(this,'dk-xem-nha-mau')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'dk-xem-nha-mau')" name="action" class="form-control">
			<option value="0" selected>Số hiển thị</option>
			<option value="1">15</option>
			<option value="2">25</option>
			<option value="3">50</option>
			<option value="4">75</option>
			<option value="5">100</option>
			<option value="6">200</option>
			<option value="7">300</option>
		</select>
	</div>
</div>

<form id="form" method="post" action="index.php?p=dk-xem-nha-mau&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:15%; text-align:left">Họ tên</th>
			<th style="width:15%; text-align:left">Email</th>
			<th style="width:15%; text-align:left">Số điện thoại</th>
			<th style="width:15%; text-align:left">Địa chỉ</th>
			
			<th style="width:16%">Ngày đăng ký</th>
			<th style="width:8%">Đã xem</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><?=$i+1 ?></td>

			<td style="text-align:left">
				<?=$items[$i]['ten_vn']?>
			</td>
			<td style="text-align:left">
				<?=$items[$i]['email']?>
			</td>
			<td style="text-align:left">
				<?=$items[$i]['so_dien_thoai']?>
			</td>
			<td style="text-align:left">
				<?=$items[$i]['dia_chi']?>
			</td>
			<td >
				<?=date('d-m-Y H:i:s',$items[$i]['ngay_dang']) ?>
			</td>
			
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_dknhamau','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=dk-xem-nha-mau&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>&loaitin=<?=@$_GET['loaitin']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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
	window.location.href = "index.php?p="+tenp+"&a=man&loaitin="+show;
}
</script>