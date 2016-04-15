<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <article>
          <h1 class="title"><?php the_title(); ?></h1>
          <time class="postdate" datetime="<?php the_time('Y-m-d'); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_time('Y-m-d'); ?></time>
          <?php the_content(); ?>
        </article>
        <div class="previous_next">
          <?php previous_next(); ?>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
