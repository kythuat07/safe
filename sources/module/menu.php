<?php
 $menu = "";
    $nav  = $d->o_fet("select * from #_category where tieu_bieu=1 and hien_thi=1 order by so_thu_tu asc, id desc");
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
                        <li  class="nav-item">
                            <a class="nav-link" href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].' <span class="caret"></span></a>
                            <ul>'.$menusub2.'</ul>
                        </li>'; 
                }  else {
                   $menusub.='<a class="dropdown-item" href="'.URLPATH.$item1['alias_'.$lang].'.html" title="'.$item1['ten_'.$lang].'">'.$item1['ten_'.$lang].'</a>'; 
                }
                
            }

            $menu.='<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" title="'.$item['ten_'.$lang].'" href="'.URLPATH.$item['alias_'.$lang].'.html" data-toggle="dropdown"> '.$item['ten_'.$lang].' </a>
                        <div class="dropdown-menu">
                            '.$menusub.'
                        </div>
                    </li>';
        }  else {
            $menu.='<li class="nav-item"><a class="nav-link" href="'.URLPATH.$item['alias_'.$lang].'.html" title="'.$item['ten_'.$lang].'">'.$item['ten_'.$lang].'</a></li>';
        }
        
    }

    echo $menu;

?>



<!-- 

                            
                    <li class="nav-item dropdown show">
                        <a class="nav-link dropdown-toggle" title="Sản phẩm" href="http://localhost/safe/san-pham.html" data-toggle="dropdown" aria-expanded="true"> Sản phẩm </a>
                        <ul class="dropdown-menu show">
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/safe/thuc-pham-chuc-nang.html" title="Thực phẩm chức năng">Thực phẩm chức năng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost/safe/thiet-bi-y-te.html" title="Thiết bị y tế">Thiết bị y tế</a>
                            </li>
                        </ul>
                    </li>
                            
                            <li class="nav-item dropdown">
                                
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Dropdown</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li> -->