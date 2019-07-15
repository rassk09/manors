@if ($__current_country && $__current_country->cities->count())
    <select style="display:none;" name="city" placeholder="@lang('ori_city-name_placeholder')" data-map="1">
        <option value="all" {{ (!request()->has('city') || request()->get('city') == "all") ? ' selected ' : '' }}>@lang('ori_map_filter_all_city')</option>
        @foreach($__current_country->cities as $city)
            <option value="{{$city->id}}" {{ $__current_city_id == $city->id ? ' selected ' : ''}}>
                {{ $city->getLocaleName($__locale) }}
            </option>
        @endforeach
    </select>
@endif