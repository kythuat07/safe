<?php

$slide  = $d->getImg(1130);
$strHtml ="";
// echo $lang; die;
foreach ($slide as $key => $item_sl) {
    $strActive = $key==0?'active':'';
    $strHtml .='
    <div class="carousel-item '.$strActive.'">
        <a href="'.$item_sl['link'].'">
            <img src="'.URLPATH.'img_data/images/'.$item_sl['picture'].'" alt="'.$item_sl['title_'.$lang].'">
            <div class="carousel-caption">
                <h3>'.$item_sl['title_'.$lang].'</h3>
                <p>'.$item_sl['body_'.$lang].'</p>
            </div>
        </a> 
    </div>

    ';
}
?>



<div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?= $strHtml ?>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-left" href="#carousel" data-slide="prev">
        <img src="assets/my/images/left.png" alt="" srcset="">
    </a>
    <a class="carousel-control-right" href="#carousel" data-slide="next">
        <img src="assets/my/images/right.png" alt="" srcset="">
    </a>
</div>