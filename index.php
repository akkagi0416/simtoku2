<?php get_header(); ?>
  <main class="col-md-8">
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
