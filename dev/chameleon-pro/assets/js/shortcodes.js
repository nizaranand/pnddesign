
// jQuery.noConflict();

function button_hover_shortcode(){
	jQuery('.button_link,button[type=submit],button,input[type=submit],input[type=button],input[type=reset]').hover(
		function() {
				jQuery(this).stop().animate({opacity:0.8},400);
			},
			function() {
				jQuery(this).stop().animate({opacity:1},400);
		});
}

jQuery(document).ready(function() {
	if(!jQuery.browser.msie){button_hover_shortcode();}
	});
