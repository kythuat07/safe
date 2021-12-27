<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=giaodien&a=man">Giao diện</a></li>
</ol>

<div class="col-xs-12">
<div class="form-group">
	<div class="btn-group">
		<select id="action" name="action" onclick="form_submit(this)" class="form-control">
			<option selected>Tác vụ</option>
			<option value="delete">Xóa</option>
		</select>
	</div>

	
	<a href="index.php?p=giaodien&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=giaodien&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:4%">STT</th>
			<th style="width:35%;text-align: left;">Giao diện</th>
			<th style="width:8%">IMG</th>
			<th style="width:7%">Hiển thị</th>
			<th style="width:7%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
                            <?php if($items[$i]['id'] !=10){ ?>
                            <input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
                            <?php } ?>
                        </td>
			<td><?=$i+1 ?></td>

			<td style="text-align: left;">
				<a href="index.php?p=giaodien&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?></a>
			</td>
			<td>
				<a href="index.php?p=giaodien&a=delete_image&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
				<?=($items[$i]['hinh_anh'] <> '')?"<img src='".URLPATH."thumb.php?src=".URLPATH."img_data/images/".$items[$i]['hinh_anh']."&w=70&h=50'>":""; ?>
			</a>
			</td>
		
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_setting','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
                            <a href="index.php?p=giaodien&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>&loaitin=<?=@$_GET['loaitin']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                            <?php if($items[$i]['id'] !=10){ ?>
                            <a href="index.php?p=giaodien&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>&loaitin=<?=@$_GET['loaitin']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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
