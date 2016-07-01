<?php
/*
Template Name: 固定ページのテンプレートテスト
*/
?>
<?php get_header(); ?>
  <main>
    <section>
      <h1 class="category_title">新着記事の一覧</h1>
      <div class="topics">
        <?php
          $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

          $args = array(
            'posts_per_page' => 12,
            'paged'          => $paged,
          );

          $aiu_query = new WP_Query( $args );
        ?>
        <?php if( $aiu_query->have_posts() ) : ?>
          <?php while( $aiu_query->have_posts() ) : $aiu_query->the_post(); ?>
            <?php
              $title     = get_the_title();
              $permalink = get_the_permalink();
              $datetime  = get_the_time( 'Y-m-d' );
              $thumbnail = get_the_post_thumbnail( $post->ID, 'thumbnail' );
              echo make_topic( '', $title, $permalink, $datetime, $thumbnail );
            ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="pagination">
        <?php
          global $wp_query;
          $big = 999999999; // need an unlikely integer
          echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            // 'total' => $wp_query->max_num_pages,
            'total' => $aiu_query->max_num_pages,
            'prev_next' => true,
            'prev_text' => __('<i class="fa fa-angle-double-left" aria-hidden="true"></i>'),
            'next_text' => __('<i class="fa fa-angle-double-right" aria-hidden="true"></i>'),
          ) );
        ?>
      </div>
    </section>
    
    <?php sns_button(); ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
