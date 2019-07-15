<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        {!! Form::textarea($field->getAttribute(), $field->getValue($item), $properties) !!}
    </div>
</div>