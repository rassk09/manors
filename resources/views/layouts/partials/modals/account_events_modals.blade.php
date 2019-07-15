<div tabindex="-1" class="modal fade modal-default modal-small jsModalEventDelete">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal__message">
                    @lang('ori_mine_window_delete_text')
                </div>
                <div class="modal__button">
                    <a href="#" class="button-default">@lang('ori_mine_window_delete_button_ok')</a>
                    <input type="hidden" class="modal_event_type" name="event_id" value=""/>
                </div>
            </div>
        </div>
    </div>
</div>


<div tabindex="-1" class="modal fade modal-default modal-small jsModalEventPublished">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal__desc">
                    @lang('ori_makedone_text_left_5_frame-1')
                    @lang('ori_makedone_text_left_5_frame-2')
                </div>
                <div class="modal__button">
                    <a href="{{ locale_route('account_events') }}" class="button-default">@lang('ori_return-site')</a>
                </div>
            </div>
        </div>
    </div>
</div>