<div id="event_{{$event->id}}" class="event-card {{ $event->getCSSClass() }} {{$event->is_opened == 0 ? 'declined' : ''}}">
    <div class="event-card__inner">
        <div class="event-card__head">
            <div class="event-card__controls">
                <div class="event-card-button">
                    {!! $event->renderFavorites($__favorites) !!}
                    <div class="event-card-button__share jsEventCardShare">
                        <a href="#" data-toggle="modal" data-event="{{ $event->id }}" data-target=".jsModalShareEvent"
                           data-action="{{ locale_route('api_map_share_email', ['id' => $event->id]) }}"
                           class="event-card-button__share-link jsEventCardShareToggle"></a>
                        {!! $event->renderShareButtons() !!}
                    </div>
                    <div class="event-card-button__label"></div>
                </div>
            </div>

            @if($__isMobile)
                <a href="{{ locale_route($event->status_id == 5 ? 'map_event_page' : 'account_events_edit', ['id' => $event->id]) }}" class="event-card__pic" target="_blank" style="background-image: url('{{ $event->getImage('medium') }}');"></a>
            @else
                @if(((isset($__route) && strpos($__route->getName(), 'account') !== 0) || !isset($__route)) && !$event->is_ended && $event->is_opened)
                    <div class="event-card-subscribe">
                        <div class="event-card-subscribe__inner">
                            <a target="_blank" href="{{ locale_route($event->status_id == 5 ? 'map_event_page' : 'account_events_edit', ['id' => $event->id]) }}" class="event-card-subscribe__link"></a>
                            <a data-toggle="modal" data-target=".jsModalEventSubscribe" data-event="{{ $event->id  }}"
                               data-event-city="{{ $event->city->name ?? '' }}" data-event-name="{{ $event->name }}"
                               data-action="{{ locale_route('api_map_add_member', ['id' => $event->id]) }}"
                               class="event-card-subscribe__button button">@lang('ori_fast_load')</a>
                        </div>
                    </div>
                @endif
                <div class="event-card__pic" style="background-image: url('{{ $event->getImage('medium') }}');"></div>
            @endif
        </div>
        <div class="event-card__body">
            <a target="_blank" href="{{ locale_route($event->status_id == 5 ? 'map_event_page' : 'account_events_edit', ['id' => $event->id]) }}" class="event-card__name" title="{{ $event->name }}">
                {{ $event->name }}
            </a>
            <div class="event-card__list">
                <ul>
                    <li class="label"><strong>{{ $event->format->lang('name') }}</strong></li>
                    @if($event->is_opened)
                        <li class="clock">{{ $event->getDatesString() }}</li>
                    @else
                        <li class="declined_text">@lang('ori_subscribe_closed_title'). @lang('ori_subscribe_closed_text')</li>
                    @endif
                    <li class="marker jsEventCardToMap">{{ $event->getAddress() }}</li>
                    @if($event->is_opened)
                        <li class="{{ $event->price_type ? 'money' : 'free' }}" data-type="{{ $event->price_type }}">
                            {{ $event->getPriceTypeTranslation() }}
                        </li>
                    @endif
                </ul>
            </div>

            @if($__isMobile && ((isset($__route) && strpos($__route->getName(), 'account') !== 0) || !isset($__route)) && !$event->is_ended && $event->is_opened)
                <div class="event-card__button">
                    <a data-toggle="modal" data-target=".jsModalEventSubscribe" data-event="{{ $event->id  }}"
                       data-event-city="{{ $event->city->name ?? '' }}" data-event-name="{{ $event->name }}"
                       data-action="{{ locale_route('api_map_add_member', ['id' => $event->id]) }}"
                       class="event-card-subscribe__button button">@lang('ori_fast_load')</a>
                </div>
            @endif
        </div>
    </div>
</div>