@extends('frontend.layouts.master')

@section('title') Новини @endsection


@section('content')


	<!-- =============== START BREADCRUMB ================ -->
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
	<!-- =============== END BREADCRUMB ================ -->

	<!-- =============== START BLOG FILTER ================ -->

	<section style="background: #fff; margin-top: -120px !important;"  class="aquraFilter padding" id="content">
		<div class="container">
			<div class="sectionTitle paddingBottom">
				<span class="heading-t3"></span>
				<h2><a href="#" disabled>Новини</a></h2>
				<span class="heading-b3"></span>
			</div><!-- end sectionTtile -->
			<!-- end blog-filter-category -->
			
			<!-- start filter -->
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="aqura-filter-content">
						<ul class="clearfix">

							@if (count($articles) > 0)
							@foreach ($articles as $article)
								<li class="col-sm-4 col-xs-12 standard ">
									<div class="blogBox">	
										<div class="imgBox">
											<img src="{{ str_replace(':pid', $article->id, Config::get('images.article_350') )}}/{{ $article->img }}" alt="{{ $article->title }}">
										</div>
										<div class="blogBoxContent">
											<div class="blogHeader">
												<h1><a href="{{ route('news.detail', $article->id) }}">{{ $article->title }}</a></h1>
											</div>
											<div class="admin-list clearfix">
												<ul>
													<li><a>{{ $article->created_at->format('d-m-Y') }}</a></li>
												</ul>
											</div><!-- end admin-list -->
											<div class="blogParagraph">
												<p>{{ $article->short_desc }}.</p>
											</div><!--end blogParagraph  -->
											<div class="rmButton">
												<a href="{{ route('news.detail', $article->id) }}">Прочети още</a>
											</div>			
										</div><!-- end blogBoxContent -->
									</div><!-- end blogBox -->
								</li><!-- end col-sm-4 col-xs-12 -->
							@endforeach
							@endif
								
						</ul>
					</div><!-- end aqura-filter-cotent -->
				</div><!-- end col-sm-12 -->
			</div><!-- end row -->
			<!-- end filter -->
		</div><!-- end container -->
	</section>
	<!-- =============== END BLOG FILTER ================ -->

@endsection