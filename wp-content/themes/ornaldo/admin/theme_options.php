<?php

/**
 * FTC Theme Options
 */

if (!class_exists('Redux_Framework_smof_data')) {

    class Redux_Framework_smof_data {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {

        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        public function setSections() {

            /* Default Sidebar */
            global $ftc_default_sidebars;
            $of_sidebars    = array();
            if( $ftc_default_sidebars ){
                foreach( $ftc_default_sidebars as $key => $_sidebar ){
                    $of_sidebars[$_sidebar['id']] = $_sidebar['name'];
                }
            }
			$args = array(
            'post_type' => 'ftc_header'
            ,'post_status' => 'publish'
            ,'posts_per_page' => -1
        );

        $posts = new WP_Query($args);
        $header_blocks = array();
        if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
            foreach( $posts->posts as $p ){
                $header_blocks[$p->ID] = $p->post_title;
            }
		}
            $ftc_layouts = array(
                '0-1-0'     => get_template_directory_uri(). '/admin/images/1col.png'
                ,'0-1-1'    => get_template_directory_uri(). '/admin/images/2cr.png'
                ,'1-1-0'    => get_template_directory_uri(). '/admin/images/2cl.png'
                ,'1-1-1'    => get_template_directory_uri(). '/admin/images/3cm.png'
            );

            /***************************/ 
            /***   General Options   ***/
            /***************************/
            $this->sections[] = array(
                'icon' => 'fa fa-home',
                'icon_class' => 'icon',
                'title' => esc_html__('General', 'ornaldo'),
                'fields' => array(				
                )
            );	 

            /** Logo - Favicon **/
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Logo - Favicon', 'ornaldo'),
                'fields' => array(			
                  array(
                    'id'=>'ftc_logo',
                    'type' => 'media',
                    'compiler'  => 'true',
                    'mode'      => false,
                    'title' => esc_html__('Logo Image', 'ornaldo'),
                    'desc'      => esc_html__('Select an image file for the main logo', 'ornaldo'),
                    'default' => array(
                        'url' => get_template_directory_uri(). '/assets/images/logo.png'
                    )
                )				
                  ,array(
                    'id'=>'ftc_favicon',
                    'type' => 'media',
                    'compiler'  => 'true',
                    'mode'      => false,
                    'title' => esc_html__('Favicon Image', 'ornaldo'),
                    'desc'      => esc_html__('Accept ICO files', 'ornaldo'),
                    'default' => array(
                        'url' => get_template_directory_uri(). '/assets/images/favicon.ico'
                    )
                )
                  ,array(
                    'id'=>'ftc_text_logo',
                    'type' => 'text',
                    'title' => esc_html__('Text Logo', 'ornaldo'),
                    'default' => 'Ornaldo Store'
                ),
                  array(
                    'id'=>'ftc_logo_mobile',
                    'type' => 'media',
                    'compiler'  => 'true',
                    'mode'      => false,
                    'title' => esc_html__('Logo Mobile Image', 'ornaldo'),
                    'desc'      => '',
                    'default' => array(
                        'url' => get_template_directory_uri(). '/assets/images/logo_mobile.png'
                    )
                )				
              )
            );

            /* Popup Newletter */
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Popup Newletter', 'ornaldo'),
                'fields' => array(                    
                    array(
                        'id'=>'ftc_enable_popup',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Popup Newletter', 'ornaldo'),
                        'desc'     => '',
                        'on' => esc_html__('Yes', 'ornaldo'),
                        'off' => esc_html__('No', 'ornaldo'),
                        'default' => 1,
                    ),
                    array(
                        'id'=>'ftc_bg_popup_image',
                        'type' => 'media',
                        'title' => esc_html__('Popup Newletter Background Image', 'ornaldo'),
                        'desc'     => esc_html__("Select a new image to override current background image", "ornaldo"),
                        'default'   =>array(
                            'url' => get_template_directory_uri(). '/assets/images/bg_news2.jpg'
                        )
                    ),  
                    array( 
                        'title' => esc_html__('Single Portfolio Full', 'ornaldo')
                        ,'desc' => ''
                        ,'id' => 'ftc_port_single_style'
                        ,'default' => 1
                        ,'type' => 'switch'
                    ),                 
                )
            );

            /** Header Options **/
            $this->sections[] = array(
                'icon' => 'icofont icofont-double-right',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Header of inner Pages', 'ornaldo'),
                'fields' => array(	
                 array(
                  'id'=>'ftc_header_layout',
                  'type' => 'image_select',
                  'full_width' => true,
                  'title' => esc_html__('Header Layout', 'ornaldo'),
                  'subtitle' => esc_html__('This header style will be showed only in inner pages, please go to Pages > Homepage to change header for front page.', 'ornaldo'),
                  'options' => array(
                    'layout1'   => get_template_directory_uri() . '/admin/images/header/layout1.jpg'
                    ,'layout2'  => get_template_directory_uri() . '/admin/images/header/layout2.jpg'
                    ,'layout3'  => get_template_directory_uri() . '/admin/images/header/layout3.jpg'
                    ,'layout5'  => get_template_directory_uri() . '/admin/images/header/layout5.jpg'
                    ,'layout6'  => get_template_directory_uri() . '/admin/images/header/layout6.jpg'
                    ,'layout7'  => get_template_directory_uri() . '/admin/images/header/layout7.jpg'
                    ,'layout8'  => get_template_directory_uri() . '/admin/images/header/layout8.jpg'
                    ,'layout9'  => get_template_directory_uri() . '/admin/images/header/layout9.jpg'
                    ,'layout10'  => get_template_directory_uri() . '/admin/images/header/layout10.jpg'
                    ,'template' => get_template_directory_uri() . '/admin/images/header/header-template.jpg'



                ),
                  'default' => 'layout1'
              ),array(
                'id' => 'ftc_header_template',
                'type' => 'select',
                'title' => esc_html__('Select Header Template', 'ornaldo'),
                'options' => $header_blocks,
                'default' => '',
            ),
              array(
                'id'=>'ftc_header_contact_information',
                'type' => 'textarea',
                'title' => esc_html__('Header nav Information', 'ornaldo'),
                'default' => '',
            ),					
              array(
                'id'=>'ftc_middle_header_content',
                'type' => 'textarea',
                'title' => esc_html__('Header Content - Information', 'ornaldo'),
                'default' => esc_html__('Default wellcome msg!', 'ornaldo'),
            ),
              array(
                'id'=>'ftc_mobile_layout',
                'type' => 'switch',
                'title' => esc_html__('Mobile Layout', 'ornaldo'),
                'default' => 1,
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
            ),  
              array(   
                "title"     => esc_html__("Header Sticky", "ornaldo"),
                "desc"     => esc_html__("Add header sticky. Please disable sticky mega main menu", "ornaldo"),
                "id"       => "ftc_enable_sticky_header",
                'default'  => 1,
                "on"       => esc_html__("Enable", "ornaldo"),
                "off"      => esc_html__("Disable", "ornaldo"),
                "type"     => "switch",
            ),
              array(
                'id'=>'ftc_header_currency',
                'type' => 'switch',
                'title' => esc_html__('Header Currency', 'ornaldo'),
                'default' => 1,
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
            ),
              array(
                'id'=>'ftc_header_language',
                'type' => 'switch',
                'title' => esc_html__('Header Language', 'ornaldo'),
                'desc'     => esc_html__("If you don't install WPML plugin, it will display demo html", "ornaldo"),
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
                'default' => 1,
            ),
              array(
                'id'=>'ftc_enable_tiny_shopping_cart',
                'type' => 'switch',
                'title' => esc_html__('Shopping Cart', 'ornaldo'),
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
                'default' => 1,
            ),
              array(
                'id' => 'ftc_cart_layout', 
                'type' => 'select',
                'title' => esc_html__('Cart Layout', 'ornaldo'),
                'options' => array(
                    'dropdown' => esc_html__('Dropdown', 'ornaldo') ,
                    'off-canvas'    => esc_html__('Off Canvas', 'ornaldo')
                ),
                'default' => 'off-canvas',
            ),
              array(
                'id'=>'ftc_enable_search',
                'type' => 'switch',
                'title' => esc_html__('Search Bar', 'ornaldo'),
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
                'default' => 1,
            ),
              array(
                'id'=>'ftc_enable_tiny_account',
                'type' => 'switch',
                'title' => esc_html__('My Account', 'ornaldo'),
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
                'default' => 1,
            ),
              array(
                'id'=>'ftc_enable_tiny_wishlist',
                'type' => 'switch',
                'title' => esc_html__('Wishlist', 'ornaldo'),
                'on' => esc_html__('Enable', 'ornaldo'),
                'off' => esc_html__('Disable', 'ornaldo'),
                'default' => 1,
            ),
              array(   "title"      => esc_html__("Check out", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_enable_tiny_checkout"
                ,"default"      => "1"
                ,"on"       => esc_html__("Enable", "ornaldo")
                ,"off"      => esc_html__("Disable", "ornaldo")
                ,"type"     => "switch"
            ),
               array(
                'id'         => 'ftc_header_social_editor',
                'type'       => 'editor',
                'full_width' => true,
                'title'      => __( 'Custom content social editor', 'ornaldo' ),
                'subtitle'   => __( 'Paste your content here.', 'ornaldo' ),
                'mode'       => 'php',
                'desc'       => '',
                'default'    => ''
            )

          )
);	




$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Breadcrumb', 'ornaldo'),
    'fields' => array(
        array(
            'id'=>'ftc_bg_breadcrumbs',
            'type' => 'media',
            'title' => esc_html__('Breadcrumbs Background Image', 'ornaldo'),
            'desc'     => esc_html__("Select a new image to override current background image", "ornaldo"),
            'default'   =>array(
                'url' => get_template_directory_uri(). '/assets/images/banner-shop.jpg'
            )
        ),
        array(
            'id'=>'ftc_enable_breadcrumb_background_image',
            'type' => 'switch',
            'title' => esc_html__('Enable Breadcrumb Background Image', 'ornaldo'),
            'desc'     => esc_html__("You can set background color by going to Color Scheme tab > Breadcrumb Colors section", "ornaldo"),
            'on' => esc_html__('Enable', 'ornaldo'),
            'off' => esc_html__('Disable', 'ornaldo'),
            'default' => 1,
        ),   
        array(
  
         'id'=>'ftc_enable_category_breadcrumb',
 
         'type' => 'switch',
 
         'title' => esc_html__('Enable List Categories Product', 'ornaldo'),
  
         'on' => esc_html__('Yes', 'ornaldo'),
 
         'off' => esc_html__('No', 'ornaldo'),
    
      'default' => 1,
        
      ),                
    )
);

/** Back top top **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Back to top', 'ornaldo'),
    'fields' => array(
        array(
            'id'=>'ftc_back_to_top_button',
            'type' => 'switch',
            'title' => esc_html__('Enable Back To Top Button', 'ornaldo'),
            'default' => true,
            'on' => esc_html__('Enable', 'ornaldo'),
            'off' => esc_html__('Disable', 'ornaldo'),
        )  
        ,array(
            'id'=>'ftc_back_to_top_button_on_mobile',
            'type' => 'switch',
            'title' => esc_html__('Enable Back To Top Button On Mobile', 'ornaldo'),
            'default' => true,
            'on' => esc_html__('Enable', 'ornaldo'),
            'off' => esc_html__('Disable', 'ornaldo'),
        )                   
    )
);
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Google Map API Key', 'ornaldo'),
    'fields' => array(
        array(
            'id'=>'ftc_gmap_api_key',
            'type' => 'text',
            'title' => esc_html__('Enter your API key', 'ornaldo'),
            'default' => 'AIzaSyAypdpHW1-ENvAZRjteinZINafSBpAYxDE',
        )                   
    )
);
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Widget Classic Editor', 'ornaldo'),   
    'fields' => array(
        array(
            'id'=>'ftc_widget_classic_editor',
            'type' => 'switch',
            'title' => esc_html__('Enable Classic Editor', 'ornaldo'),
            'description' => esc_html__('You can switch between Live Editor and Classic Editor in the Widgets page.' , 'ornaldo'),
            'default' => false,
            'on' => esc_html__('Yes', 'ornaldo'),
            'off' => esc_html__('No', 'ornaldo'),
        )                   
    )
);
/* Cookie Notice */
$this->sections[] = array(
    'icon' => 'el el-facetime-video',
    'icon_class' => 'icon',
    'title' => esc_html__('Cookie Notice', 'ornaldo'),
    'fields' => array(
     array (
        'id'       => 'cookies_info',
        'type'     => 'switch',
        'title'    => esc_html__('Show cookies info', 'ornaldo'),
        'subtitle' => esc_html__('Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'ornaldo'),
        'default' => false
    ),
     array (
        'id'       => 'cookies_text',
        'type'     => 'editor',
        'title'    => esc_html__('Popup text', 'ornaldo'),
        'subtitle' => esc_html__('Place here some information about cookies usage that will be shown in the popup.', 'ornaldo'),
        'default' => esc_html__('We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'ornaldo'),
    ),

     array (
        'id'       => 'cookies_version',
        'type'     => 'text',
        'title'    => esc_html__('Cookies version', 'ornaldo'),
        'subtitle' => esc_html__('If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'ornaldo'),
        'default' => 1,
    ),              
 )
);
/* * *  Typography  * * */
$this->sections[] = array(
    'icon' => 'icofont icofont-brand-appstore',
    'icon_class' => 'icon',
    'title' => esc_html__('Styling', 'ornaldo'),
    'fields' => array(				
    )
);	

/** Color Scheme Options  * */
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Color Scheme', 'ornaldo'),
    'fields' => array(					
       array(
          'id' => 'ftc_primary_color',
          'type' => 'color',
          'title' => esc_html__('Primary Color', 'ornaldo'),
          'subtitle' => esc_html__('Select a main color for your site.', 'ornaldo'),
          'default' => '#e74c3c',
          'transparent' => false,
      ),				 
       array(
          'id' => 'ftc_secondary_color',
          'type' => 'color',
          'title' => esc_html__('Secondary Color', 'ornaldo'),
          'default' => '#444444',
          'transparent' => false,
      ),
       array(
          'id' => 'ftc_body_background_color',
          'type' => 'color',
          'title' => esc_html__('Body Background Color', 'ornaldo'),
          'default' => '#ffffff',
          'transparent' => false,
      ),	
   )
);

/** Typography Config    **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Typography', 'ornaldo'),
    'fields' => array(
        array(
            'id'=>'ftc_body_font_enable_google_font',
            'type' => 'switch',
            'title' => esc_html__('Body Font - Enable Google Font', 'ornaldo'),
            'default' => 1,
            'folds'    => 1,
            'on' => esc_html__('Enable', 'ornaldo'),
            'off' => esc_html__('Disable', 'ornaldo'),
        ),
        array(
            'id'=>'ftc_body_font_family',
            'type'          => 'select',
            'title'         => esc_html__('Body Font - Family Font', 'ornaldo'),
            'default'       => 'Arial',
            'options'            => array(
                "Arial" => "Arial"
                ,"Advent Pro" => "Advent Pro"
                ,"Verdana" => "Verdana, Geneva"
                ,"Trebuchet" => "Trebuchet"
                ,"Georgia" => "Georgia"
                ,"Times New Roman" => "Times New Roman"
                ,"Tahoma, Geneva" => "Tahoma, Geneva"
                ,"Palatino" => "Palatino"
                ,"Helvetica" => "Helvetica"
                ,"BebasNeue" => "BebasNeue"
                ,"Poppins" =>"Poppins"


            ),
        ),
        array(
            'id'=>'ftc_body_font_google',
            'type' 			=> 'typography',
            'title' 		=> esc_html__('Body Font - Google Font', 'ornaldo'),
            'google' 		=> true,
            'subsets' 		=> false,
            'font-style' 	=> false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align' 	=> false,
            'color' 		=> false,
            'output'        => array('body'),
            'default'       => array(
                'color'			=> "#000000",
                'google'		=> true,
                'font-family'	=> 'Roboto Condensed'

            ),
            'preview'       => array(
                "text" => esc_html__("This is my font preview!", "ornaldo")
                ,"size" => "30px"
            )
        ),
        array(
            'id'        =>'ftc_secondary_body_font_enable_google_font',
            'title'     => esc_html__('Secondary Body Font - Enable Google Font', 'ornaldo'),
            'on'       => esc_html__("Enable", "ornaldo"),
            'off'      => esc_html__("Disable", "ornaldo"),
            'type'     => 'switch',
            'default'   => 1
        ),
        array(
            'id'            => 'ftc_secondary_body_font_google',
            'type'          => 'typography',
            'title'         => esc_html__('Body Font - Google Font', 'ornaldo'),
            'google'        => true,
            'subsets'       => false,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'text-align'    => false,
            'color'         => false,
            'output'        => array('body'),
            'default'       => array(
                'color'         =>"#000000",
                'google'        =>true,
                'font-family'   =>'Roboto Condensed'                            
            ),
            'preview'       => array(
                "text" => esc_html__("This is my font preview!", "ornaldo")
                ,"size" => "30px"
            )
        ),
        array(
            'id'        =>'ftc_font_size_body',
            'type'      => 'slider',
            'title'     => esc_html__('Body Font Size', 'ornaldo'),
            'desc'     => esc_html__("In pixels. Default is 14px", "ornaldo"),
            'min'      => '10',
            'step'     => '1',
            'max'      => '50',
            'default'   => '14'
        ),	
        array(
            'id'        =>'ftc_line_height_body',
            'type'      => 'slider',
            'title'     => esc_html__('Body Font Line Heigh', 'ornaldo'),
            'desc'     => esc_html__("In pixels. Default is 24px", "ornaldo"),
            'min'      => '10',
            'step'     => '1',
            'max'      => '50',
            'default'   => '24'
        )				
    )
);

/*** WooCommerce Config     ** */
if ( class_exists( 'Woocommerce' ) ) :
    $this->sections[] = array(
     'icon' => 'icofont icofont-cart-alt',
     'icon_class' => 'icon',
     'title' => esc_html__('Ecommerce', 'ornaldo'),
     'fields' => array(				
     )
 );

    /** Woocommerce **/
    $this->sections[] = array(
     'icon' => 'icofont icofont-double-right',
     'icon_class' => 'icon',
     'subsection' => true,
     'title' => esc_html__('Woocommerce', 'ornaldo'),
     'fields' => array(	
        array(  
            "title"      => esc_html__("Product Label", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "product_label_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Product Sale Label Text", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_sale_label_text"
            ,"default"      => "Sale"
            ,"type"     => "text"
        ),
        array(  
            "title"      => esc_html__("Product Feature Label Text", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_feature_label_text"
            ,"default"      => "New"
            ,"type"     => "text"
        ),						
        array(  
            "title"      => esc_html__("Product Out Of Stock Label Text", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_product_out_of_stock_label_text"
            ,"default"      => "Sold out"
            ,"type"     => "text"
        ),           		
        array(   
            "title"      => esc_html__("Show Sale Label As", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_show_sale_label_as"
            ,"default"      => "text"
            ,"type"     => "select"
            ,"options"  => array(
                'text'      => esc_html__('Text', 'ornaldo')
                ,'number'   => esc_html__('Number', 'ornaldo')
                ,'percent'  => esc_html__('Percent', 'ornaldo')
            )
        ),
        array(  
            "title"      => esc_html__("Product Hover Style", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "prod_hover_style_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Hover Style", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_effect_hover_product_style"
            ,"default"      => "style-1"
            ,"type"     => "select"
            ,"options"  => array(
                'style-1'       => esc_html__('Style 1', 'ornaldo')
                ,'style-2'      => esc_html__('Style 2', 'ornaldo')
                ,'style-3'      => esc_html__('Style 3', 'ornaldo')
            )
        ),
        array(  
                "title"      => esc_html__("Gallery image on product", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_gallery_style_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Gallery", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_gallery_on_product"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),
            array(  
                "title"      => esc_html__("Button Load More Product", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_loadmore_infinite_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Button Loadmore", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_loadmore_button_infinite"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),
            array(  
            "title"      => esc_html__("Type Main image and lightbox", "ornaldo")
            ,"desc"     => esc_html__("", "ornaldo")
            ,"id"       => "ftc_prod_advanced_zoom"
            ,"default"      => 'default'
            ,"type"     => "select"
            ,"options"  => array(
                'default'   => esc_html__('Default', 'ornaldo')
                ,'type_1'   => esc_html__('Advanced zoom', 'ornaldo')
                ,'type_2'   => esc_html__('Grid image', 'ornaldo')
            )
        ),
        array(  
            "title"      => esc_html__("On/Off Infinite Scroll", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "prod_infinite_scroll"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Apply Infinite Scroll", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_Infinite_scroll"
            ,"default"      => "1"
            ,"type"     => "select"
            ,"options"  => array(
                '0'       => esc_html__('No', 'ornaldo')
                ,'1'      => esc_html__('Yes', 'ornaldo')
            )
        ),
        array(  
                "title"      => esc_html__("Animation Product", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_animation_pro_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Animation", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_animation_product_shop"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),
             array(  
                "title"      => esc_html__("Shop Carousel", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_carousel_pro_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Carousel", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_carousel_product_shop"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),
            array(
                "title"      => esc_html__("Advanced Filter", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_advanced_filter_pro_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Filter", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_advanced_filter_product_shop"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),

        array(  
            "title"      => esc_html__("Back Product Image", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "introduction_enable_img_back"
            ,"icon"     => true
            ,"type"     => "info"
        ),					
        array(   
            "title"      => esc_html__("Enable Second Product Image", "ornaldo")
            ,"desc"     => esc_html__("Show second product image on hover. It will show an image from Product Gallery", "ornaldo")
            ,"id"       => "ftc_effect_product"
            ,"default"      => "1"
            ,"type"     => "switch"
        ),
        array(  
            "title"      => "Number Of Gallery Product Image"
            ,"id"       => "ftc_product_gallery_number"
            ,"default"      => 3
            ,"type"     => "text"
        ),
        array(  
            "title"      => esc_html__("Lazy Load", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "prod_lazy_load_options" 
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Activate Lazy Load", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_prod_lazy_load"
            ,"default"      => 1
            ,"type"     => "switch"
        ),
        array(
            'id'=>'ftc_prod_placeholder_img',
            'type' => 'media',
            'compiler'  => 'true',
            'mode'      => false,
            'title' => esc_html__('Placeholder Image', 'ornaldo'),
            'desc'      => '',
            'default' => array(
                'url' => get_template_directory_uri(). '/assets/images/prod_loading.gif'
            )
        ),
        array(  
            "title"      => esc_html__("Quickshop", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "quickshop_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Activate Quickshop", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_enable_quickshop"
            ,"default"      => 1
            ,"type"     => "switch"
        ),
        array(  
            "title"      => esc_html__("Catalog Mode", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "introduction_catalog_mode"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  
            "title"      => esc_html__("Enable Catalog Mode", "ornaldo")
            ,"desc"     => esc_html__("Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off", "ornaldo")
            ,"id"       => "ftc_enable_catalog_mode"
            ,"default"      => "0"
            ,"type"     => "switch"
        ),
        array(     
            "title"      => esc_html__("Ajax Search", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ajax_search_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(     
            "title"      => esc_html__("Enable Ajax Search", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_ajax_search"
            ,"default"      => "1"
            ,"type"     => "switch"
        ),
        array(  
                "title"      => esc_html__("Shop Mansory ", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "prod_mansory_pro_options"
                ,"icon"     => true
                ,"type"     => "info"
            ),
            array(  "title"      => esc_html__("Active Mansory product", "ornaldo")
                ,"desc"     => ""
                ,"id"       => "ftc_mansory_product_shop"
                ,'type' => 'switch'
                ,'default' => 0
                ,'on' => esc_html__('Yes', 'ornaldo')
                ,'off' => esc_html__('No', 'ornaldo')

            ),
        array(     
            "title"      => esc_html__("Number Of Results", "ornaldo")
            ,"desc"     => esc_html__("Input -1 to show all results", "ornaldo")
            ,"id"       => "ftc_ajax_search_number_result"
            ,"default"      => 3
            ,"type"     => "text"
        )
    )
);

/*** Product Category ***/
$this->sections[] = array(
 'icon' => 'icofont icofont-double-right',
 'icon_class' => 'icon',
 'subsection' => true,
 'title' => esc_html__( 'Product Category', 'ornaldo'),
 'fields' => array(
  array(
   'id' => 'ftc_prod_cat_layout',
   'type' => 'image_select',
   'title' => esc_html__('Product Category Layout', 'ornaldo'),
   'des' => esc_html__('Select main content and sidebar alignment.', 'ornaldo'),
   'options' => $ftc_layouts,
   'default' => '0-1-0'
),						
  array(    
    "title"      => esc_html__("Left Sidebar", "ornaldo")
    ,"id"       => "ftc_prod_cat_left_sidebar"
    ,"default"      => "product-category-sidebar"
    ,"type"     => "select"
    ,"options"  => $of_sidebars
),						
  array(    
    "title"      => esc_html__("Right Sidebar", "ornaldo")
    ,"id"       => "ftc_prod_cat_right_sidebar"
    ,"default"      => "product-category-sidebar"
    ,"type"     => "select"
    ,"options"  => $of_sidebars
),
  array(    
    "title"      => esc_html__("Product Columns", "ornaldo")
    ,"id"       => "ftc_prod_cat_columns"
    ,"default"      => "3"
    ,"type"     => "select"
    ,"options"  => array(
        3   => 3
        ,4  => 4
        ,5  => 5
        ,6  => 6
    )
),
  array(    
      "title"      => esc_html__("Products Per Page", "ornaldo")
      ,"desc"     => esc_html__("Number of products per page", "ornaldo")
      ,"id"       => "ftc_prod_cat_per_page"
      ,"default"      => 12
      ,"type"     => "text"
  ),
  array(   
   "title"      => esc_html__("Catalog view", "ornaldo")
   ,"desc"     => esc_html__("Display option to show product in grid or list view", "ornaldo")
   ,"id"       => "ftc_enable_glt"
   ,"default"      => 1
   ,"on"       => esc_html__("Show", "ornaldo")
   ,"off"      => esc_html__("Hide", "ornaldo")
   ,"type"     => "switch"
),       
  array(
    'title'      => esc_html__( 'Default catalog view', 'ornaldo' ),
    'desc'  => esc_html__( 'Display products in grid or list view by default', 'ornaldo' ),
    'id'        => 'ftc_glt_default',
    'type'      => 'select',
    "default"      => 'grid',
    'options'   => array(
        'grid'  => esc_html__('Grid', 'ornaldo'),
        'list'  => esc_html__('List', 'ornaldo')
    )
),					
  array(   
     "title"      => esc_html__("Top Content Widget Area", "ornaldo")
     ,"desc"     => esc_html__("Display Product Category Top Content widget area", "ornaldo")
     ,"id"       => "ftc_prod_cat_top_content"
     ,"default"      => 1
     ,"on"       => esc_html__("Show", "ornaldo")
     ,"off"      => esc_html__("Hide", "ornaldo")
     ,"type"     => "switch"
 ),
  array(    
    "title"      => esc_html__("Product Thumbnail", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_thumbnail"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(    
    "title"      => esc_html__("Product Label", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_label"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Categories", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_cat"
    ,"default"      => 0
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Title", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_title"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product SKU", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_sku"
    ,"default"      => 0
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Rating", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_rating"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Price", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_price" 
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Add To Cart Button", "ornaldo")
    ,"desc"     => ""
    ,"id"       => "ftc_prod_cat_add_to_cart"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(    
                "title"      => esc_html__("Product Images", "ornaldo")
                ,"id"       => "ftc_config_prod_img"
                ,"default"      => "2"
                ,"type"     => "select"
                ,"options"  => array(
                    1   => esc_html__('1 Image', 'ornaldo')
                    ,2  => esc_html__('2 Image (Hover image)', 'ornaldo')
                    ,'gallery_slider'  => esc_html__('All Image (Gallery Slider)', 'ornaldo') 
                )
            ),
  array(  
            "title"      => esc_html__("Variation Shop", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "prod_variation_color_options"
            ,"icon"     => true
            ,"type"     => "info"
        ),
        array(  "title"      => esc_html__("Active Variation", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_variation_product_shop"
            ,'type' => 'switch'
            ,'default' => 0
            ,'on' => esc_html__('Yes', 'ornaldo')
            ,'off' => esc_html__('No', 'ornaldo')
        ),
  array(    
   "title"      => esc_html__("Product Short Description - Grid View", "ornaldo")
   ,"desc"     => esc_html__("Show product description on grid view", "ornaldo")
   ,"id"       => "ftc_prod_cat_grid_desc"
   ,"default"      => 0
   ,"on"       => esc_html__("Show", "ornaldo")
   ,"off"      => esc_html__("Hide", "ornaldo")
   ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Short Description - Grid View - Limit Words", "ornaldo")
    ,"desc"     => esc_html__("Number of words to show product description on grid view. It is also used for product shortcode", "ornaldo")
    ,"id"       => "ftc_prod_cat_grid_desc_words"
    ,"default"      => 8
    ,"type"     => "text"
),
  array(     
    "title"      => esc_html__("Product Short Description - List View", "ornaldo")
    ,"desc"     => esc_html__("Show product description on list view", "ornaldo")
    ,"id"       => "ftc_prod_cat_list_desc"
    ,"default"      => 1
    ,"on"       => esc_html__("Show", "ornaldo")
    ,"off"      => esc_html__("Hide", "ornaldo")
    ,"type"     => "switch"
),
  array(  
    "title"      => esc_html__("Product Short Description - List View - Limit Words", "ornaldo")
    ,"desc"     => esc_html__("Number of words to show product description on list view", "ornaldo")
    ,"id"       => "ftc_prod_cat_list_desc_words"
    ,"default"      => 50
    ,"type"     => "text"
)					
)
);
/* Product Details Config  */
$this->sections[] = array(
 'icon' => 'icofont icofont-double-right',
 'icon_class' => 'icon',
 'subsection' => true,
 'title' => esc_html__('Product Details', 'ornaldo'),
 'fields' => array(
    array(
       'id' => 'ftc_prod_layout',
       'type' => 'image_select',
       'title' => esc_html__('Product Detail Layout', 'ornaldo'),
       'des' => esc_html__('Select main content and sidebar alignment.', 'ornaldo'),
       'options' => $ftc_layouts,
       'default' => '0-1-1'
   ),
    array(  
        "title"      => esc_html__("Left Sidebar", "ornaldo")
        ,"id"       => "ftc_prod_left_sidebar"
        ,"default"      => "product-detail-sidebar"
        ,"type"     => "select"
        ,"options"  => $of_sidebars
    ),
    array(  
        "title"      => esc_html__("Right Sidebar", "ornaldo")
        ,"id"       => "ftc_prod_right_sidebar"
        ,"default"      => "product-detail-sidebar"
        ,"type"     => "select"
        ,"options"  => $of_sidebars
    ),
    array(  
        "title"      => esc_html__("Product Cloud Zoom", "ornaldo")
        ,"desc"     => esc_html__("If you turn it off, product gallery images will open in a lightbox. This option overrides the option of WooCommerce", "ornaldo")
        ,"id"       => "ftc_prod_cloudzoom"
        ,"default"      => 1
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Attribute Dropdown", "ornaldo")
        ,"desc"     => esc_html__("If you turn it off, the dropdown will be replaced by image or text label", "ornaldo")
        ,"id"       => "ftc_prod_attr_dropdown"
        ,"default"      => 1
        ,"type"     => "switch"
    ),						
    array(  "title"      => esc_html__("Product Thumbnail", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_thumbnail"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Label", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_label"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Navigation", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_show_prod_navigation"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Title", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_title"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Title In Content", "ornaldo")
        ,"desc"     => esc_html__("Display the product title in the page content instead of above the breadcrumbs", "ornaldo")
        ,"id"       => "ftc_prod_title_in_content"
        ,"default"      => 0
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Rating", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_rating"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product SKU", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_sku"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Availability", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_availability"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Excerpt", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_excerpt"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Count Down", "ornaldo")
        ,"desc"     => esc_html__("You have to activate ThemeFTC plugin", "ornaldo")
        ,"id"       => "ftc_prod_count_down"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Price", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_price"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Add To Cart Button", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_add_to_cart"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Categories", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_cat"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Tags", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_tag"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Sharing", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_sharing"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Size Chart", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_show_prod_size_chart"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Size Chart Image", "ornaldo")
        ,"desc"     => esc_html__("Select an image file for all Product", "ornaldo")
        ,"id"       => "ftc_prod_size_chart"
        ,"type"     => "media"
        ,'default' => array(
            'url' => get_template_directory_uri(). '/assets/images/size-chart.jpg'
        )
    ),
    array( "title" => esc_html__("Sticky Add to cart", "ornaldo")
            ,"desc" => ""
            ,"id" => "ftc_prod_stic_bot"
            ,"default" => 0
            ,"on" => esc_html__("Show", "ornaldo")
            ,"off" => esc_html__("Hide", "ornaldo")
            ,"type" => "switch"
        ),

    
    array(  "title"      => esc_html__("Product Thumbnails", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_thumbnails"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Product Thumbnails Style", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_thumbnails_style"
        ,"default"      => "horizontal" 
        ,"type"     => "select"
        ,"options"  => array(
            'vertical'      => esc_html__('Vertical', 'ornaldo')
            ,'horizontal'   => esc_html__('Horizontal', 'ornaldo')
        )
    ),
    array(  "title"      => esc_html__("Product Tabs", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_tabs"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Product Tabs", "ornaldo")
        ,"desc"     => esc_html__("Enable Product Tabs", "ornaldo")
        ,"id"       => "ftc_prod_tabs"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Tabs Style", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_style_tabs"
        ,"default"      => "defaut"
        ,"type"     => "select"
        ,"options"  => array(
            'default'       => esc_html__('Default', 'ornaldo')
            ,'accordion'    => esc_html__('Accordion', 'ornaldo')
            ,'vertical' => esc_html__('Vertical', 'ornaldo')
        )
    ),
    array(  "title"      => esc_html__("Product Tabs Position", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_tabs_position"
        ,"default"      => "after_summary" 
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "select"
        ,"options"  => array(
            'after_summary'     => esc_html__('After Summary', 'ornaldo')
            ,'inside_summary'   => esc_html__('Inside Summary', 'ornaldo')
        )
    ),
    array(  "title"      => esc_html__("Product Custom Tab", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Product Custom Tab Title", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab_title"
        ,"default"      => "Custom tab"
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "text"
    ),
    array(  "title"      => esc_html__("Product Custom Tab Content", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_custom_tab_content"
        ,"default"      => "Your custom content goes here. You can add the content for individual product"
        ,"fold"     => "ftc_prod_tabs"
        ,"type"     => "textarea"
    ),
    array(  "title"      => esc_html__("Product Ads Banner", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "introduction_product_ads_banner"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(  "title"      => esc_html__("Ads Banner", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_ads_banner"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(     "title"      => esc_html__("Ads Banner Content", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_ads_banner_content"
        ,"default"      => ''
        ,"fold"     => "ftc_prod_ads_banner"
        ,"type"     => "textarea"
    ),
    array(  "title"      => esc_html__("Related - Up-Sell Products", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "introduction_related_upsell_product"
        ,"icon"     => true
        ,"type"     => "info"
    ),
    array(     "title"      => esc_html__("Up-Sell Products", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_upsells"
        ,"default"      => 0
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    ),
    array(  "title"      => esc_html__("Related Products", "ornaldo")
        ,"desc"     => ""
        ,"id"       => "ftc_prod_related"
        ,"default"      => 1
        ,"on"       => esc_html__("Show", "ornaldo")
        ,"off"      => esc_html__("Hide", "ornaldo")
        ,"type"     => "switch"
    )					
)
);

endif;


/* Blog Settings */
$this->sections[] = array(
    'icon' => 'icofont icofont-ui-copy',
    'icon_class' => 'icon',
    'title' => esc_html__('Blog', 'ornaldo'),
    'fields' => array(				
    )
);		

			// Blog Layout
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Blog Layout', 'ornaldo'),
    'fields' => array(	
        array(
           'id' => 'ftc_blog_layout',
           'type' => 'image_select',
           'title' => esc_html__('Blog Layout', 'ornaldo'),
           'des' => esc_html__('Select main content and sidebar alignment.', 'ornaldo'),
           'options' => $ftc_layouts,
           'default' => '1-1-0'
       ),
        array(   "title"      => esc_html__("Left Sidebar", "ornaldo")
            ,"id"       => "ftc_blog_left_sidebar"
            ,"default"      => "blog-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),				
        array(     "title"      => esc_html__("Right Sidebar", "ornaldo")
            ,"id"       => "ftc_blog_right_sidebar"
            ,"default"      => "blog-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(    
            "title"      => esc_html__("Boxed Sidebar Filter", "ornaldo")
            ,"id"       => "ftc_prod_box_sidebar_filter"
            ,"type"     => "switch"
            ,"default"      => 0
            ,"on"       => esc_html__("Yes", "ornaldo")
            ,"off"      => esc_html__("No", "ornaldo")
            ,"desc"     => esc_html__("Apply for Product Category Layout is Full-width", "ornaldo")
        ),
        array(   "title"      => esc_html__("Blog Thumbnail", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_thumbnail"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),										
        array(   "title"      => esc_html__("Blog Date", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_date"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Title", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_title"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Author", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_author"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Comment", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_comment"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Count View", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_count_view"
            ,"default"      => 0
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Read More Button", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_read_more"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Categories", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_categories"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_excerpt"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt Strip All Tags", "ornaldo")
            ,"desc"     => esc_html__("Strip all html tags in Excerpt", "ornaldo")
            ,"id"       => "ftc_blog_excerpt_strip_tags"
            ,"default"      => 0
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Excerpt Max Words", "ornaldo")
            ,"desc"     => esc_html__("Input -1 to show full excerpt", "ornaldo")
            ,"id"       => "ftc_blog_excerpt_max_words"
            ,"default"      => "-1"
            ,"type"     => "text"
        )					
    )
);				

/** Blog Detail **/
$this->sections[] = array(
    'icon' => 'icofont icofont-double-right',
    'icon_class' => 'icon',
    'subsection' => true,
    'title' => esc_html__('Blog Details', 'ornaldo'),
    'fields' => array(	
        array(
           'id' => 'ftc_blog_details_layout',
           'type' => 'image_select',
           'title' => esc_html__('Blog Detail Layout', 'ornaldo'),
           'des' => esc_html__('Select main content and sidebar alignment.', 'ornaldo'),
           'options' => $ftc_layouts,
           'default' => '0-1-0'
       ),
        array(  "title"      => esc_html__("Left Sidebar", "ornaldo")
            ,"id"       => "ftc_blog_details_left_sidebar"
            ,"default"      => "blog-detail-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(  "title"      => esc_html__("Right Sidebar", "ornaldo")
            ,"id"       => "ftc_blog_details_right_sidebar"
            ,"default"      => "blog-detail-sidebar"
            ,"type"     => "select"
            ,"options"  => $of_sidebars
        ),
        array(  "title"      => esc_html__("Blog Thumbnail", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_thumbnail"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(     "title"      => esc_html__("Blog Date", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_date"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Title", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_title"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Content", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_content"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Tags", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_tags"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Count View", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_count_view"
            ,"default"      => 0
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Categories", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_categories"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Author Box", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_author_box"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Related Posts", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_related_posts"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        ),
        array(  "title"      => esc_html__("Blog Comment Form", "ornaldo")
            ,"desc"     => ""
            ,"id"       => "ftc_blog_details_comment_form"
            ,"default"      => 1
            ,"on"       => esc_html__("Show", "ornaldo")
            ,"off"      => esc_html__("Hide", "ornaldo")
            ,"type"     => "switch"
        )				
    )
);		
}


public function setHelpTabs() {

}

public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          => 'smof_data',
                'menu_type'         => 'submenu',
                'allow_sub_menu'    => true,
                'display_name'      => $theme->get( 'Name' ),
                'display_version'   => $theme->get( 'Version' ),
                'menu_title'        => esc_html__('Theme Options', 'ornaldo'),
                'page_title'        => esc_html__('Theme Options', 'ornaldo'),
                'templates_path'    => get_template_directory() . '/admin/et-templates/',
                'disable_google_fonts_link' => true,

                'async_typography'  => false,
                'admin_bar'         => false,
                'admin_bar_icon'       => 'dashicons-admin-generic',
                'admin_bar_priority'   => 50,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => false,
                'compiler'          => false,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'smof_data',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,
                'show_options_object' => false,

                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => false,
                'output_tag'        => false,

                'database'              => '',
                'system_info'           => false,

                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                ),
                'use_cdn'                   => true,
            );


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
            }
        }			

    }

    global $redux_ftc_settings;
    $redux_ftc_settings = new Redux_Framework_smof_data();
}
function ftc_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'ftc_removeDemoModeLink');