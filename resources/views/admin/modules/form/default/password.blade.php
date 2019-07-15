<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::text($field->getAttribute(), '', ['class' => 'form-control']) !!}
        <div class="passwordStrengthDiv is0 m-t-5"></div>
    </div>
</div>

@push('js')
    <link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <script src="/assets/plugins/password-indicator/js/password-indicator.js"></script>

    <script>
        $('#{!! $field->getAttribute() !!}').passwordStrength({
            targetDiv: '.passwordStrengthDiv'
        });
    </script>
@endpush