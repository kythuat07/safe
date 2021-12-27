<?php
	$t = addslashes($_REQUEST['textsearch']);
	$s_type = 0;
	$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 and ten_{$lang} like '%".$t."%' order by id desc");

	$name = _ketquatimkiem. " (".count($tintuc).")";
    if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) $d->location(URLPATH."404.html");
    
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR=20;
    $maxP=5;
    $phantrang=$d->phantrang($tintuc, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $tintuc2=$phantrang['source'];

?>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php include 'right.php'; ?>
        </div>
        <div class="col-md-9 col-sm-8">
            <h1 class="title-home"><span>Tìm kiếm</span></h1>
            <div class="clearfix"></div>
            <?php if(count($tintuc)==""){ ?>
            <div class="chitiettin">
                <?= $loai['noi_dung_vn']?>
            </div>
            <?php }elseif(count($tintuc)==1){?>
             <div class="chitiettin">
				<h2 style="font-weight: 600;margin-bottom: 25px;margin-top: 0px;font-size: 24px;"><?= $tintuc[0]['ten_vn']?></h2>
                <?= $tintuc[0]['noi_dung_vn']?>
            </div>
            <?php }else{?>
            <div class="row">
                <?php foreach ($tintuc2  as $i => $item) { ?>
                <div class="col-md-4 col-sm-6">
                    <div class="item-new">
                        <a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['ten_'.$lang] ?>">
                            <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh']?>&w=730&h=400" alt="<?=$item['ten_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                        </a>
                        <h3><a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="$item['ten_'.$lang] ?>"><?=$d->catchuoi_new(strip_tags($item['ten_'.$lang]),100) ?></a></h3>
                        <div class="mota">
                            <?=$d->catchuoi_new(strip_tags($item['mo_ta_'.$lang]),180) ?>
                        </div>
                        
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="pagination-page">
                <?php echo @$phantrang['paging']?>
            </div>
            <?php }?>
        </div>
        
    </div>
</div>