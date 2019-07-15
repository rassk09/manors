<ul class="sub-menu">
    @foreach($items as $sidebar)
        @if (!isset($sidebar['role']) || in_array(\Auth::user()->role, $sidebar['role']))
            @php($active = adminIsActiveMenuItem($sidebar))
            <li class="{!! isset($sidebar['items']) ? ' has-sub ' : '' !!} {!! $active ? ' active ' : '' !!}">
                <a href="{!! adminGetSidebarLink($sidebar) !!}">
                    @if (isset($sidebar['items']))
                        <b class="caret pull-right"></b>
                    @endif
                    {!! $sidebar['title'] !!}
                    {!! adminGetBadge($sidebar['badge'] ?? null) !!}
                </a>
                @if (isset($sidebar['items']))
                    @include('admin.layouts.partials.sidebar_submenu', ['items' => $sidebar['items']])
                @endif
            </li>
        @endif
    @endforeach
</ul>