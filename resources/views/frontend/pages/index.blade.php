@extends('frontend.layouts.master')

@section('title') Начало @endsection


@section('content')

    <!-- =============== START BREADCRUMB ================ -->
    <section class="no-mb">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-fullscreen-parent phone-menu-bg">
                    <div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" style="background-image: url('{{ Config::get("view.frontend.img") }}/header/header.jpg');" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                        <div id="home" style="position: absolute;left: 0;top: 0;">
                            <div class="intro-header">
                                <div class="js-height-full star" style="height: 955px;">
                                    <div class="star-pattern-1 js-height-full" style="height: 994px;"></div>
                                    <div class="col-sm-12"> 
                                        <div class="starTitle">
                                            <h4>Добре дошли в</h4>
                                            <div class="grid__item">
                                                <h1>
                                                    <a class="link link-yaku" href="#">
                                                        <span>M</span><span>A</span><span>R</span><span>I</span><span>A</span>                  
                                                    </a>
                                                </h1>
                                            </div>
                                            <h4>OFFICIAL WEBSITE</h4>
                                        </div>
                                        <canvas class="cover" width="1920" height="955"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== END BREADCRUMB ================ -->



    
    <!-- =============== START ALBUM COVER SECTION ================ -->
    @if (count($music_albums) > 0)
    <section class="padding albumsHome hide-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sectionTitle paddingBottom">
                        <span class="heading-t3"></span>
                        <h2><a href="{{ route('albums') }}">Дискография</a></h2>
                        <span class="heading-b3"></span>
                    </div><!-- end sectionTtile -->
                </div><!-- end col-sm-12 -->
            </div>
        
            <div class="list-albums">
                <ul class="list-feature col-md-12 col-xs-12 col-sm-12">
                        @foreach ($music_albums as $album)
                        <li class="col-md-3 col-sm-3 col-xs-12">
                            <div class="album-icon albumIcon3">
                                    <span class="thumbs-album">
                                        <a href="{{ route('albums.single', $album->id) }}">
                                        @if(strlen($album->album_image) > 1)
                                        <img width="270" height="270" src="{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->album_image }}" class="attachment-album-thumbnail wp-post-image" alt="">
                                        @else
                                            <img width="270" height="270" src="{{ Config::get('view.frontend.img') }}/albums/albumCover.png" class="attachment-album-thumbnail wp-post-image" alt="album-cover-1">
                                        @endif
                                        </a>
                                    </span>
                                @if(strlen($album->disc_image) > 1)
                                <span class="disk" style="background: url({{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->disc_image }}) no-repeat center center;"></span>
                                @else
                                <span  class="disk" style="background: url({{ Config::get('view.frontend.img') }}/albums/disk_default.png) no-repeat center center;"></span>
                                @endif
                            </div>
                            <div class="name">
                                <h3>{{ $album->title }}</h3>                         
                            </div>
                        </li>   
                        @endforeach
                </ul>
            </div><!-- end list-albums -->
        </div><!-- end container -->
    </section>
     @endif
    <!-- =============== END ALBUM COVER SECTION ================ -->
        <!-- =============== START BIOGRAPGY ================ -->
    <section class="no-mb1">
        <div class="row">
            <div class="col-sm-12">
                <div class="before-FullscreenSlider"></div>
                <div class="breadcrumb-fullscreen-parent1 phone-menu-bg1">
                    <div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" style="background-image: url('{{ Config::get('view.frontend.img') }}/header/biography.jpg');" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                        <div class="breadTxt">
                            <h1>
                                Биография
                            </h1>
                            <p>
                                Мария Панайотова Кирова, по-известна само като Мария, е една от най-любимите български изпълнителки вече над 18 години на сцена.
                            </p>
                            <a href="{{ route('biography') }}" data-easing="easeInOutQuint" data-scroll="" data-speed="900" data-url="false">
                                Виж още <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== END BIOGRAPHY ================ -->


@endsection