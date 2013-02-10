<?php
// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }
/*
 * Catch Actions
 */
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'del_history':
            if (wp_adpress_history::empty_history()) {
            wp_adpress::display_notice('History Deleted', '<p>History Removed</p>', 'adpress-icon-request_sent');
            }
            break;
    }
}
?>
<div class="wrap" id="adpress">
	<div id="campaings-table">
		<div id="of_container">
			<div id="header">
				<div class="logo">
					<h2><a href="http://www.frogsthemes.com" target="_blank">FrogsThemes.com</a></h2>
				</div>
				<div class="version">
					FT Ads Manager<br /><span>Version <?php echo ADPRESS_VERSION; ?></span>
				</div>
				<div class="clear"></div>
			</div>
			<div id="ft-installer">
				<div class="fti-sidebars">
        			
					<div id="adpress-icon-campaigns" class="icon32"><br></div>
					<h2><?php _e('Settings', 'wp-adpress'); ?></h2>
					
					<h2 class="nav-tab-wrapper"><?php wp_adpress_settings::render_tabs(); ?></h2>					
					<?php wp_adpress_settings::render_pages(); ?>
				</div>
			</div>
		</div>
    </div>
</div>