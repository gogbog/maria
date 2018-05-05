Адми@extends('backend.layouts.master')
@section('title') Новини @endsection

@section('css')
	<link href="{{ Config::get('view.backend.css') }}/frontend.css" rel="stylesheet" type="text/css">
@endsection


@section('content')

<div id="content-wrapper">
				<div class="row">
					@include('backend.messages.errors')
				</div>
			
			<div class="row" style="padding-right:20px;">
			<!-- start filter -->
			<div class="aqura-filter-content list-albums">
				<ul class="list-feature clearfix">
					@if (count($albums) > 0)
						@foreach($albums as $album)
						<li class="col-md-3 col-sm-4 col-xs-6 new" id="album_{{ $album->id }}">
							<div class="album-icon">
								<span class="thumbs-album">
									<a href="{{ route('music_albums.edit', $album->id) }}">
										@if(strlen($album->album_image) > 5)
											<img width="270" height="270" src="{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->album_image }}" class="attachment-album-thumbnail wp-post-image" alt="">
										@else
											<img width="270" height="270" src="{{ Config::get('view.frontend.img') }}/albums/albumCover.png" class="attachment-album-thumbnail wp-post-image" alt="album-cover-1">
										@endif
										<a href="#" style="position: absolute;top: 5px;right: 5px;font-size:10px;" 
	                                           onclick="deleteRecord({{ $album->id }}); return false;"
	                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Изтрий</a>
									</a>
								</span>
								<span  class="disk" 
								@if(strlen($album->disc_image) > 1)
								style="background: url({{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->disc_image }}) no-repeat;background-size: cover;"
								@else
								style="background: url({{ Config::get('view.frontend.img') }}/albums/disk_default.png) no-repeat;background-size: cover;"
								@endif
								></span>
							</div><!-- END ALBUM ICON -->
							<div class="name">
								<h3>{{ $album->title }}</h3>						
															
							</div><!-- end name -->
						</li>

						@endforeach
					@else
					<h3 style="margin-left: 20px;">Няма записани албуми.</h3>
					@endif
		
				</ul>
			</div><!-- end aqura-filter-cotent -->
		</div>

</div>
@endsection

@section('javascript')


<script type="text/javascript">
	function deleteRecord(id)
		{
		  if (confirm('Внимание!! Сигурните ли сте, че искате да изтриете албума?'))
		  {
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("music_albums.delete") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id': id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		              document.getElementById('album_' + id).remove();
		          }
		          else
		          {
		            alert('error: ' + response.errormessage);
		          }
		      },
		      error: function(response)
		      {
		          alert('error: ' + response.errormessage);
		      }
		    });
		  }
		}
</script>

@endsection