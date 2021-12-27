<?php


	$link=explode("?",$_SERVER['REQUEST_URI']);
	$vari=explode("&",$link[1]);
	$search=array();
	foreach($vari as $item) {
		$str=explode("=",$item);
		$search["$str[0]"]=$str[1];
	}
	$data = $d->o_fet("select  * from #_chitietdathang where ma_dh like '%".($search['ma_dh'])."%' order by id desc");

?>



<section>
<div class="page-title">
<div class="container">
<ul class="breadcrumb">
<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
<li><a title="<?php $key?>"><?php echo $search['ma_dh']?></a></li>
</ul>
</div>
</div>
		
		<div class="container">
			
			<?php include "left.php"; ?>
			
			<div class="col-md-9 plr10">
			
		
				<h4 class="title-module"><span><?=$item['ma_dh']?></span></h4>
				<div class="clearfix"></div>
				<div class="">
				<?php
				foreach ($data  as $item) {
				?>
				
                <?=$item['ma_dh']?>
                	
				<?php } ?>
				</div>


	
			</div>	
		</div>	

</section>

