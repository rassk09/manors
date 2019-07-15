<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::select($field->getAttribute(), $field->getSelectValues(), $field->getValue($item), ['class' => 'form-control selectpicker', 'data-style' => 'btn-white', 'data-live-search' => $field->hasSearch($item)], $field->getOptionsAttributes()) !!}
    </div>
</div>

@if($field->getConnectedWith())
    @push('js')
        <script>
            (function(){
                $('#{{$field->getConnectedWith()}}').change(function(){
                    refreshSelect{{$field->getAttribute()}}List(true);
                });
                refreshSelect{{$field->getAttribute()}}List(false);
            })();

            function refreshSelect{{$field->getAttribute()}}List(is_select_changed) {
                var {{$field->getConnectedForeignKey()}} = $('#{{$field->getConnectedForeignKey()}}').val();
                var data_attribute = '{{str_replace('_', '-', $field->getConnectedForeignKey())}}';

                $('#{{$field->getAttribute()}} option').hide();
                $('#{{$field->getAttribute()}} option[data-' + data_attribute + '="' + {{$field->getConnectedForeignKey()}} + '"]').show();

                if (is_select_changed) {
                    var new_value = $('#{{$field->getAttribute()}} option[data-' + data_attribute + '="' + {{$field->getConnectedForeignKey()}} + '"]').first().attr('value');
                    $('#{{$field->getAttribute()}}').val(new_value);
                }

                $('#{{$field->getAttribute()}}').selectpicker('refresh');
            }
        </script>
    @endpush
@endif