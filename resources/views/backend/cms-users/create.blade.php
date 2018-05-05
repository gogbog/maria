@extends('backend.layouts.master')
@section('title') @if (!empty($edit)) Промени @else Добави @endif Админ  @endsection

@section('css')
  <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/custom-map.css">
@endsection


@section('content')
<div id="content-wrapper">
		
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">@if (!empty($edit)) Промени @else Добави @endif Админ</span>
					</div>
					<div class="panel-body">
			
						
						<form class="form-horizontal" method="POST" @if (!empty($edit)) action="{{ route('cms_users.update') }}" @else
						action="{{ route('cms_users.store') }}" @endif id="jq-validation-form">

						@include('backend.messages.errors')

						{{ csrf_field() }}

					
						<div class="form-group">
						<div class="col-sm-9 col-sm-offset-2" style="margin-bottom: 10px;">
							@if (!empty($edit)) <input @if (!empty($edit)) value="{{ $id }}" @endif type="hidden" name="admin_id" > @endif
						</div>

					
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Първо име</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $admin->first_name }}" @endif type="text" class="form-control" id="first_name" name="first_name" placeholder="Първо име">
								</div>
							</div>

							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Презиме</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $admin->last_name }}" @endif type="text" class="form-control" id="last_name" name="last_name" placeholder="Презиме">
								</div>
							</div>

							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Имейл</label>
								<div class="col-sm-9">
									<input @if (!empty($edit)) value="{{ $admin->email }}" @endif type="text" class="form-control" id="email" name="email" placeholder="Имейл">
								</div>
							</div>
					
							<div class="form-group">
								<label for="jq-validation-required" class="col-sm-2 control-label">Парола</label>
								<div class="col-sm-9">
									<input  type="password" class="form-control" id="password" name="password" placeholder="Парола">
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
 
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAJGFKGfjdLr7Bwj6pFvE_rAxFO3uJ0goE&libraries=geometry,places">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js"></script>
  <script src="{{ Config::get('view.backend.js') }}/List.js"></script>
  <script src="{{ Config::get('view.backend.js') }}/Maperizer.js"></script>
  <script src="{{ Config::get('view.backend.js') }}/map-options.js"></script>
  <script src="{{ Config::get('view.backend.js') }}/jqueryui.maperizer.js"></script>
  <script src="{{ Config::get('view.backend.js') }}/custom-map.js"></script>
  <script type="text/javascript">
  	@if (!empty($edit))
  	  var $maperizer = $('#map-canvas').maperizer(Maperizer.MAP_OPTIONS);
      $maperizer.maperizer('addMarker', {
            lat: {{ $admin->lat }},
            lng: {{ $admin->lon }},
            newMarker: true
        });
    @endif
  </script>

	<!-- Javascript -->
				<script>
					init.push(function () {
			
			

						// Setup validation
						$("#jq-validation-form").validate({
							ignore: '.ignore, .select2-input',
							focusInvalid: false,
							rules: {
							
								'first_name': {
									required: true,
								},
								'last_name': {
									required: true
								},
								'email': {
									required: true,
								},
						
								'password': {
									required: true,
								}
							
							},
						
						});
						$.extend($.validator.messages, {
					    	required: "Попълнете полето!",
						});
					});

					
				</script>
				<!-- / Javascript -->
@endsection