@extends('admin.layouts.app')

@section('content')
    <div id="content" class="content">
    {!! Form::model($item, ['class' => 'form-horizontal form-bordered', 'method' => 'put', 'action' => ['Admin\AdminController@custom_form_handler', $module_name, $item->id, $action_interface->getAction()], 'files' => true]) !!}
    <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin result-container -->
                <div class="result-container">
                    <div class="btn-group m-r-5 m-b-20">
                        <a href="{{ route('admin_module_index', ['module' => $module_name]) }}" class="btn btn-white btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Назад"><i class="fa fa-reply"></i></a>
                    </div>

                    @if($action_interface->isSaveButton())
                        <div class="btn-group m-r-5 m-b-20">
                            <button type="submit" class="btn btn-primary p-l-20 p-r-20 btn-sm">
                                <i class="fa fa-check m-r-5"></i> Сохранить
                            </button>
                        </div>
                    @endif

                    <div class="btn-group m-r-5 m-b-20">
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
                                <a href="{{ route('admin_module_edit_page', ['module' => $module_name, 'id' => $item->id]) }}" class="nav-link">
                                    <span>Общее</span>
                                </a>
                            </li>
                            @foreach($instance->getCustomTabs() as $customTab)
                                <li class="nav-items">
                                    <a href="{!! $customTab->getActionURL($module_name, $item->id) !!}" class="nav-link {!! $customTab->getAction() == $action_interface->getAction() ? ' active ' : '' !!}">
                                        <span>{!! $customTab->getTooltip() !!}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- end nav-tabs -->
                    @endif

                    <div class="card p-20">
                        <h4 class="m-t-0 m-b-0 p-b-10 underline">
                            Редактирование записи
                            <small>{{$item->name}} - {{$action_interface->getTooltip()}}</small>
                        </h4>

                        @yield('form')

                        @if($action_interface->isSaveButton())
                            <div class="form-group">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Сохранить</button>
                                </div>
                            </div>
                        @endif

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
    @yield('form_js')
@endsection