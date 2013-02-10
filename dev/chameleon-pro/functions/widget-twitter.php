<?php

/*
Plugin Name: FT Twitter Widget
Plugin URI: http://www.frogsthemes.com
Description: A widget to add your last Tweets to your sidebar.
Author: FrogsThemes.com
Version: 1
Author URI: http://www.frogsthemes.com
*/


class TwitterWidget extends WP_Widget {
    
	/** constructor */
    function TwitterWidget() {
        
		$options = array( 'description' => __('A widget to add your last Tweets to your sidebar.') );
		
		parent::WP_Widget(false, $name = 'FT Twitter Widget', $options);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        
		if(of_get_option('ft_twitter')!=''):
			$twitter_id = of_get_option('ft_twitter');
		endif;
		
		?>
		<?php echo $before_widget; ?>
		<h3 class="f-widget-title title-twitter  widget-title"><?php echo $title; ?></h3>
		<ul id="twitter_update_list" class="widget-twitter twitter_update_list">
			<li>Twitter</li>
		</ul>
		<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo strtolower($twitter_id);?>.json?callback=twitterCallback2&amp;count=2"></script>
		<p class="follow-link">Follow <a href="http://twitter.com/#!/<?php echo $twitter_id;?>" target="_blank">@<?php echo $twitter_id;?></a></p>
		<?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr($instance['title']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
		if(of_get_option('ft_twitter')!=''):
			$twitter_id = of_get_option('ft_twitter');
			echo '<p>The Twitter username you are using is "'.$twitter_id.'". You can edit it under Appearance -> Theme Options -> Connections.</p>';
		else:
			echo '<p>You will need to add your Twitter username in Appearance -> Theme Options -> Connections.</p>';
		endif;
	}

}

// register TwitterWidget widget
add_action('widgets_init', create_function('', 'return register_widget("TwitterWidget");'));


?>