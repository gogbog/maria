@extends('backend.layouts.master')

@section('title') Табло @endsection


@section('content')

<div id="content-wrapper">
	



<!-- /9. $UNIQUE_VISITORS_STAT_PANEL -->

		<!-- Page wide horizontal line -->
		<hr class="no-grid-gutter-h grid-gutter-margin-b no-margin-t">

		<div class="row">

<!-- 12. $NEW_USERS_TABLE ==========================================================================

			New users table
-->
				<div class="col-md-6">
				<div class="panel widget-tasks panel-dark-gray">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i> ПЛЕЙЛИСТ</span>
					</div> <!-- / .panel-heading -->
					<!-- Without vertical padding -->
					<div class="panel-body no-padding-vr">
			
						<div class="tasks">
							@if (count($songs))
								@foreach($songs as $song)
									<div class="task ">
										<div class="fa fa-dot-circle-o task-sort-icon"></div>
										<div class="action-checkbox">
											<label class="px-single"><input type="checkbox" @if ($song->status == 1) checked @endif onchange="changeSongStatus({{$song->id}})" value="" class="px"><span class="lbl"></span></label>
										</div>
										<a href="#" class="task-title">{{ $song->title }}</a>
									</div> <!-- / .task -->
								@endforeach
							@endif
						</div>

					</div> <!-- / .panel-body -->
				</div> <!-- / .panel -->
			</div>
			<div class="col-md-6">
				<div class="panel panel-dark-gray " id="" ">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-fire text-danger"></i>СНИМКА</span>
					
					</div> <!-- / .panel-heading -->
					<div class="tab-content">
						
						<div class="widget-threads panel-body tab-pane no-padding fade fade active in" id="dashboard-recent-comments">
						
							<div class="panel-padding no-padding-vr">
									<img style="height:200px;" class="col-md-12" src='{{ Config::get("view.frontend.img") }}/header/header.jpg'>
										<script>
											init.push(function () {
												$('#styled-finputs-example').pixelFileInput({ placeholder: 'Няма избран файл... (1920x1080)' });
											})
										</script>
											<form class="form-horizontal" method="POST" action="{{ route('background.store') }}" enctype="multipart/form-data">
												{{ csrf_field() }}
									<div class="col-md-12" style="margin:20px 0 10px 0;">
										<div class="col-sm-9" style="padding:0px 10px 0 0;">
											<input type="file" name="img" id="styled-finputs-example">
										</div>
										<div class="col-md-3" style="padding:0px;">
											<button  style="width:100%;" type="submit" class="btn btn-primary">Запази</button>
										</div>
									</div>
								</form>

							</div>
						</div> <!-- / .panel-body -->
					</div>
				</div> <!-- / .widget-threads -->
			</div>
			
		</div>

	
			<div class="col-md-6">
				<div class="panel widget-tasks panel-dark-gray">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-tasks"></i> ЗАДАЧИ</span>
						<div class="panel-heading-controls">
							<button class="btn btn-xs btn-primary btn-outline dark" id="clear-completed-tasks"><i class="fa fa-eraser text-success"></i> Изчисти завършените задачи</button>
						</div>
					</div> <!-- / .panel-heading -->
					<!-- Without vertical padding -->
					<div class="panel-body no-padding-vr">
						<div class="task" style="padding-left: 0px; padding-right: 0px;">
							<div class="col-sm-9">
								<input @if (!empty($edit)) value="{{ $customer->email }}" @endif type="text" class="form-control" id="task" placeholder="Добави задача">
							</div>
							<div class="col-md-3">
								<button onclick="addTask()" style="width:100%;" type="submit" class="btn btn-primary">Запази</button>
							</div>
						</div> <!-- / .task -->
						<div class="tasks tasks_custom">
							@if (count($tasks))
								@foreach($tasks as $task)
									<div class="task @if ($task->status == 1) completed1 @endif">
										<div class="fa fa-dot-circle-o task-sort-icon"></div>
										<div class="action-checkbox">
											<label class="px-single"><input type="checkbox" @if ($task->status == 1) checked @endif onchange="changeTaskStatus({{$task->id}})" value="" class="px"><span class="lbl"></span></label>
										</div>
										<a href="#" class="task-title">{{ $task->task }}</a>
									</div> <!-- / .task -->
								@endforeach
							@endif
						</div>

					</div> <!-- / .panel-body -->
				</div> <!-- / .panel -->
			</div>
			<div class="col-md-6">
				<div class="panel panel-dark-gray " id="dashboard-recent" ">
					<div class="panel-heading">
						<span class="panel-title"><i class="panel-title-icon fa fa-fire text-danger"></i>ИСТОРИЯ</span>
					
					</div> <!-- / .panel-heading -->
					<div class="tab-content">
						
						<div class="widget-threads panel-body tab-pane no-padding fade fade active in" id="dashboard-recent-comments">
						
							<div class="panel-padding no-padding-vr">
								@if (!empty($logs) && count($logs))
									@foreach ($logs as $log)
										<div class="thread">
											<img src="{{ Config::get('view.backend.img') }}/demo/avatars/1.jpg" alt="" class="thread-avatar">
											<div class="thread-body">
												<span style="margin-top: 6px;" class="thread-time">{{ $log->created_at }}</span>
												<a href="#" class="thread-title">{{ $log->first_name }} {{ $log->last_name }} </a>
												<div class="thread-info">{{ $log->action }}</div>
											</div> <!-- / .thread-body -->
										</div> <!-- / .thread -->
									@endforeach
								@endif


							</div>
						</div> <!-- / .panel-body -->
					</div>
				</div> <!-- / .widget-threads -->
			</div>
			
		</div>


</div> <!-- / #content-wrapper -->

@endsection

@section('javascript')
<script src="https://maps.google.com/maps/api/js?libraries=geometry&v=3.28&key=AIzaSyAJGFKGfjdLr7Bwj6pFvE_rAxFO3uJ0goE">
</script>
<script src="{{ Config::get('view.backend.js') }}/maplace.js"></script>

<script type="text/javascript">
	function addTask()
		{
		  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  var task = $('#task').val();
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("task.store") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'task' : task
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
					var htmlToPut = '<div class="task">';
					htmlToPut += '<div class="fa fa-dot-circle-o task-sort-icon"></div>';
					htmlToPut += '<div class="action-checkbox">'
					htmlToPut += '<label class="px-single"><input type="checkbox" value="" onchange="changeTaskStatus('+ response.task.id +')" class="px" ><span class="lbl"></span></label>';
					htmlToPut += "</div>";
					htmlToPut += '<a href="#" class="task-title">' + response.task.task +'</a>'
					htmlToPut += '</div>';
		             document.getElementById("task").value = "";
		             $(".tasks_custom").prepend(htmlToPut);
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

		function changeTaskStatus(id)
		{
		    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("task.changeStatus") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id' : id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		          	//do something
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

		function changeSongStatus(id)
		{
		    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		    $.ajax({
		        type: "post",
		        dataType: "json",
		        url: '{{ route("music.changeStatus") }}',
		        data: {
		          '_token': CSRF_TOKEN,
		          'id' : id
		        },
		        success: function(response)
		      {
		          if (response.success)
		          {
		          	//do something
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

		init.push(function () {
		$('.widget-tasks .panel-body').pixelTasks().slimScroll({ height: 267, alwaysVisible: true, color: '#888',allowPageScroll: true });
		$('#clear-completed-tasks').click(function () {
			$('.widget-tasks .panel-body').pixelTasks('clearCompletedTasks');
			 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  	 var task = $('#task').val();
			    $.ajax({
			        type: "post",
			        dataType: "json",
			        url: '{{ route("task.deleteCompleted") }}',
			        data: {
			          '_token': CSRF_TOKEN
			        },
			        success: function(response)
			      {
			          if (response.success)
			          {
			          	//do something
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
			});
	});
</script>
<script>
	init.push(function () {
		$('#dashboard-recent .panel-body > div').slimScroll({ height: 237, alwaysVisible: true, color: '#888',allowPageScroll: true });
	})
</script>




@endsection