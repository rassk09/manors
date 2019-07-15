<!-- #modal-dialog -->
<div class="modal fade" id="jsEventModerationMessage">
    <div class="modal-dialog">
        {!! Form::open(['class' => 'form-horizontal form-bordered', 'method' => 'post']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Оставить замечание</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {!! Form::label('message', 'Сообщение', ['class' => 'col-md-4 col-form-label text-right']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('message', null, ['class' => 'form-control', 'data-parsley-required' => 'true', 'placeholder' => 'Введите значение...']) !!}
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
