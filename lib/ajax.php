<?php

/* javascript内でajax_urlでajaxのpathを使えるようにする */
function add_my_ajax_url()
{
  $url = admin_url( 'admin-ajax.php' );
  $html = <<< EOM
  <script>
    var ajax_url = "{$url}";
  </script>
EOM;

  echo $html;
}

add_action( 'wp_head', 'add_my_ajax_url', 1 );

function search_count()
{
  // var_dump( $_GET['param'] );
  $where = make_sql_where( $_GET['param'] );
  $sql = "SELECT count(m.id) AS c FROM plans AS p JOIN mvnos AS m ON m.id = p.mvno_id
          WHERE 1" . $where;
  // echo $sql;

  $m = new Mvno();
  $result = $m->get_data_by_sql( $sql );
  echo $result[0]['c'];

  die();
}
function make_sql_where( $serialize )
{
  // search.php(submit)も取得できるので、ここでlogとり
  $ip = '';
  if( isset( $_SERVER['REMOTE_ADDR'] ) ){ $ip = $_SERVER['REMOTE_ADDR']; }
  if( isset( $_SERVER['HTTP_X_REAL_IP'] ) ){ $ip = $_SERVER['HTTP_X_REAL_IP']; }  // for nginx cache
  $log_str = $_SERVER['REQUEST_TIME'] . ',' . $ip . ',' . $serialize;

  error_log( $log_str. "\n", 3, '/var/www/sim/wp-content/themes/sim2/log/ajax.log' );

  parse_str($serialize, $params); 
  $where = '';
  if( isset( $params['sim_type'] ) ){
    $arr1 = array();
    foreach( $params['sim_type'] as $sim_type ){
      if( $sim_type == 1 ){ $arr1[] = ' sim_data  = 1'; }
      if( $sim_type == 2 ){ $arr1[] = ' sim_sms   = 1'; }
      if( $sim_type == 3 ){ $arr1[] = ' sim_voice = 1'; }
    }
    $where .= ' AND (' . implode( ' OR ', $arr1 ) . ') ';
  }
  if( !empty( $params['sim_size_min'] ) ){ $where .= ' AND data_size >= ' . $params["sim_size_min"]; }
  if( !empty( $params['sim_size_max'] ) ){ $where .= ' AND data_size <= ' . $params["sim_size_max"]; }
  if( !empty( $params['sim_cost_min'] ) ){ $where .= ' AND      cost >= ' . $params["sim_cost_min"]; }
  if( !empty( $params['sim_cost_max'] ) ){ $where .= ' AND      cost <= ' . $params["sim_cost_max"]; }
  if( isset( $params['sim_mvno'] ) ){
    $arr2 = array();
    foreach( $params['sim_mvno'] as $sim_mvno ){
      if( $sim_mvno == 1 ){ $arr2[] = ' m.shortname = "ocn"'     ; }
      if( $sim_mvno == 2 ){ $arr2[] = ' m.shortname = "iijmio"'  ; }
      if( $sim_mvno == 3 ){ $arr2[] = ' m.shortname = "dmm"'     ; }
      if( $sim_mvno == 4 ){ $arr2[] = ' m.shortname = "u-mobile"'; }
      if( $sim_mvno == 5 ){ $arr2[] = ' m.shortname = "rakuten"' ; }
      if( $sim_mvno == 6 ){ $arr2[] = ' m.shortname = "biglobe"' ; }
      if( $sim_mvno == 7 ){ $arr2[] = ' m.shortname = "mineo"'   ; }
      if( $sim_mvno == 8 ){ $arr2[] = ' m.shortname = "nifmo"'   ; }
    }
    $where .= ' AND (' . implode( ' OR ', $arr2 ) . ') ';
  }
  if( isset( $params['sim_option'] ) ){
    foreach( $params['sim_option'] as $sim_option ){
      if( $sim_option == 1 ){ $where .= ' AND p.is_beginner       = 1'; }
      if( $sim_option == 2 ){ $where .= ' AND p.is_voice_discount = 1'; }
      if( $sim_option == 3 ){ $where .= ' AND p.is_same_day_home  = 1'; }
      if( $sim_option == 4 ){ $where .= ' AND p.is_carry_over     = 1'; }
      if( $sim_option == 5 ){ $where .= ' AND p.is_onoff          = 1'; }
      if( $sim_option == 6 ){ $where .= ' AND p.is_no_limit       = 1'; }
      if( $sim_option == 7 ){ $where .= ' AND p.is_share          = 1'; }
      if( $sim_option == 8 ){ $where .= ' AND p.is_wifi           = 1'; }
      if( $sim_option == 9 ){ $where .= ' AND p.is_free           = 1'; }
      if( $sim_option == 10){ $where .= ' AND p.is_point          = 1'; }
      if( $sim_option == 11){ $where .= ' AND p.is_docomo         = 1'; }
      if( $sim_option == 12){ $where .= ' AND p.is_au             = 1'; }
    }
  }

  return $where;
}

add_action( 'wp_ajax_search_count', 'search_count' );         // ログインユーザー用
add_action( 'wp_ajax_nopriv_search_count', 'search_count' );  // 非ログインユーザー用
