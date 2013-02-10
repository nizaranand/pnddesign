<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the id=main div and all content after
*
* @package WordPress
* @subpackage Chameleon Pro
*/
?>


			
		</div><!-- END container -->
	</div><!-- END wrap -->
	
	<?php if(of_get_option('ft_home_show_footer_widget') == '1'): ?>
	<div id="foot-wrap" class="wrap"> <!-- Full width wrap -->
		<div id="foot-container" class="container"> <!-- fixed width container -->
			
                    <a href="#" class="backtotop">Back to top</a>
                    <div class="footRight">
                        <div class="footBox">
                            <?php dynamic_sidebar( 'footer-author-image' ); ?>
                        </div>
                        <!-- First Col -->
			<div class="col-6">
				<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>			
					<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
				<?php endif; ?>
			</div>
                    </div>	
        
            
			
                         <style> 
			.twiter-posts-boxx ul li { display:block; color:#000000;   }
			.twiter-posts-boxx ul li a { display: inline-block;  }
			</style>
			
			<!-- First Col -->
			<div class="col-7 twiter-posts-boxx" id="sep"">
                       <h3 class="widget-title">Twitter Feed</h3>
				<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>			
					<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
				<?php endif; ?>
			</div>
           
			
			<!-- First Col -->
			<div class="col-8 >
          
				<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>			
					<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
				<?php endif; ?>
			</div>
			
			<!-- First Col -->
			<div class="col-9">
				<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>			
					<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
				<?php endif; ?>
			</div>
			
		</div><!-- END container -->
	</div><!-- END wrap -->
	<?php endif; ?>
	
	<div id="footer" class="wrap"> <!-- Full width wrap -->
		<div class="container"> <!-- fixed width container -->
			
			<div class="logo">
				<a href="<?php echo home_url( '/' ); ?>" class="siteinfo"><?php bloginfo( 'name' ); ?></a>
				<?php if(get_bloginfo('description') != ''): ?><span class="tagline"><?php bloginfo('description'); ?></span><?php endif; ?>
			</div>
			
			<?php if(of_get_option('ft_footer_display')=='ad'): ?>
				<div class="banner-bottom-full-banner"><a href="<?php echo of_get_option('ft_footer_banner_url') ?>" class="f-thumb"><img src="<?php echo of_get_option('ft_footer_banner_image') ?>" alt="" /></a></div>
			<?php elseif(of_get_option('ft_footer_display')=='search'): ?>
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="topsearch">
					<input type="text" name="s" value="Enter search and hit enter!" class="clearme" />
					<input type="submit" name="submit" value=" " class="btn_search" />
				</form>
			<?php endif; ?>
		</div><!-- END container -->
	</div><!-- END wrap -->
	
	<div id="copyright" class="wrap"> <!-- Full width wrap -->
		<div class="container"> <!-- fixed width container -->

			<div class="copy">
				<p class="copyleft"><?php echo (of_get_option('ft_copyright_message')!='') ? of_get_option('ft_copyright_message') : "Copyright " . date('Y') . ' ' . get_bloginfo( 'name' ); ?></p>
			</div>
			
		</div><!-- END container -->
	</div><!-- END wrap -->
		<a href="https://twitter.com/icipascal" class="twitterfollowme" target="_blank" title="Follow Tim on Twitter"></a>
	<?php wp_footer(); ?>
    
    <!-- start Mixpanel -->
	<script type="text/javascript">(function(d,c){var a,b,g,e;a=d.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===d.location.protocol?"https:":"http:")+'//api.mixpanel.com/site_media/js/api/mixpanel.2.js';b=d.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b);c._i=[];c.init=function(a,d,f){var b=c;"undefined"!==typeof f?b=c[f]=[]:f="mixpanel";g="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config".split(" ");

for(e=0;e<g.length;e++)(function(a){b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,0)))}})(g[e]);c._i.push([a,d,f])};window.mixpanel=c})(document,[]);

mixpanel.init("fc0fac2db41a58748927c80ebb63910f");</script><!-- end Mixpanel -->

 

<script type="text/javascript">

 

  var _gaq = _gaq || [];

  _gaq.push(['_setAccount', 'UA-27254901-1']);

  _gaq.push(['_trackPageview']);

 

  (function() {

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

  })();

 

</script>

 

<meta name="bitly-verification" content="f55c6bf667e5"/>

 

<script type="text/javascript">

var _nct = _nct || [];

 

(function() {

var nc = document.createElement('script'); nc.type = 'text/javascript'; nc.async = true;

nc.src = 'http://t.newscurve.com/nct.js';

var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(nc, s);

})();

</script>

</body>
</html>