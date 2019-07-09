// import Promise from 'es6-promise-promise'; // нужен^ если используется require.ensure, для ie11-
import 'babel-polyfill';
import 'expose-loader?$!expose-loader?jQuery!jquery'; // подключил jquery, что бы он был виден глобально(в том числе из консоли)

//import Swiper from 'swiper';


 // let isMobile = $('body').hasClass('mobile');

import Swiper from 'swiper/dist/js/swiper.js';

let gallery = (function () {
    $('.small_photo').click(function () {
        $('.big_photo').css('background-image', 'url(' + $(this).attr('data-image') + ')');
    });
})(),
manorSearch = (function () {
    $('.list_on').click(function () {
        $('.map_on').removeClass('blue_link');
        $('.list_on').addClass('blue_link');
        $('.map').removeClass('on');
        $('.manors').addClass('on');
    });
    $('.map_on').click(function () {
        $('.list_on').removeClass('blue_link');
        $('.map_on').addClass('blue_link');
        $('.manors').removeClass('on');
        $('.map').addClass('on');
    });
})(),
    visibleText = (function () {
        $('.first_item').click(function () {
            $('.second_item').removeClass('active_item');
            $('.third_item').removeClass('active_item');
            $('.first_item').addClass('active_item');

            $('.second_text').removeClass('visible_text');
            $('.third_text').removeClass('visible_text');
            $('.first_text').addClass('visible_text');
        });
        $('.second_item').click(function () {
            $('.first_item').removeClass('active_item');
            $('.third_item').removeClass('active_item');
            $('.second_item').addClass('active_item');

            $('.first_text').removeClass('visible_text');
            $('.third_text').removeClass('visible_text');
            $('.second_text').addClass('visible_text');
        });
        $('.third_item').click(function () {
            $('.second_item').removeClass('active_item');
            $('.first_item').removeClass('active_item');
            $('.third_item').addClass('active_item');

            $('.second_text').removeClass('visible_text');
            $('.first_text').removeClass('visible_text');
            $('.third_text').addClass('visible_text');
        });
    })(),
    visibleUl = (function () {
       $('.item_name1').click(function () {
           $('.item_name1').addClass('item_name_active');
           $('.item_name2').removeClass('item_name_active');
           $('.item_name3').removeClass('item_name_active');
           $('.checkboxes1').slideDown();
           $('.checkboxes2').slideUp();
           $('.checkboxes3').slideUp();
       });
        $('.item_name2').click(function () {
            $('.item_name2').addClass('item_name_active');
            $('.item_name1').removeClass('item_name_active');
            $('.item_name3').removeClass('item_name_active');
            $('.checkboxes2').slideDown();
            $('.checkboxes1').slideUp();
            $('.checkboxes3').slideUp();
        });
        $('.item_name3').click(function () {
            $('.item_name3').addClass('item_name_active');
            $('.item_name2').removeClass('item_name_active');
            $('.item_name1').removeClass('item_name_active');
            $('.checkboxes3').slideDown();
            $('.checkboxes2').slideUp();
            $('.checkboxes1').slideUp();
        });
    })(),
    slider = (function(){
    var mySwiper = new Swiper('.gallery .swiper-container', {
        slidesPerView: 4,
        spaceBetween: 5,
    });
})()