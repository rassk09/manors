<div tabindex="-1" class="modal fade modal-default jsModalShareEvent">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-event-share event-share">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="event-share__inner">
                    <form action="" method="post" class="event-share__inner jsEmailShare">
                        <div class="event-share__title">@lang('ori_share-link-1')</div>
                        <div class="event-share__input">
                            <input type="text" class="modal__share-link" value="">
                            <!--<a href="#" class="event-share__copy jsCopyLink"></a>-->
                        </div>
                        <div class="event-share__social social" data-url="">
                            <p>@lang('ori_through-social')</p>
                            <ul>
                                <li><a class="fb" href="#"></a></li>
                                <li><a class="vk" href="#"></a></li>
                                <li><a class="ok" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="event-share__email">
                            <p>@lang('ori_or-mail')</p>
                            <div class="event-share__input2">
                                <input name="email" type="email" placeholder="@lang('ori_event_window_share_text_adress')" required>
                            </div>
                        </div>
                        <div class="event-share__textarea">
                            <textarea placeholder="@lang('ori_write-your-invitation')" name="text"  cols="30" rows="5"></textarea>
                        </div>
                        <div class="event-share__button">
                            <button class="button-default">@lang('ori_event_window_share_button_send')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>