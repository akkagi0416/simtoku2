<?php
/*
 * shortcodeがある関数は末尾に_func
 */
function mvno_txt_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );

  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );
  $html = "<span class='mvno_txt'>{$mvno['afi_txt']}</span>";

  return $html;
}

function mvno_img_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );
  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );
  $html = "<p class='mvno_img'>{$mvno['afi_img']}</p>";

  return $html;
}
function mvno_s_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );
  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );

  $html  = '<section class="mvno_s">';
  $html .= '<h2 class="mvno_title">' . $mvno['mvno'] . '</h2>';
  $html .= mvno_header( $mvno );
  $html .= mvno_function( $mvno );
  $html .= mvno_feature( $mvno );
  $html .= mvno_graph( $mvno );
  $html .= mvno_review( $shortname );
  $html .= mvno_button( $mvno );
  $html .= '</section>';

  return $html;
}
function mvno_top_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );
  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );

  $html  = '<h2 class="mvno_title">' . $mvno['mvno'] . '</h2>';
  $html .= mvno_header( $mvno );
  $html .= mvno_function( $mvno );
  $html .= mvno_feature( $mvno );
  $html .= mvno_button2( $mvno );

  return $html;
}
function mvno_say_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );
  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );

  $html  = mvno_graph( $mvno );
  $html .= '<div class="reviews">';
  $html .= mvno_review( $shortname, 100 );  // すべてのレビュー(100ならすべて取れる前提)
  $html .= '<button class="reviews_open">他の『' . $mvno['mvno'] . '』のレビューを見る/閉じる</button>';
  $html .= '</div>';

  return $html;
}
function mvno_header( $mvno )
{
  $html = <<<EOM
  <div class="mvno_header">
    <div class="mvno_header__img">
      {$mvno['afi_img']}
    </div>
    <div class="mvno_header__text">
      <p class="mvno_header__catch">{$mvno['catch_copy']}</p>
      <table class="mvno_header__spec">
        <tr>
          <th>月額料金</th>
          <td>
            <p class="mvno_header__spec_type"><span>データSIM</span>{$mvno['cost_data']}円～</p>
            <p class="mvno_header__spec_type"><span>通話SIM</span>{$mvno['cost_voice']}円～</p>
          </td>
        </tr>
        <tr><th>データ容量</th><td>{$mvno['data_type']}</td></tr>
        <tr><th>回線</th><td>{$mvno['line']}</td></tr>
      </table>
    </div>
  </div>
EOM;

  return $html;
}
function mvno_function( $mvno )
{
  $html = '<ul class="mvno_function">';
  $class = $mvno['is_beginner']       == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">初心者<br>安心</li>";
  $class = $mvno['is_shop']           == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">店舗販売</li>";
  $class = $mvno['is_voice_discount'] == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">通話半額</li>";
  $class = $mvno['is_same_day_home']  == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">自宅で<br>即日開通</li>";
  $class = $mvno['is_carry_over']     == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">データ<br>繰り越し</li>";
  $class = $mvno['is_onoff']          == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">高速通信<br>ON/OFF</li>";
  $class = $mvno['is_no_limit']       == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">通信制限<br>なし</li>";
  $class = $mvno['is_share']          == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">シェア<br>プラン</li>";
  $class = $mvno['is_wifi']           == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">WiFi<br>スポット</li>";
  $class = $mvno['is_free']           == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">使い放題</li>";
  $class = $mvno['is_coupon']         == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">容量追加</li>";
  $class = $mvno['is_point']          == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">ポイント</li>";
  $html .= '</ul>';

  return $html;
}
function mvno_feature( $mvno )
{
  $html = <<<EOM
  <div class="mvno_feature">
    <h3 class="mvno_feature__point">{$mvno['mvno']}のここがおすすめポイント</h3>
    <ul>
      <li>{$mvno['feature1']}</li>
      <li>{$mvno['feature2']}</li>
      <li>{$mvno['feature3']}</li>
    </ul>
  </div>
EOM;

  return $html;
}
function mvno_graph( $mvno )
{
  $integer_part = floor( $mvno['average'] );
  $round_part   = $mvno['average'] - $integer_part;
  $stars = '';
  for( $i = 0; $i < $integer_part; $i++ ){
    $stars .= '<i class="fa fa-star" aria-hidden="true"></i>';
  }
  if( $round_part > 0.66 ){
    $stars .= '<i class="fa fa-star" aria-hidden="true"></i>';
  }elseif( $round_part > 0.33 ){
    $stars .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
  }else{
    $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
  }
  for( $i = 0; $i < 5 - $integer_part - 1; $i++ ){
    $stars .= '<i class="fa fa-star-o-" aria-hidden="true"></i>';
  }
  $html = <<<EOM
  <div class="mvno_graph">
    <h3 class="mvno_graph__title">{$mvno['mvno']}のユーザー評価やレビュー</h3>
    <div class="mvno_graph__box">
      <canvas id="mvno_graph__{$mvno['shortname']}" width="256px" height="256px"></canvas>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script>
      <script>
        var data = {
          labels: ["料金", "通信", "通話", "サポート", "満足度" ],
          datasets: [
            {
              label:                "{$mvno['mvno']}",
              fillColor:            "rgba(51, 122, 183, 0.2)",
              strokeColor:          "rgba(51, 122, 183, 1.0)",
              pointColor:           "rgba(51, 122, 183, 1.0)",
              pointStrokeColor:     "#fff",
              pointHighlightFill:   "rgba(51, 122, 183, 1.0)",
              pointHighlightStroke: "rgba(51, 122, 183, 1.0)",
              data: [ {$mvno['q1']}, {$mvno['q2']},{$mvno['q3']},{$mvno['q4']},{$mvno['q5']}]
            },
          ]
        };
        var option = {
          scaleShowLabels: true,
          scaleOverride: true,
          scaleSteps: 5,
          scaleStepWidth: 1,
          scaleStartValue: 0,
          pointLabelFontSize: 16,
          angleLineColor: "rgba(0, 0, 0, 0.2)",
          scaleLineColor: "rgba(0, 0, 0, 0.2)"
        };
        var ctx = document.getElementById('mvno_graph__{$mvno['shortname']}').getContext('2d');
        var myRadar = new Chart(ctx).Radar(data, option);
      </script>
      <div class="mvno_graph__total_box">
        <div class="mvno_graph__total">
          <span class="mvno_graph__total_text">総合評価</span>
          <span class="mvno_graph__total_value">{$mvno['average']}</span>
          <span class="mvno_graph__total_stars">{$stars}</span>
        </div>
        <div class="mvno_graph__scores">
          <p class="score"><i class="fa fa-jpy fa-fw" aria-hidden="true"></i><span class="score__text">料金</span><span class="score__value">{$mvno['q1']}</span></p>
          <p class="score"><i class="fa fa-wifi fa-fw" aria-hidden="true"></i><span class="score__text">通信</span><span class="score__value">{$mvno['q2']}</span></p>
          <p class="score"><i class="fa fa-phone fa-fw" aria-hidden="true"></i><span class="score__text">通話</span><span class="score__value">{$mvno['q3']}</span></p>
          <p class="score"><i class="fa fa-heart-o fa-fw" aria-hidden="true"></i><span class="score__text">サポート</span><span class="score__value">{$mvno['q4']}</span></p>
          <p class="score"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="score__text">満足度</span><span class="score__value">{$mvno['q5']}</span></p>
        </div>
      </div>
    </div><!-- //.mvno_graph__box -->
  </div>
EOM;

  return $html;
}
function mvno_review( $shortname, $count = 2 )
{
  $m = new Mvno();
  $reviews = $m->get_review( $shortname, $count );

  $html = '';
  foreach( $reviews as $review ){
    $sex = $review['sex'];
    $age = $review['age'];
    $class = $sex == 1 ? 'man' : 'woman';
    $href = get_bloginfo( 'url' ) . '/' . $shortname . '/';
    if( $shortname == 'all' ){
      if( $review['mvno_id'] != '' ){
        $href = get_bloginfo( 'url' ) . '/' . $review['shortname'] . '/';
        $mvno = "<a href='$href'><span class='review_mvno'>" . $review['sim_text'] . "</span></a>";
      }else{
        $mvno = "<span class='review_mvno'>" . $review['sim_text'] . "</span>";
      }
    }else{
      $mvno = "<a href='$href'><span class='review_mvno'>" . $review['sim_text'] . "</span></a>";
    }
    if( $sex == 1 && $age <  5 ){ $img = '<img src="' . get_bloginfo( 'template_url' ) . '/img/man_01.png" alt="男性">'; }
    if( $sex == 1 && $age >= 5 ){ $img = '<img src="' . get_bloginfo( 'template_url' ) . '/img/man_02.png" alt="男性">'; }
    if( $sex == 2 && $age <  5 ){ $img = '<img src="' . get_bloginfo( 'template_url' ) . '/img/woman_01.png" alt="女性">'; }
    if( $sex == 2 && $age >= 5 ){ $img = '<img src="' . get_bloginfo( 'template_url' ) . '/img/woman_02.png" alt="女性">'; }
    $question_3 = $review['question3'] == 6 ? '-' : $review['question3'];
    $html .= <<<EOM
    <article class="review {$class}">
      <div class="review_header">
        <div class="review_header__img">{$img}</div>
        <div class="review_header__text">
          <h3 class="review_title">
            {$mvno}
            <span class="sex">{$review['sex_text']}</span>
            <span class="age">{$review['age']}0代</span>
          </h3>
          <div class="review_header__score">
            <p class="score"><i class="fa fa-jpy fa-fw" aria-hidden="true"></i><span class="score__text">料金</span><span class="score__value">{$review['question1']}</span></p>
            <p class="score"><i class="fa fa-wifi fa-fw" aria-hidden="true"></i><span class="score__text">通信</span><span class="score__value">{$review['question2']}</span></p>
            <p class="score"><i class="fa fa-phone fa-fw" aria-hidden="true"></i><span class="score__text">通話</span><span class="score__value">{$question_3}</span></p>
            <p class="score"><i class="fa fa-heart-o fa-fw" aria-hidden="true"></i><span class="score__text">サポート</span><span class="score__value">{$review['question4']}</span></p>
            <p class="score"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="score__text">満足度</span><span class="score__value">{$review['question5']}</span></p>
          </div>
        </div>
      </div>
      <p class="review_comment">
        {$review['comment']}
      </p>
    </article>
EOM;
  }
  return $html;
}
function mvno_button( $mvno )
{
  // detail & official button
  $href = get_bloginfo( 'url' ) . '/' . $mvno['shortname'];
  $html = <<<EOM
  <div class="mvno_button">
    <button class="mvno_button__detail"><a href="{$href}">プラン・詳細ページ</a></button>
    <button class="mvno_button__official">{$mvno['afi_txt']}</button>
  </div>
EOM;

  return $html;
}
function mvno_button2( $mvno )
{
  // only official button
  $href = get_bloginfo( 'url' ) . '/' . $mvno['shortname'];
  $html = <<<EOM
  <div class="mvno_button">
    <button class="mvno_button__official">{$mvno['afi_txt']}</button>
  </div>
EOM;

  return $html;
}

function mvno_card_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );

  $m = new Mvno();
  $mvno = $m->get_mvno( $shortname );
  $img  = get_bloginfo( 'template_url' ) . '/img/logo_' . $mvno['shortname'] . '.jpg';
  $href = get_bloginfo( 'url' ) . '/' . $mvno['shortname'];
  $integer_part = floor( $mvno['average'] );
  $round_part   = $mvno['average'] - $integer_part;
  $stars = '';
  for( $i = 0; $i < $integer_part; $i++ ){
    $stars .= '<i class="fa fa-star" aria-hidden="true"></i>';
  }
  if( $round_part > 0.66 ){
    $stars .= '<i class="fa fa-star" aria-hidden="true"></i>';
  }elseif( $round_part > 0.33 ){
    $stars .= '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
  }else{
    $stars .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
  }
  for( $i = 0; $i < 5 - $integer_part - 1; $i++ ){
    $stars .= '<i class="fa fa-star-o-" aria-hidden="true"></i>';
  }
  $html = <<<EOM
  <article class="mvno_card">
    <h3 class="mvno_card__title">{$mvno['mvno']}</h3>
    <div class="mvno_card__img">
      <a href="{$href}">
        <img src="{$img}" alt="{$mvno['mvno']}">
      </a>
    </div>
    <p class="mvno_card__catch">{$mvno['catch_copy']}</p>
    <ul class="mvno_card__feature">
      <li class="mvno_card__list"><i class="fa fa-jpy fa-fw" aria-hidden="true"></i><span class="mvno_card__list_text">月額</span>{$mvno['cost_min']}円～</li>
      <li class="mvno_card__list"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i><span class="mvno_card__list_text">評価</span>{$stars}</li>
    </ul>
    <div class="mvno_button">
      <button class="mvno_button__detail">
        <a href="{$href}">詳細ページ</a>
      </button>
    </div>
  </article>
EOM;

  return $html;
}

function mvno_plan_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );

  $m = new Mvno();
  $plans = $m->get_plan( $shortname );
  $mvno  = $m->get_mvno( $shortname );
  $html = <<<EOM
    <div class="mvno_plan">
      <h3 class="mvno_plan__title">{$mvno['mvno']}のプラン一覧</h3>
      <table>
        <tr>
          <th>プラン名</th>
          <th>データSIM</th>
          <th>通話SIM</th>
          <th>月額料金</th>
          <th>データ容量</th>
          <th>最大通信速度</th>
        </tr>
EOM;
  foreach( $plans as $plan ){
    if( $plan['plan_basic'] == 1 ){
      $judge_data  = $plan['sim_data']  == 1 ? 'o' : '&nbsp;';
      $judge_voice = $plan['sim_voice'] == 1 ? 'o' : '&nbsp;';
      $data_size   = $plan['data_size'] == 999 ? '使い放題' : "{$plan['data_size']}GB";
      // $constract_period = $plan['constract_period'] != null ? $plan['constract_period'] . 'か月' : '&nbsp;';
      $html .= <<<EOM
        <tr>
          <td>{$plan['plan_name']}</td>
          <td>{$judge_data}</td>
          <td>{$judge_voice}</td>
          <td>{$plan['cost']}円</td>
          <td>{$data_size}</td>
          <td>{$plan['speed_max']}Mbps</td>
        </tr>
EOM;
    }
  }
  $html .= '</table></div>';
  return $html;
}
function mvno_close_func( $atts )
{
  extract( shortcode_atts( array(
    'shortname' => 'iijmio',
  ), $atts ) );

  $m = new Mvno();
  $mvno  = $m->get_mvno( $shortname );
  $img  = get_bloginfo( 'template_url' ) . '/img/logo_' . $mvno['shortname'] . '.jpg';
  $html = <<<EOM
  <div class="mvno_close">
    <div class="mvno_close__img">
      <img src="{$img}" alt="{$mvno['mvno']}">
      <p class="mvno_close__catch">{$mvno['catch_copy']}</p>
    </div>
    <div class="mvno_close__text">
      <p>公式ページはこちら</p>
      <div class="mvno_button">
        <button class="mvno_button__official">
          {$mvno['afi_txt']}
        </button>
      </div>
    </div>
  </div>
EOM;

  return $html;
}
function mvno_reviews_func()
{
  $html = mvno_review( 'all' );

  return $html;
}

function mobile_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => 'iphone6s',
    ), $atts ) );

    $m = new Mvno();
    $mobile = $m->get_mobile( $shortname );

    $html = <<< EOM
    <section class="mobile_info">
      <h3 id="{$mobile['shortname']}">{$mobile['name']}</h3>
      <div class="row">
          <div class="col-sm-5">
              <a href="{$mobile['url']}" target="_blank"><img src="{$mobile['img']}" alt="{$mobile['name']}"></a>
          </div>
          <div class="col-sm-7">
              <h3>基本情報</h3>
              <dl>
                  <dt>価格</dt><dd>{$mobile['cost']}円(税抜)</dd>
                  <dt>メーカー</dt><dd>{$mobile['maker']}</dd>
                  <dt>OS</dt><dd>{$mobile['os']}</dd>
                  <dt>ディスプレイ</dt><dd>{$mobile['display']}</dd>
                  <dt>色</dt><dd>{$mobile['color']}</dd>
              </dl>
          </div>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed">
              <tr><td colspan="2" class="active">スペック</td></tr>
              <tr><th>CPU</th><td>{$mobile['cpu']}</td></tr>
              <tr><th>RAM</th><td>{$mobile['ram']}</td></tr>
              <tr><th>ROM</th><td>{$mobile['rom']}</td></tr>
              <tr><th>画面</th><td>{$mobile['display']} / {$mobile['resolution']}</td></tr>
              <tr><th>カメラ</th><td>{$mobile['camera']} / {$mobile['camera_sub']}</td></tr>
              <tr><th>外部メディア</th><td>{$mobile['media']}</td></tr>
              <tr><th>大きさ</th><td>{$mobile['size']}</td></tr>
              <tr><th>重さ</th><td>{$mobile['weight']}</td></tr>
              <tr><th>バッテリー</th><td>{$mobile['battery']}</td></tr>
              <tr><th>SIM</th><td>{$mobile['sim_size']}</td></tr>
          </table>
      </div>
    </section>
EOM;
    return $html;
}

function mvno_search_func()
{

  $action_url = get_bloginfo( 'url' ) . '/search';

  if( isset( $_GET['submit'] ) ){
    // 検索ボタンを押されてこのページへ来た処理
    $url = $_SERVER['REQUEST_URI'];
    $query = parse_url( $url, PHP_URL_QUERY );
    // echo "<p>{$query}</p>";
    parse_str($query, $params);
  }        

  // 未定義の時用
  if( !isset( $params['sim_type']     ) ){ $params['sim_type']     = Array(); }
  if( !isset( $params['sim_size_min'] ) ){ $params['sim_size_min'] = ''; }
  if( !isset( $params['sim_size_max'] ) ){ $params['sim_size_max'] = ''; }
  if( !isset( $params['sim_cost_min'] ) ){ $params['sim_cost_min'] = ''; }
  if( !isset( $params['sim_cost_max'] ) ){ $params['sim_cost_max'] = ''; }
  if( !isset( $params['sim_mvno']     ) ){ $params['sim_mvno']     = Array(); }
  if( !isset( $params['sim_option']   ) ){ $params['sim_option']   = Array(); }


  $sim_type_1 = in_array( 1, $params['sim_type'] ) ? 'checked' : '';
  $sim_type_2 = in_array( 2, $params['sim_type'] ) ? 'checked' : '';
  $sim_type_3 = in_array( 3, $params['sim_type'] ) ? 'checked' : '';

  $html = <<<EOM
    <section class="search">
      <h3>格安SIMの簡単検索・比較</h3>
      <p class="count"><i class="fa fa-search" aria-hidden="true"></i><span>0</span>件のプランが該当</p>
      <form action="{$action_url}" method="GET">
        <dl class="search_type">
          <dt>SIMの種類</dt>
          <dd>
            <label><input type="checkbox" name="sim_type[]" value="1" {$sim_type_1}>データSIM</label>
            <label><input type="checkbox" name="sim_type[]" value="2" {$sim_type_2}>SMS付SIM</label>
            <label><input type="checkbox" name="sim_type[]" value="3" {$sim_type_3}>通話SIM</label>
          </dd>
        </dl>
        <dl class="search_size">
          <dt>データ容量</dt>
          <dd>
            <select id="" name="sim_size_min">
EOM;
  $sim_sizes = array('', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '15', '20');
  foreach( $sim_sizes as $sim_size ){
    $selected = $params['sim_size_min'] == $sim_size ? 'selected' : '';
    $html .= "<option value='{$sim_size}' {$selected}>{$sim_size}</option>";
  }
  $html .= '</select><span class="unit">GB</span><span class="between">～</span>
            <select id="" name="sim_size_max">';
  foreach( $sim_sizes as $sim_size ){
    $selected = $params['sim_size_max'] == $sim_size ? 'selected' : '';
    $html .= "<option value='{$sim_size}' {$selected}>{$sim_size}</option>";
  }
  $html .= <<< EOM
            </select><span class="unit">GB</span>
          </dd>
        </dl>
        <dl class="search_cost">
          <dt>月額料金</dt>
          <dd>
            <select id="" name="sim_cost_min">
EOM;
  $sim_costs = array('', '500', '1000', '1500', '2000', '3000', '4000', '5000', '6000', '7000' );
  foreach( $sim_costs as $sim_cost ){
    $selected = $params['sim_cost_min'] == $sim_cost ? 'selected' : '';
    $html .= "<option value='{$sim_cost}' {$selected}>{$sim_cost}</option>";
  }
  $html .= '</select><span class="unit">円</span><span class="between">～</span>
            <select id="" name="sim_cost_max">';
  foreach( $sim_costs as $sim_cost ){
    $selected = $params['sim_cost_max'] == $sim_cost ? 'selected' : '';
    $html .= "<option value='{$sim_cost}' {$selected}>{$sim_cost}</option>";
  }
  $sim_mvno_1 = in_array( 1, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_2 = in_array( 2, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_3 = in_array( 3, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_4 = in_array( 4, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_5 = in_array( 5, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_6 = in_array( 6, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_7 = in_array( 7, $params['sim_mvno'] ) ? 'checked' : '';
  $sim_mvno_8 = in_array( 8, $params['sim_mvno'] ) ? 'checked' : '';

  $sim_option_1  = in_array(  1, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_2  = in_array(  2, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_3  = in_array(  3, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_4  = in_array(  4, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_5  = in_array(  5, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_6  = in_array(  6, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_7  = in_array(  7, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_8  = in_array(  8, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_9  = in_array(  9, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_10 = in_array( 10, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_11 = in_array( 11, $params['sim_option'] ) ? 'checked' : '';
  $sim_option_12 = in_array( 12, $params['sim_option'] ) ? 'checked' : '';

  $html .= <<< EOM
            </select><span class="unit">円</span>
          </dd>
        </dl>
        <button class="search_detail__open">検索条件を追加<i class="fa fa-chevron-down" aria-hidden="true"></i></button>
        <dl class="search_mvno">
          <dt>格安SIM</dt>
          <dd>
            <label><input type="checkbox" name="sim_mvno[]" value="1" {$sim_mvno_1}>OCN モバイル ONE</label>
            <label><input type="checkbox" name="sim_mvno[]" value="2" {$sim_mvno_2}>IIJmio</label>
            <label><input type="checkbox" name="sim_mvno[]" value="3" {$sim_mvno_3}>DMM mobile</label>
            <label><input type="checkbox" name="sim_mvno[]" value="4" {$sim_mvno_4}>U-mobile</label>
            <label><input type="checkbox" name="sim_mvno[]" value="5" {$sim_mvno_5}>楽天モバイル</label>
            <label><input type="checkbox" name="sim_mvno[]" value="6" {$sim_mvno_6}>BIGLOBE</label>
            <label><input type="checkbox" name="sim_mvno[]" value="7" {$sim_mvno_7}>mineo</label>
            <label><input type="checkbox" name="sim_mvno[]" value="8" {$sim_mvno_8}>NifMo</label>
          </dd>
        </dl>
        <dl class="search_option">
          <dt>こだわり</dt>
          <dd>
            <label><input type="checkbox" name="sim_option[]" value="1"  {$sim_option_1}>初心者向け</label>
            <label><input type="checkbox" name="sim_option[]" value="2"  {$sim_option_2}>通話半額</label>
            <label><input type="checkbox" name="sim_option[]" value="3"  {$sim_option_3}>自宅で即日開通</label>
            <label><input type="checkbox" name="sim_option[]" value="4"  {$sim_option_4}>データ繰越</label>
            <label><input type="checkbox" name="sim_option[]" value="5"  {$sim_option_5}>高速通信ON/OFF</label>
            <label><input type="checkbox" name="sim_option[]" value="6"  {$sim_option_6}>通信制限なし</label>
            <label><input type="checkbox" name="sim_option[]" value="7"  {$sim_option_7}>シェアプラン</label>
            <label><input type="checkbox" name="sim_option[]" value="8"  {$sim_option_8}>WiFiスポット</label>
            <label><input type="checkbox" name="sim_option[]" value="9"  {$sim_option_9}>使い放題</label>
            <label><input type="checkbox" name="sim_option[]" value="10" {$sim_option_10}>ポイント</label>
            <label><input type="checkbox" name="sim_option[]" value="11" {$sim_option_11}>docomo回線</label>
            <label><input type="checkbox" name="sim_option[]" value="12" {$sim_option_12}>au回線</label>
          </dd>
        </dl>
        <button class="search_detail__close">追加条件を閉じる<i class="fa fa-chevron-up" aria-hidden="true"></i></button>
        <button class="search_button" type="submit" value="1" name="submit">
          <i class="fa fa-search" aria-hidden="true"></i>検索(<span>0</span>件)<i class="fa fa-chevron-right" aria-hidden="true"></i>
        </button>
      </form>
    </section><!-- //.search -->
EOM;

  return $html;
}

function topics_new_func()
{
  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args = array(
      'posts_per_page' => 6,
      'paged' => $paged,
  );
  $my_query = new WP_Query( $args );

?>
  <section class="frontpage">
    <h2>新着記事</h2>
    <div class="topics">
      <?php if( $my_query->have_posts() ) : ?>
        <?php while( $my_query->have_posts() ) : $my_query->the_post(); ?>
          <?php
            $title     = get_the_title();
            $permalink = get_the_permalink();
            $datetime  = get_the_time( 'Y-m-d' );
            $thumbnail = get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
            // $thumbnail = get_the_post_thumbnail( $post->ID, 'thumbnail' );
            echo make_topic( '', $title, $permalink, $datetime, $thumbnail );
          ?>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <p class="to_category"><a href="<?php echo home_url( '/singles' ); ?>"><i class="fa fa-arrow-right"></i>他の新着記事一覧</a></p>
  </section>

<?php
}

add_shortcode( 'mvno_s',       'mvno_s_func' );
add_shortcode( 'mvno_top',     'mvno_top_func' );
add_shortcode( 'mvno_say',     'mvno_say_func' );
add_shortcode( 'mvno_close',   'mvno_close_func' );
add_shortcode( 'mvno_txt',     'mvno_txt_func' );
add_shortcode( 'mvno_img',     'mvno_img_func' );
add_shortcode( 'mvno_card',    'mvno_card_func' );
add_shortcode( 'mvno_plan',    'mvno_plan_func' );
add_shortcode( 'mvno_reviews', 'mvno_reviews_func' );
add_shortcode( 'mvno_search',  'mvno_search_func' );

add_shortcode( 'mobile',    'mobile_func' );

add_shortcode( 'topics_new',   'topics_new_func' );
