<?php
	$time_cur = time();

	if($com=='tags') {
            $tags=addslashes($_REQUEST['alias']);
            $query = $d->simple_fetch("select * from #_tags where alias = '$tags'");
            $tintuc = $d->o_fet("select  * from #_tintuc where hien_thi = 1 and tags_hienthi like '%".$query['ten_vn']."%' order by so_thu_tu asc, id desc");
	}
	else {
            $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");

            if(count($loai) == 0) $d->location(URLPATH."404.html");
            $id_sub=substr($d->findIdSub($loai['id'],1),1);

            $id_loai=$loai['id'].$d->findIdSub($loai['id']);
            $tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and hen_ngay_dang < '".time()."' and FIND_IN_SET(id_loai,'$id_loai') <> 0 order by so_thu_tu asc, id desc");
	}
   if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
  
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=25;
    $maxP=5;
    $phantrang=$d->phantrang($tintuc, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $tintuc2=$phantrang['source'];
    //$loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = ".$loai['id']." or id_loai = ".$loai['id_loai']." or id = ".$loai['id_loai'].") and id_loai <>0");
    //$id_loai2='1026'.$d->findIdSub(1026);
    //$news_home = $d->o_fet("select * from #_tintuc where hien_thi = 1 and noi_bat = 1 and FIND_IN_SET(id_loai,'$id_loai2') <> 0 order by id desc limit 0,10");
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php include 'right.php'; ?>
        </div>
        <div class="col-md-9 col-sm-8">
            <h1 class="title-home"><span><?=$loai['ten_vn']?></span></h1>
            <?= $d->breadcrumbList($loai['id'],$lang,URLPATH) ?>
            <div class="clearfix"></div>
            <?php if(count($tintuc)==""){ ?>
            <div class="chitiettin">
                <?= $loai['noi_dung_vn']?>
            </div>
            <?php }elseif(count($tintuc)==1){?>
             <div class="chitiettin">
                <?= $tintuc[0]['noi_dung_vn']?>
            </div>
            <?php }else{?>
            <?php if(count($tintuc)>6){ $dem = 5; ?>
            <div class="row">
                <div class="col-sm-8">
                    <div class="new-hot">
                        <a href="<?=URLPATH.$tintuc2[0]['alias_'.$lang] ?>.html" title="<?=$tintuc2[0]['ten_'.$lang] ?>">
                        <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$tintuc2[0]['hinh_anh']?>&w=730&h=400" alt="<?=$item['ten_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                        </a>
                        <h3><a href="<?=URLPATH.$tintuc2[0]['alias_'.$lang] ?>.html" title="<?= $tintuc2[0]['ten_'.$lang] ?>"><?=$d->catchuoi_new(strip_tags($tintuc2[0]['ten_'.$lang]),100) ?></a></h3>
                        <div class="mota">
                            <?=$d->catchuoi_new(strip_tags($tintuc2[0]['mo_ta_'.$lang]),350) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="new-hot-2">
                        <a href="<?=URLPATH.$tintuc2[1]['alias_'.$lang] ?>.html" title="<?=$tintuc2[1]['ten_'.$lang] ?>">
                        <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$tintuc2[1]['hinh_anh']?>&w=400&h=200" alt="<?=$item['ten_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                        </a>
                        <h3><a href="<?=URLPATH.$tintuc2[1]['alias_'.$lang] ?>.html" title="<?= $tintuc2[1]['ten_'.$lang] ?>"><?=$tintuc2[1]['ten_'.$lang] ?></a></h3>
                    </div>
                    <div class="new-hot-3">
                        <?php foreach ($tintuc2  as $i => $item) {
                            if($i>1 and $i < 6){
                            ?>
                        <h3><a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="$item['ten_'.$lang] ?>"><?=$d->catchuoi_new(strip_tags($item['ten_'.$lang]),100) ?></a></h3>
                        <?php }}?>
                    </div>
                </div>
            </div>
            <?php } else{$dem = -1;}?>
            <?php foreach ($tintuc2  as $i => $item) {
                if($i>$dem){
                ?>
            <div class="item-new">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['ten_'.$lang] ?>">
                        <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh']?>&w=730&h=400" alt="<?=$item['ten_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <h3><a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="$item['ten_'.$lang] ?>"><?=$item['ten_'.$lang] ?></a></h3>
                        <div class="mota">
                            <?=$d->catchuoi_new(strip_tags($item['mo_ta_'.$lang]),350) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}?>
            <div class="pagination-page">
                <?php echo @$phantrang['paging']?>
            </div>
            <?php }?>
        </div>
        
    </div>
</div>
