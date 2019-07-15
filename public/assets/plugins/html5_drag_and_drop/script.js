function dropAreaInit(dropArea) {
    $.each(['dragenter', 'dragover', 'dragleave', 'drop'], function (key, value) {
        dropArea.on(value, function (e) {
            e.preventDefault();
            e.stopPropagation();
        });

        $('body').on(value, function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    $.each(['dragenter', 'dragover'], function (key, value) {
        dropArea.on(value, function () {
            $(this).addClass('highlight');
        });
    });

    $.each(['dragleave', 'drop'], function (key, value) {
        dropArea.on(value, function () {
            $(this).removeClass('highlight');
        });
    });

    dropArea.on('drop', function (e) {
        let dt = e.originalEvent.dataTransfer;
        let files = dt.files;

        handleFiles(files, $(this));
    });

    dropArea.find('input[type="file"]').on('change', function () {
        handleFiles($(this)[0].files, $(this).parents('.drop-area'));
    });

    $(document).on('click', '.jsImageDelete', function(){
        let dropArea = $(this).parents('.drop-area');
        dropArea.find('#gallery').html('<input type="hidden" name="' + dropArea.attr('data-file-name') + '" value="" />');
        dropArea.find('.my-form').prepend('<p id="drop_icon" class="text-center"><i class="fa fa-upload fa-4x"></i></p>');
    });
}

function handleFiles(files, dropArea) {
    files = [...files];

    // initializeProgress(files.length);

    $.each(files, function (key, file) {
        uploadFile(file, dropArea);
        previewFile(file, dropArea);
    });
}

function uploadFile(file, dropArea) {
    let url = dropArea.attr('data-action'),
        fileName = dropArea.attr('data-file-name'),
        xhr = new XMLHttpRequest(),
        formData = new FormData();

    xhr.open('POST', url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    xhr.addEventListener('readystatechange', function(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            dropArea.find('[name="' + fileName + '"]').remove();
            dropArea.append('<input type="hidden" name="' + fileName + '" value="' + xhr.response + '"/>');

            dropArea.find('.progress').addClass('d-none');

            $.gritter.add({
                title: 'Загрузка завершена',
                text: 'Файл успешно загружен',
                class_name: 'gritter-green',
                close: 'Закрыть'
            });
        }
    });

    xhr.upload.onprogress = function(event) {
        console.log(event);

        let progress = Math.round(100 * event.loaded / event.total);
        dropArea.find('.progress').removeClass('d-none')
            .find('.progress-bar').css('width', progress + '%').html(progress + '%');
    }

    formData.append('files', file);
    xhr.send(formData);
}

function previewFile(file, dropArea) {
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = function() {
        let img = $('<img/>').attr('src', reader.result);

        dropArea.find('#gallery img').remove();
        dropArea.find('#drop_icon').hide();
        dropArea.find('#gallery').show().prepend(img);

        if (!dropArea.find('.jsImageDelete').length) {
            dropArea.find('#gallery').append(`<div class="text-center"><button type="button" class="btn btn-danger m-t-10 m-b-10 jsImageDelete"><i class="fa fa-times m-r-5"></i> Удалить изображение</button></div>`);
        }
    }
}

$('.drop-area').each(function () {
    dropAreaInit($(this));
});

$.fn.extend({
    dropArea: function() {
        dropAreaInit($(this));
    },
});

