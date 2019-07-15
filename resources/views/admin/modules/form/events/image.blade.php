<div class="form-group row">
    {!! Form::label('image', $field->getTitle($state), ['class' => 'col-md-4 col-form-label text-right']) !!}
    <div class="col-md-8">
        <!-- begin nav-tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-items">
                <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                    <span>Пользовательская</span>
                </a>
            </li>
            <li class="nav-items">
                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                    <span>Загруженные</span>
                </a>
            </li>
        </ul>
        <!-- end nav-tabs -->
        <!-- begin tab-content -->
        <div class="tab-content">
            <!-- begin tab-pane -->
            <div class="tab-pane fade active show" id="default-tab-1">
                <div class="covers row" data-image="{{ $item->image ?? null }}"></div>
            </div>
            <!-- end tab-pane -->
            <!-- begin tab-pane -->
            <div class="tab-pane fade" id="default-tab-2">
                <div class="drop-area" id="drop_area-image" data-action="{{ action('Admin\ApiController@uploadEventImage') }}" data-file-name="image">
                    <div id="gallery">
                        @if ($item->image ?? null)
                            <img src="{{ $item->image ?? null }}"/>
                            {!! Form::hidden('image', $item->image ?? null) !!}
                            <div class="text-center">
                                <button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button>
                            </div>
                        @endif
                    </div>
                    <div class="my-form">
                        @if (!($item->image ?? null))
                            <p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>
                        @endif
                        <h3 class="text-center">
                            <label for="fileElem-image"><b>Выберите файл</b> или перетащите его.</label>
                        </h3>
                        <p class="text-center">Загружайте изображения в формате <b>JPG</b>, <b>GIF</b> или <b>PNG</b>.</p>
                        <input type="file" id="fileElem-image" accept="image/*" />
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

@pushonce('js:image')
    <style>
        .covers input[type="radio"] {
            display: none;
        }

        .covers input[type="radio"] + .image {
            display: block;
            height: 4.5vw;
            background-size: cover;
            background-position: center center;
            margin-bottom: 20px;
            border: 2px solid #FFFFFF;
        }

        .covers input[type="radio"]:checked + .image {
            border: 2px solid #FF0000;
        }

    </style>

    <link href="/assets/plugins/html5_drag_and_drop/style.css" rel="stylesheet" />
    <script src="/assets/plugins/html5_drag_and_drop/script.js"></script>
    <script>
        (function(){
            $('#event_format_id, #event_type_id').change(function(){
                toggleCoversByFormatType();
            });

            $.get('{{ action('Admin\ApiController@getAllEventCovers') }}', function(out) {
                let item_image = $('#default-tab-1 .covers').attr('data-image');
                let is_user_image = true;

                $.each(out, function(k, v){
                    if (v.image == item_image) {
                        is_user_image = false;
                    }

                    $('#default-tab-1 .covers').append(`
                        <div class="cover col-md-3" data-format-id="${v.event_format_id ? v.event_format_id : ''}" data-type-id="${v.event_type_id ? v.event_type_id : ''}">
                            <input type="radio" id="cover${k}" name="cover_image" value="${v.image}" ${v.image == item_image ? ' checked ' : ''} />
                            <label for="cover${k}" class="image" style="background-image: url('${v.image}')"></label>
                        </div>
                    `);
                });

                toggleCoversByFormatType();

                if (is_user_image) {
                    $('a[href="#default-tab-1"]').removeClass('active');
                    $('a[href="#default-tab-2"]').addClass('active');

                    $('#default-tab-1').removeClass('active').removeClass('show');
                    $('#default-tab-2').addClass('active').addClass('show');
                } else {
                    $('a[href="#default-tab-1"]').addClass('active');
                    $('a[href="#default-tab-2"]').removeClass('active');

                    $('#default-tab-1').addClass('active').addClass('show');
                    $('#default-tab-2').removeClass('active').removeClass('show');

                    $('#default-tab-2 #gallery').html('');
                    $('#default-tab-2 .my-form').prepend('<p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>');
                }

            }, 'json');

            $('a[href="#default-tab-1"]').click(function(){
                toggleCoversByFormatType();

                $('#drop_icon').remove();
                $('#default-tab-2 #gallery').html('');
                $('#default-tab-2 .my-form').prepend('<p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>');

                resizeJquerySteps();
            });

            $('a[href="#default-tab-2"]').click(function(){
                $('[name="cover_image"]').prop('checked', false);

                resizeJquerySteps();
            });


        })();
    </script>
@endpushonce