<?php
$flash_sale = $d->o_fet("select * from #_flash_sale where status = 1 limit 0,1");
$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1  and deals = 1 order by so_thu_tu asc, id desc");
$curPage = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
$url= $d->fullAddress();
$maxR= 25;
$maxP=3;
$phantrang=$d->phantrang($sanpham, $url, $curPage, $maxR, $maxP,'classunlink','classlink','page');
$sanpham=$phantrang['source'];
function chuyenthang_chu($ngayI){
    $star_time = $ngayI;
    $arrtime = explode(' ', $star_time);
    $ngay =  date('M d, Y',strtotime($arrtime[0]));
    //echo $arrtime[1];
    if($arrtime[2]=='PM'){
        $arrgio = explode(':',$arrtime[1]);
        $gio = $arrgio[0]+12;
        $giophut=$gio.":'".$arrgio[1];
    }  else {
        $giophut = $arrtime[1];
    }
    $ngay2 = $ngay." ". $giophut.":00";
    return $ngay2;
}
function chuyenthang_so($ngayI){
    $star_time = $ngayI;
    $arrtime = explode(' ', $star_time);
    $ngay =  date('Y/m/d',strtotime($arrtime[0]));
    //echo $arrtime[1];
    if($arrtime[2]=='PM'){
        $arrgio = explode(':',$arrtime[1]);
        $gio = $arrgio[0]+12;
        $giophut=$gio.":".$arrgio[1];
    }  else {
        $giophut = $arrtime[1];
    }
    $ngay2 = $ngay." ". $giophut;
    return $ngay2.":00";
}
?>
<div class="container">
    <ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
        <li property="itemListElement" typeof="ListItem"> 
            <a property="item" typeof="WebPage" href="http://demo10.phuongnamvina.vn/"> 
                    <span property="name">Trang chủ</span>
            </a> <meta property="position" content="1"> 
        </li>

        <li property="itemListElement" typeof="ListItem"> 
            <a class="active" property="item" typeof="WebPage" href="<?=URLPATH.$com?>.html"> 
                <span property="name">Deals giờ vàng</span>
            </a> <meta property="position" content="2"> 
        </li>
    </ol>
    <p id="deals"></p>
    <?php if(count($sanpham)>0){ ?>
    <div class="row m0 product-list">
        <?php include 'ct_product.php'; ?>
    </div>
    <div class="pagination-page">
        <?php echo @$phantrang['paging']?>
    </div>
    <?php }else{ ?>
    <p class="text-center">Nội dung đang cập nhật</p>
    <?php }?>
</div>
<script>
    // Thiết lập thời gian đích mà ta sẽ đếm
    var countDownDate = new Date("<?= chuyenthang_chu($flash_sale[0]['end_time'])?>").getTime();

    // cập nhập thời gian sau mỗi 1 giây
    var x = setInterval(function() {

      // Lấy thời gian hiện tại
      var now = new Date().getTime();

      // Lấy số thời gian chênh lệch
      var distance = countDownDate - now;

      // Tính toán số ngày, giờ, phút, giây từ thời gian chênh lệch
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // HIển thị chuỗi thời gian trong thẻ p
      document.getElementById("deals").innerHTML = "<strong>Thời gian còn: </strong><span>"+days + " Ngày</span><span>" + hours + " Giờ</span><span> "
      + minutes + " Phút</span><span>" + seconds + " Giây</span> ";

      // Nếu thời gian kết thúc, hiển thị chuỗi thông báo
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "Thời gian đếm ngược đã kết thúc";
      }
    }, 1000);
  </script>