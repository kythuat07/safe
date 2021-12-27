<?php 
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$time = 600; //10phut
	$time_sn = time() - $time;
	//xoa ds > 10phut
	$d->o_que("delete from #_thongke_detail where time <= ".$time_sn);

	$flg = 0;
	if(isset($_SESSION['thongke'])){
		$check = $d->o_sel("*","#_thongke_detail"," session_id = '".$_SESSION['thongke']."'");
		if(count($check) == 1){
			$d->o_que("update #_thongke_detail set time = '".time()."' where session_id = '".$_SESSION['thongke']."'");
		}
		else {
			$_SESSION['thongke'] = session_id();
			$d->o_que("insert into #_thongke_detail value('".$_SESSION['thongke']."','".time()."')");
			$flg = 1;
		}

	}
	else{
		$_SESSION['thongke'] = session_id();
		$d->o_que("insert into #_thongke_detail value('".$_SESSION['thongke']."','".time()."')");
		$flg = 1;
	}

	if($flg == 1){
		$thongke = $d->o_sel("*","#_thongke","id = 1");
		// ngay
		if($thongke[0]['trong_ngay_date'] == date("d",time())){
			$d->o_que("update #_thongke set trong_ngay =  trong_ngay + 1 where id = 1");
		}
		else{
			$d->o_que("update #_thongke set trong_ngay =  1, trong_ngay_date = '".date("d",time())."' where id = 1");
		}
		//tuan
		if($thongke[0]['trong_tuan_date'] == date("W",time())){
			$d->o_que("update #_thongke set trong_tuan =  trong_tuan + 1 where id = 1");
		}
		else{
			$d->o_que("update #_thongke set trong_tuan =  1, trong_tuan_date = '".date("W",time())."' where id = 1");
		}
		//thang
		if($thongke[0]['trong_thang_date'] == trim(date("m",time()),"0")){
			$d->o_que("update #_thongke set trong_thang =  trong_thang + 1 where id = 1");
		}
		else{
			$d->o_que("update #_thongke set trong_thang =  1, trong_thang_date = '".trim(date("m",time()),"0")."' where id = 1");
		}
		$d->o_que("update #_thongke set tong_truy_cap =  tong_truy_cap + 1 where id = 1");
	}
	$thongke = $d->o_sel("*","#_thongke","id = 1");

	$dang_online = count($d->o_sel("*","#_thongke_detail"));
	$trong_ngay = $thongke[0]['trong_ngay'];
	$trong_tuan = $thongke[0]['trong_tuan'];
	$trong_thang = $thongke[0]['trong_thang'];
	$tong = $thongke[0]['tong_truy_cap'];

	function rep_thongke($str){
		// if($str < 10) $str = "000".$str;
		// else if($str < 100) $str = "00".$str;
		// else if($str < 1000) $str = "0".$str;
		// $str2 = str_replace("1", "<img src='./img/mot.png'>", $str);
		// $str2 = str_replace("2", "<img src='./img/hai.png'>", $str2);
		// $str2 = str_replace("3", "<img src='./img/ba.png'>", $str2);
		// $str2 = str_replace("4", "<img src='./img/bon.png'>", $str2);
		// $str2 = str_replace("5", "<img src='./img/nam.png'>", $str2);
		// $str2 = str_replace("6", "<img src='./img/sau.png'>", $str2);
		// $str2 = str_replace("7", "<img src='./img/bay.png'>", $str2);
		// $str2 = str_replace("8", "<img src='./img/tam.png'>", $str2);
		// $str2 = str_replace("9", "<img src='./img/chin.png'>", $str2);
		// $str2 = str_replace("0", "<img src='./img/khong.png'>", $str2);
		// return $str2;
		return $str;
	}
?>

<div class="box visited">
	<p><span class="v1"><?=_dangtruycap?>:</span> <?=$dang_online?></p>
	<!-- <p><span class="v2"><?=_trongngay?>:</span> <?=$trong_ngay?></p>
	<p><span class="v3"><?=_trongthang?>:</span> <?=$trong_thang?></p> -->
	<p><span class="v3"><?=_tongtruycap?>:</span> <?=$tong?></p>
</div>