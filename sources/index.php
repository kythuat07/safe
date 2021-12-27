<?php 

    $arrCategorys  = $d->getImg(1172);
    $arrAbout = $d->o_fet("select * from #_category where hien_thi = 1 AND id = 1173");
    $arrAboutImage  = $d->getImg(1173);
    $arrCategoryProduct = $d->o_fet("select * from #_category where hien_thi = 1 AND module = 3 and menu = 1 order by so_thu_tu asc, id desc");
?>
                                
    <section id="mainContents">
        <?php include 'module/slider.php';  ?>
        <div id="categorys">
            <div class="container">
                <div class="row">
                    <?php foreach ($arrCategorys as $key => $value) { ?>
                        
                        <div class="col-md-2 item" align="center">
                            <div class="category-image">
                                <img src="<?= URLPATH.'img_data/images/'.$value['picture']; ?>">
                            </div>
                            <div class="category-content">
                                <h5><?= $value['title_'.$lang] ?></h5>
                                <p><?= $value['body_'.$lang] ?></p>
                            </div>
                        </div>
                        
                        <?php echo   $key+1 <  count($arrCategorys)? '<div class="offset-md-2"></div>': ''; } ?>
                </div>
            </div>
        </div>
        <div id="about">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 about-image">
                        <img class="water-image" src="<?= URLPATH.'img_data/images/'.$arrAbout[0]['hinh_anh']; ?>">
                    </div>
                    <div class="col-md-7">
                        <div class="about-content">
                            <h2><?= $arrAbout[0]['ten_'.$lang]?></h2>
                            <p><?= $arrAbout[0]['mo_ta_'.$lang]?></p>
                        </div>
                        <div class="about-item">
                            <div class="row">
                                <?php foreach ($arrAboutImage as $key => $value) { ?>
                                    <div class="item col-md-3 col-sm-6 col-xs-6">
                                        <img src="<?= URLPATH.'img_data/images/'.$value['picture']; ?>">
                                        <span class="item-number"><?= $value['body_'.$lang] ?></span>
                                        <p class="item-text"><?= $value['title_'.$lang] ?></p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <p class="about-detail"><a href="<?= URLPATH ?>gioi-thieu.html">Chi tiết <i class="fas fa-angle-double-right"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($arrCategoryProduct as $key => $value) { 
            $intId =  $value['id'];
            $arrProduct = $d->o_fet("select * from #_sanpham where hien_thi = 1 AND id_loai =$intId  order by so_thu_tu asc, id desc limit 6");
            $strClass = ($key/2 == 0 )? ' products-food' : 'products-equipment';
        ?>
            <div class="<?=  $strClass ?>">
                <div class="container">
                    <div class="title">
                        <h2><?= $value['ten_'.$lang]?></h2>
                        <span class="line"></span>
                        <p><?= $value['mo_ta_'.$lang]?></p>
                    </div>
                    <div class="row">
                        <?php foreach ($arrProduct as $key => $item) : 
                            $gia=$item['gia'];
                            $km = $item['khuyen_mai'];
                        ?>
                        <div class="col-md-4 mb-2">
                            <div class="item-product">
                                <div class="item-image">
                                    <img src="<?= URLPATH.'img_data/images/'.$item['hinh_anh']; ?>" alt="" srcset="">
                                </div>
                                <div class="item-content">
                                    <h4 class="item-title"><?= $item['ten_'.$lang]?></h4>
                                    <p class="item-price"> 
                                        <?php if($km>0){ ?>
                                            <?=$d->vnd($km)?> 
                                        <?php }else{?>
                                            <?php if($gia==0){ ?>
                                            <strong>Liên hệ</strong>
                                            <?php }else{?>
                                                <?=$d->vnd($gia)?>
                                            <?php }?>
                                        <?php }?>
                                    </p>
                                    <div class="btn-even">
                                        <a href="<?= $item['alias_'.$lang]?>.html" class="btn btn-now buy-now" type="button">
                                            MUA NGAY 
                                        </a>
                                        <a class="btn btn-buy add-cart" type="button">
                                        THÊM VÀO <i class="fas fa-cart-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <p class="product-more"><a href="<?= $value['alias_'.$lang]?>.html"><?= constant('_viewmore'); ?><i class="fas fa-angle-double-right"></i></a></p>
                </div>
            </div>
        <?php } ?>
        <div id="form-email">
            <img class="open-envelope" src="assets/my/images/open-envelope.png">
            <div class="container pt-5">
                <div class="row">
                    <div class="offset-md-1">

                    </div>
                    <div class="col-md-4 text-image  pt-3">
                        <img src="assets/my/images/write.png" alt="">
                        <p> <?= constant('_nhapdiachiemail'); ?></p>
                    </div>
                    <div class="col-md-6  pt-3 form-custom">
                        <form method="POST">
                            <div class="input-group mb-3">
                                <input type="text" name="emailFile" id="emailFile" class="form-control" placeholder="Email ...">
                                <div class="input-group-append">
                                    <button type="button" id="submitAddFormEmail" name="submitAddFormEmail" class="btn btn-custom">Đăng Ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="offset-md-1">

                    </div>
                </div>
            </div>
        </div>
    </section>