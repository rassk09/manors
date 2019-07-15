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

                            @foreach($item->getTranslationFields() as $field)
                                {!! $field->renderTranslations($item, $locale) !!}
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
    <script>
        (function(){
            $('[data-action="copy_translation"]').click(function(){
                let parent = $(this).parents('.form-group.row'),
                    value = parent.find('[data-source]').html(),
                    is_mce = parent.find('[data-mce]').length,
                    is_image = parent.find('[data-image]').length,
                    attr = parent.attr('data-attr');

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