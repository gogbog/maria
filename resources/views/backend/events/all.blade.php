@extends('backend.layouts.master')
@section('title') Новини @endsection


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
										<th>Описание</th>
										<th>Дата</th>
										<th>Място</th>
										<th>Действие</th>
									</tr>
								</thead>
								<tbody>
									@if (count($events))
										@foreach ($events as $event)
											<tr id="event_{{ $event->id }}">
													<td>{{ $event->id }}</td>
												<td>{{ $event->title }}</td>
												<td>{{ $event->description }}</td>
												<td>{{ $event->date }}</td>
												<td>{{ $event->place }}</td>

												<td class="center">
													<a href="{{ route('events.edit', ['id' => $event->id]) }}" class="btn btn-info">Редактирай</a>
													<button onclick="deleteRecord({{ $event->id }})" type="button" class="btn btn-danger">Изтрий</button>
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
		$('#jq-datatables-example_wrapper .table-caption').text('Събития');
		$('#jq-datatables-example_wrapper .dataTables_filter label input').attr('placeholder', 'Търси...');
		$('.previous a').text('Предишна');
		$('.next a').text('Следваща');
	});
</script>
<script type="text/javascript">
	function deleteRecord(id)
		{
		  if (confirm('Внимание!! Сигурните ли сте, че искате да изтриете събитието?'))
		  {
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("events.delete") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id': id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		              document.getElementById('event_' + id).remove();
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