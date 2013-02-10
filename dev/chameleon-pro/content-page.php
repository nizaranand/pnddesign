<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */
?>

	<!-- MAIN POST -->
	<div class="post clearfix">
		<h1 class="post-title"><?php the_title(); ?></h1>
	
		<?php the_content(); ?>
	</div>