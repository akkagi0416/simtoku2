<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php wp_title(); ?></title>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-54272662-12', 'auto');
    ga('require', 'linkid');
    ga('send', 'pageview');
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <div class="top">
      <a href="<?php bloginfo( 'url' ); ?>">
        <?php if( is_front_page() ) : ?>
          <h1 class="logo"><?php bloginfo( 'title' ); ?></h1>
        <?php else : ?>
          <p  class="logo"><?php bloginfo( 'title' ); ?></p>
        <?php endif; ?>
      </a>
    <button class="open_button">☰</button>
    </div>
    <form  method="get" action="<?php echo home_url( '/' ); ?>">
      <input type="text" value name="s" placeholder="検索...">
      <input type="submit" value="検索">
    </form>
  </header>
  <div id="slide_menu">
    <p class="slide_menu__title">メニュー<i class="fa fa-times close_button" aria-hidden="true"></i></p>
    <nav>
    <?php
      $args = array(
        'menu'       => 'nav2',
        'container'  => false,
        'items_wrap' => '<ul>%3$s</ul>',
      );
      wp_nav_menu( $args );
    ?>
    </nav>
  </div>
  <div class="dummy_header"></div>
  <?php if( is_front_page() || is_category() ) : ?>
    <div class="img_main"><img src="<?php bloginfo( 'template_url' ); ?>/img/main.jpg" alt="" ></div>
  <?php else : ?>
    <!--
    <div class="img_main hidden"><img src="<?php bloginfo( 'template_url' ); ?>/img/main.jpg" alt="" ></div>
    -->
    <div class="img_main"><img src="<?php bloginfo( 'template_url' ); ?>/img/main.jpg" alt="" ></div>
  <?php endif; ?>
  <?php if( function_exists( 'bcn_display' ) && !is_front_page() ) : ?>
    <div class="bread_crumb">
      <?php bcn_display(); ?>
    </div>
  <?php endif; ?>
  <div id="contents">
