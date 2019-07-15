<footer class="footer">
    <div class="footer__inner">
        <div class="footer__col">
            <div class="footer__feedback ori__feedback">
                <p>@lang('ori_lk_footer_text')</p>
            </div>
            <div class="footer__social">
                <ul>
                    @if (issetKey('ori_lk_footer_social_fb'))
                        <li><a href="@lang('ori_lk_footer_social_fb')" class="fb ori__fb_link" target="_blank"></a></li>
                    @endif
                    @if (issetKey('ori_lk_footer_social_vk'))
                        <li><a href="@lang('ori_lk_footer_social_vk')" class="vk ori__vk_link" target="_blank"></a></li>
                    @endif
                    @if (issetKey('ori_lk_footer_social_ok'))
                        <li><a href="@lang('ori_lk_footer_social_ok')" class="ok ori__ok_link" target="_blank"></a></li>
                    @endif
                    @if (issetKey('ori_lk_footer_social_in'))
                        <li><a href="@lang('ori_lk_footer_social_in')" class="in ori__in_link" target="_blank"></a></li>
                    @endif
                    @if (issetKey('ori_lk_footer_social_yt'))
                        <li><a href="@lang('ori_lk_footer_social_yt')" class="yt ori__yt_link" target="_blank"></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="footer__col">
            <div class="footer__text ori__copyright">{!! str_replace('%_DATE_%', date('Y'), __k('ori_lk_footer_copyright')) !!}</div>
        </div>
    </div>
</footer>