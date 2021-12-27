<?php

    $thanhcong = $d->getTemplates(29);
    if(isset($_POST['thanhtoan'])){
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
        $vpcURL = $_POST["virtualPaymentClientURL"] . "?";

        unset($_POST["virtualPaymentClientURL"]); 
        unset($_POST["SubButL"]);

        $stringHashData = "";
        ksort ($_POST);

        $appendAmp = 0;

        foreach($_POST as $key => $value) {
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                            $stringHashData .= $key . "=" . $value . "&";
                        }
            }
        }
        $stringHashData = rtrim($stringHashData, "&");
        if (strlen($SECURE_SECRET) > 0) {
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
        }
        header("Location: ".$vpcURL);
    }elseif($_POST['huy']){
        $d->reset();
        $d->setTable('#_dathang');
        $d->setWhere('ma_dh',$_GET['DHJKB4C']);
        if($d->delete()){
            $d->reset();
            $d->setTable('#_chitietdathang');
            $d->setWhere('ma_dh',$_GET['DHJKB4C']);
            $d->delete();
            header("Location: ".URLPATH);
        }
    }
    if(isset($_POST['capnhat'])){
        $order = $d->simple_fetch("select * from #_dathang where ma_dh = '".$_GET['donhang']."' order by id DESC "); 
        $data['hinh_thuc_thanh_toan']= $_POST['pt_thanhtoan'];
       
        $d->reset();
        $d->setTable('#_dathang');
        $d->setWhere('id',$order['id']);
        if($d->update($data)){
                $order_chitiet = $d->o_fet("select * from #_chitietdathang where ma_dh = '".$_GET['donhang']."'");
                $hinhthuc = $d->simple_fetch("select * from #_hinhthucthanhtoan where id=".$order['hinh_thuc_thanh_toan']."");
                    $row_nd = "";
                    $total = 0;
                    $tong = 0;
                    
                    foreach($order_chitiet as $key => $value) {
                        
                       $product = $d->simple_fetch("select * from #_sanpham where id=".$value['id_sp']."");
                       //print_r($order_chitiet);
                        //exit();
                        if(!empty($product)){

                            $price = $product['gia'];
                            if($product['khuyen_mai'] > 0){
                                $price = $product['khuyen_mai'];
                            }
                            $id_product = $product['id'];
                            
                            $tongtien = $tongtien + ($price*$value['so_luong']);
                            
                            $d->reset();
                            $data_2['ma_dh'] = $ma_donhang;
                            $data_2['id_dh'] = $id_don;
                            $data_2['gia'] = $product['gia'];
                            $data_2['khuyen_mai'] = $product['khuyen_mai'];
                            $data_2['id_sp'] = $id_product;
                            $data_2['so_luong'] = $value['so_luong'];
                            $data_2['mau'] = $value['mau'];
                            $data_2['size'] = $value['size'];

                            $d->setTable('#_chitietdathang');
                            $d->insert($data_2);
                            $tientong = $tongtien + $data['phi_ship'];

                                            $row_nd .= '
                    <tr>
                        <td style="background-color:white;color:#000">'.$value['so_luong'].'</td>
                        <td style="background-color:white;color:#000"><img src="'.URLPATH."thumb.php?src=".URLPATH."img_data/images/".$product['hinh_anh'].'&h=50" alt="'.$product['ten_'.$_SESSION['lang']].'"></td>
                        <td style="background-color:white;color:#000">'.$product['ten_'.$_SESSION['lang']].'</td>
                        <td style="background-color:white;color:#000;text-align:right">'.number_format($price).' VNĐ</td>
                        <td style="background-color:white;color:#000;text-align:right">'.number_format($price*$value['so_luong']).' VNĐ</td>
                    </tr>                       
                        ';
                    }
                }
                
                $noidung = '
                    <h3><b>Mã đơn hàng: '.$_GET['donhang'].'</b></h3><br>                 
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);font-weight:bold">
                                <td style="color:#000">Số lượng</td>
                                <td style="color:#000">Hình ảnh</td>
                                <td style="color:#000">Tên</td>
                                <td style="color:#000">Giá</td>
                                <td style="color:#000">Thành tiền</td>
                            </tr>'.$row_nd.'
                            <tr>
                                <td colspan="4" style="text-align:right">Tổng tiền:</td>
                                <td style="text-align:right">'.number_format($tongtien).' VNĐ</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right">Phí vận chuyển:</td>
                                <td style="text-align:right">'.number_format($order['phi_ship']).'</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="background-color:white;color:#000"></td>
                                <td style="background-color:white;color:#000;text-align:right"><b>Tổng tiền cần phải thanh toán:</b></td>
                                <td style="background-color:white;color:#000;text-align:right;color:red"><b>'.number_format($tientong).' VNĐ</b></td>
                            </tr>
                        </tbody>
                    </table>                

                    <br></br>               
                                        
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                <td colspan="2" style="color:#000"><b>Thông tin khách hàng</b></td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Họ tên</td>
                                <td style="background-color:white;color:#000">'.$order['ho_ten'].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Email</td>
                                <td style="background-color:white;color:#000">'.$order['email'].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Điện thoại</td>
                                <td style="background-color:white;color:#000">'.$data['dien_thoai'].'</td>
                            </tr>
                        </tbody>
                    </table> 
                    <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                <td colspan="2" style="color:#000"><b>Chi tiết giao hàng</b></td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Địa chỉ</td>
                                <td style="background-color:white;color:#000">'.$order['dia_chi'].', '.$order['quan'] .', '.$order['thanh_pho'].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Thời gian giao hàng</td>
                                <td style="background-color:white;color:#000">'.$order['ngay_nhan'].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Hình thức thanh toán</td>
                                <td style="background-color:white;color:#000">'.$hinhthuc['ten_'.$_SESSION['lang']].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Địa chỉ</td>
                                <td style="background-color:white;color:#000">'.$order['dia_chi'].', '.$order['quan'] .', '.$order['thanh_pho'].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Hình thức thanh toán</td>
                                <td style="background-color:white;color:#000">'.$hinhthuc['ten_'.$_SESSION['lang']].'</td>
                            </tr>
                            <tr>
                                <td style="background-color:white;color:#000">Ghi chú</td>
                                <td style="background-color:white;color:#000">'.$order['loi_nhan'].'</td>
                            </tr>
                        </tbody>
                    </table> 
                    ';
                
                include "./smtp/index.php";
                $thongtin = $d->simple_fetch("select * from #_thongtin limit 0,1");
                unset($_SESSION['cart']);
                // sendmail("Bạn có 1 đơn đặt hàng mới!", $noidung, $data['email'] , $email ,  $data['ho_ten']);
                sendmail("Bạn đã đặt hàng thành công!", $noidung, $email , $order['email'] ,  $ten_cong_ty);
            header("Location: ".URLPATH."?com=cart-success&donhang=".$_GET['donhang']."&thanhtoan=".$_POST['pt_thanhtoan']);
        }
        
       
    }
?>

<?php if(isset($_GET['donhang'])){?>
<section class="product tin-tuc_main">
    <div class="container bg-white my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="login">
                    <?php if(isset($_GET['vpc_AdditionData'])){ ?>
                    <?php if($hashValidated=="CORRECT" && $txnResponseCode=="0"){?>
                    <div class="alert alert-success text-center" role="alert">
                        <p><b><?=getResponseDescription ( $txnResponseCode )?></b></p>
                    </div>
                    
                    <?php }else{ ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <p><?=getResponseDescription ( $txnResponseCode )?></p>
                        <p><i>Vui lòng chọn phương thức thanh toán khác ngay bên dưới</i></p>
                    </div>
                    <?php }}?>
                    <h3 class="text-center">Chi tiết đơn hàng - <?=$_GET['donhang']?></h3>
                    <br>
                    <?php 
                    $ma_donhang =  $_GET['donhang'];
                    $order_chitiet = $d->o_fet("select * from #_chitietdathang where ma_dh = '".$ma_donhang."'");
                    $order = $d->simple_fetch("select * from #_dathang where ma_dh = '".$ma_donhang."' order by id DESC "); 
                    $hinhthuc = $d->simple_fetch("select * from #_hinhthucthanhtoan where id={$order['hinh_thuc_thanh_toan']}");
                    if(count($order_chitiet)>0){
                        if($order_chitiet['tinh_trang']==0){
                            $trangthai = "<span style=\"color: red;\">Chưa xử lý</span>";
                        }elseif ($order_chitiet['tinh_trang']==1) {
                            $trangthai = "<span style=\"color: #f0ad4e;\">Chuẩn bị giao hàng</span>";
                        }else{
                            $trangthai = "<span style=\"color: #5cb8;\">Đã giao hàng</span>";
                        }
                        $row_nd="";
                        foreach($order_chitiet as $key => $value) {
                            $product = $d->simple_fetch("select * from #_sanpham where id=".$value['id_sp']." ");
                            if(!empty($product)){
                                $price = $product['gia'];
                                if($product['khuyen_mai'] > 0){
                                    $price = $product['khuyen_mai'];
                                }
                                $id_product = $product['id'];
                                $stt=$key+1;
                                $tongtien = $tongtien + ($price*$value['so_luong']);
                                $thanhtien2=$tongtien+$order['phi_ship'];
                                $row_nd .= '
                                <tr>
                                    <td style="text-align: center;line-height: 30px;">'.$stt.'</td>
                                    <td style="text-align: center;line-height: 30px;">'.$product['ten_'.$_SESSION['lang']].'</td>
                                    <td class="text-center" style="padding-top: 3px;padding-bottom: 3px;"><img src="'.URLPATH."thumb.php?src=".URLPATH."img_data/images/".$product['hinh_anh'].'&h=40" alt="'.$product['ten_'.$_SESSION['lang']].'"></td>
                                    <td  style="text-align: center;line-height: 30px;">'.$value['so_luong'].'</td>
                                    <td style="text-align:right;line-height: 30px;">'.$d->vnd($price).'</td>
                                    <td style="text-align:right;line-height: 30px;">'.$d->vnd($price*$value['so_luong']).'</td>
                                </tr>                       
                                                    ';
                            }
                        }
                    }
                    ?>
                    
                    
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr style="background: linear-gradient(#ffffff, #f1f1f1);font-weight:bold">
                                <td style="color:#000;text-align: center;">STT</td>
                                <td style="color:#000;text-align: center;">Tên</td>
                                <td style="color:#000;text-align: center;">Hình ảnh</td>
                                <td style="color:#000;text-align: center;">Số lượng</td>
                                <td style="color:#000;text-align: center;">Giá</td>
                                <td style="color:#000;text-align: center;">Thành tiền</td>
                            </tr>
                            <?=$row_nd?>
                            <tr>
                                <td colspan="5" class="text-right">Tổng tiền:</td>
                                <td class="text-right"><font class="color-main"><?= $d->vnd($tongtien)?> </font></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">Phí vận chuyển:</td>
                                <td class="text-right"><span id="phi_ship"><?=$d->vnd($order['phi_ship'])?></span></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align:right"><b>Tổng tiền:</b></td>
                                <td style="text-align:right;color:red"><b><?=$d->vnd($thanhtien2)?></b></td>
                            </tr>
                        </tbody>
                    </table>
                     <h3 class="text-center">Thông tin đặt hàng</h3>
                     <table class="table table-striped table-bordered">
                        <tr>
                            <td><b>Họ Tên</b></td>
                            <td><?=$order['ho_ten']?></td>
                            <td><b>Số điện thoại</b></td>
                            <td><?=$order['dien_thoai']?></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td><?=$order['email']?></td>
                            <td><b>Thanh toán</b></td>
                            <td><?=$hinhthuc['ten_vn']?></td>
                        </tr>
                        <tr>
                            <td><b>Địa chỉ:</b></td>
                            <td colspan="3"><?=$order['dia_chi']?>, <?=$order['quan']?>, <?=$order['thanh_pho']?></td>
                        </tr>
                     </table>
                     
                    <?php if(isset($_GET['vpc_AdditionData'])){?>
                    <?php if($hashValidated=="CORRECT" && $txnResponseCode !="0"){ ?>
                    <h4 style="color: red;" >Chọn phương thức thanh toán khác</h4>
                    <form method="POST" action="?com=cart-success&donhang=<?=$_GET['donhang']?>">
                       <ul style="list-style: none;padding: 0px;">
                           <?php 
                           $_hinhthucthanhtoan = $d->o_fet("select * from #_hinhthucthanhtoan where hien_thi=1 and id <>6 order by ten_vn asc");
                           foreach ($_hinhthucthanhtoan as $httt) {
                           ?>
                           <li>
                               <label style="font-weight: 500;"><input type="radio" name="pt_thanhtoan" value="<?=$httt['id'] ?>" /> <?=$httt['ten_'.$lang] ?></label>
                           </li>
                           <?php } ?>
                        </ul> 
                        <div class="text-center">
                            <button style="background-color:#85b0c5;" type="submit" name="huy" class="btn btn-login">Hủy đơn hàng</button>
                            <button type="submit" name="capnhat" class="btn btn-login">Cập nhật</button>
                            <div style="clear: both;"></div>
                        </div>
                    </form>
                     
                    <?php }else{ ?>
                     <div><?=$thanhcong['noi_dung_vn']?></div>
                    <?php }}else{?>
                    <div>
                        <strong>Hướng dẫn thanh toán:</strong>
                        <?=$hinhthuc[noi_dung_vn]?>
                     </div>
                     <?php if($_GET['thanhtoan']!='6' && $hashValidated=="CORRECT" && $txnResponseCode =="0"){ ?>
                     <hr>
                     <div>
                         <?=$thanhcong['noi_dung_vn']?>
                     </div>
                     <?php }else{?>
                     <hr>
                     <div>
                         <?=$thanhcong['noi_dung_vn']?>
                     </div>
                     <?php }
                     $tongtien = $thanhtien2*100;
                    $id_giaodich = $d->chuoird('10');
                     ?>
                     <?php if($_GET['thanhtoan']==6){ ?>
                    <form method="POST" action="">
                        <input type="hidden" name="Title" value="THANH TOAN DON HANG <?=$_GET['donhang']?>">
                        <input type="hidden" name="vpc_AccessCode" value="D67342C2">
                        <input type="hidden" name="vpc_MerchTxnRef" value="<?=$id_giaodich?>">
                        <input type="hidden" name="vpc_OrderInfo" value="<?=$_GET['donhang']?>">
                        <input type="hidden" name="vpc_Amount" value="<?=$tongtien?>">
                        <input type="hidden" name="vpc_Version" value="2">
                        <input type="hidden" name="vpc_Command" value="pay">
                        <input type="hidden" name="vpc_Locale" value="vn">
                        <input type="hidden" name="vpc_Currency" value="VND">
                        <input type="hidden" name="vpc_ReturnURL" value="<?=URLPATH?>?com=cart-success&donhang=<?=$_GET['donhang']?>">
                        <input type="hidden" name="vpc_Customer_Id" value="<?= $d->vn_to_str($order['ho_ten']) ?>">
                        <input type="hidden" name="vpc_Customer_Phone" value="<?=$order['dien_thoai']?>">
                        <input type="hidden" name="vpc_Customer_Email" value="<?=$order['email']?>">
                        <input type="hidden" name="virtualPaymentClientURL" value="https://mtf.onepay.vn/onecomm-pay/vpc.op">
                        <input type="hidden" name="vpc_SHIP_Street01" value="<?=$d->vn_to_str($order['dia_chi'])?>" />
                        <input type="hidden" name="vpc_SHIP_Provice" value="<?=$d->vn_to_str($order['quan'])?>" />
                        <input type="hidden" name="vpc_SHIP_City" value="<?=$d->vn_to_str($order['thanh_pho'])?>" />
                        <input type="hidden" name="vpc_SHIP_Country" value="Viet Nam" />
                        <input type="hidden" name="vpc_Merchant" value="ONEPAY">
                        <div class="text-center">
                            <button style="background-color:#85b0c5;" type="submit" name="huy" class="btn btn-login">Hủy đơn hàng</button>
                            <button type="submit" name="thanhtoan" class="btn btn-login">Thanh toán</button>
                        <div style="clear: both;"></div>
                        </div>
                    </form>
                     <?php }?>
                      <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }else{ 
   // header("Location:".URLPATH."gio-hang.html");
} ?>

