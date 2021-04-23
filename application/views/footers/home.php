        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <!--Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>gentelella-master/vendors/Chart.js/dist/Chart.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>gentelella-master/build/js/custom.min.js"></script>

    <!-- Chart.js -->
    <script>
      Chart.defaults.global.legend = {
        enabled: false
      };

      // Line chart
      /*var ctx = document.getElementById("lineChart");
      var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(38, 185, 154, 0.31)",
            borderColor: "rgba(38, 185, 154, 0.7)",
            pointBorderColor: "rgba(38, 185, 154, 0.7)",
            pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointBorderWidth: 1,
            data: [31, 74, 6, 39, 20, 85, 7]
          }, {
            label: "My Second dataset",
            backgroundColor: "rgba(3, 88, 106, 0.3)",
            borderColor: "rgba(3, 88, 106, 0.70)",
            pointBorderColor: "rgba(3, 88, 106, 0.70)",
            pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(151,187,205,1)",
            pointBorderWidth: 1,
            data: [82, 23, 66, 9, 99, 4, 2]
          }]
        },
      });

      // Bar chart
      var ctx = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["شهر 1", "شهر 2", "شهر 3", "شهر 4", "شهر 5", "شهر 6", "شهر 7", "شهر 8", "شهر 9", "شهر 10", "شهر 11", "شهر 12"],
          datasets: [{
            label: '<?php echo lang('outcomes'); ?>',
            backgroundColor: "#26B99A",
            data: [<?php echo $outcomes[1]; ?>, <?php echo $outcomes[2]; ?>, <?php echo $outcomes[3]; ?>, <?php echo $outcomes[4]; ?>, <?php echo $outcomes[5]; ?>, <?php echo $outcomes[6]; ?>, <?php echo $outcomes[7]; ?>, <?php echo $outcomes[8]; ?>, <?php echo $outcomes[9]; ?>, <?php echo $outcomes[10]; ?>, <?php echo $outcomes[11]; ?>, <?php echo $outcomes[12]; ?>]
          }, {
            label: '<?php echo lang('incomes'); ?>',
            backgroundColor: "#03586A",
            data: [<?php echo $incomes[1]; ?>, <?php echo $incomes[2]; ?>, <?php echo $incomes[3]; ?>, <?php echo $incomes[4]; ?>, <?php echo $incomes[5]; ?>, <?php echo $incomes[6]; ?>, <?php echo $incomes[7]; ?>, <?php echo $incomes[8]; ?>, <?php echo $incomes[9]; ?>, <?php echo $incomes[10]; ?>, <?php echo $incomes[11]; ?>, <?php echo $incomes[12]; ?>]
          }]
        },

        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
*/
      // Doughnut chart
      var ctx = document.getElementById("canvasDoughnut");
      var data = {
        labels: [
          "<?php echo $activesections[0]['name']; ?> ",
          "<?php echo $activesections[1]['name']; ?> ",
          "<?php echo $activesections[2]['name']; ?> ",
          "<?php echo $activesections[3]['name']; ?> ",
          "<?php echo $activesections[4]['name']; ?> "
        ],
        datasets: [{
          data: [
			<?php echo $activesections[0]['sum']; ?>,
			<?php echo $activesections[1]['sum']; ?>,
			<?php echo $activesections[2]['sum']; ?>,
			<?php echo $activesections[3]['sum']; ?>,
			<?php echo $activesections[4]['sum']; ?>
			],
          backgroundColor: [
            "rgba(52,152,219,0.88)",
            "rgba(38,185,154,0.88)",
            "rgba(243,156,18,0.88)",
            "rgba(231,76,60,0.88)",
            "rgba(46,109,164,0.88)"
          ],
          hoverBackgroundColor: [
            "rgba(92,172,226,0.88)",
            "rgba(81,199,174,0.88)",
            "rgba(245,175,65,0.88)",
            "rgba(235,111,98,0.88)",
            "rgba(87,138,182,0.88)"
          ]

        }]
      };

      var canvasDoughnut = new Chart(ctx, {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: data
      });

      // Radar chart
      /*var ctx = document.getElementById("canvasRadar");
      var data = {
        labels: ["شهر 1", "شهر 2", "شهر 3", "شهر 4", "شهر 5", "شهر 6", "شهر 7", "شهر 8", "شهر 9", "شهر 10", "شهر 11", "شهر 12"],
        datasets: [{
          label: '<?php echo lang('outcomes'); ?>',
          backgroundColor: "rgba(231, 76, 60, 0.2)",
          borderColor: "rgba(231, 76, 60, 0.80)",
          pointBorderColor: "rgba(231, 76, 60, 0.80)",
          pointBackgroundColor: "rgba(231, 76, 60, 0.80)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          data: [<?php echo $outcomes[1]; ?>, <?php echo $outcomes[2]; ?>, <?php echo $outcomes[3]; ?>, <?php echo $outcomes[4]; ?>, <?php echo $outcomes[5]; ?>, <?php echo $outcomes[6]; ?>, <?php echo $outcomes[7]; ?>, <?php echo $outcomes[8]; ?>, <?php echo $outcomes[9]; ?>, <?php echo $outcomes[10]; ?>, <?php echo $outcomes[11]; ?>, <?php echo $outcomes[12]; ?>]
        }, {
          label: '<?php echo lang('incomes'); ?>',
          backgroundColor: "rgba(38, 185, 154, 0.2)",
          borderColor: "rgba(38, 185, 154, 0.85)",
          pointColor: "rgba(38, 185, 154, 0.85)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [<?php echo $incomes[1]; ?>, <?php echo $incomes[2]; ?>, <?php echo $incomes[3]; ?>, <?php echo $incomes[4]; ?>, <?php echo $incomes[5]; ?>, <?php echo $incomes[6]; ?>, <?php echo $incomes[7]; ?>, <?php echo $incomes[8]; ?>, <?php echo $incomes[9]; ?>, <?php echo $incomes[10]; ?>, <?php echo $incomes[11]; ?>, <?php echo $incomes[12]; ?>]
        }]
      };

      var canvasRadar = new Chart(ctx, {
        type: 'radar',
        data: data,
      });*/

      // Pie chart
      /*var ctx = document.getElementById("pieChart");
      var data = {
        datasets: [{
          data: [
			<?php echo $customers[0]['count']; ?>,
			<?php echo $customers[1]['count']; ?>,
			<?php echo $customers[2]['count']; ?>,
			<?php echo $customers[3]['count']; ?>,
			<?php echo $customers[4]['count']; ?>
		  ],
          backgroundColor: [
            "rgba(46,109,164,0.88)",
			"rgba(231,76,60,0.88)",
            "rgba(243,156,18,0.88)",
            "rgba(38,185,154,0.88)",
			"rgba(52,152,219,0.88)"
          ],
          label: '<?php echo lang('nooforders'); ?>' // for legend
        }],
        labels: [
          "<?php echo $customers[0]['name']; ?> ",
          "<?php echo $customers[1]['name']; ?> ",
          "<?php echo $customers[2]['name']; ?> ",
          "<?php echo $customers[3]['name']; ?> ",
          "<?php echo $customers[4]['name']; ?> "
        ]
      };

      var pieChart = new Chart(ctx, {
        data: data,
        type: 'pie',
        otpions: {
          legend: false
        }
      });*/

      // PolarArea chart
      var ctx = document.getElementById("polarArea");
      var data = {
        datasets: [{
          data: [
			<?php echo $activeusers[0]['count']; ?>,
			<?php echo $activeusers[1]['count']; ?>,
			<?php echo $activeusers[2]['count']; ?>,
			<?php echo $activeusers[3]['count']; ?>,
			<?php echo $activeusers[4]['count']; ?>
		  ],
          backgroundColor: [
            "rgba(46,109,164,0.88)",
			"rgba(231,76,60,0.88)",
            "rgba(243,156,18,0.88)",
            "rgba(38,185,154,0.88)",
			"rgba(52,152,219,0.88)"
          ],
          label: '<?php echo lang('noofactions'); ?>'
        }],
        labels: [
          "<?php echo $activeusers[0]['name']; ?> ",
          "<?php echo $activeusers[1]['name']; ?> ",
          "<?php echo $activeusers[2]['name']; ?> ",
          "<?php echo $activeusers[3]['name']; ?> ",
          "<?php echo $activeusers[4]['name']; ?> "
        ]
      };

      var polarArea = new Chart(ctx, {
        data: data,
        type: 'polarArea',
        options: {
          scale: {
            ticks: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
    <!-- /Chart.js -->
  </body>
</html>