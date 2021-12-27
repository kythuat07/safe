<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Liên kết</a></li>
  <li class="active"><a href="index.php?p=ho-tro-truc-tuyen&a=man">Hỗ trợ trực tuyến</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa Hỗ trợ trực tuyến"; else echo "Thêm Hỗ trợ trực tuyến" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=ho-tro-truc-tuyen&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">

<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
	<ul id="myTabs" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
		</li>
		<!-- <li role="presentation" class="">
			<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
		</li>
		<li role="presentation" class="">
			<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
		</li> -->
	</ul>
	<div id="myTabContent" class="tab-content">
		<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
		<!-- //lang viet -->
		<div class="ar_admin">
                    <table class="table table-bordered table-hover them_dt" style="border:none">
                        <tbody>
                            <tr>
                                <td class="td_left">
                                        Tên:
                                </td>
                                <td class="td_right">
                                        <input class="input width400 form-control" type="text" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
                                </td>
                            </tr>
                        </tbody>
                    </table>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
		<!-- lang us -->
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<tr>
							<td class="td_left">
								Tên (en):
							</td>
							<td class="td_right">
								<input class="input width400 form-control" type="text" name="ten_us" value="<?php echo @$items[0]['ten_us']?>"  />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
		<!-- lang ja -->
			<div class="ar_admin">
				<table class="table table-bordered table-hover them_dt" style="border:none">
					<tbody>
						<tr>
							<td class="td_left">
								Tên (ch):
							</td>
							<td class="td_right">
								<input class="input width400 form-control" type="text" name="ten_ch" value="<?php echo @$items[0]['ten_ch']?>"  />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="ar_admin">
	<div class="title_thongtinchung">Thông tin chung</div>
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
                        Zalo:
                    </td>
                    <td class="td_right">
                        <input class="input width400 form-control" type="text" name="zalo" value="<?php echo @$items[0]['zalo']?>"  />
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Messenger:
                    </td>
                    <td class="td_right">
                        <input class="input width400 form-control" type="text" name="messenger" value="<?php echo @$items[0]['messenger']?>"  />
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Địa chỉ skype:
                    </td>
                    <td class="td_right">
                        <input class="input width400 form-control" type="text" name="skype" value="<?php echo @$items[0]['skype']?>"  />
                    </td>
                </tr>
                <tr>
                    <td class="td_left">
                        Số điện thoại:
                    </td>
                    <td class="td_right">
                        <input class="input width400 form-control" type="text" name="sdt" value="<?php echo @$items[0]['sdt']?>"  />
                    </td>
                </tr>
            </tbody>
        </table>
</div>

	<div class="ar_admin last">
		<table class="table table-bordered table-hover them_dt" style="border:none">
			<tbody>
				<tr>
					<td class="td_left">
						Số thứ tự
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
					<td class="td_left">
					</td>
					<td class="td_right">
						<input type="submit" value="Lưu" class="btn btn-primary" />
						<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=ho-tro-truc-tuyen&a=man'" class="btn btn-primary" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
</div>