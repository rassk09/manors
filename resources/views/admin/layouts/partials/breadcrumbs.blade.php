@if (\Auth::user()->isRole('admin'))
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Главная</a></li>
        @php($breadcrumbs = array_reverse(adminGetBreadcrumbs(config('admin.sidebar'), $module_name)))
        @foreach($breadcrumbs as $key => $item)
            <li class="breadcrumb-item {!! !next($breadcrumbs) ? ' active ' : '' !!}">
                @if(next($breadcrumbs))
                    <a href="javascript:;">
                        {{$item}}
                    </a>
                @else
                    {{$item}}
                @endif
            </li>
        @endforeach
    </ol>
    <!-- end breadcrumb -->
@endif