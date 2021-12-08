<?php 
add_action( 'vc_before_init', 'ftc_integrate_with_vc' );
function ftc_integrate_with_vc() {
	
	if( !function_exists('vc_map') ){
		return;
	}

	/********************** Content Shortcodes ***************************/

	/*** FTC Our Team ***/
	$team_options = array();
	if( class_exists('FTC_Team_Members') || post_type_exists('ftc_team') ){
		$args = array(
			'post_type'				=> 'ftc_team'
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'posts_per_page'		=> -1
		);
		$teams = new WP_Query($args);
		if( $teams->have_posts() ){
			global $post;
			while( $teams->have_posts() ){
				$teams->the_post();
				$team_options[$post->post_title] = $post->ID;
			}
		}
		wp_reset_postdata();
	}
	
	vc_map( array(
		'name' 		=> esc_html__( 'FTC Our Team', 'ornaldo' ),
		'base' 		=> 'ftc_team_member',
		'class' 	=> '',
		'category' 	=> 'ThemeFTC',
		"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Member name', 'ornaldo' )
				,'param_name' 	=> 'id'
				,'admin_label' 	=> true
				,'value' 		=> $team_options
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'ornaldo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> true
				,'value' 		=> '30'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('New Window Tab', 'ornaldo')	=>  '_blank'
					,esc_html__('Self', 'ornaldo')			=>  '_self'
				)
				,'description' 	=> ''
			)
		)
	) );
	/*FTC Gallery Instagram*/
	vc_map( array(
		'name' 		=> esc_html__( 'FTC Gallery Image Instagram', 'ornaldo' ),
		'base' 		=> 'ftc_insta_image',
		'class' 	=> '',
		'category' 	=> 'ThemeFTC',
		"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
		'params' 	=> array(
			array(
				'type' 			=> 'attach_images'
				,'heading' 		=> esc_html__( 'Image', 'ornaldo' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Size', 'ornaldo' )
				,'param_name' 	=> 'img_size'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'ornaldo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( '@: Tagname Instagram', 'ornaldo' )
				,'param_name' 	=> 'tag_name'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input tagname Instagram', 'ornaldo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
		)
	) );
	/*** FTC Instagram ***/
	vc_map( array(
		'name' 		=> esc_html__( 'FTC Instagram Feed', 'ornaldo' ),
		'base' 		=> 'ftc_instagram',
		'class' 	=> '',
		'category' 	=> 'ThemeFTC',
		'icon'          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Title', 'ornaldo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> 'Instagram'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Username', 'ornaldo' )
				,'param_name' 	=> 'username'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)			
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number', 'ornaldo' )
				,'param_name' 	=> 'number'
				,'admin_label' 	=> true
				,'value' 		=> '9'
				,'description' 	=> ''
			)			
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Column', 'ornaldo' )
				,'param_name' 	=> 'column'
				,'admin_label' 	=> true
				,'value' 		=> '3'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Image Size', 'ornaldo' )
				,'param_name' 	=> 'size'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Large', 'ornaldo')	=> 'large'
					,esc_html__('Small', 'ornaldo')		=> 'small'
					,esc_html__('Thumbnail', 'ornaldo')	=> 'thumbnail'
					,esc_html__('Original', 'ornaldo')	=> 'original'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Current window', 'ornaldo')	=> '_self'
					,esc_html__('New window', 'ornaldo')		=> '_blank'
				)
				,'description' 	=> ''
			)		
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Cache time (hours)', 'ornaldo' )
				,'param_name' 	=> 'cache_time'
				,'admin_label' 	=> true
				,'value' 		=> '12'
				,'description' 	=> ''
			)
		)
	) );

	/*** FTC Features ***/
	vc_map( array(
		'name' 		=> esc_html__( 'FTC Feature', 'ornaldo' ),
		'base' 		=> 'ftc_feature',
		'class' 	=> '',
		'category' 	=> 'ThemeFTC',
		"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
		'params' 	=> array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style', 'ornaldo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Horizontal', 'ornaldo')		=>  'feature-horizontal'
					,esc_html__('Vertical', 'ornaldo')		=>  'image-feature'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Icon class', 'ornaldo' )
				,'param_name' 	=> 'class_icon'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Use FontAwesome. Ex: fa-home', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style icon', 'ornaldo' )
				,'param_name' 	=> 'style_icon'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Default', 'ornaldo')		=>  'icon-default'
					,esc_html__('Small', 'ornaldo')			=>  'icon-small'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'attach_image'
				,'heading' 		=> esc_html__( 'Image Thumbnail', 'ornaldo' )
				,'param_name' 	=> 'img_id'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'dependency'  	=> array('element' => 'style', 'value' => array('image-feature'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Image Thumbnail URL', 'ornaldo' )
				,'param_name' 	=> 'img_url'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Input external URL instead of image from library', 'ornaldo')
				,'dependency' 	=> array('element' => 'style', 'value' => array('image-feature'))
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Feature title', 'ornaldo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textarea'
				,'heading' 		=> esc_html__( 'Short description', 'ornaldo' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Link', 'ornaldo' )
				,'param_name' 	=> 'link'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
				,'param_name' 	=> 'target'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('New Window Tab', 'ornaldo')	=>  '_blank'
					,esc_html__('Self', 'ornaldo')			=>  '_self'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Extra class', 'ornaldo' )
				,'param_name' 	=> 'extra_class'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> esc_html__('Ex: feature-icon-blue, feature-icon-orange, feature-icon-green', 'ornaldo')
			)
		)
	) );
	
	/*** FTC Blogs ***/
	vc_map( array(
		'name' 		=> esc_html__( 'FTC Blogs', 'ornaldo' ),
		'base' 		=> 'ftc_blogs',
		'base' 		=> 'ftc_blogs',
		'class' 	=> '',
		'category' 	=> 'ThemeFTC',
		"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
		'params' 	=> array(
			array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
				,'param_name' 	=> 'blog_title'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style of products', 'ornaldo' )
				,'param_name' 	=> 'style'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('default', 'ornaldo')				=> ''
					,esc_html__('style blog page', 'ornaldo')				=> 'blog-page-2'
					,esc_html__('style 12', 'ornaldo')				=> 'blog12'
				)
				,'description' => esc_html__( 'Select Style of product', 'ornaldo' )
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Layout', 'ornaldo' )
				,'param_name' 	=> 'layout'
				,'admin_label' 	=> true
				,'value' 		=> array(
					esc_html__('Grid', 'ornaldo')		=> 'grid'
					,esc_html__('Slider', 'ornaldo')	=> 'slider'
					,esc_html__('Masonry', 'ornaldo')	=> 'masonry'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
					'1'				=> '1'
					,'2'			=> '2'
					,'3'			=> '3'
					,'4'			=> '4'
				)
				,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
				,'param_name' 	=> 'limit'
				,'admin_label' 	=> true
				,'value' 		=> 5
				,'description' 	=> esc_html__( 'Number of Posts', 'ornaldo' )
			)
			,array(
				'type' 			=> 'ftc_category'
				,'heading' 		=> esc_html__( 'Categories', 'ornaldo' )
				,'param_name' 	=> 'categories'
				,'admin_label' 	=> true
				,'value' 		=> ''
				,'description' 	=> ''
				,'class'		=> 'post_cat'
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order by', 'ornaldo' )
				,'param_name' 	=> 'orderby'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('None', 'ornaldo')		=> 'none'
					,esc_html__('ID', 'ornaldo')		=> 'ID'
					,esc_html__('Date', 'ornaldo')		=> 'date'
					,esc_html__('Name', 'ornaldo')		=> 'name'
					,esc_html__('Title', 'ornaldo')		=> 'title'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order', 'ornaldo' )
				,'param_name' 	=> 'order'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Descending', 'ornaldo')		=> 'DESC'
					,esc_html__('Ascending', 'ornaldo')		=> 'ASC'
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post title', 'ornaldo' )
				,'param_name' 	=> 'title'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show thumbnail', 'ornaldo' )
				,'param_name' 	=> 'thumbnail'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show author', 'ornaldo' )
				,'param_name' 	=> 'author'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('No', 'ornaldo')	=> 0
					,esc_html__('Yes', 'ornaldo')	=> 1
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show comment', 'ornaldo' )
				,'param_name' 	=> 'comment'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show date', 'ornaldo' )
				,'param_name' 	=> 'date'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show post excerpt', 'ornaldo' )
				,'param_name' 	=> 'excerpt'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show count view', 'ornaldo' )
				,'param_name' 	=> 'view'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show read more button', 'ornaldo' )
				,'param_name' 	=> 'readmore'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Number of words in excerpt', 'ornaldo' )
				,'param_name' 	=> 'excerpt_words'
				,'admin_label' 	=> false
				,'value' 		=> '16'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show load more button', 'ornaldo' )
				,'param_name' 	=> 'load_more'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('No', 'ornaldo')	=> 0
					,esc_html__('Yes', 'ornaldo')	=> 1
				)
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Load more button text', 'ornaldo' )
				,'param_name' 	=> 'load_more_text'
				,'admin_label' 	=> false
				,'value' 		=> 'Show more'
				,'description' 	=> ''
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
				,'param_name' 	=> 'nav'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show dots button', 'ornaldo' )
				,'param_name' 	=> 'dots'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
				,'param_name' 	=> 'auto_play'
				,'admin_label' 	=> false
				,'value' 		=> array(
					esc_html__('Yes', 'ornaldo')	=> 1
					,esc_html__('No', 'ornaldo')	=> 0
				)
				,'description' 	=> ''
				,'group'		=> esc_html__('Slider Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'textfield'
				,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
				,'param_name' 	=> 'margin'
				,'admin_label' 	=> false
				,'value' 		=> '30'
				,'description' 	=> esc_html__('Set margin between items', 'ornaldo')
				,'group'		=> esc_html__('Slider Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Desktop small items', 'ornaldo' )
				,'param_name' 	=> 'desksmall_items'
				,'admin_label' 	=> false
				,'value' 		=>  array(
					esc_html__('1', 'ornaldo')	=> 1
					,esc_html__('2', 'ornaldo')	=> 2
					,esc_html__('3', 'ornaldo')	=> 3
					,esc_html__('4', 'ornaldo')	=> 4

				)
				,'description' 	=> esc_html__('Set items on 991px', 'ornaldo')
				,'group'		=> esc_html__('Responsive Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tablet items', 'ornaldo' )
				,'param_name' 	=> 'tablet_items'
				,'admin_label' 	=> false
				,'value' 		=>  array(
					esc_html__('1', 'ornaldo')	=> 1
					,esc_html__('2', 'ornaldo')	=> 2
					,esc_html__('3', 'ornaldo')	=> 3
					,esc_html__('4', 'ornaldo')	=> 4

				)
				,'description' 	=> esc_html__('Set items on 768px', 'ornaldo')
				,'group'		=> esc_html__('Responsive Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Tablet mini items', 'ornaldo' )
				,'param_name' 	=> 'tabletmini_items'
				,'admin_label' 	=> false
				,'value' 		=>  array(
					esc_html__('1', 'ornaldo')	=> 1
					,esc_html__('2', 'ornaldo')	=> 2
					,esc_html__('3', 'ornaldo')	=> 3
					,esc_html__('4', 'ornaldo')	=> 4

				)
				,'description' 	=> esc_html__('Set items on 640px', 'ornaldo')
				,'group'		=> esc_html__('Responsive Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Mobile items', 'ornaldo' )
				,'param_name' 	=> 'mobile_items'
				,'admin_label' 	=> false
				,'value' 		=>  array(
					esc_html__('1', 'ornaldo')	=> 1
					,esc_html__('2', 'ornaldo')	=> 2
					,esc_html__('3', 'ornaldo')	=> 3
					,esc_html__('4', 'ornaldo')	=> 4

				)
				,'description' 	=> esc_html__('Set items on 480px', 'ornaldo')
				,'group'		=> esc_html__('Responsive Options', 'ornaldo')
			)
			,array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Mobile small items', 'ornaldo' )
				,'param_name' 	=> 'mobilesmall_items'
				,'admin_label' 	=> false
				,'value' 		=>  array(
					esc_html__('1', 'ornaldo')	=> 1
					,esc_html__('2', 'ornaldo')	=> 2
					,esc_html__('3', 'ornaldo')	=> 3
					,esc_html__('4', 'ornaldo')	=> 4

				)
				,'description' 	=> esc_html__('Set items on 0px', 'ornaldo')
				,'group'		=> esc_html__('Responsive Options', 'ornaldo')
			)
		)
) );

/*** FTC Button ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Button', 'ornaldo' ),
	'base' 		=> 'ftc_button',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Text', 'ornaldo' )
			,'param_name' 	=> 'content'
			,'admin_label' 	=> true
			,'value' 		=> 'Button text'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link', 'ornaldo' )
			,'param_name' 	=> 'link'
			,'admin_label' 	=> true
			,'value' 		=> '#'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Text color', 'ornaldo' )
			,'param_name' 	=> 'text_color'
			,'admin_label' 	=> false
			,'value' 		=> '#ffffff'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Text color hover', 'ornaldo' )
			,'param_name' 	=> 'text_color_hover'
			,'admin_label' 	=> false
			,'value' 		=> '#ffffff'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Background color', 'ornaldo' )
			,'param_name' 	=> 'bg_color'
			,'admin_label' 	=> false
			,'value' 		=> '#40bea7'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Background color hover', 'ornaldo' )
			,'param_name' 	=> 'bg_color_hover'
			,'admin_label' 	=> false
			,'value' 		=> '#3f3f3f'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Border color', 'ornaldo' )
			,'param_name' 	=> 'border_color'
			,'admin_label' 	=> false
			,'value' 		=> '#e8e8e8'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Border color hover', 'ornaldo' )
			,'param_name' 	=> 'border_color_hover'
			,'admin_label' 	=> false
			,'value' 		=> '#40bea7'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Border width', 'ornaldo' )
			,'param_name' 	=> 'border_width'
			,'admin_label' 	=> false
			,'value' 		=> '0'
			,'description' 	=> esc_html__('In pixels. Ex: 1', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Self', 'ornaldo')				=> '_self'
				,esc_html__('New Window Tab', 'ornaldo')	=> '_blank'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Size', 'ornaldo' )
			,'param_name' 	=> 'size'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Small', 'ornaldo')		=> 'small'
				,esc_html__('Medium', 'ornaldo')	=> 'medium'
				,esc_html__('Large', 'ornaldo')		=> 'large'
				,esc_html__('X-Large', 'ornaldo')	=> 'x-large'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'iconpicker'
			,'heading' 		=> esc_html__( 'Font icon', 'ornaldo' )
			,'param_name' 	=> 'font_icon'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'settings' 	=> array(
				'emptyIcon' 	=> true /* default true, display an "EMPTY" icon? */
				,'iconsPerPage' => 4000 /* default 100, how many icons per/page to display */
			)
			,'description' 	=> esc_html__('Add an icon before the text. Ex: fa-lock', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show popup', 'ornaldo' )
			,'param_name' 	=> 'popup'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Popup Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'textarea_raw_html'
			,'heading' 		=> esc_html__( 'Popup content', 'ornaldo' )
			,'param_name' 	=> 'popup_content'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
			,'group'		=> esc_html__('Popup Options', 'ornaldo')
		)
	)
) );

/*** FTC Image Slider ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Image Slider', 'ornaldo' ),
	'base' 		=> 'ftc_image_slider',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Image Slider 1', 'ornaldo' )
			,'param_name' 	=> 'img_1'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> 'Set image slider 1'
		)
		,array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Image Slider 2', 'ornaldo' )
			,'param_name' 	=> 'img_2'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> 'Set image slider 2'
		)
		,array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Image Slider 3', 'ornaldo' )
			,'param_name' 	=> 'img_3'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> 'Set image slider 3'
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Image 1', 'ornaldo' )
			,'param_name' 	=> 'link_1'
			,'admin_label' 	=> true
			,'value' 		=> '#'
			,'description' 	=> ''
		)			
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Title Image 1', 'ornaldo' )
			,'param_name' 	=> 'link_title_1'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link_image_2', 'ornaldo' )
			,'param_name' 	=> 'link_2'
			,'admin_label' 	=> true
			,'value' 		=> '#'
			,'description' 	=> ''
		)						
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Title Image 2', 'ornaldo' )
			,'param_name' 	=> 'link_title_2'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link_image_3', 'ornaldo' )
			,'param_name' 	=> 'link_3'
			,'admin_label' 	=> true
			,'value' 		=> '#'
			,'description' 	=> ''
		)						
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Title Image 3', 'ornaldo' )
			,'param_name' 	=> 'link_title_3'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('New Window Tab', 'ornaldo')		=> '_blank'
				,esc_html__('Self', 'ornaldo')				=> '_self'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Image Size', 'ornaldo' )
			,'param_name' 	=> 'img_size'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'ornaldo' )
		)

	)
) );

/*** FTC Single Image ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Single Image', 'ornaldo' ),
	'base' 		=> 'ftc_single_image',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Image', 'ornaldo' )
			,'param_name' 	=> 'img_id'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Image Size', 'ornaldo' )
			,'param_name' 	=> 'img_size'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__( 'Ex: thumbnail, medium, large or full', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Image URL', 'ornaldo' )
			,'param_name' 	=> 'img_url'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__('Input external URL instead of image from library', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link', 'ornaldo' )
			,'param_name' 	=> 'link'
			,'admin_label' 	=> true
			,'value' 		=> '#'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Title', 'ornaldo' )
			,'param_name' 	=> 'link_title'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Hover Effect', 'ornaldo' )
			,'param_name' 	=> 'style_smooth'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Effect-Image Left Right', 'ornaldo')		=> 'smooth-image'
				,esc_html__('Effect Border Image', 'ornaldo')				=> 'smooth-border-image'
				,esc_html__('Effect Background Image', 'ornaldo')		=> 'smooth-background-image'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('New Window Tab', 'ornaldo')		=> '_blank'
				,esc_html__('Self', 'ornaldo')				=> '_self'
			)
			,'description' 	=> ''
		)
	)
) );

/*** FTC Heading ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Heading', 'ornaldo' ),
	'base' 		=> 'ftc_heading',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Heading style', 'ornaldo' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Style 1', 'ornaldo')		=> 'style-1'
				,esc_html__('Style 2', 'ornaldo')		=> 'style-2'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Heading Size', 'ornaldo' )
			,'param_name' 	=> 'size'
			,'admin_label' 	=> true
			,'value' 		=> array(
				'1'				=> '1'
				,'2'			=> '2'
				,'3'			=> '3'
				,'4'			=> '4'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Text', 'ornaldo' )
			,'param_name' 	=> 'text'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
	)
) );

/*** FTC Banner ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Banner', 'ornaldo' ),
	'base' 		=> 'ftc_banner',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Background Image', 'ornaldo' )
			,'param_name' 	=> 'bg_id'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Background Url', 'ornaldo' )
			,'param_name' 	=> 'bg_url'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__('Input external URL instead of image from library', 'ornaldo')
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Background Color', 'ornaldo' )
			,'param_name' 	=> 'bg_color'
			,'admin_label' 	=> false
			,'value' 		=> '#ffffff'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textarea_html'
			,'heading' 		=> esc_html__( 'Banner content', 'ornaldo' )
			,'param_name' 	=> 'content'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Position Banner Content', 'ornaldo' )
			,'param_name' 	=> 'position_content'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Left Top', 'ornaldo')			=>  'left-top'
				,esc_html__('Left Bottom', 'ornaldo')		=>  'left-bottom'
				,esc_html__('Left Center', 'ornaldo')		=>  'left-center'
				,esc_html__('Right Top', 'ornaldo')			=>  'right-top'
				,esc_html__('Right Bottom', 'ornaldo')		=>  'right-bottom'
				,esc_html__('Right Center', 'ornaldo')		=>  'right-center'
				,esc_html__('Center Top', 'ornaldo')		=>  'center-top'
				,esc_html__('Center Bottom', 'ornaldo')		=>  'center-bottom'
				,esc_html__('Center Center', 'ornaldo')		=>  'center-center'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link', 'ornaldo' )
			,'param_name' 	=> 'link'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Link Title', 'ornaldo' )
			,'param_name' 	=> 'link_title'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style Effect', 'ornaldo' )
			,'param_name' 	=> 'style_smooth'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Background Scale', 'ornaldo')						=>  'ftc-smooth'
				,esc_html__('Background Scale Opacity', 'ornaldo')				=>  'ftc-smooth-opacity'
				,esc_html__('Background Scale Dark', 'ornaldo')					=>	'ftc-smooth-dark'
				,esc_html__('Background Scale and Line', 'ornaldo')				=>  'ftc-smooth-and-line'
				,esc_html__('Background Scale Opacity and Line', 'ornaldo')		=>  'ftc-smooth-opacity-line'
				,esc_html__('Background Scale Dark and Line', 'ornaldo')		=>  'ftc-smooth-dark-line'
				,esc_html__('Background Opacity and Line', 'ornaldo')			=>	'background-opacity-and-line'
				,esc_html__('Background Dark and Line', 'ornaldo')				=>	'background-dark-and-line'
				,esc_html__('Background Opacity', 'ornaldo')					=>	'background-opacity'
				,esc_html__('Background Dark', 'ornaldo')						=>	'background-dark'
				,esc_html__('Line', 'ornaldo')									=>	'eff-line'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Background Opacity On Device', 'ornaldo' )
			,'param_name' 	=> 'opacity_bg_device'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')			=>  0
				,esc_html__('Yes', 'ornaldo')		=>  1
			)
			,'description' 	=> esc_html__('Background image will be blurred on device. Note: should set background color ', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Responsive size', 'ornaldo' )
			,'param_name' 	=> 'responsive_size'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')		=>  1
				,esc_html__('No', 'ornaldo')		=>  0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Target', 'ornaldo' )
			,'param_name' 	=> 'target'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('New Window Tab', 'ornaldo')	=>  '_blank'
				,esc_html__('Self', 'ornaldo')			=>  '_self'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Extra Class', 'ornaldo' )
			,'param_name' 	=> 'extra_class'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> esc_html__('Ex: rp-rectangle-full, rp-rectangle', 'ornaldo')
		)
	)
) );

/* FTC Testimonial */
vc_map( array(
	'name' 		=> esc_html__( 'FTC Testimonial', 'ornaldo' ),
	'base' 		=> 'ftc_testimonial',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'ftc_category'
			,'heading' 		=> esc_html__( 'Categories', 'ornaldo' )
			,'param_name' 	=> 'categories'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
			,'class'		=> 'ftc_testimonial'
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style of products', 'ornaldo' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('default', 'ornaldo')				=> ''
				,esc_html__('style home12', 'ornaldo')				=> 'clientsay12'
			)
			,'description' => esc_html__( 'Select Style of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textarea'
			,'heading' 		=> esc_html__( 'Testimonial IDs', 'ornaldo' )
			,'param_name' 	=> 'ids'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__('A comma separated list of testimonial ids', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show Avatar', 'ornaldo' )
			,'param_name' 	=> 'show_avatar'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> '4'
			,'description' 	=> esc_html__('Number of Posts', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Number of words in excerpt', 'ornaldo' )
			,'param_name' 	=> 'excerpt_words'
			,'admin_label' 	=> true
			,'value' 		=> '50'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Text Color Style', 'ornaldo' )
			,'param_name' 	=> 'text_color_style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'ornaldo')	=> 'text-default'
				,esc_html__('Light', 'ornaldo')		=> 'text-light'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show in a carousel slider', 'ornaldo' )
			,'param_name' 	=> 'is_slider'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> '1'
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> true
			,'value' 		=> '30'
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show pagination dots', 'ornaldo' )
			,'param_name' 	=> 'show_dots'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> esc_html__('If it is set, the navigation buttons will be removed', 'ornaldo')
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
	)
) );

/*** FTC Brands Slider ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Brands Slider', 'ornaldo' ),
	'base' 		=> 'ftc_brands_slider',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style Brand', 'ornaldo' )
			,'param_name' 	=> 'style_brand'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Default', 'ornaldo')	=> 'style-default'
				,esc_html__('Light', 'ornaldo')		=> 'style-light'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> '7'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'ornaldo' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Number of Rows', 'ornaldo' )
		)
		,array(
			'type' 			=> 'ftc_category'
			,'heading' 		=> esc_html__( 'Categories', 'ornaldo' )
			,'param_name' 	=> 'categories'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
			,'class'		=> 'ftc_brand'
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
			,'param_name' 	=> 'margin_image'
			,'admin_label' 	=> false
			,'value' 		=> '32'
			,'description' 	=> esc_html__('Set margin between items', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Activate link', 'ornaldo' )
			,'param_name' 	=> 'active_link'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)

		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'ornaldo' )
			,'param_name' 	=> 'desksmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4
				,esc_html__('5', 'ornaldo')	=> 5
				,esc_html__('6', 'ornaldo')	=> 6

			)
			,'description' 	=> esc_html__('Set items on 991px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'ornaldo' )
			,'param_name' 	=> 'tablet_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 768px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'ornaldo' )
			,'param_name' 	=> 'tabletmini_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 640px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'ornaldo' )
			,'param_name' 	=> 'mobile_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 480px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'ornaldo' )
			,'param_name' 	=> 'mobilesmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 0px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
	)
) );


/*** FTC Google Map ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Google Map', 'ornaldo' ),
	'base' 		=> 'ftc_google_map',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Address', 'ornaldo' )
			,'param_name' 	=> 'address'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> esc_html__('You have to input your API Key in Appearance > Theme Options > General tab', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Height', 'ornaldo' )
			,'param_name' 	=> 'height'
			,'admin_label' 	=> true
			,'value' 		=> 360
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Zoom', 'ornaldo' )
			,'param_name' 	=> 'zoom'
			,'admin_label' 	=> true
			,'value' 		=> 12
			,'description' 	=> esc_html__('Input a number between 0 and 22', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Map Type', 'ornaldo' )
			,'param_name' 	=> 'map_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('ROADMAP', 'ornaldo')		=> 'ROADMAP'
				,esc_html__('SATELLITE', 'ornaldo')		=> 'SATELLITE'
				,esc_html__('HYBRID', 'ornaldo')		=> 'HYBRID'
				,esc_html__('TERRAIN', 'ornaldo')		=> 'TERRAIN'
			)
			,'description' 	=> ''
		)
	)
) );

/*** FTC Countdown ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Countdown', 'ornaldo' ),
	'base' 		=> 'ftc_countdown',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Day', 'ornaldo' )
			,'param_name' 	=> 'day'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Month', 'ornaldo' )
			,'param_name' 	=> 'month'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Year', 'ornaldo' )
			,'param_name' 	=> 'year'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Text Color Style', 'ornaldo' )
			,'param_name' 	=> 'text_color_style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'ornaldo')	=> 'text-default'
				,esc_html__('Light', 'ornaldo')		=> 'text-light'
			)
			,'description' 	=> ''
		)
	)
) );

/*** FTC Feedburner Subscription ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Feedburner Subscription', 'ornaldo' ),
	'base' 		=> 'ftc_feedburner_subscription',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Feedburner ID', 'ornaldo' )
			,'param_name' 	=> 'feedburner_id'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> 'Newsletter'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Intro Text Line 1', 'ornaldo' )
			,'param_name' 	=> 'intro_text'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Button Text', 'ornaldo' )
			,'param_name' 	=> 'button_text'
			,'admin_label' 	=> true
			,'value' 		=> 'Subscribe'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Placeholder Text', 'ornaldo' )
			,'param_name' 	=> 'placeholder_text'
			,'admin_label' 	=> true
			,'value' 		=> 'Enter your email address'
			,'description' 	=> ''
		)
	)
) );

/********************** FTC Product Shortcodes ************************/

/*** FTC Products ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Products', 'ornaldo' ),
	'base' 		=> 'ftc_products',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style of products', 'ornaldo' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('default', 'ornaldo')				=> ''
				
			)
			,'description' => esc_html__( 'Select Style of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'ornaldo' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'ornaldo')		=> 'recent'
				,esc_html__('Sale', 'ornaldo')		=> 'sale'
				,esc_html__('Featured', 'ornaldo')	=> 'featured'
				,esc_html__('Best Selling', 'ornaldo')	=> 'best_selling'
				,esc_html__('Top Rated', 'ornaldo')	=> 'top_rated'
				,esc_html__('Mixed Order', 'ornaldo')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Custom order', 'ornaldo' )
			,'param_name' 	=> 'custom_order'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')			=> 0
				,esc_html__('Yes', 'ornaldo')		=> 1
			)
			,'description' 	=> esc_html__( 'If you enable this option, the Product type option wont be available', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'ornaldo' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'ornaldo')				=> 'none'
				,esc_html__('ID', 'ornaldo')				=> 'ID'
				,esc_html__('Date', 'ornaldo')				=> 'date'
				,esc_html__('Name', 'ornaldo')				=> 'name'
				,esc_html__('Title', 'ornaldo')				=> 'title'
				,esc_html__('Comment count', 'ornaldo')		=> 'comment_count'
				,esc_html__('Random', 'ornaldo')			=> 'rand'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order', 'ornaldo' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Descending', 'ornaldo')		=> 'DESC'
				,esc_html__('Ascending', 'ornaldo')		=> 'ASC'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Products', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Meta position', 'ornaldo' )
			,'param_name' 	=> 'meta_position'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Bottom', 'ornaldo')			=> 'bottom'
				,esc_html__('On Thumbnail', 'ornaldo')	=> 'on-thumbnail'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'ornaldo' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product SKU', 'ornaldo' )
			,'param_name' 	=> 'show_sku'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'ornaldo' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product short description', 'ornaldo' )
			,'param_name' 	=> 'show_short_desc'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'ornaldo' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product label', 'ornaldo' )
			,'param_name' 	=> 'show_label'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'ornaldo' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show add to cart button', 'ornaldo' )
			,'param_name' 	=> 'show_add_to_cart'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show load more button', 'ornaldo' )
			,'param_name' 	=> 'show_load_more'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Load more text', 'ornaldo' )
			,'param_name' 	=> 'load_more_text'
			,'admin_label' 	=> true
			,'value' 		=> 'Show more'
			,'description' 	=> ''
		)
	)
) );

/*** FTC Products Slider ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Products Slider', 'ornaldo' ),
	'base' 		=> 'ftc_products_slider',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Style of products', 'ornaldo' )
			,'param_name' 	=> 'style'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('default', 'ornaldo')				=> ''
				,esc_html__('style 12', 'ornaldo')				=> 'product12'
				,esc_html__('style 16', 'ornaldo')				=> 'newproduct16'
			)
			,'description' => esc_html__( 'Select Style of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'ornaldo' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'ornaldo')		=> 'recent'
				,esc_html__('Sale', 'ornaldo')		=> 'sale'
				,esc_html__('Featured', 'ornaldo')	=> 'featured'
				,esc_html__('Best Selling', 'ornaldo')	=> 'best_selling'
				,esc_html__('Top Rated', 'ornaldo')	=> 'top_rated'
				,esc_html__('Mixed Order', 'ornaldo')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Custom order', 'ornaldo' )
			,'param_name' 	=> 'custom_order'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')			=> 0
				,esc_html__('Yes', 'ornaldo')		=> 1
			)
			,'description' 	=> esc_html__( 'If you enable this option, the Product type option wont be available', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'ornaldo' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'ornaldo')				=> 'none'
				,esc_html__('ID', 'ornaldo')				=> 'ID'
				,esc_html__('Date', 'ornaldo')				=> 'date'
				,esc_html__('Name', 'ornaldo')				=> 'name'
				,esc_html__('Title', 'ornaldo')				=> 'title'
				,esc_html__('Comment count', 'ornaldo')		=> 'comment_count'
				,esc_html__('Random', 'ornaldo')			=> 'rand'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order', 'ornaldo' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Descending', 'ornaldo')		=> 'DESC'
				,esc_html__('Ascending', 'ornaldo')		=> 'ASC'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'ornaldo' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Number of Rows', 'ornaldo' )
		)                    
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 6
			,'description' 	=> esc_html__( 'Number of Products', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Meta position', 'ornaldo' )
			,'param_name' 	=> 'meta_position'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Bottom', 'ornaldo')			=> 'bottom'
				,esc_html__('On Thumbnail', 'ornaldo')	=> 'on-thumbnail'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'ornaldo' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product SKU', 'ornaldo' )
			,'param_name' 	=> 'show_sku'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'ornaldo' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product short description', 'ornaldo' )
			,'param_name' 	=> 'show_short_desc'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'ornaldo' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product label', 'ornaldo' )
			,'param_name' 	=> 'show_label'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'ornaldo' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show add to cart button', 'ornaldo' )
			,'param_name' 	=> 'show_add_to_cart'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show dots button', 'ornaldo' )
			,'param_name' 	=> 'dots'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Position navigation button', 'ornaldo' )
			,'param_name' 	=> 'position_nav'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Top', 'ornaldo')		=> 'nav-top'
				,esc_html__('Bottom', 'ornaldo')	=> 'nav-bottom'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> false
			,'value' 		=> '20'
			,'description' 	=> esc_html__('Set margin between items', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'ornaldo' )
			,'param_name' 	=> 'desksmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 991px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'ornaldo' )
			,'param_name' 	=> 'tablet_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 768px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'ornaldo' )
			,'param_name' 	=> 'tabletmini_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 640px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'ornaldo' )
			,'param_name' 	=> 'mobile_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 480px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'ornaldo' )
			,'param_name' 	=> 'mobilesmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 0px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
	)
) );

/*** FTC Products Widget ***/
vc_map( array(
	'name' 			=> esc_html__( 'FTC Products Widget', 'ornaldo' ),
	'base' 			=> 'ftc_products_widget',
	'class' 		=> '',
	'description' 	=> '',
	'category' 		=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 		=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'ornaldo' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'ornaldo')		=> 'recent'
				,esc_html__('Sale', 'ornaldo')		=> 'sale'
				,esc_html__('Featured', 'ornaldo')	=> 'featured'
				,esc_html__('Best Selling', 'ornaldo')	=> 'best_selling'
				,esc_html__('Top Rated', 'ornaldo')	=> 'top_rated'
				,esc_html__('Mixed Order', 'ornaldo')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 6
			,'description' 	=> esc_html__( 'Number of Products', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'ornaldo' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Thumbnail size', 'ornaldo' )
			,'param_name' 	=> 'thumbnail_size'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('shop_thumbnail', 'ornaldo')		=> 'Product Thumbnails'
				,esc_html__('shop_catalog', 'ornaldo')		=> 'Catalog Images'
				,esc_html__('shop_single', 'ornaldo')	=> 'Single Product Image'
			)
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'ornaldo' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'ornaldo' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'ornaldo' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show in a carousel slider', 'ornaldo' )
			,'param_name' 	=> 'is_slider'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')	=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Row', 'ornaldo' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> false
			,'value' 		=> 3
			,'description' 	=> esc_html__( 'Number of Rows for slider', 'ornaldo' )
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
			,'group'		=> esc_html__('Slider Options', 'ornaldo')
		)
	)
) );

/*** FTC Product Deals Slider ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Product Deals Slider', 'ornaldo' ),
	'base' 		=> 'ftc_product_deals_slider',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'ornaldo' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'ornaldo')		=> 'recent'
				,esc_html__('Featured', 'ornaldo')	=> 'featured'
				,esc_html__('Best Selling', 'ornaldo')	=> 'best_selling'
				,esc_html__('Top Rated', 'ornaldo')	=> 'top_rated'
				,esc_html__('Mixed Order', 'ornaldo')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Item Layout', 'ornaldo' )
			,'param_name' 	=> 'layout'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Grid', 'ornaldo')		=> 'grid'
				,esc_html__('List', 'ornaldo')		=> 'list'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> false
			,'value' 		=> 4
			,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Products', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show counter', 'ornaldo' )
			,'param_name' 	=> 'show_counter'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Counter position', 'ornaldo' )
			,'param_name' 	=> 'counter_position'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Bottom', 'ornaldo')			=> 'bottom'
				,esc_html__('On thumbnail', 'ornaldo')	=> 'on-thumbnail'
			)
			,'description' 	=> ''
			,'dependency' 	=> array('element' => 'show_counter', 'value' => array('1'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'ornaldo' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show gallery list', 'ornaldo' )
			,'param_name' 	=> 'show_gallery'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Gallery position', 'ornaldo' )
			,'param_name' 	=> 'gallery_position'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Bottom out line', 'ornaldo')	=> 'bottom-out'
				,esc_html__('Bottom in line', 'ornaldo')	=> 'bottom-in'
			)
			,'description' 	=> ''
			,'dependency' 	=> array('element' => 'show_counter', 'value' => array('1'))
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product SKU', 'ornaldo' )
			,'param_name' 	=> 'show_sku'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'ornaldo' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product short description', 'ornaldo' )
			,'param_name' 	=> 'show_short_desc'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'ornaldo' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product label', 'ornaldo' )
			,'param_name' 	=> 'show_label'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'ornaldo' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show add to cart button', 'ornaldo' )
			,'param_name' 	=> 'show_add_to_cart'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show dots button', 'ornaldo' )
			,'param_name' 	=> 'dots'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> false
			,'value' 		=> '20'
			,'description' 	=> esc_html__('Set margin between items', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'ornaldo' )
			,'param_name' 	=> 'desksmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 991px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'ornaldo' )
			,'param_name' 	=> 'tablet_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 768px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'ornaldo' )
			,'param_name' 	=> 'tabletmini_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 640px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'ornaldo' )
			,'param_name' 	=> 'mobile_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 480px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'ornaldo' )
			,'param_name' 	=> 'mobilesmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 0px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
	)
) );

/*** FTC Product Categories Slider ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Product Categories Slider', 'ornaldo' ),
	'base' 		=> 'ftc_product_categories_slider',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 4
			,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Rows', 'ornaldo' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Number of Rows', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 5
			,'description' 	=> esc_html__( 'Number of Product Categories', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Parent', 'ornaldo' )
			,'param_name' 	=> 'parent'
			,'admin_label' 	=> true
			,'settings' => array(
				'multiple' 			=> false
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'value' 		=> ''
			,'description' 	=> esc_html__( 'Select a category. Get direct children of this category', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Child Of', 'ornaldo' )
			,'param_name' 	=> 'child_of'
			,'admin_label' 	=> true
			,'settings' => array(
				'multiple' 			=> false
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'value' 		=> ''
			,'description' 	=> esc_html__( 'Select a category. Get all descendents of this category', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'ids'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> esc_html__('Include these categories', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Hide empty product categories', 'ornaldo' )
			,'param_name' 	=> 'hide_empty'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product category title', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product category discription', 'ornaldo' )
			,'param_name' 	=> 'show_discription'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show dots button', 'ornaldo' )
			,'param_name' 	=> 'dots'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Margin', 'ornaldo' )
			,'param_name' 	=> 'margin'
			,'admin_label' 	=> false
			,'value' 		=> '0'
			,'description' 	=> esc_html__('Set margin between items', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Desktop small items', 'ornaldo' )
			,'param_name' 	=> 'desksmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 991px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet items', 'ornaldo' )
			,'param_name' 	=> 'tablet_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 768px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Tablet mini items', 'ornaldo' )
			,'param_name' 	=> 'tabletmini_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 640px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile items', 'ornaldo' )
			,'param_name' 	=> 'mobile_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 480px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Mobile small items', 'ornaldo' )
			,'param_name' 	=> 'mobilesmall_items'
			,'admin_label' 	=> false
			,'value' 		=>  array(
				esc_html__('1', 'ornaldo')	=> 1
				,esc_html__('2', 'ornaldo')	=> 2
				,esc_html__('3', 'ornaldo')	=> 3
				,esc_html__('4', 'ornaldo')	=> 4

			)
			,'description' 	=> esc_html__('Set items on 0px', 'ornaldo')
			,'group'		=> esc_html__('Responsive Options', 'ornaldo')
		)
	)
) );


/*** FTC Products In Category Tabs***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Products Category Tabs', 'ornaldo' ),
	'base' 		=> 'ftc_products_category_tabs',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Product type', 'ornaldo' )
			,'param_name' 	=> 'product_type'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('Recent', 'ornaldo')		=> 'recent'
				,esc_html__('Sale', 'ornaldo')		=> 'sale'
				,esc_html__('Featured', 'ornaldo')	=> 'featured'
				,esc_html__('Best Selling', 'ornaldo')	=> 'best_selling'
				,esc_html__('Top Rated', 'ornaldo')	=> 'top_rated'
				,esc_html__('Mixed Order', 'ornaldo')	=> 'mixed_order'
			)
			,'description' 	=> esc_html__( 'Select type of product', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Custom order', 'ornaldo' )
			,'param_name' 	=> 'custom_order'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')			=> 0
				,esc_html__('Yes', 'ornaldo')		=> 1
			)
			,'description' 	=> esc_html__( 'If you enable this option, the Product type option wont be available', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'ornaldo' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'ornaldo')				=> 'none'
				,esc_html__('ID', 'ornaldo')				=> 'ID'
				,esc_html__('Date', 'ornaldo')				=> 'date'
				,esc_html__('Name', 'ornaldo')				=> 'name'
				,esc_html__('Title', 'ornaldo')				=> 'title'
				,esc_html__('Comment count', 'ornaldo')		=> 'comment_count'
				,esc_html__('Random', 'ornaldo')			=> 'rand'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order', 'ornaldo' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Descending', 'ornaldo')		=> 'DESC'
				,esc_html__('Ascending', 'ornaldo')		=> 'ASC'
			)
			,'dependency' 	=> array('element' => 'custom_order', 'value' => array('1'))
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'colorpicker'
			,'heading' 		=> esc_html__( 'Background Color', 'ornaldo' )
			,'param_name' 	=> 'bg_color'
			,'admin_label' 	=> false
			,'value' 		=> '#f7f6f4'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> 3
			,'description' 	=> esc_html__( 'Number of Columns', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> 6
			,'description' 	=> esc_html__( 'Number of Products', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Categories', 'ornaldo' )
			,'param_name' 	=> 'product_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> esc_html__( 'You select banners, icons in the Product Category editor', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Parent Category', 'ornaldo' )
			,'param_name' 	=> 'parent_cat'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> false
				,'sortable' 		=> false
				,'unique_values' 	=> true
			)
			,'description' 	=> esc_html__('Each tab will be a sub category of this category. This option is available when the Product Categories option is empty', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Include children', 'ornaldo' )
			,'param_name' 	=> 'include_children'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')			=> 0
				,esc_html__('Yes', 'ornaldo')		=> 1
			)
			,'description' 	=> esc_html__( 'Load the products of sub categories in each tab', 'ornaldo' )
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Active tab', 'ornaldo' )
			,'param_name' 	=> 'active_tab'
			,'admin_label' 	=> false
			,'value' 		=> 1
			,'description' 	=> esc_html__( 'Enter active tab number', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product image', 'ornaldo' )
			,'param_name' 	=> 'show_image'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product name', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product SKU', 'ornaldo' )
			,'param_name' 	=> 'show_sku'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product price', 'ornaldo' )
			,'param_name' 	=> 'show_price'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product short description', 'ornaldo' )
			,'param_name' 	=> 'show_short_desc'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product rating', 'ornaldo' )
			,'param_name' 	=> 'show_rating'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product label', 'ornaldo' )
			,'param_name' 	=> 'show_label'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show product categories', 'ornaldo' )
			,'param_name' 	=> 'show_categories'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show add to cart button', 'ornaldo' )
			,'param_name' 	=> 'show_add_to_cart'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show counter', 'ornaldo' )
			,'param_name' 	=> 'show_counter'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show in a carousel slider', 'ornaldo' )
			,'param_name' 	=> 'is_slider'
			,'admin_label' 	=> true
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Rows', 'ornaldo' )
			,'param_name' 	=> 'rows'
			,'admin_label' 	=> true
			,'value' 		=> array(
				'1'			=> '1'
				,'2'		=> '2'
			)
			,'description' 	=> esc_html__( 'Number of Rows in slider', 'ornaldo' )
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show navigation button', 'ornaldo' )
			,'param_name' 	=> 'show_nav'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No', 'ornaldo')		=> 0
				,esc_html__('Yes', 'ornaldo')	=> 1
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Auto play', 'ornaldo' )
			,'param_name' 	=> 'auto_play'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
	)
) );

/*** FTC List Of Product Categories ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC List Of Product Categories', 'ornaldo' ),
	'base' 		=> 'ftc_list_of_product_categories',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Block title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'attach_image'
			,'heading' 		=> esc_html__( 'Background image', 'ornaldo' )
			,'param_name' 	=> 'bg_image'
			,'admin_label' 	=> false
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Hover Image Effect', 'ornaldo' )
			,'param_name' 	=> 'style_smooth'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('No Effect', 'ornaldo')		=> 'no-smooth'
				,esc_html__('Effect-Image Left Right', 'ornaldo')		=> 'smooth-image'
				,esc_html__('Effect Border Image', 'ornaldo')				=> 'smooth-border-image'
				,esc_html__('Effect Background Image', 'ornaldo')		=> 'smooth-background-image'
				,esc_html__('Effect Background Top Image', 'ornaldo')	=> 'smooth-top-image'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Product Category', 'ornaldo' )
			,'param_name' 	=> 'product_cat'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> false
				,'sortable' 		=> false
				,'unique_values' 	=> true
			)
			,'description' 	=> esc_html__('Display sub categories of this category', 'ornaldo')
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Include parent category in list', 'ornaldo' )
			,'param_name' 	=> 'include_parent'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Number of Sub Categories', 'ornaldo' )
			,'param_name' 	=> 'limit_sub_cat'
			,'admin_label' 	=> true
			,'value' 		=> 6
			,'description' 	=> esc_html__( 'Leave blank to show all', 'ornaldo' )
		)
		,array(
			'type' 			=> 'autocomplete'
			,'heading' 		=> esc_html__( 'Include these categories', 'ornaldo' )
			,'param_name' 	=> 'include_cats'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'settings' => array(
				'multiple' 			=> true
				,'sortable' 		=> true
				,'unique_values' 	=> true
			)
			,'description' 	=> esc_html__('If you set the Product Category option above, this option wont be available', 'ornaldo')
		)
	)
) );


/*** FTC Milestone ***/
vc_map( array(
	'name' 		=> esc_html__( 'FTC Milestone', 'ornaldo' ),
	'base' 		=> 'ftc_milestone',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Number', 'ornaldo' )
			,'param_name' 	=> 'number'
			,'admin_label' 	=> true
			,'value' 		=> '0'
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Subject', 'ornaldo' )
			,'param_name' 	=> 'ftc_number_meta'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Text Color Style', 'ornaldo' )
			,'param_name' 	=> 'text_color_style'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Default', 'ornaldo')	=> 'text-default'
				,esc_html__('Light', 'ornaldo')		=> 'text-light'
			)
			,'description' 	=> ''
		)
	)
) );
/* FTC Portfolio */
vc_map( array(
	'name' 		=> esc_html__( 'FTC Portfolio', 'ornaldo' ),
	'base' 		=> 'ftc_portfolio',
	'class' 	=> '',
	'category' 	=> 'ThemeFTC',
	"icon"          => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' 	=> array(
		array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Columns', 'ornaldo' )
			,'param_name' 	=> 'columns'
			,'admin_label' 	=> true
			,'value' 		=> array(
				'2'		=> '2'
				,'3'	=> '3'
				,'4'	=> '4'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Limit', 'ornaldo' )
			,'param_name' 	=> 'per_page'
			,'admin_label' 	=> true
			,'value' 		=> '8'
			,'description' 	=> esc_html__('Number of Posts', 'ornaldo')
		)
		,array(
			'type' 			=> 'ftc_category'
			,'heading' 		=> esc_html__( 'Categories', 'ornaldo' )
			,'param_name' 	=> 'categories'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> ''
			,'class'		=> 'ftc_portfolio'
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order by', 'ornaldo' )
			,'param_name' 	=> 'orderby'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('None', 'ornaldo')		=> 'none'
				,esc_html__('ID', 'ornaldo')		=> 'ID'
				,esc_html__('Date', 'ornaldo')		=> 'date'
				,esc_html__('Name', 'ornaldo')		=> 'name'
				,esc_html__('Title', 'ornaldo')		=> 'title'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Order', 'ornaldo' )
			,'param_name' 	=> 'order'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Descending', 'ornaldo')		=> 'DESC'
				,esc_html__('Ascending', 'ornaldo')		=> 'ASC'
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show portfolio title', 'ornaldo' )
			,'param_name' 	=> 'show_title'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show portfolio date', 'ornaldo' )
			,'param_name' 	=> 'show_date'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show filter bar', 'ornaldo' )
			,'param_name' 	=> 'show_filter_bar'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'dropdown'
			,'heading' 		=> esc_html__( 'Show load more button', 'ornaldo' )
			,'param_name' 	=> 'show_load_more'
			,'admin_label' 	=> false
			,'value' 		=> array(
				esc_html__('Yes', 'ornaldo')	=> 1
				,esc_html__('No', 'ornaldo')	=> 0
			)
			,'description' 	=> ''
		)
		,array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Load more button text', 'ornaldo' )
			,'param_name' 	=> 'load_more_text'
			,'admin_label' 	=> false
			,'value' 		=> 'Show more'
			,'description' 	=> ''
		)
	)
) );
vc_map( array(
	'name' => esc_html__( 'Image Hotspot', 'ornaldo' ),
	'base' => 'ftc_image_hotspot',
	'class' => '',
	'category' => esc_html__( 'ThemeFTC', 'ornaldo' ),
	'description' => esc_html__( 'Add hotspots with products to the image', 'ornaldo' ),
	'icon' => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'as_parent' => array( 'only' => 'ftc_hotspot' ),
	'content_element' => true,
	'show_settings_on_create' => true,
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'ornaldo' ),
			'param_name' => 'img',
			'holder' => 'img',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'ornaldo' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'ornaldo' ),
			'param_name' => 'img_size',
			'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" ', 'ornaldo' )
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Hotspot icon', 'ornaldo' ),
			'param_name' => 'icon',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Hotspot action', 'ornaldo' ),
			'param_name' => 'action',
			'value' =>  array(
				esc_html__( 'Hover', 'ornaldo' ) => 'hover',
				esc_html__( 'Click', 'ornaldo' ) => 'click',
			),
			'description' => esc_html__( 'Open hotspot content on click or hover', 'ornaldo' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'ornaldo' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ornaldo' )
		)
	),
	'js_view' => 'VcColumnView'
) );

vc_map( array(
	'name' => esc_html__( 'Hotspot', 'ornaldo'),
	'base' => 'ftc_hotspot',
	'as_child' => array( 'only' => 'ftc_image_hotspot' ),
	'content_element' => true,
	'category' => esc_html__( 'ThemeFTC', 'ornaldo' ),
	'icon' => get_template_directory_uri() . "/inc/vc_extension/ftc_icon.png",
	'params' => array(
		array(
			'type' => 'ftc_image_hotspot',
			'heading' => esc_html__( 'Hotspot', 'ornaldo' ),
			'param_name' => 'hotspot',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Hotspot content', 'ornaldo' ),
			'param_name' => 'hotspot_type',
			'value' =>  array(
				esc_html__( 'Product', 'ornaldo' ) => 'product',
				esc_html__( 'Text', 'ornaldo' ) => 'text'
			),
			'description' => esc_html__( 'You can display any product or custom text in the hotspot content.', 'ornaldo' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Hotspot dropdown side', 'ornaldo' ),
			'param_name' => 'hotspot_dropdown_side',
			'value' =>  array(
				esc_html__( 'Left', 'ornaldo' ) => 'left',
				esc_html__( 'Right', 'ornaldo' ) => 'right',
				esc_html__( 'Top', 'ornaldo' ) => 'top',
				esc_html__( 'Bottom', 'ornaldo' ) => 'bottom',
			),
			'description' => esc_html__( 'Show the content on left or right side, top or bottom.', 'ornaldo' )
		),
				//Product
		array(
			'type' => 'autocomplete',
			'heading' => esc_html__( 'Select product', 'ornaldo' ),
			'param_name' => 'product_id',
			'description' => esc_html__( 'Add products by title.', 'ornaldo' ),
			'settings' => array(
				'multiple' => false,
				'sortable' => true,
				'groups' => true
			),
			'dependency' => array(
				'element' => 'hotspot_type',
				'value' => array( 'product' )
			)
		),
				//text
		array(
			'type' 			=> 'textfield'
			,'heading' 		=> esc_html__( 'Text title', 'ornaldo' )
			,'param_name' 	=> 'title'
			,'admin_label' 	=> true
			,'value' 		=> ''
			,'description' 	=> '',
			'element' => 'hotspot_type',
			
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Hotspot text side', 'ornaldo' ),
			'param_name' => 'hotspot_text_side',
			'value' =>  array(
				esc_html__( 'Left', 'ornaldo' ) => 'left',
				esc_html__( 'Right', 'ornaldo' ) => 'right',
				esc_html__( 'Top', 'ornaldo' ) => 'top',
				esc_html__( 'Bottom', 'ornaldo' ) => 'bottom',
			),
			'description' => esc_html__( 'Show the content on left or right side, top or bottom.', 'ornaldo' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'ornaldo' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'ornaldo' )
		)
	),
) );
if( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ftc_image_hotspot extends WPBakeryShortCodesContainer {}
}

		// Replace Wbc_Inner_Item with your base name from mapping for nested element
if( class_exists( 'WPBakeryShortCode' ) ){
	class WPBakeryShortCode_ftc_hotspot extends WPBakeryShortCode {}
}

add_filter( 'vc_autocomplete_ftc_hotspot_product_id_callback',	'ftc_productIdAutocompleteSuggester', 10, 1 ); 
add_filter( 'vc_autocomplete_ftc_image_hotspot_product_id_render','ftc_productIdAutocompleteSuggester', 10, 1 );

if ( ! function_exists( 'ftc_productIdAutocompleteSuggester' ) ) {
	function ftc_productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title, b.meta_value AS sku
			FROM {$wpdb->posts} AS a
			LEFT JOIN ( SELECT meta_value, post_id  FROM {$wpdb->postmeta} WHERE `meta_key` = '_sku' ) AS b ON b.post_id = a.ID
			WHERE a.post_type = 'product' AND ( a.ID = '%d' OR b.meta_value LIKE '%%%s%%' OR a.post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = __( 'Id', 'ornaldo' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . __( 'Title', 'ornaldo' ) . ': ' . $value['title'] : '' ) . ( ( strlen( $value['sku'] ) > 0 ) ? ' - ' . __( 'Sku', 'ornaldo' ) . ': ' . $value['sku'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}
}

}

/*** Add Shortcode Param ***/
WpbakeryShortcodeParams::addField('ftc_category', 'ftc_product_catgories_shortcode_param');
if( !function_exists('ftc_product_catgories_shortcode_param') ){
	function ftc_product_catgories_shortcode_param($settings, $value){
		$categories = ftc_get_list_categories_shortcode_param(0, $settings);
		$arr_value = explode(',', $value);
		ob_start();
		?>
		<input type="hidden" class="wpb_vc_param_value wpb-textinput product_cats textfield ftc-hidden-selected-categories" name="<?php echo esc_attr($settings['param_name']); ?>" value="<?php echo esc_attr($value); ?>" />
		<div class="categorydiv">
			<div class="tabs-panel">
				<ul class="categorychecklist">
					<?php foreach($categories as $cat){ ?>
						<li>
							<label>
								<input type="checkbox" class="checkbox ftc-select-category" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo (in_array($cat->term_id, $arr_value))?'checked':''; ?> />
								<?php echo esc_html($cat->name); ?>
							</label>
							<?php ftc_get_list_sub_categories_shortcode_param($cat->term_id, $arr_value, $settings); ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
			jQuery('.ftc-select-category').on('change', function(){
				"use strict";
				
				var selected = jQuery('.ftc-select-category:checked');
				jQuery('.ftc-hidden-selected-categories').val('');
				var selected_id = new Array();
				selected.each(function(index, ele){
					selected_id.push(jQuery(ele).val());
				});
				selected_id = selected_id.join(',');
				jQuery('.ftc-hidden-selected-categories').val(selected_id);
			});
		</script>
		<?php
		return ob_get_clean();
	}
}

if( !function_exists('ftc_get_list_categories_shortcode_param') ){
	function ftc_get_list_categories_shortcode_param( $cat_parent_id, $settings ){
		$taxonomy = 'product_cat';
		if( isset($settings['class']) ){
			if( $settings['class'] == 'post_cat' ){
				$taxonomy = 'category';
			}
			if( $settings['class'] == 'ftc_testimonial' ){
				$taxonomy = 'ftc_testimonial_cat';
			}
			if( $settings['class'] == 'ftc_portfolio' ){
				$taxonomy = 'ftc_portfolio_cat';
			}
			if( $settings['class'] == 'ftc_brand' ){
				$taxonomy = 'ftc_brand_cat';
			}
		}
		
		$args = array(
			'taxonomy' 			=> $taxonomy
			,'hierarchical'		=> 1
			,'hide_empty'		=> 0
			,'parent'			=> $cat_parent_id
			,'title_li'			=> ''
			,'child_of'			=> 0
		);
		$cats = get_categories($args);
		return $cats;
	}
}

if( !function_exists('ftc_get_list_sub_categories_shortcode_param') ){
	function ftc_get_list_sub_categories_shortcode_param( $cat_parent_id, $arr_value, $settings ){
		$sub_categories = ftc_get_list_categories_shortcode_param($cat_parent_id, $settings); 
		if( count($sub_categories) > 0){
			?>
			<ul class="children">
				<?php foreach( $sub_categories as $sub_cat ){ ?>
					<li>
						<label>
							<input type="checkbox" class="checkbox ftc-select-category" value="<?php echo esc_attr($sub_cat->term_id); ?>" <?php echo (in_array($sub_cat->term_id, $arr_value))?'checked':''; ?> />
							<?php echo esc_html($sub_cat->name); ?>
						</label>
						<?php ftc_get_list_sub_categories_shortcode_param($sub_cat->term_id, $arr_value, $settings); ?>
					</li>
				<?php } ?>
			</ul>
		<?php }
	}
}

if( class_exists('Vc_Vendor_Woocommerce') ){
	$vc_woo_vendor = new Vc_Vendor_Woocommerce();

	/* autocomplete callback */
	add_filter( 'vc_autocomplete_ftc_products_ids_callback', array($vc_woo_vendor, 'productIdAutocompleteSuggester') );
	add_filter( 'vc_autocomplete_ftc_products_ids_render', array($vc_woo_vendor, 'productIdAutocompleteRender') );


	$shortcode_field_cats = array();
	$shortcode_field_cats[] = array('ftc_products', 'product_cats');
	$shortcode_field_cats[] = array('ftc_products_slider', 'product_cats');
	$shortcode_field_cats[] = array('ftc_products_widget', 'product_cats');
	$shortcode_field_cats[] = array('ftc_product_deals_slider', 'product_cats');
	$shortcode_field_cats[] = array('ftc_products_category_tabs', 'product_cats');
	$shortcode_field_cats[] = array('ftc_products_category_tabs', 'parent_cat');
	$shortcode_field_cats[] = array('ftc_list_of_product_categories', 'product_cat');
	$shortcode_field_cats[] = array('ftc_list_of_product_categories', 'include_cats');
	$shortcode_field_cats[] = array('ftc_product_categories_slider', 'parent');
	$shortcode_field_cats[] = array('ftc_product_categories_slider', 'child_of');
	$shortcode_field_cats[] = array('ftc_product_categories_slider', 'ids');
	
	foreach( $shortcode_field_cats as $shortcode_field ){
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_callback', array($vc_woo_vendor, 'productCategoryCategoryAutocompleteSuggester') );
		add_filter( 'vc_autocomplete_'.$shortcode_field[0].'_'.$shortcode_field[1].'_render', array($vc_woo_vendor, 'productCategoryCategoryRenderByIdExact') );
	}
}
?>