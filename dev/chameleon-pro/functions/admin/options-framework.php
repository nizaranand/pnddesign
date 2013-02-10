<?php
/*
Plugin Name: Options Framework
Plugin URI: http://www.wptheming.com
Description: A framework for building theme options.
Version: 0.6
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Basic plugin definitions */

define('OPTIONS_FRAMEWORK_VERSION', '0.6');

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little plugin, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'optionsframework_rolescheck' );

function optionsframework_rolescheck () {
	if ( current_user_can('edit_theme_options') ) {
		// If the user can edit theme options, let the fun begin!
		add_action('admin_menu', 'optionsframework_add_page');
		add_action('admin_init', 'optionsframework_init' );
		add_action( 'admin_init', 'optionsframework_mlu_init' );
	}
}

/* 
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments-
 * and it makes it a little easier to change and set up in my opinion.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function optionsframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
	
	// Loads the options array from the theme
	if ( $optionsfile = locate_template( array('options.php') ) ) {
		require_once($optionsfile);
	}
	else if (file_exists( dirname( __FILE__ ) . '/options.php' ) ) {
		require_once dirname( __FILE__ ) . '/options.php';
	}
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Updates the unique option id in the database if it has changed
	optionsframework_option_name();
	
	// Gets the unique id, returning a default if it isn't defined
	$option_name = $optionsframework_settings['id'];
	
	// Set the option defaults in case they have changed
	optionsframework_setdefaults();
	
	// Registers the settings fields and callback
	register_setting('optionsframework', $option_name, 'optionsframework_validate' );
}

/* 
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function optionsframework_setdefaults() {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */

	if ( isset($optionsframework_settings['knownoptions']) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option('optionsframework', $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option('optionsframework', $optionsframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = optionsframework_options();
		
	// If the options haven't been added to the database yet, they are added now
	foreach ($options as $option) {
	
		if ( ($option['type'] != 'heading') && ($option['type'] != 'info') ) {
			$option_id = preg_replace('/\W/', '', strtolower($option['id']) );
			
			// wp_filter_post_kses for strings
			if (isset($option['std' ]) ) {
				if ( !is_array($option['std' ]) ) {
					$values[$option_id] = wp_filter_post_kses($option['std']);
				} else {
					foreach ($option['std' ] as $key => $value) {
						$optionarray[$key] = wp_filter_post_kses($value);
					}
					$values[$option_id] = $optionarray;
					unset($optionarray);
				}
			} else {
				$value = '';
			}
		}
	}
	if(get_option($option_name)===false) {
		add_option($option_name, $values);
	}
	else{
		#update_option($option_name, $values);
		#die(var_dump($values));
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */

if ( !function_exists( 'optionsframework_add_page' ) ) {
	function optionsframework_add_page() {
		
		$themename = get_theme_data(STYLESHEETPATH . '/style.css');
		$themename = $themename['Name'];
		
		if(function_exists( 'add_object_page'))
		{
			add_object_page ($themename, $themename, 'manage_options', 'frogsthemes', 'optionsframework_page', get_bloginfo('template_directory').'/assets/images/icon.png', '3');
		}
		else
		{
			add_menu_page($themename, $themename, 'manage_options', 'frogsthemes_home', 'optionsframework_page', get_bloginfo('template_directory').'/assets/images/icon.png', '3');
		}
		
		$of_page = add_submenu_page("frogsthemes", "Theme Options", "Theme Options", "manage_options", "frogsthemes", "optionsframework_page");
		add_submenu_page("frogsthemes", "Sidebar Manager", "Sidebar Manager", "manage_options", "frogsthemes_sidebar", "frogsthemes_sidebar");
		#add_submenu_page("frogsthemes", "Ads Manager", "Ads Manager", "manage_options", "frogsthemes_ads", "frogsthemes_ads");
		add_submenu_page("frogsthemes", "FT Installer", "FT Installer", "manage_options", "frogsthemes_installer", "frogsthemes_installer");
		
		// Adds actions to hook in the required css and javascript
		add_action("admin_print_styles-$of_page",'optionsframework_load_styles');
		add_action("admin_print_scripts-$of_page", 'optionsframework_load_scripts');
				
		// Adds actions to hook in the required css and javascript
		add_action( "admin_print_styles-$of_page", 'optionsframework_mlu_css', 0 );
		add_action( "admin_print_scripts-$of_page", 'optionsframework_mlu_js', 0 );	
		
	}
}

/**
 * Add Theme Options menu item to Admin Bar.
 */

function add_root_menu($name, $id, $href = FALSE)
{
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	
	$wp_admin_bar->add_menu( array(
	'id' => $id,
	'title' => $name,
	'href' => $href ) );
}

function add_sub_menu($name, $link, $root_menu, $meta = FALSE)
{
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
	return;
	
	$wp_admin_bar->add_menu( array(
	'parent' => $root_menu,
	'title' => $name,
	'href' => $link,
	'meta' => $meta) );
}

add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );

function optionsframework_adminbar() {
	
	add_root_menu("Chameleon Pro", "frogsthemes", get_admin_url()."admin.php?page=frogsthemes");
    add_sub_menu("Theme Options", get_admin_url()."admin.php?page=frogsthemes", "frogsthemes");
	add_sub_menu("Sidebar Manager", get_admin_url()."admin.php?page=frogsthemes_sidebar", "frogsthemes");
	#add_sub_menu("Ads Manager", get_admin_url()."admin.php?page=frogsthemes_ads", "frogsthemes");
	add_sub_menu("FT Installer", get_admin_url()."admin.php?page=frogsthemes_installer", "frogsthemes");
}

/* Loads the CSS */

function optionsframework_load_styles() {
	wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/admin-style.css');
	wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY .'css/colorpicker.css');
}	

/* Loads the javascript */

function optionsframework_load_scripts() {

	// Inline scripts from options-interface.php
	add_action('admin_head', 'of_admin_head');
	
	// Enqueued scripts
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY . 'js/colorpicker.js', array('jquery'));
	wp_enqueue_script('options-custom', OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js', array('jquery'));
}

function of_admin_head() {

	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'optionsframework_page' ) ) {
function optionsframework_page() {

	// Get the theme name so we can display it up top
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	
	settings_errors();
	?>
    
	<div class="wrap">
    
    <div id="of_container">
       <form action="options.php" method="post">
	  <?php settings_fields('optionsframework'); ?>

        <div id="header">
          <div class="logo">
            <h2><a href="http://www.frogsthemes.com" target="_blank">FrogsThemes.com</a></h2>
          </div>
		  <div class="version">
		  <?php esc_html_e( $themename ); ?><br /><span>Version 1.0.2</span>
		  </div>
          <div class="clear"></div>
        </div>
		<div id="headernav">
			<ul>
				<li class="changelog"><a href="http://wiki.frogsthemes.com/documentation/chameleon-pro/chameleon-pro-change-log" target="_blank">View Changelog</a></li>
				<li class="themedocs"><a href="http://wiki.frogsthemes.com/category/documentation/chameleon-pro" target="_blank">View Theme Docs</a></li>
				<li class="support"><a href="http://www.frogsthemes.com/support" target="_blank">Support</a></li>
			</ul>
			<input type="submit" class="saveheader reset-button button-secondary" name="update" value="<?php esc_attr_e( 'Save All Changes' ); ?>" />
		</div>
        <div id="main">
        <?php $return = optionsframework_fields(); ?>
          <div id="of-nav">
            <ul>
              <?php echo $return[1]; ?>
            </ul>
          </div>
          <div id="content">
            <?php echo $return[0]; /* Settings */ ?>
          </div>
          <div class="clear"></div>
        </div>
        <div class="of_admin_bar">
			<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options' ); ?>" />
            <input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!' ) ); ?>' );" />
		</div>
<div class="clear"></div>
	</form>
</div> <!-- / #container -->  
</div> <!-- / .wrap -->

<?php
}
}

/* 
 * Data sanitization!
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 */

function optionsframework_validate($input) {

	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	// If the reset button was clicked
	if (!empty($_POST['reset'])) {
		// If options are deleted sucessfully update the error message
		if (delete_option($option_name) ) {
			add_settings_error('options-framework', 'restore_defaults', __('Default options restored.'), 'updated fade');
		}
	}
	
	else
	
	{
	
	if (!empty($_POST['update'])) {
	
		$clean = array();

		// Get the options array we have defined in options.php
		$options = optionsframework_options();
		
		foreach ($options as $option) {
			
			// Verify that the option has an id
			if ( isset ($option['id']) ) {
			
				// Keep all ids lowercase with no spaces
				$id = preg_replace( '/\W/', '', strtolower( $option['id'] ) );
			
				// Set checkbox to false if it wasn't sent in the $_POST
				if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
					$input[$id] = "0";
				}
				
				// Set each item in the multicheck to false if it wasn't sent in the $_POST
				if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
					foreach ( $option['options'] as $key => $value ) {
						$input[$id][$key] = "0";
					} 
				}
				
				// For a value to be submitted to database it must pass through a sanitization filter
				if ( isset ( $input[$id] ) && has_filter('of_sanitize_' . $option['type']) ) {
					$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
				}
				
			} // end isset $input
			
		} // end isset $id
		
	} // end foreach
	
	if ( isset($clean) ) {
		add_settings_error('options-framework', 'save_options', __('Options saved.'), 'updated fade');
		return $clean; // Return validated input
	}
	
	} // end $_POST['update']
	
}


/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */
	
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
	
	if ( !empty($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}