@extends('backend.layouts.master')
@section('title') Песни @endsection


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
										<th>Песен</th>
										<th>Албум</th>
										<th>Действие</th>
									</tr>
								</thead>
								<tbody>
									@if (count($songs))
										@foreach ($songs as $song)
											<tr id="song_{{ $song->id }}">
												<td>{{ $song->id }}</td>
												<td>{{ $song->title }}</td>
												<td>
													@if ($song->mp3 != 0)
														<audio controls>
													  		<source src="{{ str_replace(':pid', $song->id, Config::get('files.song') )}}/{{ $song->mp3 }}" type="audio/mpeg">
															Браузъра ви не поддържа пускането на песни
														</audio>
													@else
														Няма
													@endif
													
												</td>
												<td>
													@if ($song->album_id != 0)
														{{ $song->album()->title }}
													@else
														Няма
													@endif
												</td>

												<td class="center">
													<a href="{{ route('music.edit', ['id' => $song->id]) }}" class="btn btn-info">Редактирай</a>
													<button onclick="deleteRecord({{ $song->id }})" type="button" class="btn btn-danger">Изтрий</button>
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
		$('#jq-datatables-example_wrapper .table-caption').text('Песни');
		$('#jq-datatables-example_wrapper .dataTables_filter label input').attr('placeholder', 'Търси...');
		$('.previous a').text('Предишна');
		$('.next a').text('Следваща');
	});
</script>
<script type="text/javascript">
	function deleteRecord(id)
		{
		  if (confirm('Внимание!! Сигурните ли сте, че искате да изтриете песента?'))
		  {
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("music.delete") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id': id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		              document.getElementById('song_' + id).remove();
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