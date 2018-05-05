@extends('frontend.layouts.master')

@section('title') Албум @endsection


@section('content')

	<!-- =============== START BREADCRUMB ================ -->
    <section class="no-mb1">
        <div class="row">
            <div class="col-sm-12">
                <div class="before-FullscreenSlider"></div>
                <div class="breadcrumb-fullscreen-parent1 phone-menu-bg1">
                    <div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" 
                    @if (strlen($album->background_image) > 1)
						style="background-image:url({{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->background_image }});"
					@else
						style="background-image:url({{ Config::get('view.frontend.img') }}/albums/bg_default.png);"
					@endif
		 			data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                        <div class="breadTxt">
                            <h1>
                                {{ $album->title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- =============== END BREADCRUMB ================ -->

	<!-- =============== START ALBUM SINGLE ================ -->
	<section class="albumSingle padding background-properties"
		style="background: #fff;">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="jp-playlist">
						<div class="about-list clearfix">
							<span class="about-name">Име</span>
							<span class="about-length">Времетраене</span>
							<span class="about-length"></span>
						</div>
						@if (count($songs) > 0)
							@foreach($songs as $song)
							<div class="trak-item" data-audio="{{ str_replace(':pid', $song->id, Config::get('files.song') )}}/{{ $song->mp3 }}" data-artist="{{ $song->album()->title }}" >
								<audio preload="metadata" src="{{ str_replace(':pid', $song->id, Config::get('files.song') )}}/{{ $song->mp3 }}" title="{{ $song->title }}"></audio>
								<div class="play-pause-button">
									@if ($song->mp3 != 0)
									<div class="center-y-table">
										<i class="fa fa-play"></i>
									</div>
									@endif
								</div>
								<div class="name-artist">
									<div class="center-y-table">
										<a href="{{ route('song.single', $song->id) }}" style="text-decoration: none;">
											<h2>
												{{ $song->title }}
											</h2>
										</a>
									</div>
								</div>
								<time class="trak-duration" style="float:left !important;">
									33:33
								</time>
								<div style="float:right;padding-top:13px;">
									<a style="padding: 0.4rem 1.5rem; border-radius: 1.3rem; transition-property: all; transition-duration: 0.2s;
    transition-timing-function: ease-in-out; color: #fff; background-color: #000;" href="{{ route('song.single', $song->id) }}">Виж</a>
								</div>
						
							</div>
							@endforeach
						@endif
						
					</div>
				</div><!-- end-col-sm-8 -->

			</div><!-- end row -->
		</div><!-- end container -->
	</section>
	<!-- =============== END ALBUM SINGLE ================ -->

	<!-- =============== START PAGINATION ================ -->
{{-- 	<div class="section-block  bkg-grey-ultralight pagination-2">
		<div class="row full-width ">
			<div class="col-sm-6 leftHover" style="background-image: url('{{ Config::get('view.frontend.img') }}/albums/albFooter.jpg');">
				<a href="albumsSingle3.html" class="pagination-previous">
					<small>Prev</small>
					<span>Strange Clouds</span>
				</a>
			</div>
			<div class="col-sm-6 rightHover" style="background-image: url('{{ Config::get('view.frontend.img') }}/albums/albFooter.jpg');">
				<a href="albumsSingle1.html" class="pagination-next ">
					<small>Next</small>
					<span>Noon XOXO</span>
				</a>
			</div>
		</div>
	</div> --}}
	<!-- =============== END PAGINATION ================ -->
@endsection