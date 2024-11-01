<div class="app-header header sticky">
	<div class="container-fluid main-container">
		<div class="d-flex">
			<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
				href="javascript:void(0)"></a>
			<!-- sidebar-toggle-->
			<a class="logo-horizontal" href="{{url('index')}}">
				<img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img main-logo"
					alt="ENH logo">
				<img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img darklogo"
					alt="ENH logo">
			</a>
			<!-- LOGO -->
			
			<div class="d-flex order-lg-2 ms-auto header-right-icons">
				
				
				<div class="navbar navbar-collapse responsive-navbar p-0">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2">
							
							<!-- COUNTRY -->
							<!-- <div class="d-flex country">
								<a class="nav-link icon theme-layout nav-link-bg layout-setting">
									<span class="dark-layout mt-1"><i class="ri-moon-clear-line"></i></span>
									<span class="light-layout mt-1"><i class="ri-sun-line"></i></span>
								</a>
							</div> -->
							<!-- Theme-Layout -->
							
							<!-- <div class="dropdown d-flex">
								<a class="nav-link icon full-screen-link" id="fullscreen-button">
									<i class="ri-fullscreen-exit-line fullscreen-button"></i>
								</a>
							</div> -->
							
							<!-- NOTIFICATIONS -->
							
							<!-- SIDE-MENU -->
							<div class="dropdown d-flex profile-1">
								<a href="javascript:void(0)" data-bs-toggle="dropdown"
									class="nav-link leading-none d-flex">
									<img src="{{asset('build/assets/images/users/male/15.jpg')}}" alt="profile-user"
										class="avatar  profile-user brround cover-image">
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
									data-bs-popper="none">
									<div class="drop-heading">
										<div class="text-center">
											<h5 class="text-dark mb-0 fw-semibold">Alison</h5>
											<span class="text-muted fs-12">Administrator</span>
										</div>
									</div>
									<a class="dropdown-item text-dark fw-semibold border-top" href="javascript:void(0)">
										<i class="dropdown-icon fe fe-user"></i> Profile
									</a>
									<a class="dropdown-item text-dark fw-semibold" href="javascript:void(0)">
										<i class="dropdown-icon fe fe-mail"></i> Inbox
										<span class="badge bg-success float-end">3</span>
									</a>
									<a class="dropdown-item text-dark fw-semibold" href="javascript:void(0)">
										<i class="dropdown-icon fe fe-settings"></i> Settings
									</a>
									<a class="dropdown-item text-dark fw-semibold" href="javascript:void(0)">
										<i class="dropdown-icon fe fe-alert-triangle"></i>
										Support ?
									</a>
									<a class="dropdown-item text-dark fw-semibold" href="{{ route('logout') }}">
										<i class="dropdown-icon fe fe-log-out"></i> Sign out
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