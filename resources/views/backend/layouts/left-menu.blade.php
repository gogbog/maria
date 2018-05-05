<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			<div class="menu-content top" id="menu-content-demo">
				<!-- Menu custom content demo
					 CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
					 Javascript: html/{{ Config::get('view.backend.img') }}/demo/demo.js
				 -->
				<div>
					<div class="text-bg"><span class="text-slim">Здравей,</span> <span class="text-semibold">{{ Auth::user()->first_name }}</span></div>

					<img src="{{ Config::get('view.backend.img') }}/pixel-admin/avatar2.png" alt="" class="">
					<div class="btn-group">
						<a href="{{ route('cms_users.edit', ['id' => Auth::user()->id]) }}" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
						<a href="{{ route('logout') }}" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
					</div>
				
				</div>
			</div>
			<ul class="navigation">
				<li class="active">
					<a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-home"></i><span class="mm-text">Табло</span></a>
				</li>

				<li class="mm-dropdown">
					<a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Администрация</span></a>
					<ul>
						<li>
							<a tabindex="-1" href="{{ route('cms_users.create') }}"><span class="mm-text">Добави</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('cms_users.all') }}"><span class="mm-text">Всички</span></a>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown">
					<a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Новини</span></a>
					<ul>
						<li>
							<a tabindex="-1" href="{{ route('news.create') }}"><span class="mm-text">Добави</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('news.all') }}"><span class="mm-text">Всички</span></a>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown">
					<a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Събития</span></a>
					<ul>
						<li>
							<a tabindex="-1" href="{{ route('events.create') }}"><span class="mm-text">Добави</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('events.all') }}"><span class="mm-text">Всички</span></a>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown">
					<a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Музика</span></a>
					<ul>
						<li>
							<a tabindex="-1" href="{{ route('music.create') }}"><span class="mm-text">Добави Песен</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('music.all') }}"><span class="mm-text">Всички Песени</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('music_albums.create') }}"><span class="mm-text">Добави Албум</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('music_albums.all') }}"><span class="mm-text">Всички Албуми</span></a>
						</li>
					</ul>
				</li>
				<li class="mm-dropdown">
					<a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Снимки</span></a>
					<ul>
						<li>
							<a tabindex="-1" href="{{ route('photo_albums.create') }}"><span class="mm-text">Добави Албум</span></a>
						</li>
						<li>
							<a tabindex="-1" href="{{ route('photo_albums.all') }}"><span class="mm-text">Всички Албуми</span></a>
						</li>
					</ul>
				</li>
			
			
		
			</ul> <!-- / .navigation -->
 	
		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->