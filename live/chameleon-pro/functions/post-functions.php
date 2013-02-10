<?php

/*
*
* Author: FrogsThemes
* File: functions that are used on the back end of a theme
*
*
*/

/* Add a new meta box to the admin menu. */
add_action('admin_menu', 'frog_create_meta_box');

/* Saves the meta box data. */
add_action('save_post', 'frog_save_meta_data');

/**
 * Function for adding meta boxes to the admin.
 * Separate the post and page meta boxes.
*/
function frog_create_meta_box() 
{
	global $theme_name;
	#add_meta_box( 'post-options', __('Chameleon Pro post options'), 'post_options', 'post', 'normal', 'high' );
}

function post_options()
{	
	global $post;
	
	?>
    
	<table class="form-table">
		<tr>
			<th style="width:150px; padding:13px 10px 10px 10px;">
				<label for="columns">Show in 'Latest News' slider?</label>
			</th>
			<td>
				<select name="_wp_showonhomepage" id="_wp_showonhomepage">
				<?php 
				
				$options = array('Yes', 'No');
				
				foreach($options as $option)
				{
					?>
					<option <?php if ( htmlentities( get_post_meta( $post->ID, '_wp_showonhomepage', true ), ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
						<?php echo $option; ?>
					</option>
					<?php 
				}
				?>
				</select>
				<input type="hidden" name="_wp_showonhomepage_noncename" id="_wp_showonhomepage_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</td>
		</tr>
		<tr>
			<th style="width:150px; padding:13px 10px 10px 10px;">
				<label for="columns">Set as featured post?</label>
			</th>
			<td>
				<select name="_wp_featured_post" id="_wp_featured_post">
				<?php 
				
				$options = array('No', 'Yes');
				
				foreach($options as $option)
				{
					?>
					<option <?php if ( htmlentities( get_post_meta( $post->ID, '_wp_featured_post', true ), ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
						<?php echo $option; ?>
					</option>
					<?php 
				}
				?>
				</select>
				<input type="hidden" name="_wp_featured_post_noncename" id="_wp_featured_post_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}



/**
 * Loops through each meta box's set of variables.
 * Saves them to the database as custom fields.
 *
 */
function frog_save_meta_data( $post_id )
{	
	global $post;
	
	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  	
	// to do anything
  	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
	{
    	return $post_id;
  	}
	
	$postOptions = array('_wp_showonhomepage',
						'_wp_featured_post'
						 );
	
	foreach($postOptions as $optionName)
	{
		if(get_post_meta($post_id, $optionName) == '')
		{
			add_post_meta($post_id, $optionName, stripslashes($_POST[$optionName]), true);
		}
		elseif(stripslashes($_POST[$optionName]) != get_post_meta($post_id, $optionName, true) && stripslashes($_POST[$optionName])!='')
		{
			update_post_meta($post_id, $optionName, stripslashes($_POST[$optionName]));
		}
		elseif(stripslashes($_POST[$optionName])=='' && get_post_meta($post_id, $optionName) == '')
		{
			delete_post_meta($post_id, $optionName, get_post_meta( $post_id, $optionName, true));	
		}
	}
}


//	This function scans the template files of the active theme, 
//	and returns an array of [Template Name => {file}.php]
if(!function_exists('frog_get_post_templates')) 
{
	function frog_get_post_templates() {
		
		$themes = get_themes();
		$theme = get_current_theme();
		$templates = $themes[$theme]['Template Files'];
		$post_templates = array();
	
		$base = array(trailingslashit(get_template_directory()), trailingslashit(get_stylesheet_directory()));
		
		foreach ((array)$templates as $template)
		{
			$template = WP_CONTENT_DIR . str_replace(WP_CONTENT_DIR, '', $template); 
			$basename = str_replace($base, '', $template);
	
			// don't allow template files in subdirectories
			if (false !== strpos($basename, '/'))
				continue;
	
			$template_data = implode('', file( $template ));
			
			$name = '';
			if (preg_match( '|Single Post Template:(.*)$|mi', $template_data, $name))
				$name = _cleanup_header_comment($name[1]);
	
			if (!empty($name)) 
			{
				if(basename($template) != basename(__FILE__))
					$post_templates[trim($name)] = $basename;
			}
		}
		return $post_templates;
	
	}
}

//	build the dropdown items
if(!function_exists('frog_post_templates_dropdown')) 
{
	function frog_post_templates_dropdown() {
		
		global $post;
		$post_templates = frog_get_post_templates();
		
		//loop through templates, make them options
		foreach ($post_templates as $template_name => $template_file) 
		{ 
			if ($template_file == get_post_meta($post->ID, '_wp_post_template', true)) 
			{ 
				$selected = ' selected="selected"'; } else { $selected = ''; 
			}
			$opt = '<option value="' . $template_file . '"' . $selected . '>' . $template_name . '</option>';
			echo $opt;
		}
	}
}

//	Filter the single template value, and replace it with
//	the template chosen by the user, if they chose one.
add_filter('single_template', 'frog_get_post_template');
if(!function_exists('frog_get_post_template'))
{
	function frog_get_post_template($template)
	{	
		global $post;
		
		$custom_field = get_post_meta($post->ID, '_wp_post_template', true);
		
		if(!empty($custom_field) && file_exists(TEMPLATEPATH . "/{$custom_field}")) 
		{ 
			$template = TEMPLATEPATH . "/{$custom_field}"; 
		}
		
		return $template;
	}
}

//	Everything below this is for adding the extra box
//	to the post edit screen so the user can choose a template

//	Adds a custom section to the Post edit screen
add_action('admin_menu', 'frog_pt_add_custom_box');
function frog_pt_add_custom_box() 
{
	if(frog_get_post_templates() && function_exists( 'add_meta_box' )) 
	{
		//add_meta_box( 'pt_post_templates', __( 'Single Post Template', 'pt' ), 'frog_pt_inner_custom_box', 'post', 'normal', 'high' ); //add the boxes under the post
	}
}
   
//	Prints the inner fields for the custom post/page section
function frog_pt_inner_custom_box()
{	
	global $post;
	
	// Use nonce for verification
	echo '<tr>';
	echo '<th style="width:240px; padding:13px 10px 10px 10px;">';
	echo '<label for="post_template">' . __("Choose a template for your post", 'pt' ) . '</label><br />';
	echo '</th>';
	echo '<td>';
	echo '<input type="hidden" name="pt_noncename" id="pt_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	// The actual fields for data entry
	echo '<select name="_wp_post_template" id="post_template" class="dropdown">';
	//echo '<option value="">Default</option>';
	frog_post_templates_dropdown(); //get the options
	echo '</select>';
	echo '</td>';
	echo '</tr>';
}

//	When the post is saved, saves our custom data
add_action('save_post', 'frog_pt_save_postdata', 1, 2); // save the custom fields

function frog_pt_save_postdata($post_id, $post)
{
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['pt_noncename'], plugin_basename(__FILE__) )) 
	{
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( 'page' == $_POST['post_type'] ) 
	{
		if ( !current_user_can( 'edit_page', $post->ID ))
		return $post->ID;
	} 
	else 
	{
		if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	}

	// OK, we're authenticated: we need to find and save the data
	
	// We'll put the data into an array to make it easier to loop though and save
	$mydata['_wp_post_template'] = $_POST['_wp_post_template'];
	// Add values of $mydata as custom fields
	foreach ($mydata as $key => $value) { //Let's cycle through the $mydata array!
		if( $post->post_type == 'revision' ) return; //don't store custom data twice
		$value = implode(',', (array)$value); //if $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { //if the custom field already has a value...
			update_post_meta($post->ID, $key, $value); //...then just update the data
		} else { //if the custom field doesn't have a value...
			add_post_meta($post->ID, $key, $value);//...then add the data
		}
		if(!$value) delete_post_meta($post->ID, $key); //and delete if blank
	}
}


/* sidebar manager options */

function ft_sidebars_add_custom_box() {

	 add_meta_box('ftsidebars', 'FT Sidebars', 'ft_sidebars_custom_box','page', 'side', 'high');
	 add_meta_box('ftsidebars', 'FT Sidebars', 'ft_sidebars_custom_box','post', 'side', 'high');
}

/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'ft_sidebars_add_custom_box');
/* prints the custom field in the new custom post section */
function ft_sidebars_custom_box() {
	
	//get post meta value
	global $post;
	
	$align = get_post_meta($post->ID,'_sidebar_align',true);
	$sidebar = get_post_meta($post->ID,'_dynamic_sidebar',true);
	$enable_sidebar = get_post_meta($post->ID,'_enable_sidebar',true);
	$active_sidebars = get_option("ft_active_sidebars");
	
	if($active_sidebars==''): $active_sidebars = array(); endif;
	
	$sidebar_array = '<select name="dynamic_sidebars"><option value="default">Default</option>';
	foreach($active_sidebars as $bar )
	{
		if($sidebar==$bar)
			$sidebar_array = $sidebar_array."<option value='{$bar}' selected>{$bar}</option>";
		else 
			$sidebar_array = $sidebar_array."<option value='{$bar}'>{$bar}</option>";
	}
	$sidebar_array =  $sidebar_array.'</select>';


	?>
	<div id="sidebar_box">
		<p>
			<label>Sidebar Alignment</label>
			<label for="algin_left">Left</label><input type="radio" id="algin_left" name="align" value="left" <?php if($align=="left") echo "checked='checked'"; ?> />
			<label for="algin_right">Right</label><input type="radio" id="algin_right" name="align" value="right" <?php if($align!="left") echo "checked='checked'"; ?>/>
		</p>
		<p>
			<label for="dynamic_sidebars">Dynamic Sidebars</label>
			<?php echo  $sidebar_array; ?>
		</p>
		<p>
			<label for="">Enable Sidebar</label>
			<label for="sidebar_yes">Yes</label><input type="radio" id="sidebar_yes" name="enable_sidebar" value="true" <?php if($enable_sidebar=="true" || trim($enable_sidebar) =="" ) echo "checked='checked'"; ?> />
			<label for="sidebar_no">No</label><input type="radio" id="sidebar_no" name="enable_sidebar" value="false" <?php if($enable_sidebar=="false") echo "checked='checked'"; ?>/>
		</p>
	</div>
	 
	<?php
}

/* use save_post action to handle data entered */
add_action('save_post', 'ft_sidebars_save_postdata');

/* when the post is saved, save the custom data */
function ft_sidebars_save_postdata($post_id) {
		
	// do not save if this is an auto save routine
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	
	$_POST["align"] = (!isset($_POST["align"])) ? '' : $_POST["align"];
	$_POST["dynamic_sidebars"] = (!isset($_POST["dynamic_sidebars"])) ? '' : $_POST["dynamic_sidebars"];
	$_POST["enable_sidebar"] = (!isset($_POST["enable_sidebar"])) ? '' : $_POST["enable_sidebar"];
	
	update_post_meta($post_id, "_sidebar_align", $_POST["align"]);
	update_post_meta($post_id, "_dynamic_sidebar", $_POST["dynamic_sidebars"]);
	update_post_meta($post_id, "_enable_sidebar", $_POST["enable_sidebar"]);
	
}

function ft_sidebar_float($section, $postid){
	
	$sidebaralign = get_post_meta($postid,'_sidebar_align',true);

	if($sidebaralign == 'left'):
		$sidebarfloat = 'col-0-1 floatL';
		$contentfloat = 'col-2-3-4-5 floatR';
	else:
		$sidebarfloat = 'col-4-5 floatR';
		$contentfloat = 'col-0-1-2-3 floatL';
	endif;
	
	if($section == 'content'):
		return $contentfloat;
	else:
		return $sidebarfloat;
	endif;
}


?>