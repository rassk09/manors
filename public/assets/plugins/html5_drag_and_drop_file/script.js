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
        let dt = e.dataTransfer;
        let files = dt.files;

        handleFiles(files, $(this));
    });

    dropArea.find('input[type="file"]').on('change', function () {
        handleFiles($(this)[0].files, $(this).parents('.drop-area'));
    });
}

function handleFiles(files, dropArea) {
    files = [...files];

    // initializeProgress(files.length);

    $.each(files, function (key, file) {
        uploadFile(file, dropArea);

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
            dropArea.append('<input type="hidden" name="' + fileName + '" value="' + xhr.response + '"/>')

            previewFile(xhr.response, dropArea);
        }
    });

    xhr.upload.onprogress = function(event) {
        let progress = Math.round(100 * event.loaded / event.total);
        dropArea.find('.progress').removeClass('d-none')
            .find('.progress-bar').css('width', progress + '%').html(progress + '%');
    }

    formData.append('files', file);
    xhr.send(formData);
}

function previewFile(file, dropArea) {
    let img = $('<a/>', {
        target: '_blank',
        class: 'btn btn-primary',
    }).attr('href', file).html('<i class="fa fa-download m-r-5"></i> Скачать файл');

    dropArea.find('#gallery a').remove();
    dropArea.find('#drop_icon').hide();
    dropArea.find('#gallery').show().append(img);

    dropArea.find('.progress').addClass('d-none');

    $.gritter.add({
        title: 'Загрузка завершена',
        text: 'Файл успешно загружен',
        class_name: 'gritter-green',
        close: 'Закрыть'
    });

}

$('.drop-area').each(function () {
    dropAreaInit($(this));
});

$.fn.extend({
    dropArea: function() {
        dropAreaInit($(this));
    },
});

