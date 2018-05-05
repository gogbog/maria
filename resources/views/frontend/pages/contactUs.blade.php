@extends('frontend.layouts.master')

@section('title') Контакти @endsection


@section('content')

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

	<!-- =============== START CONTACT ================ -->
	<section class="contactSingle padding background-properties"  id="content" style="background: #fff; margin-top: -140px !important;">
		<div class="container">
			<div class="sectionTitle paddingBottom">
				<span class="heading-t3"></span>
				<h2><a href="#" disabled>Контакти</a></h2>
				<span class="heading-b3"></span>
			</div><!-- end sectionTtile -->
			<div class="row">
				<div class="col-sm-12">
					<div class="contactTop">
						<h2>За участия</h2>
						<div class="contactInfo">
							<ul>
								<li>Име <a href="#">Жени Димова</a></li>
								<li>Имейл: <a href="#">jenidimova@payner.bg</a></li>
								<li>Телефон: <a href="#">088 872 6298</a></li>
							</ul>
						</div>
					</div>
				</div><!-- end col-sm-4 -->
				{{--
				<div class="col-sm-7 col-sm-offset-1">
					<div class="singleBlogForm">
						<h2>Пишете ни</h2>
						@if ($errors->any())
							@foreach ($errors->all() as $error)
							    <div class="alert alert-warning">
							     {{ $error }}
							    </div>
							@endforeach
						@endif
						@if (Session::has('success_message'))
						    <div class="errors">
						        <div class="alert alert-success alert-dismissible fade in" role="alert">
						          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
						          {{ Session::get('success_message') }}
						        </div>
						    </div>
						@endif
						<form action="{{ route('sendEmail') }}" method="post" class="comment-form">
							{{ csrf_field() }}
							<input id="author" name="first_name" type="text" value="" aria-required="true" required="" placeholder="Първо име*">
							<input id="lastName" name="last_name" type="text" value="" aria-required="true" required="" placeholder="Фамилия">
							<input id="url" name="subject" type="text" value="" placeholder="Тема*">
							<input id="address" name="email" type="text" value="" placeholder="Имейл* ">
							<textarea name="comment" placeholder="Съобщение..." rows="6" required=""></textarea>
							<p class="form-submit">
								<input name="submit" type="submit" id="submit" value="Изпрати имейла">
							</p>
						</form>
					</div><!-- end contactForm -->
				</div><!-- end col-sm-7 col-sm-offset-1 -->
				--}}
			</div>
		</div><!-- end container -->
	</section>
	<!-- =============== END CONTACT ================ -->


	<!-- =============== END MAP ================ -->
@endsection