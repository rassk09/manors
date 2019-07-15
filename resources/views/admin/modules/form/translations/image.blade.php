<div class="form-group row" data-attr="{{ $field->getTranslationAttribute($item) }}">
    {!! Form::label($field->getTranslationAttribute($item), $field->getTitle(), ['class' => 'col-md-2 col-form-label text-right']) !!}
    <div class="col-md-5">
        <img src="{{ $field->getValue($item) }}" class="d-block width-150 m-auto m-b-15">
        <div class="input-group">
            <span class="form-control text-ellipsis" data-source data-image>{{ $field->getValue($item) }}</span>
            <span class="input-group-append">
                <a href="{{ $field->getValue($item) }}" target="_blank" class="btn btn-primary"><i class="fa fa-download m-r-5"></i> Скачать</a>
            </span>
            <span class="input-group-append">
                <button type="button" class="btn btn-primary btn-icon btn-lg" data-action="copy_translation" data-tooltip="tooltip" data-placement="top" data-title="Скопировать"><i class="fa fa-angle-double-right"></i></button>
            </span>
        </div>
    </div>
    <div class="col-md-5">
        <div class="drop-area" id="drop_area-{!! $field->getTranslationAttribute($item) !!}" data-action="{{action($field->getAction())}}" data-file-name="{{$field->getTranslationAttribute($item)}}">
            <div id="gallery">
                @if ($locale->getContent($field->getTranslationAttribute($item)))
                    <img src="{{ $locale->getContent($field->getTranslationAttribute($item)) }}"/>
                    {!! Form::hidden($field->getTranslationAttribute($item), $locale->getContent($field->getTranslationAttribute($item))) !!}
                    <div class="text-center">
                        <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                    </div>
                @endif
            </div>
            <div class="my-form">
                @if (!$locale->getContent($field->getTranslationAttribute($item)))
                    <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                @endif
                <h3 class="text-center">
                    <label for="fileElem-{!! $field->getTranslationAttribute($item) !!}"><b>Выберите файл</b> или перетащите его.</label>
                </h3>
                <p class="text-center">Загружайте изображения в формате <b>JPG</b>, <b>GIF</b> или <b>PNG</b>.</p>
                <input type="file" id="fileElem-{!! $field->getTranslationAttribute($item) !!}" accept="image/*" />
                <div class="progress rounded-corner progress-striped active d-none">
                    <div class="progress-bar bg-lime" style="width: 0;">
                        0%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@pushonce('js:image')
    <link href="/assets/plugins/html5_drag_and_drop/style.css" rel="stylesheet" />
    <script src="/assets/plugins/html5_drag_and_drop/script.js"></script>
@endpushonce