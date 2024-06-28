@extends('student.layouts.app')
@section('student-content')
<style>
	/* Customize the progress bar appearance */
	.progress-bar-container {
		width: 100%;
		background-color: #f1f1f1;
		border-radius: 5px;
		margin: 10px 0;
		position: relative;
	}

	.progress-bar-fill {
		height: 20px;
		border-radius: 5px;
		background-color: #4CAF50;
		color: #fff;
		text-align: center;
		line-height: 20px;
		position: absolute;
		top: 0;
		left: 0;
	}
    h5 {
        font-family: Gilroy-Regular !important;
    }
</style>
	<div class="card shadow-none bg-transparent border-bottom border-2">
		<div class="card-tbl-body">
			<div class="row align-items-center">
				<div class="col-md">
					<h4 class="mb-3 mb-md-0">Dashboard</h4>
				</div>
				
			</div>
		</div>
	</div>
	<!--end row-->
	<div class="row row-cols-1 row-cols-xl-2">
        
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1" style="margin-left: 0px">Overview</h5>
										
									</div>
									<div class="font-22 ms-auto">
									</div>
								</div>
								<div class="row row-cols-1 row-cols-sm-2" style="align-items: center; margin-top: 20px;">
									<div class="col">
										<div class="containerprogress">
									        @foreach($procedure_types as $proce_type)
									        <div class="progress-container">
									            <h6>{{$proce_type->procedure_type_name}}</h6>
									            <div class="progress-bar">
									                @if($proce_type->procedure_type_name =="Timetaken / 60s")
                                                    <span data-value="{{$proce_type->avg}}" data-width="{{$proce_type->avg.'min'}}"></span>
                                                    @else
                                                    <span data-value="{{$proce_type->avg.'%'}}" data-width="{{$proce_type->avg.'%'}}"></span>
                                                    @endif
									            </div>
									        </div>
                                            @endforeach
									    </div>
									</div>
									<div class="col">
										<div>
											<div id="radialBarChart"></div>
											<div><h6 style="text-align: center;">Overall Percentage</h6></div>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
					</div>

					<div class="col d-flex">
						<div class="card radius-10 w-100">
								<div class="d-flex align-items-center" style="margin:10px 10px 0px 15px;">
									<div>
										<h5 class="mb-1">Recent Trails</h5>
										
									</div>
									<div class="font-22 ms-auto" style="z-index: 10;">
									</div>
								</div>
							<div class="card-body">
								
											<table class="table mb-0">
												<thead>
													<tr>
												        <th scope="col">S.No.</th>
                                                        <th scope="col">Procedure Name</th>
                                                        <th scope="col">Procedure Type</th>
                                                        <th scope="col">Score</th>
													</tr>
												</thead>
												<tbody>
                                                    @foreach($recent_trials as $key=> $trial)
													<tr>
														<th scope="row">{{$key+1}}</th>
                                                        <td>{{$trial->procedure_name}}</td>
                                                        <td>{{$trial->procedure_type_name}}</td>
                                                        <td>{{$trial->score}}%</td>
													</tr>
                                                    @endforeach
													
												</tbody>
											</table>
						</div>
						</div>
					</div>

	</div>
    
    <div class="row">
					<div class="col-12 col-xl-6 d-flex">
						<div class="card radius-10 w-100">
							
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">Average Score</h5>
									</div>
									<div class="font-22 ms-auto">
										<label class="dropdown1">
                                            <select class="form-select filter-by-type" id="procedureDropdown">
                                            @foreach($procedures as $procedure)
                                            <option value="{{$procedure->id}}">{{$procedure->procedure_name}}</option>
                                            @endforeach
                                            </select>
										  
										</label>
									</div>
								</div>
                                
                               
                                    <div class="chartCard" style="margin-top: 50px;">
									      <div class="chartBox">
									        <canvas id="myChart"></canvas>
									      </div>
									    </div>
							</div>
						</div>
					</div>
        <div class="col-12 col-xl-6 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-0">Recent Activity</h5>
									</div>
									<div class="font-22 ms-auto">
									</div>
								</div>
								
								
									
									
										<div class="card-body">
											<ul class="list-unstyled">
                                                  @foreach($recent_procedures as $procedure)
												<li class="d-flex align-items-center border-bottom pb-2">
                                                     @if(\File::exists(public_path('procedure/'.$procedure['procedure_image'])))
													 <img src="{{asset('procedure/'.$procedure['procedure_image'])}}" class="rounded-circle p-1 border" width="70" height="70" alt="...">
                                                    @else
													<img src="{{ asset('assets/images/avatars/user.jpg')}}" class="rounded-circle p-1 border" width="70" height="70" alt="...">
                                                    
                                                    @endif
													<div class="flex-grow-1 ms-3">
														<div style="display: flex; width:100%;"><div style="width: 50%;"><a target="_blank" href="#">
															<h5 style="text-align:left; font-size: 18px;color:#32393f;">{{$procedure['procedure_name']}}</h5></a></div>
															<div style="width: 50%;"> <a href="#" class="float-end"><h2 style="text-align:right;color:#32393f;">{{$procedure['overall_performance']}}</h2></a></div></div>
															<p style="margin-top: -10px; color: #898989;">{{$procedure['created_at']}}</p>
								                    		<p style="margin-top: -10px;">{{$procedure['description']}}</p>
												</li>
												 @endforeach

											</ul>
										</div>
									

								
								
							</div>
						</div>
					</div>
        <div class="col-xl-8 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Announcements</h5>
										<p class="mb-0 font-13 text-secondary"><i class="bx bxs-calendar"></i>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
									</div>
									<div class="font-22 ms-auto">
									</div>
								</div>
								<div class="table-responsive mt-4">
									<table class="table align-middle mb-0 table-hover dataTable" id="Transaction-History">
										
										<tbody>
                                            @if(count($announcements) > 0)
                                            @foreach($announcements as $key=>$announcement)
											<tr>
												<td>
													<div class="d-flex align-items-center" style="margin: 5px px;">
														<div class="ms-2">
															<h6 class="mb-1 font-14" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">{{$announcement->title}}</h6>
															<p class="mb-0 font-13 text-secondary">{{$announcement->discription}}</p>
															<p class="mb-0 font-13 text-secondary">{{$announcement->created_at}}</p>
														</div>
													</div>
												</td>
												<td><div class="font-22 text-primary">
												</div></td>
												
											</tr>
											@endforeach
                                            @else
                                            <tr>
												<td>
                                                 <p style="tex-align:center;">No Record Found</p>
                                                </td>
											</tr>
                                            @endif
										</tbody>
									</table>
								</div>
							</div>
							
						</div>
						
					
						</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> 
        <a href="javaScript:;" class="back-to-top">
            <i class='bx bxs-up-arrow-alt'></i>
        </a>
		<!--End Back To Top Button-->
												    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
									    <script>
									    const data = {
									      labels: ['trial1','trail2','trail3','trail4'],
									      datasets: [{
									        label: 'Overall Performance',
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
									            beginAtZero: true,
                                                max:100
									          }
									        }
									      }
									    };

									    // render init block
									    const myChart = new Chart(
									      document.getElementById('myChart'),
									      config
									    );

									    // Instantly assign Chart.js version
									    const chartVersion = document.getElementById('chartVersion');
									    chartVersion.innerText = Chart.version;
									    </script>

							</div>
						

		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> 
        <a href="javaScript:;" class="back-to-top">
            <i class='bx bxs-up-arrow-alt'></i>
        </a>
		<!--End Back To Top Button-->
			
		<script>
            
            
			document.addEventListener('DOMContentLoaded', function() {
				// Single value for the radial-like bar chart
				const value = {{ $overall_performace }}; 
	
				new ApexCharts(document.querySelector('#radialBarChart'), {
	
    chart: {
      height: 180,
      type: "radialBar",
      toolbar: {
        show: !1,
      },
    },
    plotOptions: {
      radialBar: {
        hollow: {
          margin: 0,
          size: "78%",
          background: "#ceffca",
          image: void 0,
          imageOffsetX: 0,
          imageOffsetY: 0,
          position: "front",
          dropShadow: {
            enabled: !1,
            top: 3,
            left: 0,
            blur: 4,
            color: "rgba(0, 169, 255, 0.85)",
            opacity: 0.65,
          },
        },
        track: {
          margin: 0,
          dropShadow: {
            enabled: !1,
            top: -3,
            left: 0,
            blur: 4,
            color: "rgba(0, 169, 255, 0.85)",
            opacity: 0.65,
          },
        },
        dataLabels: {
          showOn: "always",
          name: {
            offsetY: -8,
            show: !0,
            color: "#6c757d",
            fontSize: "15px",
          },
          value: {
            formatter: function (e) {
              return e + "%";
            },
            color: "#000",
            fontSize: "25px",
            show: !0,
            offsetY: 10,
          },
        },
      },
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "horizontal",
        shadeIntensity: 0.5,
        gradientToColors: ["#17a00e"],
        inverseColors: !1,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100],
      },
    },
    colors: ["#17a00e"],
    series: [value],
    stroke: {
      lineCap: "round",
      width: "5",
    },
    labels: ["Completed"],
				}).render();
			});
            

            
		</script>
@endsection

@section('scripts')
<script>
     $(document).ready(function () {
                    $(document).on("change", ".filter-by-type", function(event) {
                       var data = {
                           "_token": "{{ csrf_token() }}",
                            id:$(this).val()
                       };
                      
					   $.ajax({
						type: 'POST',
						url: "{{ url('student/filter-by-type')}}",
						data: data,
						success: function (response) {
							// Update chart data and options
							myChart.data.labels = response.labels;
							myChart.data.datasets[0].data = response.data;
							myChart.update();
						},
						error: function (xhr, status, error) {
							console.error(error);
						}
					});
                   });
    });
            
</script>

@endsection