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


                <form class="form-horizontal" method="POST"
                      @if (!empty($edit)) action="{{ route('music_albums.edit', $album->id) }}" @else
                      action="{{ route('music_albums.store') }}" @endif id="jq-validation-form"
                      enctype="multipart/form-data">

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
                                            <input @if (!empty($edit)) value="@if (!empty($album->translate($locale)->title)) {{$album->translate($locale)->title}} @endif" @endif
                                                   type="text"
                                                   class="form-control" id="title" name="{{$locale}}[title]"
                                                   placeholder="Заглавие">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jq-validation-required"
                                               class="col-sm-2 control-label"><span class="flag-icon flag-icon-@if($locale == 'en')gb @else{{$locale}} @endif"></span> eОписание</label>
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
                                            <textarea name="{{$locale}}[description]" rows="5" placeholder="Описание"
                                                      class="form-control" id="summernote-example_{{$locale}}"
                                                      rows="10">@if (!empty($edit) && !empty($album->translate($locale)->description)) {{$album->translate($locale)->description}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                        </div>
                                @if (!empty($edit))
                                    <div class="form-group">
                                        <label for="jq-validation-required" class="col-sm-2 control-label">Настоящи
                                            Снимки</label>
                                        <div class="panel col-md-3">
                                            <div class="panel-heading">
                                                <span class="panel-title">Снимка на Диска</span>
                                            </div>
                                            <div class="panel-body" id="disc_image_box">
                                                @if (strlen($album->disc_image) > 1)
                                                    <img class="col-md-12" style="height: 190px;"
                                                         src="{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->disc_image }}">
                                                    <a href="#" style="position: absolute;top: 10px;right: 10px;"
                                                       onclick="deleteFile({{ $album->id }}, 'disk_image'); return false;"
                                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                        Изтрий</a>
                                                @else
                                                    <img height="190"
                                                         src="{{ Config::get('view.frontend.img') }}/albums/disk_default.png"
                                                         class="col-md-12 attachment-album-thumbnail wp-post-image"
                                                         alt="album-cover-1">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="panel col-md-3">
                                            <div class="panel-heading">
                                                <span class="panel-title">Снимка на Албума</span>
                                            </div>
                                            <div class="panel-body" id="album_image_box">
                                                @if (strlen($album->album_image) > 1)
                                                    <img class="col-md-12" style="height: 190px;"
                                                         src="{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->album_image }}">
                                                    <a href="#" style="position: absolute;top: 10px;right: 10px;"
                                                       onclick="deleteFile({{ $album->id }}, 'album_image'); return false;"
                                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                        Изтрий</a>
                                                @else
                                                    <img height="190"
                                                         src="{{ Config::get('view.frontend.img') }}/albums/albumCover.png"
                                                         class="col-md-12 attachment-album-thumbnail wp-post-image"
                                                         alt="album-cover-1">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="panel col-md-3">
                                            <div class="panel-heading">
                                                <span class="panel-title">Снимка на Фона</span>
                                            </div>
                                            <div class="panel-body" id="background_image_box">
                                                @if (strlen($album->background_image) > 1)
                                                    <img class="col-md-12" style="height: 190px;"
                                                         src="{{ str_replace(':pid', $album->id, Config::get('images.disk_image') )}}/{{ $album->background_image }}">
                                                    <a href="#" style="position: absolute;top: 10px;right: 10px;"
                                                       onclick="deleteFile({{ $album->id }}, 'background_image'); return false;"
                                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                        Изтрий</a>
                                                @else
                                                    <img height="190"
                                                         src="{{ Config::get('view.frontend.img') }}/albums/bg_default.png"
                                                         class="col-md-12 attachment-album-thumbnail wp-post-image"
                                                         alt="album-cover-1">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="jq-validation-required" class="col-sm-2 control-label">Снимка на
                                        Диска</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="disc_image" id="styled-finputs-example1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jq-validation-required" class="col-sm-2 control-label">Снимка на
                                        Албума</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="album_image" id="styled-finputs-example2">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jq-validation-required" class="col-sm-2 control-label">Снимка на
                                        Фона</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="background_image" id="styled-finputs-example3">
                                    </div>
                                </div>

                                <script>
                                    init.push(function () {
                                        $('#styled-finputs-example1').pixelFileInput({placeholder: 'Няма избран файл...'});
                                        $('#styled-finputs-example2').pixelFileInput({placeholder: 'Няма избран файл...'});
                                        $('#styled-finputs-example3').pixelFileInput({placeholder: 'Няма избран файл...'});
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

    <script type="text/javascript">
        function deleteFile(id, type) {
            var warning = 'Сигурни ли сте, че искате да изтриете снимката?';

            if (confirm(warning)) {

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('music_albums.delete-file-aj') }}",
                    data: {
                        '_token': CSRF_TOKEN,
                        'id': id,
                        'type': type
                    },
                    success: function (response) {
                        if (response.success) {
                            if (type == "disc_image") {
                                $("disc_image_box").remove();
                            }
                            if (type == 'album_image') {
                                $("album_image_box").remove();
                            }
                            if (type == 'background_image') {
                                $("background_image_box").remove();
                            }
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
                },

            });
            $.extend($.validator.messages, {
                required: "Попълнете полето!",
            });
        });


    </script>
    <!-- / Javascript -->
@endsection