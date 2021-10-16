@include("components.header")

  <h1 class="alert alert-info text-center">集計</h1>

  <div class="container">
    <div id="app">
      <div class="d-flex justify-content-center">
        <GChart
          v-if="forms.length > 0"
          type="Table"
          :data="forms"
          style="width: auto; height: auto;"
        />
      </div>
      <div class="card my-4">
        <div class="card-header">
          性別
        </div>
        <div class="card-body">
          <GChart
            v-if="gender.length > 0"
            type="PieChart"
            :data="gender"
            style="width: 100%; height: 300px;"
          />
        </div>
      </div>
      <div class="card my-4">
        <div class="card-header">
          都道府県
        </div>
        <div class="card-body">
          <GChart
            v-if="pref.length > 0"
            type="ColumnChart"
            :data="pref"
            style="width: 100%; height: 300px;"
          />
        </div>
      </div>
      <div class="card my-4">
        <div class="card-header">
          施設
        </div>
        <div class="card-body">
          <GChart
            v-if="facility.length > 0"
            type="BarChart"
            :data="facility"
            style="width: 100%; height: 300px;"
          />
        </div>
      </div>
      <div class="card my-4">
        <div class="card-header">
          登録日
        </div>
        <div class="card-body">
          <GChart
            v-if="created.length > 0"
            type="ColumnChart"
            :data="created"
            style="width: 100%; height: 300px;"
          />
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="{{ asset('js/vue.global.prod.js') }}"></script> -->
  <!-- <script src="{{ asset('js/vue.global.js') }}"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="{{ asset('js/vue-google-charts.browser.js') }}"></script>
  <script>
	Vue.component("gchart", VueGoogleCharts.GChart);
	var app = new Vue({
		el: '#app',
		data() {
			return {
        forms: <?php echo $forms; ?>,
        gender: <?php echo $gender; ?>,
        pref: <?php echo $pref; ?>,
        facility: <?php echo $facility; ?>,
        created: <?php echo $created; ?>,
      }
		},
	})

    // const app = {
    //   data() {
    //     return {
    //       forms: <?php //echo $gc; ?>,
    //     }
    //   },
    //   methods: {
    //   },
    //   watch: {
    //   },
    // }
    // Vue.createApp(app)
    //   .component("gchart", VueGoogleCharts.GChart)
    //   .mount('#app');

  </script>

@include("components.footer")