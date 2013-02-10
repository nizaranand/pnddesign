<?php

/**

 * The template for displaying Archive pages.

 *

 * Used to display archive-type pages if nothing more specific matches a query.

 * For example, puts together date-based pages if no date.php file exists.

 *

 * Learn more: http://codex.wordpress.org/Template_Hierarchy

 *

 * @package WordPress

 * @subpackage Chameleon Pro

 */



get_header(); ?>



<!-- CONTENT -->

<div class="col-0-1-2-3" id="content">



	<div class="row">

		<div class="searchcriteria">

			<?php if ( is_day() ) : ?>

				<?php printf( __( 'Daily Archives: %s', 'frogblog' ), '<span>' . get_the_date() . '</span>' ); ?>

			<?php elseif ( is_month() ) : ?>

				<?php printf( __( 'Monthly Archives: %s', 'frogblog' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>

			<?php elseif ( is_year() ) : ?>

				<?php printf( __( 'Yearly Archives: %s', 'frogblog' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>

			<?php else : ?>

				<?php _e( 'Blog Archives', 'frogblog' ); ?>

			<?php endif; ?>

			<div class="searchcriteriaarrow"></div>

		</div>

	</div>



	<?php if ( have_posts() ) : ?>



		<?php /* Start the Loop */

		$loopcount = 0;

		?>

		<!-- Row -->

		<div class="row">

			<?php while ( have_posts() ) : the_post(); ?>

						

				<?php if(of_get_option('ft_blog_default') == 'excerpt'): ?>

				

					<div class="col-0-1-3">

				

					<!-- MAIN POST -->

					<div class="post single">

						<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

						<div class="post-details row">

							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 35 ); ?></a>

							<div class="post-details-info">By <?php the_author_posts_link(); ?>, <?php the_date('F jS, Y'); ?> | <?php echo get_the_category_list(', '); ?> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a></div>

						</div>

						<div class="post-excerpt">

							<p><a href="<?php the_permalink(); ?>"><?php

							// get first attached image

							$image_id = "";

							$first_image = $wpdb->get_results("SELECT id, guid FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1");

							

							if ($first_image):

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

							<?php endif; ?></a></p>

							<?php echo frog_the_excerpt_reloaded(50, '<a>,<p>,<img>,<h1>,<h2>,<h3>,<h4>', 'content', FALSE, '...', FALSE, 1); ?>

							<p><a href="<?php the_permalink(); ?>" class="more_link">Lire la Suite &rarr;</a></p>

						</div>

						<div class="date-tag"><span><?php echo the_time('j'); ?></span><?php echo the_time('M'); ?></div>
                          <div class="clear"></div>

					</div><!-- post -->

				

				<?php elseif(of_get_option('ft_blog_default') == 'full'): ?>

				

					<div class="col-0-1-3">

				

					<!-- MAIN POST -->

					<div class="post single">

						<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

						<div class="post-details row">

							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 35 ); ?></a>

							<div class="post-details-info">By <?php the_author_posts_link(); ?>, <?php the_date('F jS, Y'); ?> | <?php echo get_the_category_list(', '); ?> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a></div>

						</div>

						<div class="post-excerpt">

							<p><a href="<?php the_permalink(); ?>"><?php

							// get first attached image

							$image_id = "";

							$first_image = $wpdb->get_results("SELECT id, guid FROM $wpdb->posts WHERE post_parent = '$post->ID' AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1");

							

							if ($first_image):

								$image_id = $first_image[0]->id;

							endif;

							

							if(of_get_option('ft_blog_featured_images_in_post') == '1'): // show image on blog page

							if(has_post_thumbnail()): 

								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post');

								?>

								<img src="<?php echo $image_url[0]; ?>" alt="" class="align_center" />

							<?php elseif(!has_post_thumbnail() && of_get_option('ft_images_automatic') == '1' && $image_id): // no thumbnail, but opted to use first attached image ?>

								<?php $image_url = wp_get_attachment_image_src( $image_id, 'post'); ?>

								<img src="<?php echo $image_url[0]; ?>" alt="" class="alig_left" />

							<?php endif; ?>

							<?php endif; ?></a></p>

							<?php the_content(); ?>

							<p><a href="<?php the_permalink(); ?>" class="more_link">Lire la Suite &rarr;</a></p>

						</div>

						<div class="date-tag"><span><?php echo the_time('j'); ?></span><?php echo the_time('M'); ?></div>
                          <div class="clear"></div>

					</div><!-- post -->

							

				<?php else: ?>

				

					<?php if($loopcount>0 && $loopcount%2==0): ?>

					</div>

					<div class="row">

						<!-- Post -->

						<div class="col-0-1">

					<?php elseif($loopcount==0): ?>

						<!-- Post -->

						<div class="col-0-1">

					<?php else: ?>

						<!-- Post -->

						<div class="col-2-3">

					<?php endif; ?>

				

					<?php

					/* Include the Post-Format-specific template for the content.

					 * If you want to overload this in a child theme then include a file

					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.

					 */

					get_template_part( 'content' );

					?>

					

					<?php endif; ?>

				

				</div>

			<?php 

			$loopcount++;

			endwhile; ?>

		</div>

		

		<?php /* Display navigation to next/previous pages when applicable */ ?>

		<?php if (  $wp_query->max_num_pages > 1 ) : ?>

			<div class="row">

				<?php if (function_exists("emm_paginate")) { emm_paginate(); } // pagination ?>

			</div>

		<?php endif; ?>

	

	<?php else : ?>



		<!-- CONTENT -->

		<div class="col-0-1-2-3" id="content">

		

			<!-- MAIN POST -->

			<div class="post">

			

				<div class="fourofourcontent">

					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'frogblog' ); ?></p>

					<?php get_search_form(); ?>

				</div>

			</div>

		

		</div>

		

	<?php endif; ?>



</div><!-- left-wrap -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>