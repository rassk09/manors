<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::text($field->getAttribute(), $field->getValue($item) ? $field->getValue($item)->format(config('admin.default_datetime_format')) : '', $properties) !!}
    </div>
</div>

@pushonce('js:datetime')
    <link href="/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: '{{ config('admin.default_datetime_format_js') }}'
        });
    </script>
@endpushonce