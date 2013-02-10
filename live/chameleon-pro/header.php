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

</script>	

</head>



<body <?php body_class(); ?>>

	

	<div class="wrap" id="fullheadwrap">

	

		<div id="header" class="wrap rewrapping-header"> <!-- Full width wrap -->

			<div class="container"> <!-- fixed width container -->

				

				<div class="logo">

					<?php if(of_get_option('ft_custom_logo') != ''): ?>

						<a href="<?php echo home_url( '/' ); ?>" class="siteinfo logoadded"><img src="<?php echo of_get_option('ft_custom_logo') ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>

					<?php else: ?>

						<a href="<?php echo home_url( '/' ); ?>" class="siteinfo"><?php bloginfo( 'name' ); ?></a>

						<br /><?php if(get_bloginfo('description') != ''): ?><span class="tagline"><?php bloginfo('description'); ?></span><?php endif; ?>

					<?php endif; ?>

				</div>

				

				<?php if(of_get_option('ft_header_display')=='ad' && of_get_option('ft_header_banner_image')): ?>

					<div class="banner-top-full-banner"><a href="<?php echo of_get_option('ft_header_banner_url'); ?>" class="f-thumb"><img src="<?php echo of_get_option('ft_header_banner_image'); ?>" alt="" /></a></div>

				<?php elseif(of_get_option('ft_header_display')=='search'): ?>

					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="topsearch">

						<input type="text" name="s" value="Vous cherchez quelques chose ?" class="clearme" />

						<input type="submit" name="submit" value="" class="btn_search" />

					</form>

				<?php endif; ?>

				

			</div><!-- END container -->

		</div><!-- END wrap -->



		<div id="subHdr" Class="wrap"> <!-- Full width wrap -->

			<div class="container"> <!-- fixed width container -->

            	<div id="sldr">

                 <div class="sldr_first">

					<?php query_posts('cat=28&showposts=1&orderby=rand'); ?>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <div class="head_img"><?php the_post_thumbnail( array(302,302) ); ?></div>

                    <?php endwhile; ?>

                    <?php endif; ?>

                    <?php wp_reset_query(); ?>  

                 </div>

                 

                 <div class="sldr_second">

					<?php query_posts('cat=29&showposts=1&orderby=rand'); ?>

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                        <div class="head_img"><?php the_post_thumbnail( array(302,302) ); ?></div>

                    <?php endwhile; ?>

                    <?php endif; ?>

                    <?php wp_reset_query(); ?>  

                 </div>

                 

                               

                </div>
          
                <div id="sldrRight">

                	<h1>Je veux recevoir <br> les mises &agrave;  jours du <br> blog <bold>gratuitement</bold></h1>

                    <div class="subscriptionForm">

                    <form action="http://pnddesign.us5.list-manage1.com/subscribe/post?u=f426e2c2808875f5655aac7e7&amp;id=836da627b1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

                    	<p><input type="text" value="Entrez votre courriel" class="clearme" name="EMAIL" id="mce-EMAIL"></p>

                        <div id="mce-responses" class="clear">

		<div class="response" id="mce-error-response" style="display:none"></div>

		<div class="response" id="mce-success-response" style="display:none"></div>

	</div>

                    	<p><input type="submit" value="Oui, je le veux" name="subscribe" id="mc-embedded-subscribe"></p>

                        </form>

                       <p>Cette liste est sans spam, c&rsquo;est une promesse.</p>

                    </div>

                </div>

                <div class="clear"></div>

			</div>

		</div>



		<div id="navigation" class="wrap"> <!-- Full width wrap -->

			<div class="container"> <!-- fixed width container -->

                            <div class="nav-menu-button">
                                <a href="#" class="menu-toggle" id="menutoggle" data-toggled="false">
                                    <div class="btn btn-navbar">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </div>
                                    Et plus encore
                                    <span class="caret"></span>
                                </a>
                            </div>

				<!--<a href="#" class="menu-toggle" id="menutoggle">Menu</a>-->

				

				<?php

				

				$socialicons = '';

				

				$socialicons .= '<li class="mobsocial">';

				

				if(of_get_option('ft_email_feedburner')): $socialicons .= '<a href="#" onclick="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='.of_get_option('ft_email_feedburner').'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return false" class="mob-email" target="_blank">Mail</a>';

				elseif(of_get_option('ft_contact_email')): $socialicons .= '<a href="mailto:'.of_get_option('ft_contact_email').'" class="mob-email" target="_blank">Mail</a>'; endif;

				if(of_get_option('ft_facebook')): $socialicons .= '<a href="'.of_get_option('ft_facebook').'" class="mob-fb" target="_blank">Facebook</a>'; endif;

				if(of_get_option('ft_twitter')): $socialicons .= '<a href="http://twitter.com/'.of_get_option('ft_twitter').'" class="mob-tweet" target="_blank">Twitter</a>'; endif;

				if(of_get_option('ft_rss_url')): $socialicons .= '<a href="'.of_get_option('ft_rss_url').'" class="mob-rss" target="_blank">RSS</a>'; endif;

				

				$socialicons .= '</li>';

				

				// check if menu is set

				$menu = wp_nav_menu( array('theme_location' => 'top-nav', 'container' => false, 'menu_id'=> 'nav', 'depth' => '3', 'echo' => 0, 'fallback_cb' => false, 'items_wrap'      => '%3$s')); 

				

				$menu = str_replace('<ul id="nav" class="menu">', '', $menu);

				$menu = substr($menu, 0, -6);

				

				// display menu if there, otherwise get pages and show those

				if($menu):

					echo '<ul id="nav" class="menu">';

					echo $menu;

					echo $socialicons.'<li class="mobcloseli"><a href="#" class="mobclose menu-toggle-close">Close</a></li></ul>';

				else:

					?>

					<ul id="nav">

						<?php wp_list_pages('title_li=&depth=3'); ?>

						<?php echo $socialicons; ?>

						<li><a href="#" class="mobclose menu-toggle-close">Close</a></li>

					</ul>

					<?php

				endif;

				?>

			</div><!-- END container -->

		</div><!-- END wrap -->



	</div>

	

	<div class="wrap"> <!-- Full width wrap -->

		<div class="container"> <!-- fixed width container -->