jQuery(document).ready(function($) {
    $('.logo-open').click(function() {
        $('.mobile').css("display","flex");
        $(this).css("display","none")
        $('.logo-close').css("display","flex");
    });

    $('.logo-close').click(function() {
        $('.mobile').css("display","none");
        $(this).css("display","none")
        $('.logo-open').css("display","flex");
    });


});

