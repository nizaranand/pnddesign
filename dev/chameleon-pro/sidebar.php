<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */
?>
        <!-- SIDEBAR -->
        <div class="<?php echo ' '.ft_sidebar_float('sidebar', $post->ID); ?>" id="sidebar">        
            
             <?php dynamic_sidebar( 'blog-sidebar-adds' ); ?>   
             
             <h2 style="font-size:21px; margin-bottom:8px;">Les Plus Populaires</h2>
        	<?php 
			//check if dynamic sidebar added to page
			$dynamicsidebars = get_post_meta($post->ID,'_dynamic_sidebar',true);
			$enableidebars = get_post_meta($post->ID,'_enable_sidebar',true);
			
			// if dynamic sidebar added to page, use that
			if( $dynamicsidebars!="default" && trim($dynamicsidebars)!="" && $enableidebars!='false'):
				dynamic_sidebar($dynamicsidebars); 
			elseif ( is_active_sidebar( 'blog-widget-area' ) && $enableidebars!='false') :	
				dynamic_sidebar( 'blog-widget-area' );
			endif; ?>
            
        </div>