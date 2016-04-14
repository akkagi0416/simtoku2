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
    // if(body.hasClass('open')){
    //   body.animate({'right': menuWidth, 'position': absolute }, 300);
    //   menu.animate({'right': 0 }, 300);
    // }else{
    //   body.animate({'right': 0 }, 300);
    //   menu.animate({'right': -menuWidth }, 300);
    // }
  });
});
</script>
</body>
</html>
