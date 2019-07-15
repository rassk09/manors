@extends('admin.layouts.app')

@section('content')
    <div id="content" class="content">
    @if ($item ?? null)
        {!! Form::model($item, ['class' => 'form-horizontal form-bordered', 'method' => 'put', 'action' => ['Admin\TranslationsController@updateCode', $item->code], 'files' => true]) !!}
    @else
        {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\TranslationsController@storeCode'], 'files' => true]) !!}
    @endif
    <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin result-container -->
                <div class="result-container">
                    <div class="btn-group m-r-5 m-b-20">
                        <a href="{{ route('admin_translations_index') }}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" data-title="Назад"><i class="fa fa-reply"></i></a>
                    </div>
                    <div class="btn-group m-r-5 m-b-20">
                        <button type="submit" class="btn btn-primary p-l-20 p-r-20 btn-sm">
                            <i class="fa fa-check m-r-5"></i> Сохранить {{$instance->getModulePluralName(-1)}}
                        </button>
                    </div>
                    <div class="btn-group m-r-5 m-b-20">
                        @if ($item ?? null)
                            <a href="{{action('Admin\TranslationsController@destroyCode', ['id' => $item->id])}}" class="btn btn-white delete_button btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                        @else
                            <a href="{{\Request::fullUrl()}}" class="btn btn-white delete_button btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                        @endif
                        <a href="{{\Request::fullUrl()}}" class="btn btn-white clean_button btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-placement="top" data-title="Сбросить"><i class="fa fa-sync"></i></a>
                    </div>

                    @if ($item ?? null)
                        <div class="pull-right">
                            <div class="btn-group btn-toolbar pull-left">
                                <a href="{{ isset($previous_id) ? action('Admin\TranslationsController@editCode', ['id' => $previous_id]) : '#'}}" class="btn btn-white btn-sm {{ isset($previous_id) ? '' : 'disabled' }}" data-tooltip="tooltip" data-placement="top" data-title="Предыдущая запись"><i class="fa fa-arrow-up"></i></a>
                                <a href="{{ isset($next_id) ? action('Admin\TranslationsController@editCode', ['id' => $next_id]) : '#'}}" class="btn btn-white btn-sm {{ isset($next_id) ? '' : 'disabled' }}" data-tooltip="tooltip" data-placement="top" data-title="Следующая запись"><i class="fa fa-arrow-down"></i></a>
                            </div>
                            <div class="btn-group m-l-5 pull-left">
                                <a href="{{action('Admin\TranslationsController@index')}}" class="btn btn-white btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Отменить"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    @endif

                    <div class="card p-20">
                        <h4 class="m-t-0 m-b-0 p-b-10 underline">
                            @if ($item ?? null)
                                Редактирование записи
                                <small>{{$item->code}}</small>
                            @else
                                Новая запись - {{$instance->getModulePluralName(1)}}
                            @endif
                        </h4>

                        <div class="form-group row">
                            {!! Form::label('code', 'Ключ', ['class' => 'col-md-4 col-form-label text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::text('code', $code ?? null, ['class' => 'form-control', 'data-parsley-required' => "true", 'placeholder' => 'Введите значение...']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('master_content', 'Значение мастер-версии сайта ('.$master_locale->code.')', ['class' => 'col-md-4 col-form-label text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::text('master_content', isset($code) ? $master_locale->getContent($code) : null, ['class' => 'form-control', 'data-parsley-required' => "true"]) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('translations', 'Переводы', ['class' => 'col-md-4 col-form-label text-right']) !!}
                            <div class="col-md-8">
                                @foreach($locales as $locale)
                                    <div class="m-b-5">
                                        {!! Form::label('locale_content_'.$locale->id, $locale->getLocaleName(), ['class' => 'control-label']) !!}
                                        {!! Form::text('locale_content_'.$locale->id, isset($code) ? $locale->getContent($code) : null, ['class' => 'form-control']) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Сохранить {{$instance->getModulePluralName(-1)}}</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end result-container -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->

        {!! Form::hidden('__referer', url()->previous()) !!}
        {!! Form::close() !!}
    </div>
    <!-- end #content -->
@endsection

@section('js')
    <script>
        (function(){
            $('form').parsley();
        })();
    </script>

    @stack('js')
@endsection