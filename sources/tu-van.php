<?php
	if(isset($_POST['btn_question'])){
		$d->reset();
		$d->setTable('#_question');
		$data['ten'] = addslashes($_POST['ho_ten']);
		$data['email'] = addslashes($_POST['email']);
		$data['cau_hoi'] = addslashes($_POST['cau_hoi']);
		$data['ngay'] = time();
		if($d->insert($data)) {
			$d->alert("Gửi thành công!");
			$d->location(URLPATH);
			}
	}
	$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");

	if(count($loai) == 0) $d->location(URLPATH."404.html");
	$id_sub=substr($d->findIdSub($loai['id'],1),1);
	
	$id_loai=$loai['id'].$d->findIdSub($loai['id']);
	$listQuestion = $d->o_fet("select * from #_question where hien_thi = 1 order by id desc");
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-8">
            <h1 class="title-home"><span><?=$loai['ten_vn']?></span></h1>
            <div>
                <?=$loai['mo_ta_vn']?>
            </div>
            <div class="col-sm-8 col-sm-offset-2">
                <form method="" action="" style="padding: 10px;border: 1px solid #921439;border-radius: 5px;box-shadow: 1px 1px 10px 1px #ccc;">
                    <div class="form-group">
                        <label>Họ tên khách hàng:</label>
                        <input type="text" required placeholder="Nhập họ tên" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input type="text" required placeholder="Nhập số điện thoại" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" required placeholder="Nhập email" class="form-control"/>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Ngày tổ chức:</label>
                                <input type="date" required placeholder="" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>số lượng thực khách:</label>
                                <input type="number" required placeholder="Nhậpsố thực khách" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>số món:</label>
                                <input type="number" required placeholder="Nhập số món" class="form-control"/>
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label>Ghi chú:</label>
                        <textarea class="form-control" rows="4" placeholder="Nhập ghi chú"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Đặt tiệc</button>
                    </div>
                </form>
            </div>
            
        </div>
        <div class="col-md-3 col-sm-4">
            <?php include 'right.php'; ?>
        </div>
    </div>
</div>