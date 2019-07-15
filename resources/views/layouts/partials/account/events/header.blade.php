<div class="lk-head__item">
    <div class="lk-title lk-head__title">@lang('ori_button_mine1')</div>
    <div class="button-group lk-head__buttons">
        <div class="hint hint_button hint_button-active jsHint" data-cookie="hint-events-active">
            <a href="#" class="hint__close jsHintClose"></a>
            <div class="hint__content">
                <p>@lang('ori_mine_help_actual-1')</p>
                <p>@lang('ori_mine_help_actual-2')</p>
            </div>
        </div>
        <a href="{{ locale_route('account_events') }}" class="__gLkSwitchActual {{ in_array($__route->getName(), ['account_events', 'ru_account_events']) ? ' active ' : '' }}">
            @lang('ori_map_filter_status_actual')
        </a><a href="{{ locale_route('account_events_archive')  }}" class="__gLkSwitchPast {{ in_array($__route->getName(), ['account_events_archive', 'ru_account_events_archive']) ? ' active ' : '' }}">
            @lang('ori_map_filter_status_ended')
        </a>
    </div>

</div>