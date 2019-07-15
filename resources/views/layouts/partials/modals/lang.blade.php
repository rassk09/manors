@foreach(config('lang.countries') as $code => $country)
    @if ($country['modal'])
        <div tabindex="-1" class="modal fade modal-default modal-lang jsModalLang-{{ $code }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <a data-dismiss="modal" class="modal__close"></a>
                    <div class="modal-lang__title">@lang('ori_select-language')</div>
                    <div class="modal-lang__buttons">
                        @foreach($country['languages'] as $key => $language)
                            <a href="//{{ getLocaleLink($code, $country, $key) }}?country_settled=true">@lang($language['key'])</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach