<?php

	$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");
	if(count($loai) == 0) $d->location(URLPATH."404.html");
	$id_loai=$loai['id'];
	$check_index=0;
	

	if($d->findIdSub($loai['id'])!='') {
		$idsub=$d->findIdSub($loai['id']);	
		$check_index=1;
		$data = $d->o_fet("select * from #_category where hien_thi = 1 and FIND_IN_SET(id,'$idsub') <> 0 order by so_thu_tu asc, id desc");
	}
	else {
		$data = $d->o_fet("select * from #_gallery where hide = 1 and FIND_IN_SET(parent,'$id_loai') <> 0 order by stt asc, id desc");
		
	}

	
    if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
    
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=20;
    $maxP=5;
    $phantrang=$d->phantrang($data, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $data=$phantrang['source'];
	
	
?>



<section class="include">
	<div class="container">
		
		<div class="row10">
				
			<?php include("left.php"); ?>	
		
			<div class="col-md-9 row10">
				<div class="page-title">
					<ul class="breadcrumb">
						<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
						<?=$d->breadcrumb($id_loai,$_SESSION['lang'],URLPATH)?>
					</ul>
				</div>
				<div class="clearfix"></div>
				
				<div class="bg-left row10">	
					
					<?php foreach($data as $item) {?>
					<div class="col-gallery">
						<div class="item-gallery">
							<div class="img">
								<?php if($check_index>0) {  ?>
								<a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['ten_'.$_SESSION['lang']] ?>">
									<div class="mask"><span></span></div>
									<img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh']?>&w=400&h=300" alt="<?=@$item['ten_'.$_SESSION['lang']] ?>" onerror="this.src='templates/error/error.jpg';" border="0">
									<h3 class="name"><?=$item['ten_'.$_SESSION['lang']]?></h3>
								</a>
								<?php } else { ?>
								<a href="<?=URLPATH ?>img_data/images/<?=$item['picture']?>" title="<?=@$item['title_'.$_SESSION['lang']] ?>" class="fancybox" rel="group1">
									<div class="mask"><span></span></div>
									<img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['picture']?>&w=400&h=300" alt="<?=@$item['ten_'.$_SESSION['lang']] ?>" onerror="this.src='templates/error/error.jpg';" border="0">
									<h3 class="name"><?=$item['title_'.$_SESSION['lang']]?></h3>
								</a>
								<?php } ?>
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
	</div>
</section>

