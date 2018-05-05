@extends('frontend.layouts.master')

@section('title') 404 @endsection


@section('content')
<!-- =============== START BREADCRUMB ================ -->
	<section class="no-mb">
		<div class="row">
			<div class="col-sm-12">
				<div class="before-FullscreenSlider"></div>
				<div class="breadcrumb-fullscreen-parent phone-menu-bg">
					<div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" style="background-image: url('assets/img/header/header.png');" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
						<div class="breadTxt" style="text-align: center;">
                            <h1 style="color: #111;">
                                404 СТРАНИЦАТА НЕ Е НАМЕРЕНА
                            </h1>
                            <p style="color: #111">
                                Може да се върнете към  <a style="color: #111;" href="{{ route('home') }}">началната страница</a>!
                            </p>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- =============== END BREADCRUMB ================ -->


@endsection