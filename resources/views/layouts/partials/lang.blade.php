<div class="lang {!! isset($class) ? $class : '' !!} jsLang">
    <div class="lang__toggle {{ explode('-', $__locale->code)[0] }}">
        <i class="jsLangToggle"></i>
        <span class="jsLangToggle">@lang($__locale->getTranslation())</span>
    </div>
    <div class="lang__list">
        <ul>
            @foreach(config('lang.countries') as $code => $country)
                @if (!isset($available) || in_array($code, $available))
                    <li class="{{ $code }}"><a href="//{{ getLocaleLink($code, $country) }}?country_settled=true" {!! $country['modal'] ? ' data-toggle="modal" data-target=".jsModalLang-' . $code . '" ' : '' !!}><i></i><span>@lang($country['key'])</span></a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>