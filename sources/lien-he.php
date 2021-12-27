<?php
	if(!isset($_SESSION)){
		session_start();
	}
	//include "./smtp/index.php";
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	if(isset($_POST['sub_email'])){
		$chuoi1 = strtolower($_SESSION['captcha_code']);
		$chuoi2 = strtolower($_POST['captcha']);
		if($chuoi1 == $chuoi2){
			$d->reset();
			$data['ho_ten'] = addslashes($_POST['ho_ten']);
			$data['email'] = addslashes($_POST['email']);
			$data['sdt'] = addslashes($_POST['so_dien_thoai']);
			$data['noi_dung'] = addslashes($_POST['noi_dung']);
			$data['dia_chi'] = addslashes($_POST['dia_chi']);
			$data['ngay_hoi'] = date('d-m-Y H:i:s');
			$data['trang_thai'] = '0';
                        $data['tieu_de']="Liên hệ";

			$d->setTable('#_lienhe');
				$noidung = "<div style='margin-bottom:5px;'>Bạn nhận được tin nhắn từ website: ".URLPATH." : </div>";
				$noidung .= "<div style='margin-bottom:5px;'>Thông tin: </div>";
				$noidung .= "<div style='margin-bottom:5px;'>Họ tên: ".$_POST['ho_ten']."</div>";
				$noidung .= "<div style='margin-bottom:5px;'>Địa chỉ: ".$_POST['dia_chi']."</div>";
				$noidung .= "<div style='margin-bottom:5px;'>Số điện thoại: ".$_POST['so_dien_thoai']."</div>";
				$noidung .= "<div style='margin-bottom:5px;'>Email: ".$_POST['mail']."</div>";
				// $noidung .= "<div style='margin-bottom:5px;'>Tiêu đề: ".$_POST['tieu_de']."</div>";
				$noidung .= "<div style='margin-bottom:5px;    line-height: 1.5;'>Content: ".$_POST['noi_dung']."</div>";
				$noidung .= "<div style='margin-bottom:5px;'>Date: ".date('d-m-Y h:i:s', time())."</div>";
				$noidung .= "<div style='color:red; margin-top:10px; font-style:italic; font-size:12px'>Đây là thư gửi tự động, vui lòng ko trả lời thư này!</div>";
			if($d->insert($data)) {
				// if(sendmail("Liên hệ từ website ".URLPATH, $noidung, $_POST['mail'] , $thongtin[0]['email'] ,  $data['ho_ten'])) {
				// }
				$d->alert("Gửi thành công!");
				$d->location(URLPATH);
			}
			else {
				$d->alert("Error!");
			}
		}else {
			$d->alert("Security code is incorrect");
		} 
	}
	$dulieu = $d->getTemplates(10);
	$dulieu_1 = $d->simple_fetch("select * from #_category where hien_thi = 1 and id = 105");
         $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h1 class="title-home"><span><?=$loai['ten_vn']?></span></h1>
            <?= $d->breadcrumbList($loai['id'],$lang,URLPATH) ?>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-6">
                    <h3 style="padding-left: 15px; text-transform: uppercase;font-size: 15px;font-weight: 600;margin-top: 10px;margin-bottom: 20px;text-align: center;">Liên hệ với chúng tôi</h3>
                    <form id="form-contact" method="post">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" id="ho_ten" required  name="ho_ten" class="form-control"  placeholder="<?=_hoten ?> (*)">
                            </div>
                            <div class="form-group">
                                <input type="text" id="dia_chi" name="dia_chi" class="form-control"  placeholder="<?=_address ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control"  placeholder="Email (nếu có)">
                            </div>
                            <div class="form-group">
                                <input type="text" id="so_dien_thoai" required name="so_dien_thoai" class="form-control" placeholder="<?=_sodienthoai ?>(*)">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="textarea-message form-group">
                                <textarea class="form-control" required name="noi_dung" placeholder="Nội dung (*)" rows="6"></textarea>
                            </div>
                            <div class="form-group item-captcha">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control" placeholder="Nhập mã bảo vệ" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat">
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="form-control btn btn-success btn-send-contact" name="sub_email" type="submit"><?=_send ?> 
                                        <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
					<h3 style="padding-left: 15px; text-transform: uppercase;font-size: 15px;font-weight: 600;margin-top: 10px;margin-bottom: 20px;text-align: center;">Thông tin liên hệ</h3>
                    <?=$dulieu_1['mo_ta_'.$_SESSION['lang']];?>
                    <div id="map">	
                        <?php if (!empty($information['map'])) { ?>
                                <?=$information['map']?>
                        <?php }else{ ?>
                            <div id="map_contact"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
