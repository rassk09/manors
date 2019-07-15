<div tabindex="-1" class="modal fade modal-default modal-subscribe jsModalEventSubscribe">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content event-subscribe">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="event-subscribe__inner">
                    <form method="post" data-event="1">
                        <div class="event-subscribe__title">@lang('ori_event_window_signup_text_want-new')</div>
                        <div class="event-subscribe__input">
                            <input type="text" required placeholder="@lang('ori_form-fullname_placeholder')" name="name">
                            <div class="error"></div>
                        </div>
                        <div class="event-subscribe__input">
                            <input type="email" required placeholder="@lang('ori_event_window_signup_text_mail')" name="email">
                            <div class="error"></div>
                        </div>
                        <div class="event-subscribe__input">
                            <input type="tel" required name="phone" placeholder="@lang('ori_LK_text_mobile')">
                            <div class="error"></div>
                        </div>
                        <div class="event-subscribe__checkbox-group">
                            <div class="checkbox error">
                                <label>
                                    <input name="personal" type="checkbox" checked required id="agree10">
                                    <i></i>
                                    <span>@lang('ori_chosen_enter_text_agree-new')</span>
                                </label>
                                <div class="error"></div>
                            </div>
                            @if (in_array($__locale->code, ['ru-RU', 'by-BY', 'kz-KZ', 'kz-RU', 'kg-RU']))
                                <div class="checkbox error">
                                    <label>
                                        <input name="is_subscribed" type="checkbox" checked id="subscribe10" value="1">
                                        <i></i>
                                        <span>@lang('ori_chosen_enter_text_news-new')</span>
                                    </label>
                                    <div class="error"></div>
                                </div>
                            @endif
                        </div>
                        <button class="button-default">@lang('ori_event_button_sign_up')</button>

                        <input type="hidden" name="type" value="0" />
                        <input type="hidden" name="user_id" value="{{ $__auth->id ?? 0 }}" />
                        <input type="hidden" name="event_page" value="1" />
                        <input type="hidden" name="form_id" value="9" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div tabindex="-1" class="modal fade modal-default modal-subscribe-success jsModalSubscribeSuccess">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal__title jsModalSubscribeSuccessMessage">
                    @lang('ori_event_subscribe_success')
                </div>
            </div>
        </div>
    </div>
</div>