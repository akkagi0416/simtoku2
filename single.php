<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <article class="single">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php if( get_the_modified_date('Y-m-d') != get_the_time('Y-m-d') ) : ?>
            <time class="update" datetime="<?php the_modified_date('Y-m-d'); ?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i><?php the_modified_date('Y-m-d'); ?></time>
          <?php endif; ?>
          <time class="postdate" datetime="<?php the_time('Y-m-d'); ?>"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i><?php the_time('Y-m-d'); ?></time>
          <?php the_content(); ?>
        </article>
        <?php sns_button(); ?>
        <section class="relation">
          <h2>関連記事</h2>
          <?php relation( $post ); ?>
          <p class="to_category"><a href="<?php $category = get_the_category(); echo home_url( '/category/' ) . $category[0]->slug . '/'; ?>"><i class="fa fa-arrow-right"></i>他の関連記事</a></p>
        </section>
      <?php endwhile; ?>
    <?php endif; ?>

  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
