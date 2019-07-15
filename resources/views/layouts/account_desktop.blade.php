@extends('layouts.desktop')

@section('content')
    <div class="lk" data-page="lk">
        <div class="lk__inner">
            <div class="lk__header">
                <header class="header-lk">
                    <div class="header-lk__logo">
                        <a href="{{ locale_route('map_main') }}" target="_blank" class="logo"></a>
                    </div>
                    <div class="header-lk__inner">
                        <div class="header-lk__user">
                            @lang('ori_chosen_text_hello') <strong>{{$__auth->name}} {{$__auth->last_name}}</strong>
                        </div>
                        <a href="{{ locale_route('logout') }}" class="header-lk__exit">
                            <span>@lang('ori_logout')</span><i></i>
                        </a>
                    </div>
                </header>
            </div>
            <div class="lk__sidebar">
                <section class="sidebar">
                    <div class="sidebar__inner">
                        <ul class="sidebar__list">
                            <li class="sidebar__item {{ strpos($__route->getName(), 'account_events') === 0 ? ' active ' : '' }}">
                                <a href="{{ locale_route('account_events') }}" class="sidebar__link __gSidebarEvents">
                                    <span class="sidebar__icon event"></span>
                                    <span class="sidebar__text">@lang('ori_button_mine')</span>
                                </a>
                            </li>
                            <li class="sidebar__item {{ strpos($__route->getName(), 'account_favorites') === 0 ? ' active ' : '' }}">
                                <a href="{{ locale_route('account_favorites') }}" class="sidebar__link __gSidebarFavorites">
                                    <span class="sidebar__icon favorite"></span>
                                    <span class="sidebar__text">@lang('ori_map_button_chosen')</span>
                                </a>
                            </li>
                            <li class="sidebar__item {{ strpos($__route->getName(), 'account_members') === 0 ? ' active ' : '' }}">
                                <a href="{{ locale_route('account_members') }}" class="sidebar__link __gSidebarParticipants">
                                    <span class="sidebar__icon member"></span>
                                    <span class="sidebar__text">@lang('ori_button_participants')</span>
                                </a>
                            </li>
                            <li class="sidebar__item {{ strpos($__route->getName(), 'account_settings') === 0 ? ' active ' : '' }}">
                                <a href="{{ locale_route('account_settings') }}" class="sidebar__link __gSidebarPersonal">
                                    <span class="sidebar__icon lk"></span>
                                    <span class="sidebar__text">@lang('ori_personal-data')</span>
                                </a>
                            </li>
                            <li class="sidebar__item {{ strpos($__route->getName(), 'account_documents') === 0 ? ' active ' : '' }}">
                                <a href="{{ locale_route('account_documents') }}" class="sidebar__link __gSidebarDoc">
                                    <span class="sidebar__icon doc"></span>
                                    <span class="sidebar__text">@lang('ori_documentation')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="lk__content">
                @yield('account_content')
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

@endsection