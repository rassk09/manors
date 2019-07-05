$(document).ready(function() {

    $(".icon_menu").click(function(){
        $('.nav-container').toggleClass('hidden');
        $('.sidebar_footer').toggleClass('hidden2');
        $('.my-container').toggleClass('hidden3');
    });
    $(".icon_menu").click(function(){
        if ( $(window).width() < 600 ) {
            $('.nav-container').toggleClass('visible');
        }
    });


});
