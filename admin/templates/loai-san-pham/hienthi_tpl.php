<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>index.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=loai-san-pham&a=man">Loại sản phẩm</a></li>
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
		<select id="action" onchange="seach(this,'loai-san-pham')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'loai-san-pham')" name="action" class="form-control">
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
	<a href="index.php?p=loai-san-pham&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=loai-san-pham&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:68%; text-align:left">Danh mục</th>
			<!-- <th style="width:8%">Hình ảnh</th> -->
			<!-- <th style="width:8%">Menu</th> -->
			<th style="width:8%">Trang chủ</th>
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
			<td><?=$items[$i]['so_thu_tu']?></td>
			
			<td style=" text-align:left">
				<a href="index.php?p=loai-san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?></a> 
				<br/>
				 <a href="index.php?p=loai-san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_us']?></a>
			</td>
			<!-- <td>
				<?php if($items[$i]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?=$items[$i]['hinh_anh'] ?>" style="width:50px">
				<?php } ?>
			</td> -->
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','menu','<?=$items[$i]['id']?>')" <?php if($items[$i]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','tieu_bieu','<?=$items[$i]['id']?>')" <?php if($items[$i]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=loai-san-pham&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=loai-san-pham&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- // cap 1 -->
		<?php
			  $child_items = $d->o_fet("select * from #_loaisanpham where id_loai ='".$items[$i]['id']."' order by so_thu_tu asc");

    		  $count_child=count($child_items);
    		  for($j=0; $j<$count_child; $j++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items[$j]['id']?>">
			</td>
			<td>
				<?=$child_items[$j]['so_thu_tu']?>
			</td>
			<td style="text-align:left">
				<a style="padding-left:15px" href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>">|____ <?=$child_items[$j]['ten_vn']?></a>
				<br/>
				<a style="padding-left:50px" href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items[$j]['ten_us']?></a>
			</td>
			<!-- <td>
				<?php if($child_items[$j]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?=$child_items[$j]['hinh_anh'] ?>" style="width:50px">
				<?php } ?>
			</td> -->
			<!-- <td> -->
				<!-- <input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','menu','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['menu'] == 1) echo 'checked="checked"'; ?>> -->
			<!-- </td> -->
			<td>--
				<!-- <input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','tieu_bieu','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>> -->
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','hien_thi','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=loai-san-pham&a=delete&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- cap 2 -->
		<?php
			   $child_items_2 = $d->o_fet("select * from #_loaisanpham where id_loai ='".$child_items[$j]['id']."' order by so_thu_tu asc");
    		  $count_child_2=count($child_items_2);
    		  for($k=0; $k<$count_child_2; $k++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items_2[$k]['id']?>">
			</td>
			<td>
				<?=$child_items_2[$k]['so_thu_tu']?>
			</td>
			<td style="text-align:left">
				 <a style="padding-left:60px" href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>">|____ <?=$child_items_2[$k]['ten_vn']?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_2[$k]['ten_us']?></a>
			</td>
			<!-- <td>
				<?php if($child_items_2[$k]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?=$child_items_2[$k]['hinh_anh'] ?>" style="width:50px">
				<?php } ?>
			</td> -->
			<!-- <td> -->
				<!-- <input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','menu','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['menu'] == 1) echo 'checked="checked"'; ?>> -->
			<!-- </td> -->
			<td>--
				<!-- <input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','tieu_bieu','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>> -->
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_loaisanpham','hien_thi','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=loai-san-pham&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=loai-san-pham&a=delete&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<?php } ?>
		<!-- end cap 2 -->
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
