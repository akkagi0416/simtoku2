  </div><!-- //#contents -->
  <footer>
    <small><a href="<?php bloginfo( 'url' ); ?>">&copy; 2015 格安SIMでスマホお得道</a></small>
  </footer>
<?php wp_footer(); ?>
<script>
jQuery(function(){
  // jQuery('.open_button').click(function(){
  //   jQuery('.open_nav').toggle('slow');
  // });

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
});
</script>
</body>
</html>
