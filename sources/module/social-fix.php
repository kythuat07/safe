<style type="text/css">
  .like-share-fixed {
    position: fixed;
    right: 5px;
    top: 50%;
    margin-top: -113.5px;
    width: 80px;
    border: solid 1px #ebebeb;
    padding: 5px;
    border-radius: 3px;
    background: #FFF;
}
.like-share-fixed .facebook {
    float: left;
    margin-bottom: 10px;
    width: 70px;
    text-align: center;
}
.like-share-fixed .google {
    float: left;
    margin-bottom: 3px;
    width: 70px;
    text-align: center;
}
.like-share-fixed .twitter {
    float: left;
    width: 70px;
    text-align: center;
}
</style>
<div class="like-share-fixed like-destop">
  <div class="facebook">
    <div class="fb-like" data-href="<?=$url_page?>" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
  </div>
  <div class="google">
    <div class="google">
      <script src="https://apis.google.com/js/platform.js" async defer></script>
      <g:plusone size="tall"></g:plusone>
    </div>  
  </div>
  <div class="twitter">
    <a href="<?=$url_page?>" class="twitter-share-button">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </div>  
</div>
