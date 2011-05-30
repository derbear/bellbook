
 $(document).ready(function() {
     $("#my-info").css('min-width', '965px');
     $("html").css('min-width', '965px');
     $(window).scroll(function() {
     	var left = $('body').scrollLeft();
     	$("#my-info").css('left', -left + 'px');
     });
     
     // set a better min-height for the body
     var minHeight = $("ul#navigation").height() + 2 * parseInt($("ul#navigation").css("padding-top")) - 2 * parseInt($("div#real-content").css("padding-top")) - 6; /*assumes top padding = bottom padding, and in pixels, extra 6 are for borders*/
     $("#real-content").css("min-height", minHeight+"px");

 });