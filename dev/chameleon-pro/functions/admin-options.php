<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Theme colours
	$ft_colour_scheme = array("standard" => "Standard", "white" => "White", "black" => "Black", "red" => "Red", "blue" => "Blue", "purple" => "Purple", "yellow" => "Yellow");
	
	// Nivo slider transitions
	$ft_nivo_effects = array("random" => "Random", "sliceDown" => "Slice Down", "sliceDownLeft" => "Slice Dwon Left", "sliceUp" => "Slice Up", "sliceUpLeft" => "Slice Up Left", "sliceUpDown" => "Slice Up Down", "sliceUpDownLeft" => "Slice Up Down Left", "fold" => "Fold", "fade" => "Fade", "slideInRight" => "Slide In Right", "slideInLeft" => "Slide In Left", "boxRandom" => "Box Random", "boxRain" => "Box Rain", "boxRainReverse" => "Box Rain Reverse", "boxRainGrow" => "Box Rain Grow", "boxRainGrowReverse" => "Bow Rain Grow Reverse");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/functions/images/';
		
	$options = array();
		
	$options[] = array( "name" => "General Settings",
						"type" => "heading");
	
	$options[] = array( "name" => "Custom Logo",
						"desc" => "Upload a logo for your theme or add a URL to a logo elsewhere.",
						"id" => "ft_custom_logo",
						"type" => "upload");
	
	$options[] = array( "name" => "Custom Favicon",
						"desc" => "Paste the URL of a 16 x 16px <a href='http://www.favicon.co.uk/' target=\"_blank\">.ico image</a> for your theme.",
						"id" => "ft_custom_favicon",
						"type" => "text");
	
	$options[] = array( "name" => "Tracking Code",
						"desc" => "Paste your Google Analytics (or other) code in here so it can be added in the footer of your site.",
						"id" => "ft_tracking_code",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "RSS URL",
						"desc" => "Enter your preferred RSS URL here (e.g. http://feeds.feedburner.com/frogsthemes).",
						"id" => "ft_rss_url",
						"std" => "",
						"type" => "text");
					
	$options[] = array( "name" => "E-mail Subscription - Feedburner",
						"desc" => "Enter your Feedburner feed name here (e.g. frogsthemes) to link the top right mail link to your subscription form. If you use a different service other than Feedburner do not use this option.",
						"id" => "ft_email_feedburner",
						"std" => "",
						"type" => "text");						
	
	$options[] = array( "name" => "Styling Options",
						"type" => "heading");
	
	$options[] = array( "name" => "Colour Scheme",
						"desc" => "Select your preferred colour scheme.",
						"id" => "ft_colour_scheme",
						"std" => "standard",
						"type" => "select",
						"options" => $ft_colour_scheme);
	
	$options[] = array( "name" => "Background Image and Colour",
						"desc" => "Change the background styling by selecting a colour/image combination.",
						"id" => "ft_background",
						"std" => $background_defaults, 
						"type" => "background");
	
	$options[] = array( "name" => "Highlight Background Colour",
						"desc" => "Colour that is used for background of highlighted text",
						"id" => "ft_highlight_back",
						"std" => "#FEEA36",
						"type" => "color");
	
	$options[] = array( "name" => "Highlight Text Colour",
						"desc" => "Colour that is used for highlighted text",
						"id" => "ft_highlight_text",
						"std" => "#000000",
						"type" => "color");
	
	$options[] = array( "name" => "Custom CSS",
						"desc" => "Paste your cusotm CSS in here.",
						"id" => "ft_custom_css",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Typography",
						"type" => "heading");
	
	$options[] = array( "name" => "Site Title",
						"desc" => "Select the preferred typography for the blog title of your site.",
						"id" => "ft_typography_blog_title",
						"std" => array('size' => '42px','face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography");
						
	$options[] = array( "name" => "Body Text",
						"desc" => "Select the preferred standard typography for your site.",
						"id" => "ft_typography_paragraph",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
	
	$options[] = array( "name" => "Tagline",
						"desc" => "Select the preferred tagline typography for your site.",
						"id" => "ft_typography_tagline",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H1",
						"desc" => "Select the preferred H1 typography for your site.",
						"id" => "ft_typography_h1",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H2",
						"desc" => "Select the preferred H2 typography for your site.",
						"id" => "ft_typography_h2",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H3",
						"desc" => "Select the preferred H3 typography for your site.",
						"id" => "ft_typography_h3",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H4",
						"desc" => "Select the preferred H4 typography for your site.",
						"id" => "ft_typography_h4",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H5",
						"desc" => "Select the preferred H5 typography for your site.",
						"id" => "ft_typography_h5",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");
						
	$options[] = array( "name" => "H6",
						"desc" => "Select the preferred H6 typography for your site.",
						"id" => "ft_typography_h6",
						"std" => array('face' => 'droid-sans','style' => 'normal', 'color' => ''),
						"type" => "typography_r_2");

	$options[] = array( "name" => "Header",
						"type" => "heading");
	
	$options[] = array( "name" => "Header Display",
						"desc" => "Select which element, if any, you would like to display in the header.",
						"id" => "ft_header_display",
						"std" => "search",
						"type" => "radio",
						"options" => array("ad" => "Banner Advert", "search" => "Search Form", "none" => "None"));
	
	$options[] = array( "name" => "Banner Advert Options",
						"desc" => "If you opted to choose to display the 468x60px banner advert above, please choose the location of the image and add the destination URL below.",
						"type" => "info");
	
	$options[] = array( "name" => "Banner Image Location",
						"desc" => "Upload a banner image or enter the URL of an image.",
						"id" => "ft_header_banner_image",
						"type" => "upload");
	
	$options[] = array( "name" => "Banner Destination URL",
						"desc" => "Enter the destination of the banner link here.",
						"id" => "ft_header_banner_url",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Footer",
						"type" => "heading");
	
	$options[] = array( "name" => "Show Footer Widget Area",
						"desc" => "Check the box to show the footer widget area",
						"id" => "ft_home_show_footer_widget",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Footer Display",
						"desc" => "Select which element, if any, you would like to display in the footer.",
						"id" => "ft_footer_display",
						"std" => "search",
						"type" => "radio",
						"options" => array("ad" => "Banner Advert", "search" => "Search Form", "none" => "None"));
	
	$options[] = array( "name" => "Banner Advert Options",
						"desc" => "If you opted to choose to display the 468x60px banner advert above, please choose the location fo the image and add the destination URL below.",
						"type" => "info");
	
	$options[] = array( "name" => "Banner Image Location",
						"desc" => "Upload a banner image or enter the URL of an image.",
						"id" => "ft_footer_banner_image",
						"type" => "upload");
						
	$options[] = array( "name" => "Footer Author Image",
						"desc" => "Upload a author image for footer.",
						"id" => "ft_footer_author_image",
						"type" => "upload");

	$options[] = array( "name" => "Footer Author Info",
						"desc" => "Enter Author Information in short.",
						"id" => "ft_author_info",
						"std" => "",
						"type" => "textarea");

	$options[] = array( "name" => "Banner Destination URL",
						"desc" => "Enter the destination of the banner link here.",
						"id" => "ft_footer_banner_url",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Footer Copyright Text",
						"desc" => "Enter the footer Copyright Text here.",
						"id" => "ft_copyright_message",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Blog Options",
						"type" => "heading");
	
	$options[] = array( "name" => "Default View",
						"desc" => "Choose which view you would like as default.",
						"id" => "ft_blog_default",
						"std" => "full",
						"type" => "radio",
						"options" => array("grid" => "Grid View", "excerpt" => "Excerpt View", "full" => "Full Post View"));
	
	$options[] = array( "name" => "Show Latest Post Featured Box?",
						"desc" => "If checked, this will show the featured box on the blog page.",
						"id" => "ft_blog_show_latest_box",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Show Featured Excerpt Thumbs?",
						"desc" => "If checked, this will show a featured thumbnail image in the blog.",
						"id" => "ft_blog_excerpt_thumbs",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show Featured Images in Post?",
						"desc" => "If checked, this will show the featured image in the blog post.",
						"id" => "ft_blog_featured_images_in_post",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Automatic Image Thumbs",
						"desc" => "If checked, this will pull out the first image attached to the post if no featured image is set.",
						"id" => "ft_images_automatic",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Show Share Options?",
						"desc" => "If checked, this will show the share options in the blog post.",
						"id" => "ft_blog_share_option",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show Twitter Share Button?",
						"desc" => "If checked, this will show the Twitter Share Button in the blog post.",
						"id" => "ft_blog_twitter_share",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Show Facebook Like Button?",
						"desc" => "If checked, this will show the Facebook Like Button in the blog post.",
						"id" => "ft_blog_facebook_like",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Show Google+ Button?",
						"desc" => "If checked, this will show the Google+ Button in the blog post.",
						"id" => "ft_blog_google_plus_button",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Contact",
						"type" => "heading");
						
	$options[] = array( "name" => "Contact Form E-mail Address",
						"desc" => "This is the e-mail address that wil be used to send from the contact form template.",
						"id" => "ft_contact_email",
						"std" => "",
						"type" => "text");	
	
	$options[] = array( "name" => "Connections",
						"type" => "heading");
	
	$options[] = array( "name" => "Show Social Links on Site",
						"desc" => "Check this to show the social links you have added throughout the site.",
						"id" => "ft_show_social",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Twitter Username",
						"desc" => "Enter your Twitter username here for use in Twitter widgets (e.g. FrogsThemes).",
						"id" => "ft_twitter",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Facebook URL",
						"desc" => "Enter your full Facebook URL here.",
						"id" => "ft_facebook",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Facebook ID",
						"desc" => "Enter your Facebook ID here. (You can find the by editing your page and seeing the id in the URL)",
						"id" => "ft_facebook_id",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "LinkedIn URL",
						"desc" => "Enter your full LinkedIn URL here.",
						"id" => "ft_linkedin",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "YouTube URL",
						"desc" => "Enter your full YouTube URL here.",
						"id" => "ft_youtube",
						"std" => "",
						"type" => "text");
								
	return $options;
}