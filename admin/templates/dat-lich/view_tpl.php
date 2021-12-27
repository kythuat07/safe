
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Danh mục</a></li>
  <li class="active"><a href="index.php?p=dat-lich&a=man">Lịch hẹn</a></li>
  <li class="active"><a href="#">Xem</a></li>
</ol>
<div class="col-xs-12">

<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Họ tên:
			</td>
			<td class="td_right">
				<?=$items[0]['name']?>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Đơn vị công tác:
			</td>
			<td class="td_right">
				<?=$items[0]['donvi']?>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Chuyên môn:
			</td>
			<td class="td_right">
				<?=$items[0]['chuyenmon']?>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Email:
			</td>
			<td class="td_right">
				<?=$items[0]['email']?>
			</td>
		</tr>

		<tr>
			<td class="td_left">
				Số điện thoại:
			</td>
			<td class="td_right">
				<?=$items[0]['phone']?>
			</td>
		</tr>

		<tr>
			<td class="td_left">
				Mô tả ý tưởng:
			</td>
			<td class="td_right">
				<?=$items[0]['mota']?>
			</td>
		</tr>
		
		<tr>
			<td class="td_left">
				Mức độ hoàn thiện:
			</td>
			<td class="td_right">
				<?php $mucdo=$d->simple_fetch("select * from #_extra where id={$items[0]['mucdo']}"); echo $mucdo['title_vn']?>
				
			</td>
		</tr>

		<tr>
			<td class="td_left">
				Vai trò:
			</td>
			<td class="td_right">
				<?=($items[0]['khac']!='') ? $items[0]['khac']."<br>" : ''?>
				<?php $aid=explode(",",$items[0]['vaitro']);
					foreach($aid as $id) {
						$name=$d->simple_fetch("select * from #_extra where id=$id");
						echo "- ".$name['title_vn']."<br/>";
					}
				?>
			</td>
		</tr>		
		
		<tr>
			<td class="td_left">
				Nội dung muốn tư vấn:
			</td>
			<td class="td_right">
				<?=$items[0]['tuvan']?>
			</td>
		</tr>
		
		<tr>
			<td class="td_left">
				Mức độ cấp thiết:
			</td>
			<td class="td_right">
				<?=$items[0]['capthiet']?>
			</td>
		</tr>
		

		
		<tr>
			<td class="td_left" style="text-align:right">

			</td>
			<td class="td_right">
				<input type="button" value="Quay lại" onclick="javascript:window.location='index.php?p=dat-lich&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>

</div>