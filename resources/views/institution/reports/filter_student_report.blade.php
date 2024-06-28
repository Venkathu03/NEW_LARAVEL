
<link href="{{ asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<div class="accordion" id="accordionExample">
    @foreach ($procedures as $procedureIndex =>$item)
<div class="accordion-item">
<h2 class="accordion-header" id="headingOne_{{$procedureIndex}}">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{$procedureIndex}}" aria-expanded="true" aria-controls="collapseOne_{{$procedureIndex}}">
    {{$item['procedure_name']}}
    </button>
</h2>
<div id="collapseOne_{{$procedureIndex}}" class="accordion-collapse collapse @if($procedureIndex == 0) {{'show'}} @endif" aria-labelledby="headingOne_{{$procedureIndex}}" data-bs-parent="#accordionExample">
<div class="accordion-body">	
<div class="row row-cols-1 row-cols-xl-2">
    @php $i=1;@endphp
 @if(isset($item['type_value']))
  @foreach(array_reverse($item['type_value']) as $typeIndex=>$procedure_type)
		<div class="col d-flex">
					<div class="card radius-10 w-100">
						<div class="card-body">
																		<div>
																			<h5 class="mb-1" style="margin-left: 20px">{{$procedure_type['procedure_type_name']}} </h5>
																					
																		</div>
																		<div>
                                                    @if($procedure_type['procedure_type_name']=="Overall Performance")
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
																				<div><h4 style="font-family: Gilroy-SemiBold; font-size: 32px; font-weight: 700; text-align: center;">{{ json_encode($procedure_type['score'][0]).'%' }} </h4></div>
																			</div>
																		</div>  
                                                    @elseif($procedure_type['procedure_type_name'] =="Timetaken / 60s")
                                                                           <div class="row1" style="align-items: center; margin-top: 20px; display: flex; width: 100%;">
																			<div class="col1" style="width: 75%;">
																				<div 
                                                                                     class="chart_student_time_taken1"
                                                                                     data-scores="{{ json_encode($procedure_type['score']) }}"
                                                                                     id="chart_student_time_taken{{ $procedureIndex }}_{{ $typeIndex }}"
                                                                                     
                                                                                     ></div>
																			</div>
																			<div class="col2" style="width: 25%;">
																<div>
                                                                <!-- @foreach($procedure_type['score'] as $scoreIndex=>$score)
                                                            <P style="text-align: center; margin-top: 15px; font-family: Gilroy-Regular;">Trail {{$scoreIndex+1}} </p>
                                                            <h3 style="text-align: center; font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600; margin-top: -10px;">{{$score}} Sec</h3>
                                                                    @endforeach -->
                                                                    @php
                                                                    $colors = ['#42F5BC', '#426CF5', '#DCAA47', '#9942F5']; // Define an array of colors
                                                                @endphp
                                                                @foreach($procedure_type['score'] as $scoreIndex => $score)
                                                                    @php
                                                                        $color = $colors[$scoreIndex % count($colors)]; // Cycle through the colors
                                                                    @endphp
                                                                    <p style="text-align: center; margin-top: 15px; font-family: Gilroy-Regular;font-size:18px; color: {{ $color }};"><strong>Trial {{ $scoreIndex + 1 }}</strong></p>
                                                                    <h3 style="text-align: center; font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600; margin-top: -10px;">{{ $score }} Sec</h3>
                                                                @endforeach
                                                  </div>
																			</div>
																			
																		</div>
                                                                         @else
                                                                        
																			<div class="chartCard">
																			      <div class="chartBox"  >
																			        <canvas class="barChart122" data-scores="{{ json_encode($procedure_type['score']) }}" data-type="{{$procedure_type['procedure_type_name']}}"></canvas>
																			      </div>
																			    </div>

                                                                                  
                                                                                     @endif
																		</div>
																		
																	</div>
																</div>
															</div>
    
     <script>
            var span{{ $procedureIndex }}_{{ $typeIndex }} = document.querySelector("#chart_student_time_taken{{ $procedureIndex }}_{{ $typeIndex }}");
            
            var options{{ $procedureIndex }}_{{ $typeIndex }} = {
                series: JSON.parse(span{{ $procedureIndex }}_{{ $typeIndex }}.dataset.scores),
                chart: {
                    foreColor: '#000000',
                    height: 350,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                                fontColor: '#000000',
                            },
                            value: {
                                fontSize: '16px',
                                fontColor: '#000000',
                            },
                            total: {
                                show: true,
                                label: '',
                                formatter: function (w) {
                                    return ''; // Example formatter
                                }
                            }
                        }
                    }
                },
                colors: ["#42F5BC", "#426CF5", "#DCAA47", "#9942F5", "#4ED3FF"],
                labels: ['Trial 1', 'Trial 2', 'Trial 3', 'Trial 4'],
            };
            
            var chart{{ $procedureIndex }}_{{ $typeIndex }} = new ApexCharts(span{{ $procedureIndex }}_{{ $typeIndex }}, options{{ $procedureIndex }}_{{ $typeIndex }});
            chart{{ $procedureIndex }}_{{ $typeIndex }}.render();
        </script>
                                                             @endforeach
     @else 
                                                                        <p style="text-align:center;margin-left: 180px;">No Record Found</p>
    @endif
														</div>
																	</div>
																</div>
															</div>
    @php $i++;@endphp
                                                            @endforeach
													</div>
					

    
  <script>
      
      $(document).ready(function() {
            var h2 = $(".barChart122");
            var i = 0; // define variable i as your "index"
            $(h2).each(function(index) {
                i++; // Increase i by 1 each time you loop through your h2 elements
                $(this).attr("id", "section" + i); // Use $(this) to pull out the current element

               // $(this).attr("href", "#"); // Again, use $(this)
            });

        });
      
//      $(document).ready(function() {
//            var h2 = $(".chart_student_time_taken1");
//            var i = 0; // define variable i as your "index"
//            $(h2).each(function(index) {
//                i++; // Increase i by 1 each time you loop through your h2 elements
//                $(this).attr("id", "time_taken" + i); // Use $(this) to pull out the current element
//
//               // $(this).attr("href", "#"); // Again, use $(this)
//            });
//
//        });
    
      $( document ).ready(function() {

          $(".barChart122").each(function(){
            const values = $(this).data("scores");
             const backgroundColorHandler = function(value) {
              if (value >= 0 && value <= 20) {
                return 'rgba(217, 244, 226, 1)';
              } else if (value >= 21 && value <= 40) {
                return 'rgba(108, 245, 158, 1)';
              }else if (value >= 41 && value <= 60) {
                return 'rgba(115,245,163, 1)';
              }else if (value >= 61 && value <= 80) {
                return 'rgba(96, 240, 149,1)';
              } else {
                return 'rgba(70,233,130,1)';
              }
            };
        // Define data and options
        const data = {
          labels: ['Trail-1', 'Trail-2', 'Trail-3', 'Trail-4'],
          datasets: [{
            label: $(this).data("type"),
            data: values,
            borderWidth: 0,
          }, {
            label: '',
            data: [{
              x: 'Trail-1',
              y: 0
            }, {
              x: 'Trail-2',
              y: 0
            }],
            backgroundColor: backgroundColorHandler(values[0]), // Apply the background color handler
            borderColor: 'rgba(70, 233, 130, 1)',
            borderWidth: 0,
            fill: 0,
            radius: 0,
          }, {
            label: '',
            data: [{
              x: 'Trail-2',
              y: 0
            }, {
              x: 'Trail-3',
              y: 0
            }],
            backgroundColor: backgroundColorHandler(values[1]), // Apply the background color handler
            borderColor: 'rgba(115, 245, 163, 1)',
            borderWidth: 0,
            fill: 0,
            radius: 0,
          }, {
            label: 'Monthly Sales',
            data: [{
              x: 'Trail-3',
              y: 0
            }, {
              x: 'Trail-4',
              y: 0
            }],
            backgroundColor: backgroundColorHandler(values[2]), // Apply the background color handler
            borderColor: 'rgba(157, 235, 184, 1)',
            borderWidth: 0,
            fill: 0,
            radius: 0,
          }, {
            label: 'Monthly Sales',
            data: [{
              x: 'Trail-4',
              y: 0
            }],
            backgroundColor: backgroundColorHandler(values[3]), // Apply the background color handler
            borderColor: 'rgba(70, 233, 130, 1)',
            borderWidth: 0,
            fill: 0,
            radius: 0,
          }, ],
        };
        // Define chart options
        const options = {
          plugins: {
            legend: {
              display: false,
            },
          },
          scales: {
            y: {
              ticks: {
                color: '#ffffff'
              },
              beginAtZero: true,
              grid: {
                display: false
              }
            }
          },
        };
        // Render the chart
        const ctx = document.getElementById($(this).attr("id")).getContext('2d');
            const myChart = new Chart(ctx, {
              type: 'line',
              data: data,
              options: options,
            });
          
        });
          
          

          
        });
      </script>





<!-- Bootstrap JS -->
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/institution/apexcharts.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/institution/apex-custom.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	
	
	<script src="{{ asset('assets/js/index.js')}}"></script>
	<script src="{{ asset('assets/js/index2.js')}}"></script>
	<script src="{{ asset('assets/js/table-datatable.js')}}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js')}}"></script>
	<script src="{{ asset('assets/js/progressbar.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

	<script src="{{ asset('assets/js/circle.js')}}"></script>

  



