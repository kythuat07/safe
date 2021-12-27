<?php
if(isset($_POST['guibaogia'])){
    $file_name=$d->fns_Rand_digit(0,9,12);
    $d->reset();
    if(@$file = $d->upload_image("file", '', './img_data/files/',$file_name)){
        $data['file'] = $file;
    }
    $data['ho_ten'] = addslashes($_POST['ho_ten']);
    $data['email'] = addslashes($_POST['email']);
    $data['sdt'] = addslashes($_POST['so_dien_thoai']);
    $data['noi_dung'] = addslashes($_POST['noi_dung']);
    $data['dia_chi'] = addslashes($_POST['dia_chi']);
    $data['ten_cong_ty'] = addslashes($_POST['ten_ct']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';
    $data['tieu_de']="Yêu cầu báo gia";
    $d->setTable('#_lienhe');
    if($d->insert($data)) {
        // if(sendmail("Liên hệ từ website ".URLPATH, $noidung, $_POST['mail'] , $thongtin[0]['email'] ,  $data['ho_ten'])) {
        // }
        $d->alert("Gửi thành công!");
        $d->location(URLPATH);
    }
    else {
            $d->alert("Error!");
    }
    
}
?>
<div class="container">
    <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
        <li property="itemListElement" typeof="ListItem"> 
            <a property="item" typeof="WebPage" href="http://demo10.phuongnamvina.vn/"> 
                    <span property="name">Trang chủ</span>
            </a> <meta property="position" content="1"> 
        </li>

        <li property="itemListElement" typeof="ListItem"> 
            <a class="active" property="item" typeof="WebPage" href="<?=URLPATH.$com?>.html"> 
                <span property="name">Yêu cầu báo giá</span>
            </a> <meta property="position" content="2"> 
        </li>
    </ol>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <h3 class="text-center" style="font-weight: bold;text-transform: uppercase;">Gửi yêu cầu đặt hàng</h3>
            <p class="text-center">Khi có nhu cầu đơn hàng riêng, quý khách hàng có thể đặt mua với phòng kinh doanh của chúng tôi</p>
            <form method="POST" action="" class="form-horizontal form-login" style="padding: 15px;border: 1px;">
                <div class="form-group">
                    <label for="ho-ten" class="col-sm-3 control-label">Họ tên:</label>
                    <div class="col-sm-9">
                        <input required="required" name="ho_ten" type="text" class="form-control" id="ho-ten" placeholder="Nhập họ tên">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" required="required" name="email" class="form-control" id="email" placeholder="Nhập Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Số điện thoại:</label>
                    <div class="col-sm-9">
                        <input required="required" name="so_dien_thoai" type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại">
                    </div>
                </div>
                <div class="form-group">
                    <label for="diachi" class="col-sm-3 control-label">Địa chỉ:</label>
                    <div class="col-sm-9">
                        <input required="required" name="dia_chi" type="text" class="form-control" id="diachi" placeholder="Nhập địa chỉ">
                    </div>
                </div>
                <div class="form-group">
                    <label for="congty" class="col-sm-3 control-label">Công ty:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="ten_ct" id="congty" placeholder="Nhập tên công ty">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nội dung yêu cầu:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="noi_dung" rows="3" placeholder="Nhập nội dung"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">File đính kèm:</label>
                    <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" id="congty"
                            accept=".doc,.docx,.xls,.xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"   
                        >
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="guibaogia" style="background-color: #f52031;color: #fff;" class="btn">Gửi yêu cầu</button>
                </div>
            </form>
        </div>
    </div>
</div>

