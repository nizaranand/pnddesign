// initialise plugins
jQuery(document).ready(function(){ 
	
	jQuery("ul#nav").supersubs({ 
		dropShadows:   true,
		minWidth:    7,   // minimum width of sub-menus in em units 
		maxWidth:    27,   // maximum width of sub-menus in em units 
		extraWidth:  0     // extra width can ensure lines don't sometimes turn over 
						   // due to slight rounding differences and font-family 
	}).superfish();  // call supersubs first, then superfish, so that subs are 
					 // not display:none when measuring. Call before initialising 
					 // containing tabs for same reason. 


	// portfolio tabs

	// Default Action
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content
	
	// On Click Event
	jQuery("ul.tabs li").click(function() {
		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content
		var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active content
		return false;
	});	
	
	// scroll to top
	jQuery(".backtotop").click(function() {
		jQuery.scrollTo( 0, 500, {easing:'easein'} );
		return false;
	});
	
	// clear input on focus
	jQuery('.clearme').focus(function(){
		if(jQuery(this).val()==this.defaultValue){
			jQuery(this).val('');
		}
	});
	
	// if field is empty afterward, add text again
	jQuery('.clearme').blur(function(){
		if(jQuery(this).val()==''){
			jQuery(this).val(this.defaultValue);
		}
	});

	// top drawer
	jQuery('#topslider').css({
		display: 'block',
		marginTop: -jQuery('#topslider').height()
	});
	
	var openclose = 'close';
	
	jQuery('.topslidertoggle').toggle( function() {
		jQuery('.topslidertoggle').addClass('active');
		jQuery('.topslidertoggle').html('Close');		
		jQuery('#topslider').animate({
			marginTop: 0
		}, 900, 'bounceout');
		openclose = 'open';
	}, function () {
		jQuery('.topslidertoggle').removeClass('active');
		jQuery('.topslidertoggle').html('Open');
		jQuery('#topslider').animate({
			marginTop: -jQuery('#topslider').outerHeight()
		}, 900, 'bounceout');
		openclose = 'close';
	});	
	
        /* old script for mobile menu */
//	jQuery('.menu-toggle').toggle( function() {
//		jQuery('#nav').css('display', 'block');
//		jQuery('#menutoggle').addClass('active');
//		jQuery('body').append('<div class="overlay"></div');
//	}, function () {
//		jQuery('#nav').css('display', 'none');
//		jQuery('#menutoggle').removeClass('active');
//		jQuery('.overlay').remove();
//	});	
//	
//	jQuery('.menu-toggle-close').click( function() {
//		jQuery('#nav').css('display', 'none');
//		jQuery('#menutoggle').removeClass('active');
//		jQuery('.overlay').remove();
//	});
    
        jQuery('.menu-toggle').live('click',function(){
           
            var toggled = jQuery(this).data('toggled');
            jQuery(this).data('toggled', !toggled);
            
            if (!toggled) { 
                showM(); 
            } else {
                hideM(); 
            }
            return false;
            
        });
    
    	jQuery('.menu-toggle-close').click( function() {
        
                jQuery('.menu-toggle').data('toggled', false);
                hideM();
                return false;
	});
    
        jQuery('.post.single p').fitVids();


}); 

function showM(){

//    jQuery('#nav').css('display', 'block');
    jQuery('#nav').toggleClass('displayer');
    jQuery('#menutoggle').addClass('active');
    jQuery('body').append('<div class="overlay"></div');
}
function hideM(){
    
//    jQuery('#nav').css('display', 'none');
    jQuery('#nav').toggleClass('displayer');
    jQuery('#menutoggle').removeClass('active');
    jQuery('.overlay').remove();
}


// PrettyPhoto

jQuery(document).ready(function(){
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
});

function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');
  }
  jQuery('.twitter_update_list').html(statusHTML.join(''));
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}