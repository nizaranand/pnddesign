<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */

get_header(); ?>

<!-- CONTENT -->
<div class="col-0-1-2-3" id="content">

	<!-- MAIN POST -->
	<div class="post">
		<h1 class="post-title fourofour">404</h1>
	
		<div class="fourofourcontent">
			<p class="sorry">Sorry!</p>
			<p class="pagenotfound">Page Not Found</p>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'frogblog' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>

</div>
<?php get_sidebar('page'); ?>
<?php get_footer(); ?>