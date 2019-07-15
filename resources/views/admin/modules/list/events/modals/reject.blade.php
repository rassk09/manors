<!-- #modal-dialog -->
<div class="modal fade" id="jsEventModerationReject">
    <div class="modal-dialog">
        {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Отклонить мероприятие</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {!! Form::label('reject_type_id', 'Причина отклонения', ['class' => 'col-md-4 col-form-label text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::select('reject_type_id', \App\Models\Event::getRejectedTypes(), null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row d-none">
                        {!! Form::label('message', 'Сообщение', ['class' => 'col-md-4 col-form-label text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Введите значение...']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отмена</a>
                    <button class="btn btn-success">Отправить</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@push('custom_js')
    <script>
        (function(){
            var rejected_form = $('#jsEventModerationReject');

            rejected_form.find('#reject_type_id').change(function(){
                refreshMessageControl();
            });
            refreshMessageControl();

            function refreshMessageControl() {
                if (rejected_form.find('#reject_type_id').val() == 1) {
                    rejected_form.find('#message').attr('data-parsley-required', 'true');
                    rejected_form.find('#message').parents('.row').removeClass('d-none');
                } else {
                    rejected_form.find('#message').removeAttr('data-parsley-required');
                    rejected_form.find('#message').parents('.row').addClass('d-none');
                }
            }
        })();
    </script>
@endpush