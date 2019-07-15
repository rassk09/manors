<div data-step-event="3" class="event-create__step jsEventFormStage {{ (isset($modal) && $modal) || (isset($mobileEdit) && $mobileEdit) ? ' active ' : '' }}">
    <div class="event-create__form">
        @if (!isset($mobileEdit) || !$mobileEdit)
            <div class="form__group">
                <div class="form__input event-create__input error">
                    <input type="text" name="name" placeholder="Oriflame Wellness Club " maxlength="60" size="60" data-required>
                </div>
                <div class="form__label">
                    @lang('ori_make_3_text_name')
                </div>
            </div>
        @endif
        <div class="event-create-price">
            <input type="hidden" name="price_type" value="0" />
            <div class="event-create-price__title">@lang('ori_make_3_text_form')</div>
            <div class="event-create-price__body">
                <div class="event-create-price__item">
                    <a href="#" class="event-create-price__link jsEventPriceToggle" data-price-type="1">
                        <i class="money"></i>
                        <span>@lang('ori_map_text_pay')</span>
                    </a>
                </div>
                <div class="event-create-price__item active">
                    <a href="#" class="event-create-price__link jsEventPriceToggle" data-price-type="0">
                        <i class="free"></i>
                        <span>@lang('ori_map_text_free')</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>