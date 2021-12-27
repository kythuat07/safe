<div class="modal fade" id="Modal-alert" tabindex="-1" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3>Thành công</h3>
<div class="text-center">
<p><?=$_SESSION['alert']?></p>
</div>

</div>
</div>
</div>



<div class="modal fade modal-style2" id="model_user" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close style2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="box">
				<div class="custom-tab2">
					<div class="mask"></div>
					<ul class="nav nav-tabs" role="tablist">
						<!-- <li class="active"><a href="#tab1" role="tab" data-toggle="tab"><?=_dangnhap?></a></li> -->
						<li  class="active"><a href="#tab2" role="tab" data-toggle="tab"><?=_dangky?></a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane p15" id="tab1">
							<form class="form-horizontal form-login" method="post" action="">
								<div class="alert alert-success border-radius0 hide" role="alert">
									<strong><?=_dangnhapthanhcong?>!</strong> <?=_vuilongchogiaylat?>!
								</div>
								<div class="alert alert-danger border-radius0 hide" role="alert">
									<strong><?=_dangnhapthatbai?>!</strong> <?=_saitaikhoanhoacmatkhau?>!
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_taikhoan?> *</label>
									<div class="col-sm-9 plr5">			
										<div class="relative"><input type="text" name="username" id="username" data-error="<?=_nhaptaikhoan?>" class="form-control border-radius0" autocomplete="off"></div>			
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_matkhau?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="password" name="pass" id="pass" data-error="<?=_nhapmatkhau?>" class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group mb0">
									<div class="col-sm-9 col-sm-offset-3 mb5 plr5">
										<button class="button button--isi border-radius0"><?=_dangnhap?></button>										
									</div>
									
								</div>
							</form>
						</div>
						<div class="tab-pane active p15" id="tab2">
							<form class="form-horizontal form-register" method="post" action="">
								<div class="alert alert-success border-radius0 hide" role="alert">
									<strong><?=_dangkythanhcongvuilongchoadminduyettrongvong24h?></strong>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_taikhoan?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="text" name="tai_khoan" id="tai_khoan" data-error="<?=_nhaptaikhoan?>" data-error-1="<?=_tentaikhoandatontai?>" class="form-control border-radius0" autocomplete="off"></div>
										<div class="block color-red mt5 font12"><b><?=_luuy?>:</b> <?=_tentaikhoanphaikhongcodauvakhoangtrong?></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_matkhau?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="password" name="pass" id="pass" data-error="<?=_nhapmatkhau?>" class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_nhaplaimatkhau?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="password" name="re_pass" id="re_pass" data-error="<?=_matkhaukhongtrungkhop?>" class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_hoten?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="text" name="ho_ten" id="ho_ten" data-error="<?=_nhaphoten?>" class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label">Email *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="text" name="email" id="email" data-error="<?=_nhapemail?>" data-error-1="<?=_emaildatontai?>" class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_dienthoai?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="text" name="dien_thoai" id="dien_thoai" data-error="<?=_nhapdienthoai?>"  class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_diachi?> *</label>
									<div class="col-sm-9 plr5">
										<div class="relative"><input type="text" name="dia_chi" id="dia_chi" data-error="<?=_nhapdiachi?>"  class="form-control border-radius0" autocomplete="off"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_ngaysinh?> *</label>
									<div class="col-sm-9 plr5 select2-34">
										<select name="ngay" class="select2 w70">
											<option value=""><?=_ngay?></option>
											<?php for($i=1;$i<=31;$i++) { ($i<10) ? $j = "0".$i : $j = $i; ?>
											<option value="<?=$j?>"><?=$j?></option>
											<?php } ?>
										</select>
										<select name="thang" class="select2 w80">
											<option value=""><?=_thang?></option>
											<?php for($i=1;$i<=12;$i++) { ($i<10) ? $j = "0".$i : $j = $i; ?>
											<option value="<?=$j?>"><?=$j?></option>
											<?php } ?>
										</select>
										<select name="nam" class="select2 w80">
											<option value=""><?=_nam?></option>
											<?php $year = (int)date("Y"); for($i=$year;$i>($year-200);$i--) {?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 plr5 control-label"><?=_gioitinh?> *</label>
									<div class="col-sm-9 plr5">
										<label class="radio-inline">
											<input class="icheck" type="radio" name="gioi_tinh" value="1"> <?=_boy?>
										</label>
										<label class="radio-inline">
											<input class="icheck" type="radio" name="gioi_tinh" value="0"> <?=_nu?>
										</label>
									</div>
								</div>

								<div class="form-group mb0">
									<div class="col-sm-9 col-sm-offset-3 mb5 plr5">
										<button class="button button--isi border-radius0"><?=_dangky?></button>										
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</div>						
			</div>
		</div>
	</div>
</div>