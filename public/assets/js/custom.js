
 /* jQuery Pre loader
  -----------------------------------------------*/
$(window).load(function(){
    $('.preloader').fadeOut(500); // set duration in brackets
});


$(document).ready(function() {



      $(".bg-gallery1").fancybox({
            loop: true,
            keyboard: true,
            arrows: true,
            infobar: true,
            smallBtn: "auto",
            toolbar: "auto",
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "thumbs",
                "close"
            ],
            idleTime: 3,
            protect: true,
            modal: false,
            fullScreen: {
                autoStart: false
            },
            touch: {
                vertical: true,
                momentum: true
            },
            slideShow: {
                autoStart: false,
                speed: 4000
            },
            wheel: "auto",
            lang: "ru",
            i18n: {
                ru: {
                    CLOSE: "Закрыть",
                    NEXT: "След",
                    PREV: "Пред",
                    ERROR: "The requested content cannot be loaded. <br/> Please try again later.",
                    PLAY_START: "Запустить слайдшоу",
                    PLAY_STOP: "Приостановить слайдшоу",
                    FULL_SCREEN: "На весь экран",
                    THUMBS: "Миниатюры",
                    DOWNLOAD: "Скачать",
                    SHARE: "Поделиться",
                    ZOOM: "Увеличить"
                },
            }
      });


  /* Hide mobile menu after clicking on a link
    -----------------------------------------------*/
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });


  /* Smoothscroll js
  -----------------------------------------------*/
    $(function() {
        $('.navbar-default a').bind('click', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top - 49
            }, 1000);
            event.preventDefault();
        });
    });


 /* Home Slideshow Vegas
  -----------------------------------------------*/
  $(function() {
      if($('#home').length) {
          $('.matrix').vegas({
              slides: [
                  {src: '/images/1-1t.jpg'}/*,
            { src: '/images/2-1.jpg' },
            { src: '/images/3-1.jpg' }*/
              ],
              timer: false,
              transition: ['zoomIn',],
              animation: ['kenburns']
          });
      }
  });


  /* Team carousel
  -----------------------------------------------*/
  $(document).ready(function() {
      $("#team-carousel").owlCarousel({
          items : 3,
          itemsDesktop : [1199,3],
          itemsDesktopSmall : [979,3],
          slideSpeed: 300,
          itemsDesktop : [1199,2],
          itemsTablet: [768,1],
          itemsTabletSmall: [985,2],
          itemsMobile : [479,1],
      });
    });


    /* Back to Top
    -----------------------------------------------*/
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
          $('.go-top').fadeIn(200);
            } else {
                $('.go-top').fadeOut(200);
           }
        });
          // Animate the scroll to top
        $('.go-top').click(function(event) {
          event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 300);
    });


  /* wow
  -------------------------------*/
  new WOW({ mobile: false }).init();

  });

