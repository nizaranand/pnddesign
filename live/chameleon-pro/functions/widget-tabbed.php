<?php

/*
Plugin Name: FT Tabbed Widget
Plugin URI: http://www.frogsthemes.com
Description: Add a tabbed widget to your sidebar.
Author: FrogsThemes.com
Version: 1
Author URI: http://www.frogsthemes.com
*/


class TabbedWidget extends WP_Widget {
    
	/** constructor */
    function TabbedWidget() {
        
		$options = array( 'description' => __('Add a tabbed widget to your sidebar.') );
		
		parent::WP_Widget(false, $name = 'FT Tabbed Widget', $options);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
    	
		global $wpdb;
		extract( $args );

		/* Our variables from the widget settings. */
		$tab1 = $instance['tab1'];
		$tab2 = $instance['tab2'];
		$tab3 = $instance['tab3'];

		//Randomize tab order in a new array
		$tab = array();
		
		?>
        
		<div class="tab-wrap row">
			<ul class="tabs">
				<li id="firsttab"><a href="#tab1"><?php echo $tab1; ?></a></li>
				<li><a href="#tab2"><?php echo $tab2; ?></a></li>
				<li id="lasttab"><a href="#tab3"><?php echo $tab3; ?></a></li>
			</ul>
			
			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<ul class="tab-posts">
						<?php
						
						$recentPosts = new WP_Query();
						$recentPosts->query('cat=-28,-29&caller_get_posts=1&posts_per_page=5');
						while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                       
                        <li>
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>"class="f-thumb"><?php the_post_thumbnail('thumb50'); ?></a>
                            </div><!--image-->
							<?php else: ?>
							<div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="f-thumb"><img src="<?php bloginfo('template_directory'); ?>/assets/images/sml1.jpg" alt="thumb" /></a>
                            </div><!--image-->
                            <?php endif; ?>
                            
                            <div class="tab-post-info">
                                <h3 class="tab-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tab-post-details"><?php //the_time( get_option('date_format') ); ?></div>
                            </div><!--details-->
                        </li>
                        
                        <?php endwhile;?>
						<?php wp_reset_query(); ?>
						
					</ul>
				</div>
				<div id="tab2" class="tab_content">
				  <ul class="tab-posts">
						<?php 
						$popPosts = new WP_Query();
						$popPosts->query('cat=-28,-29&caller_get_posts=1&posts_per_page=5&orderby=comment_count');
						while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
                        
                        <li>
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="f-thumb"><?php the_post_thumbnail('thumb50'); ?></a>
                            </div><!--image-->
							<?php else: ?>
							<div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="f-thumb"><img src="<?php bloginfo('template_directory'); ?>/assets/images/sml1.jpg" alt="thumb" /></a>
                            </div><!--image-->
                            <?php endif; ?>
                            
                            <div class="tab-post-info">
                                <h3 class="tab-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tab-post-details"><?php //the_time( get_option('date_format') ); ?></div>
                            </div><!--details-->
                        </li>
                        
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
						
					</ul>
				</div>
				<div id="tab3" class="tab_content">
				  <ul class="tab-posts">
						<?php 
						query_posts('cat=30,-28,-29&caller_get_posts=1&posts_per_page=5&orderby=comment_count');
						while ( have_posts() ) : the_post(); ?>
                        
                        <li>
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="f-thumb"><?php the_post_thumbnail('thumb50'); ?></a>
                            </div><!--image-->
							<?php else: ?>
							<div class="tab-post-thumb">
                                <a href="<?php the_permalink(); ?>" class="f-thumb"><img src="<?php bloginfo('template_directory'); ?>/assets/images/sml1.jpg" alt="thumb" /></a>
                            </div><!--image-->
                            <?php endif; ?>
                            
                            <div class="tab-post-info">
                                <h3 class="tab-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="tab-post-details"><?php //the_time( get_option('date_format') ); ?></div>
                            </div><!--details-->
                        </li>
                        
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
						
					</ul>
				</div>
			</div>
		</div>
		
		<?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* No need to strip tags */
		$instance['tab1'] = $new_instance['tab1'];
		$instance['tab2'] = $new_instance['tab2'];
		$instance['tab3'] = $new_instance['tab3'];
		
		return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		
		$defaults = array(
		'tab1' => 'Popular',
		'tab2' => 'Recent',
		'tab3' => 'Tags',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- tab 1 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab 1 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" />
		</p>
		
		<!-- tab 2 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Tab 2 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" />
		</p>
		
		<!-- tab 3 title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Tab 3 Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" />
		</p>
        <?php
	}

}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("TabbedWidget");'));


?>