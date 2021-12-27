<?php
	
	$data = $d->o_fet("select * from #_video where hien_thi = 1 order by id desc");
	if(count($data) == 0) $d->location(URLPATH."404.html");

	
    if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
    
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=20;
    $maxP=5;
    $phantrang=$d->phantrang($data, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $data=$phantrang['source'];
	
	
?>
<section>
<div class="container"> 
 	<div class="row10">
 		<?php include 'left.php'; ?>
 		<div class="col-md-9 plr10">
 			<div class="page-title">
				<ul class="breadcrumb">
					<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
					<li><a href="<?=URLPATH ?>video.html" title="Video">Video</a></li>
				</ul>
			</div>
			<?php foreach($data as $item) {?>
				<div class="col-video">
				<div class="item-video">
				<div class="embed-responsive embed-responsive-4by3">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$item['link']?>" frameborder="0" allowfullscreen></iframe>
				</div>
				</div>
				</div>
				<?php } ?>
				<div class="clearfix"></div>
				<?php if(@$phantrang['paging'] <> ''){ ?>
				<div class="pagination-page">
				<?php echo @$phantrang['paging']?>
				</div>
			<?php } ?>				
		</div>
 	</div>
</div>
</section>