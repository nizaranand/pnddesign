<?php
// Don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}

global $wpadpress;
if (isset($_POST['savezones'])):
	
	update_option('az_camp_apo', $_POST['az_camp_apo']);
	update_option('az_title_apo', $_POST['az_title_apo']);
	update_option('az_state_apo', $_POST['az_state_apo']);
	
	update_option('az_camp_bpo', $_POST['az_camp_bpo']);
	update_option('az_title_bpo', $_POST['az_title_bpo']);
	update_option('az_state_bpo', $_POST['az_state_bpo']);
	
	update_option('az_camp_ap', $_POST['az_camp_ap']);
	update_option('az_title_ap', $_POST['az_title_ap']);
	update_option('az_state_ap', $_POST['az_state_ap']);
	
	update_option('az_camp_bp', $_POST['az_camp_bp']);
	update_option('az_title_bp', $_POST['az_title_bp']);
	update_option('az_state_bp', $_POST['az_state_bp']);
	
endif;


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
        			
					<div id="adpress-icon-addcampaign" class="icon32"><br></div>
					<h2>Ad Zones</h2>
					
					<form method="post" id="addcampaign-form">
					
					<!-- Campaign Details -->
					<div class="c-block">
						<div class="c-head">
							<h3 id="adpress-icon-campaign_details"><?php _e('Above Post Zone', 'wp-adpress'); ?></h3>
						</div>
						<table class="form-table">
							<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="az_camp_apo"><?php _e('Campaign', 'wp-adpress'); ?></label>
								</th>
								<td>
									 <select class="widefat" id="az_camp_apo" name="az_camp_apo">
										<option value="0">Select Campaign...</option>
										<?php echo wp_adpress_campaigns::widget_list_campaigns(get_option('az_camp_apo')); ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_title_apo"><?php _e('Zone Title', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="text" name="az_title_apo" id="az_title_apo" value="<?php
										echo get_option('az_title_apo');
										?>" class="string"/>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_state_apo"><?php _e('Zone State', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="checkbox" name="az_state_apo" id="az_state_apo" <?php
										if (get_option('az_state_apo')=='on') {
											echo 'checked="checked"';
										}
										?>/> Active
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<!-- Campaign Details -->
					<div class="c-block">
						<div class="c-head">
							<h3 id="adpress-icon-campaign_details"><?php _e('Below Post Zone', 'wp-adpress'); ?></h3>
						</div>
						<table class="form-table">
							<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="az_camp_bpo"><?php _e('Campaign', 'wp-adpress'); ?></label>
								</th>
								<td>
									 <select class="widefat" id="az_camp_bpo" name="az_camp_bpo">
										<option value="0">Select Campaign...</option>
										<?php echo wp_adpress_campaigns::widget_list_campaigns(get_option('az_camp_bpo')); ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_title_bpo"><?php _e('Zone Title', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="text" name="az_title_bpo" id="az_title_bpo" value="<?php
										echo get_option('az_title_bpo');
										?>" class="string"/>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_state_bpo"><?php _e('Zone State', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="checkbox" name="az_state_bpo" id="az_state_bpo" <?php
										if (get_option('az_state_bpo')=='on') {
											echo 'checked="checked"';
										}
										?>/> Active
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<!-- Campaign Details -->
					<div class="c-block">
						<div class="c-head">
							<h3 id="adpress-icon-campaign_details"><?php _e('Above Page Zone', 'wp-adpress'); ?></h3>
						</div>
						<table class="form-table">
							<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="az_camp_ap"><?php _e('Campaign', 'wp-adpress'); ?></label>
								</th>
								<td>
									 <select class="widefat" id="az_camp_ap" name="az_camp_ap">
										<option value="0">Select Campaign...</option>
										<?php echo wp_adpress_campaigns::widget_list_campaigns(get_option('az_camp_ap')); ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_title_ap"><?php _e('Zone Title', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="text" name="az_title_ap" id="az_title_ap" value="<?php
										echo get_option('az_title_ap');
										?>" class="string"/>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_state_ap"><?php _e('Zone State', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="checkbox" name="az_state_ap" id="az_state_ap" <?php
										if (get_option('az_state_ap')=='on') {
											echo 'checked="checked"';
										}
										?>/> Active
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<!-- Campaign Details -->
					<div class="c-block">
						<div class="c-head">
							<h3 id="adpress-icon-campaign_details"><?php _e('Below Page Zone', 'wp-adpress'); ?></h3>
						</div>
						<table class="form-table">
							<tbody>
							<tr valign="top">
								<th scope="row">
									<label for="az_camp_bp"><?php _e('Campaign', 'wp-adpress'); ?></label>
								</th>
								<td>
									 <select class="widefat" id="az_camp_bp" name="az_camp_bp">
										<option value="0">Select Campaign...</option>
										<?php echo wp_adpress_campaigns::widget_list_campaigns(get_option('az_camp_bp')); ?>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_title_bp"><?php _e('Zone Title', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="text" name="az_title_bp" id="az_title_bp" value="<?php
										echo get_option('az_title_bp');
										?>" class="string"/>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									<label for="az_state_bp"><?php _e('Zone State', 'wp-adpress'); ?></label>
								</th>
								<td>
									<input type="checkbox" name="az_state_bp" id="az_state_bp" <?php
										if (get_option('az_state_bp')=='on') {
											echo 'checked="checked"';
										}
										?>/> Active
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					
					<!-- Submit buttons -->
					<p class="submit" style="clear:both; float:right;">
						<input type="submit" name="savezones" class="button-primary" value="Save Zones"/>
					</p>
					</form>
				</div>
			</div>
		</div>
    </div>
</div>