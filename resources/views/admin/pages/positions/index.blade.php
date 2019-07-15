@extends('admin.layouts.app')

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Распределение блоков</h1>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-white pull-left m-r-10 m-b-20" data-action="reset"><i class="fas fa-sync m-r-5"></i> Сбросить все изменения</button>
                <a href="/?preview=1" target="_blank" class="btn btn-yellow pull-left m-r-10 m-b-20"><i class="fas fa-eye m-r-5"></i> Предпросмотр</a>
                <button type="button" class="btn btn-success pull-left m-r-10 m-b-20" data-action="publish"><i class="fas fa-check m-r-5"></i> Опубликовать страницу</button>
            </div>
        </div>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row" data-row="slides">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Свежие новости</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary pull-left m-r-10 m-b-20 jsAddNewBlock"><i class="fas fa-plus m-r-5"></i> Добавить слайд</button>
                        </div>
                    </div>
                    <div class="row" data-content>
                        <div class="col-md-12 loader text-center m-t-40 m-b-40">
                            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- begin row -->
        <div class="row" data-row="subjects">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Темы</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary pull-left m-r-10 m-b-20 jsAddNewBlock"><i class="fas fa-plus m-r-5"></i> Добавить тему</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 loader text-center m-t-40 m-b-40">
                            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
                        </div>
                        <div class="card-group" data-content></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- begin row -->
        <div class="row" data-row="today_blocks">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Сегодня</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="pull-left m-r-10 m-b-20">
                                <a href="#" class="btn btn-primary" data-toggle="dropdown"><i class="fas fa-plus m-r-5"></i> Добавить блок <i class="caret"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" class="jsAddNewCard" data-width="3" data-height="5">Блок S (3х3)</a></li>
                                    <li><a href="#" class="jsAddNewCard" data-width="6" data-height="5">Блок L (6х3)</a></li>
                                </ul>
                            </div>

                            <button type="button" class="btn btn-yellow pull-left m-r-10 m-b-20 jsAddNewText" data-width="6" data-height="10" data-type="3"><i class="fas fa-plus m-r-5"></i> Добавить карту</button>
                        </div>
                    </div>
                    <div class="grid-stack" data-gs-width="12" data-gs-current-height="120" data-content></div>
                </div>
            </div>
        </div>

        <!-- begin row -->
        <div class="row" data-row="videos">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Видео</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary pull-left m-r-10 m-b-20 jsAddNewBlock"><i class="fas fa-plus m-r-5"></i> Добавить видео</button>
                        </div>
                    </div>
                    <div class="row" data-content>
                        <div class="col-md-12 loader text-center m-t-40 m-b-40">
                            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- begin row -->
        <div class="row" data-row="lifestyle_blocks">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Лайфстайл</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="pull-left m-r-10 m-b-20">
                                <a href="#" class="btn btn-primary" data-toggle="dropdown"><i class="fas fa-plus m-r-5"></i> Добавить блок <i class="caret"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" class="jsAddNewCard" data-width="3" data-height="5">Блок S (3х3)</a></li>
                                    <li><a href="#" class="jsAddNewCard" data-width="4" data-height="5">Блок M (4х3)</a></li>
                                    <li><a href="#" class="jsAddNewCard" data-width="6" data-height="5">Блок L (6х3)</a></li>
                                    <li><a href="#" class="jsAddNewCard" data-width="12" data-height="5">Блок XLW (12х3)</a></li>
                                    <li><a href="#" class="jsAddNewCard" data-width="6" data-height="10">Блок XLH (6х6)</a></li>
                                </ul>
                            </div>
                            <div class="pull-left m-r-10 m-b-20">
                                <a href="#" class="btn btn-success" data-toggle="dropdown"><i class="fas fa-plus m-r-5"></i> Добавить заголовок <i class="caret"></i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#" class="jsAddNewText" data-width="12" data-height="1" data-type="12" data-class="homepage_super_title">Раздел</a></li>
                                    <li><a href="#" class="jsAddNewText" data-width="12" data-height="1" data-type="5" data-class="homepage_title">Заголовок (100%)</a></li>
                                    <li><a href="#" class="jsAddNewText" data-width="12" data-height="1" data-type="6" data-class="homepage_subtitle">Подзаголовок (100%)</a></li>
                                    <li><a href="#" class="jsAddNewText" data-width="6" data-height="1" data-type="6" data-class="homepage_subtitle">Подзаголовок (50%)</a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-white pull-left m-r-10 m-b-20 jsAddNewText" data-width="12" data-height="2" data-type="13" data-class="homepage_description"><i class="fas fa-plus m-r-5"></i> Добавить описание</button>
                        </div>
                    </div>
                    <div class="grid-stack" data-gs-width="12" data-gs-current-height="120" data-content></div>
                </div>
            </div>
        </div>

        <!-- begin row -->
        <div class="row" data-row="products">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <div class="card p-20">
                    <h4 class="m-b-15">Товары</h4>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary pull-left m-r-10 m-b-20 jsAddNewBlock"><i class="fas fa-plus m-r-5"></i> Добавить товар</button>
                        </div>
                    </div>
                    <div class="row" data-content>
                        <div class="col-md-12 loader text-center m-t-40 m-b-40">
                            <i class="fa text-primary fa-5x fa-circle-notch fa-spin m-t-40 m-b-40"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/assets/plugins/gridstack/dist/gridstack.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
    <link href="/assets/plugins/cropperjs-master/dist/cropper.min.css" rel="stylesheet" />


    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/assets/plugins/gridstack/dist/lodash.min.js"></script>
    <script src="/assets/plugins/gridstack/dist/gridstack.js"></script>
    <script src="/assets/plugins/gridstack/dist/gridstack.jQueryUI.js"></script>
    <script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <script src="/assets/plugins/cropperjs-master/dist/cropper.min.js"></script>

    <!-- #modal-dialog -->
    <!-- Results Create Edit Form -->
    <div class="modal fade" id="jsAddMaterial">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Добавить материал</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-l-15 p-r-15">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-right">
                                        Материал
                                    </label>
                                    <div class="col-md-8">
                                        <select class="selectpicker form-control" name="material_id" data-size="10" data-live-search="true" data-style="btn-white"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        {!! Form::hidden('block_id', null) !!}
                        {!! Form::hidden('width', null) !!}
                        {!! Form::hidden('height', null) !!}
                        {!! Form::hidden('type_id', null) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- #modal-dialog -->
    <!-- Results Create Edit Form -->
    <div class="modal fade" id="jsAddText">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Добавить текстовый блок</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-l-15 p-r-15">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-right">
                                        Содержимое
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="content" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        {!! Form::hidden('block_id', null) !!}
                        {!! Form::hidden('width', null) !!}
                        {!! Form::hidden('height', null) !!}
                        {!! Form::hidden('type_id', null) !!}
                        {!! Form::hidden('id', null) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- #modal-dialog -->
    <!-- Results Create Edit Form -->
    <div class="modal fade" id="jsAdditional">
        <div class="modal-dialog" style="min-width: 768px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Дополнительно</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-l-15 p-r-15">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-right">
                                        Цвет фона
                                    </label>
                                    <div class="col-md-8">
                                        <input name="bg_color" type="text" class="form-control colorpicker-rgba" data-color-format="rgba" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-right">
                                        Цвет текста
                                    </label>
                                    <div class="col-md-8">
                                        <input name="text_color" type="text" class="form-control colorpicker-rgba" data-color-format="rgba" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        {!! Form::hidden('id', null) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- #modal-dialog -->
    <!-- Results Create Edit Form -->
    <div class="modal fade" id="jsCropImage">
        <div class="modal-dialog" style="min-width: 1024px;">
            {!! Form::open(['class' => 'form-horizontal form-bordered']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Обрезать изображение</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-l-15 p-r-15">
                            <div class="col-md-8">
                                <img src="/images/desktop/lk/bg/1@2x.jpg" id="crop_image"/>
                                <div class="buttons m-t-15">
                                    <div class="btn-group m-r-5">
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-zoom-in" data-tooltip="tooltip" data-placement="top" data-title="Увеличить масштаб"><i class="fa fa-search-plus"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-zoom-out" data-tooltip="tooltip" data-placement="top" data-title="Уменьшить масштаб"><i class="fa fa-search-minus"></i></button>
                                    </div>
                                    <div class="btn-group m-r-5">
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-move-left" data-tooltip="tooltip" data-placement="top" data-title="Переместить влево"><i class="fa fa-arrow-left"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-move-right" data-tooltip="tooltip" data-placement="top" data-title="Переместить вправо"><i class="fa fa-arrow-right"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-move-up" data-tooltip="tooltip" data-placement="top" data-title="Переместить вверх"><i class="fa fa-arrow-up"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-move-down" data-tooltip="tooltip" data-placement="top" data-title="Переместить вниз"><i class="fa fa-arrow-down"></i></button>
                                    </div>
                                    <div class="btn-group m-r-5">
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-rotate-45" data-tooltip="tooltip" data-placement="top" data-title="Повернуть против часовой (45°)"><i class="fa fa-flip-horizontal fa-redo-alt"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-rotate-45-alt" data-tooltip="tooltip" data-placement="top" data-title="Повернуть по часовой (45°)"><i class="fa fa-redo-alt"></i></button>
                                    </div>
                                    <div class="btn-group m-r-5">
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-flip-horizontal" data-tooltip="tooltip" data-placement="top" data-title="Отобразить по горизонтали"><i class="fa fa-arrows-alt-h"></i></button>
                                        <button type="button" class="btn btn-lg btn-primary btn-icon" data-action="cropper-flip-vertical" data-tooltip="tooltip" data-placement="top" data-title="Отобразить по вертикали"><i class="fa fa-arrows-alt-v"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-l-30">
                                <h5 class="m-b-10">Предпросмотр</h5>
                                <div class="crop_preview">
                                    <div class="img-preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Отменить</a>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        {!! Form::hidden('id', null) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <style>
        .card.product img {
            display: block;
            width: 180px;
            height: 180px;
            margin: 0 auto;
        }

        /*.grid-stack-item-content {*/
            /*background: #999999;*/
        /*}*/

        .homepage_super_title {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
            font-size: 40px;
            line-height: 1;
            letter-spacing: 6.7px;
            color: #211f22;
            text-transform: uppercase;
            white-space: nowrap;
            text-align: center;
            padding: 2px 0;
        }

        .homepage_super_title:before {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #000;
            background: linear-gradient(to right, #000 0%, #000 calc(100% - 300px), #fff 100%);
            position: relative;
        }

        .homepage_super_title:after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #000;
            position: relative;
            background: linear-gradient(to left,#000 0%,#000 calc(100% - 300px),#fff 100%);
        }

        .homepage_super_title span {
            padding: 0 35px;
        }

        .homepage_title {
            text-align: center;
            font-size: 30px;
            text-transform: uppercase;
            padding-left: 11px;
            padding-right: 11px;
            width: 100%;
        }

        .homepage_subtitle {
            margin-top: 15px;
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
            padding-left: 11px;
            padding-right: 11px;
        }

        .homepage_subtitle span {
            font-size: 16px;
            line-height: 1;
            color: #211f22;
            text-transform: uppercase;
            display: block;
            padding-right: 30px;
            white-space: nowrap;
        }

        .homepage_subtitle:after {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: #000;
            position: relative;
        }

        .homepage_description span {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 590px;
            font-size: 18px;
            line-height: 30px;
            color: #9b9b9b;
            font-weight: normal;
        }

        .colorpicker {
            z-index: 2500!important;
        }

        .grid-stack-item-content.map {
            background-image: url('/images/desktop/lk/bg/1@2x.jpg');
            background-position: 50% 50%;
            background-size: cover;
            background-repeat: no-repeat;
        }

        #jsCropImage img {
            width: 100%;
        }

        .img-preview {
            float: left;
            margin-bottom: 0.5rem;
            margin-right: 0.5rem;
            overflow: hidden;
            background: #cccccc;
        }

        .grid-stack > .grid-stack-item > .grid-stack-item-content {
            overflow-y: hidden;
        }


    </style>

    <script>
        (function(){
            let rows = {
                slides: {},
                subjects: {},
                today_blocks: {},
                videos: {},
                lifestyle_blocks: {},
                products: {},
            }, all_materials,
                cropper;

            $.each(rows, function(key, row){
                row.object = $('[data-row="' + key + '"]');
                row.content = row.object.find('[data-content]');
            });

            $.get('{{action('Admin\ApiController@getPositions')}}', function(out){
                $.each(out, function(row_name, type){
                    $.each(type, function(key, item) {
                        rows[row_name].content.append(getContent(row_name, item));
                    });

                    rows[row_name].object.find('.loader').remove();
                });

                rows.slides.content.sortable({
                    stop: function (e, ui) {
                        storePositions(e, ui);
                    }
                }).disableSelection();

                rows.subjects.content.sortable({
                    stop: function (e, ui) {
                        storePositions(e, ui);
                    }
                }).disableSelection();

                rows.videos.content.sortable({
                    stop: function (e, ui) {
                        storePositions(e, ui);
                    }
                }).disableSelection();

                rows.products.content.sortable({
                    stop: function (e, ui) {
                        storePositions(e, ui);
                    }
                }).disableSelection();

                rows.lifestyle_blocks.content.gridstack().on('dragstop', function(event, ui) {
                    let grid = $(this),
                        items = grid.find('.grid-stack-item'),
                        positions = [];

                    setTimeout(function () {
                        $.each(items, function(index, value) {
                            let card = $(value).hasClass('card') ? $(value) : $(value).find('.card');

                            positions.push({
                                id: card.attr('data-id'),
                                'x': $(value).attr('data-gs-x'),
                                'y': $(value).attr('data-gs-y'),
                            });
                        });

                        $.post('{{action('Admin\ApiController@positionPositions')}}', {positions: positions}, function(){
                            swal({
                                title: "Готово!",
                                text: "Порядок сохранен",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'Закрыть',
                                        visible: true,
                                        className: 'btn btn-success',
                                        closeModal: true
                                    },
                                },
                            })
                        }, 'json');

                    }, 200);
                });

                rows.today_blocks.content.gridstack().on('dragstop', function(event, ui) {
                    let grid = $(this),
                        items = grid.find('.grid-stack-item'),
                        positions = [];

                    setTimeout(function () {
                        $.each(items, function(index, value) {
                            let card = $(value).hasClass('card') ? $(value) : $(value).find('.card');

                            positions.push({
                                id: card.attr('data-id'),
                                'x': $(value).attr('data-gs-x'),
                                'y': $(value).attr('data-gs-y'),
                            });
                        });

                        $.post('{{action('Admin\ApiController@positionPositions')}}', {positions: positions}, function(){
                            swal({
                                title: "Готово!",
                                text: "Порядок сохранен",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'Закрыть',
                                        visible: true,
                                        className: 'btn btn-success',
                                        closeModal: true
                                    },
                                },
                            })
                        }, 'json');

                    }, 200);
                });


            }, 'json');

            $.get('{{action('Admin\ApiController@getAllMaterials')}}', function(out){
                all_materials = out.materials;

                $.each(all_materials, function(key, material) {
                    $.each(material.types, function(key, type){
                        if (type.type_id == 1) material.isSlide = true;
                        if (type.type_id == 2) material.isSubject = true;
                        if (type.type_id == 3) material.isBlock = true;
                        if (type.type_id == 4) material.isVideo = true;
                        if (type.type_id == 5) material.isBlock = true;
                        if (type.type_id == 6) material.isProduct = true;
                    });
                });
            }, 'json');

            $('.colorpicker-rgba').colorpicker();
            $('.selectpicker').selectpicker('render');
            $('.btn-group.bootstrap-select .caret').remove();
            $('[data-tooltip="tooltip"]').tooltip();


            $('.jsAddNewBlock').click(function(){
                let parent = $(this).parents('[data-row]').attr('data-row');

                showAddModal(parent);
                $('#jsAddMaterial [name="width"]').val('');
                $('#jsAddMaterial [name="height"]').val('');
                $('#jsAddMaterial [name="type_id"]').val('');
            });

            $('.jsAddNewCard').click(function(e){
                e.preventDefault();

                let row = $(this).parents('[data-row]'),
                    parent = row.attr('data-row');

                showAddModal(parent);
                $('#jsAddMaterial [name="width"]').val($(this).attr('data-width'));
                $('#jsAddMaterial [name="height"]').val($(this).attr('data-height'));
                $('#jsAddMaterial [name="type_id"]').val(1);
            });

            $('.jsAddNewText').click(function(e){
                e.preventDefault();

                let row = $(this).parents('[data-row]'),
                    parent = row.attr('data-row'),
                    type_id = $(this).attr('data-type');

                $('#jsAddText form')[0].reset();
                $('#jsAddText [name="block_id"]').val(parent);
                $('#jsAddText [name="width"]').val($(this).attr('data-width'));
                $('#jsAddText [name="height"]').val($(this).attr('data-height'));
                $('#jsAddText [name="type_id"]').val($(this).attr('data-type'));

                if (type_id == 3) {
                    $('#jsAddText form').trigger('submit');
                } else {
                    $('#jsAddText').modal('show');
                }

            });

            $('.modal form').submit(function(e){
                e.preventDefault();

                let form = $(this),
                    modal = form.parents('.modal'),
                    block = form.find('[name="block_id"]').val(),
                    card_id = form.find('[name="id"]').val();

                if (modal.attr('id') == 'jsAdditional') {
                    $.post('{{action('Admin\ApiController@additionalPositions')}}', form.serialize(), function(out){
                        $('.card[data-id="' + form.find('[name="id"]').val() + '"] .additional').html(out.object.additional_settings);

                        $('.modal').modal('hide');

                        swal(out);
                    }, 'json');
                } else if (modal.attr('id') == 'jsCropImage') {
                    cropper.getCroppedCanvas().toBlob((blob) => {
                        let id = $(this).find('[name="id"]').val(),
                            formData = new FormData();

                        console.log(blob);

                        formData.append('files', blob);
                        formData.append('id', id);

                        // Use `jQuery.ajax` method
                        $.ajax('{{action('Admin\ApiController@cropPositions')}}', {
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success(out) {
                                $('.card[data-id="' + id + '"] img').attr('src', out.object.cropped_image);

                                $('.modal').modal('hide');

                                swal(out);
                            },
                            error() {
                                console.log('Upload error');
                            },
                        });
                    });
                } else {
                    $.post('{{action('Admin\ApiController@addPositions')}}', form.serialize(), function(out){
                        if (card_id) {
                            $('.card[data-id="' + card_id + '"] h4 span').html(out.object.content);
                        } else {
                            if (block != 'today_blocks' && block != 'lifestyle_blocks') {
                                rows[block].content.append(getContent(block, out.object));
                            } else {
                                let row = $('[data-row="' + block + '"]'),
                                    content = row.find('[data-content]'),
                                    grid = content.data('gridstack'),
                                    item = out.object;

                                grid.addWidget(getContent(block, item), item.x, item.y, item.width, item.height / 2, false);
                            }
                        }

                        $('.modal').modal('hide');

                        swal(out);
                    }, 'json');
                }
            });

            $(document).on('click', '[data-action="edit_content"]', function(e){
                e.preventDefault();

                let card = $(this).parents('.card[data-id]');

                $('#jsAddText').modal('show');
                $('#jsAddText form')[0].reset();
                $('#jsAddText [name="id"]').val(card.attr('data-id'));
                $('#jsAddText [name="content"]').val(card.find('h4 span').html());
            });

            $(document).on('click', '[data-action="additional"]', function(e){
                e.preventDefault();

                let card = $(this).parents('.card[data-id]'),
                    additional = card.find('.additional').html(),
                    additional_obj = JSON.parse(additional);

                $('#jsAdditional').modal('show');
                $('#jsAdditional form')[0].reset();
                $('#jsAdditional [name="id"]').val(card.attr('data-id'));
                $('#jsAdditional [name="bg_color"]').val(additional_obj.bg_color);
                $('#jsAdditional [name="text_color"]').val(additional_obj.text_color);
            });

            $(document).on('click', '[data-action="crop_image"]', function(e){
                e.preventDefault();

                let card = $(this).parents('.card[data-id]'),
                    block = $(this).parents('[data-row]').attr('data-row'),
                    ratio = getImageRatio(block, card);

                $('#jsCropImage').modal('show');
                $('#jsCropImage form')[0].reset();
                $('#jsCropImage [name="id"]').val(card.attr('data-id'));
                $('#jsCropImage #crop_image').attr('src', card.attr('data-full-image'));
                $('#jsCropImage .img-preview').css({
                    width: 288 + 'px',
                    height: 288 * ratio + 'px',
                });

                if (cropper) {
                    cropper.destroy();
                }

                setTimeout(function(){
                    cropper = new Cropper($('#jsCropImage #crop_image')[0], {
                        viewMode: 1,
                        aspectRatio: ratio,
                        dragMode: 'move',
                        preview: '.img-preview'
                    });


                }, 250);

            });

            $(document).on('click', '[data-action="delete_position"]', function(e){
                e.preventDefault();

                let row = $(this).parents('[data-row]').attr('data-row'),
                    position_id = $(this).parents('.card').attr('data-id'),
                    parents = $(this).parents(),
                    block = null;

                $.each(parents, function(key, parent) {
                    if($(this).attr('data-content') === '') {
                        block = parents[key - 1];
                        return false;
                    }
                });

                swal({
                    title: "Вы уверены?",
                    text: "После удаления будет невозможно восстановить блок",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Удалить',
                            visible: true,
                            className: 'btn btn-warning',
                            closeModal: false
                        },
                        cancel: {
                            text: 'Отмена',
                            className: 'btn',
                            visible: true,
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $.post('{!! action('Admin\ApiController@deletePosition') !!}', {position_id: position_id}, function(out){
                            if (row != 'lifestyle_blocks' && row != 'today_blocks') {
                                $(block).remove();
                            } else {
                                let parent_row = $('[data-row="' + row + '"]'),
                                    content = parent_row.find('[data-content]'),
                                    grid = content.data('gridstack');

                                grid.removeWidget($(block));
                            }


                            swal({
                                title: "Готово!",
                                text: "Блок удален",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'Закрыть',
                                        visible: true,
                                        className: 'btn btn-success',
                                        closeModal: true
                                    },
                                },
                            })
                        }, 'json');
                    }
                });
            });

            $(document).on('click', '[data-action="cropper-zoom-in"]', function(e){
                cropper.zoom(0.1);
            });

            $(document).on('click', '[data-action="cropper-zoom-out"]', function(e){
                cropper.zoom(-0.1);
            });

            $(document).on('click', '[data-action="cropper-move-left"]', function(e){
                cropper.move(-10, 0);
            });

            $(document).on('click', '[data-action="cropper-move-right"]', function(e){
                cropper.move(10, 0);
            });

            $(document).on('click', '[data-action="cropper-move-up"]', function(e){
                cropper.move(0, -10);
            });

            $(document).on('click', '[data-action="cropper-move-down"]', function(e){
                cropper.move(0, 10);
            });

            $(document).on('click', '[data-action="cropper-rotate-45"]', function(e){
                cropper.rotate(-45);
            });

            $(document).on('click', '[data-action="cropper-rotate-45-alt"]', function(e){
                cropper.rotate(45);
            });

            $(document).on('click', '[data-action="cropper-flip-horizontal"]', function(e){
                $(this).toggleClass('flipped');
                if ($(this).hasClass('flipped')) {
                    cropper.scaleX(-1);
                } else {
                    cropper.scaleX(1);
                }
            });

            $(document).on('click', '[data-action="cropper-flip-vertical"]', function(e){
                $(this).toggleClass('flipped');
                if ($(this).hasClass('flipped')) {
                    cropper.scaleY(-1);
                } else {
                    cropper.scaleY(1);
                }
            });

            $('[data-action="publish"]').click(function(){
                swal({
                    title: "Вы уверены?",
                    text: "Вы уверены что хотите опубликовать изменения?",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Опубликовать',
                            visible: true,
                            className: 'btn btn-primary',
                            closeModal: false
                        },
                        cancel: {
                            text: 'Отмена',
                            className: 'btn',
                            visible: true,
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $.post('{!! action('Admin\ApiController@publishPosition') !!}', function(out){
                            swal({
                                title: "Готово!",
                                text: "Главная страница опубликована",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'Закрыть',
                                        visible: true,
                                        className: 'btn btn-success',
                                        closeModal: true
                                    },
                                },
                            })
                        }, 'json');
                    }
                });
            });

            $('[data-action="reset"]').click(function(){
                swal({
                    title: "Вы уверены?",
                    text: "После сброса будет невозможно восстановить изменения",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: 'Сбросить',
                            visible: true,
                            className: 'btn btn-primary',
                            closeModal: false
                        },
                        cancel: {
                            text: 'Отмена',
                            className: 'btn',
                            visible: true,
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $.post('{!! action('Admin\ApiController@resetPosition') !!}', function(out){
                            swal({
                                title: "Готово!",
                                text: "Все изменения сброшены",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'Закрыть',
                                        visible: true,
                                        className: 'btn btn-success',
                                        closeModal: true
                                    },
                                },
                            });

                            setTimeout(function(){
                               window.location.reload();
                            }, 2000);
                        }, 'json');
                    }
                });
            });

            function getContent(row_name, item) {
                let material = item.material;

                if (item.material) {
                    if (row_name == 'slides') {
                        return `
                            <div class="col-md-3">
                                <div class="card" data-id="${item.id}" data-full-image="${material.image}">
                                    <img class="card-img-top" src="${getItemImage(item)}" alt="">
                                    <div class="card-block">
                                        <p class="card-text"><small class="text-muted">${ material.category ? material.category : `<b class="text-danger">Поле "Категория" не заполнено</b>` }</small></p>
                                        <h4 class="card-title m-t-0 m-b-10">${material.name}</h4>
                                        ${ material.text ? material.text : `<b class="text-danger">Поле "Текст" не заполнено</b>` }
                                        <div class="card-buttons-tr">
                                            <button type="button" class="btn btn-sm btn-icon btn-info m-r-5 m-b-5" data-action="crop_image" data-tooltip="tooltip" data-placement="top" data-title="Обрезать изображение"><i class="fa fa-crop"></i></button>
                                            <a href="${getMaterialEditAction(material)}" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (row_name == 'subjects') {
                        return `
                            <div class="card" data-id="${item.id}">
                                <div class="card-block">
                                    <p class="card-text"><small class="text-muted">${ material.category ? material.category : `<b class="text-danger">Поле "Категория" не заполнено</b>` }</small></p>
                                    <h4 class="card-title">${material.name}</h4>
                                    <div class="card-buttons-tr">
                                        <a href="${getMaterialEditAction(material)}" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (row_name == 'videos') {
                        return `
                            <div class="col-md-3">
                                <div class="card" data-id="${item.id}" data-full-image="${material.image}">
                                    <img class="card-img-top" src="${getItemImage(item)}" alt="">
                                    <div class="card-block">
                                        <h4 class="card-title m-t-0 m-b-10">${material.name}</h4>
                                        <div class="card-buttons-tr">
                                            <button type="button" class="btn btn-sm btn-icon btn-info m-r-5 m-b-5" data-action="crop_image" data-tooltip="tooltip" data-placement="top" data-title="Обрезать изображение"><i class="fa fa-crop"></i></button>
                                            <a href="${getMaterialEditAction(material)}" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (row_name == 'products') {
                        return `
                            <div class="col-md-3">
                                <div class="card product" data-id="${item.id}" data-full-image="${material.image}">
                                    <img class="card-img-top" src="${getItemImage(item)}" alt="" height="180">
                                    <div class="card-block">
                                        <p class="card-text"><small class="text-muted">${ material.category ? material.category : `<b class="text-danger">Поле "Категория" не заполнено</b>` }</small></p>
                                        <h4 class="card-title m-t-0 m-b-10">${material.name}</h4>
                                        <div class="card-buttons-tr">
                                            <button type="button" class="btn btn-sm btn-icon btn-info m-r-5 m-b-5" data-action="crop_image" data-tooltip="tooltip" data-placement="top" data-title="Обрезать изображение"><i class="fa fa-crop"></i></button>
                                            <a href="${getMaterialEditAction(material)}" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if (row_name == 'today_blocks' || row_name == 'lifestyle_blocks') {
                        return `
                            <div class="grid-stack-item" data-gs-no-resize="true" data-gs-x="${item.x}" data-gs-y="${item.y}" data-gs-width="${item.width}" data-gs-height="${item.height / 2}">
                                <div class="grid-stack-item-content">
                                    <div class="card card-inverse m-b-0" data-id="${item.id}" data-full-image="${material.image}">
                                        <img class="card-img-top img-fluid" src="${getItemImage(item)}" alt="Card image cap">
                                        <div class="card-img-overlay">
                                            <h4 class="card-title">${material.name}</h4>
                                            <div class="card-buttons-tr">
                                                <button type="button" class="btn btn-sm btn-icon btn-info m-r-5 m-b-5" data-action="crop_image" data-tooltip="tooltip" data-placement="top" data-title="Обрезать изображение"><i class="fa fa-crop"></i></button>
                                                ${
                                                    row_name == 'lifestyle_blocks' ?
                                                    `<button type="button" class="btn btn-sm btn-icon btn-info m-r-5 m-b-5" data-action="additional" data-tooltip="tooltip" data-placement="top" data-title="Дополнительно"><i class="fa fa-magic"></i></button>` :
                                                    ``
                                                }
                                                <a href="${getMaterialEditAction(material)}" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <div class="additional d-none">${item.additional_settings}</div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                } else {
                    if (row_name == 'today_blocks' || row_name == 'lifestyle_blocks') {
                        return `
                            <div class="grid-stack-item" data-gs-no-resize="true" data-gs-x="${item.x}" data-gs-y="${item.y}" data-gs-width="${item.width}" data-gs-height="${item.height / 2}">
                                <div class="grid-stack-item-content ${ item.type_id == 3 ? 'map' : '' }">
                                    <div class="card" data-id="${item.id}">
                                        <h4 class="${getStaticClass(item.type_id)}">${item.content ? `<span>${item.content}</span>` : ''}</h4>
                                        <div class="card-buttons-tr">
                                            ${
                                                item.type_id != 3 ?
                                                `<a href="#" target="_blank" class="btn btn-sm btn-icon btn-warning m-r-5 m-b-5" data-action="edit_content" data-tooltip="tooltip" data-placement="top" data-title="Редактировать материал"><i class="fa fa-pencil-alt"></i></a>` :
                                                ``
                                            }
                                            <button type="button" class="btn btn-sm btn-icon btn-danger m-r-5 m-b-5" data-action="delete_position" data-tooltip="tooltip" data-placement="top" data-title="Удалить"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                }
            }

            function showAddModal(type) {
                $('#jsAddMaterial select').html('');
                $.each(all_materials, function(key, material){
                    let isSlide = type == 'slides' && material.isSlide,
                        isSubject = type == 'subjects' && material.isSubject,
                        isVideo = type == 'videos' && material.isVideo,
                        isProduct = type == 'products' && material.isProduct,
                        isBlock = (type == 'lifestyle_blocks' || type == 'today_blocks') && material.isBlock;

                    if (isSlide || isSubject || isVideo || isProduct || isBlock) {
                        $('#jsAddMaterial select').append(`<option value="${material.id}">${material.name}</option>`);
                    }
                });

                $('#jsAddMaterial').modal('show');
                $('#jsAddMaterial form')[0].reset();
                $('#jsAddMaterial [name="block_id"]').val(type);
                $('.selectpicker').selectpicker('refresh');
            }

            function getItemImage(item) {
                if (item.cropped_image) {
                    return item.cropped_image;
                } else if (item.material) {
                    return item.material.image;
                }

                return '';
            }

            function getMaterialEditAction(material) {
                return '/admin/materials/' + material.id + '/edit';
            }

            function storePositions(e, ui) {
                let positions = [],
                    k = 0;

                ui.item.parents('[data-content]').find(' > div').each(function(){
                    let card = $(this).hasClass('card') ? $(this) : $(this).find('.card');

                    k++;
                    positions.push({
                        id: card.attr('data-id'),
                        x: k,
                        y: 0,
                    });
                });

                $.post('{{action('Admin\ApiController@positionPositions')}}', {positions: positions}, function(){
                    swal({
                        title: "Готово!",
                        text: "Порядок сохранен",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: 'Закрыть',
                                visible: true,
                                className: 'btn btn-success',
                                closeModal: true
                            },
                        },
                    })
                }, 'json');
            }

            function getStaticClass(type_id) {
                if (type_id == 3) {
                    return 'homepage_map';

                } else if (type_id == 5) {
                    return 'homepage_title';

                } else if (type_id == 6) {
                    return 'homepage_subtitle';

                } else if (type_id == 12) {
                    return 'homepage_super_title';

                } else if (type_id == 13) {
                    return 'homepage_description';

                }
            }

            function getImageRatio(block, card) {
                if (block == 'slides') {
                    return 380 / 540;

                } else if (block == 'videos') {
                    return 250 / 150;

                } else if (block == 'products') {
                    return 1;

                } else if (block == 'lifestyle_blocks' || block == 'today_blocks') {
                    let item = card.parents('.grid-stack-item'),
                        width = +item.attr('data-gs-width'),
                        height = +item.attr('data-gs-height');

                    if (width == 3 && height == 5) {
                        return 235 / 400;
                    } else if (width == 4 && height == 5) {
                        return 312 / 400;
                    } else if (width == 6 && height == 5) {
                        return 491 / 400;
                    } else if (width == 6 && height == 10) {
                        return 491 / 860;
                    } else if (width == 12 && height == 5) {
                        return 1000 / 400;
                    }

                }
            }

        })();
    </script>
@endsection