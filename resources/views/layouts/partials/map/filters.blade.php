<div class="filter-extended__body">
    <div class="filter-extended__list">
        <ul>
            <li><strong>@lang('ori_date_filter'):</strong></li>
            <li>
                <div class="filter-date">
                    <div class="filter-date__text">@lang('ori_from')</div>
                    <div class="filter-date__input">
                        <input value="{{ request()->get('date_from') }}" name="date_from" type="text" class="jsDatepicker jsDatepickerStart" data-date-format="dd.mm.yyyy">
                    </div>
                </div>
            </li>
            <li>
                <div class="filter-date">
                    <div class="filter-date__text">@lang('ori_until')</div>
                    <div class="filter-date__input">
                        <input value="{{ request()->get('date_to') }}" name="date_to" type="text" class="jsDatepicker jsDatepickerEnd" data-date-format="dd.mm.yyyy">
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="filter-extended__list">
        <ul>
            <li><strong>@lang('ori_map_filter_text_status'):</strong></li>
            @foreach($statuses as $status_id => $status)
                <li>
                    <label>
                        <input class="jsFilterStatusRadioButton" {{ (($loop->first && !request()->has('status')) || isset(request()->get('status')[$status_id])) ? 'checked' : '' }} name="status[{{ $status_id }}]" type="checkbox" value="1">
                        <span>{{ $status }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="filter-extended__list">
        <ul>
            <li><strong>@lang('ori_event_format'):</strong></li>
            @foreach($event_formats as $event_format)
                <li>
                    <label>
                        <input class="__gFilterFormatRadioButton" {{ isset(request()->get('format')[$event_format->id]) ? 'checked' : '' }}
                            name="format[{{ $event_format->id }}]" type="checkbox" value="1">
                        <span class="{{ $event_format->getCSSClass() }}">{{ $event_format->lang('name') }}</span>
                    </label>
                </li>
            @endforeach

            @if ($__locale->is_master)
                <li>
                    <label>
                        <input class="__gFilterFormatRadioButton" {{ request()->get('spo') || $__route->getName() == 'map_events_spo' ? 'checked' : '' }}
                            name="spo" type="checkbox" value="1">
                        <span>Бьюти центры Oriflame</span>
                    </label>
                </li>
            @endif
        </ul>
    </div>
</div>

@if($__route->getName() == 'map_favorites')
    <input type="hidden" id="favorites" name="favorites" value="1">
@endif