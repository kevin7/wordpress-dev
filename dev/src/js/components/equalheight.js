(function ($) {
  console.log('JS Refresh'); 
  /*
  ** Event equalheight
  */
 var resizeTimer;
 equalHeight('.test-col', 0, '.test-col');
 $(window).resize(function () {

   clearTimeout(resizeTimer);
   resizeTimer = setTimeout(function () {
     equalHeight('.test-col', 0, '.test-col');
   }, 500);
 });

 function equalHeight(elm, mobileWidth, target) {

   var tallest = 0;
   var $block = $(elm);
   $(target).css('min-height', 0);
   
   if ($(window).width() > mobileWidth) {
 
     $block.each(function (x) {
       if ($(this).outerHeight() > tallest) {
         tallest = $(this).outerHeight(); 
       }
     });   
     $(target).css('min-height', tallest);
 
   }
 }

})(jQuery);