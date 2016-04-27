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
  $html .= '<h3 class="mvno_title">' . $mvno['mvno'] . '</h3>';
  $html .= mvno_header( $mvno );
  $html .= mvno_function( $mvno );
  $html .= mvno_feature( $mvno );
  $html .= mvno_graph( $mvno );
  $html .= mvno_review( $shortname );
  $html .= mvno_button( $mvno );
  $html .= '</section>';

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
  $class = $mvno['is_voice_discount'] == 1 ? 'ok' : 'ng'; $html .= "<li class=\"$class\">通話割引</li>";
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
function mvno_review( $shortname )
{
  $m = new Mvno();
  $reviews = $m->get_review( $shortname );

  $html = '';
  foreach( $reviews as $review ){
    $sex = $review['sex'];
    $age = $review['age'];
    $class = $sex == 1 ? 'man' : 'woman';
    $href = get_bloginfo( 'url' ) . '/' . $shortname . '/';
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
            <a href="{$href}"><span class="review_mvno">{$review['sim_text']}</span></a>
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
function mobile_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => 'iphone6s',
    ), $atts ) );

    $m = new Mvno();
    $mobile = $m->get_mobile( $shortname );

    $html = <<< EOM
    <section class="mobile_info">
      <h2 id="{$mobile['shortname']}">{$mobile['name']}</h2>
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

add_shortcode( 'mvno_s', 'mvno_s_func' );
add_shortcode( 'mvno_txt', 'mvno_txt_func' );
add_shortcode( 'mvno_img', 'mvno_img_func' );
add_shortcode( 'mobile', 'mobile_func' );
