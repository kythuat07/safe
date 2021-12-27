<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
  <li class="active"><a href="<?=urladmin ?>index.php?p=import-excel&a=add">Import Excel</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa"; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="sources/import.php" enctype="multipart/form-data">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Đăng sản phẩm mới bằng File Excel</a>
		</li>
		<!--li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ JA</a>
		</li>
		<!--li role="presentation" class="">
			<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
		</li-->
		<!--li role="presentation" class="">
			<a href="#id_seo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Hỗ trợ SEO</a>
		</li-->
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
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
							File Excel tải về:
						</td>
						<td class="td_right">
							<a class="btn btn-info" href="<?=URLPATH?>admin/php/sanpham.xlsx">Tải file Excel mẫu</a>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Chọn File Excel:
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
			    				<option value="0">Chọn danh mục</option>
								<?=$loai?>
							</select>
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Tác vụ: 
						</td>
						<td class="td_right">
							<!-- <input type="checkbox" class="chkbox" name="sp_hot" <?php if(isset($items[0]['sp_hot'])) { if(@$items[0]['sp_hot']==1) echo 'checked="checked"';else echo'';	}?> id="sp_hot"><label class="lb_nut" for="sp_hot">Bán chạy</label> -->

							<!-- <input type="checkbox" class="chkbox" name="sp_moi" <?php if(isset($items[0]['sp_moi'])) { if(@$items[0]['sp_moi']==1) echo 'checked="checked"';else echo'';	}?> id="sp_moi"><label class="lb_nut" for="sp_moi">SP mới</label> -->
							<input type="checkbox" class="chkbox" name="tieu_bieu" <?php if(isset($items[0]['tieu_bieu'])) { if(@$items[0]['tieu_bieu']==1) echo 'checked="checked"';else echo'';	}?> id="tieu_bieu"><label class="lb_nut" for="tieu_bieu">SP mới</label>

							<input type="checkbox" class="chkbox" name="hien_thi" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
						</td>
					</tr>
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" class="btn btn-primary" />
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang us -->
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>		
					<tr>
						<td class="td_left">
							Tiêu đề (JA):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_us','#title_us')" id="ten_us" name="ten_us" value="<?php echo @$items[0]['ten_us']?>"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Đường dẫn (us):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="alias_us" id="alias_us" value="<?php echo @$items[0]['alias_us']?>"  OnkeyUp="addText(this,'#alias_us')"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Mô tả (us):
						</td>
						<td class="td_right">
							<textarea  class="input width400 form-control" style="height:80px" name="mo_ta_us" id="mo_ta_us"><?=@$items[0]['mo_ta_us']?></textarea>
							
						</td>
					</tr>
				
					
					<tr>
						<td class="td_left">
							Nội dung chi tiết (us):
						</td>
						<td class="td_right">
							<textarea  name="thong_tin_us" id="thong_tin_us"><?=@$items[0]['thong_tin_us']?></textarea>
							<?php $ckeditor->replace('thong_tin_us'); ?>
						</td>
					</tr>
					
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" class="btn btn-primary"/>
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
		</div>
		
		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
		<!-- lang ch -->
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>		
					<tr>
						<td class="td_left">
							Tiêu đề (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control"OnkeyUp="addText(this,'#alias_ch','#alias_ch')" id="ten_ch" name="ten_ch" value="<?php echo @$items[0]['ten_ch']?>"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Đường dẫn (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="alias_ch" id="alias_ch" value="<?php echo @$items[0]['alias_ch']?>" OnkeyUp="addText(this,'#alias_ch')"  />
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Mô tả (ja):
						</td>
						<td class="td_right">
							<textarea  class="input width400 form-control" style="height:80px" name="mo_ta_ch" id="mo_ta_ch"><?=@$items[0]['mo_ta_ch']?></textarea>
							<?php $ckeditor->replace('mo_ta_ch'); ?>
						</td>
					</tr>
				
					
					<tr>
						<td class="td_left">
							Nội dung chi tiết (ja):
						</td>
						<td class="td_right">
							<textarea  name="thong_tin_ch" id="thong_tin_ch"><?=@$items[0]['thong_tin_ch']?></textarea>
							<?php $ckeditor->replace('thong_tin_ch'); ?>
						</td>
					</tr>
					
					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" class="btn btn-primary"/>
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
		</div>
		
		<div role="tabpanel" class="tab-pane fade" id="id_seo" aria-labelledby="profile-tab">
		<!-- /seo -->
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Title (vn):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off"  type="text" name="title_vn" id="title_vn" value="<?php echo @$items[0]['title_vn']?>"  />
						</td>
					</tr>
					<!--tr>
						<td class="td_left">
							Title (us):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off"  type="text" name="title_us" id="title_us" value="<?php echo @$items[0]['title_us']?>"  />
						</td>
					</tr-->
					<!--tr>
						<td class="td_left">
							Title (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off"  type="text" name="title_ch" id="title_ch" value="<?php echo @$items[0]['title_ch']?>"  />
						</td>
					</tr-->
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

					<tr>
						<td class="td_left" style="text-align:right">
							<input type="submit" value="Lưu" class="btn btn-primary"/>
						</td>
						<td class="td_right">
							<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
						</td>
					</tr>
				</tbody>
			</table>
		<!-- end -->
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

