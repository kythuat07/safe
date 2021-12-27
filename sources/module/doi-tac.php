<?php
  $doitac = $d->getImg(1149); 
?>
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="<?= URLPATH ?>templates/module/owlcarousel/assets/owl.theme.default.min.css">

<div class="owl-carousel owl-theme doitac">
    <?php foreach ($doitac as $dt) {?>
    <div class="item">
        <a href="<?=$dt['link'] ?>" >
            <img src="<?=URLPATH ?>img_data/images/<?=$dt['picture'] ?>" />
        </a>
    </div>
    <?php } ?>
</div>

<script src="<?= URLPATH ?>templates/module/owlcarousel/owl.carousel.min.js"></script>
<script>
    $('.doitac').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:3000,
        responsive:{
            0:{
               items:1
            },
            600:{
                items:1
            },
            1000:{
               items:1
            }
        }
    })
</script>