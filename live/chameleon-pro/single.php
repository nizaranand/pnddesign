<?php

/**

 * The Template for displaying all single posts.

 *

 * @package WordPress

 * @subpackage Chameleon Pro

 */



get_header(); ?>



<!-- CONTENT -->
<?php if (is_single()) { ?>

    <div class="col-0-1-2-3" id="content">
    
<?php } else { ?>    
        
    <div class="<?php echo ft_sidebar_float('content', $post->ID); ?>" id="content">    
        
<?php } ?>





	<?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="col-0-1-3">
                    <?php get_template_part( 'content', 'single' ); ?>
                </div>         
           </div>     
	<?php endwhile; // end of the loop. ?>
    
    
    

	<?php

	// If a user has filled out their description, show a bio on their entries.

	if ( get_the_author_meta( 'description' ) ) : ?>
        <div class="row">
            <div class="col-0-1-3">
                <div class="author-details">

                        <div class="author-avatar">

                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 75 ); ?></a>

                        </div>

                        <div class="author-details-info">
                 <h3 class="author-title">About <span><?php printf( __( '%s', 'twentyten' ), get_the_author() ); ?></span></h3>

                                <?php the_author_meta( 'description' ); ?>	
                    <div id="author-link">
                                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
                                        <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?>
                                        </a>
                                </div><!-- #author-link	-->	

                        </div>

                </div>
            </div>
        </div>    
	<?php endif; ?>	
        <div class="row">
            <div class="col-0-1-3">
                <?php comments_template( '', true ); ?>
            </div>
       </div>     
	

</div>	



<?php get_sidebar(); ?>

<?php get_footer(); ?>