<?php get_header(); ?>
  <main>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <?php
          if ( $post->post_name == 'faq' ){
            $class = 'page_faq';
          }else if( $post->post_name == 'about' ){
            $class = 'page_about';
          }else{
            $class = '';
          }
        ?>
        <article class="page <?php echo $class; ?>">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
