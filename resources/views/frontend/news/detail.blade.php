@extends('frontend.layouts.master')

@section('title') {{ $article->title }} @endsection


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
	

	<!-- =============== START BLOG SINGLE ================ -->
	<section class="blogSingle padding" style="background: #fff; margin-top: -120px !important;"  id="content">
		<div class="container">
			<div class="row">
				<div class="blog-left">
					<div class="col-sm-8">
					<div class="title">
							<h2>{{ $article->title }}</h2>
					</div>
					<img src="{{ str_replace(':pid', $article->id, Config::get('images.article_740') )}}/{{ $article->img }}" alt="{{ $article->title }}">
						<div class="admin-list clearfix">
							<ul>
								<li><a href="#">{{ $article->created_at->format('d-m-Y') }}</a></li>
							</ul>
						</div>
						<div class="paragraph" style="font-family: 'Karla', sans-serif; line-height: 2;">
							{!!  $article->description !!}
						</div>

					</div><!-- end col-sm-8 -->
				</div><!-- end blog-left -->
				<div class="blog-right">
					<div class="col-sm-3 col-sm-offset-1">
						<div class="blogSidebar">
							
							@if (count($recent_art) > 0)
							<div class="widget">
								<h3 class="widget-title">Последни статии</h3>
								<ul>
									@foreach ($recent_art as $r_article)
										<li><a href="{{ route('news.detail', $r_article->id) }}">{{ $r_article->title }}</a></li>
									@endforeach
									
								</ul>
							</div><!-- end widget -->
							@endif
						{{-- 	<div class="widget">
								<h3 class="widget-title">Tweets</h3>
								<!-- twitter -->
								<a class="twitter-timeline" href="https://twitter.com/Gallenna" data-widget-id="716220714324467712">Tweets by @Gallenna</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div><!-- end widget --> --}}
						</div><!-- end blogSidebar -->
					</div><!-- end col-sm03 -->
				</div><!-- end blog-right -->
			</div><!-- end row -->
		</div><!-- end container -->
	</section>
	<!-- =============== END BLOG SINGLE ================ -->

	@endsection