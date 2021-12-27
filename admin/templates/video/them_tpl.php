<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Liên kết</a></li>
  <li class="active"><a href="index.php?p=video&a=man">Videos</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa Video"; else echo "Thêm Video" ?></a></li>
</ol>
<div class="col-xs-12">
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
		</li>
		<!-- <li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
		</li> -->
	</ul>
</div>
<form name="frm" method="post" action="index.php?p=video&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
	<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<div class="ar_admin">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Tên video:
					</td>
					<td class="td_right">
						<input type="text" name="ten_vn" value="<?php echo @$items[0]['ten_vn'] ?>" class="input width400 form-control" />
					</td>
				</tr>
			</tbody>
		</table>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang en -->
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<tr>
							<td class="td_left">
								Tên video (en):
							</td>
							<td class="td_right">
								<input type="text" name="ten_us" value="<?php echo @$items[0]['ten_us']?>" class="input width400 form-control" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="ar_admin ">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<div class="title_thongtinchung">Thông tin chung</div>
			<!-- <tr>
				<td class="td_left">
					Danh mục:
				</td>
				<td class="td_right">
					<select class="input width400 form-control" name="id_loai">
						<option value="">Chọn danh mục</option>
						<?=$loai?>
					</select>
				</td>
			</tr> -->
			<tr>
				<td class="td_left">
					ID Video:
				</td>
				<td class="td_right">
					<input type="text" name="link" value="<?php echo @$items[0]['link']?>" class="input width400 form-control" placeholder="Nhập mã video, ví dụ: icYmhp1LWGE"/>
					<div style="  margin-top: 5px;  line-height: 1.6;">
						- ID video là chuổi màu đỏ trong link sau:<br/>
						- https://www.youtube.com/watch?v=<font style="color:red">icYmhp1LWGE</font>
					</div>
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
				<td class="td_left">
				</td>
				<td class="td_right">
					<input type="submit" value="Lưu" class="btn btn-primary" />
					<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=video&a=man'" class="btn btn-primary" />
				</td>
			</tr>
		</table>
		</div>
	</div>
</form>
</div>