<header class="header-inside">
    <div class="header-inside__inner">
        <div class="header-inside__inner">
            @if(!isset($hideSelects))
                <div class="header-inside__select country">
                    <div class="select-dark">
                        @include('layouts.partials.map.select_countries')
                    </div>
                </div>
                <div class="header-inside__select city">
                    <div class="select-dark">
                        @include('layouts.partials.map.select_cities')
                    </div>
                </div>
            @endif

            <a href="{{ locale_route(($__auth ? 'account' : 'map') . '_favorites') }}" class="header-inside__button __gFavorite {{ ($__route->getName() == 'map_favorites' ? ' active ' : '') }}">
                <i class="favorite"></i><span>@lang('ori_map_button_chosen')</span>
            </a>
            <a href="{{ locale_route('account_events') }}" class="header-inside__button __gLk">
                <i class="lk"></i><span>@lang('ori_button_LK')</span>
            </a>
        </div>
    </div>
</header>