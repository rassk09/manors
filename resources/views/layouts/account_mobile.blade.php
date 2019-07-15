@extends('layouts.mobile')

@section('content')
    <div class="lk" data-page="lk">
        <div class="lk__inner">
            <div class="lk__header">
                <header class="header-mobile">
                    <div class="header-mobile__inner">
                        <div class="header-mobile__item">
                            <a href="{{ locale_route('map_main') }}" class="header-mobile__logo"></a>
                        </div>
                        <div class="header-mobile__item">
                            <a href="#" class="header-mobile__nav jsMobileNavLkToggle"></a>
                        </div>
                        <div class="header-mobile__item center"></div>
                        <div class="header-mobile__item">
                            <a href="{{ locale_route('map_main') }}" class="header-mobile__view"></a>
                        </div>
                        <div class="header-mobile__item">
                            <a href="{{ locale_route('logout') }}" class="header-mobile__exit"></a>
                        </div>
                    </div>
                </header>
                <nav class="nav-mobile nav-mobile_lk jsMobileNavLk">
                    <div class="nav-mobile__bg">
                        <div class="nav-mobile__inner">
                            <ul>
                                <li>
                                    <a class="nav-mobile__events" href="{{ locale_route('account_events') }}">
                                    <i></i><span>@lang('ori_button_mine')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-mobile__favorite" href="{{ locale_route('account_favorites') }}">
                                        <i></i><span>@lang('ori_button_chosen')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-mobile__users" href="{{ locale_route('account_members') }}">
                                        <i></i><span>@lang('ori_button_participants')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-mobile__lk" href="{{ locale_route('account_settings') }}">
                                        <i></i><span>@lang('ori_personal-data')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-mobile__doc" href="{{ locale_route('account_documents') }}">
                                        <i></i><span>@lang('ori_documentation')</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="lk__content">
                @yield('account_content')
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

@endsection