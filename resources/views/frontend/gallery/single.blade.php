@extends('frontend.layouts.master')

@section('title') Галерия @endsection


@section('content')

	<!-- =============== START BREADCRUMB ================ -->
	<section class="no-mb">
		<div class="row">
			<div class="col-sm-12">
				<div class="before-FullscreenSlider"></div>
				<div class="breadcrumb-fullscreen-parent phone-menu-bg">
					<div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" style="background-image: url('{{ str_replace(":pid", $album->id, Config::get('images.photo_album_clean') )}}/{{ $album->background }}");" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
						<div class="breadTxt breadSingle">
							<h2>{{ $album->title }}</h2><br>
							 <a href="#content" data-easing="easeInOutQuint" data-scroll="" data-speed="900" data-url="false">
                                Виж още <i class="fa fa-angle-down"></i>
                            </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- =============== END BREADCRUMB ================ -->

	<!-- =============== START GALLERY SECTION ================ -->
	<section id="content">
		<div class="gallerySection">
			<div class="container-fluid" style="padding-left:0; padding-right:0;">
				<div class="col-sm-12">
					<!-- Content Container -->
					<div class="content-container clearfix">
						<!-- Single Album Container -->
						<div class="single-photo-album-container">
							<div class="row">
								<!-- Single Album Article -->
								@if(count($photos) > 0)
									@foreach($photos as $photo)
										<article class="col-sm-12 col-md-4 col-xs-12">
											<!-- Single Album Contant Container -->
											<figure>
												<!-- Single Album Image -->
												<figcaption>
													<!-- Single Album Image -->
													<div class="hovereffect">
												        <img class="img-responsive" src="{{ Config::get('images.photos') }}/{{ $photo->image }}">
												        <div class="overlay">
												           <a class="info lightbox" href="{{ Config::get('images.photos') }}/{{ $photo->image }}"></a>
												        </div>
												    </div>
												</figcaption>
											</figure>
										</article>
									@endforeach
								@endif
												
							</div>
						</div>
					</div>
				</div>
			</div><!-- end container -->
		</div>
	</section>
	<!-- =============== END GALLERY SECTION ================ -->

@endsection
