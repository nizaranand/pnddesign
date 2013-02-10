<?php

$dir = dirname(__FILE__);

$composer_settings = Array(
   'APP_ROOT'      => $dir . '/js_composer',
   'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
   'APP_DIR'       => basename( $dir ) . '/js_composer/',
   'CONFIG'        => $dir . '/js_composer/config/',
   'ASSETS_DIR'    => 'assets/',
   'COMPOSER'      => $dir . '/js_composer/composer/',
   'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
   'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
   /* Default post type where to activate visual composer meta box settings */
   'default_post_types' => Array('page', 'portfolio', 'post', 'news', 'testimonials')
);

require_once locate_template('/functions/js_composer/js_composer.php');

$wpVC_setup->init($composer_settings);

?>