<?php @include "sources/editor.php" ?>
<ol class="breadcrumb">
  <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
   <li class="active"><a href="index.php">Danh mục</a></li>
  <li class="active"><a href="index.php?p=<?=@$_GET['p'] ?>&a=man">QL khách hàng</a></li>
  <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Thêm khách hàng"; else echo "Sửa khách hàng" ?></a></li>
</ol>
<div class="col-xs-12">
<form name="frm" method="post" action="index.php?p=<?=@$_GET['p'] ?>&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
<table class="table table-bordered table-hover them_dt" style="border:none">
	<tbody>
		<tr>
			<td class="td_left">
				Tài khoản:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="ten_vn" onchange="check_us()"  OnkeyUp="add_alias_vn(this)" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
				<font style="margin-top:3px; display: block;" id="warning_vn"></font>
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Mật khẩu:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="mat_khau" name="mat_khau" value=""  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Họ tên:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="ho_ten" name="ho_ten" value="<?php echo @$items[0]['ho_ten']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Số điện thoại:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?php echo @$items[0]['so_dien_thoai']?>"  />
			</td>
		</tr>
		

		<tr>
			<td class="td_left">
				Email:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="email" name="email" value="<?php echo @$items[0]['email']?>"  />
			</td>
		</tr>
		<tr>
			<td class="td_left">
				Địa chỉ:
			</td>
			<td class="td_right">
				<input class="input width400 form-control" id="dia_chi" name="dia_chi" value="<?php echo @$items[0]['dia_chi']?>"  />
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
				<input type="submit" value="Lưu" class="btn btn-primary" onclick="return kiemtra_link()"/>
			</td>
			<td class="td_right">
				<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=<?=@$_GET['p'] ?>&a=man'" class="btn btn-primary" />
			</td>
		</tr>
	</tbody>
</table>
</form>
</div>
<script type="text/javascript">
	var dk = <?php if(isset($_GET['id'])) echo 1;else echo 0; ?>;

	function locdau(str){
		str= str.toLowerCase();
		str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
		str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
		str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
		str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
		str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
		str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
		str= str.replace(/đ/g,"d");
		str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|\;|\||\{|\}|~/g,"");
		str= str.replace(/^\-+|\-+$/g,"");
		str= str.replace(/\\/g,"");
		str= str.replace(/-+-/g,"");
		return str;
	}


	function add_alias_vn(obj){
		var str = $(obj).val();
		var als = locdau(str);
		$("#ten_vn").val(als);
	}

	function kiemtra_link(){
		var ten_vn = $("#ten_vn").val();
		var mat_khau = $("#mat_khau").val();
		if(ten_vn == ''){
			alert("Chưa nhập tên đăng nhập.");
			$("#ten_vn").focus();
			return false;
		}
		else if(mat_khau == ''){
			alert("Chưa nhập mật khẩu.");
			$("#mat_khau").focus();
			return false;
		}
		else if(dk == 0){
			alert("Tên đăng nhập đã tồn tại.");
			$("#ten_vn").focus();
			return false;
		}
		else return true;
	}

	function check_us(){

		var ten_vn = $("#ten_vn").val();
		if(ten_vn == ''){
			alert("Chưa nhập tên đăng nhập!");
		}else{
			$.ajax({
				url: "./sources/kiem_tra_ten_dn.php",
				type:'POST',
				data:"bang=#_khachhang&ten_vn="+ten_vn,
				success: function(data){
					if(data == 0){ $("#warning_vn").html("<font style='color:red'>Tên đăng nhập đã tồn tại</font>"); dk = 0;}
					else { $("#warning_vn").html("<font style='color:blue'>Tên đăng nhập hợp lệ.</font>"); dk =1};
				}
			})
		}
		
	}
</script>