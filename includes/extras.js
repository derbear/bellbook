
 $(document).ready(function() {
     $("#my-info").css('min-width', '965px');
     $("html").css('min-width', '965px');
     $(window).scroll(function() {
     	var left = $('body').scrollLeft();
     	$("#my-info").css('left', -left + 'px');
     });
 });