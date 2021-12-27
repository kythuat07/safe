<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Danh mục</a></li>
  <li class="active"><a href="index.php?p=<?=@$_GET['p'] ?>&a=man">Tham khảo ý kiến</a></li>
</ol>

<?php 
	function laysophieu($id_ch, $d){
		$sophieu = $d->o_fet("select id from #_kh_bc where id_ch = '".$id_ch."'");
		return count($sophieu);
	}

	function layso_pt($id_loai,$id, $d){
		$sophieu = $d->o_fet("select id from #_kh_bc where id_ch = '".$id."'");

		$ds_id = $d->o_fet("select id from #_cauhoi_detail where id_loai = '".$id_loai."'");
		$id_l = "";
		foreach ($ds_id as $vl) {
			$id_l .= $vl['id'].",";
		}
		$id_l = trim($id_l,",");
		$tongso_phieu = $d->o_fet("select id from #_kh_bc where id_ch in (".$id_l.")");
		return (int)(count($sophieu)/count($tongso_phieu)*100);
	}

?>
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
		<select id="action" onchange="seach(this,'<?=@$_GET['p'] ?>')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'<?=@$_GET['p'] ?>')" name="action" class="form-control">
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
	<a href="index.php?p=<?=@$_GET['p'] ?>&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=<?=@$_GET['p'] ?>&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:2%"><input class="chk_box" type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
			<th style="width:2%">STT</th>
			<th style="width:20%; text-align:left">Câu hỏi</th>
			<th style="width:50%">Câu trả lời</th>
			<th style="width:10%">Ngày đăng</th>
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
			<td><?=$i+1 ?></td>

			<td style="text-align:left">
				<a href="index.php?p=<?=@$_GET['p'] ?>&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?>
				</a><br/>
				<a href="index.php?p=<?=@$_GET['p'] ?>&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_us']?>
				</a>
			</td>

			<td style="text-align:left">
				<?php 
					$cautraloi = $d->o_fet("select * from #_cauhoi_detail where id_loai = '".$items[$i]['id']."' order by id asc");
					
				?>
				<table style="  width: 100%;" class="table table-bordered table-hover">
					<tr>
						<th style="width:20px">STT</th>
						<th style="text-align:left">Câu trả lời</th>
						<th style="width:50px">Phiếu</th>
						<th style="width:50px">Tỉ lệ</th>
					</tr>
					
						<?php 
							$js = 0; foreach ($cautraloi as $ctl) { $js++;
						?>
					<tr>
						<td style="width:20px"><?=$js ?></td>
						<td style="text-align:left"><?=$ctl['ten_vn'] ?><br/><?=$ctl['ten_us'] ?></td>
						<td style="width:50px"><?=laysophieu($ctl['id'], $d) ?></td>
						<td style="width:50px"><?=layso_pt($ctl['id_loai'], $ctl['id'], $d)?>%</td>
					</tr>
						<?php } ?>
					
				</table>

			</td>
			<td><?=$items[$i]['ngay_dang']?></td>

			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_cauhoi','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=<?=@$_GET['p'] ?>&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=<?=@$_GET['p'] ?>&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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