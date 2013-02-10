<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */

get_header(); 
?>
<!-- CONTENT -->
<?php if ( 0 ) { ?>
    <div class="<?php echo ft_sidebar_float('content', $post->ID); ?>" id="content">
<?php } ?>    
<div class="col-0-1-2-3" id="content">
        
	<?php the_post(); ?>
	<?php get_template_part( 'content', 'page' ); ?>
	<?php //comments_template( '', true ); ?>
</div>
<?php get_sidebar('page'); ?>
<?php get_footer(); ?>