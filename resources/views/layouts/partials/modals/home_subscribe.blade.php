<div tabindex="-1" class="modal fade modal-default modal-main-subscribe jsModalSubscribe">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <a data-dismiss="modal" class="modal__close"></a>
                <div class="modal-event__inner">
                    <div class="modal__title">Узнавай первой о наших новинках, специальных предложениях и новостях бренда.</div> {{-- TODO: ADD SETTINGS --}}
                    <form action="{{ action('Api\HomeController@subscribe') }}" class="event-create__form subscribe__form jsHomeSubscribeForm">
                        <input type="hidden" class="form_id" name="form_id" value="7">
                        <div class="form__group">
                            <div class="form__input error">
                                <input type="text" class="subscribe_name" name="name" required placeholder="Имя и фамилия">
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__input error">
                                <input type="email" class="subscribe_email" name="email" required placeholder="Твоя электронная почта">
                            </div>
                        </div>
                        <div class="form__checkbox">
                            <div class="checkbox error">
                                <input name="personal" type="checkbox" checked required id="agree_popup_2">
                                <label for="agree_popup_2">Я согласен с <a href="https://www.oriflame.ru/customer-service/privacy-protection-policy" target="_blank">правилами обработки персональных данных</a></label>
                            </div>
                        </div>
                        <div class="form__checkbox">
                            <div class="checkbox ">
                                <input name="rule" type="checkbox" checked required id="subscribe_popup_2">
                                <label for="subscribe_popup_2">Я согласен получать новости Орифлэйм Россия</label>
                            </div>
                        </div>
                        <div class="modal-event__foot">
                            <div class="form__button">
                                <button class="button-default">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

