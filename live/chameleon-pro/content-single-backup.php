<?php

/**

 * The template for displaying content in the single.php template

 *

 * @package WordPress

 * @subpackage Chameleon Pro

 */

?>



<!-- MAIN POST -->

<div class="post single">

	<div class="date-tag"><span><?php echo get_the_date('j'); ?></span><?php echo get_the_date('M'); ?></div>

	

	<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

	

	<div class="post-details row">

		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 35 ); ?></a>

		<div class="post-details-info">By <?php the_author_posts_link(); ?>, <?php the_date('F jS, Y'); ?> | <?php echo get_the_category_list(', '); ?> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a></div>

	</div>

	

	<?php

	// get first attached image

	$image_id = "";

	$first_image = $wpdb->get_results("SELECT id, guid FROM $wpdb->posts WHERE post_parent = '".$post->ID."' AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1");

	

	if($first_image):

		$image_id = $first_image[0]->id;

	endif;

	

	if(of_get_option('ft_blog_featured_images_in_post') == '1'): // show image on blog page

	if(has_post_thumbnail()): 

		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post');

		?>

		<img src="<?php echo $image_url[0]; ?>" alt="" class="align_center" />

	<?php elseif(!has_post_thumbnail() && of_get_option('ft_images_automatic') == '1' && $image_id): // no thumbnail, but opted to use first attached image ?>

		<?php $image_url = wp_get_attachment_image_src( $image_id, 'post'); ?>

		<img src="<?php echo $image_url[0]; ?>" alt="" class="align_center" />

	<?php endif; ?>

	<?php endif; ?>

	

	<?php the_content(); ?>

	

	<?php if(of_get_option('ft_blog_share_option')): ?>

	<!-- AddThis Button BEGIN -->

	<div class="addthis_toolbox addthis_default_style">

	<?php if(of_get_option('ft_blog_facebook_like')): ?><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a><?php endif; ?>

	<?php if(of_get_option('ft_blog_twitter_share')): ?><a class="addthis_button_tweet"></a><?php endif; ?>

	<?php if(of_get_option('ft_blog_google_plus_button')): ?><a class="addthis_button_google_plusone" g:plusone:size="medium"></a><?php endif; ?>

	<a class="addthis_counter addthis_pill_style"></a>

	</div>

	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e96fb8d06020c47"></script>

	<!-- AddThis Button END -->

	<?php endif; ?>



	<?php

	// If a user has filled out their description, show a bio on their entries.

	if ( get_the_author_meta( 'description' ) ) : ?>

	<div class="author-details">

		<div class="author-avatar">

			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 75 ); ?></a>

		</div>

		<div class="author-details-info">

			<?php the_author_meta( 'description' ); ?>		

		</div>

	</div>

	<?php endif; ?>

	

</div><!-- post -->