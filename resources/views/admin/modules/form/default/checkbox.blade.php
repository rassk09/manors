<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <div class="checkbox checkbox-css {{ $field->isDisabled() ? 'disabled' : '' }}">
            {!! Form::hidden($field->getAttribute(), 0, ['id' => '']) !!}
            {!! Form::checkbox($field->getAttribute(), 1, isset($item) && $field->getValue($item) == 1 ? true : false, $properties) !!}
            {!! Form::label($field->getAttribute(), $field->getTitle($state)) !!}
        </div>
    </div>
</div>

@push('js')
    @if (count($field->getConnectedWith()))
        <script>
            function refreshCheckbox{{$field->getAttribute()}}() {
                let __this = $('#{{ $field->getAttribute() }}'),
                    attributes = ['{!! join("', '", $field->getConnectedWith()) !!}'];

                if (__this.is(':checked')) {
                    $.each(attributes, function(k, v) {
                        $('[name="' + v + '"]').parents('.form-group').show();
                    });
                } else {
                    $.each(attributes, function(k, v) {
                        $('[name="' + v + '"]').parents('.form-group').hide();
                    });
                }
            }

            (function(){
                $('#{{ $field->getAttribute() }}').change(function(){
                    refreshCheckbox{{ $field->getAttribute() }}();
                });

                refreshCheckbox{{ $field->getAttribute() }}();
            })();
        </script>
    @endif
@endpush