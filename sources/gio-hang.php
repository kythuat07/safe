<?php
$thanhpho = $d->o_fet("select * from #_thanhpho where hien_thi=1 order by ten_vn asc");
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(isset($_POST['addcart'])){
        $id = $_POST['id'];
        $soluong = isset($_POST['soluong'])?$_POST['soluong']:1;
        $soluong = (int)$soluong;
        $color = addslashes($_POST['color']);
        $size = addslashes($_POST['size']);
        $detail = $d->simple_fetch("select * from #_sanpham where id={$id}");
        if(!empty($detail)){
            $id_pro = $detail['id'];
            if(isset($_SESSION['cart'][$id_pro])){
                $_SESSION['cart'][$id_pro]['so_luong'] = $_SESSION['cart'][$id_pro]['so_luong'] + $soluong;
                $_SESSION['cart'][$id_pro]['mau'] =  $color;
                $_SESSION['cart'][$id_pro]['size'] =  $size;
            }
            else{
                $_SESSION['cart'][$id_pro]['so_luong'] = $soluong;
                $_SESSION['cart'][$id_pro]['mau'] =  $color;
                $_SESSION['cart'][$id_pro]['size'] =  $size;
            }
        }
    }

    if(isset($_POST['guidonhang'])){
        $chuoi1 = strtolower($_SESSION['captcha_code']);
        $chuoi2 = strtolower($_POST['captcha']);
        if($chuoi1 == $chuoi2){
            if(isset($_SESSION['cart'])){
                //kiem tra so luong don hang
                    if(isset($_SESSION['madonhang'])){
                        unset($_SESSION['madonhang']);
                    }
                    $ma_donhang = 'DH'.$d->chuoird('5');
                    $_SESSION['madonhang'] = $ma_donhang;
                    $d->reset();

                    $data['trang_thai'] = 0;
                    $data['ho_ten'] = $d->clear($_POST['ten']);
                    $data['email'] = $d->clear($_POST['email']);
                    $data['dia_chi'] = $d->clear($_POST['diachi']);
                    // $quan = $d->simple_fetch("select * from #_quan where id=".$_POST['quan_tt']." ");
                    // $data['quan'] = $quan['ten_vn'];
                    // $thanhpho= $d->simple_fetch("select * from #_thanhpho where id=".$_POST['thanh_pho_tt']." ");
                    // $data['thanh_pho'] = $thanhpho['ten_vn'];
                    // $data['phi_ship'] = $_POST['phi_ship'];
                    // $data['ngay_nhan'] = substr( $_POST['ngay_nhan'],  8, 2).'-'.substr( $_POST['ngay_nhan'],  5, 2).'-'.substr( $_POST['ngay_nhan'],  0, 4);

                    $data['dien_thoai'] = $d->clear($_POST['dienthoai']);
                    $data['hinh_thuc_thanh_toan'] = $d->clear($_POST['thanhtoan']);
                    $data['loi_nhan'] = addslashes($_POST['loinhan']);
                    $data['ma_dh'] = $ma_donhang;
                    $data['ngay_dat_hang'] = time();
                    if(isset($_POST['nhan_khac'])){
                        $data['ho_ten_2'] = $d->clear($_POST['ten2']);
                        $data['email_2'] = $d->clear($_POST['email2']);
                        $data['dien_thoai_2'] = $d->clear($_POST['dienthoai2']);
                        $tablenhan='<table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                            <tbody>
                                <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                    <td colspan="2" style="color:#000"><b>Th??ng tin ng?????i nh???n h??ng</b></td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">H??? t??n</td>
                                    <td style="background-color:white;color:#000">'.$data['ho_ten_2'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">Email</td>
                                    <td style="background-color:white;color:#000">'.$data['email_2'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">??i???n tho???i</td>
                                    <td style="background-color:white;color:#000">'.$data['dien_thoai_2'].'</td>
                                </tr>
                            </tbody>
                        </table>';
                    }  else {
                        $tablenhan="";
                    }

                    $d->setTable('#_dathang');
                    if($id_don = $d->insert($data)){

                        $hinhthuc = $d->simple_fetch("select * from #_hinhthucthanhtoan where id={$data['hinh_thuc_thanh_toan']}");
                        $row_nd = "";
                        $total = 0;
                        $tong = 0;

                        foreach($_SESSION['cart'] as $key => $value) {

                            $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
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
                            <td style="background-color:white;color:#000;text-align:right">'.number_format($price).' VN??</td>
                            <td style="background-color:white;color:#000;text-align:right">'.number_format($price*$value['so_luong']).' VN??</td>
                        </tr>                       
                                                ';
                                            }
                                        }

                                            $noidung = '
                        <h3><b>M?? ????n h??ng: '.$ma_donhang.'</b></h3><br>                 
                        <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                            <tbody>
                                <tr style="background: linear-gradient(#ffffff, #f1f1f1);font-weight:bold">
                                    <td style="color:#000">S??? l?????ng</td>
                                    <td style="color:#000">H??nh ???nh</td>
                                    <td style="color:#000">T??n</td>
                                    <td style="color:#000">Gi??</td>
                                    <td style="color:#000">Th??nh ti???n</td>
                                </tr>'.$row_nd.'
                                <tr>
                                    <td colspan="4" style="text-align:right">T???ng ti???n:</td>
                                    <td style="text-align:right">'.number_format($tongtien).' VN??</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align:right">Ph?? v???n chuy???n:</td>
                                    <td style="text-align:right">'.number_format($data['phi_ship']).'</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="background-color:white;color:#000"></td>
                                    <td style="background-color:white;color:#000;text-align:right"><b>T???ng ti???n c???n ph???i thanh to??n:</b></td>
                                    <td style="background-color:white;color:#000;text-align:right;color:red"><b>'.number_format($tientong).' VN??</b></td>
                                </tr>
                            </tbody>
                        </table>                

                        <br></br>               

                        <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                            <tbody>
                                <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                    <td colspan="2" style="color:#000"><b>Th??ng tin kh??ch h??ng</b></td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">H??? t??n</td>
                                    <td style="background-color:white;color:#000">'.$data['ho_ten'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">Email</td>
                                    <td style="background-color:white;color:#000">'.$data['email'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">??i???n tho???i</td>
                                    <td style="background-color:white;color:#000">'.$data['dien_thoai'].'</td>
                                </tr>
                            </tbody>
                        </table> 
                        '.$tablenhan.'
                        <table style="width:100%;min-width:800px;margin:auto;background-color:#ccc;font-size:14px;font-family:Tahoma,Geneva,sans-serif;line-height:20px" border="0" cellpadding="8" cellspacing="1">
                            <tbody>
                                <tr style="background: linear-gradient(#ffffff, #f1f1f1);">
                                    <td colspan="2" style="color:#000"><b>Chi ti???t giao h??ng</b></td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">?????a ch???</td>
                                    <td style="background-color:white;color:#000">'.$data['dia_chi'].', '.$data['quan'] .', '.$data['thanh_pho'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">Th???i gian giao h??ng</td>
                                    <td style="background-color:white;color:#000">'.$data['ngay_nhan'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">H??nh th???c thanh to??n</td>
                                    <td style="background-color:white;color:#000">'.$hinhthuc['ten_'.$_SESSION['lang']].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">?????a ch???</td>
                                    <td style="background-color:white;color:#000">'.$data['dia_chi'].', '.$data['quan'] .', '.$data['thanh_pho'].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">H??nh th???c thanh to??n</td>
                                    <td style="background-color:white;color:#000">'.$hinhthuc['ten_'.$_SESSION['lang']].'</td>
                                </tr>
                                <tr>
                                    <td style="background-color:white;color:#000">Ghi ch??</td>
                                    <td style="background-color:white;color:#000">'.$data['loi_nhan'].'</td>
                                </tr>
                            </tbody>
                        </table> 
                        ';
                        $madh = $ma_donhang;
                            if($_POST['thanhtoan'] ==0){
                                    header("Location:".URLPATH."?com=cart-success&donhang=".$madh.'&thanhtoan=6');
                            }else{
                                include "./smtp/index.php";
                                $thongtin = $d->simple_fetch("select * from #_thongtin limit 0,1");
                                unset($_SESSION['cart']);
                               // sendmail("B???n c?? 1 ????n ?????t h??ng m???i!", $noidung, $data['email'] , $email ,  $data['ho_ten']);
                                sendmail("B???n ???? ?????t h??ng th??nh c??ng!", $noidung, $email , $data['email'] ,  $ten_cong_ty);
                                // sendmail("B???n c?? 1 ????n ?????t h??ng m???i!", $noidung, $thongtin['email'] , $thongtin['email'] , $data['ho_ten'], $thongtin['email_smtp'], $thongtin['pass_smtp'] );
                                // sendmail("Buy successful!", $noidung, $thongtin['email'] , $data['email'] , $thongtin['name_email'], $thongtin['email_smtp'], $thongtin['pass_smtp'] );

                                header("Location:".URLPATH."?com=cart-success&donhang=".$madh.'&thanhtoan='.$_POST['thanhtoan']);
                            }

                }else{
                    $d->alert("The order has been sent or cart empty!");
                } 
            }
        }else{
            $d->alert("Security code is incorrect");
        }
    }

    
    
    if(isset($_POST['capnhatsl'])){
        $id = addslashes($_POST['id']);
        $soluong = addslashes($_POST['soluong']);
        $d->reset();
        $data['so_luong'] = $soluong;
        $d->setWhere('id',$id);
        $d->setTable('#_chitietdathang');
        if(is_numeric($soluong) && $soluong>0){
            if($d->update($data)){
                $d->location(URLPATH."gio-hang.html");
            }
        }else {
            $d->alert("Gi??? h??ng tr???ng");
        }
    }

    if(isset($_POST['xoasp'])){
        $id = addslashes($_POST['id']);
        $d->reset();
        $d->setWhere('id',$id);
        $d->setTable('#_chitietdathang');
        if($d->delete()){
            $d->location(URLPATH."gio-hang.html");
        }
    }

    if(isset($_POST['xoaall'])){
        $d->reset();
        $d->setWhere('id_dh',@$_SESSION['iddonhang']);
        $d->setTable('#_chitietdathang');
        if($d->delete()){
             $d->location(URLPATH."gio-hang.html");
        }
    }

if(isset($_SESSION['id_thanhvien']) and $_SESSION['id_thanhvien'] !=""){
    $row = $thongtin = $d->simple_fetch("select * from #_thanhvien where id = ".$_SESSION['id_thanhvien']." ");
}
?>
</div>

<style type="text/css">
    .table tr th a{ color: #000; }
    .wrapper-contai{ position: static; }

</style>
<div class="container mb-5">
     <h1 class="title-home"><span>Gi??? h??ng</span></h1>
    <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
        <li property="itemListElement" typeof="ListItem"> 
            <a property="item" typeof="WebPage" href="http://demo10.phuongnamvina.vn/"> 
                    <span property="name"><?= _trangchu ?></span>
            </a> <meta property="position" content="1"> 
        </li>

        <li property="itemListElement" typeof="ListItem"> 
            <a class="active" property="item" typeof="WebPage" href="<?=URLPATH.$com?>.html"> 
                <span property="name"><?= _cart ?></span>
            </a> <meta property="position" content="2"> 
        </li>
    </ol>
    <?php if(isset($_SESSION['cart'])){ ?>
    <div class="row">
        <div class="col-md-4" >
            <h3 class="title-home" style="font-size: 15px;border: none;text-align: center;margin-bottom: 5px;">Th??ng tin ?????t h??ng</h3>
            <!-- <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mua nhanh</a></li>
                <li><a data-toggle="tab" href="#menu1">????ng nh???p th??nh vi??n</a></li>
    </ul> -->
            <div class="tab-content" style="background-color: #f3f3f3;padding: 15px;">
                <div id="home" class="tab-pane fade in active show">
                  <div class="login">
                    <form action="" id="form-shopping" method="post" >
                        <div class="row">
                            <div class="form-group col-sm-12 ">
                                <input value="<?= @$row['ho_ten']?>" required placeholder="Nh???p h??? t??n (*)" type="text" class="form-control" id="ten" name="ten" data-error="<?=_typehoten?>">
                            </div> 
                            <div class="form-group col-sm-6 ">
                                <input value="<?= @$row['email']?>" placeholder="Nh???p email (n???u c??)" type="email" class="form-control" id="email" name="email" data-error="<?=_type_email?>">
                            </div>
                            <div class="form-group col-sm-6">
                                <input value="<?= @$row['so_dt']?>" placeholder="Nh???p s??? ??i???n tho???i(*)" required type="text" class="form-control" id="dienthoai" name="dienthoai" data-error="<?=_typesodienthoai?>">
                            </div>
                        </div>
                        <!-- <div class="checkbox">
                            <label style="font-weight: bold;">
                                <input name="nhan_khac" id="nhan_khac" type="checkbox"> Ng?????i nh???n l?? ng?????i kh??c
                            </label>
                        </div>
                        <div id="tt_nhan" style="display: none;">
                            <div class="row">
                                <div class="form-group col-sm-12 p5">
                                    <label for="ten2"><?=_hoten?> (<font class="red">*</font>)</label>
                                    <input value="" type="text" class="form-control" id="ten2" name="ten2">
                                </div>
                                <div class="form-group col-sm-6 p5">
                                    <label for="email2">Email (<font class="red">*</font>)</label>
                                    <input value=""  type="email" class="form-control" id="email2" name="email2">
                                </div>
                                <div class="form-group col-sm-6 p5">
                                    <label for="dienthoai2">??i???n tho???i (<font class="red">*</font>)</label>
                                    <input value=""  type="text" class="form-control" id="dienthoai2" name="dienthoai2" >
                                </div>
                            </div>

    </div> -->
                        <div class="form-group">
                            <input value="<?= @$row['dia_chi']?>" type="text" placeholder="Nh???p ?????a ch??? giao h??ng" required class="form-control" id="diachi" name="diachi" data-error="<?=_typeaddress?>">
                        </div>
                        <!--div class="row m-5">
                            <div class="col-sm-6 p5">
                                <div class="form-group">
                                    <label>T???nh/Th??nh ph??? (<font class="red">*</font>)</label>
                                    <select required name="thanh_pho_tt" class="tp_1 form-control" onchange="getDistrict(this,'.quan_1')">
                                        <option value="">Ch???n t???nh/th??nh ph???</option>
                                        <?php foreach ($thanhpho as $key => $value): ?>
                                        <option  value="<?=$value['id']?>"><?=$value['ten_vn']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 p5">
                                <div class="form-group">
                                    <label for="huyen">Qu???n/huy???n (<font class="red">*</font>)</label>
                                    <select required name="quan_tt" class="quan_1 form-control">
                                        <option value="">Ch???n qu???n/huy???n</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 p5">
                                <label for="ngay_nhan">Ng??y nh???n h??ng (<font class="red">*</font>)</label>
                                <input value="<?= @$row['ngay_nhan']?>" type="date" class="form-control" id="ngay_nhan" name="ngay_nhan" >
                            </div>
                        </div-->
                        <input value="0" type="hidden" id="inp_phiship" name="phi_ship">

                        <div class="form-group">
                            <textarea id="loinhan" required placeholder="Nh???p l???i nh???n" class="form-control" rows="3" name="loinhan"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="thanhtoan"><?= _payment_methods ?></label>
                            <select name="thanhtoan" class="form-control" id="thanhtoan">
                                <?php 
                                    $_hinhthucthanhtoan = $d->o_sel("*","#_hinhthucthanhtoan","hien_thi = 1","so_thu_tu asc");
                                    foreach ($_hinhthucthanhtoan as $httt) {
                                ?>
                                <option value="<?=$httt['id'] ?>" <?php if(!empty($_POST['thanhtoan']) && $_POST['thanhtoan'] == $httt['id'] ) echo 'selected="selected"' ?>><?=$httt['ten_'.$lang] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" placeholder="Nh???p m?? b???o v???" id="captcha" name="captcha" style="background: url(./sources/capchaimage.php) center right no-repeat">
                        </div>
                        <div class="form-group">                        
                            <button type="submit" class="btn btn-login" name="guidonhang"><?=_sendcart?></button>
                             <div class=" clearfix"></div>
                        </div>
                       
                    </form> 
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-8">
            <div class="page-cart">
                <div class="info-cart">
                    <div class="">
                        <h3 class="title-home" style="font-size: 15px;border: none;text-align: center;margin-bottom: 5px;">Chi ti???t ????n h??ng</h3>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered ">
                                <tbody>
                                    <tr>
                                        <th style="width:3%">STT</th>
                                        <!-- <th style="width:7%;" align="left">Images</th> -->
                                        <th style="width:25%;" class=""><?=_namepro?></th>
                                        <th style="width:15%; text-align: center;"><?=_price?></th>
        
                                        <th style="width:10%;" align="center" class="th_soluong"><?=_number?></th>
                                        <th style="width:15%;" ><?=_money?></th>
                                        <th style="width:10%;" >
                                            <?=_del?>
                                        </th>
                                    </tr>
                                    <?php
                                            $stt = 0;
                                            $tongtien = 0;

                                        if(count($_SESSION['cart'])>0){ 
                                            foreach ($_SESSION['cart'] as $key => $value) {
                                            $product = $d->simple_fetch("select * from #_sanpham where id={$key}");
                                            if(!empty($product)){
                                                $id_product = $product['id'];
                                                $price = $product['gia'];
                                                if($product['khuyen_mai'] > 0){
                                                    $price = $product['khuyen_mai'];
                                                }
                                                $tongtien = $tongtien + ($price*$value['so_luong']);
                                            $stt++;
                                            ?>
                                            <tr>
                                                <td><?=$stt?></td>
                                                <!-- <td align="left">
                                                    <img onerror="this.src='./img/noImage.gif';" src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=@$sanpham[0]['hinh_anh'] ?>&w=50&h=50">
                                                </td> -->
                                                <td>
                                                    <a href="<?=URLPATH.$product['alias_'.$_SESSION['lang']] ?>.html" >
                                                        <?=@$product['ten_'.$_SESSION['lang']]?>
                                                    </a>
                                                </td>
                                                <td align="left"><strong><?=@$d->vnd($price)?></strong></td>
                
                
                                                <td align="center">
                                                    <input name="soluong" style="width: 50px;" type="number" value="<?= $value['so_luong'] ?>" onchange="chang_soluong(this,'<?=$product['id'] ?>','<?=$_SESSION['iddonhang'] ?>')" class="text-center soluong_<?= $value['soluong'] ?>">   
                                                    
                                                </td>
                                                
                                                <td align="left">
                                                    <div id="thanhtien_117" class="thanhtien_<?=$val['id'] ?> color-main">
                                                    <?php
                                                        echo $d->vnd($price*$value['so_luong']);
                                                    ?>
                                                    </div>
                                                </td>
                                                 <td align="left">
                                                    <a href="javascript:;" onclick="xoa_sp_gh_dh('<?=$product['id'] ?>','<?=$_SESSION['iddonhang'] ?>','<?=_redel?>?')" title="X??a s???n ph???m"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                    <?php }}} ?>
                                    <tr>
                                        <td colspan="5"  class="text-right"><?= _totalmoney ?>:</td>
                                        <td class="text-right"><font class="color-main"><?=$d->vnd($tongtien)?></font></td>
                                    </tr>
                                    <!--tr>
                                        <td colspan="5"  class="text-right">Ph?? v???n chuy???n:</td>
                                        <td class="text-right"><span id="phi_ship">0</span></td>
                                    </tr-->
                                    <tr>
                                    <td colspan="2" style="border-right: 0">
                                    <div class="mua-tiep">
                                        <a href="<?=URLPATH?>" style="color: red;"><?= _continue ?></a>
                                    </div>
                                    </td>
                                    <td colspan="4" style="border-left: 0;">
                                        <div class="tong_tt">
                                        <h3 class="text-right"><span><?= _payment_total ?>:</span> <font id="tong_tien_gh" class="color-main"><?=$d->vnd($tongtien)?></font></h3>
                                        </div>
                                    </td>

                                    </tr>
                                </tbody>
                            </table>    
                        </div>  
                    </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
                
    <div class="well text-center">
        <a href="javascript:history.back()"><?=_cartblank?></a>
    </div>

    <?php } ?>
</div>


<style type="text/css">
    table th, table td{ text-align: center; }
    #form-shopping button.button{ margin-right: 15px; }
</style>

<script>
    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }
    //$('.quan_1').change(function(){
       // phi_ship = $(".quan_1 option:selected").attr('data_ship');
        //$("#phi_ship").html(formatNumber(phi_ship, ',', '.')+' <sup>??</sup>');
        //thanhtien = Number(<?=$tongtien ?>)+Number(phi_ship);
        //$("#tong_tien_gh").html(formatNumber(thanhtien, ',', '.')+' <sup>??</sup>');
        //$("#inp_phiship").val(phi_ship);
    //});
    $('#nhan_khac').click(function(){
        if($(this).is(":checked")){
            $("#tt_nhan").show();
        }
        else if($(this).is(":not(:checked)")){
            $("#tt_nhan").hide();
        }
    });
function getDistrict(_this, el){
    var id = _this.value;
    $.ajax({
        url: './sources/ajax.php',
        type: 'POST',
        data: {do: 'get_quan', id: id},
    })
    .done(function(data) {
        $(el).html(data);
    });

}
function xoa_sp_gh_dh(id,iddh,al){
    var cf = confirm(al);
    if(cf){
        $.ajax({
            url: "./sources/ajax.php",
            type:'POST',
            data:{'do':'xoa_sp_gh','id':id,'iddh':iddh},
            success: function(data){
                window.location.href="<?=URLPATH ?>gio-hang.html";
            }
        })
    }
}

function thanhtien(id,iddh){
    var cls = ".thanhtien_"+id;
    $.ajax({
        url: "./sources/ajax.php",
        type:'POST',
        data:{'do':'thanh_tien','id':id,'iddh':iddh},
        success: function(data){
            $(cls).html(data);
        }
    })
}

function tongtien(id,iddh){
    $.ajax({
        url: "./sources/ajax.php",
        type:'POST',
        data:{'do':'tong_tien','id':id,'iddh':iddh},
        success: function(data){
            $("#tong_tien_gh").html(data);
        }
    })
}
function chang_soluong(obj,id,iddh){
    var sl = $(obj).val();
    $.ajax({
        url: "./sources/ajax.php",
        type:'POST',
        data:{'do':'change_so_luong','id':id,'iddh':iddh,'sl':sl},
        success: function(data){
            if(data == 0){
                alert("S??? l?????ng nh???p kh??ng h???p l???!");
            }else{
                console.log(data);
                window.location.href="<?=URLPATH ?>gio-hang.html";
                // thanhtien(id,iddh);
                // tongtien(id,iddh);
            }
        }
    })
}

</script>