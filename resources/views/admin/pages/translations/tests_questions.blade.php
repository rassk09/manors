@extends('admin.layouts.app')

@section('content')
    <div id="content" class="content">
        {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\TranslationsController@updateModule', $model_name, $locale->code, $model_id], 'files' => true]) !!}
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin result-container -->
                    <div class="result-container">
                        <div class="btn-group m-r-5 m-b-20">
                            <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" data-title="Назад"><i class="fa fa-reply"></i></a>
                        </div>
                        <div class="btn-group m-r-5 m-b-20">
                            <button type="submit" class="btn btn-primary p-l-20 p-r-20 btn-sm">
                                <i class="fa fa-check m-r-5"></i> Сохранить переводы
                            </button>
                        </div>
                        <div class="btn-group m-r-5 m-b-20">
                            <a href="{{\Request::fullUrl()}}" class="btn btn-white clean_button btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-placement="top" data-title="Сбросить"><i class="fa fa-sync"></i></a>
                        </div>

                        <div class="card p-20">
                            <h4 class="m-t-0 m-b-0 p-b-10 underline">
                                Перевод
                                <small>{{$item->name}}</small>
                            </h4>

                            <div class="form-group row">
                                <div class="col-md-2 col-form-label p-t-15" style="border-left: none;">&nbsp;</div>
                                <div class="col-md-5"><h4 class="text-center m-t-0 m-b-0">Мастер-версия (ru-RU)</h4></div>
                                <div class="col-md-5">
                                    <h4 class="text-center m-t-0 m-b-0">
                                        Перевод ({{$locale->code}})
                                        <a href="#" class="btn btn-purple btn-sm m-l-5" data-toggle="dropdown"><i class="fa fa-pencil-alt m-r-5"></i> Изменить <i class="caret m-l-5"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            @foreach(\Auth::user()->getAvailableLocales() as $other_locale)
                                                @if (!$other_locale->is_master && $other_locale->id != $locale->id)
                                                    <li><a href="{{ route('admin_translations_module_edit_page', ['module' => $model_name, 'code' => $other_locale->code, 'id' => $item->id]) }}">{!! $other_locale->getAdminFlagIcon() . $other_locale->getLocaleName() !!}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </h4>
                                </div>
                            </div>

                            @foreach($item->questions as $question)
                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label">
                                        <h4>Вопрос №{{$loop->iteration}}</h4>
                                    </label>
                                </div>

                                <!-- Question Title -->
                                @php($field_attr = '__content_testquestion_' . $question->id. '_name')
                                <div class="form-group row" data-attr="{{ $field_attr }}">
                                    {!! Form::label($field_attr, 'Текст вопроса', ['class' => 'col-md-2 col-form-label text-right']) !!}
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <span class="form-control" data-source>{{$question->name}}</span>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-icon btn-lg" data-action="copy_translation" data-tooltip="tooltip" data-placement="top" data-title="Скопировать"><i class="fa fa-angle-double-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        {!! Form::text($field_attr, $locale->getContent($field_attr), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <!-- Question Image -->
                                @php($field_attr = '__content_testquestion_' . $question->id. '_image')
                                <div class="form-group row" data-attr="{{ $field_attr }}">
                                    {!! Form::label($field_attr, 'Изображение', ['class' => 'col-md-2 col-form-label text-right']) !!}
                                    <div class="col-md-5">
                                        <img src="{{ $question->image }}" class="d-block width-150 m-auto m-b-15">
                                        <div class="input-group">
                                            <span class="form-control text-ellipsis" data-source data-image>{{ $question->image }}</span>
                                            <span class="input-group-append">
                                                <a href="{{ $question->image }}" target="_blank" class="btn btn-primary"><i class="fa fa-download m-r-5"></i> Скачать</a>
                                            </span>
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-icon btn-lg" data-action="copy_translation" data-tooltip="tooltip" data-placement="top" data-title="Скопировать"><i class="fa fa-angle-double-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="drop-area" id="drop_area-{!! $field_attr !!}" data-action="{{action('Admin\ApiController@uploadTestImage')}}" data-file-name="{{$field_attr}}">
                                            <div id="gallery">
                                                @if ($locale->getContent($field_attr))
                                                    <img src="{{ $locale->getContent($field_attr) }}"/>
                                                    {!! Form::hidden($field_attr, $locale->getContent($field_attr)) !!}
                                                @endif
                                            </div>
                                            <div class="my-form">
                                                @if (!$locale->getContent($field_attr))
                                                    <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                                                @endif
                                                <h3 class="text-center">
                                                    <label for="fileElem-{!! $field_attr !!}"><b>Выберите файл</b> или перетащите его.</label>
                                                </h3>
                                                <p class="text-center">Загружайте изображения в формате <b>JPG</b>, <b>GIF</b> или <b>PNG</b>.</p>
                                                <input type="file" id="fileElem-{!! $field_attr !!}" accept="image/*" />
                                                <div class="progress rounded-corner progress-striped active d-none">
                                                    <div class="progress-bar bg-lime" style="width: 0;">
                                                        0%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question Answers -->
                                <div class="form-group row">
                                    {!! Form::label('', 'Ответы', ['class' => 'col-md-2 col-form-label text-right']) !!}
                                    @if ($item->test_format_id != 3)
                                        <div class="col-md-5">
                                            @foreach($question->answers as $answer)
                                                @php($field_attr = '__content_testquestionanswer_' . $answer->id. '_name')
                                                <div class="input-group m-b-10">
                                                    <div class="input-group-prepend"><span class="input-group-text width-40 text-center">#{{ $loop->iteration }}</span></div>
                                                    <span class="form-control" data-source data-attr="{{ $field_attr }}">{{ $answer->name }}</span>
                                                    <span class="input-group-append">
                                                        <button type="button" class="btn btn-primary btn-icon btn-lg" data-action="copy_translation" data-tooltip="tooltip" data-placement="top" data-title="Скопировать"><i class="fa fa-angle-double-right"></i></button>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-5">
                                            @foreach($question->answers as $answer)
                                                @php($field_attr = '__content_testquestionanswer_' . $answer->id. '_name')
                                                <div class="input-group m-b-10">
                                                    <div class="input-group-prepend"><span class="input-group-text width-40 text-center">#{{ $loop->iteration }}</span></div>
                                                    {!! Form::text($field_attr, $locale->getContent($field_attr), ['class' => 'form-control']) !!}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else

                                    @endif
                                </div>
                            @endforeach

                            <div class="form-group">
                                <div class="col-md-5 offset-md-7">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Сохранить переводы</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end result-container -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->

            {!! Form::hidden('locale_id', $locale->id) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('js')
    <link href="/assets/plugins/html5_drag_and_drop/style.css" rel="stylesheet" />
    <script src="/assets/plugins/html5_drag_and_drop/script.js"></script>

    <script>
        (function(){
            $('[data-action="copy_translation"]').click(function(){
                let parent = $(this).parents('.form-group.row'),
                    value = parent.find('[data-source]').html(),
                    is_mce = parent.find('[data-mce]').length,
                    is_image = parent.find('[data-image]').length,
                    attr = parent.attr('data-attr');

                if (!attr) {
                    attr = $(this).parents('.input-group').find('[data-attr]').attr('data-attr');
                    value = $(this).parents('.input-group').find('[data-source]').html();
                }

                if (is_mce) {
                    tinymce.get(attr).setContent(value);
                } else if (is_image) {
                    let dropArea = parent.find('.drop-area'),
                        img = $('<img/>').attr('src', value);

                    dropArea.find('[name="' + attr + '"]').remove();
                    dropArea.append('<input type="hidden" name="' + attr + '" value="' + value + '"/>');

                    dropArea.find('#gallery img').remove();
                    dropArea.find('#drop_icon').hide();
                    dropArea.find('#gallery').show().append(img);
                } else {
                    $('[name="' + attr + '"]').val(value);
                }

            });
        })();
    </script>

    @stack('js')
@endsection