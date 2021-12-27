<?php
if(isset($_GET['logout'])){
    unset($_SESSION['id_thanhvien']);
    unset($_SESSION['name_thanhvien']);
    $d->redirect(URLPATH);
}
if(isset($_GET['confirmid']) and $_GET['confirmid']!="" and isset($_GET['verificationid']) and $_GET['verificationid']!=""){
    $md5_email      =   $d->clear($_GET['confirmid']);
    $token_register =   $d->clear($_GET['verificationid']);
    $dem = $d->num_rows("select * from #_thanhvien where md5_email ='$md5_email' and token_register= '$token_register' ");
    if($dem==1){
        $row = $d->simple_fetch("select * from #_thanhvien where md5_email = '".$md5_email."' and token_register= '$token_register' ");
        $data['token_register'] = '';
        $data['trang_thai'] =  1;
        $d->setTable('#_thanhvien');
        $d->setWhere('id',$row['id']);
        if($d->update($data)){
            session_start();
            $_SESSION['id_thanhvien'] = $row['id'];
            $_SESSION['name_thanhvien'] = $row['ho_ten'];
            $d->redirect(URLPATH);
        }
    }else{
        if($com!="gio-hang"){
            $thongbaologin = "$('#myModal').modal('show')";
        }
        $error = "<b>Xác nhận thất bại!</b> Thông tin xác nhận không đúng, vui lòng kiểm tra lại</a>";
    }
}

if(isset($_POST['quen_pass'])){
    include "./smtp/index.php";
    $token_reset         =   $d->token();
    $data['token_reset']     =   $token_reset;
    $email_tv =  $_POST['email'];
    $matkhaumoi= $d->rand_string(10);
    $data['mat_khau']     =   MD5($matkhaumoi);
   
    $dem = $d->num_rows("select * from #_thanhvien where email ='$email_tv' ");
    if($dem>0){
        $noidung='<p><a href="'.URLPATH.'" title="'.$ten_cong_ty.'"><img style="height: 50px;" src="'.$logo.'" alt="hoameli.com" /></a></p>
	<p>Xin chào quý khách '.$ho_ten.',</p>
	<br>
	<p>Cảm ơn quý khách đã đăng ký tài khoản thành viên tại '.URLPATH.'.</p>
	<p>Quý khách nhận được email này bởi vì quý khách muốn lấy lại mật khẩu thành viên của '.$ten_cong_ty.'. Nếu quý khách không thực hiện, vui lòng liên hệ với chúng tôi. Vui lòng truy cập vào liên kết bên dưới để xác nhận email và hoàn thành thông tin này:</p>
	
	<p>Mật khẩu mới của quý khách là: <b>'.$matkhaumoi.'</b></p>
        
	<p><b>Trân trọng!</b></p>
	<p><i>Vui lòng không trả lời thư này!</i></p>';
        if(sendmail("Liên hệ từ website ".URLPATH, $noidung, $email, $email_tv , 'hoameli.com')) {
            $row = $d->simple_fetch("select * from #_thanhvien where email = '".$email_tv."'");
            $d->setTable('#_thanhvien');
            $d->setWhere('id',$row['id']);
            if($d->update($data)){
                if($com!="gio-hang"){
                    $thongbaologin = "$('#myModal').modal('show')";
                }
                $error = "Mật khẩu mới đã được gửi vào email của bạn";
            }
        }else{
            if($com!="gio-hang"){
                $thongbaologin = "$('#myModal').modal('show')";
            }
            $error = "<b>Gửi mail thất bại!</b> Vui lòng kiểm tra lại</a>";
        }
       
    }else{
        if($com!="gio-hang"){
            $thongbaologin = "$('#myModal').modal('show')";
        }
        $error = "<b>Email không tồn tại!</b> Vui lòng kiểm tra lại</a>";
    }
    
}
if(isset($_POST['dang_ky'])){
    include "./smtp/index.php";
    $url = $_POST['url'];
    $data['mat_khau'] = MD5($d->clear(addslashes($_POST['mat_khau'])));
    $data['ho_ten'] = $d->clear(addslashes($_POST['ho_ten']));
    $data['so_dt'] = $d->clear(addslashes($_POST['so_dt']));
    $email_tv = $d->clear(addslashes($_POST['email']));
    $data['email'] = $email_tv;
    $data['md5_email'] = MD5($email_tv);
    
    $token_register         =   $d->token();
    $data['token_register']     =   $token_register;
    $data['trang_thai']         =   0;
    $noidung='<p><a href="'.URLPATH.'" title="'.$ten_cong_ty.'"><img style="height: 50px;" src="'.$logo.'" alt="hoameli.com" /></a></p>
	<p>Xin chào quý khách '.$ho_ten.',</p>
	<br>
	<p>Cảm ơn quý khách đã đăng ký tài khoản thành viên tại '.URLPATH.'.</p>
	<p>Quý khách nhận được email này bởi vì quý khách đã vừa tạo tài khoản thành viên của '.$ten_cong_ty.'. Nếu quý khách không thực hiện, vui lòng liên hệ với chúng tôi. Vui lòng truy cập vào liên kết bên dưới để xác nhận email và hoàn thành thông tin này:</p>
	
	<p><a href="'.URLPATH.'index.php?verificationid='.$token_register.'&confirmid='.MD5($email_tv).'">'.URLPATH.'index.php?verificationid='.$token_register.'&confirmid='.MD5($email_tv).'</a></p>
	<p><b>Trân trọng!</b></p>
	<p><i>Vui lòng không trả lời thư này!</i></p>';
    $row = $d->simple_fetch("select * from #_thanhvien where email = '".$data['email']."'");
    if(count($row) == 0){
        if(sendmail("Liên hệ từ website ".URLPATH, $noidung, $email, $email_tv , 'hoameli.com')) {
            $d->setTable('#_thanhvien');
            if($id = $d->insert($data))
            {
                if($com!="gio-hang"){
                    $thongbaologin = "$('#myModal').modal('show')";
                }
                $error = "Vui lòng kiểm tra email và làm theo hướng dẫn để xác nhận đăng ký";
                //session_start();
                //$_SESSION['id_thanhvien'] = $id;
                //$_SESSION['name_thanhvien'] = $data['ho_ten'];
                //$d->redirect($url);
            }
            else{
                if($com!="gio-hang"){
                    $thongbaologin = "$('#myModal').modal('show')";
                }
                $error = "Đăng ký thất bại".$d->sql; echo mysql_error();
            }
        }else{
            if($com!="gio-hang"){
                $thongbaologin = "$('#myModal').modal('show')";
            }
            $error = "Gửi mail thất bại";
        }
        
    }  else {
        if($com!="gio-hang"){
            $thongbaologin = "$('#myModal').modal('show')";
        }
        $error = "<b>Email đã tồn tại!</b> Nhập email khác hoặc <a href=''> Lấy lại mật khẩu</a>";
    }
}

if(isset($_POST['dang_nhap'])){
    $url = $_POST['url'];
    $email      =   $d->clear(addslashes($_POST['email']));
    $matkhau    =   MD5($d->clear(addslashes($_POST['mat_khau'])));
    $row = $d->simple_fetch("select * from #_thanhvien where email = '".$email."' and mat_khau =  '".$matkhau."' ");
    if(count($row)>0){
        session_start();
        $_SESSION['id_thanhvien'] = $row['id'];
        $_SESSION['name_thanhvien'] = $row['ho_ten'];
        
    }else{
        if($com!="gio-hang"){
            $thongbaologin = "$('#myModal').modal('show')";
        }
        $error="<b>Đăng nhập thất bại!</b> Thông tin đăng nhập không chính xác";
    }
}

if(isset($_POST['update']) and isset($_SESSION['id_thanhvien'])){
    $id = $_SESSION['id_thanhvien'];
    $data['ho_ten'] = $d->clear(addslashes($_POST['ho_ten']));
    $data['so_dt'] = $d->clear(addslashes($_POST['so_dt']));
    $data['email'] = $d->clear(addslashes($_POST['email']));
    $data['dia_chi'] = $d->clear(addslashes($_POST['dia_chi']));
    $data['ngay_sinh'] = $d->clear(addslashes($_POST['ngay_sinh']));
    $d->setTable('#_thanhvien');
    $d->setWhere('id',$id);
    if($d->update($data)){
        $thongbaocapnhat="Cập nhật thành công";
    }
    else{
        $thongbaocapnhat="Cập nhật thất bại";
    }
}
if(isset($_POST['update_pass']) and isset($_SESSION['id_thanhvien'])){
    $row = $d->simple_fetch("select * from #_thanhvien where id = '".$_SESSION['id_thanhvien']."'");
    $id = $_SESSION['id_thanhvien'];
    $matkhaucu = MD5($d->clear(addslashes($_POST['mat_khau_old'])));
    $matkhaumoi = MD5($d->clear(addslashes($_POST['mat_khau_new'])));
    $matkhau2 = MD5($d->clear(addslashes($_POST['mat_khau_2'])));
    if($matkhaucu!=$row['mat_khau']){
        $thongbaomatkhau ="Mật khẩu cũ không chính xác";
    }elseif ($matkhaumoi != $matkhau2) {
        $thongbaomatkhau ="Mật khẩu không khớp";
    }  else {
        $data['mat_khau'] = $matkhaumoi;
        
        $d->setTable('#_thanhvien');
        $d->setWhere('id',$id);
        if($d->update($data)){
            $thongbaomatkhau="Cập nhật thành công";
        }else{
             $thongbaomatkhau="Cập nhật thất bại";
        }
    }
}