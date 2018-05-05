@extends('backend.layouts.master')
@section('title') @if (!empty($edit)) Промени @else Добави @endif Статия  @endsection

@section('css')
    <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/custom-map.css">
@endsection


@section('content')
    <div id="content-wrapper">

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">@if (!empty($edit)) Промени @else Добави @endif Статия</span>
            </div>
            <div class="panel-body">


                <form class="form-horizontal" method="POST"
                      @if (!empty($edit)) action="{{ route('news.edit', $article->id) }}" @else
                      action="{{ route('news.store') }}" @endif id="jq-validation-form" enctype="multipart/form-data">

                    @include('backend.messages.errors')

                    {{ csrf_field() }}


                    <div class="form-group">


                        <div class="form-group">
                            <label for="jq-validation-required" class="col-sm-2 control-label">Заглавие</label>
                            <div class="col-sm-9">
                                <input @if (!empty($edit)) value="{{ $article->title }}" @endif type="text"
                                       class="form-control" id="title" name="title" placeholder="Заглавие">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jq-validation-required" class="col-sm-2 control-label">Описание</label>
                            <div class="col-md-9">
                                <script>
                                    init.push(function () {
                                        if (!$('html').hasClass('ie8')) {
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
                                {{--<textarea style="resize: vertical;" class="form-control" name="description" rows="5"  id="summernote-example"  placeholder="Описание">@if (!empty($edit)){{ $article->description }}@endif</textarea>--}}
                                <textarea name="description" style="resize: vertical;" rows="5" placeholder="Описание"
                                          class="form-control"
                                          id="summernote-example">@if (!empty($edit)){!!$article->description!!}@endif</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jq-validation-required" class="col-sm-2 control-label">Мини Описание</label>
                            <div class="col-sm-9">
                                <textarea style="resize: vertical;" class="form-control" name="short_desc" rows="5"
                                          placeholder="Мини Описание">@if (!empty($edit)){{ $article->short_desc }}@endif</textarea>
                            </div>
                        </div>

                        <script>
                            init.push(function () {
                                $('#styled-finputs-example').pixelFileInput({placeholder: 'Няма избран файл...'});
                            })
                        </script>
                        @if (!empty($edit) && strlen($article->img) > 1)
                            <div class="form-group" id="img_box_{{ $article->id }}">
                                <label for="jq-validation-required" class="col-sm-2 control-label">Снимка</label>
                                <div class="col-sm-9">
                                    <img class="col-md-12"
                                         src="{{ str_replace(':pid', $article->id, Config::get('images.article_350') )}}/{{ $article->img }}">
                                    <a href="#" style="position: absolute;top: 20px;right: 40px;"
                                       onclick="deleteFile({{ $article->id }}); return false;"
                                       class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Изтрий</a>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="jq-validation-required" class="col-sm-2 control-label">Качи Снимка</label>
                            <div class="col-sm-9">
                                <input type="file" name="img" id="styled-finputs-example">
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
                    'short_desc': {
                        required: true,
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