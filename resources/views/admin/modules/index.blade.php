@extends('admin.layouts.app')

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        @include('admin.layouts.partials.breadcrumbs')

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
                                        @if ($instance->isExportable())
                                            <button type="button" class="btn btn-primary dropdown-toggle no-caret" data-toggle="dropdown" aria-expanded="false" data-tooltip="tooltip" data-placement="top" data-title="Выгрузить в файл">
                                                <i class="fa fa-download fa-fw"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right" x-placement="bottom-start" style="position: absolute; transform: translate3d(909px, 46px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                {{--<li><a href="javascript:;" class="jsExport" data-ext="xlsx"><i class="fas fa-file-excel fa-lg text-lime m-r-5"></i> <span>Скачать XLSX</span></a></li>--}}
                                                <li><a href="{{ route('admin_module_export', ['module' => $module_name, 'type' => 'xls']) }}?{!! request()->getQueryString() !!}" target="_blank" download><i class="fas fa-file-excel fa-lg text-lime m-r-5"></i> <span>Скачать XLS</span></a></li>
                                                <li><a href="{{ route('admin_module_export', ['module' => $module_name, 'type' => 'csv']) }}?{!! request()->getQueryString() !!}"><i class="fas fa-file-code fa-lg text-warning m-r-5"></i> <span>Скачать CSV</span></a></li>
                                                <li><a href="{{ route('admin_module_export', ['module' => $module_name, 'type' => 'txt']) }}?{!! request()->getQueryString() !!}"><i class="fas fa-file-alt fa-lg text-gray m-r-5"></i> <span>Скачать TXT</span></a></li>
                                            </ul>
                                        @endif
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
                                <a href="{{ route('admin_module_create_page', ['module' => $module_name]) }}" class="btn btn-primary pull-left m-r-10 m-b-20"><i class="fas fa-plus m-r-5"></i> Добавить <span class="d-none d-md-inline">{{$instance->getModulePluralName(-1)}}</span></a>
                            @endif

                            @if($instance->isMassDeletable())
                                <button data-action="{{ route('admin_module_massive_destroy', ['module' => $module_name]) }}" class="btn btn-danger pull-left m-r-10 m-b-20 jsMassDeleteButton" style="display: none;"><i class="fas fa-trash m-r-5"></i> Удалить отмеченные</button>
                            @endif

                            @if(request()->filter || request()->date_start || request()->date_end)
                                <a href="/{!! request()->path() !!}" class="btn btn-success pull-left m-r-10 m-b-20"><i class="fa fa-sync m-r-5"></i> Сбросить фильтры</a>
                            @endif

                            @foreach($instance->getAdminFilters() as $filter)
                                @if ($filter->getType() == 'select')
                                    {!! $filter->render() !!}
                                @endif
                            @endforeach

                            <!-- begin btn-group -->
                            {{--<div class="btn-group  pull-left m-r-10 m-b-20">--}}
                                {{--<a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-list"></i></a>--}}
                                {{--<a href="javascript:;" class="btn btn-white btn-white-without-border active"><i class="fa fa-th"></i></a>--}}
                                {{--<a href="javascript:;" class="btn btn-white btn-white-without-border"><i class="fa fa-th-large"></i></a>--}}
                            {{--</div>--}}
                            <!-- end btn-group -->

                            {!! $data->onEachSide(1)->links('admin.layouts.partials.pagination', ['class' => 'pull-right m-t-3 m-b-20']) !!}

                        </div>
                    </div>

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="headerTable">
                                <thead>
                                    <tr>
                                        @if ($instance->isMassDeletable())
                                            <th width="10" class="with-checkbox">
                                                <div class="checkbox checkbox-css">
                                                    <input type="checkbox" id="massDeleteAll" class="check_all" />
                                                    <label for="massDeleteAll"></label>
                                                </div>
                                            </th>
                                        @endif
                                        <th width="60">
                                            @include('admin.modules.list.default.column_head', ['column' => $instance->getAdminAttributeColumn('id', 'ID', 'text', true)])
                                        </th>
                                        @foreach($instance->getAdminColumns() as $column)
                                            <th>
                                                @include('admin.modules.list.default.column_head', ['column' => $column])
                                            </th>
                                        @endforeach
                                        @if (count($instance->getCustomActionConfiguration()) > 0 || $instance->isEditable() || $instance->isDeletable())
                                            <th width="40">Действия</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        <tr data-id="{{$item->id}}" class="{!! $item->is_active === 0 ? ' row_hidden ' : '' !!}">
                                            @if ($instance->isMassDeletable())
                                                <td width="10" class="with-checkbox">
                                                    <div class="checkbox checkbox-css">
                                                        <input type="checkbox" id="massDelete{{$item->id}}" class="mass_delete_checkbox" />
                                                        <label for="massDelete{{$item->id}}"></label>
                                                    </div>
                                                </td>
                                            @endif
                                            <td>{{$item->id}}</td>
                                            @foreach($instance->getAdminColumns() as $column)
                                                <td>
                                                    {!! $column->render($item) !!}
                                                </td>
                                            @endforeach

                                            @if (count($instance->getCustomActionConfiguration()) > 0 || $instance->isEditable() || $instance->isDeletable())
                                                <td class="text-nowrap">
                                                    @foreach($instance->getCustomActionConfiguration() as $action)
                                                        @if (!$action->isHidden())
                                                            {!! $action->buildHtml($module_name, $item->id) !!}
                                                        @endif
                                                    @endforeach

                                                    @if ($instance->isTranslatable())
                                                        <a href="#" class="btn btn-purple btn-sm m-r-5" data-toggle="dropdown"><i class="fa fa-globe m-r-5"></i> Перевести <i class="caret m-l-5"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            @foreach(\Auth::user()->getAvailableLocales() as $locale)
                                                                @if (!$locale->is_master)
                                                                    <li>
                                                                        <a href="{{ route('admin_translations_module_edit_page', ['module' => $instance->getNameOfClass(), 'code' => $locale->code, 'id' => $item->id]) }}">
                                                                            {!! $locale->getAdminFlagIcon() . $locale->getLocaleName() !!}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @endif

                                                    @if ($instance->isToggleActive())
                                                        @if ($item->is_active === 0)
                                                            <div class="btn btn-grey btn-icon btn-sm m-r-5 jsActiveToggle" data-action="{{ route('admin_module_active', ['module' => $module_name, 'id' => $item->id]) }}" data-tooltip="tooltip" data-placement="top" data-title="Показать/Скрыть"><i class="fa fa-eye-slash"></i></div>
                                                        @else
                                                            <div class="btn btn-success btn-icon btn-sm m-r-5 jsActiveToggle" data-action="{{ route('admin_module_active', ['module' => $module_name, 'id' => $item->id]) }}" data-tooltip="tooltip" data-placement="top" data-title="Показать/Скрыть"><i class="fa fa-eye"></i></div>
                                                        @endif
                                                    @endif

                                                    @if ($instance->isEditable())
                                                        <a href="{{ route('admin_module_edit_page', ['module' => $module_name, 'id' => $item->id]) }}" class="btn btn-warning btn-icon btn-sm" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                                                    @endif

                                                    @if ($instance->isDeletable())
                                                        <a href="{{ route('admin_module_destroy', ['module' => $module_name, 'id' => $item->id]) }}" class="btn btn-danger btn-icon btn-sm m-l-5 delete_button" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
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

    @foreach($instance->getCustomActionConfiguration() as $action)
        @if (!$action->isHidden() && $modal = $action->getModal())
            @include('admin.modules.list.' . $modal)
        @endif
    @endforeach

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
            })
            .then((isConfirm) => {
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

        $(document).on('change', '.mass_delete_checkbox', function(){
            isMassDeleteButtonShown();
        });

        $(document).on('change', '.check_all', function(){
            $('.mass_delete_checkbox').prop('checked', $(this).is(':checked'));
            isMassDeleteButtonShown();
        });

        $('.jsMassDeleteButton').click(function(){
            var url = $(this).attr('data-action');

            swal({
                title: "Вы уверены?",
                text: "Выбрано " + $('.mass_delete_checkbox:checked').length + " записей для удаления",
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
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    var arr_rows_id = [];
                    $('.mass_delete_checkbox:checked').each(function(){
                        arr_rows_id.push($(this).parents('tr').attr('data-id'));
                    });

                    $.post(url, {arr_rows_id: arr_rows_id}, function(out){
                        $.each(arr_rows_id, function(k, v) {
                            $('tr[data-id="' + v + '"]').remove();
                        });

                        isMassDeleteButtonShown();
                        $('.check_all').prop('checked', false);

                        swal({
                            title: "Готово!",
                            text: "Записи удалены",
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

        $(document).on('click', '.ajax_button', function(e) {
            e.preventDefault();

            var obj = $(this);

            $.post(obj.attr('href'), {}, function(){
                swal({
                    title: "Готово!",
                    text: obj.attr('data-success-text'),
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: 'Закрыть',
                            visible: true,
                            className: 'btn btn-success',
                            closeModal: true
                        },
                    },
                });

                if (obj.attr('data-success-remove') == 'true') {
                    obj.parents('tr').remove();
                }
            });
        });

        $(document).on('click', '[data-toggle="modal"]', function(){
            var obj = $(this),
                data = {};

            $(obj.attr('href')).find('form')
                .attr('action', obj.attr('data-action'))
                .attr('data-success-remove', obj.attr('data-success-remove'))
                .attr('data-row-id', obj.parents('tr').attr('data-id'));

        });

        $('.modal form').submit(function(e){
            e.preventDefault();

            var form = $(this),
                modal = form.parents('.modal'),
                form_valid = form.parsley().validate();

            if (form_valid) {
                $.post(form.attr('action'), form.serialize(), function(response) {
                    modal.modal('hide');
                    form[0].reset();

                    if (response.status == 'success') {
                        swal(response);
                    }

                    if (form.attr('data-success-remove') == 'true') {
                        $('tr[data-id="' + form.attr('data-row-id') + '"]').remove();
                    }

                }, 'json');
            }
        });

        $('.jsActiveToggle').click(function(){
            let row = $(this).parents('tr'),
                isHidden = row.hasClass('row_hidden');

            if (isHidden) {
                row.removeClass('row_hidden');
                $(this).removeClass('btn-grey');
                $(this).addClass('btn-success');
                $(this).attr('data-title', 'Скрыть с сайта');
                $(this).find('i').removeClass('fa-eye-slash');
                $(this).find('i').addClass('fa-eye');
            } else {
                row.addClass('row_hidden');
                $(this).addClass('btn-grey');
                $(this).removeClass('btn-success');
                $(this).attr('data-title', 'Показать на сайте');
                $(this).find('i').addClass('fa-eye-slash');
                $(this).find('i').removeClass('fa-eye');
            }

            $.get($(this).attr('data-action'), {active: isHidden});

        });

        function isMassDeleteButtonShown() {
            var valid = false;
            $('.mass_delete_checkbox').each(function(){
                if ($(this).is(':checked')) {
                    valid = true;
                }
            });

            if (valid) {
                $('.jsMassDeleteButton').show();
            } else {
                $('.jsMassDeleteButton').hide();
            }
        }

    </script>

    @stack('custom_js')
@endsection
