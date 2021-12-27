<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Liên kết</a></li>
  <li class="active"><a href="#">Hỗ trợ trực tuyến</a></li>
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
		<select id="action" onchange="seach(this,'ho-tro-truc-tuyen')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'ho-tro-truc-tuyen')" name="action" class="form-control">
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
	<a href="index.php?p=ho-tro-truc-tuyen&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=ho-tro-truc-tuyen&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box checkall" type="checkbox" name="chk" value="0"  id="check_all"></th>
			<th style="width:5%">STT</th>
			<!-- <th style="width:16%">Nhóm hỗ trợ</th> -->
			<th style="width:20%">Tên</th>
            <!-- <th style="width:10%">Hình ảnh</th> -->
		    <th style="width:10%">Zalo</th>
		    <th style="width:10%">Skype</th>
		    <th style="width:10%">Số điện thoại</th>
			<!-- <th style="width:8%">Footer</th> -->
			<th style="width:8%">Hiển thị</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
                            <?php if($items[$i]['id'] != 18){ ?>
                            <input type="checkbox"  class="chk_box" name="chk_child[]" value="<?=$items[$i]['id']?>">
                            <?php } ?>
                        </td>
			<td><?=$i+1 ?></td>
			
			
			<!-- <td>
				<?php //$text=$d->simple_fetch("select * from #_nhomhotro where id={$items[$i]['id_loai']}"); echo  $text['title']?>
			</td> -->
			<td>
				<a href="index.php?p=ho-tro-truc-tuyen&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger"><?=$items[$i]['ten_vn']?></a>
			</td>
            <!-- <td>
				<?php if($items[$i]['hinh_anh'] <> ''){ ?>
					<a href="index.php?p=ho-tro-truc-tuyen&a=delete_image&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
						<img src="../img_data/images/<?=$items[$i]['hinh_anh'] ?>" style="width:50px">
					</a>
				<?php } ?>
			</td> -->
			<td>
				<?=$items[$i]['zalo']?>
			</td>
			<td>
				<?=$items[$i]['skype']?>
			</td>
			<td>
				<?=$items[$i]['sdt']?>
			</td>
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_hotro','footer','<?=$items[$i]['id']?>')" <?php if($items[$i]['footer'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_hotro','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
                            <a href="index.php?p=ho-tro-truc-tuyen&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                            <?php if($items[$i]['id'] != 18){ ?>
                            <a href="index.php?p=ho-tro-truc-tuyen&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                            <?php } ?>
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