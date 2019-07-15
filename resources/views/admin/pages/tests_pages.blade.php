@extends('admin.layouts.app')

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Распределение блоков</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h5>Настройки</h5>
                    {!! Form::open(['class' => 'form-horizontal', 'method' => 'get', 'id' => 'filtersForm']) !!}
                        <table>
                            <tr>
                                <td width="50%" class="p-10">
                                    <select name="locale_id" class="form-control">
                                        <option value="0">Выберите локальную версию...</option>
                                        @foreach($locales as $locale)
                                            <option value="{{$locale->id}}" {{ request()->get('locale_id') == $locale->id ? ' selected ' : '' }}>{{$locale->getLocaleName()}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="50%" class="p-10">
                                    <select name="category_id" class="form-control">
                                        <option value="0">Все тесты</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ request()->get('category_id') == $category->id ? ' selected ' : '' }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="100" class="p-10">
                                    <button class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Применить</button>
                                </td>
                            </tr>
                        </table>
                    {!! Form::close() !!}
                </div>

                @if (request()->get('locale_id'))
                    <div class="card p-20">

                        @if ($tests_absent->count() > 0)
                            <div class="note note-yellow m-b-15">
                                <div class="note-icon f-s-20 p-t-10">
                                    <i class="fa fa-lightbulb fa-2x"></i>
                                </div>
                                <div class="note-content">
                                    <h4 class="m-t-5 m-b-5 p-b-2">Внимание!</h4>
                                    <ul class="p-l-25">
                                        <li>На данной странице отсутствует <strong>{{ $tests_absent->count() }}</strong> {!! \App\Models\Test::first()->getModulePluralName($tests_absent->count()) !!}.</li>
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="pull-right">
                            @if ($tests_absent->count() > 0)
                                <button type="button" class="btn btn-primary m-b-20 m-r-5" data-toggle="dropdown"><i class="fa fa-plus m-r-5"></i> Добавить новые <i class="caret"></i></button>
                                <ul class="dropdown-menu pull-right">
                                    @foreach($tests_absent as $test)
                                        <li><a href="#" class="jsAddTest" data-id="{{ $test->id }}">{{ $test->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="btn btn-warning m-b-20 m-r-5" data-action="reset_positions"><i class="fa fa-sync m-r-5"></i> Сбросить позиции</button>
                        </div>
                        <h5 class="m-b-40">Блоки</h5>
                        @if ($tests_pages->count() > 0)
                            <div class="grid-stack" data-gs-width="12" data-gs-current-height="120">
                                @foreach($tests_pages as $test)
                                    <div class="grid-stack-item" data-gs-no-resize="true" data-test-id="{{$test->id}}"
                                         @if($test->x != null || $test->y  != null) data-gs-x="{{$test->x * 3}}" data-gs-y="{{$test->y * 3}}" @endif
                                         @if($test->image_size == 1)
                                            data-gs-width="3" data-gs-height="3"
                                         @elseif($test->image_size == 2)
                                            data-gs-width="6" data-gs-height="3"
                                         @elseif($test->image_size == 3)
                                            data-gs-width="6" data-gs-height="6"
                                        @endif
                                    >
                                        <div class="grid-stack-item-content" style="background-image: url({{$test->image_size == 2 ? $test->test->image_2x1 : (isset($test->test->image) ? $test->test->image : '')}});background-size: cover;">
                                            <div class="btn btn-warning btn-icon btn-xs" data-action="change_size" style="position:absolute; top: 8px; right: 30px; z-index: 3" data-id="{{$test->id}}" data-image-size="{{$test->image_size}}" data-tooltip="tooltip" data-placement="top" data-title="Изменить размер"><i class="fa fa-pencil-alt"></i></div>
                                            <div class="btn btn-danger btn-icon btn-xs" data-action="delete_test" style="position:absolute; top: 8px; right: 8px; z-index: 3" data-id="{{$test->id}}" data-tooltip="tooltip" data-placement="top" data-title="Убрать со страницы"><i class="fa fa-trash"></i></div>
                                            <h4 style="color: {{$test->test->title_color}}">{{$test->test->name}}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <link rel="stylesheet" href="/assets/plugins/gridstack/dist/gridstack.css"/>
    <script src="/assets/plugins/gridstack/dist/lodash.min.js"></script>
    <script src="/assets/plugins/gridstack/dist/gridstack.js"></script>
    <script src="/assets/plugins/gridstack/dist/gridstack.jQueryUI.js"></script>

    <style type="text/css">
        .grid-stack-item-content {
            color: #2c3e50;
            text-align: center;
            background-color: #18bc9c;
            background-position: center center;
            background-size: cover;
            cursor: move;
        }

        .grid-stack-item-content button {
            cursor: pointer;
        }

        .grid-stack-item-content h4 {
            position: absolute;
            bottom: 30px;
            left: 30px;
            padding-right: 30px;
            width: calc(100% - 30px);
            text-align: left;
            text-transform: uppercase;
            font-weight: 700;
            line-height: 1.291666667;
            font-size: calc(1.14286px + 1.7484vw);
        }

        [data-gs-width="6"][data-gs-height="3"] .grid-stack-item-content h4 {
            left: 44%;
            top: 5%;
            height: 90%;
            text-transform: none;
            display: flex;
            justify-content: center;
            align-content: center;
            flex-direction: column;
            width: 55%;
            padding-bottom: 10px;
            font-weight: 700;
            line-height: 1.125;
            font-size: calc(1.14286px + 1.7484vw);
        }

    </style>

    <!-- #modal-edit -->
    <div class="modal fade" id="editTypeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Изменение размера</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Размер изображения</label>
                                <select name="image_size" class="form-control">
                                    <option value="1">1x1</option>
                                    <option value="2">2x1</option>
                                    <option value="3">2x2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button class="btn btn-success">Сохранить</button>
                        <input type="hidden" name="test_id" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        (function () {
            let category_id = $('[name="category_id"]').val();

            $('.grid-stack').gridstack({
                cellHeight: getCellHeight(),
                verticalMargin: 20,
            }).on('dragstop', function(event, ui) {
                let grid = $(this),
                    items = grid.find('[data-test-id]'),
                    positions = {};

                setTimeout(function () {
                    $.each(items, function(index, value) {
                        positions[$(value).attr('data-test-id')] = {
                            'sortable' : index,
                            'x': $(value).attr('data-gs-x'),
                            'y': $(value).attr('data-gs-y'),
                        }
                    });

                    $.post('{{action('Admin\ApiController@storeTestsPages')}}', {positions: positions});

                }, 200);
            });

            $('[data-action="change_size"]').click(function(){
                $('#editTypeModal').modal('show');
                $('#editTypeModal [name="test_id"]').val($(this).attr('data-id'));
                $('#editTypeModal [name="image_size"]').val($(this).attr('data-image-size'));
            });

            $('#editTypeModal form').submit(function(e){
                e.preventDefault();
                $.post('{{action('Admin\ApiController@updateTestsPages')}}', $(this).serialize(), function(){
                    window.location.reload();
                });
            });

            $('.jsAddTest').click(function(){
                $.post('{{action('Admin\ApiController@addTestsPages')}}', {id: $(this).attr('data-id'), query: window.location.search}, function(){
                    window.location.reload();
                });
            });

            $('[data-action="reset_positions"]').click(function(){
                swal({
                    title: "Вы уверены?",
                    text: "Настройки этой страницы будут утеряны",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Сбросить',
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
                        $.post('{{action('Admin\ApiController@resetTestsPages')}}', $('#filtersForm').serialize(), function(){
                            window.location.reload();
                        });
                    }
                });
            });

            $('[data-action="delete_test"]').click(function(){
                let id = $(this).attr('data-id');
                swal({
                    title: "Вы уверены?",
                    text: "Выбранный тест не будет отображаться на странице",
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
                        $.post('{{action('Admin\ApiController@deleteTestsPages')}}', {id: id}, function(){
                            $('.grid-stack-item[data-test-id="' + id + '"]').remove();

                            swal({
                                title: "Готово!",
                                text: "Тест скрыт",
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
                        });
                    }
                });
            });

            function getCellHeight() {
                if ($(window).width() <= 1400) {
                    return 64;
                } else {
                    return 120;
                }
            }

        })();
    </script>
@endsection