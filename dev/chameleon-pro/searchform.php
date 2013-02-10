<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" class="searchform">
	<input type="text" name="s" value="Enter search and hit enter!" class="clearme" />
	<input type="submit" name="submit" value="Search" class="submit" />
</form>