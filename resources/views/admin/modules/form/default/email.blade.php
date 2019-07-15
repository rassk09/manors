<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <div class="input-group">
            <span class="input-group-addon">@</span>
            {!! Form::email($field->getAttribute(), $field->getValue($item), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>