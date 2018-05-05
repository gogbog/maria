@extends('frontend.layouts.master')

@section('title') Галерия @endsection


@section('content')
	<section class="no-mb">
		<div class="row">
			<div class="col-sm-12">
				<div class="before-FullscreenSlider"></div>
					<div class="breadcrumb-fullscreen-parent phone-menu-bg" >
					<div class="breadcrumb overlay almost-black-overlay" style="background: #fff;padding:12rem 0 0 0;" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                        <div class="sectionTitle paddingBottom" style="padding-bottom: 2rem !important;">
							<span class="heading-t3"></span>
							<h2><a href="#" disabled="">Галерия</a></h2>
							<span class="heading-b3"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =============== START GALLERY SECTION ================ -->
	<section class="padding gallerySection" id="content" style="padding: 14rem !important;">
		<div class="container" style="padding:0;">
				<div class="col-sm-12">
					<!-- Content Container -->
					<div class="content-container clearfix">
						<!-- Single Album Container -->
						<div class="single-photo-album-container">
							<div class="row">
								<!-- Single Album Article -->
								@if (count($albums))
									@foreach ($albums as $album)
										<article class="col-sm-4">
											<!-- Single Album Contant Container -->
											<figure>
												<!-- Single Album Image -->
												<figcaption>
													<div class="hovereffect" style="position:relative;margin-bottom: 30px;">
														  <div class="col-md-12" style="position: absolute; bottom:0;font-size: 17px; height:40px;background: #fff;line-height: 40px;z-index: 231321;">
												        	{{ $album->title }}
												        </div>
														@if (strlen($album->photo) < 1)
												        <img class="img-responsive" src="{{ Config::get('view.frontend.img') }}/gallery/galGrid.png" alt="">
												        @else
												        <img class="img-responsive" src="{{ str_replace(':pid', $album->id, Config::get('images.photo_album') )}}/{{ $album->photo }}" alt="{{ $album->title }}">
												        
												        @endif
												        <div class="overlay">
												        	<a href="{{ route('gallery.single', $album->id) }}" class="info"></a>
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
	</section>
	<!-- =============== END GALLERY SECTION ================ -->


@endsection