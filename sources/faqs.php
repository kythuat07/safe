<?php
	
	if($_POST) {
        $chuoi1 = strtolower($_SESSION['captcha_code']);
        $chuoi2 = strtolower($_POST['captcha']);
		if($chuoi1 == $chuoi2) {			
			$d->reset();
			$data['ten'] = addslashes($_POST['ten']);	
			$data['cau_hoi'] = addslashes($_POST['cau_hoi']);
			$data['ngay'] = time();
            $data['hien_thi'] = 0;
						
			$d->setTable('#_question');
			if($d->insert($data)) {
                $d->alert("Gửi câu hỏi thành công");
                $d->location(URLPATH."faqs.html");
            }
            else {
                $d->alert("Gửi câu hỏi không thành công");
				$d->location(URLPATH."faqs.html");
            }			
		}
		else {
			$d->alert("Mã bảo vệ chưa đúng");
			 $d->location(URLPATH."faqs.html");
		}		
	}
	else {
		$list_question=$d->o_fet("select * from #_question where hien_thi=1 order by id desc");
	}


	
?>


<section class="include">
	<div class="container">
		<div class="center">

			<ul class="breadcrumb">
				<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
				<li><a  href="<?=URLPATH ?>faqs.html" title="FAQs">FAQs</a></li>
			</ul>			
			<div class="clearfix"></div>
			
			<div class="right">

				<div class="panel-group question-list" id="accordion" role="tablist" aria-multiselectable="true">
					<?php foreach($list_question as $i => $item) { ?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="questh<?=$i?>">
							<h4 class="panel-title">
								
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#quesco<?=$i?>" aria-expanded="false" aria-controls="quesco<?=$i?>">
									<b><?=_question?>: </b> <?=$item['cau_hoi']?> - <b class="name"><?=$item['ten']?></b>
								</a>
							</h4>
						</div>
						<div id="quesco<?=$i?>" class="panel-collapse collapse<?php if($i==0) echo ' in'; ?>" role="tabpanel" aria-labelledby="questh<?=$i?>">
							<div class="panel-body">
								<h5><b><?=_repply?>:</b> </h5>
								<?=$item['tra_loi']?> 
							</div>
						</div>
					</div>
					<?php } ?>
					
					
				</div>
				
				<div class="cleafix"></div>
				<h5><b><?=_title_ques?></b></h5>
				<div class="col-sm-8 col-sm-offset-2">
					<form method="post" id="form-question" action="">
						<div class="form-group">
							<label for="ten"><?=_hoten ?>:</label>
							<input type="text" class="form-control" id="ten" name="ten"  data-error="<?=_typehoten ?>">
						</div>
						<div class="form-group">
							<label for="captcha"><?=_captcha ?>:</label>
							<div>
								<input type="text" class="form-control" id="captcha" name="captcha" data-error="<?=_typecaptcha ?>" style="background: url(./sources/capchaimage.php) center right no-repeat">
							</div>
						</div>
						<div class="form-group">
							<label for="cau_hoi"><?=_questionct ?>:</label>
							<textarea class="form-control" rows="5" name="cau_hoi" id="cau_hoi" data-error="<?=_typecontent ?>"></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  value=" <?=_send ?> " class="btn btn-default">
						</div>
					</form>
				</div>
				
				
			</div>
			
			<?php include("left.php")?>
		</div>
	</div>
</section>

