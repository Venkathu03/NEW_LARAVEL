@extends('student.layouts.app')
@section('student-content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

    <div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md">
								<h4 class="mb-3 mb-md-0">{{$procedure_name}}</h4>
							</div>
							
						</div>
					</div>
				</div>
				
   <div class="row row-cols-1 row-cols-xl-2">
    @if($overall_performance > 0)
      <div class="col d-flex">
         <div class="card radius-10 w-100">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <h5 class="mb-1" style="margin-left: 30px">Over all Performance</h5>
                  </div>
               </div>
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
                     <div>
                        <p style="font-family: Gilroy-Regular; font-size: 16px; font-weight: 400; text-align: center;">Your Over all Performance is Average </p>
                     </div>
                     <div>
                        <h4 style="font-family: Gilroy-SemiBold; font-size: 32px; font-weight: 700; text-align: center;">{{$overall_performance.'%'}}</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
        @endif
       @if(json_encode($time_taken_details[3]) > 0)

					<div class="col d-flex">
																<div class="card radius-10 w-100">
																	<div class="card-body">
																		<div class="d-flex align-items-center">
																			<div>
																				<h5 class="mb-1" style="margin-left: 20px">Time Taken</h5>
																				
																			</div>
																			
																		</div>
																		<div class="row row-cols-1 row-cols-sm-2" style="align-items: center; margin-top: 20px;">
																			<div class="col1"  style="width: 78%;">
																				 <div id="chart13" data-scores="{{ json_encode($time_taken_details)}}"></div>
																			</div>
																			<div class="col2" style="width: 22%;">
																				<div class="trail " >
																					 @foreach($time_taken_details as $index=>$score)
                                                            <P style="text-align: center; margin-top: 15px; font-family: Gilroy-Regular;">Trail {{$index+1}} </p>
                                                            <h3 style="text-align: center; font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600; margin-top: -10px;">{{$score}} Sec</h3>
                                                                    @endforeach
																				</div>
																			</div>
																			
																		</div>
																		
																	</div>
																</div>
															</div>
       @endif
   </div>
   <!--end row-->
   <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
       
       @foreach ($other_procedure_types as $index => $data)
              
     
      <div class="col">
         <div class="card radius-10">
            <div class="card-body">
               <div class="d-flex align-items-center">
                  <div>
                     <h5>{{$data['procedure_type_name']}}</h5>
                  </div>
               </div>
               <div class="chartBox" style="padding:0px;width:100%;">
                    <canvas id="myChart{{ $index + 1 }}"></canvas>
               </div>
            </div>
         </div>
      </div>
         @endforeach
       
       
       
   <script>
        const finalData = @json($other_procedure_types);
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
   </div>
  
@endsection