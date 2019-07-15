<div data-step-event="1" class="event-create__step jsEventFormStage active">
    <div class="event-create__form">
        <div class="form__group">
            <div class="form__input event-create__input error">
                <input type="text" name="contacts_person" placeholder="@lang('ori_form-fullname_placeholder')" value="{{$__auth->getFullName()}}" data-required />
            </div>
            <div class="form__label">
                @lang('ori_make_text_name')
            </div>
        </div>
        <div class="form__group">
            <div class="form__input event-create__input error">
                <input type="text" name="contacts_phone" placeholder="+7 (___) ___-__-__" value="{{$__auth->phone}}" data-required /> {{-- TODO: !!!TRANSLATION!!! (PLACEHOLDER) --}}
            </div>
            <div class="form__label">@lang('ori_make_text_mobile')</div>
        </div>
        <div class="form__group">
            <div class="form__input event-create__input error">
                <input type="email" name="contacts_email" placeholder="example@mail.ru" value="{{$__auth->email}}" data-required /> {{-- TODO: !!!TRANSLATION!!! (PLACEHOLDER) --}}
            </div>
            <div class="form__label">@lang('ori_make_text_mail')</div>
        </div>
    </div>
</div>