<aside>
  <section class="ranking">
    <h2>人気ランキング</h2>
  </section>
  <section class="news">
    <h2><a href="<?php echo home_url( '/category/news' ); ?>">格安SIMニュース</a></h2>
    <?php sidebar_pickup( 'news', 5 ); ?>
    <p class="to_category"><a href="<?php echo home_url( '/category/news' ); ?>"><i class="fa fa-arrow-right"></i>他のニュース一覧</a></p>
  </section>
  <section class="blog">
    <h2><a href="<?php echo home_url( '/category/blog' ); ?>">管理人のひとり言</a></h2>
    <?php sidebar_pickup( 'blog', 3 ); ?>
    <p class="to_category"><a href="<?php echo home_url( '/category/blog' ); ?>"><i class="fa fa-arrow-right"></i>他のひとり言一覧</a></p>
  </section>
</aside>
