/* preloader */

function handlePreloader() {
    if($('.preloader').length){
        $('body').removeClass('active-preloader-ovh');
        $('.preloader').fadeOut();
    }
}

 var dd = $('.vticker').easyTicker({
            direction: 'up',
            easing: 'swing',
            speed: 'slow',
            interval: 2000,
            height: '270',
            visible: 1,
            mousePause: 0,
            
        }).data('easyTicker');

jQuery(window).on('load', function() {
    (function($) {
        handlePreloader()
       
        // thmScrollAnim();
       
    })(jQuery);
});


/* preloader */



 $(".all-cat-sec img,.marsh-pic img ").hover(function () {
    $(this).toggleClass("bounceIn animated");
 });
 
 $(".search").click(function(){
  $("#search").toggleClass("open");
});

 $(".close").click(function(){
  $("#search").removeClass("open");
});
/* home slider */

/* home slider */

