<?php
/**
 * Clothing Store: Customizer
 *
 * @subpackage Clothing Store
 * @since 1.0
 */

function clothing_store_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// Add custom control.
  	require get_parent_theme_file_path( 'inc/customize/customize_toggle.php' );

	// Register the custom control type.
	$wp_customize->register_control_type( 'Clothing_Store_Toggle_Control' );

 	$wp_customize->add_section('clothing_store_pro', array(
        'title'    => __('UPGRADE CLOTHING STORE PREMIUM', 'clothing-store'),
        'priority' => 1,
    ));

    $wp_customize->add_setting('clothing_store_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Clothing_Store_Pro_Control($wp_customize, 'clothing_store_pro', array(
        'label'    => __('Clothing Store PREMIUM', 'clothing-store'),
        'section'  => 'clothing_store_pro',
        'settings' => 'clothing_store_pro',
        'priority' => 1,
    )));

	// Post Layouts
    $wp_customize->add_section('clothing_store_layout',array(
        'title' => __('Post Layout', 'clothing-store'),
        'description' => __( 'Change the post layout from below options', 'clothing-store' ),
        'priority' => 1
    ) );

	$wp_customize->add_setting( 'clothing_store_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_post_sidebar', array(
		'label'       => esc_html__( 'Show Fullwidth', 'clothing-store' ),
		'section'     => 'clothing_store_layout',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_post_sidebar',
	) ) );

	$wp_customize->add_setting( 'clothing_store_single_post_sidebar', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_single_post_sidebar', array(
		'label'       => esc_html__( 'Show Single Post Fullwidth', 'clothing-store' ),
		'section'     => 'clothing_store_layout',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_single_post_sidebar',
	) ) );

    $wp_customize->add_setting('clothing_store_post_option',array(
		'default' => 'simple_post',
		'sanitize_callback' => 'clothing_store_sanitize_select'
	));
	$wp_customize->add_control('clothing_store_post_option',array(
		'label' => esc_html__('Select Layout','clothing-store'),
		'section' => 'clothing_store_layout',
		'setting' => 'clothing_store_post_option',
		'type' => 'radio',
        'choices' => array(
            'simple_post' => __('Simple Post','clothing-store'),
            'grid_post' => __('Grid Post','clothing-store'),
        ),
	));

    $wp_customize->add_setting('clothing_store_grid_column',array(
		'default' => '3_column',
		'sanitize_callback' => 'clothing_store_sanitize_select'
	));
	$wp_customize->add_control('clothing_store_grid_column',array(
		'label' => esc_html__('Grid Post Per Row','clothing-store'),
		'section' => 'clothing_store_layout',
		'setting' => 'clothing_store_grid_column',
		'type' => 'radio',
        'choices' => array(
            '1_column' => __('1','clothing-store'),
            '2_column' => __('2','clothing-store'),
            '3_column' => __('3','clothing-store'),
            '4_column' => __('4','clothing-store'),
            '5_column' => __('6','clothing-store'),
        ),
	));

	$wp_customize->add_setting( 'clothing_store_date', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_date', array(
		'label'       => esc_html__( 'Hide Date', 'clothing-store' ),
		'section'     => 'clothing_store_layout',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_date',
	) ) );

	$wp_customize->add_setting( 'clothing_store_admin', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_admin', array(
		'label'       => esc_html__( 'Hide Author/Admin', 'clothing-store' ),
		'section'     => 'clothing_store_layout',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_admin',
	) ) );

	$wp_customize->add_setting( 'clothing_store_comment', array(
		'default'           => true,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_comment', array(
		'label'       => esc_html__( 'Hide Comment', 'clothing-store' ),
		'section'     => 'clothing_store_layout',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_comment',
	) ) );

	// Top Header
    $wp_customize->add_section('clothing_store_top',array(
        'title' => __('Contact info', 'clothing-store'),
        'priority' => 1
    ) );

    $wp_customize->add_setting('clothing_store_top_phone',array(
		'default' => '',
		'sanitize_callback' => 'clothing_store_sanitize_phone_number'
	));
	$wp_customize->add_control('clothing_store_top_phone',array(
		'label' => esc_html__('Add Phone','clothing-store'),
		'section' => 'clothing_store_top',
		'setting' => 'clothing_store_top_phone',
		'type'    => 'text'
	));
    
    $wp_customize->add_setting('clothing_store_top_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('clothing_store_top_text',array(
		'label' => esc_html__('Add Text','clothing-store'),
		'section' => 'clothing_store_top',
		'setting' => 'clothing_store_top_text',
		'type'    => 'text'
	));

	// Social Media
    $wp_customize->add_section('clothing_store_urls',array(
        'title' => __('Social Media', 'clothing-store'),
        'description' => __( 'Add social media links in the below feilds', 'clothing-store' ),
        'priority' => 3
    ) );
    
	$wp_customize->add_setting('clothing_store_facebook',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	)); 
	$wp_customize->add_control('clothing_store_facebook',array(
		'label' => esc_html__('Facebook URL','clothing-store'),
		'section' => 'clothing_store_urls',
		'setting' => 'clothing_store_facebook',
		'type'    => 'url'
	));

	$wp_customize->add_setting('clothing_store_twitter',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	)); 
	$wp_customize->add_control('clothing_store_twitter',array(
		'label' => esc_html__('Twitter URL','clothing-store'),
		'section' => 'clothing_store_urls',
		'setting' => 'clothing_store_twitter',
		'type'    => 'url'
	));

	$wp_customize->add_setting('clothing_store_youtube',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	)); 
	$wp_customize->add_control('clothing_store_youtube',array(
		'label' => esc_html__('Youtube URL','clothing-store'),
		'section' => 'clothing_store_urls',
		'setting' => 'clothing_store_youtube',
		'type'    => 'url'
	));

	$wp_customize->add_setting('clothing_store_instagram',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	)); 
	$wp_customize->add_control('clothing_store_instagram',array(
		'label' => esc_html__('Instagram URL','clothing-store'),
		'section' => 'clothing_store_urls',
		'setting' => 'clothing_store_instagram',
		'type'    => 'url'
	));

    //Slider
	$wp_customize->add_section( 'clothing_store_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'clothing-store' ),
    	'description' => __('Slider Image Dimension ( 500px x 500px )','clothing-store'),
		'priority'   => 3,
	) );

	$wp_customize->add_setting( 'clothing_store_slider_arrows', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => 'clothing_store_sanitize_checkbox',
	) );
	$wp_customize->add_control( new Clothing_Store_Toggle_Control( $wp_customize, 'clothing_store_slider_arrows', array(
		'label'       => esc_html__( 'Check to show slider', 'clothing-store' ),
		'section'     => 'clothing_store_slider_section',
		'type'        => 'toggle',
		'settings'    => 'clothing_store_slider_arrows',
	) ) );

	$args = array('numberposts' => -1); 
	$post_list = get_posts($args);
	$i = 0;	
	$pst_sls[]= __('Select','clothing-store');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting('clothing_store_post_setting'.$i,array(
			'sanitize_callback' => 'clothing_store_sanitize_select',
		));
		$wp_customize->add_control('clothing_store_post_setting'.$i,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','clothing-store'),
			'section' => 'clothing_store_slider_section',
		));
	}
	wp_reset_postdata();

	$wp_customize->add_setting('clothing_store_product_discount_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('clothing_store_product_discount_text',array(
		'label' => esc_html__('Discount Text','clothing-store'),
		'section' => 'clothing_store_slider_section',
		'setting' => 'clothing_store_product_discount_text',
		'type'    => 'text'
	));

	$wp_customize->add_setting('clothing_store_product_discount_number',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('clothing_store_product_discount_number',array(
		'label' => esc_html__('Discount Number','clothing-store'),
		'section' => 'clothing_store_slider_section',
		'setting' => 'clothing_store_product_discount_number',
		'type'    => 'text'
	));


	// Product
    $wp_customize->add_section('clothing_store_millions_of_hours_section',array(
		'title'	=> __('Product Settings','clothing-store'),
		'priority'	=> 4,
	));

	$wp_customize->add_setting('clothing_store_millions_of_hours_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('clothing_store_millions_of_hours_heading',array(
		'type' => 'text',
		'label' => __('Heading Text','clothing-store'),
		'section' => 'clothing_store_millions_of_hours_section',
	));

	$wp_customize->add_setting('clothing_store_millions_of_hours_sub_heading',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('clothing_store_millions_of_hours_sub_heading',array(
		'type' => 'text',
		'label' => __('Sub Heading Text','clothing-store'),
		'section' => 'clothing_store_millions_of_hours_section',
	));

    $wp_customize->add_setting('clothing_store_millions_of_hours_countdown_timer',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('clothing_store_millions_of_hours_countdown_timer',array(
		'label'	=> esc_html__('Add Countdown Timer','clothing-store'),
		'description'	=> esc_html__('Ex: 20 Octobar 2021','clothing-store'),
		'section'	=> 'clothing_store_millions_of_hours_section',
		'type'		=> 'text'
	));

	// Product settings
	$args = array(
	    'type'                     => 'product',
	    'child_of'                 => 0,
	    'parent'                   => '',
	    'orderby'                  => 'term_group',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'hierarchical'             => 1,
	    'number'                   => '',
	    'taxonomy'                 => 'product_cat',
	    'pad_counts'               => false
	);
	$categories = get_categories($args);
	$cat_posts = array();
	$m = 0;
	$cat_posts[]='Select';
	foreach($categories as $category){
	if($m==0){
		$default = $category->slug;
			$m++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('clothing_store_millions_of_hours_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'clothing_store_sanitize_select',
	));
	$wp_customize->add_control('clothing_store_millions_of_hours_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select category to display products ','clothing-store'),
		'section' => 'clothing_store_millions_of_hours_section',
	));
    
	//Footer
    $wp_customize->add_section( 'clothing_store_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'clothing-store' ),
    	'priority' => 6
	) );

    $wp_customize->add_setting('clothing_store_footer_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('clothing_store_footer_text',array(
		'label'	=> esc_html__('Copyright Text','clothing-store'),
		'section'	=> 'clothing_store_footer_copyright',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'clothing_store_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'clothing_store_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'clothing_store_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'clothing_store_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'clothing-store' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'clothing-store' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'clothing_store_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'clothing_store_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'clothing_store_customize_register' );

function clothing_store_customize_partial_blogname() {
	bloginfo( 'name' );
}
function clothing_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function clothing_store_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function clothing_store_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('CLOTHING_STORE_PRO_LINK',__('https://www.ovationthemes.com/wordpress/clothing-store-wordpress-theme/','clothing-store'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Clothing_Store_Pro_Control')):
    class Clothing_Store_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( CLOTHING_STORE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CLOTHING STORE PREMIUM','clothing-store');?> </a>
	        </div>
            <div class="col-md">
                <img class="clothing_store_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('Clothing Store PREMIUM - Features', 'clothing-store'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'clothing-store');?> </li>
                    <li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'clothing-store');?> </li>
                   	<li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'clothing-store');?> </li>
                   	<li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'clothing-store');?> </li>
                   	<li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'clothing-store');?> </li>
                   	<li class="upsell-clothing_store"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'clothing-store');?> </li>
                </ul>
        	</div>
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( CLOTHING_STORE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE CLOTHING STORE PREMIUM','clothing-store');?> </a>
		    </div>
        </label>
    <?php } }
endif;