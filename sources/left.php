<?php 
	$nav_pro	= $d->o_fet("select * from #_category where hien_thi=1 and id_loai=1113 order by so_thu_tu asc, id desc");
    $nav_services   = $d->o_fet("select * from #_category where hien_thi=1 and id_loai=1098 order by so_thu_tu asc, id desc");
    $support    = $d->o_fet("select * from #_hotro where hien_thi=1 order by so_thu_tu asc, id desc");
    $list_id = '1026'.$d->findIdSub(1026);
    $news_left  = $d->o_fet("select * from #_tintuc where hen_ngay_dang<'".time()."' and hien_thi=1 and id_loai in ({$list_id}) order by so_thu_tu asc, id desc limit 0,2");
     $quang_cao = $d->o_fet("select * from #_gallery where hide = 1 and parent = 1132");   
?>

<div class="col-md-3 col-left plr10" >
    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><span class="at"></span><?=_danhmucsanpham?></h3>
        <div class="box category" >
            <ul class="sub fadeInRight" >
                <?php foreach($nav_pro as $item) {                
                $sub=$d->o_fet("select * from #_category where id_loai={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");  
                ?>
                <li <?=(count($sub) ? "class='arrow-sub'" : '')?>>
                    <span class="ic-menu"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
                    <a <?=($item['id']==$_SESSION['nav'][1]) ? 'class="active"' : ''?> href="<?=URLPATH.$item['alias_'.$lang] ?>.html" title="<?=$item['ten_'.$_SESSION['lang']]?>"><?=$item['ten_'.$_SESSION['lang']]?></a>
                    <?php if(count($sub)>0) {?>
                    <ul class="sub_1">
                        <?php foreach($sub as $item1) {?>
                            <li><a <?=($item1['id']==$_SESSION['nav'][2]) ? 'class="active"' : ''?> href="<?=URLPATH.$item1['alias_'.$lang] ?>.html" title="<?=$item1['ten_'.$_SESSION['lang']]?>"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span><?=$item1['ten_'.$_SESSION['lang']]?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="clearfix bao-left">
        <h3 class="title-left title-font"><span class="at"></span><?=_support_online?></h3>
        <div class="box box10">
            <div class="support-online">
                <div class="img-hotline mb10">
                    <img src="templates/images/hot-line.png" alt="hot line">
                </div>
                <?php foreach($support as $item) { $st++; ?>
                   
                     <div class="col-md-12 col-sm-6 plr5">
                        <div class="support mb10">
                            <div class="phone">
                                <i class="fa fa-phone"></i>
                                <span class="so-dt"><?=$item['sdt']?></span>
                            </div>
                            <div class="title-hotro">
                                <i class="fa fa-skype"></i>
                               <a href="<?=$item['skype']?>"><span class="name"><?=$item['ten_vn']?></span></a>
                            </div>                           
                            <div class="hot-line">
                                <i class="fa fa-envelope"></i>
                                <span class="email"><?=$item['yahoo']?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div> 
        </div>
    </div>
    <div>
        <?php foreach($quang_cao as $item): ?>
        <div>
            <img data-u="image" src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['picture']?>&w=400&h=350" alt="<?=$item['title_'.$_SESSION['lang']]?>" />
        </div>
        <?php endforeach ?>
    </div>
</div>

