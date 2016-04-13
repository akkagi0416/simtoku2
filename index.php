<?php get_header(); ?>
  <div class="container">
    <div class="row">
      <main class="col-md-8">
        <?php if( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </main>
      <?php get_sidebar(); ?>
    </div><!-- //.row -->
  </div><!-- //.container -->
<?php get_footer(); ?>
