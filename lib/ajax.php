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
      if( $sim_option == 'is_beginner'       ){ $where .= ' AND p.is_beginner       = 1'; }
      if( $sim_option == 'is_voice_discount' ){ $where .= ' AND p.is_voice_discount = 1'; }
      if( $sim_option == 'is_same_day_home'  ){ $where .= ' AND p.is_same_day_home  = 1'; }
      if( $sim_option == 'is_carry_over'     ){ $where .= ' AND p.is_carry_over     = 1'; }
      if( $sim_option == 'is_onoff'          ){ $where .= ' AND p.is_onoff          = 1'; }
      if( $sim_option == 'is_wifi'           ){ $where .= ' AND p.is_wifi           = 1'; }
      if( $sim_option == 'is_free'           ){ $where .= ' AND p.is_free           = 1'; }
      if( $sim_option == 'is_point'          ){ $where .= ' AND p.is_point          = 1'; }
    }
  }

  return $where;
}

add_action( 'wp_ajax_search_count', 'search_count' );         // ログインユーザー用
add_action( 'wp_ajax_nopriv_view_sitename', 'view_sitename' );  // 非ログインユーザー用
