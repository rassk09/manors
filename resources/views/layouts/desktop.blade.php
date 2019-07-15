<!DOCTYPE html>
<html lang="{{ $__locale->code }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oriflame</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    @if (isset($og))
        <meta property="og:title" content="{!!  $og['title'] !!}">
        <meta property="og:description" content="{!! $og['description'] !!}">
        <meta property="og:image" content="{!! $og['image'] !!}">
    @elseif(in_array($__route->getName(), ['tests', 'tests_inner']))
        <meta property="og:title" content="@lang('og_tests_share_title')">
        <meta property="og:description" content="@lang('og_tests_share_text')">
        <meta property="og:image" content="@lang('og_tests_share_image')">
    @elseif(strpos($__route->getName(), 'map') === 0)
        <meta property="og:title" content="@lang('og_map_share_title')">
        <meta property="og:description" content="@lang('og_map_share_text')">
        <meta property="og:image" content="@lang('og_map_share_image')">
    @endif

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oranienbaum|PT+Serif|Roboto&amp;subset=cyrillic" rel="stylesheet">
    <style>@font-face{font-family:"Gill Sans for Oriflame";font-weight:300;src:url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Light.woff?v16084828b20) format('woff'),url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Light.ttf?v16084828b20) format('truetype')}@font-face{font-family:"Gill Sans for Oriflame";font-weight:300;font-style:italic;src:url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_LightItalic.woff?v16126fb8fa0) format('woff'),url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_LightItalic.ttf?v15ea6d0dee0) format('truetype')}@font-face{font-family:"Gill Sans for Oriflame";font-weight:400;src:url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Regular.woff?v16084828350) format('woff'),url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Regular.ttf?v16084828350) format('truetype')}@font-face{font-family:"Gill Sans for Oriflame";font-weight:700;src:url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Bold.woff?v16084828350) format('woff'),url(/fonts/GillSans_for_Oriflame/GillSans_for_Oriflame_Bold.ttf?v16084828350) format('truetype')}@font-face{font-family:"Oriflame Sans";font-weight:400;src:url(/fonts/Oriflame_Sans/OriflameSans-Regular.woff?v160addd6d50) format('woff'),url(/fonts/Oriflame_Sans/OriflameSans-Regular.ttf?v160addd6d50) format('truetype')}@font-face{font-family:"Oriflame Sans";font-weight:700;src:url(/fonts/Oriflame_Sans/OriflameSans-Bold.woff?v160addd6d50) format('woff'),url(/fonts/Oriflame_Sans/OriflameSans-Bold.ttf?v160addd6d50) format('truetype')}@font-face{font-family:'Garamond for Oriflame';src:url(/fonts/Garmond/Garamond-BoldItalic.woff?v16134433050) format('woff'),url(/fonts/Garmond/Garamond-BoldItalic.ttf?v16134432880) format('truetype');font-weight:700;font-style:italic}@font-face{font-family:'Garamond for Oriflame';src:url(/fonts/Garmond/GaramondforOriflame-Italic.woff?v16134436700) format('woff'),url(/fonts/Garmond/GaramondforOriflame-Italic.ttf?v16134436700) format('truetype');font-weight:400;font-style:italic}</style>

    <link href="/bundles/css/desktop.min.css?v=a603eeac718f417ea63b3f3f0a5ebb40" rel="stylesheet">

    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(
            j,f);
        })(window,document,'script','dataLayer','{!! config('lifestyle.ga_counter') !!}');
    </script>
</head>
<body class="{!! isset($body_class) ? $body_class : '' !!}">
<!– Google Tag Manager (noscript) –>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?{!! config('lifestyle.ga_counter') !!}"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!– End Google Tag Manager (noscript) –>

@yield('content')

@include('layouts.partials.modals')

{{--<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>--}}
{{--<script src="//yastatic.net/share2/share.js"></script>--}}
{{--<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki" style="display: none"></div>--}}

<script src="/bundles/webpack/vendor.bundle.js?v=05d0e4ee12db6c702a101521d958c8d2"></script>
<script src="/bundles/webpack/desktop.bundle.js?v=c9c069b925f1d734fcd9166ed52fd1fd"></script>
<script src="/bundles/webpack/scripts.bundle.js?v=e6e73cea0f48ece56c40480f71b83442"></script>

<script src="/js/lifestyle.menu.common.js?v=d6e0781011b336794b84f09ffd1d422d"></script>
<script>
    var __g_locale = '{!! $__locale->code !!}';
    var __g_domain = '{{ locale_route('home') }}';
    initHubMenu();
</script>

{{--<script src="/js/scripts.js?v=92f72b1a3935cc59e00d0fa3a2419b16"></script>--}}
{{--<script src="/js/device.js?v=1783fbc2c993143285825e402cc49c95"></script>--}}
{{--<script src="/js/share.js?v=7b55a3816142e4f4f400682ee91aa9f6"></script>--}}
{{--<script src="/js/gtm.js?v=65bc3055e906e1084de2a46e04f24a0d"></script>--}}

@yield('js')

@if (request()->has('error'))
    <script>
        $('.jsModalError').modal('show');
    </script>
@endif

@if (request()->has('success'))
    <script>
        $('.jsModalErrorMessage').html('Файл успешно загружен'); // TODO: !!!TRANSLATION!!!
        $('.jsModalError').modal('show');
    </script>
@endif

@if($__show_locale_popup == 1)
    <script>
        $('.jsModalCountryConfirm').modal('show');
        $.post('{{ locale_route('locale_chosen') }}');
    </script>
@endif


</body>
</html>



