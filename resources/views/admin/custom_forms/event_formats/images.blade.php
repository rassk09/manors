@extends('admin.custom_forms.base')

@section('form')
    <!-- begin form-file-upload -->
    <div id="fileupload" action="/assets/global/plugins/jquery-file-upload/server/php/">
        <div class="note note-yellow m-b-15">
            <div class="note-icon f-s-20 p-t-10">
                <i class="fa fa-lightbulb fa-2x"></i>
            </div>
            <div class="note-content">
                <h4 class="m-t-5 m-b-5 p-b-2">Внимание!</h4>
                <ul class="p-l-25">
                    <li>Максимальный размер файл для загрузки <strong>5 Мб</strong>.</li>
                    <li>Загружать можно только изображения (<strong>JPG, GIF, PNG</strong>).</li>
                </ul>
            </div>
        </div>
        <div class="row fileupload-buttonbar">
            <div class="col-md-7">
                <span class="btn btn-primary fileinput-button m-r-3">
                    <i class="fa fa-plus"></i>
                    <span>Добавить файлы...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                {{--<button type="submit" class="btn btn-primary start m-r-3">--}}
                    {{--<i class="fa fa-upload"></i>--}}
                    {{--<span>Начать загрузку</span>--}}
                {{--</button>--}}
                {{--<button type="reset" class="btn btn-default cancel m-r-3">--}}
                    {{--<i class="fa fa-ban"></i>--}}
                    {{--<span>Отменить загрузку</span>--}}
                {{--</button>--}}
                {{--<button type="button" class="btn btn-default delete m-r-3">--}}
                    {{--<i class="glyphicon glyphicon-trash"></i>--}}
                    {{--<span>Удалить файлы</span>--}}
                {{--</button>--}}
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-md-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active m-b-0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- begin table -->
        <table class="table table-striped table-condensed">
            <thead>
            <tr>
                <th width="10%">ИЗОБРАЖЕНИЕ</th>
                <th>ИНФОРМАЦИЯ</th>
                <th>ПРОГРЕСС</th>
                <th width="1%"></th>
            </tr>
            </thead>
            <tbody class="files">
            <tr data-id="empty">
                <td colspan="4" class="text-center text-muted p-t-30 p-b-30">
                    <div class="m-b-10"><i class="fa fa-file fa-3x"></i></div>
                    <div>Файлы не выбраны</div>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- end table -->
    </div>
    <!-- end form-file-upload -->
@endsection

@section('form_js')
    <link href="/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

    <!-- The template to display files available for upload -->
    <script id="template-upload" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload fade show">
                <td>
                    <span class="preview"></span>
                </td>
                <td>
                	<div class="alert alert-secondary p-10 m-b-0">
						<dl class="m-b-0">
							<dt class="text-inverse">Имя файла:</dt>
							<dd class="name">{%=file.name%}</dd>
							<dt class="text-inverse m-t-10">Размер файла:</dt>
							<dd class="size">Оценка...</dd>
						</dl>
					</div>
                    <strong class="error text-danger"></strong>
                </td>
                <td>
                	<dl>
						<dt class="text-inverse m-t-3">Прогресс:</dt>
						<dd class="m-t-5">
							<div class="progress progress-sm progress-striped active rounded-corner"><div class="progress-bar progress-bar-primary" style="width:0%; min-width: 40px;">0%</div></div>
						</dd>
					</dl>
                </td>
                <td nowrap>
                    {% if (!i && !o.options.autoUpload) { %}
                        <button class="btn btn-primary start width-100 p-r-20 m-r-3" disabled>
                            <i class="fa fa-upload fa-fw pull-left m-t-2 m-r-5"></i>
                            <span>Загрузить</span>
                        </button>
                    {% } %}
                    {% if (!i) { %}
                        <button class="btn btn-white cancel width-100 p-r-20">
                            <i class="fa fa-trash fa-fw pull-left m-t-2 m-r-5 text-muted"></i>
                            <span>Отменить</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade show">
                <td width="1%">
                    <span class="preview">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.url%}" width="80"></a>
                        {% } else { %}
                        	<div class="bg-silver text-center f-s-20" style="width: 80px; height: 80px; line-height: 80px; border-radius: 6px;">
                        		<i class="fa fa-file-image fa-lg text-muted"></i>
                        	</div>
                        {% } %}
                    </span>
                </td>
                <td>
                	<div class="alert alert-secondary p-10 m-b-0">
						<dl class="m-b-0">
							<dt class="text-inverse">Имя файла:</dt>
							<dd class="name">
								{% if (file.url) { %}
									<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.url?'data-gallery':''%}>{%=file.name%}</a>
								{% } else { %}
									<span>{%=file.name%}</span>
								{% } %}
							</dd>
							<dt class="text-inverse m-t-10">Размер файла:</dt>
							<dd class="size">{%=o.formatFileSize(file.size)%}</dd>
						</dl>
						{% if (file.error) { %}
							<div><span class="label label-danger">ОШИБКА</span> {%=file.error%}</div>
						{% } %}
					</div>
                </td>
                <td></td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn btn-danger delete width-100 m-r-3 p-r-20" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash pull-left fa-fw m-t-2"></i>
                            <span>Удалить</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>

    <script src="/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
    <script src="/assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
    <script src="/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="/assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->

    <script>
        (function () {
            $('form').fileupload({
                autoUpload: true,
                disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                maxFileSize: 5242879,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
            });

            // Enable iframe cross-domain access via redirect option:
            $('form').fileupload(
                'option',
                'redirect',
                window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                )
            );

            // hide empty row text
            $('form').bind('fileuploadadd', function(e, data) {
                $('#fileupload [data-id="empty"]').hide();
            });

            // show empty row text
            $('form').bind('fileuploadfail', function(e, data) {
                var rowLeft = $('.files tr:not([data-id="empty"])').length - data['originalFiles'].length
                if (rowLeft === 0) {
                    $('#fileupload [data-id="empty"]').show();
                }
            });

            // Load & display existing files:
            $('form').addClass('fileupload-processing');
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: '{!! action('Admin\ApiController@getEventFormatImages', ['id' => $item->id]) !!}',
                dataType: 'json',
                context: $('form')[0]
            }).always(function () {
                $(this).removeClass('fileupload-processing');
            }).done(function (result) {
                $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
            });
        })();
    </script>
@endsection