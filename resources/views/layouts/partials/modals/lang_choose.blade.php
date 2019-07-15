<div tabindex="-1" class="modal fade modal-default modal-lang modal-lang-confirm jsModalCountryConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <a data-dismiss="modal" class="modal__close"></a>
            <div class="modal-lang__title2">
                <p><span>@lang('ori_your-country')</span><strong>@lang(config('lang.countries.' . explode('-', $__locale->code)[0] . '.key'))</strong></p>
                <div>
                    <a class="jsModalCountryConfirmListToggle" href="#">@lang('ori_make_3_pay_text_change')</a>
                    <ul>
                        @foreach(config('lang.countries') as $code => $country)
                            @if (!isset($available) || in_array($code, $available))
                                <li><a href="//{{ getLocaleLink($code, $country) }}?country_settled=true" {!! $country['modal'] ? ' data-toggle="modal" data-target=".jsModalLang-' . $code . '" onclick="$(\'.jsModalCountryConfirm\').modal(\'hide\'); return false;" ' : '' !!}><i></i><span>@lang($country['key'])</span></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-lang__buttons modal-lang__buttons2">
                <a href="#" class="active" data-toggle="modal" data-target=".jsModalCountryConfirm">@lang('ori_mine_window_delete_button_ok')</a>
            </div>
        </div>
    </div>
</div>