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
    if( jQuery(this).parent('div.table-responsive').length ){
    }else{
      // div.table-responsiveで囲まれていなければ囲う
      jQuery(this).wrap('<div class="table-responsive"></div>');
    }
  });

  // add div.iframe-responsive
  jQuery('iframe').each(function(){
    if( jQuery(this).parent('div.iframe-responsive').length ){
    }else{
      // div.iframe-responsiveで囲まれていなければ囲う
      jQuery(this).wrap('<div class="iframe-responsive"></div>');
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
});
</script>
</body>
</html>
