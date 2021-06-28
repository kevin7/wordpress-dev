import slick from 'slick-carousel';
import 'magnific-popup';
import Flickity from 'flickity';

(function ($) {

    $('.link-video').magnificPopup({
        type: 'iframe'
    });

    $('#test').slick({
        arrows: false,
        dots: true
    });

    var flkty = new Flickity( '.main-carousel', {
        // options
      });

})(jQuery);