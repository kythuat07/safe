<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Hiển thị</a></li>
  <li class="active"><a href="#">Liên hệ</a></li>
</ol>

<div class="col-xs-12">
<div class="form-group tac-vu">
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
		<select id="action" onchange="seach(this,'lien-he')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'lien-he')" name="action" class="form-control">
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
	<a href="index.php?p=lien-he&a=sua-noi-dung" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Nội dung hiển thị</a>
</div>

<form id="form" method="post" action="index.php?p=lien-he&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input  type="checkbox" name="chk" value="0" class="checkall chk_box" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th>Họ tên</th>
                        <th style="width:10%">Tiêu đề</th>
		    <th style="width:25%">Thông tin</th>
		    <!-- <th style="width:10%">Tiêu đề</th> -->
		    <th style="width:8%">Ngày hỏi</th>
		    <th style="width:8%">Trạng thái</th>
                    <th style="width:8%">File đính kèm</th>
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
				<?=$items[$i]['ho_ten']?>
			</td>
                        <td>
                            <b><?=$items[$i]['tieu_de']?></b>
			</td>
			<td>
				<?=($items[$i]['email'] <> '') ?"Email: ".$items[$i]['email']."</br>":"" ?>
				<?=($items[$i]['sdt'] <> '') ?"Số điện thoại:: ".$items[$i]['sdt']."</br>":"" ?>
				<?=($items[$i]['dia_chi'] <> '') ?"Địa chỉ: ".$items[$i]['dia_chi']."</br>":"" ?>
			</td>
			<td>
				<?=$items[$i]['ngay_hoi']?>
			</td>
			<td align="center">
		      	<?php if(@$items[$i]['trang_thai'] == 1){ ?>
		        	<font style="color:blue">Đã xem</font>
		        <?php } else { ?>
		       		<font style="color:red">Chưa xem</font>
		        <?php } ?>
			</td>
                        <td>
                            <?php if($items[$i]['file']!=""){ ?> <a href="<?=URLPATH?>img_data/file<?=$items[$i]['file']?>" target="_blank">Xem file</a><?php } ?>
			</td>
			 <td align="center">
		        <a href="index.php?p=lien-he&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_REQUEST['page'];?>">Xem chi tiết</a>
			</td>
			<td>
				<a href="index.php?p=lien-he&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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