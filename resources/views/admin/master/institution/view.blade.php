@extends('admin.layouts.app')
@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md">
								<h4 class="mb-3 mb-md-0">Institution Management</h4>
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
																	<h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">< Government Health care institution, Chennai</h5>
																</div>
																<div style="margin-top: 20px;">
																		
																		<table style="width: 100%;">
																			<tr>
																				<th width="20%">Institution Name</th>
																				<th width="20%">Contact Name</th>
																				<th width="20%">Mobile Number</th>
																				<th width="25%">Email id</th>
																				<th width="25%">Designation</th>
																			</tr>
																			<tr>
																				<td>{{$institution->institution_name}}</td>
																				<td>{{$institution->contact_name}}</td>
																				<td>{{$institution->phone_number}}</td>
																				<td>{{$institution->email}}</td>
																				<td>{{$institution->designation}}</td>
																			</tr>
																		</table>


																	</div>
																
																
															</div>
															
														</div>
														<h6 style="margin-top: 20px; margin-bottom: -10px;">Students Details</h6>
													</div>

												</div>
											</div>
					
										</div>

										
										<div class="card">
											<div class="card-body">
												<div class="table-responsive">
													<table id="example" class="table table-striped table-bordered">
														<thead style="background-color: #E4E4E4;">
															<tr>
																<th>S.No.</th>
																<th>Student Name</th>
																<th>Mobile Number</th>
																<th>Email id</th>
																<th>Course Studying</th>
																<th>Status</th>
															</tr>
														</thead>
														<tbody>
                                                            @foreach($students as $key=>$student)
															<tr>
																<td>{{$key+1}}</td>
																<td>{{$student->fullname}}</td>
																<td>{{$student->phone_number}}</td>
																<td>{{$student->email}}</td>
																<td>{{$student->course->course_name.' - '.IntoString($student->study_year)}}</td>
                                                                @if($student->active_status ==1)
																<td style="color: #43E69DCC;">Active</td>
                                                                @else
                                                                <td style="color: red;">Inactive</td>
                                                                @endif
                                                                
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

@endsection