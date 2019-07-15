<div class="form-group row" data-attr="{{ $field->getTranslationAttribute($item) }}">
    {!! Form::label($field->getTranslationAttribute($item), $field->getTitle(), ['class' => 'col-md-2 col-form-label text-right']) !!}
    <div class="col-md-5">
        <div class="input-group">
            <span class="form-control height-150" data-source>{{ $field->getValue($item) }}</span>
            <span class="input-group-append">
                <button type="button" class="btn btn-primary btn-icon btn-lg" data-action="copy_translation" data-tooltip="tooltip" data-placement="top" data-title="Скопировать"><i class="fa fa-angle-double-right"></i></button>
            </span>
        </div>
    </div>
    <div class="col-md-5">
        {!! Form::textarea($field->getTranslationAttribute($item), $locale->getContent($field->getTranslationAttribute($item)), ['class' => 'form-control height-150']) !!}
    </div>
</div>