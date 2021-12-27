<?php
if(!isset($_SESSION))
{
	session_start();
}
	error_reporting(0); 
	define('_source','../sources/');
	define('_lib','../admin/lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$do = addslashes($_POST['do']);

	
	if($do=='xoa_sp_gh') {
		$id = addslashes($_POST['id']);
		unset($_SESSION['cart'][$id]);		
	}
	else if($do=='thanh_tien') {
		$id = addslashes($_POST['id']);
		$iddh= addslashes($_POST['iddh']);
		$thanhtien = $d->o_fet("select * from  #_chitietdathang where id= '".$id."'");
		$tt = 0;
		if(@$thanhtien[0]['khuyen_mai'] <> 0){
			$tt = @$thanhtien[0]['so_luong']*@$thanhtien[0]['khuyen_mai'];
		}else{
			$tt = @$thanhtien[0]['so_luong']*@$thanhtien[0]['gia'];
		}
		echo $d->vnd($tt);		
	}
	else if($do=='tong_tien') {
		$id = addslashes($_POST['id']);
		$iddh= addslashes($_POST['iddh']);
		$thanhtien = $d->o_fet("select * from  #_chitietdathang where id_dh = '".$iddh."'");
		
		$tt = 0;
		if(count($thanhtien) >0 ){
			foreach ($thanhtien as $val) {
				if($val['khuyen_mai'] <> 0){
					$tt += $val['khuyen_mai']*$val['so_luong'];
				}else{
					$tt +=  $val['so_luong']*$val['gia'];
				}
			}
		}

		echo $d->vnd($tt);		
	}
	else if($do=='change_so_luong') {
		$id = addslashes($_POST['id']);
		$sl= addslashes($_POST['sl']);
		if($sl == 0){
			unset($_SESSION['cart'][$id]);
		}
		else{
			$_SESSION['cart'][$id]['so_luong'] = $sl;
		}	
		echo 1;		
	}
	else if($do=='register_email') {
		$data = "";
		$data = array(
			'email' 		=> $d->clear($_POST['email']),
			'dien_thoai' 	=> $d->clear($_POST['email2']),
			'ngay_gui' 		=> time(),
		);
		$check = $d->o_fet("select * from #_email where email='{$data['email']}'");
		if(count($check)>0) {
			echo "replace";
		}
		else {
			$d->setTable('#_email');
			if($d->insert($data)) {
				echo "ok";
			}
			else echo mysql_error();
		}
		
	}
	else if($do=='dang_ky') {
		$data = "";
		$ngay_sinh = strtotime($d->clear($_POST['ngay'])."-".$d->clear($_POST['thang'])."-".$d->clear($_POST['nam']));
		$data = array(
			'token' => $d->token(),
			'tai_khoan' => $d->username($d->clear($_POST['tai_khoan'])),
			'user_hash' => sha1($d->clear($_POST['tai_khoan'])),
			'pass_hash' => sha1($d->clear($_POST['pass'])),
			'email' => $d->clear($_POST['email']),
			'ho_ten' => $d->clear($_POST['ho_ten']),
			'dien_thoai' => $d->clear($_POST['dien_thoai']),
			'dia_chi' => $d->clear($_POST['dia_chi']),
			'ngay_sinh' => $ngay_sinh,
			'gioi_tinh' => $d->clear($_POST['gioi_tinh']),
			'quyen_han' => 0,
			'hien_thi' => 0,
			'ngay_tao' => time(),
		);

		$d->setTable('#_user');
		if($d->insert($data)) {
			echo "ok";
		}
		else echo mysql_error();
		
	}
	else if($do=='check_tai_khoan') {
		$tai_khoan = $d->username($d->clear($_POST['tai_khoan']));

		if($tai_khoan!=''){
			$check = $d->num_rows("select tai_khoan from #_user where tai_khoan='{$tai_khoan}'");

			if($check==0) {
				$valid = true;
			}
			else {
				$valid = false;
			}
		} 
		else {
			$valid = false;
		}
		echo json_encode($valid);	
	}
	else if($do=='check_email') {
		$email = $d->clear($_POST['email']);

		if($email!=''){
			$check = $d->num_rows("select email from #_user where email='{$email}'");

			if($check==0) {
				$valid = true;
			}
			else {
				$valid = false;
			}
		} 
		else {
			$valid = false;
		}
		echo json_encode($valid);		
	}
	else if($do=='dang_nhap') {
		$user_hash = sha1($d->clear($_POST['username']));
		$pass_hash = sha1($d->clear($_POST['pass']));
		$query = $d->o_fet("select * from #_user where user_hash='$user_hash' and pass_hash='$pass_hash'");
		if(count($query)>0 && $user_hash==$query[0]['user_hash'] && $pass_hash==$query[0]['pass_hash']) {
			$_SESSION['user'] = array(
				'id' => $query[0]['id'],
				'token' => $query[0]['token'],
				'tai_khoan' => $query[0]['tai_khoan'],
				'ho_ten' => $query[0]['ho_ten'],
				'quyen_han' => $query[0]['quyen_han'],
			);
			echo "ok";
		}
		else {
			echo "error";
		}
	}
	else if($do=='dang_xuat') {
		unset($_SESSION['user']);
		echo "ok";
	}
	else if($do=='tim_kiem') {
		
		$check = $_POST['ch_search'];
		foreach($check as $keyword){
			
			 $keywordarray[] = $keyword;
			
		}
		 $keywords = implode (",", $keywordarray);
		echo URLPATH."search.html?q=$keywords";
	}
	else if($do=='change_video') {
		
		$id = $_POST['id'];
		$video = $d->simple_fetch("select * from #_video where id={$id} limit 0,1");
		if(!empty($video)){ ?>
			<iframe width="300" height="150" src="https://www.youtube.com/embed/<?= $video['link']; ?>" frameborder="0" allowfullscreen=""></iframe>
		<?php }
	}
	else if($do=='send_comment') {
		header('Content-Type: application/json');
		$data = "";
		$data = array(
			'parent' => $d->clear($_POST['parent']),
			'alias' => $d->clear($_POST['alias']),
			'hoten' => $d->clear($_POST['hoten']),
			'email' => $d->clear($_POST['email']),
			'dienthoai' => $d->clear($_POST['dienthoai']),
			'noidung' => $d->clear($_POST['noidung']),
			'link' => $d->clear($_POST['link']),
			'ngaytao' => time(),
		);
		$d->setTable('#_binhluan');
		if($d->insert($data)) {
			echo json_encode(array('ok'=>'ok','error'=>0));
		}
		else echo mysql_error();
	}
        else if($do=='get_quan') {
            $id = (int)$_POST['id'];
            $quan = $d->o_fet("select * from #_quan where id_loai = '".$id."' order by ten_vn asc");
            echo '<option value="">Chọn quận huyện</option>';
            foreach ($quan as $key => $value) {
                echo '<option value="'.$value['id'].'" data_ship="'.$value['phi_ship'].'">'.$value['ten_vn'].'</option>';
            }
        }
?>