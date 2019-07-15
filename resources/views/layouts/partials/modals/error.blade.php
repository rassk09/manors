<div tabindex="-1" class="modal fade modal-default modal-small jsModalError">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal__message jsModalErrorMessage">
                    {!!
                        request()->has('error') && request()->get('error') == 'invalid_xls_file' ?
                        'Прикрепленный файл не соответствует формату .xls<br/><br/>Попробуйте пересохранить файл и загрузить его снова' :
                        (request()->get('error') == 'user_exists' ? 'Пользователь уже записан на мероприятие' : __k('ori_error')) !!} {{-- TODO !!!TRANSLATIONS!!! --}}
                </div>
            </div>
        </div>
    </div>
</div>

