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
    mapPage = (function(){
        // list/map tabs
        $('.list_on').click(function () {
            $('.map_on').removeClass('blue_link');
            $('.list_on').addClass('blue_link');

            $('.map').hide();
            $('.manors').show();
        });

        $('.map_on').click(function () {
            $('.list_on').removeClass('blue_link');
            $('.map_on').addClass('blue_link');

            $('.map').show();
            $('.manors').hide();
        });

        // selectpicker
        $('.selectpicker').selectpicker({
            width: '20vw',
            height: '100%',
            padding: 0,
            margin: 0,
            size: 5,
            container: 'body',
            background: '#010d25',
        });

        // filters column
        $('.filter_item .item_name').click(function(){
            let is_active = $(this).hasClass('item_name_active');
            console.log(is_active);

            $('.filter_item .item_name').removeClass('item_name_active');
            if (!is_active) {
                $(this).addClass('item_name_active');
            }

            $('.filter_item .item_name:not(.item_name_active)').parents('.filter_item').find('ul').stop().slideUp();
            $('.filter_item .item_name.item_name_active').parents('.filter_item').find('ul').stop().slideDown();
        });

        // favorites
        $('.single_manor .like').click(function(){
            let button = $(this);
            $.post(button.hasClass('active') ? button.attr('data-remove-url') : button.attr('data-add-url'), function (out) {
                if (out.status == 'success') {
                    button.toggleClass('active');
                }
            }, 'json');
        });

        // region/area handler
        function initSelect() {
            let region_id = $('[name="region_id"]').val(),
                area_id = $('[name="area_id"]').val();

            $('[name="area_id"] option').hide();
            if (region_id > 0) {
                $('[name="area_id"] option[data-region="' + region_id + '"]').show();
            }

            $('[name="area_id"] option[value="0"]').show();
            if (area_id > 0) {
                $('[name="area_id"]').val(0);
            }

            $('.selectpicker').selectpicker('refresh');
        }

        $('[name="region_id"]').change(function(){
            $('[name="area_id"]').val(0);
            initSelect();
        });

        initSelect();


        // filtering


    })(),



    manorSearch = (function () {
        // $('.manor_address').click(function () {
        //     $('.list_on').removeClass('blue_link');
        //     $('.map_on').addClass('blue_link');
        //     $('.manors').removeClass('manor_on');
        //     $('.map').addClass('manor_on');
        // });
    })(),
    visibleText = (function () {
        $('.manor_info .item').click(function(){
            let tab = $(this);

            $('.manor_info .item').removeClass('active_item');
            $(this).addClass('active_item');

            $('.manor_info .text').hide();
            $(tab.attr('data-target')).show();
        });
    })(),
    slider = (function () {
        var mySwiper = new Swiper('.gallery .swiper-container', {
            slidesPerView: 4,
            spaceBetween: 5,

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    })(),
    onePageScroll = (function () {
        if ($('body').hasClass('home_page')) {
            $('#fullpage').onepage_scroll({
                sectionContainer: "section",
                pagination: false,
                loop: false,
                updateURL: false,
                direction: "vertical"
            });

            $("#down_btn").click(function () {
                $(".main").moveDown();
            });
        }
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
