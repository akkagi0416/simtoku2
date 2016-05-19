<?php get_header(); ?>
  <main>
    <h1>search</h1>
    <div class="search">
      <p class="count"><span>0</span>件</p>
      <form action="<?php bloginfo( 'url' ). '/search' ?>" method="GET">
        <div class="search_type">
          <h3>種類</h3>
          <div>
            <label for="sim_type_1"><input type="checkbox" id="sim_type_1" name="sim_type[]" value="1">データSIM</label>
            <label for="sim_type_2"><input type="checkbox" id="sim_type_2" name="sim_type[]" value="2">SMS付SIM</label>
            <label for="sim_type_3"><input type="checkbox" id="sim_type_3" name="sim_type[]" value="3">通話SIM</label>
          </div>
        </div>
        <div class="search_size">
          <h3>データ容量</h3>
            <select id="" name="sim_size_min">
              <option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>GB～
            <select id="" name="sim_size_max">
              <option value=""></option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>GB
          <div>
        </div>
        <div class="search_cost">
          <h3>月額料金</h3>
            <select id="" name="sim_cost_min">
              <option value=""></option>
              <option value="0">0</option>
              <option value="500">500</option>
              <option value="1000">1000</option>
              <option value="2000">2000</option>
            </select>円～
            <select id="" name="sim_cost_max">
              <option value=""></option>
              <option value="0">0</option>
              <option value="500">500</option>
              <option value="1000">1000</option>
              <option value="2000">2000</option>
            </select>円
          <div>
        </div>
        <div class="search_mvno">
          <h3>格安SIM</h3>
          <div>
            <label for="sim_mvno_1"><input type="checkbox" id="sim_mvno_1" name="sim_mvno[]" value="1">OCN モバイル ONE</label>
            <label for="sim_mvno_2"><input type="checkbox" id="sim_mvno_2" name="sim_mvno[]" value="2">IIJmio</label>
            <label for="sim_mvno_3"><input type="checkbox" id="sim_mvno_3" name="sim_mvno[]" value="3">DMM mobile</label>
            <label for="sim_mvno_4"><input type="checkbox" id="sim_mvno_4" name="sim_mvno[]" value="4">U-mobile</label>
            <label for="sim_mvno_5"><input type="checkbox" id="sim_mvno_5" name="sim_mvno[]" value="5">楽天モバイル</label>
            <label for="sim_mvno_6"><input type="checkbox" id="sim_mvno_6" name="sim_mvno[]" value="6">BIGLOBE</label>
            <label for="sim_mvno_7"><input type="checkbox" id="sim_mvno_7" name="sim_mvno[]" value="7">mineo</label>
            <label for="sim_mvno_8"><input type="checkbox" id="sim_mvno_8" name="sim_mvno[]" value="8">NifMo</label>
          </div>
        </div>
        <div class="search_option">
          <h3>こだわり</h3>
          <div>
            <label for="sim_option_1"><input type="checkbox" id="sim_option_1" name="sim_option[]" value="is_beginner">初心者向け</label>
            <label for="sim_option_2"><input type="checkbox" id="sim_option_2" name="sim_option[]" value="is_voice_discount">通話割引</label>
            <label for="sim_option_3"><input type="checkbox" id="sim_option_3" name="sim_option[]" value="is_same_day_home">自宅で即日開通</label>
            <label for="sim_option_4"><input type="checkbox" id="sim_option_4" name="sim_option[]" value="is_carry_over">データ繰越</label>
            <label for="sim_option_5"><input type="checkbox" id="sim_option_5" name="sim_option[]" value="is_onoff">高速通信ON/OFF</label>
            <label for="sim_option_6"><input type="checkbox" id="sim_option_6" name="sim_option[]" value="is_wifi">WiFiスポット</label>
            <label for="sim_option_7"><input type="checkbox" id="sim_option_7" name="sim_option[]" value="is_free">使い放題</label>
            <label for="sim_option_8"><input type="checkbox" id="sim_option_8" name="sim_option[]" value="is_point">ポイント</label>
          </div>
        </div>
      <button type="submit" value="1" name="submit">この条件で検索</button>
      </form>
    </div><!-- //.search -->
  </main>
  <?php get_sidebar(); ?>
<?php get_footer(); ?>
