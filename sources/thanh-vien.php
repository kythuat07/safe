<?php
if(isset($_SESSION['id_thanhvien']) and $_SESSION['id_thanhvien']!=""){
    
}else{
    $d->redirect(URLPATH);
}
if(isset($_SESSION['id_thanhvien']) and $_SESSION['id_thanhvien'] !=""){
    $row = $thongtin = $d->simple_fetch("select * from #_thanhvien where id = ".$_SESSION['id_thanhvien']." ");
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
                <span property="name">Thành viên</span>
            </a> <meta property="position" content="2"> 
        </li>
    </ol>
     <div class="row">
         <div class="col-sm-3">
             <ul class="nav-thanhvien">
                 <li class="active"><a data-toggle="tab" href="#home">Thông tin thành viên</a></li>
                 <li><a data-toggle="tab" href="#menu1">Lịch sử mua hàng</a></li>
             </ul>
         </div>
         <div class="col-sm-9" style="border-left: 1px dashed #ccc;">
             <div class="tab-content">
                 <div id="home" class="tab-pane fade in active">
                     <form method="POST" action="" class="form-login form-thongtin" id="dang_ky_form">
                         <h3>Thông tin thành viên</h3>
                         <?php if(isset($thongbaocapnhat)){ ?>
                         <div class="alert alert-success" role="alert">
                             <?= $thongbaocapnhat ?>
                         </div>
                         <?php } ?>
                         <div class="row">
                         <?php if($com==""){$url = URLPATH; }  else {$url = URLPATH.$com."html";} ?>
                             <div class="form-group col-sm-6">
                                 <label>Họ Tên</label>
                                 <input type="text" value="<?=@$row['ho_ten']?>" class="form-control" name="ho_ten" placeholder="Nhập họ tên" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <label>Ngày sinh</label>
                                 <input type="text" value="<?=@$row['ngay_sinh']?>" class="form-control" name="ngay_sinh" placeholder="Nhập ngày sinh" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <label>Số điện thoại</label>
                                 <input value="<?=@$row['so_dt']?>" type="text" class="form-control" name="so_dt" placeholder="Nhập họ tên" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <label>Email</label>
                                 <input type="email" value="<?=@$row['email']?>" class="form-control" name="email" placeholder="Nhập email" />
                             </div>
                             <div class="form-group col-sm-12">
                                 <label>Địa chỉ</label>
                                 <input type="text" value="<?=@$row['dia_chi']?>" class="form-control" name="dia_chi" placeholder="Nhập địa chỉ" />
                             </div>
                         </div>
                         <div class="login-tool">
                             <button type="submit" name="update"  class="btn btn-login">Cập nhật</button>
                         </div>
                     </form>
                     <form method="POST" action="" class="form-login form-thongtin" id="dang_ky_form">
                         <h3>Đổi mật khẩu</h3>
                         <?php if(isset($thongbaomatkhau)){ ?>
                         <div class="alert alert-success" role="alert">
                             <?= $thongbaomatkhau ?>
                         </div>
                         <?php } ?>
                         <div class="row">
                             <div class="form-group col-sm-6">
                                 <label>Mật khẩu cũ</label>
                                 <input type="password" class="form-control" name="mat_khau_old" placeholder="Nhập mật khẩu cũ" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <label>mật khẩu mới</label>
                                 <input type="password" class="form-control" name="mat_khau_new" placeholder="Nhập mật khẩu mới" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <label>Nhập lại mật khẩu</label>
                                 <input type="password" class="form-control" name="mat_khau_2" placeholder="Nhập lại mật khẩu" />
                             </div>
                             <div class="form-group col-sm-6">
                                 <button style="margin-top: 25px;float: inherit;" type="submit" name="update_pass"  class="btn btn-login">Cập nhật mật khẩu</button>
                             </div>
                         </div>
                     </form>
                 </div>
                 <div id="menu1" class="tab-pane fade">
                      <h3>Lịch sử mua hàng</h3>
                      <table class="table table-bordered">
                         <thead>
                           <tr>
                             <th>STT</th>
                             <th>Mã đơn hàng</th>
                             <th>Ngày mua</th>
                             <th>Tổng tiền</th>
                             <th>Trạng thái</th>
                             <th>Chi tiết</th>
                           </tr>
                         </thead>
                         <tbody>
                             <?php
                                 $order = $d->o_fet("select * from #_dathang where email = '".$row['email']."' order by id DESC "); 
                                 foreach ($order as $key => $item_order) { 
                                     //echo "select * from #_chitietdathang where ma_dh = '".$item_order['ma_dh']."'";
                                     $order_chitiet = $d->o_fet("select * from #_chitietdathang where ma_dh = '".$item_order['ma_dh']."'"); 
                                     $tong=0;
                                     //print_r($order_chitiet);
                                     foreach ($order_chitiet as $key => $value) {
                                         if($value['khuyen_mai']==0){
                                             $tong = $tong+$value['gia'];
                                         }else{
                                             $tong = $tong+$value['khuyen_mai'];
                                         }
                                     }
                                     if($item_order['tinh_trang']==0){
                                         $trangthai = "Chưa xử lý";
                                     }elseif ($item_order['tinh_trang']==1) {
                                         $trangthai = "Chuẩn bị giao hàng";
                                     }else{
                                         $trangthai = "Đã giao hàng";
                                     }
                                 ?>
                                 <tr>
                                     <td><?= $key+1 ?></td>
                                     <td><?= $item_order['ma_dh'] ?></td>
                                     <td><?=date("d-m-Y",$item_order[0]['ngay_dat_hang'])?></td>
                                     <td style="text-align: right;"><?= $d->vnd($tong) ?></td>
                                     <td style="text-align: center;color: red;"><b><?= $trangthai ?></b></td>
                                     <td style="text-align: center;color: #01a1e5;"><button type="button" onclick="check_donwhang('<?= $item_order['ma_dh'] ?>')" class="label label-success" style="border: none;">Xem</button></td>
                                 </tr>
                             <?php }?>

                         </tbody>
                       </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
