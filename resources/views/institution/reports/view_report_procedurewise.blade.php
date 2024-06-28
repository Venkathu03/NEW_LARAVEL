@extends('institution.layouts.app')
@section('institution-content')

<style>
	.header {
		justify-content: space-between;
        align-items: center;
	}

	.dwn_report_pro {
		padding: 10px;
		border-radius: 5px;
		border: 1px solid gray;
		background: none;
		
	}

    .back_btn {
        padding: 5px 5px 5px 5px;
        border-radius: 5px;
        border: none;
        background: linear-gradient(270deg, #0AACD5 0%, #17B4A9 58.12%, #24BC7D 100%);
    }




</style>

				<div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md-3">
								<h4 class="mb-3 mb-md-0">Report</h4>
							</div>
							<div class="col-md-9">
								<h4 class="mb-3 mb-md-0" style="font-size: 16px; font-family: Gilroy-Regular; font-weight: 400; float: right;">>Reports>>{{ $student_detail->fullname }}</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
								<div class="tab-content py-3">
									
										<div class="row row-cols-1">
											<div class="col d-flex">
												<div class="card radius-10 w-100" style="margin-bottom: 0px;">
													<div class="card-body">
														<div>
															<div class="row" style="align-items: center;">
																<div class="col">
                                                                    <button class="back_btn"><a href="{{ url('institution/students-performance-report')}}" style="text-decoration: none; color: #000000;"> Go Back</a></button>
																	<h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">{{ $student_detail->fullname }}</h5>
																	<div style="margin-top: 20px;">
																		<h5 style="font-size: 18px; font-weight: 500; font-family: Gilroy-SemiBold;">Student Information</h5>
																		<table style="width: 100%;">
																			<tr>
																				<th width="20%">Student Name</th>
																				<th width="20%">Course & year of Studying</th>
																				<th width="20%"></th>
																				<th width="20%"></th>
																				<th width="20%"></th>
																			</tr>
																			<tr>
																				<td>{{$student_detail->fullname}}</td>
																				<td>{{$student_detail->course->course_name}} & {{$student_detail->study_year}}</td>
																				<td></td>																				<td></td>
																				<td></td>
																				<td></td>
																			</tr>
																		</table>


																	</div>
																	
																</div>
																
																
															</div>
															
														</div>
														
														
													</div>

												</div>
											</div>
					
										</div>

										
										<div class="card">
											<div class="card-body">
                                            <div class="d-flex header">
												<div>
													<h6>Procedure Report</h6>
												</div>
												<div class="mb-2">
													<button class="btn btn-primary month-filter" id="dwn_report_pro"> Download Report </button>
												</div>
												</div>
												<div class="table-responsive">
													<table id="example" class="table table-striped table-bordered">
    <thead style="background-color: #E4E4E4;">
        <tr>
            <th>S.No.</th>
            <th>Month</th>
            <th>Procedure</th>
            <th>Procedure Type</th>
            <th>Overall Score</th>
            <th>No.of Trials</th>
            <th>Time Taken</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mark_lists as $key => $mark)
            <tr>
                <td>{{ $key + 1 }}</td>
				@if($key == 0 || $mark_lists[$key-1]['month'] != $mark['month'] || $key % $mark['type_count'] == 0)
                    <td>{{ $mark['month'] }}</td>
                @else
                    <td></td> <!-- Empty cell for procedure name -->
                @endif
                @if($key == 0 || $mark_lists[$key-1]['procedure_name'] != $mark['procedure_name'] || $key % $mark['type_count'] == 0)
                    <td>{{ $mark['procedure_name'] }}</td>
                @else
                    <td></td> <!-- Empty cell for procedure name -->
                @endif
                <td>{{ $mark['procedure_type_name'] }}</td>
                <td>{{ $mark['score'] }}</td>
                @if($key == 0 || $mark_lists[$key-1]['trail'] != $mark['trail'])
                    <td>{{ $mark['trail'] }}</td>
                @else
                    <td></td> <!-- Empty cell for trail -->
                @endif
                <td>
                    @if($mark['procedure_type_name'] == "Timetaken / 60s")
                        {{ $mark['score'].'min' }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

												</div>
											</div>
										</div>
									
									
								</div>
							</div>
                            <script>
document.querySelector('#dwn_report_pro').addEventListener('click', function () {
    // Get the table data
    var table = document.getElementById('example');
    var workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });

    // Generate Excel file
    XLSX.writeFile(workbook, 'Report_for_{{$mark['procedure_name']}}_{{ $student_detail->fullname }}.xlsx');
});
</script>

@endsection