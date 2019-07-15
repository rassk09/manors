<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        @foreach($locales as $locale)
            <div class="checkbox checkbox-css">
                {!! Form::checkbox('test_locale[]', $locale->id, $state == 'edit' ? $item->hasLocale($locale->id) : false, ['id' => 'test_locale_' . $locale->id]) !!}
                {!! Form::label('test_locale_' . $locale->id, $locale->getLocaleName()) !!}
            </div>
        @endforeach
    </div>
</div>