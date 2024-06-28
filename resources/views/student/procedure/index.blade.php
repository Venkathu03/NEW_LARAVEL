@extends('student.layouts.app')
@section('student-content')
				<div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md">
								<h4 class="mb-3 mb-md-0">Procedure</h4>
							</div>
							
						</div>
					</div>
				</div>
				<!--end row-->
				
				<div class="row row-cols-1 row-cols-xl-2">

					
					<div class="col d-flex" style="width: 100%;">
						<div class="card radius-10 w-100">

							<div class="product-list p-3 mb-3" style="height:400px;overflow:scroll;">
                                @foreach($procedures as $procedure)
								<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">
                                        <div  class="col-sm-6" style="width: 50%!important;">
											<a href="{{url('student/procedure/view/'.$procedure->id)}}">
												<div class="d-flex align-items-center">
													<div class="product-img">
														<img src="{{ asset('procedure/'.$procedure['procedure_image'])}}" alt="" />
													</div>
													<div class="ms-2">
														<h6 class="mb-1">{{ $procedure['procedure_name']}}</h6>
														
													</div>
												</div>
											</a>
										</div>
										<div class="col-sm" style="width: 40%; align-content: center!important;">
											<p style="float: right; margin-bottom: -10px; padding-right: 20px;"><i class="arrow right"></i></p>
											
										</div>
				                </div>
                                
                                @endforeach
									
							</div>
						</div>
					</div>
				</div>
				<div><h5>Recent Trials</h5></div>
				<!--end row-->
				
				<!--end row-->
				
				<!--end row-->
				<div class="row">
					
					<div class="col-12 col-xl-6 d-flex" style="width: 100%;">
						<div class="card radius-10 w-100">
							<div class="card-body">
								
											<table class="table mb-0">
												<thead>
													<tr>
														<th scope="col">S.No.</th>
														<th scope="col">Procedure</th>
														<th scope="col">Date/Time</th>
														<th scope="col">Average</th>
													</tr>
												</thead>
												<tbody>
													@foreach($recent_trials as $key=> $trial)
                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td>{{$trial->procedure_name}}</td>
                                                    <td>{{$trial->created_at}}</td>
                                                    <td>{{$trial->score}}%</td>
                                                </tr>
                                                @endforeach
												</tbody>
											</table>
						</div>
					</div>
				</div>
		
	</div>

@endsection