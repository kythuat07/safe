<?php 
    $nav_left   = $d->o_fet("select * from #_category where id_loai = 1113 and hien_thi=1 order by so_thu_tu asc, id desc");
    $support    = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
    $news_left  = $d->o_fet("select * from #_tintuc where noi_bat=1 and hien_thi=1 and id_loai=1156  order by so_thu_tu asc, id desc limit 0,10");   
    $video = $d->getTemplates(52);
    $sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 and tieu_bieu = 1 order by so_thu_tu asc, id desc limit 0,3");
?>
<div class="xs-none">
<link rel="stylesheet" type="text/css" href="<?=URLPATH?>templates/module/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?=URLPATH?>templates/module/slick/slick-theme.css"/>
<h2 class="title-home2"><span>Danh mục sản phẩm</span></h2>
<nav class="nav-right">
    <ul>
        <?php foreach ($nav_left as $key => $value) {?>
        <li>
            <a href="<?=URLPATH.$value['alias_vn']?>.html" title="<?=$value['ten_vn']?>">
                <i class="fa fa-cubes" aria-hidden="true"></i> <?=$value['ten_vn']?>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>
<h2 class="title-home2"><span>Hỗ trợ  trực tuyến</span></h2>
<div class="hotro" style="margin-bottom:30px;">
    <img src="<?=URLPATH?>img_data/images/<?=$support[0]['hinh_anh']?>" />
    <div class="hotline-right">
        Hotline: <?=$hotline?>
    </div>
	<div class="zalo">
        Zalo: <a style="color: #12b1d7;" href="http://zalo.me/<?=$zalo?>"><?=$zalo?></a>
    </div>
    <div class="email">
        Email: <?=$skype?>
    </div>
    
</div>
<h2 class="title-home2"><span>Sản phẩm nổi bật</span></h2>
<div class="san-phamhot" style="margin-bottom:30px;">
<?php
foreach ($sanpham as $key => $item) {
    $gia=$item['gia'];
    $km = $item['khuyen_mai'];
?>
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
    </div>
<?php }?>
</div>
<h2 class=" title-home2"><span>Tin tức nổi bật</span></h2>
<div class="new-righ" style="margin-bottom:30px;">
    <?php foreach ($news_left as $key => $item) {?>
    <div class="item-new-right">
        <div class="row m-5">
            <div class="col-sm-3 col-xs-4 p5">
                <a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=@$item['ten_'.$lang] ?>">
                    <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh']?>&w=200&h=200" alt="<?=$item['ten_'.$lang] ?>" onerror="this.src='<?=URLPATH ?>templates/error/error.jpg';">
                </a>
            </div>
            <div class="col-sm-9 col-xs-8 p5">
                <h3 class="name"><a href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=@$item['ten_'.$lang] ?>"><?=$item['ten_'.$lang] ?></a></h3>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<h2 class=" title-home2"><span>Video clip</span></h2>
<div class="video">
    <iframe width="560" height="200" src="<?= $video['link']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?=URLPATH?>templates/module/slick/slick.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.san-phamhot').slick({
            slidesToShow: 1,
            autoplay:true,
            autoplaySpeed: 4000,
            vertical: true,
            arrows:false
        });
     })
</script>
</div>