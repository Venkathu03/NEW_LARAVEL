@extends('admin.layouts.app')
@section('admin-content')
				<div class="col">
						<h4 class="mb-3 mb-md-0">Report</h4>
						<hr/>
						<div class="card">
							<div class="card-body">
								<ul class="nav nav-tabs nav-primary" role="tablist">
									
								
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primarysubscription" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Performance Report</div>
											</div>
										</a>
									</li>
                                    
                                    <li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#reg_intitution" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Reg.Institution Report</div>
											</div>
										</a>
									</li>
                                    
                                     <li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#unreg_intitution" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">UnReg.Institution Report</div>
											</div>
										</a>
									</li>

								</ul>
								<div class="tab-content py-3">
								<div class="tab-pane fade   show active" id="primarychange" role="tabpanel">
										
									</div>
									<div class="tab-pane fade show active" id="primarysubscription" role="tabpanel">
										
									
													<div class="card-body">
														<div class="d-flex align-items-center">
															<div class="row row-cols-auto g-3" style="align-items: center;">
																<div class="col">
																	<h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Students Performance Reports</h5>
																</div>
																
															</div>
															
														</div>
                                                         <div class="row">
                                                             <div class="col-sm-3">
                                                                 <label>Institution Name</label>
                                                                <select class="form-select" id="institution_id" required>
                                                                    <option value="">Choose</option>  
                                                                    @foreach($all_institutions as $institution)
                                                                    <option value="{{$institution->id}}">{{$institution->institution_name}}</option> 
                                                                    @endforeach
                                                                 </select>    
                                                            </div> 
                                                             
                                                             
                                                             <div class="col-sm-3">
                                                                 <label>Student Name</label>
                                                                <select class="form-select" id="student_id" required>
                                                                    <option value="">Choose</option>
                                                                 </select>    
                                                            </div>
                                                             
                                                             <div class="col-sm-2">
                                                                 <label>From Date</label>
                                                                <input type="date" class="form-control from-date">   
                                                            </div>
                                                            <div class="col-sm-2">
                                                                 <label>To Date</label>
                                                                <input type="date" class="form-control to-date">   
                                                            </div>
                                                            
                                                              <div class="col-sm-2" style="margin-top: 20px;">
                                                                  <button class="btn btn-primary filter-report-by-student">Search</button> 
                                                               </div>

                                                          </div>
													</div>
													<div class="card-body1"></div>		<!--end row-->
														<div class="accordion" id="accordionExample">
                                                            @foreach ($procedures as $index =>$item)
															<div class="accordion-item">
																<h2 class="accordion-header" id="headingOne_{{$index}}">
                                                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$index}}" aria-expanded="true" aria-controls="collapseOne_{{$index}}">
                                                                {{$item['procedure_name']}}
                                                              </button>
														</h2>
																<div id="collapseOne_{{$index}}" class="accordion-collapse collapse @if($index == 0) {{'show'}} @endif" aria-labelledby="headingOne_{{$index}}" data-bs-parent="#accordionExample">
																	<div class="accordion-body">	
																	
														<!--end row-->

														<!--end row-->
														<div class="row row-cols-1 row-cols-xl-2">
                                                            @if(isset($item['type_value']))
                                                                @foreach($item['type_value'] as $index=>$procedure_type)
															<div class="col d-flex">
																<div class="card radius-10 w-100">
																	<div class="card-body">
																		<div>
																			<h5 class="mb-1" style="margin-left: 30px">{{$procedure_type['procedure_type_name']}}</h5>
																					
																		</div>
																		<div>
                                                                     @if($procedure_type['procedure_type_name']=="Overall performance")
                                                                         
																		<div class="row row-cols-1 row-cols-sm-3 mt-4" style="align-items: center;">
																			<div class="col" style="width: 30%; margin-left: 0px;">
																				<div style="margin-left: 30px;">
																					<div id="div1"></div>
																					<div id="div2"></div>
																					<div id="div3"></div>
																					<div id="div4"></div>
																				</div>
																			</div>
																			<div class="col" style="width: 70%;">
																				<div><p style="font-family: Gilroy-Regular; font-size: 16px; font-weight: 400; text-align: center;">Your Over all Performance is Average </p></div>
																				<div><h4 style="font-family: Gilroy-SemiBold; font-size: 32px; font-weight: 700; text-align: center;">{{ json_encode($procedure_type['score'][0]).'%' }}</h4></div>
																			</div>
																		</div>  
                                                                       @elseif($procedure_type['procedure_type_name'] =="Timetaken / 60s")
                                                                            <div class="row row-cols-1 row-cols-sm-2" style="align-items: center; margin-top: 20px;">
																			<div class="col1" style="width: 70%;">
                                                                                <div class="container2">
                                                                                <div class="circular-progress" data-scores="{{json_encode($procedure_type['score'][0])}}">
                                                                                <span class="progress-value">{{json_encode($procedure_type['score'][0]).'%'}}</span>
                                                                                </div>
																		</div>
																			</div>
																			<div class="col2" style="width: 30%;">
																				<div class="trail" style="width: 100%;">
																					   <P style="text-align: center; margin-top: 15px; font-family: Gilroy-Regular;">Over all Time Taken is Average</p>
																						<h3 style="text-align: center; font-size: 24px; font-family: Gilroy-SemiBold; font-weight: 700; margin-top: -10px;">{{json_encode($procedure_type['score'][0])}}</h3>
																				</div>
																			</div>
																			
																		</div>
                                                                         @else
                                                                        
																			<div class="container20">
																			  
																			  <div class="barcontainer20">
																			    <div class="bar20" style="margin-bottom: 10px;font-size:20px;height:{{ json_encode($procedure_type['score'][0]).'%' }}">
																			      <p style="font-size: 20px; font-family: Gilroy-Bold; text-align: center;">{{ json_encode($procedure_type['score'][0]).'%' }}</p>
																			    </div>
																			  </div>

																			  <p style="color: #828583; font-weight: 300; font-family: Gilroy-Regular; text-align: center; margin-top: 10px;">Over all {{$procedure_type['procedure_type_name']}}</p>
																			 
																			</div>
                                                                            @endif
																		</div>
																		
																	</div>
																</div>
															</div>
                                                             @endforeach
                                                            
                                                             @else 
                                                                        <p style="text-align:center;margin-left: 180px;">No Record Found</p>
                                                            @endif
														</div>
																	</div>
																</div>
															</div>
                                                            @endforeach
													</div>
												
									</div>
                                    
                                    
                                    <div class="tab-pane fade" id="reg_intitution" role="tabpanel">
										<div class="row row-cols-1">
											<div class="col d-flex">
												<div class="card radius-10 w-100" style="margin-bottom: 0px;">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<div class="row row-cols-auto g-3" style="align-items: center;">
																<div class="col">
																	<h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Institution Reports</h5>
																</div>
																
																
															</div>
															
														</div>
														
													</div>
													<div class="card-body">
														<div class="table-responsive">
															<table id="example22" class="table table-striped table-bordered">
																<thead style="background-color: #E4E4E4;">
															<tr>
																<th>S.No.</th>
																<th>Institution Name</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
                                                            @foreach($register_institions as $key=>$instition)
															<tr>
																<td>{{$key+1}}</td>
																<td>{{$instition->institution_name}}</td>
                                                                @if($instition->active_status == 1)
																    <td style="color: #43E69B;">Active</td>
                                                                @else 
                                                                    <td style="color: red;">Inactive</td>
                                                                @endif
																<td><a href="{{ url('admin/view-institution-report/'.$instition->id)}}" style="text-decoration: underline; color: #000000;">View</a></td>
															</tr>
                                                            @endforeach
														</tbody>
														
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                    
                                    
                                    <div class="tab-pane fade" id="unreg_intitution" role="tabpanel">
										<div class="row row-cols-1">
											<div class="col d-flex">
												<div class="card radius-10 w-100" style="margin-bottom: 0px;">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<div class="row row-cols-auto g-3" style="align-items: center;">
																<div class="col">
																	<h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Institution Reports</h5>
																</div>
																
																
															</div>
															
														</div>
														
													</div>
													<div class="card-body">
														<div class="table-responsive">
															<table id="example21" class="table table-striped table-bordered">
																<thead style="background-color: #E4E4E4;">
															<tr>
																<th>S.No.</th>
																<th>Institution Name</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
                                                            @foreach($unregister_institions as $key=>$instition)
															<tr>
																<td>{{$key+1}}</td>
																<td>{{$instition->institution_name}}</td>
                                                                @if($instition->active_status == 1)
																    <td style="color: #43E69B;">Active</td>
                                                                @else 
                                                                    <td style="color: red;">Inactive</td>
                                                                @endif
																<td><a href="{{ url('admin/view-institution-report/'.$instition->id)}}" style="text-decoration: underline; color: #000000;">View</a></td>
															</tr>
                                                            @endforeach
														</tbody>
														
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									
								</div>
							</div>
						</div>
					</div>
		
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {

    const barCharts = document.querySelectorAll('.barChart');

    barCharts.forEach((canvas) => {

      const scores = JSON.parse(canvas.dataset.scores);

      new Chart(canvas, {

        type: 'bar',

        data: {

          labels: ['', '', ''],

          datasets: [{

            label: 'Score',

            data: scores,

            backgroundColor: ['rgba(70, 233, 130, 1)', 'rgba(70, 233, 130, 1)', 'rgba(70, 233, 130, 1)', 'rgba(70, 233, 130, 1)', 'rgba(0, 0, 0, 0.2)'],

            borderColor: ['rgba(70, 233, 130, 1)', 'rgba(17, 18, 18, 1)', 'rgba(17, 18, 18, 1)', 'rgba(17, 18, 18, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(0, 0, 0, 1)'],

            borderWidth: 1

          }, ],

        },

        options: {

          plugins: {

            legend: {

              display: false

            }

          },

          scales: {

            y: {

              beginAtZero: true,

              display: false

            }

          }

        },

        scales: {

          y: {

            ticks: {

              color: '#ffffff'

            },

            beginAtZero: true,

            grid: {

              borderColor: '#ffffff',

              drawOnChartArea: false,

              borderWidth: 1,

              borderBorder: false

            }

          },

          x: {

            ticks: {

              color: '#ffffff'

            },

            grid: {

              drawBorder: false,

              drawOnChartArea: false,

              display: true,

              lineWidth: 5

            }

          }

        }

      });

    });

    // Instantly assign Chart.js version

    const chartVersion = document.getElementById('chartVersion');

    chartVersion.innerText = Chart.version;

  });

</script>
     @if(isset($item['type_value']))
<script>

  const finalData = @json($item['type_value']);

  finalData.forEach((data, index) => {

    const chartCanvas = document.getElementById(`myChart${index + 1}`);

    const config = {

      type: 'line',

      data: {

        labels: data.scores.map((_, i) => `Trail ${i + 1}`),

        datasets: [{

          label: data.procedure_type_name,

          data: data.scores,

          borderWidth: 2,

          borderColor: 'rgba(0, 178, 231, 1)',

          backgroundColor: 'rgba(0, 178, 231, 0.2)',

          fill: true

        }]

      },

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

    new Chart(chartCanvas, config);

  });

  const chartVersion = document.getElementById('chartVersion');

  chartVersion.innerText = Chart.version;

</script>
@endif

@endsection

@section('scripts')
    <script>
   $(document).ready(function () {        
           $(document).on("click", ".filter-report-by-student", function(event) {
                
               var data = {
                   "_token": "{{ csrf_token() }}",
                    institution_id:$("#institution_id").val(),
                    student_id:$("#student_id").val(),
                    from_date:$(".from-date").val(),
                    to_date:$(".to-date").val()
               };
               $.ajax({
                   type: "POST",
                   url: "{{ url('admin/filter/performance-report')}}",
                   data: data,
                   success: function(result) {
                        $(".accordion").hide();
                        $(".card-body1").empty();
                        $(".card-body1").append(result);

                   }
               });
           });
           $(document).on("change", "#institution_id", function(event) {
               var data = {
                   "_token": "{{ csrf_token() }}",
                    id:$(this).val(),
               };
               $.ajax({
                   type: "POST",
                   url: "{{ url('admin/get-student-institution')}}",
                   data: data,
                   success: function(result) {
                        $("#student_id").empty();
                        $("#student_id").append(result);
                       

                   }
               });
           });
       
       
        });
    </script>
@endsection