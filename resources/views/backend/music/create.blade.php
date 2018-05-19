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

                <form class="form-horizontal" method="POST"
                      @if (!empty($edit)) action="{{ route('music.edit', $song->id) }}" @else
                      action="{{ route('music.store') }}" @endif id="jq-validation-form" enctype="multipart/form-data">

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
                                            <input @if (!empty($edit)) value="@if (!empty($song->translate($locale)->title)) {{$song->translate($locale)->title}} @endif" @endif type="text"
                                                   class="form-control" id="title" name="{{$locale}}[title]" placeholder="Заглавие">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> Текст</label>
                                        <div class="col-sm-9">
                                            <!-- Javascript -->
                                            <script>
                                                init.push(function () {
                                                    if (!$('html').hasClass('ie8')) {
                                                        $('#summernote-example_{{$locale}}').summernote({
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
                                            <textarea name="{{$locale}}[lyrics]" rows="5" placeholder="Описание" class="form-control"
                                                      id="summernote-example_{{$locale}}"
                                                      rows="10">@if (!empty($edit) && !empty($song->translate($locale)->lyrics)) {{$song->translate($locale)->lyrics}} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="jq-validation-required" class="col-sm-2 control-label">Youtube Url</label>
                            <div class="col-sm-9">
                                <input @if (!empty($edit)) value="{{ $song->youtube_url }}" @endif type="text"
                                       class="form-control" id="youtube_url" name="youtube_url"
                                       placeholder="Youtube видео">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jq-validation-select2" class="col-sm-2 control-label">Албум</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="album_id" id="album_id">
                                    @if (count($albums) > 0)
                                        @foreach ($albums as $album)
                                            <option @if (!empty($edit) && $album->id == $song->album_id) selected
                                                    @endif value="{{ $album->id }}">{{ $album->title }}</option>
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
                                $('#styled-finputs-example1').pixelFileInput({placeholder: 'Няма избран файл...'});
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