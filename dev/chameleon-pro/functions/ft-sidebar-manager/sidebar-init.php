<?php

$dynamic_active_sidebars = get_option("ft_active_sidebars");

if($dynamic_active_sidebars==""):
	$dynamic_active_sidebars = array();
endif;

foreach($dynamic_active_sidebars as $widget):
		
	$temp_widget = array(  
		'name' =>__( $widget),
		'description' => __( 'Dynamic sidebar'),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	);

	register_sidebar($temp_widget);

endforeach;

?>