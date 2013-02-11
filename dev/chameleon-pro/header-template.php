<?php

session_start();

/**

* The Header for our theme.

* @package WordPress

* @subpackage Chameleon Pro

*/

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title><?php

/*

 * Print the <title> tag based on what is being viewed.

 */

global $page, $paged;



wp_title( '|', true, 'right' );



// Add the blog name.

bloginfo( 'name' );



// Add the blog description for the home/front page.

$site_description = get_bloginfo( 'description', 'display' );

if ( $site_description && ( is_home() || is_front_page() ) )

    echo " | $site_description";



?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php if(of_get_option('ft_rss_url')!=''): ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo of_get_option('ft_rss_url'); ?>" />

<?php else: ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

<?php endif; ?>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

<!-- CSS -->

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/base.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/custom.css" type="text/css" media="all" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/320_grid.css" type="text/css" media="screen and (max-width: 320px)" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/720_grid.css" type="text/css" media="screen and (min-width: 720px)" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/986_grid.css" type="text/css" media="screen and (min-width: 986px)" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/986_grid.css" type="text/css" media="screen and (min-width: 1236px)" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/prettyPhoto.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/media-responsive.css" type="text/css" />

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png" />



<?php if (is_single()) { ?>



<?php while (have_posts()) : the_post(); ?>



<link rel="alternate" type="application/rss+xml" title="<?php the_title(); ?> Comments" href="<?php bloginfo('url'); ?>/?feed=rss2&amp;p=<?php the_ID(); ?>" />



<?php endwhile; ?>



<?php rewind_posts(); ?>



<?php } ?> 





<script src="<?php bloginfo('template_directory'); ?>/assets/js/respond.min.js"></script>



<!-- Default Google Webfonts -->

<?php

$arrayGooglFonts = array(

		'droid-sans'  => 'Droid+Sans:400,700',

		'nixie-one'  => 'Nixie+One',

		'tenor-sans'  => 'Tenor+Sans',

		'open-sans-condensed'  => 'Open+Sans+Condensed:300,300italic',

		'news-cycle'  => 'News+Cycle',

		'terminal-dosis-light'  => 'Terminal+Dosis+Light',

		'cabin-sketch'  => 'Cabin+Sketch:700',

		'open-sans'  => 'Open+Sans:400italic,400',

		'buda'  => 'Buda:300',

		'ubuntu'  => 'Ubuntu:400,400italic',

		'lato'  => 'Lato:400,400italic',

		'crimson-text'  => 'Crimson+Text:400,400italic',

		'oswald'  => 'Oswald',

		'lora'  => 'Lora:400,400italic',

		'judson'  => 'Judson',

		'goudy-bookletter-1911'  => 'Goudy+Bookletter+1911',

		'bentham'  => 'Bentham',

		'josefin-slab'  => 'Josefin+Slab:400,400italic',

		'istok-web'  => 'Istok+Web:400,400italic',

		'quattrocento-sans'  => 'Quattrocento+Sans',

		'molengo'  => 'Molengo');



$arrayGoogleFontsUsedAlready = array();



// blog title

if(of_get_option('ft_typography_blog_title')!=''):

	

	foreach(of_get_option('ft_typography_blog_title') as $typ_opts_key=>$typ_opts_val):

		if($typ_opts_val):

			if($typ_opts_key=='face' && array_key_exists($typ_opts_val, $arrayGooglFonts) && !in_array($typ_opts_val, $arrayGoogleFontsUsedAlready)): 

				echo "<link href='http://fonts.googleapis.com/css?family=".$arrayGooglFonts[$typ_opts_val]."&amp;v2' rel='stylesheet' type='text/css'>";

				$arrayGoogleFontsUsedAlready[] = $typ_opts_val;

			endif;

		endif;

	endforeach;



endif;



// heading options

if(of_get_option('ft_typography_heading')!=''):

	

	foreach(of_get_option('ft_typography_heading') as $typ_opts_key=>$typ_opts_val):

		if($typ_opts_val):

			if($typ_opts_key=='face' && array_key_exists($typ_opts_val, $arrayGooglFonts) && !in_array($typ_opts_val, $arrayGoogleFontsUsedAlready)): 

				echo "<link href='http://fonts.googleapis.com/css?family=".$arrayGooglFonts[$typ_opts_val]."&amp;v2' rel='stylesheet' type='text/css'>"; 

				$arrayGoogleFontsUsedAlready[] = $typ_opts_val;

			endif;

		endif;

	endforeach;



endif;



// page_title options

if(of_get_option('ft_typography_page_title')!=''):

	

	foreach(of_get_option('ft_typography_page_title') as $typ_opts_key=>$typ_opts_val):

		if($typ_opts_val):

			if($typ_opts_key=='face' && array_key_exists($typ_opts_val, $arrayGooglFonts) && !in_array($typ_opts_val, $arrayGoogleFontsUsedAlready)): 

				echo "<link href='http://fonts.googleapis.com/css?family=".$arrayGooglFonts[$typ_opts_val]."&amp;v2' rel='stylesheet' type='text/css'>"; 

				$arrayGoogleFontsUsedAlready[] = $typ_opts_val;

			endif;

		endif;

	endforeach;



endif;



// h1 - h6

for($i=1; $i<=6; $i++):

	if(of_get_option('ft_typography_h'.$i)!=''):

		

		foreach(of_get_option('ft_typography_h'.$i) as $typ_opts_key=>$typ_opts_val):

			if($typ_opts_val):

				if($typ_opts_key=='face' && array_key_exists($typ_opts_val, $arrayGooglFonts) && !in_array($typ_opts_val, $arrayGoogleFontsUsedAlready)): 

					echo "<link href='http://fonts.googleapis.com/css?family=".$arrayGooglFonts[$typ_opts_val]."&amp;v2' rel='stylesheet' type='text/css'>"; 

					$arrayGoogleFontsUsedAlready[] = $typ_opts_val;

				endif;

			endif;

		endforeach;

	

	endif;

endfor;



?>



<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php

/* We add some JavaScript to pages with the comment form

 * to support sites with threaded comments (when in use).

 */

if ( is_singular() && get_option( 'thread_comments' ) )

	wp_enqueue_script( 'comment-reply' );



/* Always have wp_head() just before the closing </head>

 * tag of your theme, or you will break many plugins, which

 * generally use this hook to add elements to <head> such

 * as styles, scripts, and meta tags.

 */

wp_head();

	

?>



<script type="text/javascript">

	jQuery.noConflict();
	jQuery(document).ready(function(){
    		
	    	jQuery(".post.single").fitVids();
	});

</script>	

</head>



<body <?php body_class(); ?>>

	



	

	<div class="wrap"> <!-- Full width wrap -->

		<div class="container"> <!-- fixed width container -->
