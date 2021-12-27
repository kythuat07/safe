<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="./index.php">Danh mục</a></li>
  <li class="active"><a href="./index.php?p=gallery&a=man">Hình ảnh</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa ảnh"; else echo "Thêm ảnh" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=gallery&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
	<div class="ar_admin">
		<div class="title_thongtinchung">
			Thông tin chung
		</div>
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<?php if($items[0]['id'] == 103){ ?>
						<tr>
							<tr>
						<td class="td_left">
							Tên ảnh:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" type="text" name="title_vn" value="<?php echo @$items[0]['title_vn']?>"  />
						</td>
					</tr>
							<td class="td_left">
								Favicon:
							</td>
							<td class="td_right">
								<?php if($items[0]['favicon'] <> ''){ ?>
								<img src="../img_data/icon/<?php echo @$items[0]['favicon']?>"  width="50" alt="NO PHOTO" />
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Trình Duyệt:
							</td>
							<td class="td_right">
								<input type="file" name="file_1" class="input width400 form-control"/>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Chia sẻ:
							</td>
							<td class="td_right">
								<?php if($items[0]['ic_share'] <> ''){ ?>
								<img src="../img_data/icon/<?php echo @$items[0]['ic_share']?>"  width="50" alt="NO PHOTO" />
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Icon Chia sẻ:
							</td>
							<td class="td_right">
								<input type="file" name="file_2" class="input width400 form-control"/>
							</td>
						</tr>
						<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=gallery&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			<?php } ?>
			<?php if($items[0]['id'] <> 103){ ?>
			<tbody>
				<tr>
					<td class="td_left">
						Danh mục:
					</td>
					<td class="td_right">
						<select class="input width400 form-control" name="parent">
							<?php if(count($parent)>0){foreach ($parent as $lsp) {
							?>
								<option value="<?php echo $lsp['id'] ?>" <?php if($lsp['id'] == $items[0]['parent']) echo "selected"; ?>>
								<?php echo $lsp['ten_vn'] ?></option>
								<!-- /// -->
								<?php
									$sp_child1 = $d->o_fet("select * from #_category where id_loai = '".$lsp['id']."' order by so_thu_tu asc");
									if(count($sp_child1)>0){foreach ($sp_child1 as $lsp1) {
								?>
								<option value="<?php echo $lsp1['id'] ?>" <?php if($lsp1['id'] == $items[0]['parent']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp1['ten_vn'] ?></option>
									<!-- // -->
									<!-- /// -->
										<?php
											$sp_child2 = $d->o_fet("select * from #_category where id_loai = '".$lsp1['id']."' order by so_thu_tu asc");
											 if(count($sp_child2)>0){foreach ($sp_child2 as $lsp2) {
										?>
										<option value="<?php echo $lsp2['id'] ?>" <?php if($lsp2['id'] == $items[0]['parent']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp2['ten_vn'] ?></option>
										<?php }} ?>
										<!-- /// -->
									<!-- / -->
								<?php }} ?>
								<!-- /// -->
							<?php }} ?>
						</select>
					</td>
				</tr>
				
				
				<?php if(isset($_GET['id'])){ ?>
				<tr class="show_1">
					<td class="td_left">
						Hình hiện tại:
					</td>
					<td class="td_right">
						<img src="../img_data/images/<?php echo @$items[0]['picture']?>"  width="120" alt="NO PHOTO" /><br />
					</td>
				</tr>
				<?php }?>
				<tr class="show_1">
					<td class="td_left">
						Hình ảnh:
					</td>
					<td class="td_right">
						<input type="file" name="file" class="input width400 form-control"/>
					</td>
				</tr>

				<tr >
					<td class="td_left">
						Link:
					</td>
					<td class="td_right">
						<input class="input width400 form-control" type="text" name="link" value="<?php echo @$items[0]['link']?>"  />
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
		</ul>
	</div>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
			<!-- //lang viet -->
			<div class="ar_admin">
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<tr>
						<td class="td_left">
							Tên ảnh:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" type="text" name="title_vn" value="<?php echo @$items[0]['title_vn']?>"  />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Thông tin:
						</td>
						<td class="td_right">
							<textarea  name="body_vn" rows="5" class="input width400 form-control" id="body_vn"><?=@$items[0]['body_vn']?></textarea>
						</td>
					</tr>	
				</tbody>
			</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<tr >
							<td class="td_left">
								Tên ảnh (en):
							</td>
							<td class="td_right">
								<input class="input width400 form-control" type="text" name="title_us" value="<?php echo @$items[0]['title_us']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Thông tin (en):
							</td>
							<td class="td_right">
								<textarea  name="body_us" rows="5" class="input width400 form-control" id="body_us"><?=@$items[0]['body_us']?></textarea>

							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<tr >
							<td class="td_left">
								Tên ảnh (Ja):
							</td>
							<td class="td_right">
								<input class="input width400 form-control" type="text" name="title_ch" value="<?php echo @$items[0]['title_ch']?>"  />
							</td>
						</tr>
						<tr>
							<td class="td_left">
								Thông tin (Ja):
							</td>
							<td class="td_right">
								<textarea  name="body_ch" rows="5" class="input width400 form-control" id="body_ch"><?=@$items[0]['body_ch']?></textarea>

							</td>
						</tr>
					</tbody>
				</table>
			</div>
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
						<input type="text" name="stt" value="<?php if(isset($items[0]['stt'])) echo $items[0]['stt']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
					</td>
				</tr>
				<tr>
					<td class="td_left">
						Hiển thị:
					</td>
					<td class="td_right">
						<input type="checkbox" class="chkbox" name="hide" <?php if(isset($items[0]['hide'])){	if(@$items[0]['hide']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
					</td>
				</tr>
				<tr>
					<td class="td_left" style="text-align:right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
					</td>
					<td class="td_right">
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=gallery&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		<?php } ?>
		</table>
	</div>
</div>
</form>
</div>
