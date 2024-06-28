<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<!-- <h6>Welcome, Ken Adams</h6> -->
						</div>
					</div>
					<div class="top-menu ms-auto blured">
						
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             @if(!is_null(auth('institution')->user()->image))
								<img src="{{asset('setting/'.auth('institution')->user()->image)}}" class="user-img" alt="user avatar">
                            @else
                                <img src="{{ asset('assets/images/avatars/user.jpg')}}" class="user-img" alt="user avatar">
                            @endif
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{ auth('institution')->user()->institution_name}}</p>
								<!-- <p class="designattion mb-0">Web Designer</p> -->
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
                            
							<li><a class="dropdown-item" href="{{ route('institution.logout.submit') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                                <form id="logout-form" action="{{ route('institution.logout.submit') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>