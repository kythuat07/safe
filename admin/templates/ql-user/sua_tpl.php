<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	if($_SESSION['quyen'] == 2) $d->location("index.php?p=ql-user&a=man");
	$permission = $d->o_fet("select * from #_permission_group where id_loai=0");
	$user_id = $items[0]['id'];
	$permission_group = $d->o_fet("select * from #_user_permission_group where id_user = '".$user_id."'");
	$array_check = array();
	if(!empty($permission_group)){
		foreach ($permission_group as $key => $value) {
			array_push($array_check, $value['id_permission']);
		}
	}

?>
<?php @include "sources/editor.php" ?>

<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">User</a></li>
  <li class="active"><a href="index.php?p=ql-user&a=man">Quản lý user</a></li>
  <li class="active"><a href="#">User</a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=ql-user&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Loại tài khoản:
			</td>
			<td class="td_right">
				 <select class="input width400 form-control" name="quyen_han">
				 	<option <?php if(@$items[0]['quyen_han'] == 2) echo "selected='selected'";?> value="2">Quản trị viên</option>
				 	<option <?php if(@$items[0]['quyen_han'] == 1) echo "selected='selected'";?> value="1">Administrator</option>
				 </select>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Tên tài khoản:
			</td>
			<td class="td_right">
				 <input class="input width400 form-control"	 type="text" name="tai_khoan" value="<?php echo @$items[0]['tai_khoan']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Họ tên:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="text" name="ho_ten" value="<?php echo @$items[0]['ho_ten']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Mật khẩu:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="password" name="password" id="password" value=""  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Nhập lại mật khẩu:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" type="password" name="cfpassword" id="cfpassword" value=""  />
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
				Quyền hạn:
			</td>
			<td class="td_right">
				<?php
					foreach ($permission as $key => $value) {
						$child_per = $d->o_fet("select * from #_permission_group where hide = 1 and  id_loai= '".$value['id']."'");
						?>
							<div class="col-md-3 col-sm-3 col-xs-3" style="padding-left: 0px; ">
								<input type="checkbox" class="parent-check chkbox" data-check="<?=$value['id']?>" name="permission[]" value="<?=$value['id']?>" <?= in_array($value['id'], $array_check)?'checked="checked"':''; ?> >
								<label class="text-bottom"><?=$value['title']?></label>
								<?php foreach ($child_per as $k => $v): ?>
									<div class="it-child">
										<input type="checkbox" class="child-check-<?=$key?> chkbox" name="permission[]" value="<?=$v['id']?>" <?= in_array($v['id'], $array_check)?'checked="checked"':''; ?> >
										<label class="text-bottom"><?=$v['title']?></label>
									</div>
								<?php endforeach ?>
							</div>
							<?php if($key == 3){ echo '<div class="clearfix"></div>'; } ?>
						<?php
					}
				?>
				
			</td>
		</tr>

		<tr>
			<input type="hidden" name="id_user" value="<?=@$items[0]['id']?>">
			<td class="td_left" style="text-align:right">
				
			</td>
			<td class="td_right" style="">
				<input type="submit" onclick="return kiemtra()" value="Lưu" class="btn btn-primary" style="margin-left: 0px;" />
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=ql-user&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>

<style type="text/css">
	.td_right label{ margin-right: 10px; }
	.text-bottom{ vertical-align: text-bottom; }
	.it-child{ margin-left: 10px; }
	.it-child .chkbox{ width: 18px; height: 18px; }
</style>
<script type="text/javascript">
	function kiemtra(){
		var pw = $("#password").val();
		var cfpw = $("#cfpassword").val();
		if(pw != cfpw){
			alert('Mật khẩu không giống nhau');
			$("#cfpassword").focus();
			return false;
		}
		return true;
	}

	jQuery(document).ready(function($) {
		// $('.parent-check').change(function() {
		//     var id = $(this).attr('data-check');
		//     if (this.checked) {
		//         $(this).siblings('.it-child').children(':checkbox').attr('checked','checked');
		//     } else {
		//         $(this).siblings('.it-child').children(':checkbox').removeAttr("checked");
		//     }
		// });
	});
</script>
