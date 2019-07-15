<p>@lang($title_key)</p>
<ul class="social" data-url="{{ locale_route('tests_inner', ['id' => $test->id]) }}">
    @if(in_array($__locale->code, config('lifestyle.tests.share_locales')))
        <li><a class="vk" href="#">VKONTAKTE</a></li>
    @endif
    <li><a class="fb" href="#">FACEBOOK</a></li>
    @if(in_array($__locale->code, config('lifestyle.tests.share_locales')))
        <li><a class="ok" href="#">ODNOKLASSNIKI</a></li>
    @endif
</ul>
