<?php
$ctsp = $d->o_fet("select * from #_sanpham where hien_thi = 1 and alias_".$_SESSION['lang']." = '".$com."'");
$property=explode('@1@',$ctsp[0]['property']);
if(count($ctsp) == 0) $d->location(URLPATH."404.html");
$loai = $d->simple_fetch("select * from #_category where hien_thi = 1 and id = ".$ctsp[0]['id_loai']." ");
$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and id <> '".@$ctsp[0]['id']."' and id_loai = '".@$ctsp[0]['id_loai']."' order by id desc limit 0,6");
$hinh_anh_sp = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".@$ctsp[0]['id']."' order by id desc");

$list_color = $d->o_fet("select * from #_sanpham_phienban where type = 0 and id_sanpham = '".$ctsp[0]['id']."'");
$list_size = $d->o_fet("select * from #_sanpham_phienban where type = 1 and id_sanpham = '".$ctsp[0]['id']."'");
if($ctsp[0]['gia']==''){
        $gia='<span class="p-price gia-center">Liên hệ</span>';
}else{
    if($item['khuyen_mai']==''){
         $gia='<span class="p-price gia-center">'.$ctsp[0]['gia'].' VNĐ</span>';
    }else{
        $gia=' 
        <span class="p-price">'.$ctsp[0]['khuyen_mai'].' VNĐ</span>
        <span class="p-oldprice">'.$ctsp[0]['gia'].' VNĐ</span>';

    }

}
if(isset($_POST['lienhe'])){
    $d->reset();
    $data['ho_ten'] = addslashes($_POST['ho_ten']);
    $data['email'] = addslashes($_POST['email']);
    $data['sdt'] = addslashes($_POST['phone']);
    $data['noi_dung'] = addslashes($_POST['noi_dung']);
    $data['ngay_hoi'] = date('d-m-Y H:i:s');
    $data['trang_thai'] = '0';
    $data['tieu_de']="Liên hệ của sản phẩm: <a href=\"".$url_page."\">".$ctsp[0]['ten_vn']."</a>";
    $d->setTable('#_lienhe');
    print_r($data);
    if($d->insert($data)) {
        $d->alert("Gửi thành công!");
        $d->location($url_page);
    }else{
        $d->alert("Gửi thất bại"); 
    }
}
?>
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.theme.default.min.css">
<link href="<?=URLPATH?>templates/module/magiczoomplus/magiczoomplus.css" rel="stylesheet" />
<script src="<?=URLPATH?>templates/module/magiczoomplus/magiczoomplus.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <?php include 'right.php'; ?>
        </div>
        <div class="col-md-9 col-sm-8">
            <h1 class="title-home"><span><?=$loai['ten_vn']?></span></h1>
            <?= $d->breadcrumbList($loai['id'],$lang,URLPATH) ?>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6 col-sm-12 hinh-sp">
                    <div class="zoom-gallery">
                        <a class="MagicZoom" id="Zoom-v" title="" href="<?=URLPATH ?>img_data/images/<?=$ctsp[0]['hinh_anh'] ?>">
                            <img src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$ctsp[0]['hinh_anh']?>&w=500&h=400">
                        </a>
                    </div>
                    <?php if(count($hinh_anh_sp)>0){ ?>
                    <br>
                    <div class="slide-sp owl-carousel owl-theme">
                        <div class="item">
                           <a class="thumb-item" style="background-image:url('<?=URLPATH ?>img_data/images/<?=$ctsp[0]['hinh_anh'] ?>');"
                               data-image="<?=URLPATH ?>img_data/images/<?=$ctsp[0]['hinh_anh'] ?>" >
                           </a>
                       </div>
                       <?php foreach ($hinh_anh_sp as $key => $item) { ?>
                       <div class="item">
                           <a class="thumb-item" style="background-image:url(<?=URLPATH ?>img_data/images/<?=$item['hinh_anh'] ?>);"
                               data-image="<?=URLPATH ?>img_data/images/<?=$item['hinh_anh'] ?>" >
                           </a>
                       </div>
                       <?php } ?>
                    </div>
                    <?php }?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h1 class="ten-sp"><?=$ctsp[0]['ten_'.$lang] ?></h1>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <strong>Mã sản phẩm: <?=$ctsp[0]['ma_sp'] ?></strong>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <div class="giaban">Giá bán: <?=$gia?></div>
                    <hr style="margin-top: 10px;margin-bottom: 10px;border-color: #eae8e8;">
                    <p><b>Mô tả sản phẩm:</b></p>
                    <div>		
                        <?=$ctsp[0]['mo_ta_'.$lang] ?>
                    </div>
                   
                    <div class="lienhe-sp">
                        <form method="post" action="<?=URLPATH."gio-hang.html" ?>">
                            <input type="hidden" name="id" value="<?=$ctsp[0]['id'] ?>">
                            <div class="row m-5">
                                <div class="col-sm-3 box-sl p5">
                                    <input type="number" value="1" class="soluong"  />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-9 p5">
                                    <button type="submit" name="addcart" class="btn btn-block btn-lienhe"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua hàng</button>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs tab-sp">
                <li class="active"><a data-toggle="tab" href="#home">Thông tin chi tiết</a></li>
                <!--li><a data-toggle="tab" href="#menu2">Hướng dẫn thanh toán</a></li-->
                <li><a data-toggle="tab" href="#menu3">Bình luận</a></li>
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div class="chitiettin">
                    <?=$ctsp[0]['thong_tin_'.$lang] ?>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <div class="chitiettin">
                    <?=$ctsp[0]['thong_so_'.$lang] ?>
                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <div class="fb-comments" data-href="<?=$url_page?>" data-width="847" data-numposts="5"></div>
                </div>
            </div>
            
            <h3 class="title-home"><span>Sản phẩm liên quan</span></h3>
            <div class="row list-product m-5">
                <?php include 'ct_product.php'; ?>
            </div>
        </div>
        
    </div>
</div>

<script>
    jQuery('.thumb-item').on('click touch', function() {
        var img = $(this).attr('data-image');
        $('#Zoom-v').attr('href',img);
        $('#Zoom-v img').attr('src',img);
    });
    
    var mzOptions = {
        zoomMode: "magnifier"
    };
</script>
<script src="<?= URLPATH ?>templates/module/owlcarousel/owl.carousel.min.js"></script>
<script>
    $('.slide-sp').owlCarousel({
        loop:true,
        margin:5,
        nav:true,
        dots:false,
        //autoplay:true,
        autoplayTimeout:3000,
        responsive:{
            0:{
               items:2
            },
            600:{
                items:3
            },
            1000:{
               items:4
            }
        }
    })
</script>