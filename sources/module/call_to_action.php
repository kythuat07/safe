<?php
	$hotro= $d->simple_fetch("select * from #_hotro limit 0,1");
?>
<style>
.bottom-contact{display:none}
.btn-phone {
    position: fixed;
    left: 20px;
    bottom: 30px;
    z-index: 99;
}
.btn-phone a i{
	font-size: 24px;
	color: #fff;
}
.btn-phone a{
	background: #dc3545;
	border-radius: 50%;
    box-shadow: -2px 0px 8px -3px black;
    display: block;
    line-height: 53px;
    text-align: center;
    width: 45px;
    height: 45px;
}
.btn-phone a:after{
	content: '';
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: inherit;
    border-radius: inherit;
    -webkit-animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    animation: pulse-animation 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    z-index: -1;
}
span.number-phone{
	position: absolute;
    background: #c01627;
    bottom: 0;
    left: 55%;
    font-size: 18px;
    color: #fff;
    font-weight: 700;
    padding: 0px;
    z-index: -1;
    border-radius: 0 25px 25px 0;
    height: 35px;
    line-height: 35px;
    perspective: 1000px;
    transition: all 600ms cubic-bezier(0.04, 0.94, 0.21, 1.22);
    transform-origin: left;
    top: 7px;
    width: 184px;
}
.touch span.number-phone.no-hover, span.number-phone{
	transform: scaleX(0);
}
.btn-phone:hover span.number-phone, .btn-phone:focus span.number-phone{
	    transform: scaleX(1);
} 
@keyframes pulse-animation{
	0%{

		transform: scale(1);
		opacity: .6;
    }
    40%{

		transform: scale(1.3);
		opacity: .6;
	}
	
	100%{
		transform: scale(2);
		opacity: 0;
	}
}
@media  (max-width: 767px) {
.btn-phone{
	display:none;
}
.bottom-contact{display: block;
    position: fixed;
    bottom: 0;
    background: #0a0a0ab5;
    width: 100%;
    z-index: 99;
    box-shadow: 2px 1px 9px #dedede;
    border-top: 1px solid #eaeaea;}
.bottom-contact ul{
   padding: 0px;
}
.bottom-contact ul li{width: 25%;
    float: left;
    list-style: none;
    text-align: center; font-size:13.5px;}
.bottom-contact ul li span{color:#fff}
.bottom-contact ul li img{    width: 35px;
    margin-top: 10px;
    margin-bottom: 0px;}
 
}
</style>
<div class="btn-phone">
    <a href="tel:<?= $hotro['sdt'] ?> "><i class="fa fa-phone"></i><span class="number-phone"><?= $hotro['sdt'] ?></span></a>
</div>
<div class="bottom-contact">
<ul>
<li>
<a id="goidien" href="tel:<?= $hotro['sdt'] ?>">
<img src="<?= URLPATH?>templates/images/icon-phone2.png"/>
<br>
<span>Gọi điện</span>
</a>
</li>
<li>
<a id="nhantin" href="sms:<?= $hotro['sdt'] ?>">
<img src="<?= URLPATH?>templates/images/icon-sms2.png"/>
<br>
<span>Nhắn tin</span>
</a>
</li>
<li>
<a id="chatzalo" href="http://zalo.me/<?= $hotro['zalo'] ?>">
<img src="<?= URLPATH?>templates/images/icon-zalo2.png"/>
<br>
<span>Chat zalo</span>
</a>
</li>
<li>
<a id="chatfb" href="https://www.messenger.com/t/<?= $hotro['facebook'] ?>">
<img src="<?= URLPATH?>templates/images/icon-mesenger2.png"/>
<br>
<span>Facebook</span>
</a>
</li>
</ul>
</div>