<?php
$sql = "select id from #_dathang where tinh_trang = 0 and trang_thai = 1";
$c_donhang = count($d->o_fet($sql));

$sql = "select id from #_lienhe where trang_thai = 0";
$c_lienhe = count($d->o_fet($sql));

$sql = "select id from #_dknhamau where hien_thi = 0";
$c_nhamau = count($d->o_fet($sql));


?>
<ol class="breadcrumb">
  	<li>
  		<a href="<?=URLPATH?>">
	  		<i class="glyphicon glyphicon-home"></i> Trang chủ website
	  	</a>  
  		<!-- <?php if($c_donhang>0){ ?>
	  		<img src="./img/new.gif"> 
	  		<a href="./index.php?p=danh-sach-don-hang&a=man"><?php echo $c_donhang ?> Đơn hàng mới</a>
  		<?php } ?>
  		<?php if($c_lienhe>0){ ?>
  		 <img src="./img/new2.gif"> 
  		 <a href="./index.php?p=lien-he&a=man"><?php echo $c_lienhe ?> Tin nhắn mới</a>
  		<?php } ?>
  		<?php if($c_nhamau>0){ ?>
  		 <img src="./img/new2.gif"> 
  		 <a href="./index.php?p=dk-xem-nha-mau&a=man"><?php echo $c_nhamau ?> ĐK xem nhà mẫu</a>
  		<?php } ?> -->
  	</li>
</ol>
<style type="text/css">
	.info-custom ul{ list-style: none; padding-left: 0px; font-size: 15px; }
	.info-custom{ text-align: left; }
	.red{ color: red; }
	.plr0{ padding: 0px; }
</style>

<style type="text/css">
    .login-header{
            /*width: 1160px;*/
        /*margin: 100px auto 0;*/
        border-radius: 5px;
    }
    .login-header .alert-custom h3{
        font-size: 16px;
        margin-top: 0px;
        padding-top: 10px;
        text-align: left;
        padding-left: 39px;
        font-weight: 600;
    }
    .login-header .alert-custom{
        padding: 10px;
        border-radius: 5px;
    }
    .huong-dan{
        text-align: left;
        padding-left: 15px;
        font-size: 16px;
        line-height: 28px;
    }
    .huong-dan ul{
                padding-left: 300px;
    }
    .huong-dan ul li{ line-height: 30px; font-size: 18px; }
    .red{ color: red; font-size: 24px; }
    #login{
        margin-top: 85px;
            width: 400px;
    }
    .login-header .alert-custom{ height: 180px; }
    @media(max-width: 1024px){
            .huong-dan ul{ padding-left: 20px; }
    }
    @media(max-width: 991px){
      .login-header .alert-custom h3{ font-size: 16px; }
      .huong-dan .red{ font-size: 14px; display: block; }
      .huong-dan ul li{ font-size: 12px; line-height: inherit; }
       .huong-dan ul{ padding-left: 0; }
       ul#menu > li > ul{ width: 180px; }
       ul#menu > li:hover > a > span{ width: 180px; }
    }
    .fix-footer{ position: fixed; bottom: 0; left: 0; z-index: 999; width: 100%; }
    body{ margin-bottom: 130px;  }
    </style>
<div class="col-xs-12 text-center">
	<!-- <div class="col-xs-6 col-xs-offset-3">
		<div class="info-custom">
	        <h3 class="red">Nếu cần hỗ trợ kỹ thuật, quý khách vui lòng thực hiện:</h3>
	        <div class="huong-dan">
	            <ul>
	                <li>Gửi yêu cầu vào email: <span class="red">kythuat@phuongnamvina.vn</span></li>
	                <li>Gọi số Hotline HTKH: 0915 101 017 - 0912 817 117</li>
	            </ul>
	        </div>
	    </div>
	</div> -->
	

		<div style="margin:auto">
			<div class="text-center"></div>
			<div class="clearfix"></div>
			<!-- <div class="t_index"> -->
				<div class="login-header">
			        <div class="alert alert-success alert-custom">
			            <h3>Nếu cần hỗ trợ kỹ thuật, quý khách vui lòng thực hiện một trong ba cách sau:</h3>
                                    <div class="huong-dan">
                                        <ol>
                                            <li>Truy cập: <a href="https://supportphuongnamvina.com" tabindex="_blank"><strong style="color: red;">supportphuongnamvina.com</strong></a>     và gửi yêu cầu hỗ trợ.</li>
                                            <li>Gửi email cho phòng kỹ thuật: <strong style="color: red;">kythuat@phuongnamvina.vn.</strong></li>
                                            <li>Gọi số Hotline Hỗ Trợ Khách Hàng: <strong style="color: red;">0915101017, 0912817117.</strong></li>
                                        </ol>
                                    </div>
			        </div>
			    </div>
			<!-- </div> -->
			
	

		</div>

</div>
<style type="text/css">
.t_index a {
color: #FF262B;
text-decoration: none;
font-size: 16px;
font-family: tahoma;
font-weight: 500;
padding-bottom:10px;
display:block;
}
.t_index a:hover{
	color: #0AA4C6;
}
</style>