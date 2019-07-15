<div data-step-event="4" class="event-create__step jsEventFormStage {{ (isset($modal) && $modal) || (isset($mobileEdit) && $mobileEdit) ? ' active ' : '' }}">
    <div class="event-create__date">
        <div class="hint hint_form jsHint" data-cookie="hint-3days">
            <a href="#" class="hint__close jsHintClose"></a>
            <div class="hint__content">@lang('ori_makedone_text_left_2_frame')</div>
        </div>
        <div class="form__group">
            @if (isset($mobileEdit) && $mobileEdit)
                <br/>
            @endif
            <div class="event-create__label">@lang('ori_changeplace_text_date_start')</div>
            <div class="event-create__inline-new">
                @if ($__isMobile && isset($event) && $event)
                    <span>@lang('ori_from')</span>
                    <div class="form__input">
                        <label class="date" for="date_full">{!! date('Y-m-d', strtotime($event->date_start)) !!}</label>
                        <input type="date" name="event_date_start" id="date_full" value="{!! date('Y-m-d', strtotime($event->date_start)) !!}" />
                    </div>
                    <span>@lang('ori_in')</span>
                    <div class="form__input">
                        <label class="time" for="time_full">{!! date('H:i', strtotime($event->date_start)) !!}</label>
                        <input type="time" name="event_time_start" id="time_full" value="{!! date('H:i', strtotime($event->date_start)) !!}" />
                    </div>
                @else
                    <span>@lang('ori_from')</span>
                    <div class="form__input">
                        @if($__isMobile)
                            <label class="date" for="date_full">{!! mb_strtolower(join('.', [__k('ori_day_placeholder'), __k('ori_month_placeholder'), __k('ori_year_placeholder')])) !!}</label>
                            <input type="date" name="date_start" id="date_full" value="" />
                        @else
                            <input type="text" class="date jsDatepicker" name="date_start" id="date_full" value="" placeholder="{!! mb_strtolower(join('.', [__k('ori_day_placeholder'), __k('ori_month_placeholder'), __k('ori_year_placeholder')])) !!}" />
                        @endif
                    </div>
                    <span>@lang('ori_in')</span>
                    <div class="form__input">
                        @if($__isMobile)
                            <label class="time" for="time_full">@lang('ori_time_placeholder')</label>
                            <input type="time" name="time_start" id="time_full" />
                        @else
                            <input type="text" class="time jsTimepicker" name="time_start" id="time_full" placeholder="@lang('ori_time_placeholder')" />
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="form__group">
            <div class="event-create__label">@lang('ori_changeplace_text_date_end')</div>
            <div class="event-create__inline-new">
                @if ($__isMobile && isset($event) && $event)
                    <span>@lang('ori_from')</span>
                    <div class="form__input">
                        <label class="date" for="date_full_end">{!! date('Y-m-d', strtotime($event->date_end)) !!}</label>
                        <input type="date" name="event_date_end" id="date_full_end" value="{!! date('Y-m-d', strtotime($event->date_end)) !!}" />
                    </div>
                    <span>@lang('ori_in')</span>
                    <div class="form__input">
                        <label class="time" for="time_full_end">{!! date('H:i', strtotime($event->date_end)) !!}</label>
                        <input type="time" name="event_time_end" id="time_full_end" value="{!! date('H:i', strtotime($event->date_end)) !!}" />
                    </div>
                @else
                    <span>@lang('ori_from')</span>
                    <div class="form__input">
                        @if($__isMobile)
                            <label class="date" for="date_full_end">{!! mb_strtolower(join('.', [__k('ori_day_placeholder'), __k('ori_month_placeholder'), __k('ori_year_placeholder')])) !!}</label>
                            <input type="date" name="date_end" id="date_full_end" value="" />
                        @else
                            <input type="text" class="date jsDatepicker" name="date_end" id="date_full_end" value="" placeholder="{!! mb_strtolower(join('.', [__k('ori_day_placeholder'), __k('ori_month_placeholder'), __k('ori_year_placeholder')])) !!}" />
                        @endif
                    </div>
                    <span>@lang('ori_in')</span>
                    <div class="form__input">
                        @if($__isMobile)
                            <label class="time" for="time_full_end">@lang('ori_time_placeholder')</label>
                            <input type="time" name="time_end" id="time_full_end" />
                        @else
                            <input type="text" class="time jsTimepicker" name="time_end" id="time_full_end" placeholder="@lang('ori_time_placeholder')" />
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (isset($mobileEdit) && $mobileEdit)
        <div class="event-create-price__title">@lang('ori_location-event')</div>
    @endif

    <div class="event-create__form">
        <div class="form__group">
            <div class="select-form">
                <select name="country_id" class="country_select" placeholder="@lang('ori_LK_text_country')" data-action="{{ action('Api\MapController@getCities') }}">
                    @foreach($__all_countries as $country)
                        <option value="{{ $country->id }}" {{$country->id == $__auth->country_id ? ' selected ' : ''}}>{{ $country->lang('name') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__label">@lang('ori_make_4_text_country')</div>
        </div>
        <div class="form__group">
            <div class="select-form">
                <select name="city_id" class="city_select" placeholder="@lang('ori_LK_text_city')">
                    @foreach($__cities as $city)
                        <option value="{{ $city->id }}" {{$city->id == $__auth->city_id ? ' selected ' : '' }}>
                            {{ $city->getLocaleName($__locale) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form__label">
                @lang('ori_make_4_text_city')
            </div>
        </div>
        <div class="form__group">
            <div class="event-create__inline address">
                <div class="event-create__inline-item street">
                    <div class="form__input event-create__input inline">
                        <input class="no-redesign" type="text" name="address_street" placeholder="Улица" data-required>
                    </div>
                    <div class="form__label">Введи улицу</div> {{-- TODO: !!!TRANSLATION!!! --}}
                </div>
                <div class="event-create__inline-item house">
                    <div class="form__input event-create__input inline">
                        <input class="no-redesign" type="text" name="address_house" placeholder="Дом" data-required>
                    </div>
                    <div class="form__label">Введи номер дома</div> {{-- TODO: !!!TRANSLATION!!! --}}
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__input event-create__input error">
                <input type="text" name="address_comment"/>
            </div>
            <div class="form__label">
                @lang('ori_make_4_text_comment')
            </div>
        </div>
    </div>
</div>