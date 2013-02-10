<?php
/**
 * WPBakery Visual Composer build plugin
 *
 * @package WPBakeryVisualComposer
 *
 */


if (!defined('ABSPATH')) die('-1');

class WPBakeryVisualComposerSetup extends WPBakeryVisualComposerAbstract {
    public static $version = '3.0.2';
    protected $composer;

    public function __construct() {
    }

    public function init($settings) {

        /* TODO: add method for validating configurations from user */

        parent::init($settings);

        $this->composer = WPBakeryVisualComposer::getInstance();

        $this->composer->createColumnShortCode(); // Refactored

        if ( preg_match('/wp\-content\/plugins/', preg_replace('/\\\/', '/', self::$config['APP_ROOT']) ) ) {
            $this->composer->setPlugin();
            $this->setUpPlugin();
        } elseif ( preg_match('/wp\-content\/themes/', preg_replace('/\\\/', '/', self::$config['APP_ROOT']) ) ) {
            $this->composer->setTheme();
            $this->setUpTheme();
        }

        /*
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails', array( 'page' ) );
        }
		*/

        load_plugin_textdomain( 'js_composer', false, self::$config['APP_ROOT'] . '/locale/' );
        add_post_type_support( 'page', 'excerpt' );
    }

    public function setUpPlugin() {
        register_activation_hook( __FILE__, Array( $this, 'activate' ) );
        if (!is_admin()) {
            $this->addAction('template_redirect', 'frontCss');
            $this->addAction('template_redirect', 'frontJsRegister');
            $this->addAction('wp_enqueue_scripts', 'frontendJsLoad');
            $this->addFilter('the_content', 'fixPContent', 10000);
            $this->addFilter('body_class', 'jsComposerBodyClass');
        }
    }

    public function fixPContent($content = null) {
        //$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        $s = array("<p><div class=\"row-fluid\"", "</div></p>");
        $r = array("<div class=\"row-fluid\"", "</div>");
        $content = str_ireplace($s, $r, $content);
        return $content;
    }
    public function frontendJsLoad() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'wpb_composer_front_js' );
    }

    public function frontCss() {
        // wp_register_style( 'bootstrap', $this->composer->assetURL( 'bootstrap/css/bootstrap.css' ), false, WPB_VC_VERSION, 'screen' );
        wp_register_style( 'ui-custom-theme', $this->composer->assetURL( 'ui-custom-theme/jquery-ui-' . WPB_JQUERY_UI_VERSION . '.custom.css' ), false, WPB_VC_VERSION, 'screen');
        wp_register_style( 'flexslider', $this->composer->assetURL( 'js/flexslider/flexslider.css' ), false, WPB_VC_VERSION, 'screen' );

        wp_register_style( 'prettyphoto', $this->composer->assetURL( 'js/prettyphoto/css/prettyPhoto.css' ), false, WPB_VC_VERSION, 'screen' );

        wp_register_style( 'js_composer_front', $this->composer->assetURL( 'js_composer_front.css' ), false, WPB_VC_VERSION, 'screen' );

        // wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'js_composer_front' );
    }

    public function frontJsRegister() {
        wp_register_script( 'wpb_composer_front_js', $this->composer->assetURL( 'js_composer_front.js' ), array( 'jquery' ));

        wp_register_script( 'tweet', $this->composer->assetURL( 'js/jquery.tweet.js' ), array( 'jquery' ));
        wp_register_script( 'isotope', $this->composer->assetURL( 'js/jquery.isotope.min.js' ), array( 'jquery' ));
        wp_register_script( 'jcarousellite', $this->composer->assetURL( 'js/jcarousellite_1.0.1.min.js' ), array( 'jquery' ));

        //wp_register_script( 'cycle', $this->composer->assetURL( 'js/jquery.cycle.all.js' ), array( 'jquery' ));
        wp_register_script( 'nivo-slider', $this->composer->assetURL( 'js/jquery.nivo.slider.pack.js' ), array( 'jquery' ));
        wp_register_script( 'flexslider', $this->composer->assetURL( 'js/flexslider/jquery.flexslider2.js' ), array( 'jquery' ));
        wp_register_script( 'prettyphoto', $this->composer->assetURL( 'js/prettyphoto/js/jquery.prettyPhoto.js' ), array( 'jquery' ));

        //wp_register_script( 'jcarousellite', $this->composer->assetURL( 'js/jcarousellite_1.0.1.min.js' ), array( 'jquery' ));
        //wp_register_script( 'anythingslider', $this->composer->assetURL( 'js/jquery.anythingslider.min.js' ), array( 'jquery' ));
    }

    /* Activation hook for plugin */
    public function activate() {
        add_option( 'wpb_js_composer_do_activation_redirect', true );
    }

    public function setUpTheme() {
           $this->setUpPlugin();
    }


    public function jsComposerBodyClass($classes) {
        $classes[] = 'wpb-js-composer js-comp-ver-'.WPB_VC_VERSION;
        return $classes;
    }
}

/* Setup for admin */

class WPBakeryVisualComposerSetupAdmin extends WPBakeryVisualComposerSetup {
    public function __construct() {
        parent::__construct();
    }

    /* Setup plugin composer */

    public function setUpPlugin() {
        parent::setUpPlugin();

        $this->composer->addAction( 'edit_post', 'saveMetaBoxes' );
        $this->composer->addAction( 'wp_ajax_wpb_get_element_backend_html', 'elementBackendHtmlJavascript_callback' );
        $this->composer->addAction( 'wp_ajax_wpb_shortcodes_to_visualComposer', 'shortCodesVisualComposerJavascript_callback' );
        $this->composer->addAction( 'wp_ajax_wpb_show_edit_form', 'showEditFormJavascript_callback' );
        $this->composer->addAction('wp_ajax_wpb_save_template', 'saveTemplateJavascript_callback');
        $this->composer->addAction('wp_ajax_wpb_load_template', 'loadTemplateJavascript_callback');
        $this->composer->addAction('wp_ajax_wpb_delete_template', 'deleteTemplateJavascript_callback');

        // Add specific CSS class by filter
        $this->addFilter('body_class', 'jsComposerBodyClass');
        $this->addFilter( 'get_media_item_args', 'jsForceSend' );



        $this->addAction( 'admin_menu','composerSettings' );
        $this->addAction( 'admin_init', 'composerRedirect' );
        $this->addAction( 'admin_init', 'jsComposerEditPage', 5 );

        $this->addAction( 'admin_init', 'registerCss' );
        $this->addAction( 'admin_init', 'registerJavascript' );

        $this->addAction( 'admin_print_scripts-post.php', 'editScreen_js' );
        $this->addAction( 'admin_print_scripts-post-new.php', 'editScreen_js' );

        /* Create Media tab for images */
        $this->composer->createImagesMediaTab();
    }
    /*
     * Set up theme filters and actions
     *
     */
    public function setUpTheme() {
        $this->setUpPlugin();
        $this->addAction('admin_init', 'themeScreen_js');
    }


    public function jsForceSend($args) {
        $args['send'] = true;
        return $args;
    }

    public function themeScreen_js() {
        wp_enqueue_script('wpb_js_theme_admin');
    }

    public function editScreen_js() {
        // wp_enqueue_style('bootstrap');
        wp_enqueue_style('ui-custom-theme');
        wp_enqueue_style('js_composer');

        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-accordion');

        // wp_enqueue_script('bootstrap-js');
        wp_enqueue_script('wpb_js_composer_js');
    }

    public function registerJavascript() {
        wp_register_script('wpb_js_composer_js', $this->composer->assetURL( 'js_composer.js' ), array('jquery'), WPB_VC_VERSION, true);
        // wp_register_script('bootstrap-js', $this->composer->assetURL( 'bootstrap/js/bootstrap.min.js' ), false, WPB_VC_VERSION, true);
        wp_register_script('wpb_js_theme_admin', $this->composer->assetURL( 'theme_admin.js' ), array('jquery'), WPB_VC_VERSION, true);

    }

    public function registerCss() {

        // wp_register_style( 'bootstrap', $this->composer->assetURL( 'bootstrap/css/bootstrap.css' ), false, WPB_VC_VERSION, false );
        wp_register_style( 'ui-custom-theme', $this->composer->assetURL( 'ui-custom-theme/jquery-ui-' . WPB_JQUERY_UI_VERSION . '.custom.css' ), false, WPB_VC_VERSION, false );
        wp_register_style( 'js_composer', $this->composer->assetURL( 'js_composer.css' ), false, WPB_VC_VERSION, false );

    }
    /* Call to generate main template editor */

    public function jsComposerEditPage() {
        $pt_array = $this->composer->getPostTypes();
        foreach ($pt_array as $pt) {
            add_meta_box( 'wpb_visual_composer', __('Visual Composer', "js_composer"), Array($this->composer->getLayout(), 'output'), $pt, 'normal', 'high');
        }
    }

    /* Add option to Settings menu */
    public function composerSettings() {

        if ( current_user_can('manage_options') && $this->composer->isPlugin()) {
            add_options_page(__("Visual Composer Settings", "js_composer"), __("Visual Composer", "js_composer"), 'install_plugins', "wpb_vc_settings", array($this, "composerSettingsMenuHTML"));
        } elseif($this->composer->isTheme() && current_user_can('edit_theme_options')) {


        }
    }

    /* Include plugin settings page */

    public static function composerSettingsMenuHTML() {
        /* TODO: Refactor file js_composer_settings_menu.php */
        include_once( self::$config['COMPOSER'] . 'settings/' . 'js_composer_settings_menu.php' );
    }


    public function composerRedirect() {
        if ( get_option('wpb_js_composer_do_activation_redirect', false) ) {
            delete_option('wpb_js_composer_do_activation_redirect');
            wp_redirect(admin_url().'options-general.php?page=wpb_vc_settings');
        }
    }
}