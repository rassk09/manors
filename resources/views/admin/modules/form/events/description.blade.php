<div class="form-group row">
    {!! Form::label('description', $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::textarea('description', isset($item) ? $item->description : '', ['class' => 'form-control', 'data-parsley-required' => 'true', 'placeholder' => 'Введите значение...']) !!}
    </div>
</div>

@if (!isset($item))
    @pushonce('js:description')
        <script>
            (function(){
                $('#event_format_id').change(function(){
                    reloadTextarea();
                });
                reloadTextarea();

                function reloadTextarea() {
                    let event_format_id = $('#event_format_id').val();
                    $.get('{{ route('admin_get_event_format') }}', {event_format_id: event_format_id}, function(out){
                        $('[name="description"]').val(out.description);
                    }, 'json');
                }

            })();
        </script>
    @endpushonce
@endif