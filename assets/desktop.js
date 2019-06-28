// import Promise from 'es6-promise-promise'; // нужен^ если используется require.ensure, для ie11-
import 'babel-polyfill';
import 'expose-loader?$!expose-loader?jQuery!jquery'; // подключил jquery, что бы он был виден глобально(в том числе из консоли)

//import Swiper from 'swiper';
import Swiper from 'swiper/dist/js/swiper.js';

 let isMobile = $('body').hasClass('mobile');

gallery = (function () {
    $('.small_photo').click(function () {
        $('.big_photo').css('background-image', 'url(' + $(this).attr('data-image') + ')');
    });
})()