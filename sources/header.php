<?php


($com!='') ? $linkcom = "&langcom=".$com : $linkcom ='';
$num_cart = 0;
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        $num_cart = $num_cart + $value['so_luong'];
    }
}
$camket=$d->getImg(1166);
$arrSocialNetwork   = $d->o_fet("select * from #_thongtin where id = 1;");
$hotline =$d->getTemplates(55);
$arrClock =$d->getTemplates(54);
$arrCategory = $d->o_fet("select * from #_category where hien_thi = 1 AND module = 3 order by so_thu_tu asc, id desc");



?>



<header id="mainHeader">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><?= constant('_wellcome'); ?></p>
                </div>
                <div class="col-md-6">
                    <ul class="header-right">
                        <li class="email"><i class="fas fa-envelope"></i> Email:
                            <a href="mail:<?= $arrSocialNetwork[0]['email']; ?>"> <?= $arrSocialNetwork[0]['email']; ?></a>
                        </li>
                        <li class="language">
                            <a class="language-curent" id="changeLanguege" href="javascript:void(0)"><img src="assets/my/images/<?= $_SESSION['lang'] ?>.png" alt="Tiếng Việt" srcset="assets/my/images/<?= $_SESSION['lang'] ?>.png"></a>
                            <ol id="language-select">
                                <li>
                                    <a href="<?= URLPATH?>?lang=vn"><img src="assets/my/images/vn.png" alt="Tiếng Việt" srcset="assets/my/images/vn.png"></a>
                                </li>
                                <li>
                                    <a href="<?= URLPATH?>?lang=ch"><img src="assets/my/images/ch.png" alt="日本語" srcset="assets/my/images/ch.png"></a>
                                </li>
                                <li>
                                    <a href="<?= URLPATH?>?lang=us"><img src="assets/my/images/us.png" alt="English" srcset="assets/my/images/us.png"></a>
                                </li>
                            </ol>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a id="logo" href="index.html">
                        <img src="assets/my/images/logo.png" alt="DRSAFE" srcset="assets/my/images/logo.png">
                    </a>
                </div>
                <div class="offset-md-1"></div>
                <div class="col-md-5">
                    <form action="search.html" method="get">
                        <div class="input-group mt-3 mb-3 form-pc">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                                <?= constant('_danhmucsanpham'); ?>
                                </button>
                                <div class="dropdown-menu">
                                    <?php foreach ($arrCategory as $key => $value) { ?> 
                                    <a class="dropdown-item" href=" <?=  $value['alias_'.$lang] ?>"><?=  $value['ten_'.$lang] ?></a>
                                    <?php } ?> 
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="<?= constant('_search'); ?>...">
                            <div class="input-group-append">
                                <button class="btn btn-success button-search" type="submit">TÌM KIẾM</button>
                            </div>
                        </div>
                        <div class="input-group mt-3 mb-3 form-mobie">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                    <a  class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="<?= constant('_search'); ?>...">
                            <div class="input-group-append">
                                <button class="btn btn-success button-search" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4" align="center">
                    <div class="clock">
                        <div class="image-content">
                            <img src="<?= URLPATH.'img_data/images/'.$arrClock['hinh_anh']; ?>">
                        </div>
                        <div class="text-content">
                            <span class="title"><?= $arrClock['ten_'.$lang]; ?>:</span>
                            <?= $arrClock['noi_dung_'.$lang]; ?>
                        </div>
                    </div>
                    <div class="phone">
                        <div class="image-content">
                            <img src="<?= URLPATH.'img_data/images/'.$hotline['hinh_anh']; ?>">
                        </div>
                        <div class="text-content">
                            <span><?= $hotline['ten_'.$lang]; ?>:</span>
                            <?= $hotline['noi_dung_'.$lang]; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="mainMenu">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">

                        <ul class="nav nav-pills  nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?=URLPATH?>">Trang chủ</a>
                            </li>
                            <?php include 'module/menu.php'; ?>
                        </ul>
                    </div>

                    <div class="cart">
                        <a class="nav-link" href="<?= URLPATH?>gio-hang.html">
                            <i class="fas fa-shopping-cart"></i>
                            <span>12</span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>