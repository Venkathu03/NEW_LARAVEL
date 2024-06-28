<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/Ds/logo.png')}}"  alt="logo icon" width="75%">
				</div>
			</div>
			<ul class="metismenu" id="menu">
				<li class="{{ request()->segment(2) == 'dashboard' ? 'mm-active' : '' }}">

					<a href="{{ url('/institution/dashboard')}}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				
				</li>	
                
               <li class="{{ request()->segment(2) == 'institution-student' ? 'mm-active' : '' }}">
					<a href="{{ url('/institution/institution-student')}}" >
						<div class="font-22 text-primary"> <i class="lni lni-consulting" style="color: #000000;"></i></div>
						<div class="menu-title">Student Management</div>
					</a>
					
				</li>

                 <li class="{{ request()->segment(2) == 'students-performance-report' ? 'mm-active' : '' }}">
					<a href="{{ url('/institution/students-performance-report')}}" >
						<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-save" style="color: #000000;"></i></div>
						<div class="menu-title">Reports</div>
					</a>
					
				</li>
                
                <li class="{{ request()->segment(2) == 'settings'}}">
					<a href="{{url('institution/settings')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-slider-alt" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Settings</div>
					</a>
					
				</li>
						
                
                
				
			</ul>
		</div>
	