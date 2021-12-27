<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>index.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=ql-binhluan&a=man">QL binh luận</a></li>
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
		<select id="action" onchange="seach(this,'ql-binhluan')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'ql-binhluan')" name="action" class="form-control">
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
</div>

<form id="form" method="post" action="index.php?p=ql-binhluan&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:2%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:3%">STT</th>
			<th style="width:16%; text-align:left">Thông tin</th>
			<th style="width:35%; text-align:left">Nội dung</th>
			<th style="width:10%; text-align:left">Ngày đăng</th>
			<th style="width:18%; text-align:left">Mục BL</th>
			<th style="width:8%">Hiển thị</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $a = 0; $count=count($items); for($i=0; $i<$count; $i++){ $a++; ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><?=$a ?> </td>
			
			<td style=" text-align:left; color:red">
				<?=$items[$i]['ho_ten'] ?><br/>
				<?=$items[$i]['email'] ?><br/>
			</td>
			<td style=" text-align:left">
				<?=$items[$i]['noi_dung'] ?>
			</td>
			<td style=" text-align:left">
				<?=date('d-m-Y h:i:s', $items[$i]['ngay_dang']) ?>
			</td>
			<td style=" text-align:left">
				<?php 
					$tintuc = $d->o_sel("*","#_tintuc","id = '".$items[$i]['id_tintuc']."'");
					
					echo $tintuc[0]['ten_vn']." [<a target='_blank' href='".URLPATH."tintuc/".$tintuc[0]['alias_vn'].".html'>URL</a>]";
				?>
			</td>

			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_binhluan','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=ql-binhluan&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=ql-binhluan&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- // cap 1 -->
		<?php
			  $child_items = $d->o_fet("select * from #_binhluan where id_tintuc ='".$items[$i]['id']."' order by ngay_dang asc");

    		  $count_child=count($child_items);
    		  for($j=0; $j<$count_child; $j++){ $a++;
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items[$j]['id']?>">
			</td>
			<td>
				<?=$a ?>
			</td>
			<td style=" text-align:left;color: blue">
				<?=$child_items[$j]['ho_ten'] ?><br/>
				<?=$child_items[$j]['email'] ?><br/>
			</td>
			<td style=" text-align:left">
				<?=$child_items[$j]['noi_dung'] ?>
			</td>
			<td style=" text-align:left">
				<?=date('d-m-Y h:i:s', $child_items[$j]['ngay_dang']) ?>
			</td>
			<td style=" text-align:left">
				--
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_binhluan','hien_thi','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=ql-binhluan&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=ql-binhluan&a=delete&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		
		<?php } ?>
		<!-- end ccap 1 -->
		<?php } ?>
	</tbody>
</table>
</form>
</div>
<div class="pagination">
  <?php echo @$paging['paging']?>
</div>
