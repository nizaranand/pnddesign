<?php



/*

*

* Author: FrogsThemes

* File: functions that are used on the front end of the theme

*

*

*/



/* add options page to the theme admin */

function frogs_add_admin() {





}



/* initialise scripts and css */

function frogs_init() {



	$file_dir=get_bloginfo('template_directory');

	if(!is_admin()):

		wp_deregister_script('jquery');

		wp_register_script('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js", false, false);

		wp_enqueue_script('jquery');

	endif;

}

// function my_print_css() {
// 	$template_dir = get_bloginfo('template_directory');
//     wp_deregister_style('bootstrap');
// }
// add_action('wp_enqueue_styles', 'my_print_css');

function frogs_loadscripts(){

		

	$template_dir = get_bloginfo('template_directory');



	wp_deregister_script('jquery');

	wp_register_script('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js", false, false);

	wp_enqueue_script('jquery');

	

	wp_deregister_script('jquerycycle');

	wp_register_script('jquerycycle', "http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.2.74.js", false, false);

	wp_enqueue_script('jquerycycle');

	

	wp_deregister_script('plusone');

	wp_register_script('plusone', "https://apis.google.com/js/plusone.js", false, false);

	wp_enqueue_script('plusone');

	

	wp_enqueue_script('easing', $template_dir . '/assets/js/jquery.easing.js', array('jquery'));

	wp_enqueue_script('hoverintent', $template_dir . '/assets/js/hoverIntent.js', array('jquery'));

	wp_enqueue_script('superfish', $template_dir . '/assets/js/superfish.js', array('jquery'));

	wp_enqueue_script('jqueryprettyPhoto', $template_dir . '/assets/js/jquery.prettyPhoto.js', array('jquery'));

	wp_enqueue_script('supersubs', $template_dir . '/assets/js/supersubs.js', array('jquery'));

	wp_enqueue_script('scrollto', $template_dir . '/assets/js/jquery.scrollto.js', array('jquery'));

        wp_enqueue_script('fitvids',           $template_dir . '/assets/js/jquery.fitvids.min.js');
        
	wp_enqueue_script('main', $template_dir . '/assets/js/default.js', array('jquery','jqueryprettyPhoto','easing','hoverintent','superfish','supersubs', 'scrollto'));	

}

add_action('wp_enqueue_scripts', 'frogs_loadscripts');



/* goes into wp_head(); */

function frogs_wp_head()

{

	

	// stylesheet selector

	if($_REQUEST['style'])

	{

		$style = $_REQUEST['style'];

		$_SESSION['style'] = $style;

	}

	elseif($_SESSION['style']!='')

	{

		$style = $_SESSION['style'];

	}

	else

	{

		$style = of_get_option('ft_colour_scheme');

	}

	

	// get stylesheet

	if ($style!='') 

	{

		echo '<link href="'. get_bloginfo('template_directory') .'/styles/'.$style.'/css/'.$style.'.css" rel="stylesheet" type="text/css" />'."\n";

		echo '<link href="'. get_bloginfo('template_directory') .'/styles/'.$style.'/css/'.$style.'_320_grid.css" rel="stylesheet" type="text/css" media="screen and (max-width: 320px)" />'."\n";

	}



	// custom favicon

	if(of_get_option('ft_custom_favicon') != '') 

	{

		echo '<link rel="shortcut icon" href="'.  of_get_option('ft_custom_favicon')  .'"/>'."\n";

	}

	

	if(of_get_option('ft_custom_css') || of_get_option('ft_background') || of_get_option('ft_highlight_back') || of_get_option('ft_highlight_text') || of_get_option('ft_typography_heading') || of_get_option('ft_typography_paragraph') || of_get_option('ft_typography_page_title') || of_get_option('ft_typography_blog_title')):

	

		echo "\n<style type=\"text/css\">";

	

		// custom css

		if(of_get_option('ft_custom_css')!=''):

			echo "\n" . of_get_option('ft_custom_css');

		endif;

		

		// background options

		if(of_get_option('ft_background')!=''):

			

			echo "\nbody{";

				foreach(of_get_option('ft_background') as $back_opts_key=>$back_opts_val):

					if($back_opts_val):

					if($back_opts_key=='color'): echo 'background-color:'.$back_opts_val.';'; endif;

					if($back_opts_key=='image'): echo 'background-image:url('.$back_opts_val.');'; endif;

					if($back_opts_key=='repeat'): if($back_opts_val=='none'): echo 'background-repeat:no-repeat;'; else: echo 'background-repeat:'.$back_opts_val.';'; endif; endif;

					if($back_opts_key=='position'): echo 'background-position:'.$back_opts_val.';'; endif;

					if($back_opts_key=='attachment'): echo 'background-attachment:'.$back_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// content background

		if(of_get_option('ft_content_bg_image')!=''):

			

			echo "\n#full-wrap-cont{";

				echo 'background:url('.of_get_option('ft_content_bg_image').') repeat-y center top;';

			echo "}\n";

		

		endif;

		

		// hide content background

		if(of_get_option('ft_show_content_bg_image')!='1'):

			

			echo "\n#full-wrap-cont{";

				echo 'background:none;';

			echo "}\n";

		

		endif;

		

		// highlight

		if(of_get_option('ft_highlight_back')!=''):

			echo "\n::selection, ::-moz-selection, .highlight { background-color:".of_get_option('ft_highlight_back')."; }";

		endif;

		if(of_get_option('ft_highlight_text')!=''):

			echo "\n::selection, ::-moz-selection, .highlight { color:".of_get_option('ft_highlight_text')."; }";

		endif;



		$typo_array = array(

		'arial'     => 'Arial, Helvetica, sans-serif',

		'verdana'   => 'Verdana, Geneva, sans-serif',

		'trebuchet' => '"Trebuchet MS", Arial, Helvetica, sans-serif',

		'georgia'   => 'Georgia, "Times New Roman", Times, serif',

		'times'     => '"Times New Roman", Times, serif',

		'tahoma'    => 'Tahoma, Geneva, sans-serif',

		'palatino'  => '"Palatino Linotype", "Book Antiqua", Palatino, serif',

		'droid-sans'=> 'Droid+Sans:400,700',

		'helvetica' => 'Helvetica*',

		'nixie-one'  => "'Nixie One', cursive",

		'tenor-sans'  => "'Tenor Sans', cursive",

		'open-sans-condensed'  => "'Open Sans Condensed', sans-serif",

		'news-cycle'  => "'News Cycle', sans-serif",

		'terminal-dosis-light'  => "'Terminal Dosis Light', sans-serif",

		'cabin-sketch'  => "'Cabin Sketch', cursive",

		'open-sans'  => "'Open Sans', sans-serif",

		'buda'  => "'Buda', sans-serif",

		'ubuntu'  => "'Ubuntu', sans-serif",

		'lato'  => "'Lato', sans-serif",

		'crimson-text'  => "'Crimson Text', serif",

		'oswald'  => "'Oswald', sans-serif",

		'lora'  => "'Lora', serif",

		'judson'  => "'Judson', serif",

		'goudy-bookletter-1911'  => "'Goudy Bookletter 1911', serif",

		'bentham'  => "'Bentham', serif",

		'josefin-slab'  => "'Bentham', serif",

		'istok-web'  => "'Istok Web', sans-serif",

		'quattrocento-sans'  => "'Quattrocento Sans', sans-serif",

		'molengo'  => "'Molengo', sans-serif");

		

		// blog title options

		if(of_get_option('ft_typography_blog_title')!=''):

			

			echo "\n.logo a.siteinfo{";

				foreach(of_get_option('ft_typography_blog_title') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='size'): echo 'font-size:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// tagline options

		if(of_get_option('ft_typography_tagline')!=''):

			

			echo "\n.logo span.tagline{";

				foreach(of_get_option('ft_typography_tagline') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h1 options

		if(of_get_option('ft_typography_h1')!=''):

			

			echo "\nh1, h1.post-title{";

				foreach(of_get_option('ft_typography_h1') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h2 options

		if(of_get_option('ft_typography_h2')!=''):

			

			echo "\nh2, .post h2.post-title, .post h2.post-title a, h2.widget-title {";

				foreach(of_get_option('ft_typography_h2') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h3 options

		if(of_get_option('ft_typography_h3')!=''):

			

			echo "\nh3, h3.widget-title {";

				foreach(of_get_option('ft_typography_h3') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h4 options

		if(of_get_option('ft_typography_h4')!=''):

			

			echo "\nh4 {";

				foreach(of_get_option('ft_typography_h4') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h5 options

		if(of_get_option('ft_typography_h5')!=''):

			

			echo "\nh5 {";

				foreach(of_get_option('ft_typography_h5') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// h6 options

		if(of_get_option('ft_typography_h6')!=''):

			

			echo "\nh6 {";

				foreach(of_get_option('ft_typography_h6') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		// paragraph options

		if(of_get_option('ft_typography_paragraph')!=''):

			

			echo "\n body, .portfolio-intro p{";

				foreach(of_get_option('ft_typography_paragraph') as $typ_opts_key=>$typ_opts_val):

					if($typ_opts_val):

					if($typ_opts_key=='face'): echo 'font-family:'.$typo_array[$typ_opts_val].';'; endif;

					if($typ_opts_key=='style'): echo 'font-style:'.$typ_opts_val.';'; endif;

					if($typ_opts_key=='color'): echo 'color:'.$typ_opts_val.';'; endif;

					endif;

				endforeach;

			echo "}\n";

		

		endif;

		

		echo "</style>\n";

		

	endif;

	

}



/* goes into wp_footer(); */

function frogs_wp_footer()

{	

	if(of_get_option('ft_tracking_code'))

	{

		echo "\n<script type=\"text/javascript\">\n" . of_get_option('ft_tracking_code') . "</script>\n";

	}

}



// initialise widget areas

function ft_widgets_init() {

	

	// sidebar widget area for the blog

	register_sidebar( array(

		'name' => __( 'Blog Widget Area'),

		'id' => 'blog-widget-area',

		'description' => __( 'The blog sidebar widget area'),

		'before_widget' => '<div class="row"><div class="widget">',

		'after_widget' => '</div></div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	// sidebar widget area for a page

	register_sidebar( array(

		'name' => __( 'Page Widget Area'),

		'id' => 'page-widget-area',

		'description' => __( 'The page sidebar widget area'),

		'before_widget' => '<div class="row"><div class="widget">',

		'after_widget' => '</div></div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// footer widget areas

	register_sidebar( array(

		'name' => __( 'First Footer Widget Area'),

		'id' => 'first-footer-widget-area',

		'description' => __( 'The first footer widget area'),

		'before_widget' => '<div class="f-widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	register_sidebar( array(

		'name' => __( 'Second Footer Widget Area'),

		'id' => 'second-footer-widget-area',

		'description' => __( 'The second footer widget area'),

		'before_widget' => '<div class="f-widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	register_sidebar( array(

		'name' => __('Third Footer Widget Area'),

		'id' => 'third-footer-widget-area',

		'description' => __('The third footer widget area'),

		'before_widget' => '<div class="f-widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	register_sidebar( array(

		'name' => __('Fourth Footer Widget Area'),

		'id' => 'fourth-footer-widget-area',

		'description' => __('The fourth footer widget area'),

		'before_widget' => '<div class="f-widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );
	
	// sidebar widget area for the blog adds

	register_sidebar( array(

		'name' => __( 'Blog Sidebar Adds'),

		'id' => 'blog-sidebar-adds',

		'description' => __( 'The blog sidebar adds area'),

		'before_widget' => '<div class="adds">',

		'after_widget' => '</div>',

		'before_title' => '<h3>',

		'after_title' => '</h3>',

	) );
	
	// Footer Author widget area for the blog adds

	register_sidebar( array(

		'name' => __( 'Footer Author Image'),

		'id' => 'footer-author-image',

		'description' => __( 'The Footer Author Image area'),

		'before_widget' => '<div class="authImageBox">',

		'after_widget' => '</div>',

		'before_title' => '<h3>',

		'after_title' => '</h3>',

	) );

}

add_action( 'widgets_init', 'ft_widgets_init' );



if ( ! function_exists( 'ft_comment' ) ) :

/**

 * Template for comments and pingbacks.

 */

function ft_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case '' :

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		

		<div class="avatarwrap"><?php echo get_avatar( $comment, 50 ); ?></div>

		<div class="commentcontent post">

			<div class="commentarrow"></div>

			<p class="commentator"><?php printf( __( '%s'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> Says: <?php comment_date('F j, Y') ?> at <?php comment_date('g:i a') ?></p>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.'); ?></em>

				<br />

			<?php endif; ?>

			<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		</div>



	<?php

			break;

		case 'pingback'  :

		case 'trackback' :

	?>

	<li class="post pingback">

		<p><?php _e( 'Pingback:'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)'), ' ' ); ?></p>

	<?php

			break;

	endswitch;

}

endif;



function ft_breadcrumbs() {

 

  $delimiter = '&gt;';

  $home = 'Home'; // text for the 'Home' link

  $before = '<span class="current">'; // tag before the current crumb

  $after = '</span>'; // tag after the current crumb

 

  if ( !is_home() && !is_front_page() || is_paged() ) {

 

    echo '<ul id="breadcrumb">';

 

    global $post;

    $homeLink = get_bloginfo('url');

    echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li>';

 

    if ( is_category() ) {

      global $wp_query;

      $cat_obj = $wp_query->get_queried_object();

      $thisCat = $cat_obj->term_id;

      $thisCat = get_category($thisCat);

      $parentCat = get_category($thisCat->parent);

      if ($thisCat->parent != 0) echo('<li>'.get_category_parents($parentCat, TRUE, ' '.$delimiter.' ').'</li>');

      echo '<li>'.$before . '' . single_cat_title('', false) . '' . $after.'</li>';

 

    } elseif ( is_day() ) {

      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';

      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li>';

      echo '<li>'.$before . get_the_time('d') . $after.'</li>';

 

    } elseif ( is_month() ) {

      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li>';

      echo '<li>'.$before . get_the_time('F') . $after.'</li>';

 

    } elseif ( is_year() ) {

      echo '<li>'.$before . get_the_time('Y') . $after.'</li>';

 

    } elseif ( is_single() && !is_attachment() ) {

      if ( get_post_type() != 'post' ) {

        $post_type = get_post_type_object(get_post_type());

        $slug = $post_type->rewrite;

        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . '</li>';

        echo '<li>'.$before . get_the_title() . $after.'</li>';

      } else {

        $cat = get_the_category(); $cat = $cat[0];

        echo '<li>'. get_category_parents($cat, TRUE, ' '. $delimiter.' ').'</li>';

        echo '<li>'.$before . get_the_title() . $after.'</li>';

      }

 

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {

      $post_type = get_post_type_object(get_post_type());

      echo '<li>'.$before . $post_type->labels->singular_name . $after.'</li>';

 

    } elseif ( is_attachment() ) {

      $parent = get_post($post->post_parent);

      $cat = get_the_category($parent->ID); $cat = $cat[0];

      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');

      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . '</li>';

      echo '<li>'.$before . get_the_title() . $after.'</li>';

 

    } elseif ( is_page() && !$post->post_parent ) {

      echo '<li>'.$before . get_the_title() . $after.'</li>';

 

    } elseif ( is_page() && $post->post_parent ) {

      $parent_id  = $post->post_parent;

      $breadcrumbs = array();

      while ($parent_id) {

        $page = get_page($parent_id);

        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';

        $parent_id  = $page->post_parent;

      }

      $breadcrumbs = array_reverse($breadcrumbs);

      foreach ($breadcrumbs as $crumb) echo $crumb . '<li>' . $delimiter . '</li>';

      echo '<li>'.$before . get_the_title() . $after.'</li>';

 

    } elseif ( is_search() ) {

      echo '<li>'.$before . 'Search results for "' . get_search_query() . '"' . $after.'</li>';

 

    } elseif ( is_tag() ) {

      echo '<li>'.$before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after.'</li>';

 

    } elseif ( is_author() ) {

       global $author;

      $userdata = get_userdata($author);

      echo '<li>'.$before . 'Articles posted by ' . $userdata->display_name . $after.'</li>';

 

    } elseif ( is_404() ) {

      echo '<li>'.$before . 'Error 404' . $after.'</li>';

    }

 

    echo '</ul>';

 

  }

}



// remove recent comments styles in right column widget

function ft_remove_recent_comments_style() {

	add_filter( 'show_recent_comments_widget_style', '__return_false' );

}

add_action( 'widgets_init', 'ft_remove_recent_comments_style' );



// gets a feed of twitter feed for user and uses frog_twitterify() to format it nicely

function frog_twitter_messages($username = 'frogsthemes')

{

 

	include_once(ABSPATH . WPINC . '/rss.php');

 

	$feed = fetch_feed('http://twitter.com/statuses/user_timeline/'.$username.'.rss');

 

	$i=0;

 

	foreach($feed->get_items() as $item){

		if($i < 3){

 

			$description = trim(str_replace($username . ': ', '', $item->get_description()));

 

			echo '<p>'.frog_twitterify(strip_tags($description)).'</p>';

 

			$i++;

 

		}

	}

}



// change [...] to Continue reading >

function ft_continue_reading_link() {

	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading &gt;') . '</a>';

}



// Ondemand function to generate tinyurl

function getTinyUrl($url) {  

     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  

     return $tinyurl;  

}



// create a facebook share link

function simple_facebook_link($service,$url="") {

    if ($url=="") {$url=get_permalink($post->ID);}

    create_facebook_link($service,$url);

    return;

}

function create_facebook_link($service,$url) {

    $title=urlencode(html_entity_decode(get_the_title($post->ID),ENT_QUOTES,'UTF-8'));

    // Use the Simple URL Shortener plugin to get a short URL

    if (function_exists('simple_url_shortener')) {$url=simple_url_shortener($url,$service);}

    // Now, send the URL and blog title to Facebook

    echo "http://www.facebook.com/sharer.php?u=".$url."&t=".$title;

    return;

}



// nice formatting of twitter post

function frog_twitterify($ret) {

	# thanks to http://www.snipe.net/2009/09/php-twitter-clickable-links/#axzz0psFrJPHB

	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

	$ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);

	$ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);

	return $ret;

}



/* excerpt reloaded functions */

function frog_wp_the_excerpt_reloaded($args='')

{

	parse_str($args);

	if(!isset($excerpt_length)) $excerpt_length = 120; // length of excerpt in words. -1 to display all excerpt/content

	if(!isset($allowedtags)) $allowedtags = '<a>'; // HTML tags allowed in excerpt, 'all' to allow all tags.

	if(!isset($filter_type)) $filter_type = 'none'; // format filter used => 'content', 'excerpt', 'content_rss', 'excerpt_rss', 'none'

	if(!isset($use_more_link)) $use_more_link = 1; // display

	if(!isset($more_link_text)) $more_link_text = "(more...)";

	if(!isset($force_more)) $force_more = 1;

	if(!isset($fakeit)) $fakeit = 1;

	if(!isset($fix_tags)) $fix_tags = 1;

	if(!isset($no_more)) $no_more = 0;

	if(!isset($more_tag)) $more_tag = 'div';

	if(!isset($more_link_title)) $more_link_title = 'Continue reading this entry';

	if(!isset($showdots)) $showdots = 1;



	return frog_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $fix_tags, $no_more, $more_tag, $more_link_title, $showdots);

}



function frog_the_excerpt_reloaded($excerpt_length=120, $allowedtags='<a>', $filter_type='none', $use_more_link=true, $more_link_text="(more...)", $force_more=true, $fakeit=1, $fix_tags=true, $no_more=false, $more_tag='div', $more_link_title='Continue reading this entry', $showdots=true)

{

	if(preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) 

	{

		$filter_type = 'the_' . $filter_type;

	}

	echo frog_get_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $no_more, $more_tag, $more_link_title, $showdots);

}



function frog_get_the_excerpt_reloaded($excerpt_length, $allowedtags, $filter_type, $use_more_link, $more_link_text, $force_more, $fakeit, $no_more, $more_tag, $more_link_title, $showdots) 

{

	global $post;



	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) { // and it doesn't match cookie

			if(is_feed()) { // if this runs in a feed

				$output = __('There is no excerpt because this is a protected post.');

			} else {

	            $output = get_the_password_form();

			}

		}

		return $output;

	}



	if($fakeit == 2) { // force content as excerpt

		$text = $post->post_content;

	} elseif($fakeit == 1) { // content as excerpt, if no excerpt

		$text = (empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { // excerpt no matter what

		$text = $post->post_excerpt;

	}



	if($excerpt_length < 0) 

	{

		$output = $text;

	} 

	else 

	{

		if(!$no_more && strpos($text, '<!--more-->')) 

		{

		    $text = explode('<!--more-->', $text, 2);

			$l = count($text[0]);

			$more_link = 1;

		} 

		else 

		{

			$text = explode(' ', $text);

			if(count($text) > $excerpt_length) 

			{

				$l = $excerpt_length;

				$ellipsis = 1;

			} 

			else 

			{

				$l = count($text);

				$more_link_text = '';

				$ellipsis = 0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . ' ';

	}



	if('all' != $allowed_tags) 

	{

		$output = strip_tags($output, $allowedtags);

	}



	//	$output = str_replace(array("\r\n", "\r", "\n", "  "), " ", $output);

	$output = rtrim($output, "\s\n\t\r\0\x0B");

	$output = ($fix_tags) ? $output : balanceTags($output);

	$output .= ($showdots && $ellipsis) ? '...' : '';



	switch($more_tag) 

	{

		case('div') :

			$tag = 'div';

		break;

		case('span') :

			$tag = 'span';

		break;

		case('p') :

			$tag = 'p';

		break;

		default :

			$tag = 'span';

	}



	if ($use_more_link && $more_link_text)

	{

		if($force_more)

		{

			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '#more-' . $post->ID .'" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";

		} 

		else 

		{

			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";

		}

	}



	$output = apply_filters($filter_type, preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output));



	return $output;

}



/**

 * Retrieve or display pagination code.

 *

 * The defaults for overwriting are:

 * 'page' - Default is null (int). The current page. This function will

 *      automatically determine the value.

 * 'pages' - Default is null (int). The total number of pages. This function will

 *      automatically determine the value.

 * 'range' - Default is 3 (int). The number of page links to show before and after

 *      the current page.

 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 

 *      replaced with ellipses (...).

 * 'anchor' - Default is 1 (int). The number of links to always show at begining

 *      and end of pagination

 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 

 *      to add before the pagination links.

 * 'after' - Default is '</div>' (string). The html or text to add after the

 *      pagination links.

 * 'title' - Default is '__('Pages:')' (string). The text to display before the

 *      pagination links.

 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 

 *      next page link.

 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 

 *      previous page link.

 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this

 *      to 0 (zero).

 *

 * @author Eric Martin <eric@ericmmartin.com>

 * @copyright Copyright (c) 2009, Eric Martin

 * @version 1.0

 *

 * @param array|string $args Optional. Override default arguments.

 * @return string HTML content, if not displaying.

 */

function emm_paginate($args = null) {

	$defaults = array(

		'page' => null, 'pages' => null, 

		'range' => 3, 'gap' => 3, 'anchor' => 1,

		'before' => '<ul class="pagination">', 'after' => '</ul>',

		'title' => __(''),

		'nextpage' => __('Next'), 'previouspage' => __('Previous'),

		'echo' => 1

	);



	$r = wp_parse_args($args, $defaults);

	extract($r, EXTR_SKIP);



	if (!$page && !$pages) {

		global $wp_query;



		$page = get_query_var('paged');

		$page = !empty($page) ? intval($page) : 1;



		$posts_per_page = intval(get_query_var('posts_per_page'));

		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));

	}

	

	$output = "";

	if ($pages > 1) {	

		

		$output .= "$before";

		

		if ($page > 1 && !empty($previouspage)) {

			$output .= "<li class=\"previous\"><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";

		}

		

		$ellipsis = "<li><a href='#'>...</a></li>";



		$min_links = $range * 2 + 1;

		$block_min = min($page - $range, $pages - $min_links);

		$block_high = max($page + $range, $min_links);

		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;

		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;



		if ($left_gap && !$right_gap) {

			$output .= sprintf('%s%s%s', 

				emm_paginate_loop(1, $anchor), 

				$ellipsis, 

				emm_paginate_loop($block_min, $pages, $page)

			);

		}

		else if ($left_gap && $right_gap) {

			$output .= sprintf('%s%s%s%s%s', 

				emm_paginate_loop(1, $anchor), 

				$ellipsis, 

				emm_paginate_loop($block_min, $block_high, $page), 

				$ellipsis, 

				emm_paginate_loop(($pages - $anchor + 1), $pages)

			);

		}

		else if ($right_gap && !$left_gap) {

			$output .= sprintf('%s%s%s', 

				emm_paginate_loop(1, $block_high, $page),

				$ellipsis,

				emm_paginate_loop(($pages - $anchor + 1), $pages)

			);

		}

		else {

			$output .= emm_paginate_loop(1, $pages, $page);

		}

		

		if ($page < $pages && !empty($nextpage)) {

			$output .= "<li class=\"next\"><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";

		}



		$output .= $after;

	}



	if ($echo) {

		echo $output;

	}



	return $output;

}



/**

 * Helper function for pagination which builds the page links.

 *

 * @access private

 *

 * @author Eric Martin <eric@ericmmartin.com>

 * @copyright Copyright (c) 2009, Eric Martin

 * @version 1.0

 *

 * @param int $start The first link page.

 * @param int $max The last link page.

 * @return int $page Optional, default is 0. The current page.

 */

function emm_paginate_loop($start, $max, $page = 0) {

	$output = "";

	for ($i = $start; $i <= $max; $i++) {

		$output .= ($page === intval($i)) 

			? "<li><a href='" . get_pagenum_link($i) . "' class='selected'>$i</li>" 

			: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";

	}

	return $output;

}



/* get number of twitter follwers for given username */

function ft_twitter_followwer_count($username){

	

	$tw = get_option("twitterfollowerscount");

	

	if($tw['lastcheck'] < mktime() - 3600)

	{

		$xml=file_get_contents('http://twitter.com/users/show.xml?screen_name='.$username);

		if (preg_match('/followers_count>(.*)</',$xml,$match)!=0) 

		{

			$tw['count'] = $match[1];

		}

		$tw['lastcheck'] = mktime();

		update_option("twitterfollowerscount",$tw);

	}

	

	return $tw['count'];

}



/* get number of facebok fans for given username */

function ft_facebook_fans($page_id){

	

	$xml = @simplexml_load_file("http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id=".$page_id."") or die ("a lot");

	$fans = $xml->page->fan_count;

	return $fans;

	

}



/* get feedburner subscriber count */

function GetFeedburnerFollowerCount($feed){



	$feedburner_xml = file_get_contents("http://feedburner.google.com/api/awareness/1.0/GetFeedData?dates=".date('Y')."-".date('m')."-".date("d", mktime(0, 0, 0, date("m"),date("d")-2,date("Y")))."&uri=".$feed);

	$xml = new SimpleXmlElement($feedburner_xml, LIBXML_NOCDATA);

	$new_feedburner_followers= $xml->feed->entry['circulation'];

	return $new_feedburner_followers;



}



?>