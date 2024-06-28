<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/Ds/logo.png')}}"  alt="logo icon" width="75%">
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="{{ request()->segment(2) == 'dashboard' ? 'mm-active' : '' }}">

					<a href="{{ url('admin/dashboard') }}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				
				</li>

				<li class="{{ request()->segment(2) == 'masters' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/masters') }}">
						<div class="font-22 text-primary"> <i class="lni lni-graduation" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Masters</div>
					</a>
					
				</li>
				<li class="{{ request()->segment(2) == 'institution' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/institution')}}" >
						<div class="font-22 text-primary"> <i class="lni lni-apartment" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Institution Management</div>
					</a>
					
				</li>
				<li class="{{ request()->segment(2) == 'student' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/student')}}" >
						<div class="font-22 text-primary"> <i class="lni lni-consulting" style="color: #000000;"></i></div>
						<div class="menu-title">Student Management</div>
					</a>
				</li>
				<li class="{{ request()->segment(2) == 'course' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/course')}}" >
						<div class="font-22 text-primary"> <i class="lni lni-graduation" style="color: #000000;"></i></div>
						<div class="menu-title">Course Management</div>
					</a>
					
				</li>
				<li class="{{ request()->segment(2) == 'subscription' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/subscription')}}" >
						<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-wallet-alt" style="color: #000000;"></i></div>
						<div class="menu-title">Subscription Management</div>
					</a>
					
				</li>	
                <li class="{{ request()->segment(2) == 'announcements' ? 'mm-active' : '' }}">
					<a href="{{ url('admin/announcements')}}" >
						<div class="font-22 text-primary"> <i class="lni lni-bullhorn" style="color: #000000;"></i></div>
						<div class="menu-title">Announcements</div>
					</a>
					
				</li>			
				 <li class="{{ request()->segment(2) == 'students-performance-report' ? 'mm-active' : '' }}">
					<a href="{{ url('/admin/performance-report')}}" >
						<div class="font-22 text-primary"> <i class="fadeIn animated bx bx-save" style="color: #000000;"></i></div>
						<div class="menu-title">Reports</div>
					</a>
					
				 </li>
                
                  <li class="{{ request()->segment(2) == 'settings'}}">
					<a href="{{url('admin/profile')}}" >
						<div class="font-22 text-primary">	<i class="fadeIn animated bx bx-slider-alt" style="color: #000000;"></i>
							</div>
						<div class="menu-title">Settings</div>
					</a>
				  </li>
				
			</ul>
			<!--end navigation-->
		</div>
	