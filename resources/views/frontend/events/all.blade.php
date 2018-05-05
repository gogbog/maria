@extends('frontend.layouts.master')

@section('title') Събития @endsection


@section('content')



	<!-- =============== START BREADCRUMB ================ -->
	<section class="no-mb">
        <div class="row">
            <div class="col-sm-12">
            	<div class="breadcrumb-fullscreen-parent phone-menu-bg">
					<div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
					
                    				<div id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=BWeiHgkMfBI',containment:'.player',autoPlay:true, mute:false, startAt:0, opacity:1, addRaster:true}">
                    					</div>
					</div>
				</div><!--end bread  -->
            </div>
        </div>
    </section>
	<!-- =============== END BREADCRUMB ================ -->

	<!-- =============== START EVENTS SECTION-1 ================ -->
	<section style="background: #d1d1d1;" class="background-properties padding">
		<div class="tableEvents">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="sectionTitle paddingBottom">
							<span class="heading-t3"></span>
							<h2><a href="albums.html">Събития</a></h2>
							<span class="heading-b3"></span>
						</div><!-- end sectionTtile -->
						<table>
							<tr class="tableEventsTitle">
								<th class="date">Дата</th>
								<th class="venue">Събитие</th>
								<th class="location">Място</th>
								<th class="tickets">Цена</th>
								<th></th>
							</tr>
							@if (count($events) > 0)
								@foreach ($events as $event)	
								<tr>
									<td class="aqura-date"><a href="{{ route('events.detail', $event->id) }}"><i class="fa fa-plus"></i></a><a href="#">{{ $event->date }}</a></td>
									<td class="aqura-location"><a href="{{ route('events.detail', $event->id) }}">{{ $event->title }}</a></td>
									<td class="aqura-city"><a href="#">{{ $event->place }}</a></td>
									<td class="aqura-tickets"><a href="#">{{ $event->price }}лв</a></td>
									<td class="aqura-vip"><a href="{{ route('events.detail', $event->id) }}">Виж</a></td>
								</tr>
								@endforeach
							@endif
							
						</table>
					</div><!-- end col-sm-12 -->
				</div><!-- end row -->
			</div><!-- end container -->
		</div><!-- end tableEvents -->
	</section>
	<!-- =============== END EVENTS SECTION-1 ================ -->

@endsection