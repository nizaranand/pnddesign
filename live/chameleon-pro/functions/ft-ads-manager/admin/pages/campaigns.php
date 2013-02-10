<?php
// Don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}
// Create a new Campaigns page view
$view = new wp_adpress_campaigns_view();
$campaigns_count = wp_adpress_campaigns::campaigns_number();
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
					 <h2><?php _e('Campaigns', 'wp-adpress'); ?><a href="admin.php?page=adpress-inccampaign" class="add-new-h2"><?php _e('Add New', 'wp-adpress'); ?></a></h2>
					
					<?php echo $view->view; ?>
				</div>
			</div>
		</div>
    </div>
</div>