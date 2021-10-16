<?php $data = judgeJsonRes($target, $span, $type); ?>
<div class="card h-100">
  <div class="card-header">
    <div class="badge bg-dark text-white">
      <span class="h6">Q.{{ $num ?? "" }}</span>
    </div>
    <b>{{ $title }}</b>
  </div>
  <div class="card-body">
    <canvas id="<?php echo $id; ?>" height="<?php echo $height; ?>"></canvas>
    <script>
      var ctx = document.getElementById('<?php echo $id; ?>').getContext('2d');
      var myChart = new Chart(ctx, {
        plugins: [ChartDataLabels],
        type: 'bar',
        responsive: true,
        maintainAspectRatio: true,
        data: {
          labels: <?php echo json_encode($data["labels"]); ?>,
          datasets: [{
            label: '数',
            data: <?php echo json_encode($data["values"]); ?>,
            backgroundColor: <?php echo json_encode(getBackgroundColorArr(count($data["values"]))); ?>,
            borderColor: <?php echo json_encode(getBorderColorArr(count($data["values"]))); ?>,
            borderWidth: 1
          }]
        },
        options: {
          indexAxis: 'y',
          plugins: {
            legend: false,
            datalabels: {
              color: '#c2c3c4',
              anchor: 'end',
              align: 'end',
              offset: 5,
              font: {
                size: 16
              }
            },
          },
          layout: {
            padding: {
              right: 30
            }
          },
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
  </div>
  <div class="card-footer">
    <form action="/chart/csv" method="post">
      @csrf
      <input type="hidden" name="type" value="chart-bar">
      <input type="hidden" name="dType" value="{{ $type }}">
      <input type="hidden" name="target" value="{{ $target }}">
      <input type="hidden" name="start" value="{{ $span['start'] }}">
      <input type="hidden" name="end" value="{{ $span['end'] }}">
      <input type="submit" value="CSV" class="btn btn-success">
    </form>
  </div>
</div>