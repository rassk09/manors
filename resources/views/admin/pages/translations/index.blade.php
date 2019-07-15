@extends('admin.layouts.app')

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
    {{--@include('admin.layouts.partials.breadcrumbs')--}}

    <!-- begin page-header -->
        <h1 class="page-header">{{ $instance->getModuleTitle() }} <small>Показано {{ $data->count() }} {{ $instance->getModulePluralName($data->count()) }}</small></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin result-container -->
                <div class="result-container">
                    <div class="row">
                        <div class="col-md-12">
                            @if ($instance->isSearchable())
                                <!-- begin input-group -->
                                    {!! Form::open(['method' => 'get']) !!}
                                    <div class="input-group input-group-lg m-b-20">
                                        <input type="text" class="form-control input-white" name="q" placeholder="Поиск по названию или ID..." {!! isset($search_query) ? ' value="'.$search_query.'" ' : '' !!} />
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Найти</button>
                                        </div>
                                    </div>
                                    @foreach(request()->all() as $attribute => $value)
                                        @if(!in_array($attribute, ['q', 'page', 'filter']))
                                            {!! Form::hidden($attribute, $value) !!}
                                        @endif
                                        @if($attribute == 'filter')
                                            @foreach($value as $filter_attribute => $filter_value)
                                                {!! Form::hidden('filter[' . $filter_attribute . ']', $filter_value) !!}
                                            @endforeach
                                        @endif
                                    @endforeach
                                    {!! Form::close() !!}
                                <!-- end input-group -->
                            @endif

                            @if($instance->isCreatable())
                                <a href="{{ route('admin_translations_create_page') }}" class="btn btn-primary pull-left m-r-10 m-b-20"><i class="fas fa-plus m-r-5"></i> Добавить <span class="d-none d-md-inline">{{$instance->getModulePluralName(-1)}}</span></a>
                            @endif

                            {!! $data->onEachSide(1)->links('admin.layouts.partials.pagination', ['class' => 'pull-right m-t-3 m-b-20']) !!}
                        </div>
                    </div>

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    @foreach($instance->getAdminColumns() as $column)
                                        <th>
                                            @include('admin.modules.list.default.column_head', ['column' => $column])
                                        </th>
                                    @endforeach

                                    @if (count($instance->getCustomActionConfiguration()) > 0 || $instance->isEditable() || $instance->isDeletable())
                                        <th width="240">Действия</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr data-id="{{$item->id}}">
                                        @foreach($instance->getAdminColumns() as $column)
                                            <td>
                                                {!! $column->render($item) !!}
                                            </td>
                                        @endforeach
                                        @if (count($instance->getCustomActionConfiguration()) > 0 || $instance->isEditable() || $instance->isDeletable())
                                            <td class="text-nowrap">
                                                <div class="pull-left width-xs progress progress-striped active m-l-5 m-r-10">
                                                    <div class="progress-bar bg-{{$item->getProgressColor()}}" style="width: {{$item->getProgress()}}%">{{$item->getProgress()}}%</div>
                                                </div>

                                                @if ($instance->isEditable())
                                                    <a href="{{ route('admin_translations_edit_page', ['id' => $item->code]) }}" class="btn btn-warning btn-icon btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                                                @endif

                                                @if ($instance->isDeletable())
                                                    <a href="{{ route('admin_translations_destroy', ['id' => $item->code]) }}" class="btn btn-danger btn-icon btn-sm m-l-5 delete_button" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                                                @endif

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- begin pagination -->
                    <div class="clearfix m-t-20 m-b-20">
                        {!! $data->onEachSide(1)->links('admin.layouts.partials.pagination', ['class' => 'pull-right']) !!}
                    </div>
                    <!-- end pagination -->
                </div>
                <!-- end result-container -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection

@section('js')
    <script>
        $(document).on('click', '.delete_button', function(e) {
            e.preventDefault();
            var url = $(this).attr('href'),
                row = $(this).parents('tr');

            swal({
                title: "Вы уверены?",
                text: "После удаления будет невозможно восстановить запись",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: 'Удалить',
                        visible: true,
                        className: 'btn btn-warning',
                        closeModal: false
                    },
                    cancel: {
                        text: 'Отмена',
                        className: 'btn',
                        visible: true,
                        closeModal: true
                    }
                },
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.get(url, {}, function(out){
                        row.remove();
                        swal({
                            title: "Готово!",
                            text: "Запись удалена",
                            icon: "success",
                            buttons: {
                                confirm: {
                                    text: 'Закрыть',
                                    visible: true,
                                    className: 'btn btn-success',
                                    closeModal: true
                                },
                            },
                        })
                    }, 'json');
                }
            });
        });

    </script>

    @stack('custom_js')
@endsection
