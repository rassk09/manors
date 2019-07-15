<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <div id="{{$field->getAttribute()}}_loader" class="m-b-5">
            <i class="fa text-orange fa-circle-notch fa-spin"></i>
            <span>Загрузка...</span>
        </div>
        {!! Form::select($field->getAttribute(), [], $field->getValue($item), ['class' => 'form-control selectpicker_ajax', 'data-style' => 'btn-white']) !!}
    </div>
</div>

@push('js')
    <script>
        var current_value = '{{$field->getValue($item)}}';
        $.get('{{action($field->getAction())}}', {}, function(out) {
            $.each(out, function(key, value){
                $('select#{{$field->getAttribute()}}').append('<option value="' + key + '">' + value + '</option>');
            });

            $('select#{{$field->getAttribute()}}').val(current_value);
            $('select#{{$field->getAttribute()}}').selectpicker('render');
            $('#{{$field->getAttribute()}}_loader').remove();
            $('.btn-group.bootstrap-select .caret').remove();
        }, 'json');
    </script>
@endpush