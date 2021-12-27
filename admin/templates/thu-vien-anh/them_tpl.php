<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="./index.php">Liên kết</a></li>
  <li class="active"><a href="./index.php?p=thu-vien-anh&a=man">Thư viện ảnh</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa ảnh"; else echo "Thêm ảnh" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=thu-vien-anh&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Loại:
			</td>
			<td class="td_right">
				<select class="input width400 form-control" name="id_loai" onchange="aj_select_anh(this)">
					<option value="1" <?php if($items[0]['id_loai'] == 1) echo 'selected="selected"'; ?>>Hình ảnh</option>
					<option value="2" <?php if($items[0]['id_loai'] == 2) echo 'selected="selected"'; ?>>Video</option>
				</select>
			</td>
		</tr>
		<tr >
			<td class="td_left">
				Tên ảnh/video:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
			</td>
		</tr>
		<?php if(isset($_GET['id'])){ ?>
		<tr class="show_1" style="<?php if($items[0]['id_loai'] == 2) echo "display:none" ?>">
			<td class="td_left">
				Hình hiện tại:
			</td>
			<td class="td_right">
				<img src="../img_data/images/<?php echo @$items[0]['hinh_anh']?>"  width="120" alt="NO PHOTO" /><br />
			</td>
		</tr>
		<?php }?>
		<tr class="show_1" style="<?php if($items[0]['id_loai'] == 2) echo "display:none" ?>">
			<td class="td_left">
				Hình ảnh:
			</td>
			<td class="td_right">
				<input type="file" name="file" />
			</td>
		</tr>
		
		<tr class="show_2" style="<?php if($items[0]['id_loai'] == 1 || !isset($_GET['id'])) echo "display:none" ?>">
			<td class="td_left">
				Mã video:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="id_video" value="<?php echo @$items[0]['id_video']?>"  placeholder="Nhập mã video, ví dụ: icYmhp1LWGE"/>
				<div style="  margin-top: 5px;  line-height: 1.6;">
					- Mã video là chuổi màu đỏ trong các link sau:<br>
					- https://www.youtube.com/watch?v=<font style="color:red">icYmhp1LWGE</font><br>
					- https://youtu.be/<font style="color:red">icYmhp1LWGE</font><br>
					- https://www.youtube.com/embed/<font style="color:red">icYmhp1LWGE</font>
				</div>
			</td>
		</tr>

		<tr>
			<td class="td_left">
				Số thứ tự:
			</td>
			<td class="td_right">
				<input type="text" name="so_thu_tu" value="<?php if(isset($items[0]['so_thu_tu'])) echo $items[0]['so_thu_tu']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Hiển thị:
			</td>
			<td class="td_right">
				<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])){	if(@$items[0]['hien_thi']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
			</td>
		</tr>
		<tr>
			<td class="td_left" style="text-align:right">
				<input type="submit" value="Lưu" class="btn btn-primary" />
			</td>
			<td class="td_right">
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=thu-vien-anh&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<script type="text/javascript">
 function aj_select_anh(obj){
 	var cls = ".show_"+$(obj).val();
 	$(".show_1").hide();
 	$(".show_2").hide();
 	$(cls).show();
 }
</script>