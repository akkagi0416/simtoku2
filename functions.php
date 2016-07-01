<?php

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

// my library
// require_once dirname( __FILE__ ) . '/lib/mvnodb.php';       // mvno関連のデータベース操作
require_once dirname( __FILE__ ) . '/lib/db.php';       // mvno関連のデータベース操作
require_once dirname( __FILE__ ) . '/lib/shortcode.php';    // shortcode集
// require_once dirname( __FILE__ ) . '/lib/mobile.php';       // mobile関連のデータベース操作
require_once dirname( __FILE__ ) . '/lib/ajax.php';    // ajax for wordpress

// wp_nav_menu remove id, class
add_filter( 'nav_menu_css_class', 'remove_class', 100, 2 );
add_filter( 'nav_menu_item_id',   'remove_id', 10 );
function remove_class( $classes, $item ){
  return $item->current == true ? array( $classes[0], 'current' ) : array( $classes[0] );
}
function remove_id( $id ){ return $id = array(); }

/* 投稿画面のタイトルに文字カウンター */
function excerpt_count_js(){
  echo '<script>jQuery(document).ready(function(){
    jQuery("#titlewrap").after("<div style=\"position:absolute;top:5px;right:5px;color:#666;\"><small>文字数: </small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"title_counter\" readonly=\"\" style=\"background:#fff;\"></div>");
    jQuery("#title_counter").val(jQuery("#title").val().length);
    jQuery("#title").keyup( function() {
      jQuery("#title_counter").val(jQuery("#title").val().length);
    });
  });</script>';
}
add_action( 'admin_head-post.php', 'excerpt_count_js');
add_action( 'admin_head-post-new.php', 'excerpt_count_js');

/*
 * sns button
 */
function sns_button(){
/* 参考 http://news.7zz.jp/css/4598.html */
?>
  <ul class="sns_button">
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_twitter')) echo get_scc_twitter(); ?></span><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo get_the_title(); ?>&via=akkagi0416" target="_blank"><span class="sns_button__icon sns_button__icon_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_facebook')) echo get_scc_facebook(); ?></span><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_hatebu')) echo get_scc_hatebu(); ?></span><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php echo get_the_title(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_hatebu">B!</span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_gplus')) echo get_scc_gplus(); ?></span><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('scc_get_share_pocket')) echo scc_get_share_pocket(); ?></span><a href="http://getpocket.com/edit?url=<?php the_permalink(); ?>&title=<?php echo get_the_title(); ?>" onclick="window.open(this.href, 'PCwindow', 'width=550, height=350, menubar=no, toolbar=no, scrollbars=yes'); return false;"><span class="sns_button__icon sns_button__icon_pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('scc_get_follow_feedly')) echo scc_get_follow_feedly(); ?></span><a href="http://cloud.feedly.com/#subscription/feed/<?php echo rawurlencode(get_bloginfo('rss2_url')); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_feedly">feedly</span></a></li>
   <li><span class="sns_button__bal">送る</span><a href="http://line.naver.jp/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_line">LINE</span></a></li>
  </ul>
<?php
}
function sns_button_home(){
?>
  <ul class="sns_button">
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_twitter')) echo scc_get_share_twitter( array( post_id => 'home' ) ); ?></span><a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo get_the_title(); ?>&via=akkagi0416" target="_blank"><span class="sns_button__icon sns_button__icon_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_facebook')) echo scc_get_share_facebook( array( post_id => 'home' ) ) ; ?></span><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_hatebu')) echo scc_get_share_hatebu( array( post_id => 'home' ) ); ?></span><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php echo get_the_title(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_hatebu">B!</span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('get_scc_gplus')) echo scc_get_share_gplus( array( post_id => 'home' ) ); ?></span><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('scc_get_share_pocket')) echo scc_get_share_pocket( array( post_id => 'home' ) ); ?></span><a href="http://getpocket.com/edit?url=<?php the_permalink(); ?>&title=<?php echo get_the_title(); ?>" onclick="window.open(this.href, 'PCwindow', 'width=550, height=350, menubar=no, toolbar=no, scrollbars=yes'); return false;"><span class="sns_button__icon sns_button__icon_pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i></span></a></li>
   <li><span class="sns_button__bal"><?php if(function_exists('scc_get_follow_feedly')) echo scc_get_follow_feedly( array( post_id => 'home' ) ); ?></span><a href="http://cloud.feedly.com/#subscription/feed/<?php echo rawurlencode(get_bloginfo('rss2_url')); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_feedly">feedly</span></a></li>
   <li><span class="sns_button__bal">送る</span><a href="http://line.naver.jp/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="_blank"><span class="sns_button__icon sns_button__icon_line">LINE</span></a></li>
  </ul>
<?php
}

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
      echo $html;
    }
  }

  wp_reset_postdata();
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
