<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

// my library
// require_once dirname( __FILE__ ) . '/lib/mvnodb.php';       // mvno関連のデータベース操作
require_once dirname( __FILE__ ) . '/lib/db.php';       // mvno関連のデータベース操作
require_once dirname( __FILE__ ) . '/lib/shortcode.php';    // shortcode集
// require_once dirname( __FILE__ ) . '/lib/mobile.php';       // mobile関連のデータベース操作

// wp_nav_menu remove id, class
add_filter( 'nav_menu_css_class', 'remove_class', 100, 2 );
add_filter( 'nav_menu_item_id',   'remove_id', 10 );
function remove_class( $classes, $item ){
  return $item->current == true ? array( $classes[0], 'current' ) : array( $classes[0] );
}
function remove_id( $id ){ return $id = array(); }

/*
 * previous_next
 */
function previous_next(){
  $prev = get_adjacent_post( true, '', true );
  $next = get_adjacent_post( true, '', false );
  $html = '';
  if( $prev ){
    $title     = get_the_title( $prev->ID );
    $permalink = get_permalink( $prev->ID );
    $datetime  = get_the_time( 'Y-m-d', $prev->ID );
    $thumbnail = get_the_post_thumbnail( $prev->ID, 'thumbnail' );
    $html .= '<div class="previous">';
    $html .= '<a href="' . $permalink . '"><p><i class="fa fa-chevron-left" aria-hidden="true"></i>前の記事</p></a>';
    // $html .= make_topic( 'prev', $title, $permalink, $datetime, $thumbnail );
    $html .= make_topic( '', $title, $permalink, $datetime, $thumbnail );
    $html .= '</div>';
  }
  if( $next ){
    $title     = get_the_title( $next->ID );
    $permalink = get_permalink( $next->ID );
    $datetime  = get_the_time( 'Y-m-d', $next->ID );
    $thumbnail = get_the_post_thumbnail( $next->ID, 'thumbnail' );
    $html .= '<div class="next">';
    $html .= '<a href="' . $permalink . '"><p>次の記事<i class="fa fa-chevron-right" aria-hidden="true"></i></p></a>';
    // $html .= make_topic( 'next', $title, $permalink, $datetime, $thumbnail );
    $html .= make_topic( '', $title, $permalink, $datetime, $thumbnail );
    $html .= '</div>';
  }
  echo $html;
}
/*
 * relation
 */
function relation( $post ){
  $categories = wp_get_post_categories( $post->ID, array( 'orderby' => 'rand' ) );
  if( $categories ){
    $args = array(
      'category__in' => array( $categories[0] ),
      'post__not_in' => array( $post->ID ),
      'showposts'    => 4,
      // 'caller_get_posts' => 1,
      'ignore_sticky_posts' => 1,
      'orderby'      => 'rand',
    );
    $my_query = new WP_Query( $args );
    if( $my_query->have_posts() ){
      $html = '';
      while( $my_query->have_posts() ){
        $my_query->the_post();
        $title     = get_the_title();
        $permalink = get_the_permalink();
        $datetime  = get_the_time( 'Y-m-d' );
        $thumbnail = get_the_post_thumbnail( $my_query->ID, 'thumbnail' );
        $html .= make_topic( '', $title, $permalink, $datetime, $thumbnail );
      }
    }
  }

  wp_reset_postdata();
  echo $html;
}
/*
 * sidebar
 */
function sidebar_pickup( $category_name, $number = 5 ){
  $args = array(
    'category_name'  => $category_name,
    'posts_per_page' => $number
  );
  $my_query = new WP_Query( $args );
  $html = '';
  if( $my_query->have_posts() ){
    while( $my_query->have_posts() ){
      $my_query->the_post();
      $title     = get_the_title();
      $permalink = get_the_permalink();
      $datetime  = get_the_time( 'Y-m-d' );
      $thumbnail = get_the_post_thumbnail( $my_query->ID, 'thumbnail' );
      // $thumbnail = get_the_post_thumbnail( $my_query->ID, 'thumbnail', array( 'class' => 'img-fluid' ) );
      $html .= make_topic( '', $title, $permalink, $datetime, $thumbnail );
    }
  }
  wp_reset_postdata();
  echo $html;
}

function make_topic( $class, $title, $permalink, $datetime, $thumbnail ){
  $html = <<< EOM
  <article class="topic {$class}">
    <a href="{$permalink}">
      <div class="topic_img">
        {$thumbnail}
      </div>
      <div class="topic_text">
        <h3 class="topic_text__title">{$title}</h3>
        <time class="topic_text__date" datetime="{$datetime}"><i class="fa fa-clock-o" aria-hidden="true"></i>{$datetime}</time>
      </div>
    </a>
  </article>
EOM;

  return $html;
}
