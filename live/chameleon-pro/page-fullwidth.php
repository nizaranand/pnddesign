<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */

get_header(); ?>
<!-- CONTENT -->
<div class="row" id="content">
	<?php the_post(); ?>
	<?php get_template_part( 'content', 'page' ); ?>
	<?php comments_template( '', true ); ?>
</div>
<?php get_footer(); ?>