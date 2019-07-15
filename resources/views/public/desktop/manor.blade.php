@extends('layouts.desktop')

@section('content')
    <section class="cont">
        <div class="left">
            <a href="javascript:history.back();" class="preview">&#60; Назад</a>
            <div class="about_manor">
                <p class="manor_name">{{ $manor->name }}</p>
                <div class="manor_card">
                    <div class="card_header">
                        @if ($manor->number)
                            <div class="number">Реестровый №{{ $manor->number }}</div>
                        @endif
                        <div class="show_map show_on">смотреть на карте</div>
                        <div class="show_photo">смотреть фотографии</div>
                    </div>
                    <div class="table">
                        <div class="col col_left">
                            <div class="cell cell1">
                                <div class="cell_title">Адрес:</div>
                                <div class="cell_text">{{ $manor->address }}</div>
                            </div>
                            <div class="cell cell2_restored">
                                <div class="cell_title">Состояние усадьбы:</div>
                                <div class="cell_text">{{ $manor->getType() }}</div>
                            </div>
                        </div>
                        <div class="col col_right">
                            <div class="cell cell3">
                                <div class="cell_title">Вид собственности:</div>
                                <div class="cell_text">{{ $manor->privacy_type ? $manor->privacy_type->name : 'Неизвестно' }}</div>
                            </div>
                            <div class="cell cell4">
                                <div class="cell_title">Владельцы:</div>
                                <div class="cell_text">{{ $manor->owner_id > 0 ? $manor->owner->id : 'Нет' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="manor_info">
                    @if ($manor->texts->count() > 0)
                        <div class="paragraph">
                            @foreach($manor->texts as $text)
                                <div class="item {{ $loop->first() ? 'active_item' : '' }}" data-target="#tab{{ $text->id }}">{{ $text->title }}</div>
                            @endforeach
                        </div>
                        <div class="info_text scrollbar_style">
                            @foreach($manor->texts as $text)
                                <div class="text {{ $loop->first() ? 'visible_text' : '' }}" id="tab{{ $text->id }}">
                                    {!! $text->content !!}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="paragraph">
                            <div class="item active_item" data-target="#tab1">Историческая справка</div>
                            <div class="item" data-target="#tab2">События в усадьбе</div>
                            <div class="item" data-target="#tab3">Туризм</div>
                        </div>
                        <div class="info_text scrollbar_style">
                            <div class="text visible_text" id="tab1">
                                <p>Усадьба дворян Качаловых «Хвалевское» расположена на высоком живописном берегу реки Суды в
                                    селе Борисово-Судское Бабаевского района Вологодской области. Исторически эти земли
                                    были частью Белозерского уезда Новгородской губернии.
                                </p>
                                <p>Главный усадебный дом был построен в 1854–56 годах местным помещиком Николаем Александровичем
                                    Качаловым.
                                </p>
                                <p>Н.А. Качалов долгие годы был предводителем дворянства Белозерского уезда. Впоследствии он
                                    руководил первым Новгородским земством, служил губернатором Архангельска,
                                    после чего руководил Таможней Российской империи.
                                </p>
                                <p>Николай Александрович был близким соратником царя Александра III. Женат он был на Александре
                                    Павловне Долговой-Сабуровой, дочери местного помещика. Земли усадьбы Хвалевское и местные
                                    деревни он передал своей дочери в качестве приданого.Кронштадтским, строил храмы и богадельни.
                                    Владимир Федорович, будучи человеком благородного происхождения, с детства дружил с деревенскими
                                    ребятишками и поэтому всю жизнь старался общаться с народом. Он помогал сиротам и вдовам,
                                    кормил нищих, утешал страждущих.владельцами после революции и что представляет собой это
                                    старинное поместье в наши дни?
                                </p>
                                <p>Поиск ответов на все эти вопросы особенно актуален сейчас - когда руководство Тульской области
                                    изъяло Хрусловку у предыдущего собственника и сейчас ищет усадьбе нового заботливого владельца.
                                    Кстати: интерес к усадьбе растет с каждым годом, причем не только среди россиян, но и среди
                                    представителей других стран.
                                </p>
                            </div>
                            <div class="text" id="tab2">
                                <p>Н.А. Качалов долгие годы был предводителем дворянства Белозерского уезда. Впоследствии он
                                    руководил первым Новгородским земством, служил губернатором Архангельска,
                                    после чего руководил Таможней Российской империи.
                                </p>
                                <p>Николай Александрович был близким соратником царя Александра III. Женат он был на Александре
                                    Павловне Долговой-Сабуровой, дочери местного помещика. Земли усадьбы Хвалевское и местные
                                    деревни он передал своей дочери в качестве приданого.Кронштадтским, строил храмы и богадельни.
                                    Владимир Федорович, будучи человеком благородного происхождения, с детства дружил с деревенскими
                                    ребятишками и поэтому всю жизнь старался общаться с народом. Он помогал сиротам и вдовам,
                                    кормил нищих, утешал страждущих.владельцами после революции и что представляет собой это
                                    старинное поместье в наши дни?
                                </p>
                                <p>Поиск ответов на все эти вопросы особенно актуален сейчас - когда руководство Тульской области
                                    изъяло Хрусловку у предыдущего собственника и сейчас ищет усадьбе нового заботливого владельца.
                                    Кстати: интерес к усадьбе растет с каждым годом, причем не только среди россиян, но и среди
                                    представителей других стран.
                                </p>
                            </div>
                            <div class="text" id="tab3">
                                <p>Поиск ответов на все эти вопросы особенно актуален сейчас - когда руководство Тульской области
                                    изъяло Хрусловку у предыдущего собственника и сейчас ищет усадьбе нового заботливого владельца.
                                    Кстати: интерес к усадьбе растет с каждым годом, причем не только среди россиян, но и среди
                                    представителей других стран.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="right">
            <div class="gallery showItem">
                <div class="big_photo" style="background-image: url('{{ $manor->image }}')"></div>
                @if ($manor->photos->count() > 0)
                    <div class="swiper-container">
                        <ul class="small_box swiper-wrapper">
                            <li class="small_photo swiper-slide" style="background-image: url('{{ $manor->image }}')" data-image="{{ $manor->image }}"></li>
                            @foreach($manor->photos as $photo)
                                <li class="small_photo swiper-slide" style="background-image: url('{{ $photo->image }}')" data-image="{{ $photo->image }}"></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="map_alone" id="restoredMap"></div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=66502966-277a-449d-bbfc-1d82323b26ce" type="text/javascript"></script>
    <script>
        ymaps.ready(function () {
            let myMap = new ymaps.Map('restoredMap', {
                    center: [{{ $manor->geo_lat }}, {{ $manor->geo_lng }}],
                    zoom: 10
                }, {
                    searchControlProvider: 'yandex#search'
                }),

                myPlacemark = new ymaps.Placemark([{{ $manor->geo_lat }}, {{ $manor->geo_lng }}], {
                    balloonContent: `<div id="content" style="height: 100%">
                        <div id="siteNotice"></div>
                        <div class="bodyContent">
                            <div class="manorCard" style="background-image: url('{{ $manor->image }}');"></div>
                            <div class="manorName">
                                <span>{{ $manor->name }}</span>
                            </div>
                        </div>
                    </div>`
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '/images/desktop/{{ $manor->type_id == 1 ? 'address-blue.png' : 'address-grey.png' }}',
                    iconImageSize: [28, 38],
                    iconImageOffset: [-14, -38],
                });

            myMap.geoObjects.add(myPlacemark);
        });
    </script>
@endsection
