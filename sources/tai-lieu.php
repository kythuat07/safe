<?php
	
	$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$_SESSION['lang']} = '$com'");

	if(count($loai) == 0) $d->location(URLPATH."404.html");
	$id_sub=substr($d->findIdSub($loai['id'],1),1);
	
	$id_loai=$loai['id'].$d->findIdSub($loai['id']);
	$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc, id desc");


   if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
  
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=25;
    $maxP=5;
    $phantrang=$d->phantrang($tintuc, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $tintuc=$phantrang['source'];

?>



<section>

<div class="container bg-white">
        
        	
<?php include("left.php"); ?>
		
<div class="col-md-9 plr5">
	<div class="page-title">
		<div class="bg-white">
		<div class="col-md-12 plr0">
		<ul class="breadcrumb">
		<li><a href="<?=URLPATH ?>" title="<?=_trangchu?>"><i class="fa fa-home"></i></a></li>
		<?php if($com!='tags') {?>
		<?=$d->breadcrumb($loai['id'],$_SESSION['lang'],URLPATH)?>
		<?php } else { ?>
		<li><a href="<?=URLPATH ?>tags/<?=$tags?>.html" title="Tìm theo <?=$tags?>">Tag: <?=$tags?></a></li>
		<?php } ?>
		</ul>
		</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="mota-dm">
		<?=$loai['mo_ta_'.$lang]?>
	</div>
<div class="clearfix"></div>


					

<div class="box-item module row5">
<?php foreach ($tintuc  as $i => $item) { ?>	
	<div class="col-sm-4 plr5">		
		<div class="item-kythuat mb10" >
			<div class="img">
				<a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['ten_'.$_SESSION['lang']] ?>">
				<img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh']?>&w=500&h=400" alt="<?=@$item['ten_'.$_SESSION['lang']] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
				</a>
			</div>
			<div class="clearfix"></div>
			<div class="content-kythuat">
				<h3 class="name"><a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=@$item['ten_'.$_SESSION['lang']] ?>"><?=@$item['ten_'.$_SESSION['lang']] ?></a></h3>
				<div class="quote hidden-xs"><?=$d->catchuoi_new(strip_tags($item['mo_ta_'.$_SESSION['lang']]),200) ?></div>
			</div>
		</div>
	</div>
<?php } ?>
<div class="clearfix"></div>
<div class="pagination-page">
<?php echo @$phantrang['paging']?>
</div>	
					
</div>


	

</div>
<?php //include("right.php"); ?>
	
</div>
</section>

<style type="text/css">
	.item-kythuat{ border: 1px solid #b7b7b7; }
	.content-kythuat{  padding: 10px; text-align: justify;  }
	.content-kythuat h3{ font-size: 16px; font-weight: bold; }
</style>
