@extends('frontend.layouts.master')

@section('title') {{ $song->title }} @endsection


@section('content')
	<style>
	.blogSingle .widget a, .blogSidebarRight .widget a {
	    font-size: 1.6rem !important;
	}
	</style>
  <!-- =============== START BREADCRUMB ================ -->
  @if(!is_null($song->youtube_url))
	<section class="no-mb">
        <div class="row">
            <div class="col-sm-12">
            	<div class="breadcrumb-fullscreen-parent phone-menu-bg">
            		
						<div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
						
						<div id="bgndVideo" class="player" data-property="{videoURL:'{!! $song->youtube_url !!}',containment:'.player',autoPlay:false, mute:false, startAt:0, opacity:1}">
					
                    	    
                    	</div>
               
    </div>
                   
					</div>
				</div><!--end bread  -->
            </div>
        </div>
    </section>
     @endif
	<!-- =============== END BREADCRUMB ================ -->

		@if(is_null($song->youtube_url))
			<section class="no-mb">
			    <div class="row">
			        <div class="col-sm-12">
			            <div class="breadcrumb-fullscreen-parent phone-menu-bg">
			                <div class="breadcrumb   overlay almost-black-overlay" style="background: #fff;padding: 50px !important;" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
			                    
			                </div>
			            </div>
			        </div>
			    </div>
			</section>
		@endif

	<!-- =============== START BLOG SINGLE ================ -->

	<section  class="blogSingle padding biography padding background-properties" id="content" style="padding: 8rem 0">
		<div class="container">
			<div class="row">
				<div class="blog-left">
					<div class="col-sm-8">
						<div class="title" style="margin-bottom: 1.2cm">
							<h2 style="font-size: 1.0cm;">{{ $song->title }}</h2>
						</div>
						<style>


						.custom-par p span {
							font-family: 'Karla', sans-serif;
							line-height: 2 !important;
						}

						.custom-par span {
						    font-family: 'Karla', sans-serif;
						    line-height: 2 !important;
						}

						.custom-par p  {
						    font-family: 'Karla', sans-serif;
						    line-height: 2 !important;
						}

						.custom-par .par div{
						    font-family: 'Karla', sans-serif;
						    line-height: 2 !important;
						}
					 	</style>
						<div class="paragraph custom-par">
							{!! $song->lyrics !!}
						</div>
					

						
					</div><!-- end col-sm-8 -->
				</div><!-- end blog-left -->
				<div class="blog-right">
					<div class="col-sm-3 col-sm-offset-1">
						<div class="blogSidebar">
							<div class="widget">
								<h3 class="widget-title">Последни Песни</h3>
								<ul>
									@if (count($songs) > 0)
										@foreach($songs as $song)
											<li><a href="{{ route('song.single', $song->id) }}">{{ $song->title }}</a></li>
										@endforeach
									@endif
								</ul>
							</div><!-- end widget -->
							<div class="widget">
								<h3 class="widget-title">Последни Албуми</h3>
								<ul>
									@if (count($albums) > 0)
										@foreach($albums as $album)
											<li><a href="{{ route('albums.single', $album->id) }}">{{ $album->title }}</a></li>
										@endforeach
									@endif
								</ul>
							</div><!-- end widget -->
					
			
						</div><!-- end blogSidebar -->
					</div><!-- end col-sm03 -->
				</div><!-- end blog-right -->
			</div><!-- end row -->
		</div><!-- end container -->
	</section>
	<!-- =============== END BLOG SINGLE ================ -->

	@endsection