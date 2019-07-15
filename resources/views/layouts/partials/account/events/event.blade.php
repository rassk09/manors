<div class="event-card {{ $event->getCSSClass() }} {{ !$event->is_opened ? 'declined' : '' }}">
    <div class="event-card__number">
        №{{ $event->id }}
        <span>{{ $event->getStatusTranslation() }}</span>
        @if ($__locale->is_master && $event->status_id == 6)
            <span class="reason" data-event-id="{{ $event->id }}"></span>
            <div class="hint hint_reason" data-event-id="{{ $event->id }}">
                <a href="#" class="hint__close jsHintClose"></a>
                <div class="hint__content">
                    <p>{{ $event->getRejectReasonWithMessage() }}</p>
                </div>
            </div>
        @endif
    </div>
    <div class="event-card__inner">
        <div class="event-card__edit">
            <div class="event-card-control">
                @if(!$event->is_ended)
                    <div class="event-card-control__item">
                        <a href="#" class="event-card-control__button remove jsEventDeleteConfirm eventRemove" data-action="{{ locale_route('account_events_delete', ['id' => $event->id]) }}"></a>
                        <div class="event-card-control__hint">@lang('ori_minefull_button_del')</div>
                    </div>
                    <div class="event-card-control__item">
                        <a href="{{ locale_route('account_events_edit', ['id' => $event->id]) }}" class="event-card-control__button edit"></a>
                        <div class="event-card-control__hint">@lang('ori_changeevent_button_change')</div>
                    </div>
                    @if ($event->status_id == -1)
                        <div class="event-card-control__item">
                            <a href="#" class="event-card-control__button public eventPublicate" data-action="{{ locale_route('eventPublish', ['id' => $event->id, 'status' => 1]) }}"></a>
                            <div class="event-card-control__hint">@lang('ori_minefull_button_publish')</div>
                        </div>
                    @endif
                @else
                    <div class="event-card-control__item">
                        <a href="{{ locale_route('account_events_edit', ['id' => $event->id]) }}" class="event-card-control__button edit-photo"></a>
                        <div class="event-card-control__hint">@lang('ori_changeevent_text_photo')</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="event-card__head">
            <div class="event-card__controls">
                <div class="event-card-button">
                    {!! $event->renderFavorites($__favorites) !!}
                    @if ($event->status_id == 5)
                        <div class="event-card-button__share jsEventCardShare">
                            <a href="#" class="event-card-button__share-link jsEventCardShareToggle"></a>
                            {!! $event->renderShareButtons() !!}
                        </div>
                    @endif
                    <div class="event-card-button__label"></div>
                </div>
            </div>
            <a href="{{ locale_route($event->status_id == 5 ? 'map_event_page' : 'account_events_edit', ['id' => $event->id]) }}" class="event-card__pic" style="background-image: url('{{ $event->getImage('medium') }}');"></a>
        </div>
        <div class="event-card__body">
            <a href="{{ locale_route($event->status_id == 5 ? 'map_event_page' : 'account_events_edit', ['id' => $event->id]) }}" class="event-card__name" title="{{$event->name}}">{{$event->name}}</a>
            <div class="event-card__list">
                <ul>
                    <li class="label"><strong>{{ $event->format->lang('name') }}</strong></li>
                    <li class="clock">{{$event->getDatesString()}}</li>
                    <li class="marker">{{$event->getAddress()}}</li>
                    <li class="{{ $event->price_type ? 'money' : 'free' }}" data-type="{{ $event->price_type }}">
                        {{ $event->getPriceTypeTranslation() }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>