<aside>
  <section class="ranking">
    <h2>人気ランキング</h2>
    <?php
      $mvnos = array(
        'rakuten' => '楽天モバイル',
        'ocn'     => 'OCN モバイル ONE',
        'iijmio'  => 'IIJmio',
        'mineo'   => 'mineo',
        'dmm'     => 'DMM mobile'
      );
      $html = '';
      $count = 1;
      foreach( $mvnos as $mvno => $value ){
        $img   = get_bloginfo( 'template_url' ) . '/img/logo_' . $mvno . '.jpg';
        $href  = get_bloginfo( 'url' ) . '/' . $mvno . '/';
        $html .= <<< EOM
        <div class="ranking_box">
          <a href="{$href}">
            <!--
            <p class="ranking_box__ranking">{$count}位</p>
            -->
            <div class="ranking_box__img">
              <img src="{$img}" alt="{$value}">
            </div>
            <div class="ranking_box__text">
              <h3 class="ranking_box__title">{$value}</h3>
            </div>
          </a>
        </div>
EOM;
        $count += 1;
      }
      echo $html;
    ?>
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
