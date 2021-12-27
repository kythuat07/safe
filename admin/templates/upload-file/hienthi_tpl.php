<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
  <li class="active"><a href="./">Danh mục</a></li>
  <li class="active"><a href="./index.php?p=upload-file&a=man">Upload file</a></li>
</ol>

<style type="text/css">.hide_all{display: none}</style>
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
		<select id="action" onchange="seach(this,'upload-file')" name="action" class="form-control">
			<option value="0" selected>Tìm theo</option>
			<option value="1">ID</option>
			<option value="3">Mã SP</option>
			<option value="2">Tên</option>
		</select>
	</div>
	<div class="btn-group">
		<select id="action" onchange="show(this,'upload-file')" name="action" class="form-control">
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
	<a href="index.php?p=upload-file&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
</div>

<form id="form" method="post" action="index.php?p=upload-file&a=delete_all" role="form">

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th style="width:2%"><input  type="checkbox" name="chk" value="0" class=" chk_box checkall" id="check_all"></th>
			<th style="width:4%">STT</th>
			<th style="width:22%"">Tên file</th>
			<th style="width:33%">Code chèn file</th>
			<th style="width:8%;">Ngày đăng</th>
			<th style="width:10%">Kich thước</th>
			<th style="width:7%">Loại file</th>
			<th style="width:7%">Hiển thị</th>
			<th style="width:7%">Tác vụ</th>
			
		</tr>
	</thead>
	<tbody>
		<?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
		<tr>
			<td>
				<input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
			</td>
			<td><?=($i+1)?></td>
			<td>
				<a href="index.php?p=upload-file&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>"><?=$items[$i]['ten_vn']?></a>
			</td>
			<td>
				<div>
					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_0')" id="name_<?=$items[$i]['id']?>_0"> <label for="name_<?=$items[$i]['id']?>_0" style="margin-right:5px"> URL</label>

					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_1')" id="name_<?=$items[$i]['id']?>_1"> <label for="name_<?=$items[$i]['id']?>_1" style="margin-right:5px"> URL Dowload</label>

					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_2')" id="name_<?=$items[$i]['id']?>_2"> <label for="name_<?=$items[$i]['id']?>_2" style="margin-right:5px"> MP3/Radio</label>

					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_3')" id="name_<?=$items[$i]['id']?>_3"> <label for="name_<?=$items[$i]['id']?>_3" style="margin-right:5px"> MP4/Video</label>

					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_4')" id="name_<?=$items[$i]['id']?>_4"> <label for="name_<?=$items[$i]['id']?>_4" style="margin-right:5px"> PDF</label>

					<input type="radio" name="rad_hien_thi" onclick="show_hienthi('<?=$items[$i]['id']?>_5')" id="name_<?=$items[$i]['id']?>_5"> <label for="name_<?=$items[$i]['id']?>_5" style="margin-right:5px"> SWF/Flash</label>
				</div>
				<div class="hide_all <?=$items[$i]['id']?>_0" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">URL: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value="<?=URLPATH."img_data/".$items[$i]['link'] ?>">

					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						URL gốc của file. Ứng dụng cho chèn hình ảnh, file để hiển thị trên website...
					</div>
				</div>

				<div class="hide_all <?=$items[$i]['id']?>_1" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">Dowl: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value="<?=URLPATH."dowload.php?id_code=".$items[$i]['id_code'] ?>">
					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						Hiển thị đường dẫn dowload. Ứng dụng cho các tập tin cần dowload về máy...
					</div>
				</div>
				<div class="hide_all <?=$items[$i]['id']?>_2" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">MP3: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value='<audio class="html5_audio" controls=""><source src="<?=URLPATH."img_data/".$items[$i]['link']  ?>" type="audio/mpeg"></audio>'>
					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						Mã trình phát file dạng mp3.
					</div>
				</div>
				<div class="hide_all <?=$items[$i]['id']?>_3" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">MP4: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value='<video src="<?=URLPATH."img_data/".$items[$i]['link']  ?>" width="400px" controls="controls" loop="loop"></video>'>
					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						Mã trình phát file dạng mp4.
					</div>
				</div>
				<div class="hide_all <?=$items[$i]['id']?>_4" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">PDF: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value="<iframe frameborder='0' scrolling='no' style='width:100%' src='<?=URLPATH."readpdf/pdf/index.php?f=" ?><?=URLPATH."img_data/".$items[$i]['link']  ?>'></iframe>">
					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						Mã đọc file pdf trên website.
					</div>
				</div>


				<div class="hide_all <?=$items[$i]['id']?>_5" style="  text-align: left;    border-bottom: 1px solid #EAEAEA;  margin-bottom: 7px; ">
					<label style="float:left; width:10%">SWF: </label>
					<input onclick="selec_all(this)" style="   background: none; width: 90%; float:right;  border: none;" type="text" value="<object type='application/x-shockwave-flash' data='<?=URLPATH."img_data/".$items[$i]['link']  ?>' width='100%' height='1100'><param name='movie' value='<?=URLPATH."img_data/".$items[$i]['link']  ?>' /><param name='quality' value='high'/><param name='wmode' value='transparent'/></object>">
					<div style="clear:both"></div>
					<div style="font-size: 12px;    color: red;">
						Mã trình phát file dạng flash swf.
					</div>
				</div>
			</td>
			<td>
				<?=$items[$i]['ngay_dang'] ?>
			</td>
			<td>
				<?=$items[$i]['size'] ?> Kb
			</td>
			<td>
				<?php 
					$file = end(explode(".", $items[$i]['link']));
					echo "[ .".$file." ]";
				?>
			</td>
			<td>
				<input class="chk_box" type="checkbox" onclick="on_check(this,'#_file','hien_thi','<?=$items[$i]['id']?>')" <?php if($items[$i]['hien_thi'] == 1) echo 'checked="checked"'; ?>>
			</td>
			<td>
				<a href="index.php?p=upload-file&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
				<a href="index.php?p=upload-file&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
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
	function selec_all(obj){
		$(obj).select();
	}

	function show_hienthi(id){
		$(".hide_all").hide();
		$("."+id).show();
	}
</script>