@extends('backend.layouts.master')
@section('title') @if (!empty($edit)) Промени @else Добави @endif Събитие  @endsection

@section('css')
    <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/custom-map.css">
@endsection


@section('content')
    <div id="content-wrapper">

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">@if (!empty($edit)) Промени @else Добави @endif Събитие</span>
            </div>
            <div class="panel-body">


                <form class="form-horizontal" method="POST"
                      @if (!empty($edit)) action="{{ route('events.edit', $event->id) }}" @else
                      action="{{ route('events.store') }}" @endif id="jq-validation-form">

                    @include('backend.messages.errors')

                    @php
                        $locales = config('translatable.locales');
                    @endphp
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($locales as $locale)
                            <li class="nav-item @if ($locale == App::getLocale()) active @endif">
                                <a class="nav-link @if ($locale == App::getLocale()) active @endif" id="{{$locale}}-tab"
                                   data-toggle="tab" href="#{{$locale}}" role="tab"
                                   aria-controls="{{$locale}}"
                                   aria-selected="@if ($locale == App::getLocale()) true @else false @endif">
                                    <span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> {{$locale}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    {{ csrf_field() }}

                    <div class="form-group">

                        <div class="tab-content" id="myTabContent">
                            @foreach($locales as $locale)
                                <div class="tab-pane fade @if ($locale == App::getLocale()) active in @endif"
                                     id="{{$locale}}" role="tabpanel" aria-labelledby="{{$locale}}-tab">
                                    <div class="form-group">
                                        <label for="jq-validation-required"
                                               class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Заглавие</label>
                                        <div class="col-sm-9">
                                            <input @if (!empty($edit)) value="@if (!empty($event->translate($locale)->title)) {{$event->translate($locale)->title}}@endif" @endif type="text"
                                                   class="form-control" id="title" name="{{$locale}}[title]" placeholder="Заглавие">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required"
                                               class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Описание</label>
                                        <div class="col-sm-9">
                                            <textarea style="resize: vertical;" class="form-control" name="{{$locale}}[description]"
                                                      rows="5"
                                                      placeholder="Описание">@if (!empty($edit) && !empty($event->translate($locale)->description)) {{$event->translate($locale)->description}} @endif</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Час</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <input type="text" name="{{$locale}}[hour]"
                                                       @if (!empty($edit)) @if (!empty($edit)) value="@if (!empty($event->translate($locale)->hour)) {{$event->translate($locale)->hour}} @endif" @endif
                                                       @endif class="form-control" id="bs-timepicker-component"><span
                                                        class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Дата</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date" id="bs-datepicker-component">
                                                <input @if (!empty($edit)) value="@if (!empty($event->translate($locale)->date)) {{$event->translate($locale)->date}} @endif" @endif type="text"
                                                       name="{{$locale}}[date]" class="form-control"><span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Място</label>
                                        <div class="col-sm-9">
                                            <input @if (!empty($edit)) value="@if (!empty($event->translate($locale)->place)) {{$event->translate($locale)->place}} @endif" @endif type="text"
                                                   class="form-control" id="place" name="{{$locale}}[place]" placeholder="Място">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Цена</label>
                                        <div class="col-sm-9">
                                            <input @if (!empty($edit)) value="@if (!empty($event->translate($locale)->price)) {{$event->translate($locale)->price}} @endif" @endif type="text"
                                                   class="form-control" id="price" name="{{$locale}}[price]" placeholder="00.00">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-9">
                                            <button type="submit" class="btn btn-primary">Запази</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section ('javascript')

    <script type="text/javascript">
        function deleteFile(id) {
            var warning = 'Сигурни ли сте, че искате да изтриете снимката?';

            if (confirm(warning)) {

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('news.delete-file-aj') }}",
                    data: {
                        '_token': CSRF_TOKEN,
                        'id': id,
                    },
                    success: function (response) {
                        if (response.success) {
                            $("#img_box_" + id).remove();
                        }
                        else {
                            $("#dialogLoader").remove();
                            alert('error: ' + response.errormessage);
                        }
                    },
                    error: function (response) {
                        $("#dialogLoader").remove();
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
                    'description': {
                        required: true
                    },
                    'hour': {
                        required: true,
                    },
                    'place': {
                        required: true,
                    },
                    'date': {
                        required: true,
                    },
                    'price': {
                        required: true,
                    },

                },

            });
            $.extend($.validator.messages, {
                required: "Попълнете полето!",
            });
        });


    </script>
    <!-- Javascript -->
    <script>
        init.push(function () {

            var options = {
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                showInputs: false,
                orientation: $('body').hasClass('right-to-left') ? {x: 'right', y: 'auto'} : {x: 'auto', y: 'auto'}
            }
            $('#bs-timepicker-component').timepicker(options);

        });
    </script>
    <script>
        init.push(function () {

            $('#bs-datepicker-component').datepicker(
                {
                    format: 'dd-mm-yyyy',
                });

        });
    </script>
    <!-- / Javascript -->
@endsection