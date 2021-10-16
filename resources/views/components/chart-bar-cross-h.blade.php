<div class="card h-100">
  <div class="card-header">
    <div class="badge bg-dark text-white">
      <span class="h6">Q.{{ $num ?? "" }}</span>
    </div>
    <b>{{ $title }}</b>
  </div>
  <div class="card-body">
    <?php $data  = conCrossData($target1, $target2, $span); ?>
    <?php $data2 = conCrossData($target2, $target1, $span); ?>
    @if( count($data["labels"]) > 0 )
      <canvas id="<?php echo $id; ?>" height="<?php echo $height; ?>"></canvas>
      <canvas id="<?php echo $id; ?>_2" height="<?php echo $height; ?>"></canvas>
      <script>
        var ctx = document.getElementById('<?php echo $id; ?>').getContext('2d');
        var myChart = new Chart(ctx, {
          // plugins: [ChartDataLabels],
          type: 'bar',
          responsive: true,
          maintainAspectRatio: true,
          data: {
            labels: <?php echo json_encode($data["labels"]); ?>,
            datasets: [
              <?php foreach ($data["values"] as $k => $v): ?>
                {
                  label: '<?php echo $v["label"]; ?>',
                  data: <?php echo json_encode($v["values"]); ?>,
                  backgroundColor: '<?php echo getBackgroundColor($k); ?>',
                  borderColor: '<?php echo getBorderColor($k); ?>',
                  borderWidth: 1
                },
              <?php endforeach; ?>
            ]
          },
          options: {
            indexAxis: 'y',
            plugins: {
              legend: true,
              datalabels: {
                color: '#000',
                anchor: 'center',
                align: 'center',
                offset: 0,
                clamp: 'true',
                font: {
                  size: 12
                }
              },
            },
            layout: {
              padding: {
                // top: 30
              }
            },
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true
              }
            }
          }
        });
      </script>
      <script>
        var ctx = document.getElementById('<?php echo $id; ?>_2').getContext('2d');
        var myChart = new Chart(ctx, {
          // plugins: [ChartDataLabels],
          type: 'bar',
          responsive: true,
          maintainAspectRatio: true,
          data: {
            labels: <?php echo json_encode($data2["labels"]); ?>,
            datasets: [
              <?php foreach ($data2["values"] as $k => $v): ?>
                {
                  label: '<?php echo $v["label"]; ?>',
                  data: <?php echo json_encode($v["values"]); ?>,
                  backgroundColor: '<?php echo getBackgroundColor($k); ?>',
                  borderColor: '<?php echo getBorderColor($k); ?>',
                  borderWidth: 1
                },
              <?php endforeach; ?>
            ]
          },
          options: {
            indexAxis: 'y',
            plugins: {
              legend: true,
              datalabels: {
                color: '#000',
                anchor: 'center',
                align: 'center',
                offset: 0,
                clamp: 'true',
                font: {
                  size: 12
                }
              },
            },
            layout: {
              padding: {
                // top: 30
              }
            },
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true
              }
            }
          }
        });
      </script>
    @endif
  </div>
</div>