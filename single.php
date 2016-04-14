<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <article>
          <h1 class="title"><?php the_title(); ?></h1>
          <time class="postdate" datetime="<?php the_time('Y-m-d'); ?>">投稿日: <?php the_time('Y-m-d'); ?></time>
          <?php the_content(); ?>
        </article>
        <ul class="pager">
          <li class="previous"><?php previous_post_link( '%link', ' <i class="fa fa-arrow-left"></i> 前の記事', TRUE ); ?></li>
          <li class="next"    ><?php next_post_link( '%link', '次の記事  <i class="fa fa-arrow-right"></i>', TRUE ); ?></li>
        </ul>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
