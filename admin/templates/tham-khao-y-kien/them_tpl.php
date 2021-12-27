<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Danh mục</a></li>
  <li class="active"><a href="index.php?p=<?=@$_GET['p'] ?>&a=man">Tham khảo ý kiến</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Thêm câu hỏi"; else echo "Sửa câu hỏi" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_GET['p'] ?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Nội dung câu hỏi (vn):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control" name="ten_vn" id="ten_vn" style="height:100px"><?=@$items[0]['ten_vn']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Nội dung câu hỏi (us):
			</td>
			<td class="td_right">
				<textarea class="input width400 form-control" name="ten_us" id="ten_us" style="height:100px"><?=@$items[0]['ten_us']?></textarea>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Danh sách câu trả lời:
			</td>
			<td class="td_right ">
				<div class="dv-add">
					<!-- //show cau tra lơi củ -->
					<?php if(isset($_GET['id'])){ 
						$cautlcu = $d->o_fet("select * from #_cauhoi_detail where id_loai = '".addslashes($_GET['id'])."' order by id asc");
						foreach ($cautlcu as $ctl) {
					?>
						<input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_cu_<?=$ctl['id'] ?>" value="<?=$ctl['ten_vn'] ?>" placeholder="Nhập câu trả lời (vn)!"/>
						<input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_cu_us_<?=$ctl['id'] ?>" value="<?=$ctl['ten_us'] ?>" placeholder="Nhập câu trả lời (us)!"/>
					<?php }} ?>
					<!-- end -->
					<input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_tra_loi[]" value="" placeholder="Nhập câu trả lời (vn)!"/>
					<input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_tra_loi_us[]" value="" placeholder="Nhập câu trả lời (us)!"/>
				</div>
				
				<a href="javascript:;" onclick="add_cauhoi()" style="  padding: 6px 0px;  display: block;">Thêm câu trả lời.</a>
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
				Tác vụ: 
			</td>
			<td class="td_right">
				<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
			</td>
		</tr>
		<tr>
			<td class="td_left" style="text-align:right">
				<input type="submit" value="Lưu" class="btn btn-primary" />
			</td>
			<td class="td_right">
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=<?=@$_GET['p'] ?>&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<style type="text/css">.top-5{margin-bottom:5px;}</style>
<script type="text/javascript">
	function add_cauhoi(){
		$('.dv-add').append('<input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_tra_loi[]" value="" placeholder="Nhập câu trả lời (vn)!"/><input class="top-5 input width400 form-control" id="cau_tra_loi" name="cau_tra_loi_us[]" value="" placeholder="Nhập câu trả lời (us)!"/>');
	}
</script>