<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>index.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=category&a=man">Loại danh mục</a></li>
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
		<select id="action" onchange="seach(this,'category')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	        $('input#search').keypress(function (e) {
	         var key = this.value;
	           if (e.which == 13) {
	             window.location = "index.php?p=category&a=man&seach=name&key="+key;
	           }
	        });        
	    }); 
	</script>
	<div class="btn-group">
		<select id="action" onchange="show(this,'category')" name="action" class="form-control">
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
	<a href="index.php?p=category&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=category&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:3%"><input class="chk_box checkall" type="checkbox" name="chk" value="0"  id="check_all"></th>
			<th style="width:5%">STT</th>
			<th style="width:40%; text-align:left">Danh mục</th>
			<th style="width:8%">Hình ảnh</th>
			<th style="width:8%">Module</th>
			<th style="width:8%">Trang chủ</th>
			<th style="width:8%">Danh mục</th>
			<!-- <th style="width:8%">Top Menu</th> -->
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
			<td>
<input type="number" value="<?=$items[$i]['so_thu_tu']?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?=$items[$i]['id']?>" />
            </td>
			
			<td style=" text-align:left">
				<a href="index.php?p=category&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?></a> 
				<!--br/>
				 <a href="index.php?p=category&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_us']?></a>
				 <br/>
				 <a href="index.php?p=category&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_ch']?></a-->
			</td>
			<td>
				<?php if($items[$i]['hinh_anh'] <> ''){ ?>
					<a href="index.php?p=category&a=delete_image&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
						<img src="../img_data/images/<?=$items[$i]['hinh_anh'] ?>" style="width:50px">
					</a>
				<?php } ?>
			</td>
			<td><?php $module=$d->simple_fetch("select * from #_module where id={$items[$i]['module']}"); echo $module['title']?></td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?=$items[$i]['id']?>')" <?php if($items[$i]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','tieu_bieu','<?=$items[$i]['id']?>')" <?php if($items[$i]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?=$items[$i]['id']?>')" <?php if($items[$i]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			
			<!-- HIỂN THỊ -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=category&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=category&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- // cap 1 -->
		<?php
			  $child_items = $d->o_fet("select * from #_category where id_loai ='".$items[$i]['id']."' order by so_thu_tu asc");

    		  $count_child=count($child_items);
    		  for($j=0; $j<$count_child; $j++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items[$j]['id']?>">
			</td>
			<td>
                <input type="number" value="<?=$child_items[$j]['so_thu_tu']?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?=$child_items[$j]['id']?>" />
			</td>
			<td style="text-align:left">
				<a style="padding-left:15px" href="index.php?p=category&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>">|____ <?=$child_items[$j]['ten_vn']?></a>
				<!--br/>
				<a style="padding-left:50px" href="index.php?p=category&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items[$j]['ten_us']?></a>
				<br/>
				<a style="padding-left:50px" href="index.php?p=category&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items[$j]['ten_ch']?></a-->
			</td>
			<td>
				<?php if($child_items[$j]['hinh_anh'] <> ''){ ?>
					<a href="index.php?p=category&a=delete_image&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
						<img src="../img_data/images/<?=$child_items[$j]['hinh_anh'] ?>" style="width:50px">
					</a>
				<?php } ?>
			</td>
			<td><?php $module=$d->simple_fetch("select * from #_module where id={$child_items[$j]['module']}"); echo $module['title']?></td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','tieu_bieu','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?=$child_items[$j]['id']?>')" <?php if($child_items[$j]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=category&a=edit&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=category&a=delete&id=<?=$child_items[$j]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- cap 2 -->
		<?php
			   $child_items_2 = $d->o_fet("select * from #_category where id_loai ='".$child_items[$j]['id']."' order by so_thu_tu asc");
    		  $count_child_2=count($child_items_2);
    		  for($k=0; $k<$count_child_2; $k++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items_2[$k]['id']?>">
			</td>
			<td>
				<input type="number" value="<?=$child_items_2[$k]['so_thu_tu']?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?=$child_items_2[$k]['id']?>" />
			</td>
			<td style="text-align:left">
				 <a style="padding-left:60px" href="index.php?p=category&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>">|____ <?=$child_items_2[$k]['ten_vn']?></a>
				<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_2[$k]['ten_us']?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_2[$k]['ten_ch']?></a-->
			</td>
			<td>
				<?php if($child_items_2[$k]['hinh_anh'] <> ''){ ?>
					<a href="index.php?p=category&a=delete_image&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa">
						<img src="../img_data/images/<?=$child_items_2[$k]['hinh_anh'] ?>" style="width:50px">
					</a>
				<?php } ?>
			</td>
			<td><?php $module=$d->simple_fetch("select * from #_module where id={$child_items_2[$k]['module']}"); echo $module['title']?></td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','tieu_bieu','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?=$child_items_2[$k]['id']?>')" <?php if($child_items_2[$k]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=category&a=edit&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=category&a=delete&id=<?=$child_items_2[$k]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
		<!-- cap 3 -->
		<?php
			   $child_items_3 = $d->o_fet("select * from #_category where id_loai ='".$child_items_2[$k]['id']."' order by so_thu_tu asc");
    		  $count_child_3=count($child_items_3);
    		  for($m=0; $m<$count_child_3; $m++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items_3[$m]['id']?>">
			</td>
			<td>
				<input type="number" value="<?=$child_items_3[$m]['so_thu_tu']?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?=$child_items_3[$m]['id']?>" />
			</td>
			<td style="text-align:left">
				 <a style="padding-left:120px" href="index.php?p=category&a=edit&id=<?=$child_items_3[$m]['id']?>&page=<?=@$_GET['page']?>">|____<?=$child_items_3[$m]['ten_vn']?></a>
				<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_3[$m]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_3[$m]['ten_us']?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_3[$m]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_3[$m]['ten_ch']?></a-->
			</td>
			<td>
				<?php if($child_items_3[$m]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?=$child_items_3[$m]['hinh_anh'] ?>" style="width:50px">
				<?php } ?>
			</td>
			<td><?php $module=$d->simple_fetch("select * from #_module where id={$child_items_3[$m]['module']}"); echo $module['title']?></td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?=$child_items_3[$m]['id']?>')" <?php if($child_items_3[$m]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','tieu_bieu','<?=$child_items_3[$m]['id']?>')" <?php if($child_items_3[$m]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<!-- <td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','is_top','<?=$child_items_3[$m]['id']?>')" <?php if($child_items_3[$m]['is_top'] == 1) echo 'checked="checked"'; ?>>
			</td> -->
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?=$child_items_3[$m]['id']?>')" <?php if($child_items_3[$m]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=category&a=edit&id=<?=$child_items_3[$m]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=category&a=delete&id=<?=$child_items_3[$m]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
        
		<!-- cap 4 -->
		<?php
			   $child_items_4 = $d->o_fet("select * from #_category where id_loai ='".$child_items_3[$m]['id']."' order by so_thu_tu asc");
    		  $count_child_4=count($child_items_4);
    		  for($l=0; $l<$count_child_4; $l++){
    	?>
    	<tr>
			<td>
				<input type="checkbox" class="chk_box" name="chk_child[]" value="<?=$child_items_4[$l]['id']?>">
			</td>
			<td>
				<input type="number" value="<?=$child_items_4[$l]['so_thu_tu']?>" class="a_stt" data-table="#_category" data-col="so_thu_tu" data-id="<?=$child_items_4[$l]['id']?>" />
			</td>
			<td style="text-align:left">
				 <a style="padding-left:160px" href="index.php?p=category&a=edit&id=<?=$child_items_4[$l]['id']?>&page=<?=@$_GET['page']?>">|____<?=$child_items_4[$l]['ten_vn']?></a>
				<!--br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_4[$l]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_4[$l]['ten_us']?></a>
				<br/>
				<a style="  padding-left: 95px;" href="index.php?p=category&a=edit&id=<?=$child_items_4[$l]['id']?>&page=<?=@$_GET['page']?>"><?=$child_items_4[$l]['ten_ch']?></a-->
			</td>
			<td>
				<?php if($child_items_4[$l]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?=$child_items_3[$l]['hinh_anh'] ?>" style="width:50px">
				<?php } ?>
			</td>
			<td><?php $module=$d->simple_fetch("select * from #_module where id={$child_items_3[$m]['module']}"); echo $module['title']?></td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','menu','<?=$child_items_4[$l]['id']?>')" <?php if($child_items_4[$l]['menu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','tieu_bieu','<?=$child_items_4[$l]['id']?>')" <?php if($child_items_4[$l]['tieu_bieu'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_category','hien_thi','<?=$child_items_4[$l]['id']?>')" <?php if($child_items_4[$l]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=category&a=edit&id=<?=$child_items_4[$l]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=category&a=delete&id=<?=$child_items_4[$l]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>

        <?php } ?>
		<!-- end cap 4 -->
        <?php } ?>
		<!-- end cap 3 -->
		<?php } ?>
		<!-- end cap 2 -->
		<?php } ?>
		<!-- end cap 1 -->
		<?php } ?>
	</tbody>
</table>
</form>
</div>
<div class="pagination">
  <?php echo @$paging['paging']?>
</div>
