<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php wp_title(); ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
  <?php wp_head(); ?>
</head>
<body>
  <header>
    <div class="container top">
      <a href="<?php bloginfo( 'url' ); ?>">
        <?php if( is_front_page() ) : ?>
          <h1 class="logo pull-xs-left"><?php bloginfo( 'title' ); ?></h1>
        <?php else : ?>
          <p class="logo pull-xs-left"><?php bloginfo( 'title' ); ?></p>
        <?php endif; ?>
      </a>
      <button class="open_button">☰</button>
      <form class="form-inline hidden-sm-down pull-xs-right" method="get" action="<?php echo home_url( '/' ); ?>">
        <div class="form-group">
          <input type="text" class="form-control" value name="s" placeholder="検索...">
          <input type="submit" class="btn btn-default" value="検索">
        </div>
      </form>
    </div>
    <nav class="open_nav">
    <?php
      $args = array(
        'container'       => false,
        'items_wrap'      => '<ul class="container">%3$s</ul>',
      );
      wp_nav_menu( $args );
    ?>
    </nav>
  </header>
  <div class="container img_main"><img class="img-fluid" src="<?php bloginfo( 'template_url' ); ?>/img/main.jpg" alt="" ></div>
  <?php if( function_exists( 'bcn_display' ) && !is_front_page() ) : ?>
    <div class="container bread_crumb">
      <?php bcn_display(); ?>
    </div>
  <?php endif; ?>
