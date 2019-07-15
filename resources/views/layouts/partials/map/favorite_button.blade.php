<a href="#" data-add-url="{{ locale_route('addToFavorite', ['id' => $event->id]) }}" data-remove-url="{{ locale_route('removeFromFavorite', ['id' => $event->id]) }}"
   class="event-card-button__favorite {{ in_array($event->id, $__favorites) ? ' active ' : '' }} jsFavorite">
    <svg width="23" height="21" xmlns="http://www.w3.org/2000/svg">
        <path d="M22.055 8.66c-.437 1.834-1.447 3.503-2.92 4.827l-7.566 6.694-7.435-6.692c-1.476-1.326-2.486-2.995-2.924-4.83-.313-1.317-.183-2.06-.183-2.066l.006-.043C1.321 3.334 3.573 1 6.388 1c2.074 0 3.903 1.263 4.77 3.302l.41.959.408-.96C12.828 2.297 14.754 1 16.88 1c2.813 0 5.065 2.334 5.36 5.59 0 .01.13.754-.185 2.07" stroke="#F3CB8E" fill="none"/>
    </svg>
</a>