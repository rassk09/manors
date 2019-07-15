<div class="form-group row">
    {!! Form::label($field->getAttribute(), $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <!-- begin nav-tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-items">
                <a href="#default-tab-1" data-toggle="tab" class="nav-link {{ !$item || !$item->isVideo() ? ' active ' : '' }} ">
                    <span>Файл</span>
                </a>
            </li>
            <li class="nav-items">
                <a href="#default-tab-2" data-toggle="tab" class="nav-link {{ $item && $item->isVideo() ? ' active ' : '' }}">
                    <span>Видео</span>
                </a>
            </li>
        </ul>
        <!-- end nav-tabs -->
        <!-- begin tab-content -->
        <div class="tab-content">
            <!-- begin tab-pane -->
            <div class="tab-pane fade  {{ !$item || !$item->isVideo() ? ' active show ' : '' }}" id="default-tab-1">
                <div class="drop-area" id="drop_area-file" data-action="{{action('Admin\ApiController@uploadDocumentsFile')}}" data-file-name="file">
                    <div id="gallery">
                        @if ($item->file ?? null && !$item->isVideo())
                            <a href="{{$item->file}}" target="_blank" class="btn btn-primary"><i class="fa fa-download m-r-5"></i> Скачать файл</a>
                            {!! Form::hidden('file', $item->file) !!}
                            <div class="text-center">
                                <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                            </div>
                        @endif
                    </div>
                    <div class="my-form">
                        @if (!$item || !$item->file)
                            <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                        @endif
                        <h3 class="text-center">
                            <label for="fileElem-file"><b>Выберите файл</b> или перетащите его.</label>
                        </h3>
                        <p class="text-center">Максимальный размер файла <b>{{ str_replace('M', '', ini_get('post_max_size')) }} Мб</b>.</p>
                        <input type="file" id="fileElem-file" />
                        <div class="progress rounded-corner progress-striped active d-none">
                            <div class="progress-bar bg-lime" style="width: 0;">
                                0%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end tab-pane -->
            <!-- begin tab-pane -->
            <div class="tab-pane fade {{ $item && $item->isVideo() ? ' active show ' : '' }}" id="default-tab-2">

                {!! Form::label(null, 'Ссылка на Youtube') !!}
                <div class="input-group m-b-15">
                    <span class="input-group-addon">https://youtu.be/</span>
                    {!! Form::text('youtube', $item->youtube ?? null, ['class' => 'form-control', 'placeholder' => 'Введите значение...']) !!}
                </div>

                <div class="drop-area" id="drop_area-file_video" data-action="{{action('Admin\ApiController@uploadDocumentsFile')}}" data-file-name="file_video">
                    <div id="gallery">
                        @if ($item->file ?? null && $item->isVideo())
                            <a href="{{$item->file}}" target="_blank" class="btn btn-primary"><i class="fa fa-download m-r-5"></i> Скачать файл</a>
                            {!! Form::hidden('file_video', $item->file) !!}
                            <div class="text-center">
                                <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                            </div>
                        @endif
                    </div>
                    <div class="my-form">
                        @if (!$item || !$item->file)
                            <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                        @endif
                        <h3 class="text-center">
                            <label for="fileElem-file_video"><b>Выберите файл</b> или перетащите его.</label>
                        </h3>
                        <p class="text-center">
                            Максимальный размер файла <b>{{ str_replace('M', '', ini_get('post_max_size')) }} Мб</b>.<br/>
                            Загружайте видео в формате <b>AVI</b> или <b>MP4</b>.
                        </p>
                        <input type="file" id="fileElem-file_video" accept="video/*" />
                        <div class="progress rounded-corner progress-striped active d-none">
                            <div class="progress-bar bg-lime" style="width: 0;">
                                0%
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end tab-pane -->
        </div>
        <!-- end tab-content -->
    </div>
</div>

@pushonce('js:file')
<link href="/assets/plugins/html5_drag_and_drop_file/style.css" rel="stylesheet" />
<script src="/assets/plugins/html5_drag_and_drop_file/script.js"></script>
@endpushonce