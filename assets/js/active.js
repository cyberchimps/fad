jQuery(document).ready(function(){
 jQuery("ul.nav.navbar-nav menu-item").addClass('dropdown');
});

function changeClass(element){

			jQuery('.list-group li').removeClass('active');

			jQuery(element).addClass('active');

}


jQuery(window).load(function() {
    var boxheight = jQuery('#myCarousel .carousel-inner').innerHeight();
    var itemlength = jQuery('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	jQuery('#myCarousel .list-group-item').outerHeight(triggerheight);
});
