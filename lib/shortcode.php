<?php

/*
 * _sは簡略化バージョン
 */
function mvno_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => 'iijmio',
    ), $atts ) );

    $m = new Mvno();
    $mvnoInfo = $m->getInfo( $shortname );
    $mvnoPlan = $m->getPlan( $shortname );

    $html = '<section class="mvno_info">';
    $html .= mvno_head( $mvnoInfo );
    $html .= mvno_mybtn( $mvnoInfo );
    $html .= mvno_feature( $mvnoInfo );
    $html .= mvno_table( $mvnoInfo, $mvnoPlan );
    $html .= mvno_option( $mvnoInfo, $mvnoPlan );
    $html .= '</section>';

    return $html;
}

function mvno_s_func( $atts ){
    extract( shortcode_atts( array(
        'shortname' => 'iijmio',
    ), $atts ) );
    $m = new Mvno();
    $mvnoInfo = $m->getInfo( $shortname );
    $mvnoPlan = $m->getPlan( $shortname );

    $html = '<section class="mvno_info">';
    $html .= mvno_head( $mvnoInfo );
    $html .= mvno_mybtn_s( $mvnoInfo );
    $html .= mvno_feature( $mvnoInfo );
    $html .= mvno_table_s( $mvnoInfo, $mvnoPlan );
    $html .= '</section>';

    return $html;
}

function mvno_head( $mvnoInfo )
{
    $html = <<< EOM
    <h2 id="{$mvnoInfo['shortname']}">{$mvnoInfo['mvno']}の格安SIM情報</h2>
    <div class="row">
        <div class="col-sm-5">
            {$mvnoInfo['afi_img']}
        </div>
        <div class="col-sm-7">
            <h3>基本情報</h3>
            <dl>
                <dt>初期費用</dt><dd>{$mvnoInfo['initial']}</dd>
                <dt>最大速度</dt><dd>{$mvnoInfo['speed']}</dd>
                <dt>SIMサイズ</dt><dd>{$mvnoInfo['size']}</dd>
                <dt>SMS付</dt><dd>{$mvnoInfo['sms']}</dd>
                <dt>音声通話付</dt><dd>{$mvnoInfo['voice']}</dd>
                <dt>通話料</dt><dd>{$mvnoInfo['voice_cost']}</dd>
                <dt>回線</dt><dd>{$mvnoInfo['line']}</dd>
                <dt>購入窓口</dt><dd>{$mvnoInfo['buy']}</dd>
            </dl>
        </div>
    </div>
EOM;
    return $html;
}

function mvno_mybtn( $mvnoInfo )
{
    $html = <<< EOM
    <div class="mybtn">
        <p>
            <span>公式サイト </span>
            {$mvnoInfo['afi_txt']}
        </p>
    </div>
EOM;
    return $html;
}
function mvno_mybtn_s( $mvnoInfo )
{
    $html = <<< EOM
    <div class="mybtn">
        <p>
            {$mvnoInfo['afi_txt']}
            <a href="%URL%">詳細説明はこちら</a>
        </p>
    </div>
EOM;
    $url = site_url() . '/plan/' . $mvnoInfo['shortname'] . '/';
    return str_replace( '%URL%', $url, $html );
}
function mvno_feature( $mvnoInfo )
{
    $html = <<< EOM
    <h3>{$mvnoInfo['mvno']}の3つのおすすめポイント</h3>
    <ul>
        <li><i class="fa fa-star"></i>{$mvnoInfo['feature1']}</li>
        <li><i class="fa fa-star"></i>{$mvnoInfo['feature2']}</li>
        <li><i class="fa fa-star"></i>{$mvnoInfo['feature3']}</li>
    </ul>
    <p>{$mvnoInfo['comment1']}</p>
EOM;
    return $html;
}
function mvno_table( $mvnoInfo, $mvnoPlan )
{
    $html = <<< EOM2
        <h3>{$mvnoInfo['mvno']}の基本プラン</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-condensed">
                <tr class="active">
                    <th>プラン名</th>
                    <th>音声通話</th>
                    <th>月額料金(円)</th>
                    <th>最大速度</th>
                    <th>データ量</th>
                    <th>最低契約期間</th>
                </tr>
EOM2;

    foreach( $mvnoPlan as $row ){
        // 基本プランのみ表示
        // if( $row['plan_basic'] == 1 ){
            // データSIM or 音声通話付SIM表示 (SMS付SIMなし)
            if( $row['sim_data'] == 1 || $row['sim_voice'] == 1 ){
                $html .= '<tr>';
                $html .= '<td>' . $row['plan_name'] . '</td>';
                if( $row['sim_voice'] == 1 ){
                    $html .= '<td>〇</td>';
                } else {
                    $html .= '<td>&nbsp</td>';
                }
                $html .= '<td>' . $row['cost']      . '</td>';
                $html .= '<td>' . $row['speed']     . '</td>';
                $html .= '<td>' . $row['data']      . '</td>';
                $html .= '<td>' . $row['contract_period']      . '</td>';
                $html .= '</tr>';
            }
        // }
    }
    $html .= '</table></div>';

    return $html;
}
function mvno_table_s( $mvnoInfo, $mvnoPlan )
{
    $html = <<< EOM2
        <h3>{$mvnoInfo['mvno']}の基本プラン(一部)</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-condensed">
                <tr class="active">
                    <th>プラン名</th>
                    <th>音声通話</th>
                    <th>月額料金(円)</th>
                    <th>最大速度</th>
                    <th>データ量</th>
                </tr>
EOM2;

    foreach( $mvnoPlan as $row ){
        // 基本プランのみ表示
        if( $row['plan_basic'] == 1 ){
            // データSIM or 音声通話付SIM表示 (SMS付SIMなし)
            if( $row['sim_data'] == 1 || $row['sim_voice'] == 1 ){
                $table .= '<tr>';
                $html .= '<td>' . $row['plan_name'] . '</td>';
                if( $row['sim_voice'] == 1 ){
                    $html .= '<td>〇</td>';
                } else {
                    $html .= '<td>&nbsp</td>';
                }
                $html .= '<td>' . $row['cost']      . '</td>';
                $html .= '<td>' . $row['speed']     . '</td>';
                $html .= '<td>' . $row['data']      . '</td>';
                $html .= '</tr>';
            }
        }
    }
    $html .= '</table></div>';

    return $html;
}

function mvno_option( $mvnoInfo, $mvnoPlan )
{
    $html = <<< EOM
    <div class="option">
        <h3>{$mvnoInfo['mvno']}の機能一覧</h3>
        <div class="table-responsive">
            <table>
                <tr>
                    <th>プラン変更</th>
                    <td>{$mvnoInfo['option1']}</td>
                </tr>
                <tr>
                    <th>データ繰り越し</th>
                    <td>{$mvnoInfo['option2']}</td>
                </tr>
                <tr>
                    <th>バースト機能</th>
                    <td>{$mvnoInfo['option3']}</td>
                </tr>
                <tr>
                    <th>高速通信ON/OFF</th>
                    <td>{$mvnoInfo['option4']}</td>
                </tr>
                <tr>
                    <th>3日間の速度制限</th>
                    <td>{$mvnoInfo['option5']}</td>
                </tr>
                <tr>
                    <th>音声通話の割引</th>
                    <td>{$mvnoInfo['option6']}</td>
                </tr>
                <tr>
                    <th>シェアプラン</th>
                    <td>{$mvnoInfo['option7']}</td>
                </tr>
                <tr>
                    <th>Wi-Fiスポット</th>
                    <td>{$mvnoInfo['option8']}</td>
                </tr>
            </table>
        </div>
    </div>
EOM;
    return $html;
}

function mvno_img_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => 'iijmio',
    ), $atts ) );

    $m = new Mvno();
    $mvnoInfo = $m->getInfo( $shortname );
    $html = "<p class='mvno_img'>{$mvnoInfo['afi_img']}</p>";

    return $html;
}

function mvno_txt_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => 'iijmio',
    ), $atts ) );

    $m = new Mvno();
    $mvnoInfo = $m->getInfo( $shortname );
    $html = "<span class='mvno_txt'>{$mvnoInfo['afi_txt']}</span>";

    return $html;
}

function mobile_func( $atts )
{
    extract( shortcode_atts( array(
        'shortname' => iphone6s,
    ), $atts ) );

    $m = new Mobile();
    $mobileInfo = $m->getInfo( $shortname );

    $html = <<< EOM
    <section class="mobile_info">
      <h2 id="{$mobileInfo['shortname']}">{$mobileInfo['name']}</h2>
      <div class="row">
          <div class="col-sm-5">
              <a href="{$mobileInfo['url']}" target="_blank"><img src="{$mobileInfo['img']}" alt="{$mobileInfo['name']}"></a>
          </div>
          <div class="col-sm-7">
              <h3>基本情報</h3>
              <dl>
                  <dt>価格</dt><dd>{$mobileInfo['cost']}円(税抜)</dd>
                  <dt>メーカー</dt><dd>{$mobileInfo['maker']}</dd>
                  <dt>OS</dt><dd>{$mobileInfo['os']}</dd>
                  <dt>ディスプレイ</dt><dd>{$mobileInfo['display']}</dd>
                  <dt>色</dt><dd>{$mobileInfo['color']}</dd>
              </dl>
          </div>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed">
              <tr><td colspan="2" class="active">スペック</td></tr>
              <tr><th>CPU</th><td>{$mobileInfo['cpu']}</td></tr>
              <tr><th>RAM</th><td>{$mobileInfo['ram']}</td></tr>
              <tr><th>ROM</th><td>{$mobileInfo['rom']}</td></tr>
              <tr><th>画面</th><td>{$mobileInfo['display']} / {$mobileInfo['resolution']}</td></tr>
              <tr><th>カメラ</th><td>{$mobileInfo['camera']} / {$mobileInfo['camera_sub']}</td></tr>
              <tr><th>外部メディア</th><td>{$mobileInfo['media']}</td></tr>
              <tr><th>大きさ</th><td>{$mobileInfo['size']}</td></tr>
              <tr><th>重さ</th><td>{$mobileInfo['weight']}</td></tr>
              <tr><th>バッテリー</th><td>{$mobileInfo['battery']}</td></tr>
              <tr><th>SIM</th><td>{$mobileInfo['sim_size']}</td></tr>
          </table>
      </div>
    </section>
EOM;
    return $html;
}

add_shortcode( 'mvno_s', 'mvno_s_func' );
add_shortcode( 'mvno',   'mvno_func' );
add_shortcode( 'mvno_img', 'mvno_img_func' );
add_shortcode( 'mvno_txt', 'mvno_txt_func' );
add_shortcode( 'mobile',   'mobile_func' );
