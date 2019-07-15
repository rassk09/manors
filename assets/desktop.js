// import Promise from 'es6-promise-promise'; // нужен^ если используется require.ensure, для ie11-
import 'babel-polyfill';
import 'expose-loader?$!expose-loader?jQuery!jquery'; // подключил jquery, что бы он был виден глобально(в том числе из консоли)
import 'popper.js';
import 'bootstrap';
import 'bootstrap-select';
import 'onepage-scroll-master/jquery.onepage-scroll.min';
import Swiper from 'swiper/dist/js/swiper.js';

// let isMobile = $('body').hasClass('mobile');

let gallery = (function () {
    $('.small_photo').click(function () {
        $('.big_photo').css('background-image', 'url(' + $(this).attr('data-image') + ')');
    });
})(),

manorSearch = (function () {
    $('.list_on').click(function () {
        $('.map_on').removeClass('blue_link');
        $('.list_on').addClass('blue_link');
        $('.map').removeClass('manor_on');
        $('.manors').addClass('manor_on');
    });
    $('.map_on').click(function () {
        $('.list_on').removeClass('blue_link');
        $('.map_on').addClass('blue_link');
        $('.manors').removeClass('manor_on');
        $('.map').addClass('manor_on');
    });
    $('.manor_address').click(function () {
        $('.list_on').removeClass('blue_link');
        $('.map_on').addClass('blue_link');
        $('.manors').removeClass('manor_on');
        $('.map').addClass('manor_on');
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
})(),
onePageScroll = (function(){
    $('#fullpage').onepage_scroll({
        sectionContainer: "section",
        
        pagination: false,
        loop: false,
        updateURL: false,
        direction: "vertical"
    });
})(),
bootstrapSelect = (function () {
    $('.selectpicker').selectpicker({
        width: '20vw',
        height: '100%',
        padding: 0,
        margin: 0,
        size: 5,
        container: 'body',
        background: '#010d25',
    });
})(),
ruinedRestoredMap = (function () {
    $('.show_map').click(function () {
        $('.show_map').removeClass('show_on');
        $('.show_photo').addClass('show_on');

        $('.gallery').removeClass('showItem');
        $('.map_alone').addClass('showItem');
    });
    $('.show_photo').click(function () {
        $('.show_photo').removeClass('show_on');
        $('.show_map').addClass('show_on');

        $('.map_alone').removeClass('showItem');
        $('.gallery').addClass('showItem');
    });
})();