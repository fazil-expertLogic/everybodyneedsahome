
				<div class="sticky">
					<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
					<div class="app-sidebar">
						<div class="side-header">
							<a class="header-brand1" href="{{route('dashboard')}}">
								<img src="{{asset('build/assets/images/brand/logo1.png')}}" class="header-brand-img main-logo"
									alt="Sparic logo">
								<img src="{{asset('build/assets/images/brand/logo-light.png')}}" class="header-brand-img darklogo"
									alt="Sparic logo">
								<img src="{{asset('build/assets/images/brand/icon.png')}}" class="header-brand-img icon-logo"
									alt="Sparic logo">
								<img src="{{asset('build/assets/images/brand/icon2.png')}}" class="header-brand-img icon-logo2"
									alt="Sparic logo">
							</a>
						</div>
						<!-- logo-->
						<div class="main-sidemenu">
							<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
									fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
									<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
								</svg></div>
							<ul class="side-menu">
								<li class="sub-category">
									<h3>Main</h3>
								</li>
								<li class="slide">
									<a class="side-menu__item has-link" data-bs-toggle="slide" href="javascript:void(0)"><i
											class="side-menu__icon ri-home-4-line"></i><span
											class="side-menu__label">Dashboard</span><i
											class="angle fe fe-chevron-right"></i></a>
									<ul class="slide-menu">
										<li class="panel sidetab-menu">
											<div class="panel-body tabs-menu-body p-0 border-0">
												<div class="tab-content">
													<div class="tab-pane active" id="side1">
														<ul class="sidemenu-list">
															<li class="side-menu-label1"><a href="javascript:void(0)">Dashboard</a></li>
															<li><a class="slide-item" href="{{route('dashboard')}}">index</a></li>
														</ul>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</li>
								<li class="slide">
									<a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('chat')}}">
											<i class="side-menu__icon fa fa-comment-o"></i>
											<span class="side-menu__label">chat</span>
									</a>
									<a class="side-menu__item has-link" data-bs-toggle="slide" href="{{route('properties.index')}}">
										<i class="side-menu__icon fa fa-home"></i>
										<span class="side-menu__label">Property</span>
									</a>
									
								</li>
							</ul>
						</div>
					</div>
				</div>