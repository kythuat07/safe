<?php foreach ($sanpham as $key => $item) {
    $gia=$item['gia'];
    $km = $item['khuyen_mai']
?>
    <div class="col-md-3 col-sm-6 p10">
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
                <a href="<?=URLPATH.$item['alias_'.$lang]?>.html">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Mua ngay
                </a>
            </div>
        </div>
    </div>
<?php } ?>