<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=category&a=man">Loại danh mục</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=category&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

<div class="ar_admin">
	<div class="title_thongtinchung">
		Thông tin chung
	</div>
	<table class="table table-bordered table-hover them_dt" style="border:none">
		<tbody>
		<?php if(isset($_GET['id'])){ ?>
			<tr>
				<td class="td_left">
					Hình ảnh:
				</td>
				<td class="td_right">
					<?php if($items[0]['hinh_anh'] <> ''){ ?>
					<img src="../img_data/images/<?php echo @$items[0]['hinh_anh']?>"  width="120" alt="NO PHOTO" />
					<?php } ?>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td class="td_left">
					Hình ảnh:
				</td>
				<td class="td_right">
					<input type="file" name="file" class="input width400 form-control"/>
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Danh mục:
				</td>
				<td class="td_right">
					<select name="id_loai" class="input width400 form-control" style="border-radius:4px">
	    				<option value="0">Chọn làm mục cha</option>
	    				<?=$loaibv?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td_left">
					Module:
				</td>
				<td class="td_right">
					<select name="module" class="input width400 form-control" style="border-radius:4px">
	    				<!--option value="0">Chọn Module</option-->
	    				<?php if(count($module)>0){foreach ($module as $item) { ?>
					    <option value="<?php echo $item['id'] ?>" <?php if($item['id'] == $items[0]['module']) echo "selected"; ?>><?php echo $item['title'] ?></option>					    	
						<?php }} ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</div>


<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_seo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Hỗ trợ SEO</a>
		</li>
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tiêu đề:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_vn','#title_vn')" id="ten_vn" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Đường dẫn:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_vn" id="alias_vn" value="<?php echo @$items[0]['alias_vn']?>"  OnkeyUp="addText(this,'#alias_vn')" />
					</td>
				</tr>
				<?php if($items[0]['id'] == 1040) {?>
				<tr>
					<td class="td_left">
						Tóm tắt:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="noi_dung_vn" id="noi_dung_vn"><?=@$items[0]['noi_dung_vn']?></textarea>
						<?php $ckeditor->replace('noi_dung_vn'); ?>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td class="td_left">
						Nội dung:
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="mo_ta_vn" id="mo_ta_vn"><?=@$items[0]['mo_ta_vn']?></textarea>
						<?php $ckeditor->replace('mo_ta_vn'); ?>
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang us -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tiêu đề (en):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_us','#title_us')" id="ten_us" name="ten_us" value="<?php echo @$items[0]['ten_us']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Đường dẫn (en):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_us" id="alias_us" value="<?php echo @$items[0]['alias_us']?>"  OnkeyUp="addText(this,'#alias_us')"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Mô tả (en):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="mo_ta_us" id="mo_ta_us"><?=@$items[0]['mo_ta_us']?></textarea>
						<?php $ckeditor->replace('mo_ta_us'); ?>
					</td>
				</tr>
				<!-- <tr>
					<td class="td_left">
						Nội dung chân trang (en):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="noi_dung_us" id="noi_dung_us"><?=@$items[0]['noi_dung_us']?></textarea>
						<?php $ckeditor->replace('noi_dung_us'); ?>
					</td>
				</tr>	 -->
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
		<!-- lang ch -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tiêu đề (ja):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_ch','#title_ch')"  id="ten_ch" name="ten_ch" value="<?php echo @$items[0]['ten_ch']?>"  />
					</td>
				</tr>

				<tr>
					<td class="td_left">
						Đường dẫn (ja):
					</td>
					<td class="td_right">
						<input class="input width400 form-control" name="alias_ch" id="alias_ch" value="<?php echo @$items[0]['alias_ch']?>"  OnkeyUp="addText(this,'#alias_ch')"  />
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Mô tả (ja):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="mo_ta_ch" id="mo_ta_ch"><?=@$items[0]['mo_ta_ch']?></textarea>
						<?php $ckeditor->replace('mo_ta_ch'); ?>
					</td>
				</tr>
				<!--tr>
					<td class="td_left">
						Nội dung chân trang (ch):
					</td>
					<td class="td_right">
						<textarea class="input width400 form-control" style="height:80px" name="noi_dung_ch" id="noi_dung_ch"><?=@$items[0]['noi_dung_ch']?></textarea>
						<?php $ckeditor->replace('noi_dung_ch'); ?>
					</td>
				</tr-->					
				<!--  -->
			</tbody>
		</table>
		</div>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_seo" aria-labelledby="profile-tab">
		<!-- /seo -->
		<div class="ar_admin">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Title:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="title_vn" id="title_vn" value="<?php echo @$items[0]['title_vn']?>" />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Title (en):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="title_us" id="title_us" value="<?php echo @$items[0]['title_us']?>" />
						</td>
					</tr>
					tr>
						<td class="td_left">
							Title (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="title_ch" id="title_ch" value="<?php echo @$items[0]['title_ch']?>" />
						</td>
					</tr
					<tr>
						<td class="td_left">
							Keyword:
						</td>
						<td class="td_right">
							<textarea class="input width400 form-control"  style="height:70px" name="keyword" id="keyword"><?=@$items[0]['keyword']?></textarea>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Description:
						</td>
						<td class="td_right">
							<textarea class="input width400 form-control"  style="height:70px" name="des" id="des"><?=@$items[0]['des']?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
		</div>
		</div>
		<div class="ar_admin last">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
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
							Số thứ tự 2 (Trang chủ):
						</td>
						<td class="td_right">
							<input type="text" name="ordering" value="<?php if(isset($items[0]['ordering'])) echo $items[0]['ordering']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
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
							<input type="submit" value="Lưu"  class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=category&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
</form>
</div>




<script>

function addText(text,target,title) {
	var str=$(text).val();
	var link=locdau(str);
	$(target).val(link);
	$(title).val(str);
}	
	

</script>

