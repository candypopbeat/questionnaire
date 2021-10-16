@can('admin')
  <div class="card h-100">
    <div class="card-header">
      <b>{{ $title }}</b>
    </div>
    <div class="card-body">
      <div id="table">
        <vue-good-table
          :columns="columns"
          :rows="rows"
          :fixed-header="true"
          :line-numbers="false"
          :search-options="{
            enabled: true,
            skipDiacritics: true,
          }"
          :pagination-options="{
            enabled: true,
            perPage: 5,
          }"
          :sort-options="{
            enabled: true,
            initialSortBy: {field: 'id', type: 'desc'}
          }"
        />
      </div>
      <script>
        var table = new Vue({
          el: '#table',
          data: {
            columns: [{
                label: 'ID',
                field: 'id',
                type: 'number',
              },
              {
                label: '性別',
                field: 'gender',
              },
              {
                label: '年代',
                field: 'age',
              },
              {
                label: '都道府県',
                field: 'pref',
              },
              {
                label: '施設',
                field: 'facilitys',
              },
              {
                label: '登録者',
                field: 'author',
              },
              {
                label: 'IPアドレス',
                field: 'userIp',
              },
              {
                label: 'エージェント',
                field: 'userAgent',
              },
              {
                label: 'Created At',
                field: 'created_at',
                type: 'date',
                dateInputFormat: 'YYYY-MM-DD hh:mm:ss',
                dateOutputFormat: 'YYYY-MM-DD hh:mm:ss',
              },
              {
                label: 'Updated At',
                field: 'updated_at',
                type: 'date',
                dateInputFormat: 'YYYY-MM-DD hh:mm:ss',
                dateOutputFormat: 'YYYY-MM-DD hh:mm:ss',
              },
            ],
            rows: <?php echo json_encode(conVueGoodTable($span)); ?>
          }
        });
      </script>
    </div>
    <div class="card-footer">
      <form action="/chart/csv" method="post">
        @csrf
        <input type="hidden" name="type" value="datatable">
        <input type="hidden" name="start" value="{{ $span['start'] }}">
        <input type="hidden" name="end" value="{{ $span['end'] }}">
        <input type="submit" value="CSV" class="btn btn-success">
      </form>
    </div>
  </div>
@endcan