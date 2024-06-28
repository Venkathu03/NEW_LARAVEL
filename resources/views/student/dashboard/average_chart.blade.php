 <canvas id="myChart1"></canvas>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
									    <script>
                                              document.addEventListener('DOMContentLoaded', function() {
									    const data = {
									      labels: ['trial1','trail2','trail3','trail4'],
									      datasets: [{
									        label: 'Weekly Sales',
									        data: <?php echo json_encode($score);?>,
									        backgroundColor: (context) => {
									        	const bgColor = [
										          'rgba(0, 178, 231, 1)',
										          'rgba(190, 229, 244, 1)',
										          'rgba(255, 255, 255, 1)',
										          'rgba(255, 255, 255, 1)',
										          'rgba(255, 255, 255, 1)',
										          'rgba(255, 255, 255, 1)',
										          'rgba(255, 255, 255, 1)'
									        	];
									        	if (!context.chart.chartArea) {
									        		return;
									        	}
									        	console.log(context.chart.chartArea)
									        	const { ctx, data, chartArea: {top, bottom} } = context.chart;
									        	const gradientBg = ctx.createLinearGradient(0, top, 0, bottom);
									        	gradientBg.addColorStop(0, bgColor[0])
									        	gradientBg.addColorStop(0.5, bgColor[1])
									        	gradientBg.addColorStop(1, bgColor[2])
									        	return gradientBg;
									        },
									        borderColor: [
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)'
									        ],
									        tension: 0,
									        fill: true,
									       pointHoverRadius: 10,
									       pointHoverBorderWidth: 1,
									       pointHoverBackgroundColor: [
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)',
									          'rgba(0, 178, 231, 2)'
									        ],
									       pointHoverBorderColor: [
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)'
									        ],
									       pointRadius: 6,
									       pointBorderWidth: 3,
									        pointBackgroundColor: [
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)',
									          'rgba(54, 162, 235, 0)'
									        ],
									        pointBorderColor: [
									          'rgba(0, 178, 231, 0)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 1)',
									          'rgba(0, 178, 231, 0)'
									        ],
									        borderWidth: 1,
									        fill: true
									      }]
									    };

									    // config 
									    const config = {
									      type: 'line',
									      data,
									      options: {
									      	plugins: {
									      		legend: {
									      			display: false
									      		}
									      	},
									        scales: {
									          y: {
									            beginAtZero: true
									          }
									        }
									      }
									    };

									    // render init block
									    const myChart = new Chart(
									      document.getElementById('myChart1'),
									      config
									    );

									    // Instantly assign Chart.js version
									    const chartVersion = document.getElementById('chartVersion');
									    chartVersion.innerText = Chart.version;
                                            });
									    </script>