@extends('layouts.desktop')

@section('content')
    <form id="filterForm">
        <div class="cont">
            <div class="obj">
                <div class="search_body">
                    <div class="search_menu">
                        <select class="search_element region_search selectpicker" title="ОБЛАСТЬ" name="region_id">
                            <option value="0">Все регионы</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ request()->get('region_id') == $region->id ? ' selected ' : '' }}>{{ $region->name }}</option>
                            @endforeach
                        </select>
                        <select class="search_element area selectpicker" title="РАЙОН" name="area_id">
                            <option value="0">Все районы</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" data-region="{{ $area->region_id }}" {{ request()->get('area_id') == $area->id ? ' selected ' : '' }}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                        <input name="q" class="search_element search_input" title="Поиск по названию усадьбы" placeholder="Поиск по названию усадьбы">
                        <button type="button" class="search_button"></button>
                    </div>
                    <div class="info_string">
                        <a class="list_on blue_link">Списком</a>
                        <a class="map_on">на карте</a>
                        <div class="how_many">Найдено <span>100 объектов</span></div>
                    </div>
                </div>
                <div class="manors manor_on">
                    @foreach($manors as $manor)
                        <div class="single_manor" data-id="{{ $manor->id }}" data-region="{{ $manor->region_id }}" data-area="{{ $manor->area_id }}"
                             data-type="{{ $manor->type_id }}" data-privacy="{{ $manor->privacy_type_id }}" data-owner="{{ $manor->owner_id > 0 ? 1 : 0 }}"
                             data-image="{{ $manor->image }}" data-geo-lat="{{ $manor->geo_lat }}" data-geo-lng="{{ $manor->geo_lng }}">
                            <div class="card_photo" style="background-image: url('{{ $manor->image }}');">
                                <div class="like brick {{ in_array($manor->id, $__favorites) ? ' active ' : '' }}"
                                     data-add-url="{{ route('addToFavorite', ['id' => $manor->id]) }}" data-remove-url="{{ route('removeFromFavorite', ['id' => $manor->id]) }}"></div>
                                <div class="type {{ $manor->type_id == 1 ? ' restored ' : ' ruined ' }} brick"></div>
                            </div>
                            <div class="manor_info">
                                <div class="manor_name">{{ $manor->name }}</div>
                                <div class="manor_address">{{ $manor->address }}</div>
                                <a href="{{ route('manor', ['id' => $manor->id]) }}" class="blue_button">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="map" id="map"></div>
            </div>
            <div class="filters">
                <div class="filter">
                    <div class="filter_header">
                        <div class="filter_title">Настроить фильтры</div>
                    </div>
                    <div class="filter_body">
                        <div class="filter_item">
                            <div class="item_name item_name1">Вид собственности</div>
                            <ul class="checkboxes1">
                                @foreach($privacy_types as $type)
                                    <li>
                                        <input class="styled-checkbox" type="radio" name="privacy" value="{{ $type->id }}" id="privacy_{{ $type->id }}" {{ request()->get('privacy') == $type->id ? ' checked ' : '' }}>
                                        <label for="privacy_{{ $type->id }}">{{ $type->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter_item">
                            <div class="item_name item_name2">Владельцы</div>
                            <ul class="checkboxes2">
                                <li>
                                    <input class="styled-checkbox" type="radio" name="owner" value="1" id="checkbox_4" {{ request()->get('owner') == 1 ? ' checked ' : '' }}>
                                    <label for="checkbox_4">Есть</label>
                                </li>
                                <li>
                                    <input class="styled-checkbox" type="radio" name="owner" value="0" id="checkbox_5" {{ request()->get('owner') === '0' ? ' checked ' : '' }}>
                                    <label for="checkbox_5">Нет</label>
                                </li>
                            </ul>
                        </div>
                        <div class="filter_item">
                            <div class="item_name item_name3">Состояние усадьбы</div>
                            <ul class="checkboxes3">
                                <li>
                                    <input class="styled-checkbox" type="radio" name="type" value="1" id="checkbox_6" {{ request()->get('type') == 1 ? ' checked ' : '' }}>
                                    <label for="checkbox_6">Возрожденные</label>
                                </li>
                                <li>
                                    <input class="styled-checkbox" type="radio" name="type" value="0" id="checkbox_7" {{ request()->get('type') === '0' ? ' checked ' : '' }}>
                                    <label for="checkbox_7">Заброшенные</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('js')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=66502966-277a-449d-bbfc-1d82323b26ce" type="text/javascript"></script>
    <script>
        ymaps.ready(function () {
            let locations = [],
                placemarks = [];

            $('.single_manor').each(function(){
                let card = $(this),
                    card_id = +card.attr('data-id'),
                    geo_lat = +card.attr('data-geo-lat'),
                    geo_lng = +card.attr('data-geo-lng'),
                    type = +card.attr('data-type'),
                    image = card.attr('data-image'),
                    name = card.find('.manor_name').html();

                locations.push([
                    card_id,
                    `<div id="content" style="height: 100%">
                        <div id="siteNotice"></div>
                        <div class="bodyContent">
                            <div class="manorCard" style="background-image: url('${image}');"></div>
                            <div class="manorName">
                                <span>${name}</span>
                            </div>
                        </div>
                    </div>`,
                    geo_lat,
                    geo_lng,
                    (type == 1 ? 'address-blue.png' : 'address-grey.png')
                ]);
            });

            let myMap = new ymaps.Map('map', {
                    center: [55.751574, 37.573856],
                    zoom: 9
                }, {
                    searchControlProvider: 'yandex#search'
                });


            $.each(locations, function(key, value) {
                placemarks[value[0]] = new ymaps.Placemark([value[2], value[3]], {
                    hintContent: 'Собственный значок метки',
                    balloonContent: value[1]
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '/images/desktop/' + value[4],
                    iconImageSize: [28, 38],
                    iconImageOffset: [-14, -38],
                    // balloonLayout: MyBalloonLayout,
                });

                myMap.geoObjects.add(placemarks[value[0]]);
            });

            myMap.setBounds(myMap.geoObjects.getBounds(), {
                checkZoomRange: true
            }).then(function () {
                if (myMap.getZoom() > 10) {
                    myMap.setZoom(10);
                }
            });

            function getObjectsWord(count) {
                let words = ['объект', 'объекта', 'объектов'],
                    num = count % 100;

                if (num > 19) {
                    num = count % 10;
                }

                switch (num) {
                    case 1: {
                        return(words[0]);
                    }
                    case 2:
                    case 3:
                    case 4: {
                        return(words[1]);
                    }
                    default: {
                        return(words[2]);
                    }
                }
            }

            function initFilters() {
                let form = $('#filterForm'),
                    region_id = form.find('[name="region_id"]').val(),
                    area_id = form.find('[name="area_id"]').val(),
                    q = form.find('[name="q"]').val(),
                    type = form.find('[name="type"]:checked').val(),
                    owner = form.find('[name="owner"]:checked').val(),
                    privacy = form.find('[name="privacy"]:checked').val(),
                    selector = [];

                $('.single_manor').removeClass('mr').removeClass('visible').hide();
                $.each(placemarks, function(key, placemark) {
                    if (placemark) {
                        placemark.options.set('visible', false);
                    }
                });

                if (region_id > 0) {
                    if (area_id > 0) {
                        selector.push('[data-region="' + region_id + '"][data-area="' + area_id + '"]');
                    } else {
                        selector.push('[data-region="' + region_id + '"]');
                    }
                }

                if (type || type === 0) {
                    selector.push('[data-type="' + type + '"]');
                }

                if (owner || owner === 0) {
                    selector.push('[data-owner="' + owner + '"]');
                }

                if (privacy || privacy === 0) {
                    selector.push('[data-privacy="' + privacy + '"]');
                }

                $('.single_manor' + selector.join('')).show().addClass('visible');
                $('.single_manor.visible').each(function(){
                    if (q != '') {
                        let card = $(this),
                            name = card.find('.manor_name').text().toLowerCase(),
                            index = name.indexOf(q.toLowerCase());
                        if (index < 0) {
                            card.hide();
                        }
                    }
                });

                let k = 0;
                $('.single_manor.visible').each(function(){
                    k++;
                    if (k % 4 != 0) {
                        $(this).addClass('mr');
                    }

                    placemarks[$(this).attr('data-id')].options.set('visible', true);
                });

                $('.how_many span').html($('.single_manor.visible').length + ' ' + getObjectsWord($('.single_manor.visible').length));
                $('html, body').scrollTop(0);

                myMap.setBounds(myMap.geoObjects.getBounds(), {
                    checkZoomRange: true
                }).then(function () {
                    if (myMap.getZoom() > 10) {
                        myMap.setZoom(10);
                    }
                });
            }

            $('#filterForm').submit(function(e){
                e.preventDefault();
                initFilters();
            });

            $('#filterForm [name="region_id"], #filterForm [name="area_id"], #filterForm [type="checkbox"], #filterForm [type="radio"], #filterForm [name="q"]').change(function() {
                initFilters();
            });

            $('#filterForm [name="q"]').keyup(function(e) {
                initFilters();
            });

            initFilters();

        });
    </script>
@endsection