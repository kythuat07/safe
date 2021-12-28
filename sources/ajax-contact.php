<?php 

if(!isset($_SESSION))
{
	session_start();
}

function reponse($boolSuccess, $strMessage)
{
    echo json_encode(['success' => $boolSuccess, 'message' => $strMessage]); die;
}


error_reporting(0); 
define('_source','../sources/');
define('_lib','../admin/lib/');
@include _lib."config.php";
@include_once _lib."function.php";
$d = new func_index($config['database']);
$d->reset();

switch ($_POST['action']) {
    case 'contact':
        $d->setTable('#_lienhe');   
        $data['ho_ten'] = trim(addslashes($_POST['full_name']));
        $data['email'] = trim(addslashes($_POST['email']));
        $data['sdt'] = trim(addslashes($_POST['sdt']));
        $data['noi_dung'] = trim(addslashes($_POST['noi_dung']));
        $data['ngay_hoi'] = date("d-m-Y H:i:s");
        $data['type'] = 'contact';
        if($d->insert($data)) {
            reponse(true, 'Đăng ký tư vấn thành công.');
        }else{
            reponse(false, 'Đăng ký tư vấn không thành công.');
        }
        break;
    case 'contact-page':
        $d->setTable('#_lienhe');   
        $data['ho_ten'] = trim(addslashes($_POST['full_name']));
        $data['email'] = trim(addslashes($_POST['email']));
        $data['dia_chi'] = trim(addslashes($_POST['address']));
        $data['sdt'] = trim(addslashes($_POST['sdt']));
        $data['noi_dung'] = trim(addslashes($_POST['noi_dung']));
        $data['ngay_hoi'] = date("d-m-Y H:i:s");
        $data['type'] = 'contact-page';
        if($d->insert($data)) {
            reponse(true, 'Đăng ký tư vấn thành công.');
        }else{
            reponse(false, 'Đăng ký tư vấn không thành công.');
        }
        break;
    case 'recruitment':
        $d->setTable('#_lienhe');   
        $data['ho_ten'] = trim(addslashes($_POST['full_name']));
        $data['email'] = trim(addslashes($_POST['email']));
        $data['sdt'] = trim(addslashes($_POST['phone']));
        $data['noi_dung'] = 'Ứng tuyển vị trí: '. trim(addslashes($_POST['recruitment']));
        $data['ngay_hoi'] = date("d-m-Y H:i:s");
        $data['type'] = 'recruitment';
        if($d->insert($data)) {
            reponse(true, 'Ưng tuyển thành công.');
        }else{
            reponse(false, 'Ưng tuyển không thành công.');
        }
        break;
    case 'email':
        $d->setTable('#_lienhe');   
        $data['email'] = trim(addslashes($_POST['email']));
        $data['type'] = 'email';
        $data['noi_dung'] = 'Nhận thông tin về';
        if($d->insert($data)) {
            reponse(true, 'Đăng ký nhận thông tin thành công.');
        }else{
            reponse(false, 'Đăng ký nhận thông tin không thành công.');
        }
        break;
    default:
            reponse(false, 'Truy cập không hợp lệ.'); 
        break;
}
