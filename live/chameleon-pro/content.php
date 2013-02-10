<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Chameleon Pro
 */
?>


	<div class="post excerpt-post">
		
		<?php if(of_get_option('ft_blog_excerpt_thumbs') == '1'): ?>
			<?php 
			
			// get first attached image
			$image_id = "";
			$first_image = $wpdb->get_results("SELECT id, guid FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1");
			
			if ($first_image):
				$image_id = $first_image[0]->id;
			endif;
			
			if(has_post_thumbnail()): // featured thumbnail set
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumb');
				?>
				<div class="post-img portfolio-image-hover">
					<a href="<?php the_permalink(); ?>">
						<span class="dark-background"></span>
						<img src="<?php echo $image_url[0]; ?>" alt="" class="imageHover" />
					</a>
				</div>
			<?php elseif(!has_post_thumbnail() && of_get_option('ft_images_automatic') == '1' && $image_id): // no thumbnail, but opted to use first attached image ?>
				<?php $image_url = wp_get_attachment_image_src( $image_id, 'thumb'); ?>
				<div class="post-img portfolio-image-hover">
					<a href="<?php the_permalink(); ?>">
						<span class="dark-background"></span>
						<img src="<?php echo $image_url[0]; ?>" alt="" class="imageHover" />
					</a>
				</div>
			<?php else: // no image attached, use default ?>
				<div class="post-img portfolio-image-hover">
					<a href="<?php the_permalink(); ?>">
						<span class="dark-background"></span>
						<img src="<?php bloginfo('template_directory'); ?>/assets/images/excerpt-post-img.png" alt="" class="imageHover" />
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="post-excerpt">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><a href="<?php the_permalink(); ?>" class="more_link">Lire la Suite &rarr;</a></p>
		</div>
		<div class="date-tag"><span><?php echo get_the_date('j'); ?></span><?php echo get_the_date('M'); ?></div>
	</div><!-- post -->