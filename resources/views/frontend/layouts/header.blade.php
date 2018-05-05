
@if (!empty($dark_version))
    <style>
        .open-menu span {
            background: #333 !important;
        }
    </style>
@endif

 <!-- =============== START TOP HEADER ================ -->
    <div class="topHeader" >
        <div class="header">
            <div class="rightTopHeader">
               
                <!-- Open Menu Button -->
                <a class="open-menu">
                    <!-- Buttons Bars -->
                    <span class="span-1"></span>
                    <span class="span-2"></span>
                    <span class="span-3"></span>
                </a>
            </div><!-- end rightTopHeader -->
        </div><!-- end header -->
        <!-- Menu Fixed Container -->
        <div class="menu-fixed-container">
            <!-- Menu Fixed Centred Container -->
            <nav>
                <!-- Menu Fixed Close Button -->
                <div class="x-filter">
                    <span></span>
                    <span></span>
                </div>
                <!-- Menu Fixed Primary List -->
                <ul>
                    <!-- Menu Fixed Item -->
                    <li>
                        <a href="{{ route('home') }}">
                           {{ trans('frontend.menu.home') }}
                        </a>
                    </li>
               {{--      <li>
                        <a href="albumsGrid.html">
                            {{ trans('frontend.menu.home') }}
                        </a>
                        <ul class="sub-menu">
                            <!-- Menu Fixed Sub Menu Item -->
                            <li>
                                <a href="albumsFullBackground.html">
                                    albums full background
                                </a>
                            </li>
                            Menu Fixed Sub Menu Item
                            <li>
                                <a href="albumsGrid.html">
                                    albums grid
                                </a>
                            </li>
                            <!-- Menu Fixed Sub Menu Item -->
                            <li>
                                <a href="albumsSingle1.html">
                                    album description
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    <!-- Menu Fixed Item -->
                    <li>
                        <a href="{{ route('news') }}">
                            {{ trans('frontend.menu.news') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}">
                            {{ trans('frontend.menu.events') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.albums') }}">
                            {{ trans('frontend.menu.gallery') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('biography') }}">
                            {{ trans('frontend.menu.biography') }}
                        </a>
                    </li>
                       <li>
                        <a href="{{ route('albums') }}">
                            {{ trans('frontend.menu.discography') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contactUs') }}">
                            {{ trans('frontend.menu.contact') }}
                        </a>
                    </li>
                </ul>
                <!-- Menu Fixed Close Button -->
                <div class="x-filter">
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div><!-- end menu-fixed-container -->
        <!-- =============== STAR LOGO ================ -->
        <div class="logo-container-top">
            {{-- <a href={{ route('home') }}><img src="{{ Config::get('view.frontend.img') }}/logo/whiteLogo.png" alt="Maria"></a> --}}
            <a style="text-decoration: none;" href={{ route('home') }}>
              <h1 style="font-family: 'Montserrat', sans-serif;color: #fff; @if(!empty($dark_version)) color: #333; @endif font-size:20px;">MARIAOFFICIAL.COM</h1>
            </a>
        </div><!-- end logo-container-top -->
        <!-- =============== END LOGO ================ -->
    </div><!-- end topHeader -->
    <!-- =============== END TOP HEADER ================ -->