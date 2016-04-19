  </div><!-- //#contents -->
  <footer>
    <small><a href="<?php bloginfo( 'url' ); ?>">&copy; 2015 格安SIMでスマホお得道</a></small>
  </footer>
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

});
</script>
</body>
</html>
