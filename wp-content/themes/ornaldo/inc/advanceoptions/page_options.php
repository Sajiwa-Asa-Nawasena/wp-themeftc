<?php
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array();
foreach( $ftc_default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

/* Get list menus */
$menus = array('0' => esc_html__('Default', 'ornaldo'));
$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
if( is_array($nav_terms) ){
	foreach( $nav_terms as $term ){
		$menus[$term->term_id] = $term->name;
	}
}

$options[] = array(
	'id'		=> 'page_layout_heading'
	,'label'	=> esc_html__('Page Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'layout_style'
	,'label'	=> esc_html__('Layout Style', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'ornaldo')
		,'boxed' 	=> esc_html__('Boxed', 'ornaldo')
		,'wide' 	=> esc_html__('Wide', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'page_layout'
	,'label'	=> esc_html__('Page Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0-1-0'  => esc_html__('Fullwidth', 'ornaldo')
		,'1-1-0' => esc_html__('Left Sidebar', 'ornaldo')
		,'0-1-1' => esc_html__('Right Sidebar', 'ornaldo')
		,'1-1-1' => esc_html__('Left & Right Sidebar', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'left_right_padding'
	,'label'	=> esc_html__('Left Right Padding', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'ornaldo')
		,'0'	=> esc_html__('No', 'ornaldo')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'header_breadcrumb_heading'
	,'label'	=> esc_html__('Header - Breadcrumb', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'header_layout'
	,'label'	=> esc_html__('Header Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  		=> esc_html__('Default', 'ornaldo')
		,'layout1'  	=> esc_html__('Header Layout 1', 'ornaldo')
		,'layout3' 		=> esc_html__('Header Layout 3', 'ornaldo')
		,'layout4' 		=> esc_html__('Header Layout 4', 'ornaldo')
		,'layout5' 		=> esc_html__('Header Layout 5', 'ornaldo')
		,'layout6' 		=> esc_html__('Header Layout 6', 'ornaldo')
		,'layout7' 		=> esc_html__('Header Layout 7', 'ornaldo')
		,'layout8' 		=> esc_html__('Header Layout 8', 'ornaldo')
		,'layout9' 		=> esc_html__('Header Layout 9', 'ornaldo')
		,'layout10' 		=> esc_html__('Header Layout 10', 'ornaldo')
		,'layout11' 		=> esc_html__('Header Layout 11', 'ornaldo')
	)
);

$header_blocks = array('0' => '');

$args = array(
	'post_type'			=> 'ftc_header'
	,'post_status'	 	=> 'publish'
	,'posts_per_page' 	=> -1
);

$posts = new WP_Query($args);

if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
	foreach( $posts->posts as $p ){
		$header_blocks[$p->ID] = $p->post_title;
	}
}
$options[] = array(
	'id'		=> 'page_header_template'
	,'label'	=> esc_html__('Header Template', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $header_blocks
);
$options[] = array(
'id' => 'page_enable_popup'
,'label' => esc_html__('Show popup newletter', 'ornaldo')
,'desc' => ''
,'type' => 'select'
,'default' => 0
,'options' => array(
'0' => esc_html__('No', 'ornaldo')
,'1' => esc_html__('Yes', 'ornaldo')
)
);
$options[] = array(
	'id'		=> 'header_transparent'
	,'label'	=> esc_html__('Transparent Header', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'ornaldo')
		,'0'	=> esc_html__('No', 'ornaldo')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'header_text_color'
	,'label'	=> esc_html__('Header Text Color', 'ornaldo')
	,'desc'		=> esc_html__('Only available on transparent header', 'ornaldo')
	,'type'		=> 'select'
	,'options'	=> array(
		'default'	=> esc_html__('Default', 'ornaldo')
		,'light'	=> esc_html__('Light', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'menu_id'
	,'label'	=> esc_html__('Primary Menu', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $menus
);

$options[] = array(
	'id'		=> 'show_page_title'
	,'label'	=> esc_html__('Show Page Title', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'ornaldo')
		,'0'	=> esc_html__('No', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'show_breadcrumb'
	,'label'	=> esc_html__('Show Breadcrumb', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'ornaldo')
		,'0'	=> esc_html__('No', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_layout'
	,'label'	=> esc_html__('Breadcrumb Layout', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'ornaldo')
		,'v1'  		=> esc_html__('Breadcrumb Layout 1', 'ornaldo')
		,'v2' 		=> esc_html__('Breadcrumb Layout 2', 'ornaldo')
		,'v3' 		=> esc_html__('Breadcrumb Layout 3', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_bg_parallax'
	,'label'	=> esc_html__('Breadcrumb Background Parallax', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'ornaldo')
		,'1'		=> esc_html__('Yes', 'ornaldo')
		,'0'		=> esc_html__('No', 'ornaldo')
	)
);

$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo_mobile'
	,'label'	=> esc_html__('Mobile Logo', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo'
	,'label'	=> esc_html__('Logo', 'ornaldo')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

if( !class_exists('ThemeFtc_GET') ){			
	$footer_blocks = array('0' => '');
	
	$args = array(
		'post_type'			=> 'ftc_footer'
		,'post_status'	 	=> 'publish'
		,'posts_per_page' 	=> -1
	);
	
	$posts = new WP_Query($args);
	
	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$footer_blocks[$p->ID] = $p->post_title;
		}
	}

	$options[] = array(
		'id'		=> 'page_footer_heading'
		,'label'	=> 'Page Footer'
		,'desc'		=> esc_html__('You also need to add the FTC- Footer widget into Footer Top,Middle,Bottom', 'ornaldo')
		,'type'		=> 'heading'
	);

	$options[] = array(
		'id'		=> 'footer_top'
		,'label'	=> esc_html__('Footer Top', 'ornaldo')
		,'desc'		=> ''
		,'type'		=> 'select'
		,'options'	=> $footer_blocks
	);

	$options[] = array(
		'id'		=> 'footer_middle'
		,'label'	=> esc_html__('Footer Middle', 'ornaldo')
		,'desc'		=> ''
		,'type'		=> 'select'
		,'options'	=> $footer_blocks
	);

	$options[] = array(
		'id'		=> 'footer_bottom'
		,'label'	=> esc_html__('Footer Bottom', 'ornaldo')
		,'desc'		=> ''
		,'type'		=> 'select'
		,'options'	=> $footer_blocks
	);

}

$options[] = array(
	'id'	=> 'primary_color'
	,'label'	=> esc_html__('Primary Color', 'ornaldo')
	,'desc'	=> ''
	,'type'	=> 'colorpicker'
);


$options[] = array(
	'id'	=> 'secondary_color'
	,'label'	=> esc_html__('Secondary Color', 'ornaldo')
	,'desc'	=> ''
	,'type'	=> 'colorpicker'
);

$options[] = array(
	'id'		=>'body_font_google'
	,'label' 	=> esc_html__('Body Font - Google Font', 'ornaldo')
	,'desc'		=> ''
	,'type' 	=> 'text'
);


$options[] = array(
	'id'		=>'secondary_body_font_google'
	,'label' 	=> esc_html__('Secondary Body Font - Google Font', 'ornaldo')
	,'desc'		=> ''
	,'type' 	=> 'text'
);


?>