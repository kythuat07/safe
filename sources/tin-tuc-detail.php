<?php
	
	$tintuc = $d->simple_fetch("select * from #_tintuc where hien_thi = 1 and alias_".$lang." = '".$com."' limit 0,1");
	if(count($tintuc) == 0) {
		$d->location(URLPATH."404.html");
	}
	$tintuc_lienquan = $d->o_fet("select * from #_tintuc where hien_thi = 1 and id <> '".@$tintuc['id']."' and id_loai = '".$tintuc['id_loai']."' order by id desc limit 0,12");
	
	$loai=$d->simple_fetch("select * from #_category where id = '".$tintuc['id_loai']."'");
	$hinh_anh_slide = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet = '".$tintuc['id']."' order by id desc");
    $loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = ".$loai['id']." or id_loai = ".$loai['id_loai']." or id = ".$loai['id_loai'].") and id_loai <>0");
    $id_loai2='1026'.$d->findIdSub(1026);
    $news_home = $d->o_fet("select * from #_tintuc where hien_thi = 1 and noi_bat = 1 and FIND_IN_SET(id_loai,'$id_loai2') <> 0 order by id desc limit 0,10");
?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php include 'right.php'; ?>
        </div>
        <div class="col-md-9 col-sm-8">
            <h2 class="title-home"><span><?=$loai['ten_vn']?></span></h2>
            <?= $d->breadcrumbList($loai['id'],$lang,URLPATH) ?>
            <div class="clearfix"></div>
            <h1 class="title-tin"><?=$tintuc['ten_'.$lang]?></h1>
            <div class="ngaydang">
                <span class="pull-left"> Ngày đăng: <?=date('d-m-Y h:i:s',$tintuc['ngay_dang'])?></span>
                <div class="pull-right">
                    <div class="fb-like" data-href="<?=$url_page?>" data-width="" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="chitiettin">
                <?=$tintuc['noi_dung_'.$lang]?>
            </div>
            <h3 class="title-home"><span>Bài viết liên quan</span></h3>
            <ul class="tinlienquan">
                <?php foreach ($tintuc_lienquan as $key => $value) {?>
                <li><a href="<?=URLPATH.$value['alias_'.$lang]?>.html" title="<?=$value['ten_'.$lang]?>"><?=$value['ten_'.$lang]?></a></li>  
                <?php } ?>
            </ul>
            <div class="fb-comments" data-href="<?=$url_page?>" data-width="847" data-numposts="5"></div>
        </div>
        
    </div>
</div>
