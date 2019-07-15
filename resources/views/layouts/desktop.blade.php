<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1440, initial-scale=1">
    <title>Усадебное достояние</title>

    {{--<meta property="og:url" content="{{ url()->current() }}">--}}
    {{--<meta property="og:type" content="website">--}}

    {{--@if (isset($og))--}}
        {{--<meta property="og:title" content="{!!  $og['title'] !!}">--}}
        {{--<meta property="og:description" content="{!! $og['description'] !!}">--}}
        {{--<meta property="og:image" content="{!! $og['image'] !!}">--}}
    {{--@elseif(in_array($__route->getName(), ['tests', 'tests_inner']))--}}
        {{--<meta property="og:title" content="@lang('og_tests_share_title')">--}}
        {{--<meta property="og:description" content="@lang('og_tests_share_text')">--}}
        {{--<meta property="og:image" content="@lang('og_tests_share_image')">--}}
    {{--@elseif(strpos($__route->getName(), 'map') === 0)--}}
        {{--<meta property="og:title" content="@lang('og_map_share_title')">--}}
        {{--<meta property="og:description" content="@lang('og_map_share_text')">--}}
        {{--<meta property="og:image" content="@lang('og_map_share_image')">--}}
    {{--@endif--}}

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="/bundles/css/desktop.min.css" rel="stylesheet">

    @if ($__route->getName() == 'home')
        <link href="/node_modules/onepage-scroll-master/onepage-scroll.css" rel="stylesheet">
    @endif


</head>
<body class="{!! $__route->getName() == 'home' ? 'home_page' : '' !!}">
<header>
    <ul class="menu">
        <li><a href="{{ route('home') }}">главная</a></li>
        <li><a href="{{ route('home') }}#about">о проекте</a></li>
        <li><a href="{{ route('map', ['type' => 0]) }}">заброшенные усадьбы</a></li>
        <li><a href="{{ route('map', ['type' => 1]) }}">возрожденные усадьбы</a></li>
        {{--<li><a href="#">приватизация усадеб</a></li>--}}
        {{--<li><a href="#">контакты</a></li>--}}
        <li class="chosen"><a href="{{ route('favorites') }}" {!! count($__favorites) > 0 ? ' class="active" ' : ''  !!}>избранное</a></li>
    </ul>
</header>

@yield('content')

<script src="/bundles/webpack/vendor.bundle.js"></script>
<script src="/bundles/webpack/desktop.bundle.js"></script>

@yield('js')

</body>
</html>


