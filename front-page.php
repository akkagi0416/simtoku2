<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <article class="page <?php echo $class; ?>">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
    <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $args = array(
          'posts_per_page' => 6,
          'paged' => $paged,
      );
      $my_query = new WP_Query( $args );
    ?>
    <section class="frontpage">
      <h2>新着記事</h2>
      <div class="topics">
        <?php if( $my_query->have_posts() ) : ?>
          <?php while( $my_query->have_posts() ) : $my_query->the_post(); ?>
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
      <p class="to_category"><a href="<?php echo home_url( '/singles' ); ?>"><i class="fa fa-arrow-right"></i>他の新着記事一覧</a>
    </section>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
