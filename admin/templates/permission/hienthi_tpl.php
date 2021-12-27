<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>">Cấu hình</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=permission&a=man"> Danh sách quyền</a></li>
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
		<select id="action" onchange="seach(this,'permission')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'permission')" name="action" class="form-control">
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
	<a href="index.php?p=permission&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a><br/>
</div>

<form id="form" method="post" action="index.php?p=permission&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box checkall" type="checkbox" name="chk" value="0" id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:48%; text-align:left">Tên</th>
			<th style="width:15%; text-align:left">Page</th>
			<th style="width:8%">Hiển thị</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $a = 0; $count=count($items); for($i=0; $i<$count; $i++){ $a++; ?> 
		<tr>
			<td>
				<input  class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><input type="number" value="<?=$items[$i]['stt']?>" class="a_stt" data-table="#_permission_group" data-col="stt" data-id="<?=$items[$i]['id']?>" /></td>
            
			<td style="text-align:left">
<a href="index.php?p=permission&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['title']?></a>

			</td>
            
			<td style="text-align:left">
				<?=$items[$i]['page']?>
			</td>


			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_permission_group','hide','<?=$items[$i]['id']?>')" <?php if($items[$i]['hide'] == 1) echo 'checked="checked"'; ?>>
			</td>
            
			<td>
				<a href="index.php?p=permission&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=permission&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<?php
			$child_items = $d->o_fet("select * from #_permission_group where id_loai ='".$items[$i]['id']."' order by stt asc");
			$count_child=count($child_items);
		   	for($j=0; $j<$count_child; $j++){ ?>
		   		<tr>
					<td>
						<input  class="chk_box" type="checkbox" name="chk_child[]" value="<?=$child_items[$j]['id']?>">
					</td>
					<td><input type="number" value="<?=$child_items[$j]['stt']?>" class="a_stt" data-table="#_permission_group" data-col="stt" data-id="<?=$child_items[$j]['id']?>" /></td>
		            
					<td style="text-align:left">
						<a href="index.php?p=permission&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>">|___<?=$child_items[$j]['title']?></a>
					</td>
					<td style="text-align:left">
						<?=$child_items[$j]['page']?>
					</td>
					<td>
						<input class="chk_box" type="checkbox" onclick="on_check(this,'#_permission_group','hide','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['hide'] == 1) echo 'checked="checked"'; ?>>
					</td>
		            <td>
						<a href="index.php?p=permission&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
						<a href="index.php?p=permission&a=delete&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
					</td>
				</tr>
		    <?php } ?>	
		<?php } ?>
	</tbody>
</table>
</form>
</div>
<div class="pagination">
  <?php echo @$paging['paging']?>
</div>