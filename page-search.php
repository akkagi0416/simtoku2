<?php get_header(); ?>
  <main>
    <article class="page">
      <h1 class="title"><?php the_title(); ?></h1>

      <?php echo do_shortcode( '[mvno_search]' ); ?>
      <?php
        if( isset( $_GET['submit'] ) ){
          // 検索ボタンを押されてこのページへ来た処理
          $url = $_SERVER['REQUEST_URI'];
          $query = parse_url( $url, PHP_URL_QUERY );
          // echo "<p>{$query}</p>";
          
          $where = make_sql_where( $query );
          $sql = "SELECT m.afi_txt, m.mvno, p.* FROM plans AS p JOIN mvnos AS m ON m.id = p.mvno_id WHERE 1" . $where;
          // echo '<script>console.log("' . $sql . '");</script>';

          $m = new Mvno();
          $result = $m->get_data_by_sql( $sql );
          $html = <<<EOM
            <h3>検索結果の一覧</h3>
            <div class="scroll_div" >
              <table _fixedhead="rows:1; cols:2;" class="not_responsive">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>格安SIM</th>
                    <th>プラン名</th>
                    <th>回線</th>
                    <th>データSIM</th>
                    <th>SMS付SIM</th>
                    <th>通話SIM</th>
                    <th>料金(円)</th>
                    <th>データ容量(GB)</th>
                    <th>通信速度(Mbps)</th>
                    <th>初心者安心</th>
                    <th>店舗販売</th>
                    <th>通話半額</th>
                    <th>自宅で即日開通</th>
                    <th>データ繰越</th>
                    <th>高速通信ON/OFF</th>
                    <th>通信制限なし</th>
                    <th>シェアプラン</th>
                    <th>WiFiスポット</th>
                    <th>使い放題</th>
                    <th>容量追加</th>
                    <th>ポイントサービス</th>
                    <th>5分かけ放題</th>
                    <th>最低契約期間(か月)</th>
                  </tr>
                </thead>
                <tbody>
EOM;
          foreach( $result as $row ){
            $html .= "<tr>";
            $img  = get_bloginfo( 'template_url' ) . '/img/logo_' . $row['shortname'] . '.jpg';
            $html .= "<th><img src='{$img}' alt='{$row['mvno']}'></th>";
            $html .= "<td>{$row['afi_txt']}</td>";
            $html .= "<td>{$row['plan_name']}</td>";
            $html .= $row['is_docomo']         == 1 ? '<td>docomo</td>' : '<td>au</td>';
            $html .= $row['sim_data']          == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['sim_sms']           == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['sim_voice']         == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= "<td>{$row['cost']}</td>";
            $html .= $row['data_size']         == 999 ? '<td>使い放題</td>' : "<td>{$row['data_size']}</td>";
            $html .= "<td>{$row['speed_max']}</td>";
            $html .= $row['is_beginner']       == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_shop']           == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_voice_discount'] == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_same_day_home']  == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_carry_over']     == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_onoff']          == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_no_limit']       == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_share']          == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_wifi']           == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_free']           == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_coupon']         == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_point']          == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= $row['is_5min']           == 1 ? '<td>o</td>' : '<td>&nbsp;</td>';
            $html .= "<td>{$row['constract_period']}</td>";
            $html .= "</tr>";
          }
          $html .= '</tbody></table></div>';
          echo $html;

          $sql = "SELECT m.shortname FROM plans AS p JOIN mvnos AS m ON m.id = p.mvno_id WHERE 1" . $where . " GROUP BY m.shortname ORDER BY p.mvno_id";
          $shortnames = $m->get_data_by_sql( $sql );
          $html  = '<h3>検索に該当した格安SIM</h3>';
          $html .= '<div class="mvno_cards">';
          foreach( $shortnames as $row ){
            $html .= do_shortcode( "[mvno_card shortname='{$row['shortname']}']" ); 
          }
          $html .= '</div>';
          echo $html;
        }
      ?>
    </article>
    <?php if( have_posts() ) : ?>
      <?php while( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php sns_button(); ?>
  </main>
  <?php get_sidebar(); ?>
  <script type="text/javascript" src="<?php echo get_bloginfo( 'template_url' ); ?>/js/fixed_midashi.js"></script>
  <script>window.onload = function(){ FixedMidashi.create(); }</script>
<?php get_footer(); ?>
