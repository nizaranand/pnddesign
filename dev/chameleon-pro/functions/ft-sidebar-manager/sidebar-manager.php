<?php


add_action('admin_init', 'sidebarmanager_add_init');

function sidebarmanager_add_init() 
{   
	if(isset($_GET['page'])&&($_GET['page']=='frogsthemes_sidebar'))
	{	
		wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/admin-style.css');
		wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/sidebar-style.css');	
		wp_enqueue_script('jquery-ui-sortable', OPTIONS_FRAMEWORK_DIRECTORY . 'js/jquery.ui.sortable.js', array('jquery'));
	}
}



function frogsthemes_sidebar() 
{	  
	if(isset($_POST["submit"])):

		update_option("ft_active_sidebars", $_POST["active"]);
		update_option("ft_inactive_sidebars", $_POST["inactive"]);

	endif;
	
	$active = get_option("ft_active_sidebars");
	$inactive = get_option("ft_inactive_sidebars");

	if($active==''): $active = array(); endif;
	if($inactive==''): $inactive = array(); endif;
	
	?>
      
	<script>
	jQuery(function() {
		
		jQuery( "ul.droptrue" ).sortable({
			connectWith: "ul"
		});

		jQuery( "#activesidebars, #inactivesidebars" ).disableSelection();
		
		jQuery("#addsidebar").click(function(){
		
			if(jQuery.trim(jQuery("#sidebar_name").val())=="") return;
			
			jQuery("#activesidebars").prepend(" <li><span>" + jQuery("#sidebar_name").val() + "</span><input type=\"hidden\" value=\"" + jQuery("#sidebar_name").val() + "\" name=\"active[]\" /> <a href=\"#\" class=\"delete\">X</a></li>");
			jQuery("#sidebar_name").val("");
			
		});
		
		jQuery("#activesidebars").sortable({ placeholder:'sidebar-holder' ,connectWith: '#inactivesidebars' 
		,  stop: function(event, ui) { ui.item.find("input").attr("name","inactive[]"); }
		});
		jQuery("#inactivesidebars").sortable({ placeholder:'sidebar-holder' , connectWith: '#activesidebars'
		,  stop: function(event, ui) { ui.item.find("input").attr("name","active[]"); }
		 });
		
		jQuery(".delete").live("click",function(e){
			jQuery(this).parent().remove();
			e.preventDefault();
		});
		
	});
	</script>

	<div id="of_container">
		<div id="header">
			<div class="logo">
				<h2><a href="http://www.frogsthemes.com" target="_blank">FrogsThemes.com</a></h2>
			</div>
			<div class="version">
				Sidebar Manager<br /><span>Version 1.0.0</span>
			</div>
			<div class="clear"></div>
		</div>
		<div id="ft-installer">
				
			<div class="fti-sidebars">
				
				<form method="post" action="" class="clearfix" >
				
					<div class="add-sidebar"> 
						<h2>Welcome to the FT Sidebar Manager</h2>
						<p>Here you can create as many dynamic sidebars as you like. Creating new sidebars is easy:</p>
						<ol>
							<li>Add a sidebar using the form below by entering the name of your sidebar and clicking 'Add'. Click 'Save Sidebars' to make the change.</li>
							<li>Once a sidebar has been created you can add widgets to them under <a href="<?php echo get_admin_url()."widgets.php"; ?>">Appearance -> Widgets</a>.</li>
							<li>Now when you go to a page or post where you want to use the sidebar and select it from the dropdown in the 'FT Sidebars' options box in the right column. Once updated, your post/page will now use your dynamic sidebar instead of the default one. You also have options to change the alignment and to disable it if need be.</li>
							<li>To deactivate a sidebar, simply drag the sidebar from 'Active Sidebars' over to the 'Inactive Sidebars' section and click 'Save Sidebars'.</li>
							<li>To remove a sidebar, click the 'X' next to the relevant sidebar and click 'Save Sidebars'</li>
						</ol>
						<p>&nbsp;</p>
						<h2>Add Sidebar</h2>
						<input id="sidebar_name" name="sidebar_name" type="text" />
						<input name="addsidebar" type="button" value="Add" id="addsidebar" class="button" /> 
					</div>
					
					<div class="sidebarcontainers">
						
						<?php if($_POST['submit']!=''): ?>
						<div class="success">Sidebars Updated!</div>
						<?php endif ?>
						
						<div class="activecontainer">
						
							<h2>Active Sidebars</h2>
							
							<ul id="activesidebars" class='droptrue'>
								<?php 
								foreach($active as $sidebar) : 
									echo "<li><input type='hidden' name='active[]' value='".$sidebar."'/>".$sidebar." <a href='#' class='delete'>X</a></li>";  
								endforeach; 
								?>
							</ul>
						
						</div>
						
						<div class="inactivecontainer">
						
							<h2>Inactive Sidebars</h2>
							
							<ul id="inactivesidebars" class='droptrue'>
								<?php 
								foreach($inactive as $sidebar) : 
									echo "<li><input type='hidden' name='inactive[]' value='".$sidebar."'/>".$sidebar." <a href='#' class='delete'>X</a></li>";
								endforeach; 
								?>
							</ul>
							
						</div>
					
					</div>
					
					<input name="submit" type="submit" value="Save Sidebars" class="admin-button fti-button" />
				
				</form>
				
			</div>
		</div>
	</div>
	
	<?php 
} 
?>