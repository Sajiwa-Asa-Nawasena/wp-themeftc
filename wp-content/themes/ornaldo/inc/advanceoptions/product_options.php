<?php 
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array(
	'0'	=> esc_html__('Default', 'ornaldo')
);
foreach( $ftc_default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

$options[] = array(
	'id'		=> 'prod_layout_heading'
	,'label'	=> esc_html__('Product Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_layout'
	,'label'	=> esc_html__('Product Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0'			=> esc_html__('Default', 'ornaldo')
		,'0-1-0'  	=> esc_html__('Fullwidth', 'ornaldo')
		,'1-1-0' 	=> esc_html__('Left Sidebar', 'ornaldo')
		,'0-1-1' 	=> esc_html__('Right Sidebar', 'ornaldo')
		,'1-1-1' 	=> esc_html__('Left & Right Sidebar', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'prod_left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'prod_right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'prod_custom_tab_heading'
	,'label'	=> esc_html__('Custom Tab', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_custom_tab'
	,'label'	=> esc_html__('Custom Tab', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0'		=> esc_html__('Default', 'ornaldo')
		,'1'	=> esc_html__('Override', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'prod_custom_tab_title'
	,'label'	=> esc_html__('Custom Tab Title', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'prod_custom_tab_content'
	,'label'	=> esc_html__('Custom Tab Content', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'textarea'
);

$options[] = array(
	'id'		=> 'prod_size_chart_heading'
	,'label'	=> esc_html__('Product Size Chart', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'show_size_chart'
	,'label'	=> esc_html__('Show Size Chart', 'ornaldo')
	,'desc'		=> esc_html__('You can show or hide Size Chart for all product on Theme Option > Product Detail', 'ornaldo')
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Show', 'ornaldo')
		,'0'	=> esc_html__('Hide', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'prod_size_chart'
	,'label'	=> esc_html__('Size Chart Image', 'ornaldo')
	,'desc'		=> esc_html__('You can upload size chart image for product', 'ornaldo')
	,'type'		=> 'upload'
);	

$options[] = array(
	'id'		=> 'prod_breadcrumb_heading'
	,'label'	=> esc_html__('Breadcrumbs', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'prod_video_heading'
	,'label'	=> esc_html__('Video', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'prod_video_url'
	,'label'	=> esc_html__('Video URL', 'ornaldo')
	,'desc'		=> esc_html__('Enter Youtube or Vimeo video URL', 'ornaldo')
	,'type'		=> 'text'
);		
?>