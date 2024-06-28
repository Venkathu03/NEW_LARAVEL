@extends('admin.layouts.app')

@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md-3">
								<h4 class="mb-3 mb-md-0">Dashboard</h4>
							</div>
							
						</div>
					</div>
				</div>
				
	<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					
					<div class="col">
						<div class="card radius-10" style="border-radius: 50px; border-top: 15px solid #a4fcd7; border-color: #a4fcd7;">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0" style="font-size: 13px; font-family: Gilroy-Regular; color: #5F6564;">Total<br>Students</p>
										<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;">{{$total_student}}</h5>
									</div>
									<div class="dropdown ms-auto">
										<section class="bar-graph bar-graph-vertical bar-graph-two">
										  <div class="bar-one bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-two bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-three bar-container">
										    <div class="bar"></div>
										    
										  </div>

										</section>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10" style="border-radius: 50px; border-top: 15px solid #a4fcd7; border-color: #a4fcd7;">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0" style="font-size: 13px; font-family: Gilroy-Regular; color: #5F6564;">Total<br>Performance</p>
										<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;">{{$total_performance}}</h5>
									</div>
									<div class="dropdown ms-auto">
										<section class="bar-graph bar-graph-vertical bar-graph-two">
										  <div class="bar-one bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-two bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-three bar-container">
										    <div class="bar"></div>
										    
										  </div>

										</section>
									</div>
								</div>
								
							</div>
						</div>
					</div>
        
					<div class="col">
						<div class="card radius-10" style="border-radius: 50px; border-top: 15px solid #a4fcd7; border-color: #a4fcd7;">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0" style="font-size: 13px; font-family: Gilroy-Regular; color: #5F6564;">Total<br>Institution</p>
										<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;">{{$total_institution}}</h5>
									</div>
									<div class="dropdown ms-auto">
										<section class="bar-graph bar-graph-vertical bar-graph-two">
										  <div class="bar-one bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-two bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-three bar-container">
										    <div class="bar"></div>
										    
										  </div>

										</section>
									</div>
								</div>
								
							</div>
						</div>
					</div>
        <div class="col">
						<div class="card radius-10" style="border-radius: 50px; border-top: 15px solid #a4fcd7; border-color: #a4fcd7;">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0" style="font-size: 13px; font-family: Gilroy-Regular; color: #5F6564;">Today<br>Performance</p>
										<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;">{{$today_performance}}</h5>
									</div>
									<div class="dropdown ms-auto">
										<section class="bar-graph bar-graph-vertical bar-graph-two">
										  <div class="bar-one bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-two bar-container">
										    <div class="bar"></div>
										 
										  </div>
										  <div class="bar-three bar-container">
										    <div class="bar"></div>
										    
										  </div>

										</section>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
				<div class="row row-cols-1 row-cols-xl-2">
					<div class="col-12 col-xl-6 d-flex">
						<div class="card radius-10 w-100">
							
							<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0">Sales Insights</h5>
										</div>
                                        <div class="font-22 ms-auto">
										<label class="dropdown1">
                                           <input type="month" class="form-control filter-by-month" value="{{date('F Y')}}">
										</label>
									</div>
									</div>

								
										<div class="chartCard">
									      <div class="chartBox">
									        <canvas id="myChart"></canvas>
									      </div>
									    </div>
									    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
									    <script>
									    // setup 
									    const data = {
									      labels: <?php echo json_encode($weeks);?>,
									      datasets: [{
									        label: 'Weekly Sales',
									        data: <?php echo json_encode($week_score);?>,
									       // backgroundColor: [
									         // 'rgba(255, 26, 104, 0.2)',
									          //'rgba(54, 162, 235, 0.2)',
									         // 'rgba(255, 206, 86, 0.2)',
									         // 'rgba(75, 192, 192, 0.2)',
									         // 'rgba(153, 102, 255, 0.2)',
									         // 'rgba(255, 159, 64, 0.2)',
									          //'rgba(0, 0, 0, 0.2)'
									        //],
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
						</div>
					</div>
                    
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1" style="margin-left: 20px">Students Insights</h5>
										
									</div>
									
								</div>
								<div class="row row-cols-1 row-cols-sm-2" style="align-items: center; margin-top: 60px;">
									<div class="col">
										<div class="containerprogress">
									        @foreach($procedure_types as $proce_type)
                                            <div class="progress-container">
                                                <h6>{{$proce_type->procedure_type_name}}</h6>
                                                <div class="progress-bar">
                                                    @if($proce_type->procedure_type_name =="Timetaken / 60s")
                                                    <span data-value="{{$proce_type->avg.'min '}}" data-width="{{$proce_type->avg.'%'}}"></span>
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
				</div>
				<!--end row-->
				
				<!--end row-->
				
				<!--end row-->
				<!--end row-->
				<div class="row">
                    
					<div class="col d-flex">
						<div class="card radius-10 w-100">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Performance Insights</h5>
										
									</div>
									
								</div>
							</div>
							<div class="card-body">
								<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Top 5 Institution</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarychange" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Top 5 Students</div>
											</div>
										</a>
									</li>
									

								</ul>
								<div class="tab-content py-3">
									<div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
										<div class="row row-cols-1">
											<div class="col d-flex">
												<div class="card radius-10 w-100" style="margin-bottom: 0px;">
													
														
														<div class="product-list p-3 mb-3" style="height: 300px!important;overflow:scroll;">
															 @foreach($top_institutions as $key=>$institution)
															<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">
																
																<div class="col-sm-6" style="width: 70%!important;">
																	<div class="d-flex align-items-center">
																		<div class="product-img">
																			<p style="padding: 10px 20px; border: 1px solid #40D5F9; border-radius: 20px; margin-top: 10px;">#{{$key+1}}</p>
																		</div>
																		<div class="ms-2">
																			<h6 class="mb-1" style="font-size: 14px; font-family: Gilroy-SemiBold;">{{$institution->institution_name}}</h6>
																			
																		</div>
																	</div>
																</div>
																<div class="col-sm" style="width: 30%;">
																	<h6 class="mb-1" style="float: right; font-family: Gilroy-SemiBold; font-size: 32px;">{{ round($institution->score).'%'}}</h6>
																	
																</div>
																
															</div>
                                                            @endforeach

															
														</div>

													

												</div>
											</div>
					
										</div>

										
																			
									</div>
									<div class="tab-pane fade" id="primarychange" role="tabpanel">
										<div class="row row-cols-1">
											<div class="col d-flex">
												<div class="card radius-10 w-100" style="margin-bottom: 0px;">
													<div class="product-list p-3 mb-3" style="height: 300px!important; overflow: scroll;">
															@foreach($top_students as $key=>$student)
															<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">
																
																<div class="col-sm-6" style="width: 70%!important;">
																	<div class="d-flex align-items-center">
																		<div class="product-img">
																			<p style="padding: 10px 20px; border: 1px solid #40D5F9; border-radius: 20px; margin-top: 10px;">#{{$key+1}}</p>
																		</div>
																		<div class="ms-2">
																			<h6 class="mb-1" style="font-size: 14px; font-family: Gilroy-SemiBold;">{{$student->fullname}} </h6>
																			
																		</div>
																	</div>
																</div>
																<div class="col-sm" style="width: 30%;">
																	<h6 class="mb-1" style="float: right; font-family: Gilroy-SemiBold; font-size: 32px;">{{ round($student->score).'%'}}</h6>
																	
																</div>
																
															</div>
															
															@endforeach
														</div>
													
												</div>
											</div>
										</div>
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
										<h5 class="mb-1">Institution Insights</h5>
									</div>
								
								</div>
								
								
								<div class="chart-container1" style="padding: 50px;">
									<canvas id="chart6"></canvas>
									</div>
									<div class="row row-cols-1 row-cols-sm-2">
										<div class="col" tabindex="220">
											<div style="text-align:center">
  
												  <span class="dot" style="height: 20px; width: 20px; background-color: #4ED3FF; border-radius: 50%; display: inline-block; vertical-align: middle;"></span>
												  <span style="font-size: 14px; font-family: Gilroy-Regular;" >Registered Institution</span>
												  <div style="padding-top: 10px;"><h6 style="font-size: 24px; font-family: Gilroy-SemiBold;">{{$is_registered_institute.'%'}}</h6></div>
											</div>
  
										</div>
										<div class="col" tabindex="220">
											<div style="text-align:center">
  
												  <span class="dot" style="height: 20px; width: 20px; background-color: #45E395; border-radius: 50%; display: inline-block; vertical-align: middle;"></span>
												  <span style="font-size: 14px; font-family: Gilroy-Regular;" >UnRegistered Institution</span>
												  <div style="padding-top: 10px;"><h6 style="font-size: 24px; font-family: Gilroy-SemiBold;">{{$un_registered_institute.'%'}}</h6></div>
											</div>
										</div>

									</div>
        
									

								
								
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
@endsection

@section('scripts')

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
<script>
     $(document).ready(function () {
         const monthControl = document.querySelector('input[type="month"]');
        const date= new Date()
        const month=("0" + (date.getMonth() + 1)).slice(-2)
        const year=date.getFullYear()
        monthControl.value = `${year}-${month}`;
         
                    $(document).on("change", ".filter-by-month", function(event) {
                       var data = {
                           "_token": "{{ csrf_token() }}",
                            month:$(this).val()
                       };
                      
					   $.ajax({
						type: 'POST',
						url: "{{ url('admin/filter-by-month')}}",
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
<script>
  new Chart(document.getElementById("chart6"), {
											type: 'doughnut',
											data: {
												labels: ["Registered", "UnRegistered"],
												datasets: [{
													label: "",
													backgroundColor: ["#43E59F", "#4ED3FF"],
													data:<?php echo json_encode(array($is_registered_institute,$un_registered_institute)) ;?>,
												}]
											},

											options: {
												plugins: {
									      		legend: {
									      			display: false
										      		}
										      	},

												maintainAspectRatio: false,
												title: {
													display: false,
													text: ''
												}
											}
										});
									</script>

@endsection