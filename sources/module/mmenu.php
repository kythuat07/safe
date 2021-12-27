<?php
    $menu = "";
    $nav        = $d->o_fet("select * from #_category where tieu_bieu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
    foreach($nav as $item) {
        $sub=$d->o_fet("select * from #_category where id_loai={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
        if(count($sub)>0) {
            $menusub="";
            foreach ($sub as $key => $item1) {
                $sub1=$d->o_fet("select * from #_category where id_loai={$item1['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
                if(count($sub1)>0){
                    $menusub2="";
                    foreach ($sub1 as $key1 => $item2) {
                        $menusub2.='<li><a href="'.URLPATH.$item2['alias_'.$lang].'.html" title="'.$item2['ten_'.$lang].'">'.$item2['ten_'.$lang].'</a></li>';
                    }
                    $menusub.='
                        <li>
                            <a href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].' <span class="caret"></span></a>
                            <ul>'.$menusub2.'</ul>
                        </li>'; 
                }  else {
                   $menusub.='<li><a href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].'</a></li>'; 
                }
                
            }
            $menu.='<li>
                        <a href="'.URLPATH.$item['alias_'.$lang].'.html"  title="'.$item['ten_'.$lang].'">'.$item['ten_'.$lang].'</a>
                        <ul>
                            '.$menusub.'
                        </ul>
                    </li>';
        }  else {
            $menu.='<li><a href="'.URLPATH.$item['alias_'.$lang].'.html" title="'.$item['ten_'.$lang].'">'.$item['ten_'.$lang].'</a></li>';
        }
        
    }
    //echo $menu;
?> 

<link href="<?= URLPATH ?>templates/module/HC-MobileNav/css/HC-Mobilenav.css" rel="stylesheet"/>
<nav id="main-nav">
    <ul class="second-nav">
        <?= $menu ?>
    </ul>
</nav>
<!-- hc-offcanvas-nav -->
<script src="<?=URLPATH?>templates/module/HC-MobileNav/js/hc-offcanvas-nav.js"></script>
<script>
    (function($) {
      var $main_nav = $('#main-nav');
      var $toggle = $('.navbar-toggle');
      var defaultData = {
    	maxWidth: false,
    	customToggle: $toggle,
    	navTitle: 'Danh mục',
    	levelTitles: true,
    	pushContent: '#container',
    	insertClose: false,
      };
      // call our plugin
      var Nav = $main_nav.hcOffcanvasNav(defaultData);
    
    })(jQuery);
</script>
<!-- hc-offcanvas-nav -->