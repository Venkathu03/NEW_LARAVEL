
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">


<!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script src="{{ asset('assets/js/table-datatable.js')}}"></script>

<table id="example2" class="table table-striped table-bordered">
																<thead style="background-color: #E4E4E4;">
															<tr>
																<th>S.No.</th>
																<th>Student Name</th>
																<th>Student Id</th>
																<th>Batch Year</th>
																<th>Mobile Number</th>
																<th>Course Studying</th>
																<th>Month</th>
																<th>Average Score</th>
																<th>Action</th>
															</tr>
														</thead>
														<tbody>
                                                            @foreach($current_month_report as $key=>$student)
															<tr>
																<td>{{$key+1}}</td>
																<td>{{$student->student_name}}</td>
																<td>{{$student->id}}</td>
																<td>{{$student->batch_year}}</td>
																<td>{{$student->mobile}}</td>
																<td>{{$student->course_name}}</td>
																<td>{{$student->month}}</td>
																<td>{{ $student->avg}}</td>
																<td><a href="{{url('institution/view/month-report/'.$student->id. '/' .$student->month)}}" style="text-decoration: underline; color: #000000;">View</a></td>
															</tr>
															@endforeach
														</tbody>
														
</table>
