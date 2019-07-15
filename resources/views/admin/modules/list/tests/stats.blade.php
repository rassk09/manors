@php($percent = $item->views > 0 ? round(100 * ($item->completed / $item->views)) : 0)
<div class="progress rounded-corner m-b-15 width-200">
    <div class="progress-bar" style="width: {{ $percent }}%">{{ $percent }}%</div>
</div>
<p class="text-center">Завершило тест {{ $item->completed }} / {{ $item->views }} пользователей</p>