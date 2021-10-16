@include("components.header")

  <h1 class="alert alert-secondary text-center">リスト</h1>
  
  <div class="container">
    <div class="d-flex justify-content-center">
      <table class="table table-bordered list w-auto">
        <thead>
          <tr>
            <th>ID</th>
            <th>性別</th>
            <th>年代</th>
            <th>施設</th>
            <th>登録者</th>
            <th>IP</th>
            <th>エージェント</th>
            <th>登録日</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $k => $v) { ?>
            <tr>
              <td>{{ $v["id"] }}</td>
              <td>{{ $v->gender }}</td>
              <td>{{ $v->age }}</td>
              <td>
                <?php
                  $facilitys = jsonToArray($v->facilitys);
                  foreach ($facilitys as $fk => $fv) {
                    echo $fv;
                    if ($fk !== array_key_last($facilitys)) {
                      echo " / ";
                    }
                  }
                ?>
              </td>
              <td>{{ $v->author }}</td>
              <td>{{ $v->userIp}}</td>
              <td>{{ $v->userAgent }}</td>
              <td>{{ $v->created_at }}</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="app">
    <div class="container">
      <div class="d-flex justify-content-center">
      </div>
    </div><!-- /.container -->
  </div>

  <!-- <script src="{{ asset('js/vue.global.prod.js') }}"></script> -->
  <script src="{{ asset('js/vue.global.js') }}"></script>
  <script>
  const app = {
    data() {
      return {
        disabledSubmit: true,
      }
    },
    methods: {
    },
    watch: {
    },
  }
  Vue.createApp(app).mount('#app')
  </script>

@include("components.footer")