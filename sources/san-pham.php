<?php
    $query=$d->simple_fetch("select id,ten_vn,alias_vn,mo_ta_vn from #_category where alias_{$_SESSION['lang']}='$com'");
    $id_loai=$query['id'];
    $all_id=$id_loai.$d->findIdSub($id_loai);

    if($id_loai == '') {
        $d->location(URLPATH."404.html");
    }
    $loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and alias_{$lang} = '$com'");
    $sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id_loai in ( $all_id ) and style=0 order by so_thu_tu asc, id desc");

    if(isset($_GET['page']) && !is_numeric(@$_GET['page'])) {
            $d->location(URLPATH."404.html");
    }
    $curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
    $url= $d->fullAddress();
    $maxR= 25;
    $maxP=3;
    $phantrang=$d->phantrang($sanpham, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
    $sanpham=$phantrang['source'];
    $loaisub = $d->o_fet("select * from #_category where hien_thi = 1 and (id_loai = ".$loai['id']." or id_loai = ".$loai['id_loai']." or id = ".$loai['id_loai'].") and id_loai <>0");
        
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
			<?php if(!empty($query['mo_ta_'.$lang])){ ?>	
				<div class="des-module mb10">
					<?= $query['mo_ta_'.$lang]; ?>			
				</div>
			<?php } ?>
            <?php if(count($sanpham)>0){ ?>
                <div class="row list-product m-10">
                    <?php include 'ct_product.php'; ?>
                </div>
                <div class="pagination-page">
                    <?php echo @$phantrang['paging']?>
                </div>
                <?php }else{ ?>
                <p class="text-center">Nội dung đang cập nhật</p>
            <?php }?>
        </div>
        
    </div>
</div>