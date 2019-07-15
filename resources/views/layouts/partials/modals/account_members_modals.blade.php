@if(isset($event))
    <div tabindex="-1" class="modal fade modal-default modal-small jsModalConfirmMembersDelete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ locale_route('account_members_delete', ['id' => $event->id]) }}">
                    <div class="modal-body">
                        <a data-dismiss="modal" class="modal__close"></a>
                        <div class="modal__message jsModalConfirmText">
                            @lang('ori_delete_members_confirm')
                        </div>
                        <div class="modal__button">
                            <a href="#" class="button-default white jsModalConfirmNo">@lang('ori_modal_confirm_no')</a>
                            <a href="#" class="button-default jsModalConfirmYes">@lang('ori_modal_confirm_yes')</a>
                            <input type="hidden" name="members" value="" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div tabindex="-1" class="modal fade modal-default modal-small jsModalEventLoadCSV">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <a data-dismiss="modal" class="modal__close"></a>
                    <div class="modal-event__inner">
                        {!! Form::open(['class' => 'event-create__form', 'route' => ['account_members_import_xls', $event->id], 'method' => 'post', 'files' => true]) !!}
                            <div class="event-create-type__title">@lang('ori_participantsvisited_text_title')</div>
                            <div class="form__input-file event-photo-upload__input modal__input-file error">
                                <input type="file"  required="" name="file_members">
                            </div>
                            <div class="modal-event__foot">
                                <button class="button-default">@lang('ori_participantsvisited_button_add')</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div tabindex="-1" class="modal fade modal-default modal-small jsModalEventAddMember">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <a data-dismiss="modal" class="modal__close"></a>
                    <div class="modal-event__inner">
                        {!! Form::open(['class' => 'event-create__form', 'method' => 'post', 'route' => ['account_members_store', $event->id]]) !!}
                            <div class="form__group">
                                <div class="form__input event-create__input">
                                    <input type="text" name="name" required placeholder="@lang('ori_form-fullname_placeholder')">
                                </div>
                                <div class="form__label">@lang('ori_changemanager_text_name')</div>
                            </div>
                            <div class="form__group">
                                <div class="form__input event-create__input">
                                    <input type="email" name="email" required placeholder="example@mail.ru">
                                </div>
                                <div class="form__label">@lang('ori_entermail_new')</div>
                            </div>
                            <div class="form__group">
                                <div class="form__input event-create__input">
                                    <input type="text" name="phone" required placeholder="@lang('ori_form-phone_placeholder')">
                                </div>
                                <div class="form__label">@lang('ori_changemanager_text_mobile')</div>
                            </div>
                            <div class="modal-event__foot">
                                <button class="button-default"><span>@lang('ori_participantsadd_button_add')</span></button>
                                <input type="hidden" name="event_id" value="{{ $event->id }}" />
                                <input type="hidden" name="type" value="{{ $event->is_ended }}" />
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif