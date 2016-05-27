  </div><!-- //#contents -->
  <footer>
    <div class="footer_img">
      <a href="<?php bloginfo( 'url' ); ?>/about/">
        <i class="fa fa-map-o footer_img__logo" aria-hidden="true"></i>
      </a>
    </div>
    <div class="footer_text">
      <ul>
        <li><a href="<?php bloginfo( 'url' ); ?>/about/">サイト情報</a></li>
        <li><a href="<?php bloginfo( 'url' ); ?>/about/#contact">お問い合わせ</a></li>
        <li><a href="<?php bloginfo( 'url' ); ?>/category/blog/">管理人のひとり言</a></li>
      </ul>
      <small><a href="<?php bloginfo( 'url' ); ?>">&copy; 2015 格安SIMでスマホお得道</a></small>
    </div>
  </footer>
  <div class="to_top">
    <i class="fa fa-arrow-up" aria-hidden="true"></i>
  </div>
<?php wp_footer(); ?>
<script>
jQuery(function(){

  // slide menu
  jQuery('.open_button').click(function(){
    jQuery('body').toggleClass('open');
    jQuery('header').toggleClass('open');
    jQuery('#slide_menu').toggleClass('open');
  });
  jQuery('.close_button').click(function(){
    jQuery('body').removeClass('open');
    jQuery('header').removeClass('open');
    jQuery('#slide_menu').removeClass('open');
  });

  // add div.table-responsive to table
  jQuery('article table').each(function(){
    if(jQuery(this).parent('div.table-responsive').length ){
    }else if(jQuery(this).hasClass('not_responsive')){
    }else{
      // div.table-responsiveで囲まれていなければ囲う
      jQuery(this).wrap('<div class="table-responsive"></div>');
    }
  });

  // add div.iframe-responsive
  jQuery('iframe').each(function(){
    if( jQuery(this).parent('div.iframe-responsive').length ){
    }else{
      if(!jQuery(this).hasClass('not_responsive')){ 
        // div.iframe-responsiveで囲まれていない
        // not_responsiveクラスでない(responsiveさせないためのクラス)
        jQuery(this).wrap('<div class="iframe-responsive"></div>');
      }
    }
  });
  
  // to top
  jQuery('body').attr('id', 'to_top');
  jQuery('.to_top').click(function(){
    jQuery('body').animate({scrollTop: '0'}, 500);
  });
  jQuery(window).scroll(function(){
    if(jQuery(this).scrollTop() > 200){
      jQuery('.to_top').fadeIn();
    }else{
      jQuery('.to_top').fadeOut();
    }
  });

  // reviews open/close
  jQuery('.reviews button').click(function(){
    // jQuery('.reviews .review').toggle('slow');
    if(jQuery('.reviews .review').hasClass('review_open')){
      jQuery('.reviews .review').removeClass('review_open');
    }else{
      jQuery('.reviews .review').addClass('review_open');
    }
  });

  // search
  // if( jQuery('.search form').length ){ countup(); } // 読み込み時のカウント
  if( location.href.match(/search/) ){ countup(); }
  jQuery('.search form').on('change', function(){
    countup();
    return false;
  });
  jQuery('.search .search_detail__open').click(function(){
    jQuery(this).toggle();
    jQuery('.search_detail__close').toggle();
    jQuery('.search .search_mvno').slideToggle();
    jQuery('.search .search_option').slideToggle();
    return false; // イベントをformまで伝搬させないため
  });
  jQuery('.search .search_detail__close').click(function(){
    jQuery(this).toggle();
    jQuery('.search_detail__open').toggle();
    jQuery('.search .search_mvno').slideToggle();
    jQuery('.search .search_option').slideToggle();
    return false; // イベントをformまで伝搬させないため
  });
  // check button
  jQuery("input[type='checkbox']:checked").parent().addClass('checked');
  jQuery("input[type='checkbox']").change(function(){
    if(jQuery(this).is(':checked')){
      jQuery(this).parent().addClass('checked');
    }else{
      jQuery(this).parent().removeClass('checked');
    }
  });
  // add link to logo
  jQuery('.scroll_div table img').click(function(){
    // var tmp = jQuery(this).parent().next('a').click();
    var href = jQuery(this).parent().parent().find('a').attr('href');
    window.open(href);
  });
});
function countup(number)
{
  var param = jQuery('.search form').serialize();
  // console.log(param);
  jQuery.ajax({
    type: 'GET',
    url: ajax_url,
    data: {
      'action': 'search_count',
      'param': param,
    },
    success: function(response){
      // 検索結果の件数をカウントアップ
      jQuery({count: 0}).animate({count: response}, {
        duration: 500,
        easing: 'linear',
        progress: function(){
          jQuery('.search .count span').text(Math.ceil(this.count));
          jQuery('.search button span').text(Math.ceil(this.count));
        }
      });
      // jQuery('.search .count span').text(response);
    }
  });
}
</script>
</body>
</html>
