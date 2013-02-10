<?php
// Don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}

if (!class_exists('Ads_Manager_Widget')) {
    /**
     * Ads Manager Widget
     */
    class Ads_Manager_Widget extends WP_Widget
    {

        /**
         * Constructor
         *
         * Registers the widget details with the parent class
         */
        function __construct()
        {
            // widget actual processes			
			parent::__construct($id = 'adpress_widget', $name = 'Ads Manager Widget', $options = array('description' => __('FT Ads Manager Advertising Widget', 'wp-adpress')));
        }

        /**
         * Creates a form in the theme widgets page
         * @param $instance
         */
        function form($instance)
        {
            // outputs the options form on admin
            if ($instance) {
                $title = esc_attr($instance['title']);
                $campaign = esc_attr($instance['campaign']);
            } else {
                $title = __('Our Sponsors', 'wp-adpress');
                $campaign = 1;
            }
            ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label><br/>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('campaign'); ?>">Campaign</label><br/>
            <select class="widefat" id="<?php echo $this->get_field_id('campaign'); ?>"
                    name="<?php echo $this->get_field_name('campaign'); ?>">
                <?php echo wp_adpress_campaigns::widget_list_campaigns($campaign); ?>
            </select>
        </p>
        <?php
        }

        /**
         * Update the form on submit
         * @param $new_instance
         * @param $old_instance
         * @return array
         */
        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['campaign'] = strip_tags($new_instance['campaign']);
            return $instance;
        }

        /**
         * Displays the widget
         * @param $args
         * @param $instance
         */
        function widget($args, $instance)
        {
            // Extract the content of the widget
            extract($args);
            $title = apply_filters('widget_title', $instance['title']);

            // Before Widget
            echo $before_widget;

            // Displays the title
            if ($title) {
                echo $before_title . $title . $after_title;
            }
            // Displays the campaign
            $campaign = new wp_adpress_campaign((int)$instance['campaign']);
            $campaign->display();

            // After Widget
            echo $after_widget;
        }

    }
}