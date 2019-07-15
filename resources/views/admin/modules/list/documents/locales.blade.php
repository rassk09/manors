@php
    $arr_locales = [];
    $locales = $item->getAvailableLocales();
    foreach($locales as $locale) {
        $arr_locales[] = $locale->code;
    }
@endphp
{!! join(', ', $arr_locales) !!}
