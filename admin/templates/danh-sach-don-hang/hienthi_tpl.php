<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href=".">Đơn hàng</a></li>
  <li class="active"><a href="#">Danh sách đơn hàng</a></li>
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
		<select id="action" onchange="seach(this,'danh-sach-don-hang')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'danh-sach-don-hang')" name="action" class="form-control">
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

<form id="form" method="post" action="index.php?p=danh-sach-don-hang&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:2%"><input type="checkbox" name="chk" value="0" class="chk_box checkall" id="check_all"></th>
			<th style="width:2%">STT</th>
		    <th style="width:10%;">Mã đơn hàng</th>
		    <th style="width:15%;">Tên khách hàng</th>
		    <th style="width:9%;">Ngày đặt</th>
		    <!-- <th style="width:9%;">Ngày giao</th> -->
		    <!-- <th style="width:15%;">Thời gian giao hàng</th> -->
		    <!-- <th style="width:14%;">Hình thức thanh toán</th> -->
		    <th style="width:9%;">Trạng thái</th>
		    <th style="width:9%;">Xem chi tiết</th>
			<th style="width:8%">Tác vụ</th>
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>" class="chk_box ">
			</td>
			<td><?=($i+1)?></td>
			<td>
				<?php
					$id_dh = $d->o_fet("select * from #_chitietdathang where id_dh = '".$items[$i]['id']."'");
					echo @$id_dh[0]['ma_dh'];
		      	?>
			</td>
			<td>
				<?=$items[$i]['ho_ten']?>
			</td>
			<td>
				<?=date('d-m-Y H:i:s',$items[$i]['ngay_dat_hang']) ?>
			</td>
			<!-- <td>
				<?php
					// @$ngh = explode('/', $items[$i]['ngay_giao_hang']);
					// echo @$ngh[1].'-'.@$ngh[0].'-'. @$ngh[2];
					echo $items[$i]['ngay_giao_hang'];
				?>
			</td> -->
			<!-- <td>
				<?php
				echo $items[$i]['thoi_gian_giao_hang'];
			?>
			</td>
			<td>
		      	<?php
					$_hinhthucthanhtoan = $d->o_sel("ten_vn","#_hinhthucthanhtoan","id ='".$items[$i]['hinh_thuc_thanh_toan']."'");
					echo $_hinhthucthanhtoan[0]['ten_vn'];
				?>
			</td> -->
			<td>
	      	<?php if(@$items[$i]['tinh_trang']==0){?>
		        <a style="color:rgb(57, 170, 4)" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=1&id=<?php echo $items[$i]['id']?>&page=<?php echo @$_REQUEST['page'];?>">Chưa giao</a>
		        <?php }else if(@$items[$i]['tinh_trang']==1){ ?>
		        <a style="color:blue" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=2&id=<?php echo $items[$i]['id']?>&page=<?php echo @$_REQUEST['page'];?>">Đang giao</a>
		        <?php }else{?>
		        <a style="color:red" href="index.php?p=danh-sach-don-hang&a=man&b=tinh_trang&TT=2&id=<?php echo $items[$i]['id']?>&page=<?php echo @$_REQUEST['page'];?>">Đã giao</a>
		        <?php } ?>
			</td>
			<td>
	      		<a href="index.php?p=danh-sach-don-hang&a=view&id=<?php echo $items[$i]['id']?>">Xem chi tiết</a>
	      	</td>
			<td>
				<a href="index.php?p=danh-sach-don-hang&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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