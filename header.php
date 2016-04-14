<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php wp_title(); ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.css">
  <!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  -->
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
    <div id="slide_menu">
      <p class="slide_menu__title">メニュー<i class="fa fa-times close_button" aria-hidden="true"></i></p>
      <nav>
      <?php
        $args = array(
          'container'       => false,
          'items_wrap'      => '<ul>%3$s</ul>',
        );
        wp_nav_menu( $args );
      ?>
      </nav>
    </div>
  </header>
  <div class="img_main"><img src="<?php bloginfo( 'template_url' ); ?>/img/main.jpg" alt="" ></div
  <?php if( function_exists( 'bcn_display' ) && !is_front_page() ) : ?>
    <div class="bread_crumb">
      <?php bcn_display(); ?>
    </div>
  <?php endif; ?>
