@extends('backend.layouts.master')
@section('title') @if (!empty($edit)) Промени @else Добави @endif Песен  @endsection

@section('css')
  <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/custom-map.css">
@endsection


@section('content')
<div id="content-wrapper">
		
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">@if (!empty($edit)) Промени @else Добави @endif Песен</span>
					</div>
					<div class="panel-body">
			
						
						<form class="form-horizontal" method="POST" @if (!empty($edit)) action="{{ route('music.edit', $song->id) }}" @else
						action="{{ route('music.store') }}" @endif id="jq-validation-form" enctype="multipart/form-data">

						@include('backend.messages.errors')

						{{ csrf_field() }}

					
						<div class="form-group">

					
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Заглавие</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $song->title }}" @endif type="text" class="form-control" id="title" name="title" placeholder="Заглавие">
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Текст</label>
								<div class="col-sm-9">
									<!-- Javascript -->
								<script>
									init.push(function () {
										if (! $('html').hasClass('ie8')) {
											$('#summernote-example').summernote({
												height: 200,
												tabsize: 2,
												codemirror: {
													theme: 'monokai'
												}
											});
										}
										$('#summernote-boxed').switcher({
											on_state_content: '<span class="fa fa-check" style="font-size:11px;"></span>',
											off_state_content: '<span class="fa fa-times" style="font-size:11px;"></span>'
										});
										$('#summernote-boxed').on($('html').hasClass('ie8') ? "propertychange" : "change", function () {
											var $panel = $(this).parents('.panel');
											if ($(this).is(':checked')) {
												$panel.find('.panel-body').addClass('no-padding');
												$panel.find('.panel-body > *').addClass('no-border');
											} else {
												$panel.find('.panel-body').removeClass('no-padding');
												$panel.find('.panel-body > *').removeClass('no-border');
											}
										});
									});
								</script>
								<!-- / Javascript -->
									<textarea name="lyrics" rows="5" placeholder="Описание" class="form-control" id="summernote-example" rows="10">@if (!empty($edit)){{ $song->lyrics }}@endif</textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Youtube Url</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $song->youtube_url }}" @endif type="text" class="form-control" id="youtube_url" name="youtube_url" placeholder="Youtube видео">
								</div>
							</div>

							<div class="form-group">
								<label for="jq-validation-select2" class="col-sm-2 control-label">Албум</label>
								<div class="col-sm-9">
									<select class="form-control" name="album_id" id="album_id">
										@if (count($albums) > 0)
											@foreach ($albums as $album)
											 <option @if (!empty($edit) && $album->id == $song->album_id) selected @endif value="{{ $album->id }}">{{ $album->title }}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>


							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">MP3</label>
								<div class="col-sm-9">
									<input type="file" name="mp3" id="styled-finputs-example1">
								</div>
							</div>

							<script>
								init.push(function () {
									$('#styled-finputs-example1').pixelFileInput({ placeholder: 'Няма избран файл...' });
								})
							</script>

				
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
								'description': {
									required: true
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