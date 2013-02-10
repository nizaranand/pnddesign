<?php
/**
 * @package WordPress
 * @subpackage Chameleon Pro
 */



// shortcodes
include TEMPLATEPATH . '/functions/shortcodes.php';

// custom post types
include TEMPLATEPATH . '/functions/custom-post-types.php';

// theme specific functions
include TEMPLATEPATH . '/functions/theme-functions.php';

// admin functions
include TEMPLATEPATH . '/functions/post-functions.php';

// FT widgets
include TEMPLATEPATH . '/functions/widget-twitter.php';
include TEMPLATEPATH . '/functions/widget-flickr.php';
include TEMPLATEPATH . '/functions/widget-tabbed.php';
include TEMPLATEPATH . '/functions/widget-search.php';
#include TEMPLATEPATH . '/functions/widget-archive.php';

include TEMPLATEPATH . '/functions/widget-dashboard-feed.php';

// theme specific options page
include TEMPLATEPATH . '/functions/admin-options.php';

// theme options framework
define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/functions/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/functions/admin/');
include TEMPLATEPATH . '/functions/admin/options-framework.php';

add_action('wp_head', 'frogs_wp_head');
add_action('wp_footer', 'frogs_wp_footer');
add_action('admin_menu', 'frogs_add_admin');

// ft installer
include TEMPLATEPATH . '/functions/ft-installer/ft-installer.php';

// sidebar manager
include TEMPLATEPATH . '/functions/ft-sidebar-manager/sidebar-manager.php';
include TEMPLATEPATH . '/functions/ft-sidebar-manager/sidebar-init.php';

// include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// if(!is_plugin_active('js_composer/js_composer.php')):
// 	// visual composer
// 	include TEMPLATEPATH . '/functions/init.php';
// endif;

/** Tell WordPress to run ft_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ft_setup' );

if ( ! function_exists( 'ft_setup' ) ):

function ft_setup() {
	
	// allow post thumbnails
	add_theme_support( 'post-thumbnails', array( 'page', 'post' ) ); // Add it for posts
	set_post_thumbnail_size( 220, 161, true );
	add_image_size( 'thumb', 366, 198, true );
	add_image_size( 'thumb50', 50, 50, true );
	add_image_size( 'related', 130, 70, true );
	add_image_size( 'post', 748, 9999 );
	add_image_size( 'logo', 500, 50, true);
	add_image_size( 'blog-featured', 628, 9999);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-nav' => __( 'Top Navigation')
	) );
}
endif;


// function my_print_css() {
//    if ( !is_admin() ) {
//       wp_deregister_style('bootstrap1');
//    }
// }
// add_action('wp_print_styles', 'my_print_css');
?>