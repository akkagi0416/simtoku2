<?php get_header(); ?>
  <main>
    <h1>search</h1>
    <?php echo do_shortcode( '[mvno_search]' ); ?>
    <?php
      if( isset( $_GET['submit'] ) ){
        // 検索ボタンを押されてこのページへ来た処理
        $url = $_SERVER['REQUEST_URI'];
        $query = parse_url( $url, PHP_URL_QUERY );
        echo "<p>{$query}</p>";
        
        $where = make_sql_where( $query );
        $sql = "SELECT count(m.id) AS c FROM plans AS p JOIN mvnos AS m ON m.id = p.mvno_id WHERE 1" . $where;
        echo '<script>console.log("' . $sql . '");</script>';

        // $m = new Mvno();
        // $result = $m->get_data_by_sql( $sql );
        // echo $result[0]['c'];
      }
    ?>
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
