@if ($__all_countries && $__all_countries->count())
    <select style="display:none;" name="country" placeholder="@lang('ori_country-name_placeholder')" data-events="1" data-action="{{ action('Api\MapController@getCities') }}">
        @foreach($__all_countries as $country)
            <option value="{{ $country->id }}" {{ $__current_country->id == $country->id ? ' selected ' : '' }}>{{ $country->lang('name') }}</option>
        @endforeach
    </select>
@endif
