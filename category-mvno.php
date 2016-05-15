<?php get_header(); ?>
  <main>
    <section>
      <h1 class="category_title"><?php $cat_info = get_category( $cat ); echo esc_html( $cat_info->name ); ?></h1>
      <div class="mvno_cards">
        <?php if( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
          <?php echo do_shortcode("[mvno_card shortname='" . get_page_uri( get_the_ID() ) . "']"); ?>
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
            'total' => $wp_query->max_num_pages,
            'prev_next' => true,
            // 'prev_text' => __('«'),
            // 'next_text' => __('»'),
            'prev_text' => __('<i class="fa fa-angle-double-left" aria-hidden="true"></i>'),
            'next_text' => __('<i class="fa fa-angle-double-right" aria-hidden="true"></i>'),
            // 'prev_text' => __('&laquo;'),
            // 'next_text' => __('&raquo;'),
          ) );
        ?>
      </div>
    </section>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
