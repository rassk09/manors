@extends('admin.custom_forms.base')

@section('form')
    <div class="loading height-400"><span class="spinner"></span></div>
    <div id="members_table" class="d-none m-t-20">
        <table id="data-table-default" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th class="text-nowrap">ФИО</th>
                    <th class="text-nowrap">E-mail</th>
                    <th class="text-nowrap">Телефон</th>
                    <th class="text-nowrap">Тип</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('form_js')
    <link href="/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <script src="/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

    <script>
        (function(){
            var rows = '';
            $.get('{{action('Admin\ApiController@getEventMembers', ['id' => $item->id])}}', {}, function(out) {
                $.each(out, function(key, value){
                    rows += '<tr>' +
                        '<td>' + value.id + '</td>'+
                        '<td>' + value.name + '</td>'+
                        '<td>' + value.email + '</td>'+
                        '<td>' + value.phone + '</td>'+
                        '<td>' + value.type + '</td>'+
                    '</tr>';
                });

                $('#members_table').removeClass('d-none').find('tbody').append(rows);
                $('.loading').remove();

                if ($('#data-table-default').length !== 0) {
                    $('#data-table-default').DataTable({
                        responsive: true,
                        language: {
                            "processing": "Подождите...",
                            "search": "Поиск:",
                            "lengthMenu": "Показать _MENU_ записей",
                            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                            "infoEmpty": "Записи с 0 до 0 из 0 записей",
                            "infoFiltered": "(отфильтровано из _MAX_ записей)",
                            "infoPostFix": "",
                            "loadingRecords": "Загрузка записей...",
                            "zeroRecords": "Записи отсутствуют.",
                            "emptyTable": "В таблице отсутствуют данные",
                            "paginate": {
                                "first": "Первая",
                                "previous": "Предыдущая",
                                "next": "Следующая",
                                "last": "Последняя"
                            },
                            "aria": {
                                "sortAscending": ": активировать для сортировки столбца по возрастанию",
                                "sortDescending": ": активировать для сортировки столбца по убыванию"
                            },
                            // url: "/assets/plugins/DataTables/media/i18n/russian.json"
                        }
                    });
                }
            }, 'json');
        })();
    </script>
@endsection