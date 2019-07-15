<div tabindex="-1" class="modal fade modal-default jsModalLogin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal-event__inner">
                    <form id="login_form" class="event-create__form jsAuthForm">
                        <div class="form__group">
                            <div class="select-form select-lang">
                                <select name="login_country">
                                    @foreach(config('lifestyle.map.available_countries') as $country)
                                        <option value="{{ $country }}" {{ strpos($__locale->code, $country) === 0 ? ' selected ' : '' }}>@lang(config('lang.countries.' . $country . '.key'))</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form__label">@lang('ori_changeplace_text_country')</div>
                        </div>
                        <div class="form__group">
                            <div class="form__input error">
                                <input type="text" name="login" required placeholder="@lang('ori_chosen_enter_text_consultant')">
                            </div>
                            <div class="form__label">@lang('ori_chosen_enter_text_number')</div>
                        </div>
                        <div class="form__group">
                            <div class="form__input error">
                                <input type="password" name="password" required="" placeholder="●●●●●●">
                                <div class="error" id="login_form_error"></div>
                            </div>
                            <div class="form__label">@lang('ori_chosen_enter_text_password')</div>
                        </div>
                        <div class="form__checkbox">
                            <div class="checkbox error">
                                <input name="login_personal" type="checkbox" checked required id="login_agree">
                                {{--<div class="error"></div>--}}
                                <label for="agree_popup">@lang('ori_chosen_enter_text_agree-new')</label>
                            </div>
                        </div>
                        @if (in_array($__locale->code, ['ru-RU', 'by-BY', 'kz-KZ', 'kz-RU', 'kg-RU']))
                            <div class="form__checkbox">
                                <div class="checkbox ">
                                    <input name="subscribe" type="checkbox" checked value="1" id="subscribe_popup">
                                    <label for="subscribe_popup">@lang('ori_chosen_enter_text_news-new')</label>
                                </div>
                            </div>
                        @endif
                        <div class="modal-event__foot">
                            <div class="form__button">
                                <button class="button-default">@lang('ori_login')</button>
                                <input type="hidden" name="locale_id" value="{{$__locale->id}}" />
                            </div>
                            <div class="lk-auth__link">
                                <a target="_blank" href="@lang('ori_login_registration_link')">@lang('ori_login_registration')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>