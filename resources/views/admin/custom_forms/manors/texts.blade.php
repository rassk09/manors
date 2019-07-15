@extends('admin.custom_forms.base')

@section('form')
    <div class="row m-t-20">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary m-r-5" id="jsAddText"><i class="fa fa-plus m-r-5"></i> <span>Добавить текст</span></button>
        </div>
    </div>
    <div class="row m-t-20" id="jsTexts" data-id="{{$item->id}}">
        <div class="col-md-12 loader text-center m-t-40 m-b-40">
            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
        </div>
        <div class="col-md-12" id="jsTextsTable"></div>
    </div>
@endsection

@section('form_js')
    <!-- #modal-dialog -->
    <!-- Texts Create Edit Form -->
    <div class="modal fade" id="jsManorTextForm">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post', 'action' => ['Admin\ApiController@createOrUpdateManorText']]) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Описание</h4>
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
                    {!! Form::hidden('manor_id', $item->id) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <script>
        (function(){
            let body = $('#jsTexts'),
                manor_id = body.attr('data-id'),
                test_format_id = +body.attr('data-format-id');

            $.get('{{action('Admin\ApiController@getManorTexts')}}', {manor_id: manor_id}, function(out){
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
                                <th>Описание</th>
                                <th width="40">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${content}
                        </tbody>
                    </table>
                `;

                body.find('#jsTextsTable').html(tmpl_form);
                body.find('.loader').hide();

            }, 'json');

            $('#jsAddText').click(function(){
                $('#jsManorTextForm').modal('show');
                renderForm({});
            });

            $(document).on('click', '[data-action="edit_result"]', function(){
                let row = $(this).parents('tr'),
                    text_id = row.attr('data-id');

                $('#jsManorTextForm').modal('show');
                $.get('{{action('Admin\ApiController@getManorText')}}', {text_id: text_id}, function(response){
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
                        $.get('{!! action('Admin\ApiController@deleteManorText') !!}', {result_id: result_id}, function(out){
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
                $('#jsManorTextForm .loader').hide();
                $('#jsManorTextForm .row').html(getTextsForm(object));
            }

            function getResultsRow(result) {
                return `
                    <tr data-id="${result.id}">
                        <td>${result.id}</td>
                        <td>${result.title}</td>
                        <td>${result.content}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-icon btn-sm" data-action="edit_result" data-tooltip="tooltip" data-placement="top" data-title="Редактировать"><i class="fa fa-pencil-alt"></i></a>
                            <a href="#" class="btn btn-danger btn-icon btn-sm m-l-5" data-action="delete_result" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                `;
            }

            function getTextsForm(result) {
                return `
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-right">
                                Заголовок
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="title" value="${result.title ? result.title : ''}" class="form-control" data-parsley-required="true" placeholder="Введите значение..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-right">
                                Описание
                            </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="12" name="content" id="content">${ result.content ? result.content : '' }</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="${ result.id ? result.id : '' }" />
                `;
            }

        })();
    </script>


@endsection