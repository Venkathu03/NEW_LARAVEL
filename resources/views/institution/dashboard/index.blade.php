@extends('institution.layouts.app')

@section('institution-content')
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

<div class="row row-cols-1 row-cols-md-2">
	<div class="col">
		<div class="card radius-10" style="border-radius: 50px; border-top: 15px solid #a4fcd7; border-color: #a4fcd7;">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<p class="mb-0" style="font-size: 14px; font-family: Gilroy-Regular; color: #5F6564;">Total
							Students</p>
							<div class="font-22 ms-auto">
						<select class="form-select filter-by-year-tot">
							<option value="">All</option>
							@foreach($batch_year as $year)
								<option value="{{ $year }}">{{ $year }}</option>
								@endforeach
						</select>
					</div>
					<div class="total">
						<h5 class="mb-0"
							style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;text-align: center;">
							{{$total_student}}
						</h5>
</div>
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
						<p class="mb-0" style="font-size: 14px; font-family: Gilroy-Regular; color: #5F6564;">Average
							Score</p>
						<!-- <h5 class="mb-0"
								style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;text-align: center;"> {{$total_performance}}
							</h5> -->
						<div class="average">
							<h5 class="mb-0"
								style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 30px;text-align: center;">
								{{$total_performance}}
							</h5>
						</div>

					</div>
					<div class="font-22 ms-auto">
						<select class="form-select filter-by-year">
							<option value="">All</option>
							@foreach($batch_year as $year)
								<option value="{{ $year }}">{{ $year }}</option>
								@endforeach
						</select>
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
		<div class="card radius-10 w-100" style="flex: 0 0 auto; !important">

			<div class="card-body" style="flex: 0 0 auto;">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-1">Performance Insights</h5>

					</div>
					<div class="font-22 ms-auto">
						<select class="form-select filter-by-procedure">
							<option value="">All</option>
							@foreach($procedures as $procedure)
								<option value="{{$procedure->id}}">{{$procedure->procedure_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>


			<div class="d-flex align-items-center" style="column-gap: 20px;">
				<div>
					<div class="col-12" style=" margin-left: 20px;">
						<button type="submit" class="btn btn-primary" style="padding: 10px 10px;">Top 5
							Students</button>
					</div>

				</div>


			</div>

			<div class="product-list p-3 mb-3">

				@php $i = 1; @endphp
				@foreach($top_students as $key => $student)
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">

						<div class="col-sm-6">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0"
										style="padding: 10px 20px; border: 1px solid #40D5F9; border-radius: 20px; margin-top: 10px;">
										#{{$i}}</p>
								</div>
								<div class="product-img">
									@if(!is_null($student->avatar))
										<img src="{{asset('setting/' . $student->avatar)}}>">
									@else
										<img src="{{ asset('assets/images/avatars/user.jpg')}}">
									@endif
								</div>
								<div class="ms-2">
									<h6 class="mb-1" style="font-size: 14px; font-family: Gilroy-SemiBold;">
										{{$student->fullname}}
									</h6>
								</div>

							</div>
						</div>
						<div class="col-sm" style="width: 100%; display: flex;">
							<div style=" width: 50%; text-align: center; margin-top: auto; margin-bottom: auto;">
								<p class="mb-0"></p>
							</div>
							<div style=" width: 50%; text-align: center; margin-top: auto; margin-bottom: auto;">
								<p class="mb-0" style="float: right; font-family: Gilroy-SemiBold; font-size: 32px;">
									{{round($student->score) . '%'}}
								</p>
							</div>
						</div>

					</div>
					@php $i++; @endphp
				@endforeach
			</div>
		</div>
	</div>
	<div class="col d-flex">
		<div class="card radius-10 w-100">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-1">Students Insights For All Procedures</h5>

					</div>

				</div>

				<div class="row row-cols-1 row-cols-sm-2" style="align-items: center; margin-top: 60px;">
					<div class="col">
						<div class="containerprogress">
							<div class="font-22 ms-auto">
								<select class="form-select filter-by-year-progress">
									<option value="">All</option>
									@foreach($batch_year as $year)
								<option value="{{ $year }}">{{ $year }}</option>
								@endforeach
								</select>
							</div>
							<div class="student_insights progress-container">
								@foreach($procedure_types as $proce_type)
									<div class="progress-container">
										<h6>{{ $proce_type->procedure_type_name }}</h6>
										<div class="progress-bar">
											@if($proce_type->procedure_type_name == "Timetaken / 60s")
												<span data-value="{{ $proce_type->avg . 'min ' }}"
													data-width="{{ $proce_type->avg /15 *100 . '%' }}"></span>
											@else
												<span data-value="{{ $proce_type->avg . '%' }}"
													data-width="{{ $proce_type->avg . '%' }}"></span>
											@endif
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col">
						<div>
							<div id="radialBarChart"></div>
							<div>
								<h6 style="text-align: center;">Overall Percentage</h6>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<!--end row-->


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
	document.addEventListener('DOMContentLoaded', function () {
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
		$(document).on("change", ".filter-by-procedure", function (event) {
			var data = {
				"_token": "{{ csrf_token() }}",
				id: $(this).val()
			};
			console.log("Procedure Data" + data);
			$.ajax({
				type: 'POST',
				url: "{{ url('institution/filter-by-procedure')}}",
				data: data,
				success: function (response) {
					$(".product-list").html("");
					$(".product-list").append(response);
				},
				error: function (xhr, status, error) {
					console.error(error);
				}
			});
		});
	});

</script>

<script>
	$(document).ready(function () {
    $(document).on("change", ".filter-by-year-progress", function (event) {
        var batchValue = $(this).val();
        console.log("Selected Batch Value: ", batchValue);

        var data = {
            "_token": "{{ csrf_token() }}",
            batch: batchValue
        };

        console.log("Procedure Data: ", data);

        $.ajax({
            type: 'POST',
            url: "{{ url('institution/filter-by-year-progress') }}",
            data: data,
            success: function (response) {
                console.log("Server Response: ", response);
                var studentInsights = $(".student_insights");
                console.log("Found .student_insights element:", studentInsights.length);

                if (studentInsights.length && response.procedure_types) {
                    studentInsights.html(""); // Clear existing content

                    // Iterate over procedure types and append them to studentInsights
                    response.procedure_types.forEach(function (procedure) {
                        var progressContainer = $("<div>").addClass("progress-container");
                        var h6 = $("<h6>").text(procedure.procedure_type_name);
                        var progressBar = $("<div>").addClass("progress-bar");

                        var span = $("<span>");

                        // Check if the procedure type is "Timetaken / 60s"
                        if (procedure.procedure_type_name === "Timetaken / 60s") {
                            // Calculate the width of the progress bar for 30 minutes
                            var progressWidth = (procedure.avg / 15) * 100 + "%";
                            span.text(procedure.avg + "mins");
                        } else {
                            // For other procedure types, calculate the width based on percentage
                            var progressWidth = procedure.avg + "%";
                            span.text(procedure.avg + "%");
                        }

                        span.css("width", progressWidth);

                        progressBar.append(span);
                        progressContainer.append(h6, progressBar);
                        studentInsights.append(progressContainer);
                    });
                } else {
                    console.error(".student_insights element not found in the DOM or response does not contain procedure types");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", error);
                console.log("Status: ", status);
                console.log("XHR Object: ", xhr);
            }
        });
    });
});


</script>





<script>
	$(document).ready(function () {
		$(document).on("change", ".filter-by-year", function (event) {
			var batchValue = $(this).val();
			console.log("Selected Batch Value: ", batchValue); // Log the batch value for debugging

			var data = {
				"_token": "{{ csrf_token() }}",
				batch: batchValue
			};

			console.log("Data to be sent: ", data); // Log the data for debugging

			$.ajax({
				type: 'POST',
				url: "{{ url('institution/filter-by-year') }}",
				data: data,
				success: function (response) {
					console.log("AJAX Success Response: ", response); // Log the response for debugging
					$(".average").html(""); // Clear the current content
					if (response.total_performances !== null) {
						$(".average").append('<h5 class="mb-0" style="font-size: 30px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">' + response.total_performances + '</h5>');
					} else {
						$(".average").append('<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">N/A</h5>');
					}
				},
				error: function (xhr, status, error) {
					console.error("AJAX error: ", error); // Log the error for debugging
					$(".average").html('<h5 class="mb-0" style="font-size: 30px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">Error</h5>');
				}
			});
		});
	});


</script>

<script>
	$(document).ready(function () {
		$(document).on("change", ".filter-by-year-tot", function (event) {
			var batchValue = $(this).val();
			console.log("Selected Batch Value: ", batchValue); // Log the batch value for debugging

			var data = {
				"_token": "{{ csrf_token() }}",
				batch: batchValue
			};

			console.log("Data to be sent: ", data); // Log the data for debugging

			$.ajax({
				type: 'POST',
				url: "{{ url('institution/filter-by-year-tot') }}",
				data: data,
				success: function (response) {
					console.log("AJAX Success Response: ", response); // Log the response for debugging
					$(".total").html(""); // Clear the current content
					if (response.total_performances !== null) {
						$(".total").append('<h5 class="mb-0" style="font-size: 30px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">' + response.total_performances + '</h5>');
					} else {
						$(".total").append('<h5 class="mb-0" style="font-size: 32px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">N/A</h5>');
					}
				},
				error: function (xhr, status, error) {
					console.error("AJAX error: ", error); // Log the error for debugging
					$(".total").html('<h5 class="mb-0" style="font-size: 30px; font-family: Gilroy-SemiBold; padding-top: 15px;text-align: center;">Error</h5>');
				}
			});
		});
	});


</script>

@endsection
