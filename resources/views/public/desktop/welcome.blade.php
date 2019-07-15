@extends('layouts.desktop')

@section('content')
    <div class="main onepage-wrapper" id="fullpage">
        <section class="main_screen section">
            <div class="main_logo">
                <div>При поддержке</div>
                <a href="#" class="logotype"></a>
            </div>
            <div class="main_block">
                <div>проект</div>
                <h1>«Усадебное достояние <br>России»</h1>
                <a class="blue_button" id="down_btn">Подробнее</a>
            </div>
        </section>
        <section id="about" class="about_screen slide section">
            <div class="info_block">
                <div class="title">
                    <div class="first">Первые</div>
                    <span></span>
                    <div class="second">усадеб</div>
                    <div class="third">ждут своих хозяев</div>
                </div>
                <p class="text">
                    В России примерно 2000 «забытых» исторических усадеб и эти объекты должны быть возвращены
                    к жизни передачей новым добросовестным собственникам с беспрецедентными преференциями,
                    объявленными О.Ю. Голодец на 7-ом СПБ международном культурном форуме. Наша Ассоциация
                    в рамках проекта «Возрождение исторических усадеб»  предлагает помощь тем, кто готов
                    взять на себя ответственность за их сохранение и использование в разумном сочетании
                    своих интересов и заботы о национальном достоянии.
                </p>
                <div class="button_block">
                    <a href="{{ route('map', ['type' => 0]) }}" class="button black_btn">Заброшенные усадьбы</a>
                    <a href="{{ route('map', ['type' => 1]) }}" class="button blue_btn">Возрожденные усадьбы</a>
                </div>
                <a href="{{ route('map') }}" class="more">Смотреть все объекты</a>
            </div>
        </section>
    </div>
@endsection