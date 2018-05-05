@extends('frontend.layouts.master')

@section('title') {{ $event->title }} @endsection


@section('content')

	<!-- =============== START BREADCRUMB ================ -->

	<!-- =============== END BREADCRUMB ================ -->

	<!-- =============== START EVENT SINGLE ================ -->
	<div class="singleEvent padding background-properties" style="background-image: url({{ Config::get('view.frontend.img') }}/events/home-events-1.jpg);">
		<div class="container">
			<div class="sectionTitle paddingBottom">
				<span class="heading-t3"></span>
				<h2><a href="#" disabled>{{ $event->title }}</a></h2>
				<span class="heading-b3"></span>
			</div><!-- end sectionTtile -->

			<div class="row">
				<div class="col-sm-8">
					<div class="descriptionEvent">
						{!! $event->description !!}
					</div><!-- end descriptionEvent -->
				</div><!-- end col-sm-8 -->
				<div class="col-sm-3 col-sm-offset-1">
					<div class="sidebarAlbum">
						<div class="widget">
							<h3>Детайли</h3>
							<ul>
								<li>Дата:<span>{{ $event->date }}</span></li>
								<li>Час:<span>{{ $event->hour }}</span></li>
								<li>Място:<span>{{ substr($event->place, 0, 30) }}</span></li>
								<li>Цена:<span>{{ $event->price }}лв</span></li>
							</ul>
						</div><!-- end widget -->
						
					
					</div><!-- end sidebarAlbum -->
				</div><!-- end col-sm-3 col-sm-offset-1 -->
			</div><!-- end row -->
		</div><!-- end container -->
	</div>
	<!-- =============== END EVENT SINGLE ================ -->

	<!-- =============== START MAP ================ -->
{{-- 	<section class="googleMap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div id="map-canvas" class="google-map" data-lat="40.7841484" data-long="-73.9661407" data-img="{{ Config::get('view.frontend.img') }}/contact/marker.png"></div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- =============== END MAP ================ -->

	{{--<!-- =============== START PAGINATION ================ -->--}}
	{{--<section class="paginationFooter ">--}}
		{{--<div class="container">--}}
			{{--<div class="row">--}}
				{{--<div class="col-sm-12">--}}
					{{--<div class="col-sm-6">--}}
						{{--<a href="#" class="pagination-previous">--}}
							{{--<small>Preview Event</small>--}}
						{{--</a>--}}
					{{--</div>--}}
					{{--<div class="col-sm-6">--}}
						{{--<a href="#" class="pagination-next">--}}
							{{--<small>Next Event</small>--}}
						{{--</a>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</section>--}}
	<!-- =============== END PAGINATION ================ -->

@endsection

@section('js')

<script src="{{ Config::get('view.frontend.js') }}/map.js"></script>


@endsection