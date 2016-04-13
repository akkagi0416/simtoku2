<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

// wp_nav_menu remove id, class
add_filter( 'nav_menu_css_class', 'remove_class', 100, 2 );
add_filter( 'nav_menu_item_id',   'remove_id', 10 );
function remove_class( $classes, $item ){
  return $item->current == true ? array( $classes[0], 'current' ) : array( $classes[0] );
}
function remove_id( $id ){ return $id = array(); }

//
// sidebar
//
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
      $datetime  = get_the_time('Y-m-d');
      $thumbnail = get_the_post_thumbnail( $my_query->ID, 'thumbnail', array( 'class' => 'img-fluid' ) );
      $html .= <<< EOM
      <article class="topic">
        <a href="{$permalink}">
          <div class="topic_img">
            {$thumbnail}
          </div>
          <div class="topic_text">
            <h3 class="topic_text__title">{$title}</h3>
            <time class="topic_text__date" datetime="{$datetime}">{$datetime}</time>
          </div>
        </a>
      </article>
EOM;
    }
  }
  wp_reset_postdata();
  return $html;
}
