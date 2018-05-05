@extends('backend.layouts.master')
@section('title') @if (!empty($edit)) Промени @else Добави @endif Албум  @endsection

@section('css')
  <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/custom-map.css">
@endsection


@section('content')
<div id="content-wrapper">
		
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">@if (!empty($edit)) Промени @else Добави @endif Албум</span>
					</div>
					<div class="panel-body">
			
						
						<form class="form-horizontal" method="POST" @if (!empty($edit)) action="{{ route('photo_albums.edit', $album->id) }}" @else
						action="{{ route('photo_albums.store') }}" @endif id="jq-validation-form" enctype="multipart/form-data">

						@include('backend.messages.errors')

						{{ csrf_field() }}

						<input type="hidden" name="unique_token" id='unique_token' value="{{ rand(1111111, 99999999) }}">

					
						<div class="form-group">

					
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Заглавие</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $album->title }}" @endif type="text" class="form-control" id="title" name="title" placeholder="Заглавие">
								</div>
							</div>


							
							<script>
								init.push(function () {
									$('#styled-finputs-example').pixelFileInput({ placeholder: 'Няма избран файл...' });
									$('#styled-finputs-example1').pixelFileInput({ placeholder: 'Няма избран файл...(1920x1080)' });
								})
							</script>
							@if (!empty($edit) && strlen($album->photo) > 1)
							<div class="form-group" id="img_box_{{ $album->id }}">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимка на албума</label>
								<div class="col-md-3 col-sm-12">
									<img style="width:100%" class="col-md-12" src="{{ str_replace(':pid', $album->id, Config::get('images.photo_album') )}}/{{ $album->photo }}">
									<a href="#" style="position: absolute;top: 2px;right: 23px;" 
                                           onclick="deleteFile({{ $album->id }}); return false;"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Изтрий</a>
								</div>
							</div>
							@endif
							@if (!empty($edit) && strlen($album->background) > 1)
							<div class="form-group" id="background_box_{{ $album->id }}">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимка за фон</label>
								<div class="col-md-3 col-sm-12">
									<img style="width:100%" class="col-md-12" src="{{ str_replace(':pid', $album->id, Config::get('images.photo_album_clean') )}}/{{ $album->background }}">
									<a href="#" style="position: absolute;top: 2px;right: 23px;" 
                                           onclick="deleteBackground({{ $album->id }}); return false;"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Изтрий</a>
								</div>
							</div>
							@endif

							@if (!empty($edit) && count($album->photos()) > 0)
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимки в албума</label>
								<div class="col-md-10">
								@foreach ($album->photos() as $photo)
									<div class="col-md-3 col-sm-6" style="margin-bottom: 20px;padding:0px;" id="picture_box_{{ $photo->id }}">
									<img style="width:100%;" class="col-md-12 custom-full-height" src="{{ Config::get('images.photos') }}/{{ $photo->image }}">
									<a href="#" style="position: absolute;top: 2px;right: 23px;" 
                                           onclick="deletePicture({{ $photo->id }}); return false;"
                                           class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Изтрий</a>
								</div>
								@endforeach
								</div>
							</div>
							@endif

							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимка на албума</label>
								<div class="col-sm-9">
									<input type="file" name="img" id="styled-finputs-example">
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимка за фон</label>
								<div class="col-sm-9">
									<input type="file" name="background" id="styled-finputs-example1">
								</div>
							</div>

							<script>
								init.push(function () {
									$("#dropzonejs-example").dropzone({
										url: "{{ route('photo_albums.upload-file-aj') }}",
										paramName: "file", // The name that will be used to transfer the file
										maxFilesize:6, // MB

										addRemoveLinks : false,
										maxFiles: 20,
										dictResponseError: "Снимката не може да се качи!",
										autoProcessQueue: true,
										thumbnailWidth: 138,
										thumbnailHeight: 120,

										

										previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

										sending: function(file, xhr, formData) {
										    formData.append("_token", CSRF_TOKEN);
										    formData.append("token", $('#unique_token').val());
										}
										
								
									});
								});
							</script>
							<!-- / Javascript -->
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Снимки в албума</label>
								<div class="col-sm-9">
										<div id="dropzonejs-example" class="dropzone-box">
											<div class="dz-default dz-message">
												<i class="fa fa-cloud-upload"></i>
												Избери снимки<br><span class="dz-text-small">и ги пусни тук!</span>
											</div>
											<form action="{{ route('photo_albums.upload-file-aj') }}">
												<div class="fallback">
													<input name="file" type="file" multiple="" />
																
												</div>
											</form>
							</div>
								</div>
							</div>


				
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-9">
									<button type="submit" class="btn btn-primary">Запази</button>
								</div>
							</div>
						</form>
							
					</div>
				</div>
</div>
@endsection

@section ('javascript')

<script type="text/javascript">
	function deleteFile(id)
	{
	  var warning = 'Сигурни ли сте, че искате да изтриете снимката?';

	  if (confirm(warning))
	  {
	  
	    $.ajax({
	        type: "post",
	        dataType: "json",
	        url: "{{ route('photo_albums.delete-file-aj') }}",
	        data: {
	           '_token': CSRF_TOKEN,
	          'id': id,
	        },
	        success: function(response)
	        {
	            if (response.success) 
	            {
	                $("#img_box_" + id).remove();
	            }
	            else {
	              $( "#dialogLoader" ).remove();
	              alert('error: ' + response.errormessage);
	            }
	        },
	        error: function(response)
	        {
	          $( "#dialogLoader" ).remove();
	          alert('error: ' + response.errormessage);
	        }
	    });
	  }
	}

	function deleteBackground(id)
	{
	  var warning = 'Сигурни ли сте, че искате да изтриете снимката?';

	  if (confirm(warning))
	  {
	  
	    $.ajax({
	        type: "post",
	        dataType: "json",
	        url: "{{ route('photo_albums.delete-background-aj') }}",
	        data: {
	           '_token': CSRF_TOKEN,
	          'id': id,
	        },
	        success: function(response)
	        {
	            if (response.success) 
	            {
	                $("#background_box_" + id).remove();
	            }
	            else {
	              $( "#dialogLoader" ).remove();
	              alert('error: ' + response.errormessage);
	            }
	        },
	        error: function(response)
	        {
	          $( "#dialogLoader" ).remove();
	          alert('error: ' + response.errormessage);
	        }
	    });
	  }
	}
</script>

<script type="text/javascript">
	function deletePicture(id)
	{
	  var warning = 'Сигурни ли сте, че искате да изтриете снимката?';

	  if (confirm(warning))
	  {
	  
	    $.ajax({
	        type: "post",
	        dataType: "json",
	        url: "{{ route('photo_albums.delete-picture-aj') }}",
	        data: {
	           '_token': CSRF_TOKEN,
	          'id': id,
	        },
	        success: function(response)
	        {
	            if (response.success) 
	            {
	                $("#picture_box_" + id).remove();
	            }
	            else {
	              $( "#dialogLoader" ).remove();
	              alert('error: ' + response.errormessage);
	            }
	        },
	        error: function(response)
	        {
	          $( "#dialogLoader" ).remove();
	          alert('error: ' + response.errormessage);
	        }
	    });
	  }
	}
</script>


	<!-- Javascript -->
				<script>
					init.push(function () {
			
			

						// Setup validation
						$("#jq-validation-form").validate({
							ignore: '.ignore, .select2-input',
							focusInvalid: false,
							rules: {
							
								'title': {
									required: true,
								},
							
							},
						
						});
						$.extend($.validator.messages, {
					    	required: "Попълнете полето!",
						});
					});

					
				</script>
				<!-- / Javascript -->
@endsection