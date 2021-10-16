<?php $created = conChartTimestamp($span, $minute, $height); ?>
@if( count($created) > 0 )
<div class="card h-100">
  <div class="card-header">
    <b>{{ $title }}</b>
  </div>
  <div class="card-body">
    <canvas id="<?php echo $id; ?>" height="<?php echo $height; ?>"></canvas>
    <script>
      var ctx = document.getElementById('<?php echo $id; ?>').getContext('2d');
      var myChart = new Chart(ctx, {
        plugins: [ChartDataLabels],
        type: 'line',
        responsive: true,
        maintainAspectRatio: true,
        data: {
          labels: <?php echo json_encode($created["labels"]); ?>,
          datasets: [{
            label: '数',
            data: <?php echo json_encode($created["values"]); ?>,
            backgroundColor: '<?php echo getBackgroundColor(0); ?>',
            borderColor: '<?php echo getBorderColor(0); ?>',
            borderWidth: 3.5,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: '<?php echo getBackgroundColor(0); ?>',
          }]
        },
        options: {
          maintainAspectRatio: false,
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
              top: 40
            }
          },
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Poppins',
            bodyFontFamily: 'Poppins',
            cornerRadius: 3,
            intersect: false,
          },
          scales: {
            xAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: false,
                labelString: 'Month'
              },
              ticks: {
                fontFamily: "Poppins"
              }
            }],
            yAxes: [{
              display: false,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: false,
                labelString: 'Value',
                fontFamily: "Poppins"
              },
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
      });
    </script>
  </div>
</div>
@endif