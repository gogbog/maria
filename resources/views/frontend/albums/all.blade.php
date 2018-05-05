@extends('frontend.layouts.master')

@section('title') ДИСКОГРАФИЯ  @endsection


@section('content')
	
	@if (count($albums) > 0)
		@foreach ($albums as $album)
			<!-- =============== START ALBUMS SECTION ================ -->
			<section class="fullAlbums" style="background-image:url(
			@if (strlen($album->background_image) > 1)
			{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->background_image }}
			@else
			{{ Config::get('view.frontend.img') }}/albums/bg_default.png
			@endif
			);background-size: cover;">
				<div class="fullAlbumsContent col-sm-5">
					<h1>{{ $album->title }}</h1>
					<div class="social-icons" style="margin: 10px 0 0 10px;">
						{{-- <a href="#" class="icon-button shopIcon" target="_blank"><i class="fa fa-headphones"></i><span></span></a> --}}
						<a href="{{ route('albums.single', $album->id) }}" class="detailsSocial">ВИЖ ПОВЕЧЕ <i class="fa fa-angle-right"></i></a>
					</div>
				</div><!-- end fullAlbumsContent -->
			</section>
		@endforeach
	@endif

	

@endsection