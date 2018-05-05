@extends('backend.layouts.master')
@section('title') Админи @endsection


@section('content')

<div id="content-wrapper">
				<div class="row">
					@include('backend.messages.errors')
				</div>
				
				<div class="row">
					<div class="panel">
				
					<div class="panel-body">
						<div class="table-primary">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
								<thead>
									<tr>
										<th>#</th>
										<th>Име</th>
										<th>Имейл</th>
										<th>Действие</th>
									</tr>
								</thead>
								<tbody>
									@if (count($cms_users))
										@foreach ($cms_users as $admin)
											<tr id="cms_user_{{ $admin->id }}">
													<td>{{ $admin->id }}</td>
												<td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
												<td>{{ $admin->email }}</td>

												<td class="center">
													<button onclick="deleteRecord({{ $admin->id }})" type="button" class="btn btn-danger">Изтрий</button>
												</td>
											</tr>
										@endforeach
									@endif
						
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>


</div>
@endsection

@section('javascript')

<!-- Javascript -->
<script>
	init.push(function () {
		$('#jq-datatables-example').dataTable();
		$('#jq-datatables-example_wrapper .table-caption').text('Админи');
		$('#jq-datatables-example_wrapper .dataTables_filter label input').attr('placeholder', 'Търси...');
		$('.previous a').text('Предишна');
		$('.next a').text('Следваща');
	});
</script>
<script type="text/javascript">
	function deleteRecord(id)
		{
		  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  if (confirm('Внимание!! Сигурните ли сте, че искате да изтриете админа?'))
		  {
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("cms_users.delete") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id': id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		              document.getElementById('cms_user_' + id).remove();
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