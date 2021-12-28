<?php
	$t = addslashes($_REQUEST['textsearch']);
	$strCategory = addslashes($_REQUEST['categorysearch']);
    $strSQLGetCategory = '';
    if($strCategory != '' && $strCategory != 0){
        $strSQLGetCategory = "id_loai = $strCategory AND"; 
    }
    $s_type = 0;
	$tintuc = $d->o_fet("SELECT * FROM db_sanpham WHERE $strSQLGetCategory hien_thi = 1 and ten_{$lang} like '%".$t."%'  order by id desc");

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
            <div class="row">
                <?php foreach ($tintuc  as $i => $item) { ?>

                <div class="col-md-4 col-sm-12 p10">
                    <div class="item-product ">
                        <a href="<?=URLPATH.$item['alias_'.$lang]?>.html" title="<?=$item['ten_'.$lang]?>">
                            <img src="<?=URLPATH?>img_data/images/<?=$item['hinh_anh']?>" alt="<?=$item['ten_'.$lang]?>" />
                        </a>
                        <h3><a href="<?=URLPATH.$item['alias_'.$lang]?>.html" title="<?=$item['ten_'.$lang]?>"><?=$item['ten_'.$lang]?></a></h3>
                        <div class="gia-ban">
                            <?php if($km>0){?>
                            Giá bán: <strong><?=$d->vnd($km)?></strong>
                            <?php }else{?>
                                <?php if($gia==0){ ?>
                                Giá bán: <strong>Liên hệ</strong>
                                <?php }else{?>
                                    Giá bán: <strong><?=$d->vnd($gia)?></strong>
                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="chitiet">
                            <a href="<?=URLPATH.$item['alias_'.$lang]?>.html" class="btn btn-now buy-now" type="button">
                            <?= constant('_buynow'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="pagination-page">
                <?php echo @$phantrang['paging']?>
            </div>
        </div>
        
    </div>
</div>