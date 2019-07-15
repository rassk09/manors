@extends('admin.custom_forms.base')

@section('form')
    <div class="row m-t-20">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary m-r-5" id="jsAddResult"><i class="fa fa-plus m-r-5"></i> <span>Добавить результат</span></button>
        </div>
    </div>
    <div class="row m-t-20" id="jsResults" data-id="{{$item->id}}" data-format-id="{{$item->test_format_id}}">
        <div class="col-md-12 loader text-center m-t-40 m-b-40">
            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
        </div>
        <div class="col-md-12" id="jsResultsTable"></div>
    </div>
@endsection

@section('form_js')

    <link href="/assets/plugins/html5_drag_and_drop/style.css" rel="stylesheet" />
    <script src="/assets/plugins/html5_drag_and_drop/script.js"></script>

    <!-- #modal-dialog -->
    <!-- Results Create Edit Form -->
    <div class="modal fade" id="jsTestResultsForm">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\ApiController@createOrUpdateTestResult']]) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Результат теста</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="loader text-center m-t-40 m-b-40">
                        <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
                    </div>
                    <div class="row p-l-15 p-r-15"></div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    {!! Form::hidden('test_id', $item->id) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <script>
        (function(){
            let body = $('#jsResults'),
                test_id = body.attr('data-id'),
                test_format_id = +body.attr('data-format-id'),
                abc_letters = [
                    { points: 1, letter: 'A' },
                    { points: 2, letter: 'B' },
                    { points: 3, letter: 'C' },
                    { points: 4, letter: 'D' },
                    { points: 5, letter: 'E' },
                    { points: 6, letter: 'F' },
                    { points: 7, letter: 'G' },
                    { points: 8, letter: 'H' },
                    { points: 9, letter: 'I' },
                    { points: 10, letter: 'J' },
                    { points: 11, letter: 'K' },
                    { points: 12, letter: 'L' },
                    { points: 13, letter: 'M' },
                    { points: 14, letter: 'N' },
                    { points: 15, letter: 'O' },
                    { points: 16, letter: 'P' },
                    { points: 17, letter: 'Q' },
                    { points: 18, letter: 'R' },
                    { points: 19, letter: 'S' },
                    { points: 20, letter: 'T' },
                    { points: 21, letter: 'U' },
                    { points: 22, letter: 'V' },
                    { points: 23, letter: 'W' },
                    { points: 24, letter: 'X' },
                    { points: 25, letter: 'Y' },
                    { points: 26, letter: 'Z' },
                ],
                develop_types = {
                    0: 'Результат теста',
                    @foreach(\App\Models\TestQuestion::getDevelopTypes() as $key => $type)
                        {{$key}}: '{{$type}}',
                    @endforeach
                },
                available_locales = [
                    @foreach(\Auth::user()->getAvailableLocales() as $locale)
                        {
                            'id': {{$locale->id}},
                            'code': '{{$locale->code}}',
                            'is_master': {{$locale->is_master}},
                            'title': '{!! $locale->getAdminFlagIcon() . $locale->getLocaleName() !!}',
                        },
                    @endforeach
                ];

            $.get('{{action('Admin\ApiController@getTestResults')}}', {test_id: test_id}, function(out){
                let content = '';

                $.each(out.results, function(key, result) {
                    content += getResultsRow(result);
                });

                let tmpl_form = `
                    <table class="table table-striped table-hover" id="jsAnswersTable">
                        <thead>
                            <tr>
                                <th width="10">ID</th>
                                <th>Заголовок</th>
                                @if ($item->test_format_id == 5)
                                    <th width="100">Блок</th>
                                @endif
                                @if ($item->test_format_id == 2)
                                    <th width="40">Результат</th>
                                @else
                                    <th width="40">От</th>
                                    <th width="40">До</th>
                                @endif
                                <th width="220">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${content}
                        </tbody>
                    </table>
                `;

                body.find('#jsResultsTable').html(tmpl_form);
                body.find('.loader').hide();

            }, 'json');

            $('#jsAddResult').click(function(){
                $('#jsTestResultsForm').modal('show');
                renderForm({});
            });

            $(document).on('click', '[data-action="edit_result"]', function(){
                let row = $(this).parents('tr'),
                    result_id = row.attr('data-id');

                $('#jsTestResultsForm').modal('show');
                $.get('{{action('Admin\ApiController@getTestResult')}}', {result_id: result_id}, function(response){
                    renderForm(response.result);
                }, 'json');
            });

            $(document).on('click', '[data-action="delete_result"]', function(e){
                e.preventDefault();

                let row = $(this).parents('tr'),
                    result_id = row.attr('data-id');

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
                        $.get('{!! action('Admin\ApiController@deleteTestResult') !!}', {result_id: result_id}, function(out){
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

            $('.modal form').submit(function(e){
                e.preventDefault();

                let form = $(this),
                    modal = form.parents('.modal'),
                    formValid = form.parsley().validate();

                if (formValid) {
                    let formData = form.serializeObject();
                    $.post(form.attr('action'), form.serialize(), function(response) {
                        modal.modal('hide');
                        form[0].reset();

                        if (response.status == 'success') {
                            let row = getResultsRow(response.object);

                            if ($('tr[data-id="' + formData.id + '"]').length) {
                                $('tr[data-id="' + formData.id + '"]').replaceWith(row);
                            } else {
                                $('#jsAnswersTable tbody').append(row);
                            }

                            swal(response);
                        }

                    }, 'json');
                }
            });

            function renderForm(object) {
                $('#jsTestResultsForm .loader').hide();
                $('#jsTestResultsForm .row').html(getResultsForm(object));

                $('.drop-area').dropArea();
                initTynyMCE();
            }

            function getResultsRow(result) {
                return `
                    <tr data-id="${result.id}">
                        <td>${result.id}</td>
                        <td>${result.name}</td>
                        @if ($item->test_format_id == 5)
                            <td>${develop_types[result.test_block_id]}</td>
                        @endif
                        @if ($item->test_format_id == 2)
                            <td>${getABCLetter(result.min).letter}</td>
                        @else
                            <td>${result.min}</td>
                            <td>${result.max}</td>
                        @endif
                        <td>
                            <a href="#" class="btn btn-purple btn-sm m-r-5" data-toggle="dropdown"><i class="fa fa-globe m-r-5"></i> Перевести <i class="caret m-l-5"></i></a>
                            <ul class="dropdown-menu pull-right">
                                ${available_locales.map(locale => !locale.is_master ? `<li><a href="/admin/translations/model/TestResult/${locale.code}/${result.id}/edit">${locale.title}</a></li>` : ``).join('')}
                            </ul>

                            <a href="#" class="btn btn-warning btn-icon btn-sm" data-action="edit_result" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                            <a href="#" class="btn btn-danger btn-icon btn-sm m-l-5" data-action="delete_result" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                `;
            }

            function getResultsForm(result) {
                let imageUploadAction = '{{action('Admin\ApiController@uploadTestImage')}}';

                return `
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-right">
                                Заголовок
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="name" value="${result.name ? result.name : ''}" class="form-control" data-parsley-required="true" placeholder="Введите значение..." />
                            </div>
                        </div>
                        @if ($item->test_format_id == 5)
                            <div class="form-group row">
                                <label for="test_block_id" class="col-md-4 col-form-label text-right">
                                    Блок
                                </label>
                                <div class="col-md-8">
                                    <select name="test_block_id" id="test_block_id" class="form-control">
                                        ${getDevelopTypes(result.test_block_id ? result.test_block_id : 0)}
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if ($item->test_format_id == 2)
                            <div class="form-group row">
                                <label for="min" class="col-md-4 col-form-label text-right">
                                    Больше ответов
                                </label>
                                <div class="col-md-8">
                                    <select name="min" id="min" class="form-control">
                                        ${getABCSelect(result.min ? result.min : 0)}
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="min" class="col-md-4 col-form-label text-right">
                                    Результаты
                                </label>
                                <div class="col-md-8 form-inline">
                                    <label class="m-r-15">От</label>
                                    <input type="number" name="min" value="${ result.min ? result.min : '' }" class="form-control width-70 m-r-15" min="0" data-parsley-required="true" placeholder="От..." />
                                    <label class="m-r-15">до</label>
                                    <input type="number" name="max" value="${ result.max ? result.max : '' }" class="form-control width-70 m-r-15" min="0" data-parsley-required="true" placeholder="До..." />
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-right">
                                Изображение
                            </label>
                            <div class="col-md-8">
                                <div class="drop-area" id="drop_area-image" data-action="${imageUploadAction}" data-file-name="image">
                                    <div id="gallery" ${ !result.image ? ' style="display: none;" ' : '' } >
                                        <img src="${ result.image ? result.image : '' }"/>
                                        <input type="hidden" name="image" value="${ result.image ? result.image : '' }" />
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                                        </div>
                                    </div>
                                    <div class="my-form">
                                        <p id="drop_icon" class="text-center" ${ result.image ? ' style="display: none;" ' : '' } ><i class="fa fa-upload fa-4x"></i></p>
                                        <h3 class="text-center">
                                            <label for="fileElem-image"><b>Выберите файл</b> или перетащите его.</label>
                                        </h3>
                                        <p class="text-center">Загружайте изображения в формате <b>JPG</b>, <b>GIF</b> или <b>PNG</b>.</p>
                                        <input type="file" id="fileElem-image" accept="image/*" />
                                        <div class="progress rounded-corner progress-striped active d-none">
                                            <div class="progress-bar bg-lime" style="width: 0;">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-right">
                                Описание
                            </label>
                            <div class="col-md-8">
                                <textarea class="mce" name="description" id="description">${ result.description ? result.description : '' }</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="${ result.id ? result.id : '' }" />
                `;
            }

            function getABCLetter(k) {
                let current = {};

                $.each(abc_letters, function(key, value){
                    if (value.points == k) {
                        current = value;
                        return false;
                    }
                });

                return current;
            }

            function getABCSelect(k) {
                let lng = $('#jsAnswersTable tbody tr').length,
                    content = '';

                for (i = 0; i < lng + 1; i++) {
                    letter = getABCLetter(i + 1);
                    content += `<option value="${letter.points}" ${ letter.points == k ? ' selected ' : '' }>${letter.letter}</option>`;
                }

                return content;
            }

            function getDevelopTypes(k) {
                let content = '';

                $.each(develop_types, function(key, value){
                    content += `<option value="${key}" ${ key == k ? ' selected ' : '' }>${value}</option>`;
                });

                return content;

            }

        })();
    </script>


@endsection