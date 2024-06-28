@if(count($top_students) > 0)
    @php $i = 1; @endphp
@foreach($top_students as $key=>$student)
								<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
									
									<div class="col-sm-6">
										<div class="d-flex align-items-center">
											<div class="ms-2">
												
												<p class="mb-0" style="padding: 10px 20px; border: 1px solid #40D5F9; border-radius: 20px; margin-top: 10px;">#{{$i}}</p>
											</div>
											<div class="product-img">
                                                @if(!is_null($student->avatar))
												<img src="{{asset('setting/'.$student->avatar)}}>">
                                                @else
                                                <img src="{{ asset('assets/images/avatars/user.jpg')}}">
                                                @endif
											</div>
											<div class="ms-2">
												<h6 class="mb-1" style="font-size: 14px; font-family: Gilroy-SemiBold;">{{$student->fullname}}</h6>
											</div>

										</div>
									</div>
									<div class="col-sm" style="width: 100%; display: flex;">
										<div style=" width: 50%; text-align: center; margin-top: auto; margin-bottom: auto;">
												<p class="mb-0"></p>
											</div>
										<div style=" width: 50%; text-align: center; margin-top: auto; margin-bottom: auto;">
												<p class="mb-0" style="float: right; font-family: Gilroy-SemiBold; font-size: 32px;">{{round($student->score).'%'}}</p>
											</div>
									</div>
									
								</div>
                                 
    @php $i++; @endphp
@endforeach

@else
<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
	<p style="text-align:center;">No Record Found</p>								
</div>


@endif