<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <span class="letter letter-{!! strtoupper(mb_substr(\Auth::user()->email, 0, 1)) !!}">{!! mb_substr(\Auth::user()->email, 0, 1) !!}</span>
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        {{ \Auth::user()->email }}
                        <small>{{ \Auth::user()->getType() }}</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    {{--<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Изменить профиль</a></li>--}}
                    <li><a href="/" target="_blank"><i class="fa fa-external-link-alt"></i> Перейти на сайт</a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out-alt"></i> Выход</a></li>
                </ul>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            @foreach(config('admin.sidebar') as $sidebar)
                @if (!isset($sidebar['role']) || in_array(\Auth::user()->role, $sidebar['role']))
                    @php($active = adminIsActiveMenuItem($sidebar))
                    <li class="{!! isset($sidebar['items']) ? ' has-sub ' : '' !!} {!! $active ? ' active ' : '' !!}">
                        <a href="{!! adminGetSidebarLink($sidebar) !!}">
                            @if (isset($sidebar['items']))
                                <b class="caret"></b>
                            @endif
                            <i class="{!! $sidebar['icon'] !!}"></i>
                            <span>
                                {!! $sidebar['title'] !!}
                                {!! adminGetBadge($sidebar['badge'] ?? null) !!}
                            </span>
                        </a>
                        @if (isset($sidebar['items']))
                            @include('admin.layouts.partials.sidebar_submenu', ['items' => $sidebar['items']])
                        @endif
                    </li>
                @endif
            @endforeach
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->