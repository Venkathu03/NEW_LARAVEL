@extends('student.layouts.app')
@section('student-content')
<style>
    .announcement-div {
        border: 1px solid #E4E4E4;
        background: #F8F8F8;
        border-radius: 12px !important;
        margin-top: 10px; 
    }
    
     .announcement-table {
            border-collapse:separate;
            border-spacing:0 15px;
        }
    
/*
    .announcement-table {
      border: solid 1px #000;
      border-style: none solid solid none;
      padding: 10px;
    }
*/
    
    
    


</style>

<div class="card shadow-none bg-transparent border-bottom border-2">
	<div class="card-body">
		<div class="row align-items-center">
			<div class="col-md">
				<h4 class="mb-3 mb-md-0">Medisim VR</h4>
			</div>

		</div>
	</div>
</div>

<!--end row-->
<div class="row">
	<div class="col-xl-4">
		<div class="card radius-10 overflow-scroll">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-0">Tweets</h5>
					</div>
					<div class="ms-auto"><a href="javascript:;" style="color:#0dcaf0;font-weight:bold;">View all</a>
					</div>
				</div>
				<div class="product-list p-3 mb-3" style="height: 800px!important;">
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> 
                                
                                <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>

					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>
					<div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer" style="align-items: center">

						<div class="ms-2">
							<h6 class="mb-1" style=" font-size: 18px; font-family: Gilroy-SemiBold; font-weight: 600;margin-top: 10px;">Blood Transfusion</h6>
							<p class="mb-0" style="margin-top: 10px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 400;">The symbiosis of medicine and technology is a large industry that links medical practitioners with cutting-edge technology, helping improve every aspect of healthcare.</p>
						</div>

						<div class="col-sm-6" style="width: 60%!important; margin-top: 10px;">
							<div class="d-flex align-items-center">
								<div class="ms-2">

									<p class="mb-0" style="margin-top: 5px; font-size: 14px; font-family: Gilroy-Regular; font-weight: 550;">Posted on 25.10.2023 06:00 Pm</p>
								</div>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">

							<div class="font-22 text-primary" style="float: right;"> <i class="lni lni-heart" style="color: #000000;"></i>
							</div>
						</div>
						<div class="col-sm" style="width: 20%; margin-top: 10px;">
							<div class="font-22 text-primary"> <i class="lni lni-popup" style=" color: #000000; float: right;"></i>
							</div>

						</div>
					</div>

				</div>
			</div>

		</div>

	</div>
	<div class="col-xl-8 d-flex">
		<div class="card radius-10 w-100">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-1">Announcements</h5>
						<p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>25-05-2023</p>
					</div>
					<div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
					</div>
				</div>
				<div class="table-responsive mt-4">
					<table class="table align-middle mb-0 table-hover announcement-table" id="Transaction-History">

						<tbody>
							<tr class="announcement-div">
								<td class="announcement-td">
									<div class="d-flex align-items-center" style="margin: 10px 10px;">
										<div class="">
											<img src="/assets/images/Ds/rec.png" class="rounded-circle" width="46" height="46" alt="" />
										</div>
										<div class="ms-2" style="padding-left: 20px;">
											<h6 class="mb-1 font-14" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Blood Transfusion - Collaborative Training</h6>
											<p class="mb-0 font-13 text-secondary">Procedure Proper</p>
											<p class="mb-0 font-13 text-secondary">Room 01</p>
										</div>
									</div>
								</td>
								<td>
									<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-right-arrow-alt" style="color: #000000;"></i>
									</div>
								</td>

							</tr>
                            <div></div>
							<tr class="announcement-div">
								<td class="announcement-td">
									<div class="d-flex align-items-center" style="margin: 10px 10px;">
										<div class="">
											<img src="/assets/images/Ds/rec.png" class="rounded-circle" width="46" height="46" alt="" />
										</div>
										<div class="ms-2" style="padding-left: 20px;">
											<h6 class="mb-1 font-14" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Blood Transfusion - Collaborative Training</h6>
											<p class="mb-0 font-13 text-secondary">Procedure Proper</p>
											<p class="mb-0 font-13 text-secondary">Room 01</p>
										</div>
									</div>
								</td>
								<td>
									<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-right-arrow-alt" style="color: #000000;"></i>
									</div>
								</td>

							</tr>
							<tr class="announcement-div">
								<td class="announcement-td">
									<div class="d-flex align-items-center" style="margin: 10px 10px;">
										<div class="">
											<img src="/assets/images/Ds/rec.png" class="rounded-circle" width="46" height="46" alt="" />
										</div>
										<div class="ms-2" style="padding-left: 20px;">
											<h6 class="mb-1 font-14" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Blood Transfusion - Collaborative Training</h6>
											<p class="mb-0 font-13 text-secondary">Procedure Proper</p>
											<p class="mb-0 font-13 text-secondary">Room 01</p>
										</div>
									</div>
								</td>
								<td>
									<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-right-arrow-alt" style="color: #000000;"></i>
									</div>
								</td>

							</tr>
							<tr class="announcement-div">
								<td >
									<div class="d-flex align-items-center" style="margin: 10px 10px;">
										<div class="">
											<img src="/assets/images/Ds/rec.png" class="rounded-circle" width="46" height="46" alt="" />
										</div>
										<div class="ms-2" style="padding-left: 20px;">
											<h6 class="mb-1 font-14" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Blood Transfusion - Collaborative Training</h6>
											<p class="mb-0 font-13 text-secondary">Procedure Proper</p>
											<p class="mb-0 font-13 text-secondary">Room 01</p>
										</div>
									</div>
								</td>
								<td>
									<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-right-arrow-alt" style="color: #000000;"></i>
									</div>
								</td>

							</tr>

						</tbody>
					</table>
				</div>
			</div>

			<div class="card radius-10 overflow-hidden">
				<!--<div class="card-body">-->
				<div class="d-flex align-items-center">
					<div>
						<h5 class="mb-0" style="margin-top: 10px; margin-left: 10px;">Videos</h5>
					</div>
					<div class="ms-auto"><a href="javascript:;" class="btn btn-sm btn-outline-secondary" style="color: #40D4FF; border: none;">See all</a>
					</div>
				</div>
				<div class="chat-list" style="overflow: scroll;">
					<div class="list-group list-group-flush">
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
						<a href="javascript:;" class="list-group-item">
							<div class="d-flex">
								<div>
									<img src="/assets/images/Ds/videos.png" width="100" height="100" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2" style="margin-left: 30px!important;">
									<h6 class="mb-0 chat-title" style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Intradermal Injection Administration </h6>
									<p class="mb-0 chat-msg" style="font-size: 16px; font-weight: 500; font-family: Gilroy-Regular; margin-top: 10px;">5 mints</p>
									<div style="display: flex; width: 100%; margin-top: 10px;">
										<div style="width: 50%;"><button class="button-video"><i class="fadeIn animated bx bx-caret-right-circle"></i>Play Video</button></div>

										<div style="width: 50%;"><i class="lni lni-heart" style="color: #000000; float: right; margin-right: -10px;margin-top: 10px;"></i>
										</div>
									</div>
								</div>
								<div class="chat-time"><i class="fadeIn animated bx bx-dots-vertical-rounded"></i></div>

							</div>
						</a>
					</div>
				</div>
			</div>

		</div>


	</div>

</div>
</div>

</div>
</div>

@endsection