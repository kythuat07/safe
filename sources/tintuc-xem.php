<section>


<div class="container">
<div class="col-md-12 plr10">
<?php if(count($tintuc)==1) {?>
<div class="box-item module">
<div class="text-contents wow fadeIn" data-wow-duration="2s">
<div class="text-pages">
<?=@$tintuc[0]['noi_dung_'.$_SESSION['lang']]?>
</div>
</div>	
<div class="like-share-page">
<div class="facebook">
<div class="fb-like" data-href="<?=$url_page?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
<div class="twitter">
<a href="<?=$url_page?>" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>
<div class="google">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<g:plusone size="medium"></g:plusone>
</div>		
</div> 
<div class="clearfix"></div>
<div class="comment-facebook">
<div class="fb-comments" data-href="<?=$url_page?>" data-numposts="5" data-width="100%"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</div>
					
<div class="clearfix"></div>
<div class="tags">
<span><i class="glyphicon glyphicon-tags"></i> Tags:</span>
<?php 
$tags_ht = $d->o_fet("select id,alias, ten_vn from #_tags where id in (".stripslashes(@$tintuc[0]['tags']).")");
foreach ($tags_ht as  $val) 
{
echo "<a class='a-tags' href='".URLPATH.$lang."tags/".stripslashes($val['alias']).".html'>".stripslashes($val['ten_vn']).'</a>';
}
?>
</div>
</div>
<?php } else {?>
<div class="row5">
<?php $k=0; foreach ($tintuc  as $i => $item) { ?>				
<div class="col-md-4 col-sm-4">
<div class="service-feature-box">
<div class="service-media">
<img onerror="this.src='<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>templates/error/error.jpg&w=400&h=300';"  src="<?=URLPATH ?>thumb.php?src=<?=URLPATH ?>img_data/images/<?=$item['hinh_anh'] ?>&w=400&h=300">	

<a href="<?=URLPATH.$d->create_long_link($item['alias_'.$_SESSION['lang']],$_SESSION['lang']) ?>.html" title="<?=$item['ten_'.$_SESSION['lang']] ?>">
<span>
XEM CHI TIẾT
<i class="fa fa-chevron-right"></i>
</span>
</a>
</div>
<div class="service-body">
<div class="custom-heading">
<h4><?=$item['ten_'.$_SESSION['lang']] ?></h4>
</div>
<p><?=$d->subText($item['mo_ta_'.$_SESSION['lang']],100) ?></p>
</div>
</div>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class="pagination-page">
<?php echo @$phantrang['paging']?>
</div>	
/div>

				
<?php } ?>	
</div>
			
</div>
</section>