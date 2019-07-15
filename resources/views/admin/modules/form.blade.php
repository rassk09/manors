@extends('admin.layouts.app')

@section('content')
    <div id="content" class="content">
        @if ($item ?? null)
            {!! Form::model($item, ['class' => 'form-horizontal form-bordered', 'method' => 'put', 'action' => ['Admin\AdminController@update', $module_name, $item->id], 'files' => true]) !!}
        @else
            {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\AdminController@store', $module_name], 'files' => true]) !!}
        @endif
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin result-container -->
                    <div class="result-container">
                        <div class="btn-group m-r-5 m-b-20">
                            <a href="{{ route('admin_module_index', ['module' => $module_name]) }}" class="btn btn-white btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Назад"><i class="fa fa-reply"></i></a>
                        </div>
                        <div class="btn-group m-r-5 m-b-20">
                            <button type="submit" class="btn btn-primary p-l-20 p-r-20 btn-sm">
                                <i class="fa fa-check m-r-5"></i> Сохранить {{$instance->getModulePluralName(-1)}}
                            </button>
                        </div>
                        <div class="btn-group m-r-5 m-b-20">
                            @if ($item ?? null)
                                <a href="{{action('Admin\AdminController@destroy', ['module' => $module_name, 'id' => $item->id])}}" class="btn btn-white delete_button btn-sm p-l-20 p-r-20" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                            @else
                                <a href="{{\Request::fullUrl()}}" class="btn btn-white delete_button btn-sm p-l-20 p-r-20" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                            @endif
                            <a href="{{\Request::fullUrl()}}" class="btn btn-white clean_button btn-sm p-l-20 p-r-20" data-tooltip="tooltip" data-placement="top" data-title="Сбросить"><i class="fa fa-sync"></i></a>
                        </div>

                        @if ($item ?? null)
                            <div class="pull-right">
                                <div class="btn-group btn-toolbar pull-left">
                                    <a href="{{ isset($previous_id) ? action('Admin\AdminController@edit', ['module' => $module_name, 'id' => $previous_id]) : '#'}}" class="btn btn-white btn-sm {{ isset($previous_id) ? '' : 'disabled' }}" data-tooltip="tooltip" data-placement="top" data-title="Предыдущая запись"><i class="fa fa-arrow-up"></i></a>
                                    <a href="{{ isset($next_id) ? action('Admin\AdminController@edit', ['module' => $module_name, 'id' => $next_id]) : '#'}}" class="btn btn-white btn-sm {{ isset($next_id) ? '' : 'disabled' }}" data-tooltip="tooltip" data-placement="top" data-title="Следующая запись"><i class="fa fa-arrow-down"></i></a>
                                </div>
                                <div class="btn-group m-l-5 pull-left">
                                    <a href="{{action('Admin\AdminController@index', ['module' => $module_name])}}" class="btn btn-white btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Отменить"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        @endif

                        @if (count($instance->getCustomTabs()) > 0)
                            <!-- begin nav-tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-items">
                                    <a href="{!! request()->fullUrl() !!}" class="nav-link active">
                                        <span>Общее</span>
                                    </a>
                                </li>
                                @if (isset($item))
                                    @foreach($instance->getCustomTabs() as $customTab)
                                        <li class="nav-items">
                                            <a href="{!! $customTab->getActionURL($module_name, $item->id) !!}" class="nav-link">
                                                <span>{!! $customTab->getTooltip() !!}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <!-- end nav-tabs -->
                        @endif

                        <div class="card p-20">
                            <h4 class="m-t-0 m-b-0 p-b-10 underline">
                                @if ($item ?? null)
                                    Редактирование записи
                                    <small>{{$item->name}}</small>
                                @else
                                    Новая запись - {{$instance->getModulePluralName(1)}}
                                @endif
                            </h4>

                            @if ($item ?? null)
                                {!! \App\Admin\Form\BaseControl::text('id')->setTitle('ID')->disabled()->render($state, $item) !!}
                                {!! \App\Admin\Form\BaseControl::text('created_at')->setTitle('Дата добавления')->disabled()->render($state, $item) !!}
                                {!! \App\Admin\Form\BaseControl::text('updated_at')->setTitle('Дата обновления')->disabled()->render($state, $item) !!}
                            @endif

                            @foreach($instance->getAdminFormControl() as $field)
                                {!! $field->render($state, $item ?? null) !!}
                            @endforeach

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