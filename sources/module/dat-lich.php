<?php
	if($_POST) {
		$data['name']=$d->clear($_POST['name']);
		$data['donvi']=$d->clear($_POST['donvi']);
		$data['chuyenmon']=$d->clear($_POST['chuyenmon']);
		$data['email']=$d->clear($_POST['email']);
		$data['phone']=$d->clear($_POST['phone']);
		$data['mota']=$d->clear($_POST['mota']);
		$data['mucdo']=$d->clear($_POST['mucdo']);
		$pvaitro=$d->clear($_POST['vaitro']);
		$vaitro="";
		foreach($pvaitro as $id) {
			$vaitro.=",".$id;
		}
		$vaitro=substr($vaitro,1);
		$data['vaitro']=$vaitro;
		$data['khac']=$d->clear($_POST['khac']);
		$data['tuvan']=$d->clear($_POST['tuvan']);
		$data['capthiet']=$d->clear($_POST['capthiet']);
		$data['day']=time();
		
		$d->setTable('#_datlich');
		if($d->insert($data)) {
			$_SESSION['datlich']=1;
			header("Location:".URLPATH."dat-lich.html");
		}		
	}
	else {
		$text_lich=$d->getTemplates(22);
		$mucdo=$d->o_fet("select * from #_extra where type=0 order by stt asc, id desc");
		$vaitro=$d->o_fet("select * from #_extra where type=1 order by stt asc, id desc");
	}

?>

<?php if($_SESSION['datlich']==1 && !$_POST) {
	$_SESSION['alert']="Chúng tôi sẽ liên lạc bạn trong thời gian sớm nhất!";
?>
<script>
$(document).ready(function() {
	$('#Modal-alert').modal('show')
});
</script>
<?php unset($_SESSION['datlich']); } ?>

<section class="include">
	<div class="container">
	
		<div class="center">
			<ul class="breadcrumb">
				<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
			
				<li><a href="<?=URLPATH ?>dat-lich.html">Đăng ký lịch tư vấn</a></li>

			</ul>
			<div class="clearfix"></div>	

			
			<div class="left">
				<div class="title-page"><a>Đăng ký lịch tư vấn</a></div>
				<div class="box-item module datlich">
					
					<div class="text">
						<?=$text_lich['noi_dung_'.$_SESSION['lang']]?>	
					</div>
					<div class="clearfix"></div>
				
					<div class="col-sm-10 col-sm-offset-1">
						<form method="post" action="" id="form-datlich">
							<div class="form-group">
								<label>Họ tên <span class="red">*</span></label>
								<input type="text" class="form-control" placeholder="Họ tên" id="name" name="name" data-error="Nhập họ tên">
							</div>
							<div class="form-group">
								<label>Đơn vị công tác <span class="red">*</span></label>
								<p>(Nơi học tập / làm việc)</p>
								<input type="text" class="form-control" placeholder="Đơn vị công tác" id="donvi" name="donvi" data-error="Nhập đơn vị công tác">
							</div>
							<div class="form-group">
								<label>Chuyên môn <span class="red">*</span></label>
								<p>(Sinh viên chuyên ngành gì, năm mấy?; công tác trong lĩnh vực gì, chuyên môn?)</p>
								<input type="text" class="form-control" placeholder="Chuyên môn" id="chuyenmon" name="chuyenmon" data-error="Nhập chuyên môn">
							</div>
							<div class="form-group">
								<label>Email <span class="red">*</span></label>
								<input type="email" class="form-control" placeholder="Email" id="email" name="email" data-error="Nhập email">
							</div>
							<div class="form-group">
								<label>Số điện thoại <span class="red">*</span></label>
								<input type="text" class="form-control" placeholder="Số điện thoại" id="phone" name="phone" data-error="Nhập số điện thoại">
							</div>
							<div class="form-group">
								<label>Mô tả tóm tắt ý tưởng sản phẩm hoặc dịch vụ bạn đang muốn kinh doanh <span class="red">*</span></label>
								<p>Công dụng, đặc tính, những điểm nổi bật so với những sản phẩm/dịch vụ hiện có trên thị trường</p>
								<textarea  type="text" class="form-control" rows="5" id="mota" name="mota" data-error="Nhập mô tả"></textarea>
							</div>
							
							<h5 id="mucdo" data-error="Chọn mức độ"><b>Mức độ hoàn thiện của ý tưởng về sản phẩm/dịch vụ <span class="red">*</span></b></h5>
							<?php foreach($mucdo as $item) {?>
							<div class="radio">
								<label>
								<input type="radio" name="mucdo" value="<?=$item['id']?>">
								<?=$item['title_'.$_SESSION['lang']]?>
								</label>
							</div>
							<?php } ?>

							
							<h5 id="vaitro" data-error="Chọn vai trò"><b>Vai trò của bạn/nhóm của bạn <span class="red">*</span></b></h5>
							<?php foreach($vaitro as $item) {?>
							<div class="checkbox">
								<label>
								<input type="checkbox" name="vaitro[]" value="<?=$item['id']?>" >
								<?=$item['title_'.$_SESSION['lang']]?>
								</label>
							</div>
							<?php } ?>
							<div class="checkbox">
								<label>
								<input type="checkbox" name="vaitro[]" value="0" >
								Khác
								</label>
								<input type="text" name="khac" value="" >
							</div>
							
							
							<div class="form-group end-check">
								<label>Bạn muốn được tư vấn những nội dung nào? <span class="red">*</span></label>
								<p>(Ví dụ: tư vấn nghiên cứu hoàn thiện sản phẩm/dịch vụ; kiểm nghiệm tính khả thi của ý tưởng; tư vấn xây dựng/hoàn thiện KHKD; tư vấn bảo hộ SHTT; tư vấn pháp lý; tư vấn cách thức triển khai; ...)...)</p>
								<textarea  type="text" class="form-control" rows="5" id="tuvan" name="tuvan" data-error="Nhập nội dung cần tư vấn"></textarea>
							</div>
							
							<div class="form-group">
								<label>Mức độ cấp thiết và thời gian cần được tư vấn</label>
								<p>(Nếu dự án của bạn đang cần được hỗ trợ gấp hãy thông tin để chúng tôi biết và ưu tiên xếp lịch hẹn sớm)</p>
								<textarea  type="text" class="form-control" rows="5" name="capthiet"></textarea>
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Gửi đi</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>
				

			<?php include "right.php"; ?>
		</div>
	</div>
</section>

