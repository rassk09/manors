@if($item->last_action)
    {!! $item->last_action->created_at !!}<br/>
    {!! $item->last_action->message !!}
@else
    {{ $item->updated_at }}
@endif