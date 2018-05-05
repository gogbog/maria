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