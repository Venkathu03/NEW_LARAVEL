
  
    <div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/Ds/logo.png')}}"  alt="logo icon" width="75%">
				</div>
			</div>
        @if(auth('student')->user()->is_payment_done =="yes") 
			<ul class="metismenu" id="menu">
				<li class="{{ request()->segment(2) == 'dashboard' ? 'mm-active' : '' }}">

					<a href="{{url('student/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				
				</li>

                
                <li class="{{ request()->segment(2) == 'procedures' ||  request()->segment(2) == 'procedure'  ? 'mm-active' : '' }}">
					<a href="{{url('student/procedures')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-save" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Procedure Report</div>
					</a>
					
				</li>
                
<!--
                <li class="{{ request()->segment(2) == 'about' ||  request()->segment(2) == 'about'  ? 'mm-active' : '' }}">
					<a href="{{url('student/about')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-info-circle" style="color: #000000;"></i>
							</div>
						<div class="menu-title">About MedisimVR</div>
					</a>
					
				</li>

				<li class="{{ request()->segment(2) == 'learning-material' ||  request()->segment(2) == 'learning-material'  ? 'mm-active' : '' }}">
					<a href="{{url('student/learning-material')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-book-reader" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Learning Material & Videos</div>
					</a>
					
				</li>
-->
                
                <li class="{{ request()->segment(2) == 'settings'}}">
					<a href="{{url('student/settings')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-slider-alt" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Settings</div>
					</a>
					
				</li>
							
			</ul>
        @endif		
</div>
