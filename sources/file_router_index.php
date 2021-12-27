<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$alias = (isset($_REQUEST['alias'])) ? addslashes($_REQUEST['alias']) : "";
	$alias1 = (isset($_REQUEST['alias1'])) ? addslashes($_REQUEST['alias1']) : "";
	$alias2 = (isset($_REQUEST['alias2'])) ? addslashes($_REQUEST['alias2']) : "";
	

	if($com=='search') {
		$com='search';
	}
	else if($com=='khuyen-mai') {
		$com='khuyen-mai';
	}
	else if($com=='cart-success') {
		$com='cart-success';
	}
	else if($com=='tags') {
		$com='tags';
	}
	else {
            if($alias!='') {
                    $com=$alias;
            }
            if($alias1!='') {
                    $com=$alias1;
            }
            if($alias2!='') {
                    $com=$alias2;
            }
	}
	
	$query=$d->o_fet("select * from #_category where alias_{$_SESSION['lang']}='$com' ");
	if(count($query) > 0 && $com!='') {
		if($query[0]['module']==1) {
			$source = 'gallery';		
		}
		else if($query[0]['module']==2) {
			$source = 'tin-tuc';
		}
		else if($query[0]['module']==3) {
			$source = 'san-pham';
		}
		else if($query[0]['module']==4) {
			$source = 'tu-van';
		}
		else if($query[0]['module']==5) {
			$source = 'lien-he';
		}
		else if($query[0]['module']==6) {
			$source = 'video';
		}
		else if($query[0]['module']==7) {
			$source = 'gio-hang';
		}
	}
	else if($d->num_rows("select * from #_tintuc where hen_ngay_dang<'".time()."' and alias_{$_SESSION['lang']}='$com' ") > 0 && $com!='') {
		$source = 'tin-tuc-detail';
	}
	else if($d->num_rows("select * from #_sanpham where alias_{$_SESSION['lang']}='$com' ") > 0 && $com!='') {
		$query = $d->simple_fetch("select * from #_sanpham where alias_{$_SESSION['lang']}='$com' ");
		if($query['style']==0) {
			$source = 'san-pham-detail';
		}
		else {
			$source = 'bat-dong-san-detail';
		}
	}
	else if($com == 'dat-lich'){
		$source = 'dat-lich';
	}
	else if($com == 'sitemap'){
		$source = 'sitemap';
	}
	else if($com == 'faqs'){
		$source = 'faqs';
	}
	else if($com == 'tags'){
		$source = 'tin-tuc';
	}
	else if($com == 'livedemo'){
		$source = 'livedemo';
	}
	else if($com == 'search'){
		$source = 'search';
	}	
	else if($com == 'cart-success'){
            $source = 'thanh-cong';
	}
        else if($com == 'deals-gio-vang'){
            $source = 'deals-gio-vang';
        }
        else if($com == 'thanh-vien'){
            $source = 'thanh-vien';
        }
        else if($com == 'yeu-cau-bao-gia'){
            $source = 'yeu-cau-bao-gia';
        }
	else if($com=='') {
		$source = 'index';
	}
	else if($com=='404'){
		$source = '404';
	}
	else {
		$source = '404';
	}

	// var_dump($source);
	// var_dump($com);
?>