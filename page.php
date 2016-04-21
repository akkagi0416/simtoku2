<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <article class="page <?php if( $post->post_name == 'faq' ){ echo 'page_faq'; }?>">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
