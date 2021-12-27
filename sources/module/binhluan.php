<div class="clearfix"></div>
<?php 	
	$count = $d->o_fet("select id from #_binhluan where parent=0 and alias = '{$com}' and hide=1");
	$div = 10;
	$box=4;
	$Apage = ceil(count($count)/$div);
	$page = ($Apage>$box) ? $box : $Apage;
	$limit = " limit 0,$div";
	$list_cm = $d->o_fet("select * from #_binhluan where parent=0 and alias = '{$com}' and hide=1 order by id asc $limit");
?>
<div class="comment-pnvn">
	<?php if(count($list_cm)>0) { ?>
	<div class="title">Bình luận khách hàng:</div>
	<?php } ?>
	
	<?php if(count($list_cm)>0) {  ?>
	<div class="list-comment-pnvn">
		<?php foreach($list_cm as $i => $item) {
			$sub = $d->o_fet("select * from #_binhluan where parent={$item['id']} and alias = '{$com}' and hide=1 order by id asc");
		?>
		<div class="item">
			<div class="name-cm"><b><?=$item['hoten']?></b> - <?=$d->time_stamp($item['ngaytao']);?></div>
			<div class="body-cm"><?=nl2br($item['noidung'])?></div>
			<div class="btn-cm">
				<a class="repply-comment" title="Trả lời" data-id="<?=$item['id']?>"><i class="icon-comment"></i> Trả lời</a>
			</div>
			
		</div>
		<div class="clearfix"></div>
		<div class="load-repply-form load<?=$item['id']?>"></div>
		<?php if(count($sub)>0) { foreach($sub as $item1) { ?>
		<div class="item sub">
			<div class="name-cm"><b><?=$item1['hoten']?></b> - <?=$d->time_stamp($item1['ngaytao']);?></div>
			<div class="body-cm"><?=nl2br($item1['noidung'])?></div>
		</div>
		<div class="clearfix"></div>
		<?php } } } if($page>1) { ?> 
		<div class="text-center">
			<ul class="pagination pagination-sm pagi-comment" alias="<?=$com?>" div="<?=$div?>" box="<?=$box?>" apage="<?=$Apage?>">
				<?php for($i=1;$i<=$page;$i++) { ?> 
				<li class="<?=($i==1) ? 'active' : ''?>" page="<?=$i?>"><a><?=$i?></a></li>
				<?php } ?>
			</ul>
		</div>

		<?php } ?>

	</div>
	<?php } ?>
	
	<div class="clearfix"></div>
	
	<div class="box-show-hide-comment hide">
		<div class="title">Nhập bình luận của bạn:</div>
		<div class="box-form-comment-pnvn">									
			<form class="form-comment-pnvn" method="" action="">
				<div class="alert alert-success alert-comment alert-dismissible hide" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Gửi thành công!</strong> bình luận của bạn sẽ hiển thị khi admin duyệt tin!.
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="hoten" id="hoten" data-error="Nhập họ tên" placeholder="Nhập họ tên" >
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" id="email" data-error="Nhập email" placeholder="Nhập email" >
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="dienthoai" id="dienthoai" data-error="Nhập số điện thoại" placeholder="Nhập số điện thoại" >
				</div>
				<!--div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<input type="text" class="form-control" name="captcha" id="captcha" data-error="Nhập mã xác nhận" placeholder="Nhập mã xác nhận">													
						</div>
						<div class="col-sm-6">
							<div class="showcaptcha"></div>
						</div>
					</div>
				</div-->
					
				<div class="form-group">
					<textarea class="form-control" name="noidung" id="noidung" data-error="Nhập nội dung" rows="4"></textarea>
				</div>
				<div class="form-group btn-comment">
					<button type="submit" class="btn btn-primary">Gửi bình luận</button>
					<input type="hidden" name="do" value="send_comment">
					<input type="hidden" id="parent" name="parent" value="0">
					<input type="hidden" name="alias" value="<?=$com?>">
					<input type="hidden" name="link" value="<?=$url_page?>">
				</div>
				
			</form>
		</div>
	</div>
	
	
</div>
<div class="clearfix"></div>