<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <div class="drop-area" id="drop_area-{!! $field->getAttribute() !!}" data-action="{{action($field->getAction())}}" data-file-name="{{$field->getAttribute()}}">
            <div id="gallery">
                @if ($field->getValue($item))
                    <img src="{{$field->getValue($item)}}"/>
                    {!! Form::hidden($field->getAttribute(), $field->getValue($item)) !!}
                    <div class="text-center">
                        <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                    </div>
                @endif
            </div>
            <div class="my-form">
                @if (!$field->getValue($item))
                    <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                @endif
                <h3 class="text-center">
                    <label for="fileElem-{!! $field->getAttribute() !!}"><b>Выберите файл</b> или перетащите его.</label>
                </h3>
                <p class="text-center">Загружайте изображения в формате <b>JPG</b>, <b>GIF</b> или <b>PNG</b>.</p>
                <input type="file" id="fileElem-{!! $field->getAttribute() !!}" accept="image/*" />
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