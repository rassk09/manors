<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::text($field->getAttribute(), $field->getValue($item) ? $field->getValue($item)->format(config('admin.default_date_format')) : '', ['class' => 'form-control datepicker']) !!}
    </div>
</div>

@push('js')
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.ru.min.js"></script>
    <script>
        $('.datepicker').datepicker({
            todayHighlight: true,
            format: '{{ config('admin.default_date_format_js') }}',
            language: 'ru',
        });
    </script>
@endpush