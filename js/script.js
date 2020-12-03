// preloader
$(window).on('load', function () {
  var $preloader = $('.preloader'),
      $svg_anm = $preloader.find('.preloader__svg_anm');
  $svg_anm.fadeOut();
  $preloader.delay(500).fadeOut('slow');
});

// slider
$(document).ready(function(){
    $('.trust-us__sliders').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      prevArrow:'.trust-us__action-left',
      nextArrow:'.trust-us__action-right',
      responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            }
        },
        {
            breakpoint: 700,
            settings: {
              slidesToShow: 1,
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            }
          }
      ]
      
    });
    $(".trust-us__sliders").on('afterChange', function(event, slick, currentSlide){
        $("#cp").text(currentSlide + 1);
     });
  });

//  scroll down
$(".header__arrow").click(function() {
    $('html, body').animate({
        scrollTop: $(".trust-us").offset().top 
    }, 1000); 
});

// Вывод имени выбраного файла в lable
$('#upload-photo').change(function() {
    var filename = $('#upload-photo').val();
    $('#select_file').html(filename);
});
