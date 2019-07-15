<div data-step-event="2" class="event-create__step jsEventFormStage {{ (isset($modal) && $modal) || (isset($mobileEdit) && $mobileEdit) ? ' active ' : '' }}" data-action="{{ locale_route('api_getEventFormatsInfo') }}" data-locale-id="{{ $__locale->id }}">
    <div class="event-create-type__title">@lang('ori_event_format')</div>
    <div class="event-create-type">
        <div class="event-create-type__head">
            <ul class="jsEventFormType clearfix" data-content="event_formats"></ul>
            <input type="hidden" name="event_format_id"/>
        </div>
        <div class="event-create-type__body">
            <div class="event-create-type__item jsEventFormTypeItem">
                <!-- Event Type -->
                <div class="event-create__form">
                    <div class="form__group">
                        <div class="select-form" data-content="event_types">
                            <select class="event_type" name="event_type_id" ></select>
                        </div>
                        <div class="form__label">
                            @lang('ori_choose_event_type')
                        </div>
                    </div>
                </div>

                @if (isset($mobileEdit) && $mobileEdit)
                    <div class="form__group form__group_name-event">
                        <div class="event-create-type__title">@lang('ori_participantstab_name')</div>
                        <div class="form__input event-create__input error">
                            <input type="text" name="name" placeholder="Oriflame Wellness Club " maxlength="60" size="60" data-required>
                        </div>
                    </div>
                @endif

                <!-- Event Description -->
                <div class="event-create-type__desc-title">
                    @lang('ori_description')
                </div>
                <div class="form__group readonly">
                    <div class="form__input event-create__input error">
                        @if(!$__isMobile)
                            <div class="form__edit"><a href="#" class="lk-edit desc jsEventFormDescEdit"></a></div>
                        @endif
                        <textarea name="description" cols="30" rows="10" readonly data-content="event_description"></textarea>
                        @if($__isMobile)
                            <div class="form__edit"><a href="#" class="lk-edit desc jsEventFormDescEdit">Редактировать</a></div>
                        @endif
                    </div>
                </div>

                <!-- Event USP -->
                <div class="event-create-type__desc-title">
                    Включи в описание актуальные пункты (они отобразятся в описании твоего мероприятия) {{-- TODO: !!!TRANSLATION!!! --}}
                </div>
                <div class="{{ !$__isMobile ? 'form__group' : '' }} form__group_page">
                    <div class="event-create-type__desc_bold">@lang('ori_here_you_will_know')</div>
                    <div class="checkbox-form">
                        <div data-content="event_usps"></div>
                        <div class="checkbox-form__input_textarea jsEventTextarea">
                            <label>@lang('ori_your_option'):</label>
                            <textarea maxlength="100"></textarea>
                            <span class="textarea-to-checkbox jsEventCheckboxAdd">@lang('ori_add')</span>
                        </div>
                        <div class="checkbox-form__add-input jsEventTextareaAdd">
                            <span>@lang('ori_add_another_option')</span>
                        </div>
                    </div>
                </div>

                <!-- Documents Link -->
                <div class="event-create-type__files event-create-type__files_redesign">
                    <span class="event-create-type__files-title">
                        @lang('ori_necessary_materials_place')
                        <a target="_blank" href="{{ locale_route('account_documents') }}">@lang('ori_documentation')</a>
                    </span>
                    <a href="#" class="button-default button-default_files" style="text-decoration: none;" data-content="event_type_documents_download" >
                        @lang('ori_download_materials')
                    </a>
                </div>

                <!-- Image Covers -->
                <div class="event-create-type__slider jsSliderEventCover">
                    <div data-content="image"></div>
                    <button class="swiper-prev swiper-button-disabled"></button>
                    <button class="swiper-next swiper-button-disabled"></button>
                    <input type="hidden" name="image" />
                </div>
                <div class="form__label">
                    @lang('ori_make_2_text_cover')
                </div>
            </div>
        </div>

        @if($__locale->is_master)
            <div class="event-create-type__foot">
                <div class="checkbox-form">
                    <div class="checkbox-form__input">
                        <input type="hidden" name="event_spo_id" value="0"/>
                        <input type="checkbox" id="event_spo_id" name="event_spo_id" value="1">
                        @if ($__isMobile)
                            <label>
                                это мероприятие проводится Бьюти центром Oriflame
                                <span class="checkbox-hint">
                                <span class="checkbox-hint__toggle">?</span>
                                    <span class="checkbox-hint__popover">
                                        <ol>
                                            @foreach($event_spos as $event_spo)
                                                <li>{!! $event_spo->address !!}</li>
                                            @endforeach
                                        </ol>
                                    </span>
                                </span>
                            </label>
                        @else
                            <label for="event_spo_id">это мероприятие проводится Бьюти центром Oriflame</label>
                            <span class="checkbox-hint">
                                <span class="checkbox-hint__toggle">?</span>
                                <span class="checkbox-hint__popover">
                                    <ol>
                                        @foreach($event_spos as $event_spo)
                                            <li>{!! $event_spo->address !!}</li>
                                        @endforeach
                                    </ol>
                                </span>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>