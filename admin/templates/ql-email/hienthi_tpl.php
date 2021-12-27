<ol class="breadcrumb">
  <li><a href="<?=URLPATH."admin" ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=URLPATH."admin" ?>">Hiển thị</a></li>
  <li class="active"><a href="<?=URLPATH."admin/index.php?p=ql-email&a=man" ?>">Danh sách email</a></li>
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
		<select id="action" onchange="seach(this,'<?=$_GET['p'] ?>')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'<?=$_GET['p'] ?>')" name="action" class="form-control">
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

<form id="form" method="post" action="index.php?p=<?=$_GET['p'] ?>&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:5%"><input  type="checkbox" name="chk" value="0" class="checkall chk_box" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="text-align:left">Email</th>
			<th style="text-align:left">Số điện thoại</th>
		    <th style="width:15%">Ngày đăng ký</th>
		    <th style="width:10%">Tác vụ</th>

		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><?=($i+1) ?></td>
			<td style="text-align:left">
				<?=$items[$i]['email']?>
			</td>
			<td style="text-align:left">
				<?=$items[$i]['dien_thoai']?>
			</td>
			<td>
				<?=date('d-m-Y h:i:s', $items[$i]['ngay_gui']) ?>
			</td>
			<td>
				<a href="index.php?p=<?=$_GET['p'] ?>&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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