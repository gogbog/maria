
	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header" style="height:46px;">

				<!-- Logo -->
				<a href="{{ route('dashboard') }}" class="navbar-brand">
					{{-- <img style="padding: 3px" width="67px;" alt="НаргилетаБГ" src="{{ Config::get('view.backend.img') }}/logo.png"> --}}
				</a>

				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>

			</div> <!-- / .navbar-header -->

			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
			

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">

<!-- 3. $NAVBAR_ICON_BUTTONS =======================================================================

							Navbar Icon Buttons

							NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.

							Classes:
							* 'nav-icon-btn-info'
							* 'nav-icon-btn-success'
							* 'nav-icon-btn-warning'
							* 'nav-icon-btn-danger' 
-->

					



							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<img src="{{ Config::get('view.backend.img') }}/pixel-admin/avatar2.png"  alt="">
									<span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ route('cms_users.edit', ['id' => Auth::user()->id]) }}"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Настройки</a></li>
									<li class="divider"></li>
									<li><a href="{{ route('logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Излез</a></li>
								</ul>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->