<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Danh mục</a></li>
  <li class="active"><a href="#">Đăng ký tư vấn</a></li>
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
		<select id="action" onchange="seach(this,'dat-lich')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'dat-lich')" name="action" class="form-control">
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

<form id="form" method="post" action="index.php?p=dat-lich&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input  type="checkbox" name="chk" value="0" class="checkall chk_box" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:15%">Tên</th>
			<th style="width:15%">Email</th>
		    <th style="width:20%">Mức độ cấp thiết</th>
		    <th style="width:10%">Ngày gửi</th>
		    <th style="width:8%">Trạng thái</th>
		    <th style="width:8%">Chi tiết</th>
			<th style="width:8%">Tác vụ</th>



		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><?=($i+1) ?></td>
			<td>
				<?=$items[$i]['name']?>
			</td>
			<td>
				<?=$items[$i]['email']?>
			</td>
			<td>
				<?=$items[$i]['capthiet']?>
			</td>
			<td>
				<?=date("d-m-Y",$items[$i]['day'])?>
			</td>
			<td align="center">
		      	<?php if(@$items[$i]['view'] == 1){ ?>
		        	<font style="color:blue">Đã xem</font>
		        <?php } else { ?>
		       		<font style="color:red">Chưa xem</font>
		        <?php } ?>
			</td>
			 <td align="center">
		        <a href="index.php?p=dat-lich&a=view&id=<?=$items[$i]['id']?>&page=<?=@$_REQUEST['page'];?>">Xem chi tiết</a>
			</td>
			<td>
				<a href="index.php?p=dat-lich&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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