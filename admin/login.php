<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    @define('_template','/templates/');
    @define('_source','/sources/');
    @define('_lib','/lib/');

    include "lib/config.php";
    include "lib/function.php";
    global $d;
    $d = new func_index($config['database']);
    
    if(isset($_POST['login'])){
        $user_hash = sha1($d->clean(addslashes($_POST['input-username'])));
        $pass_hash = sha1($d->clean(addslashes($_POST['input-password'])));
        
        $login = $d->o_fet("select * from #_user where user_hash = '$user_hash' and pass_hash = '$pass_hash' and quyen_han>=1");
       
        if(count($login)>0 && $pass_hash==$login[0]['pass_hash']) {
            $_SESSION['id_user'] = $login[0]['id'];
            $_SESSION['user_admin'] = $login[0]['tai_khoan'];
            $_SESSION['user_hash'] = $user_hash;
            $_SESSION['quyen'] = @$login[0]['quyen_han'];
            $_SESSION['name'] = @$login[0]['ho_ten'];
            $_SESSION['is_admin'] = $login[0]['is_admin'];
            
            $d->location("index.php");
        }else{
            $err = 'Tài khoản hoặc mật khẩu chưa đúng.';
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập hệ thống</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="./css/style.min.css" rel="stylesheet" />
    <link href="./css/style_responsive.css" rel="stylesheet" />
    <link href="./css/style_default.css" rel="stylesheet" id="style_color" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .login-header{
            width: 630px;
            margin: 60px auto 0;
            border-radius: 5px;
            height: auto;
        }
        .login-header .alert-custom h3{
            font-size: 16px;
            margin-top: 0px;
            text-align: left;
            line-height: 18px;
            padding-left: 10px;
            font-weight: 600;
        }
        .login-header .alert-custom{
            padding: 20px 10px 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .huong-dan{
            text-align: left;
            padding-left: 0px;
            font-size: 14px;
        }
        .huong-dan ol li{
            line-height: 27px;
            font-size: 16px;
        }
        .red{ color: red; }
        #login{
            margin-top: 0px;
            width: 590px;
            padding-bottom: 30px;
        }
        #login .lock{
            width: 210px;
            text-align: center;
            font-size: 160px;
            margin-top: 0px;
            margin-top: 20px;
        }
        #login-body{
            background-color: #fff !important;
            background-image: none !important;
        }
        .control-wrap{
            margin-bottom: 15px;
            width: 350px;
        }
        #login .control-group {
            margin-bottom: 0px;
        }
        #login input.txt{
            width: 292px;
        }
        @media(max-width: 991px){
            #login{ margin-top: 110px !important;}
            .login-header{ width: 100%; margin-top: 40px;  }
            .login-header .alert-custom h3{ font-size: 13px; line-height: 20px; }
            .huong-dan{ padding: 0; font-size: 12px; }
        }
        @media(max-width: 767px){
            .control-wrap{
                width: 260px;
            }
            .control-wrap h4{ text-align: center; }
            #login{ margin-top: 0px !important;}
            #login input.txt {
                width: 200px;
            }
            .login-header .alert-custom{
        
            }
        }
        @media(max-width: 320px){
            .huong-dan{ padding: 0; font-size: 11px; }
        }
        
        
    </style>
</head>
<body id="login-body">
    <div class="login-header">
        <div class="alert alert-success alert-custom">
            <h3>Nếu cần hỗ trợ kỹ thuật, quý khách vui lòng thực hiện một trong ba cách sau:</h3>
            <div class="huong-dan">
                <ol>
                    <li>Truy cập: <a href="https://supportphuongnamvina.com/" target="_blank"><strong style="color: red;">supportphuongnamvina.com</strong></a> và gửi yêu cầu hỗ trợ.</li>
                    <li>Gửi email cho phòng kỹ thuật: <strong style="color: red;">kythuat@phuongnamvina.vn.</strong></li>
                    <li>Gọi số Hotline Hỗ Trợ Khách Hàng: <strong style="color: red;">0915101017, 0912817117.</strong></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="login">
        <form id="loginform" class="form-vertical no-padding no-margin" action=""  method="post" >
            <div class="lock">
                <i class="icon-lock"></i>
            </div>
            <div class="control-wrap">
                <h4 style="text-transform: uppercase;margin-bottom: 20px;font-size: 16px;">Đăng nhập hệ thống</h4>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">
                                <i class="icon-user"></i>
                            </span>
                            <input id="input-username" name="input-username" class="txt" onchange="coockie()" type="text" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">
                                <i class="icon-key"></i>
                            </span>
                            <input id="input-password" name="input-password" class="txt" type="password" placeholder="Password" />
                        </div>
                        <div>
                            <font class='err' style="color: red"><?=@$err?></font>
                        </div>
                        <div class="mtop10">
                            <div class="block-hint pull-left small">
                                <input type="checkbox" name="checkbox" id="" /> Ghi nhớ 
                            </div>
                            <div class="block-hint pull-right">
                                <a href="javascript:;" class="" id="forget-password">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="clearfix space5"></div>
                    </div>
                </div>
            </div>
            <input type="submit" id="login-btn" name="login" onclick="return kiem_tra_login()" class="btn btn-block login-btn" value="Đăng nhập" />
        </form>
        <form id="forgotform" class="form-vertical no-padding no-margin hide" action="" />
                <p class="center">Nhập địa chỉ email đã đăng ký với user.</p>
                <div class="control-group"><div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <input id="input-email" name="quen_mat_khau" type="text" placeholder="Email" />
                    </div>
                </div>
                <div class="space20"></div>
            </div>
            <input type="button" id="forget-btn" class="btn btn-block login-btn" value="Submit" />
        </form>
    </div>
    <div id="login-copyright"> <a href="http://phuongnamvina.vn/" rel="nofollow" target="_blank" title="Thiết kế website: Phương Nam Vina">Thiết kế website: Phương Nam Vina</a> </div>
    <script src="./js/jquery-1.8.3.min.js"></script><script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/jquery.blockui.js"></script>
    <script type="text/javascript" charset="utf-8" async defer>
        function kiem_tra_login(){
            if($("#input-username").val() == ''){
                $("#input-username").focus();
                $(".err").text("Chưa nhập tên tài khoản");
                return false;
            }else if($("#input-password").val() == ''){
                $("#input-password").focus();
                $(".err").text("Chưa nhập mật khẩu");
                return false;
            }else return true;
        }
    </script>

    <style type="text/css">
        
    </style>
</body>
</html>
