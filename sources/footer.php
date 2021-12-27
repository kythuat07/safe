<?php
    $arrSupport = $d->getTemplates(53);
    $arrSocialNetwork   = $d->o_fet("select * from #_thongtin where id = 1;");
?>

<footer id="mainFooter">
        <div class="footer-content ">
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-5 contact">
                        <h3>Thông tin liên hệ</h3>
                        <p><i class="fas fa-map-marker-alt"></i> <?= $arrSocialNetwork[0]['address']; ?></p>
                        <p><i class="fas fa-phone-volume"></i> <a href="tel:<?= $arrSocialNetwork[0]['hotline']; ?>"><?= $arrSocialNetwork[0]['hotline']; ?> <?= $arrSocialNetwork['map']; ?></a></p>
                        <p><i class="fas fa-envelope"></i> <a href="mail:<?= $arrSocialNetwork[0]["email"]; ?>"><?= $arrSocialNetwork[0]['email']; ?></a></p>
                        <p><i class="fas fa-globe-asia"></i> <a href="<?= URLPATH; ?>"> <?= URLPATH; ?></a></p>
                    </div>
                    <div class="col-md-3 customer">
                        <h3><?= $arrSupport['ten_'.$lang]; ?></h3>
                        <?= $arrSupport['noi_dung_'.$lang]; ?>
                    </div>
                    <div class="col-md-4 checkin">
                        <h3>Hướng dẫn đi đường</h3>
                            <?= $arrSocialNetwork[0]['map']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrighter container">
            <div class="row">
                <div class="col-md-6">
                    <p><?= $copyright ?> - <?=$backlink?></p>
                </div>
                <div class="col-md-6 social">
                    <p>Liên kết mạng xã hội
                        <a href="<?= $arrSocialNetwork[0]['facebook']; ?>"><i class="fab fa-facebook-square"></i></i></a>
                        <a href="<?= $arrSocialNetwork[0]['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                        <a href="mail:<?= $arrSocialNetwork[0]['email']; ?>"><i class="fas fa-at"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>