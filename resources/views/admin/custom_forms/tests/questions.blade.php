@extends('admin.custom_forms.base')

@section('form')
    <div class="row m-t-20">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary m-r-5" id="jsAddQuestion"><i class="fa fa-plus m-r-5"></i> <span>Добавить вопрос</span></button>

            <a href="#" class="btn btn-purple m-r-5" data-toggle="dropdown"><i class="fa fa-globe m-r-5"></i> Перевести <i class="caret m-l-5"></i></a>
            <ul class="dropdown-menu pull-right">
                @foreach(\Auth::user()->getAvailableLocales() as $locale)
                    @if (!$locale->is_master)
                        <li><a href="{{ action('Admin\TranslationsController@editTestQuestions', ['code' => $locale->code, 'id' => $item->id]) }}">{!! $locale->getAdminFlagIcon() . $locale->getLocaleName() !!}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row m-t-20">
        <div class="col-md-12">
            <table class="table table-striped table-hover" id="questionsTable">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th width="50">Изобр.</th>
                        <th>Вопрос</th>
                        @if ($item->test_format_id == 5)
                            <th width="100">Блок</th>
                        @endif
                        <th>Варианты ответа</th>
                        <th width="40">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($item->questions as $question)
                        <tr data-id="{!! $question->id !!}">
                            <td><i class="fa fa-sort" style="cursor: move;"></i></td>
                            <td><img src="{!! $question->image !!}" width="50" /></td>
                            <td>{!! $question->name !!}</td>
                            @if ($item->test_format_id == 5)
                                <td>
                                    {{$question->getDevelopType()}}
                                    {!! Form::hidden('__row_' . $question->id . '_block_id', $question->test_block_id) !!}
                                </td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-primary btn-sm m-b-10" data-action="edit_answers"><i class="fa fa-pencil-alt m-r-5"></i> <span>Изменить ответы</span></button>
                                <ul class="p-l-20">
                                    @foreach($question->answers as $answer)
                                        <li>{!! $answer->name !!}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="#" class="btn btn-warning btn-icon btn-sm" data-action="edit_question" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                                <a href="#" class="btn btn-danger btn-icon btn-sm m-l-5" data-action="delete_question" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('form_js')
    <!-- #modal-dialog -->
    <!-- Question Create Edit Form -->
    <div class="modal fade" id="jsTestQuestionForm">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\ApiController@createOrEditTestQuestion']]) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Вопрос теста</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            {!! Form::label('name', 'Название', ['class' => 'col-md-4 col-form-label text-right']) !!}
                            <div class="col-md-8">
                                {!! Form::text('name', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'placeholder' => 'Введите значение...']) !!}
                            </div>
                        </div>
                        @if ($item->test_format_id == 5)
                            <div class="form-group row">
                                {!! Form::label('test_block_id', 'Блок', ['class' => 'col-md-4 col-form-label text-right']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('test_block_id', \App\Models\TestQuestion::getDevelopTypes(), null, ['class' => 'form-control selectpicker', 'data-style' => 'btn-white']) !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            {!! Form::label('image', 'Изображение', ['class' => 'col-md-4 col-form-label text-right']) !!}
                            <div class="col-md-8">
                                <div class="drop-area" id="drop_area-image" data-action="{{action('Admin\ApiController@uploadTestImage')}}" data-file-name="image">
                                    <div id="gallery" style="display: none;">
                                        <img src=""/>
                                        {!! Form::hidden('image', null) !!}
                                        <div class="text-center">
                                            <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                                        </div>
                                    </div>
                                    <div class="my-form">
                                        <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
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
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        {!! Form::hidden('test_id', $item->id) !!}
                        {!! Form::hidden('id', null) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- #modal-dialog -->
    <!-- Answers Create Edit Form -->
    <div class="modal fade" id="jsTestAnswersForm">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\ApiController@editTestAnswers']]) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ответы к вопросу</h4>
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
                        {!! Form::hidden('question_id') !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <link href="/assets/plugins/html5_drag_and_drop/style.css" rel="stylesheet" />
    <script src="/assets/plugins/html5_drag_and_drop/script.js"></script>

    <script>
        (function(){
            let test_format_id = {{$item->test_format_id == 5 ? 1 : $item->test_format_id}},
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
                ];

            $('#questionsTable tbody').sortable({
                stop: function (e, ui) {
                    let positions = {},
                        k = 0;

                    $('#questionsTable tbody tr').each(function(){
                        k++;
                        positions[k] = $(this).attr('data-id');
                    });

                    $.post('{{action('Admin\ApiController@positionTestQuestion')}}', {positions: positions}, function(){
                        swal({
                            title: "Готово!",
                            text: "Позиции сохранены",
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
            }).disableSelection();

            $('#jsAddQuestion').click(function(){
                $('#jsTestQuestionForm [name="id"]').val('');
                $('#jsTestQuestionForm [name="image"]').val('');
                $('#jsTestQuestionForm [name="test_block_id"]').val('');
                $('#jsTestQuestionForm #gallery img').attr('src', '');
                $('#jsTestQuestionForm #gallery').hide();
                $('#jsTestQuestionForm #drop_icon').show();
                $('#jsTestQuestionForm').modal('show');
            });

            $(document).on('click', '[data-action="edit_question"]', function(e){
                e.preventDefault();

                let row = $(this).parents('tr'),
                    image = row.find('img').attr('src');

                $('#jsTestQuestionForm [name="id"]').val(row.attr('data-id'));
                $('#jsTestQuestionForm [name="name"]').val(row.find('td:nth-child(3)').html());
                $('#jsTestQuestionForm [name="test_block_id"]').val($('[name="__row_' + row.attr('data-id') + '_block_id"]').val());

                if (image) {
                    $('#jsTestQuestionForm [name="image"]').val(image);
                    $('#jsTestQuestionForm #gallery img').attr('src', image);
                    $('#jsTestQuestionForm #gallery').show();
                    $('#jsTestQuestionForm #drop_icon').hide();
                } else {
                    $('#jsTestQuestionForm #gallery').hide();
                    $('#jsTestQuestionForm #drop_icon').show();
                }

                $('#jsTestQuestionForm').modal('show');
            });

            $(document).on('click', '[data-action="delete_question"]', function(e) {
                e.preventDefault();

                let row = $(this).parents('tr'),
                    question_id = row.attr('data-id');

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
                        $.get('{!! action('Admin\ApiController@deleteTestQuestion') !!}', {question_id: question_id}, function(out){
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

            $(document).on('click', '[data-action="edit_answers"]', function(){
                let row = $(this).parents('tr'),
                    question_id = row.attr('data-id');

                $('#jsTestAnswersForm').modal('show');
                $('#jsTestAnswersForm .row').hide();
                $('#jsTestAnswersForm .loader').show();
                $('#jsTestAnswersForm input[name="question_id"]').val(question_id);

                $.get('{{action('Admin\ApiController@getTestAnswers')}}', {question_id: question_id}, function(out){
                    let k = 0,
                        content = '';

                    $.each(out.answers, function(key, answer) {
                        k++;
                        if (test_format_id == 1) {
                            content += getRow123(k, answer);
                        } else if (test_format_id == 2) {
                            content += getRowABC(k, answer);
                        } else if (test_format_id == 3) {
                            content += getRowRW(k, answer);
                        }
                    });

                    if (k < 3) {
                        for (i = (k + 1); i <= 3; i++) {
                            if (test_format_id == 1) {
                                content += getRow123(i, {});
                            } else if (test_format_id == 2) {
                                content += getRowABC(i, {});
                            } else if (test_format_id == 3) {
                                content += getRowRW(i, {});
                            }
                        }
                    }

                    if (test_format_id == 1) {
                        let tmpl_form = `
                            <button type="button" class="btn btn-primary m-r-5" id="jsAddAnswer"><i class="fa fa-plus m-r-5"></i> <span>Добавить ответ</span></button>
                            <table class="table table-striped table-hover" id="jsAnswersTable">
                                <thead>
                                    <tr>
                                        <th>Вариант ответа</th>
                                        <th width="100">Вес</th>
                                        <th width="40">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${content}
                                </tbody>
                            </table>
                        `;

                        $('#jsTestAnswersForm .row').html(tmpl_form).show();
                        $('#jsTestAnswersForm .loader').hide();
                    } else if (test_format_id == 2) {
                        let tmpl_form = `
                            <button type="button" class="btn btn-primary m-r-5" id="jsAddAnswer"><i class="fa fa-plus m-r-5"></i> <span>Добавить ответ</span></button>
                            <table class="table table-striped table-hover" id="jsAnswersTable">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th width="50">Номер</th>
                                        <th>Вариант ответа</th>
                                        <th width="40">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${content}
                                </tbody>
                            </table>
                        `;

                        $('#jsTestAnswersForm .row').html(tmpl_form).show();
                        $('#jsTestAnswersForm .loader').hide();
                        $('#jsAnswersTable tbody').sortable({
                            stop: function (e, ui) {
                                refreshAnswersTable();
                            }
                        });
                    } else if (test_format_id == 3) {
                        let tmpl_form = `
                            <button type="button" class="btn btn-primary m-r-5" id="jsAddAnswer"><i class="fa fa-plus m-r-5"></i> <span>Добавить ответ</span></button>
                            <table class="table table-striped table-hover" id="jsAnswersTable">
                                <thead>
                                    <tr>
                                        <th width="50%">Вариант ответа</th>
                                        <th width="50%">Подсказка</th>
                                        <th width="50">Верный</th>
                                        <th width="40">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${content}
                                </tbody>
                            </table>
                        `;

                        $('#jsTestAnswersForm .row').html(tmpl_form).show();
                        $('#jsTestAnswersForm .loader').hide();
                    }

                    checkAnswersDeleteButton();

                }, 'json');
            });

            $(document).on('click', '#jsAddAnswer', function() {
                let k = $('#jsAnswersTable tbody tr').length + 1;

                if (test_format_id == 1) {
                    $('#jsAnswersTable tbody').append(getRow123(k, {}));
                } else if (test_format_id == 2) {
                    $('#jsAnswersTable tbody').append(getRowABC(k, {}));
                } else if (test_format_id == 3) {
                    $('#jsAnswersTable tbody').append(getRowRW(k, {}));
                }

                checkAnswersDeleteButton();
            });

            $(document).on('click', '[data-action="delete_answer"]', function(){
                let row = $(this).parents('tr');

                swal({
                    title: "Вы уверены?",
                    text: "После удаления будет невозможно восстановить запись",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Удалить',
                            visible: true,
                            className: 'btn btn-warning',
                            closeModal: true
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
                        row.remove();
                        checkAnswersDeleteButton();
                        refreshAnswersTable();
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
                            swal(response);
                        }

                        if (form.attr('data-success-remove') == 'true') {
                            $('tr[data-id="' + form.attr('data-row-id') + '"]').remove();
                        }

                        if (form.parents('#jsTestQuestionForm').length) {
                            let question = response.object;
                            let row = `
                                <tr data-id="${question.id}">
                                    <td><i class="fa fa-sort" style="cursor: move;"></i></td>
                                    <td><img src="${question.image}" width="50" /></td>
                                    <td>${question.name}</td>
                                    ${
                                        question.test_block_name
                                            ?
                                        `
                                            <td>
                                                ${question.test_block_name}
                                                <input type="hidden" name="__row_${question.id}_block_id" value="${question.test_block_id}" />
                                            </td>
                                        `
                                            :
                                        ''
                                    }
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm m-b-10" data-action="edit_answers"><i class="fa fa-pencil-alt m-r-5"></i> <span>Изменить ответы</span></button>
                                        <ul class="p-l-20">
                                            ${question.answers ? question.answers.map(answer => `<li>${answer.name}</li>`).join('') : ''}
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-icon btn-sm" data-action="edit_question" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-danger btn-icon btn-sm m-l-5" data-action="delete_question" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;

                            if (formData.id) {
                                $('tr[data-id="' + formData.id + '"]').replaceWith(row);
                            } else {
                                $('#questionsTable tbody').append(row);
                            }
                        } else if (form.parents('#jsTestAnswersForm').length) {
                            let question = response.object,
                                content = `
                                    ${question.answers ? question.answers.map(answer => `<li>${answer.name}</li>`).join('') : ''}
                                `;
                            $('tr[data-id="' + formData.question_id + '"] ul').html(content);
                        }

                    }, 'json');
                }
            });

            function checkAnswersDeleteButton() {
                $('#jsAnswersTable tbody tr [data-action="delete_answer"]').prop('disabled', !($('#jsAnswersTable tbody tr').length > 3));
            }

            function getRow123(k, answer) {
                return `
                    <tr data-number="${k}">
                        <td><input type="text" name="answer[${k}][name]" class="form-control" value="${answer.name ? answer.name : ''}" data-parsley-required="true" /></td>
                        <td><input type="text" name="answer[${k}][points]" class="form-control" value="${answer.points || answer.points === 0  ? answer.points : ''}" data-parsley-required="true" /></td>
                        <td>
                            <button type="button" href="#" class="btn btn-danger btn-icon m-l-5" data-action="delete_answer" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            }

            function getRowABC(k, answer) {
                let current = getABCLetter(k);

                return `
                    <tr data-number="${k}">
                        <td><i class="fa fa-sort" style="cursor: move;"></i></td>
                        <td data-value="letter">
                            <span>${current.letter}</span>
                            <input type="hidden" name="answer[${k}][points]" value="${current.points}" />
                        </td>
                        <td><input type="text" name="answer[${k}][name]" class="form-control" value="${answer.name ? answer.name : ''}" data-parsley-required="true" /></td>
                        <td>
                            <button type="button" href="#" class="btn btn-danger btn-icon m-l-5" data-action="delete_answer" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            }

            function getRowRW(k, answer) {
                return `
                    <tr data-number="${k}">
                        <td><input type="text" name="answer[${k}][name]" class="form-control" value="${answer.name ? answer.name : ''}" data-parsley-required="true" /></td>
                        <td><input type="text" name="answer[${k}][description]" class="form-control" value="${answer.description ? answer.description : ''}" data-parsley-required="true" /></td>
                        <td>
                            <div class="radio radio-css">
                                <input type="radio" id="cssRadio${k}" value="${k}" name="is_correct" ${answer.is_correct ? ' checked ' : ''} />
                                <label for="cssRadio${k}"></label>
                            </div>
                        </td>
                        <td>
                            <button type="button" href="#" class="btn btn-danger btn-icon m-l-5" data-action="delete_answer" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
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

            function refreshAnswersTable() {
                let k = 0;

                $('#jsAnswersTable tbody tr').each(function(){
                    k++;
                    $(this).attr('data-number', k);
                    $(this).find('input:not([type="radio"])').each(function(){
                        let cache = $(this).attr('name').split('[');
                        $(this).attr('name', cache[0] + '[' + k + '][' + cache[2]);
                    });

                    $(this).find('input[type="radio"]').val(k);

                    if (test_format_id == 2) {
                        let cell = $(this).find('[data-value="letter"]');
                        cell.find('span').html(current = getABCLetter(k).letter);
                        cell.find('input[type="hidden"]').val(k);
                    }
                });
            }


        })();
    </script>



@endsection