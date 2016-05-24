<?php get_header(); ?>
  <main>
    <article class="page">
      <h1>search</h1>
      <?php echo do_shortcode( '[mvno_search]' ); ?>
      <?php
        if( isset( $_GET['submit'] ) ){
          // 検索ボタンを押されてこのページへ来た処理
          $url = $_SERVER['REQUEST_URI'];
          $query = parse_url( $url, PHP_URL_QUERY );
          // echo "<p>{$query}</p>";
          
          $where = make_sql_where( $query );
          $sql = "SELECT * FROM plans AS p JOIN mvnos AS m ON m.id = p.mvno_id WHERE 1" . $where;
          echo '<script>console.log("' . $sql . '");</script>';

          $m = new Mvno();
          $result = $m->get_data_by_sql( $sql );
          $html = <<<EOM
            <table>
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>格安SIM</th>
                  <th>プラン名</th>
                  <th>データSIM</th>
                  <th>SMS付SIM</th>
                  <th>通話SIM</th>
                  <th>料金(円)</th>
                  <th>データ容量(GB)</th>
                  <th>通信速度(Mbps)</th>
                </tr>
              </thead>
              <tbody>
EOM;
          foreach( $result as $row ){
            $html .= "<tr>";
            $img  = get_bloginfo( 'template_url' ) . '/img/logo_' . $row['shortname'] . '.jpg';
            $html .= "<th><img src='{$img}' alt='{$row['mvno']}'></th>";
            $html .= "<td>{$row['mvno']}</td>";
            $html .= "<td>{$row['plan_name']}</td>";
            $html .= "<td>{$row['sim_data']}</td>";
            $html .= "<td>{$row['sim_sms']}</td>";
            $html .= "<td>{$row['sim_voice']}</td>";
            $html .= "<td>{$row['cost']}</td>";
            $html .= "<td>{$row['data_size']}</td>";
            $html .= "<td>{$row['speed_max']}</td>";
            $html .= "</tr>";
          }
          $html .= '</tbody></table>';
          // echo $result[0]['c'];
          echo $html;
        }
      ?>
    </article>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
