<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <?php global $smof_data; ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Serif" />

    <?php 
    ftc_theme_favicon();
    wp_head(); 
    ?>
</head>
<?php
$header_classes = array();
if( isset($smof_data['ftc_enable_sticky_header']) && $smof_data['ftc_enable_sticky_header'] ){
    $header_classes[] = 'header-sticky';
}
?>  
<body <?php body_class(); ?>>
<?php ftc_header_mobile_navigation(); ?>
    <div id="page" class="site ftc_header_layout6">
        <?php if( !is_page_template('page-blank.php') ): ?>
            <header id="masthead" class="site-header header6">
            <div class="header-nav">
                        <div class="container-fluid">
                            <div class="nav-left">
                                <?php if( $smof_data['ftc_header_language'] ): ?>
                                            <div class="header-language">
                                                <img src="/wp-content/themes/ornaldo/assets/images/england-flag.png" alt="#">
                                                <?php ftc_wpml_language_selector(); ?></div>
                                <?php endif; ?>
                                <?php if( $smof_data['ftc_header_currency'] ): ?>
                                            <div class="header-currency"><?php ftc_woocommerce_multilingual_currency_switcher(); ?></div>
                                        <?php endif; ?>

                                
                                <?php if( $smof_data['ftc_header_contact_information'] ):?>
                                    <div class="info-desc"><?php echo do_shortcode(stripslashes($smof_data['ftc_header_contact_information'])); ?></div>
                                <?php endif; ?>
                                <?php if( $smof_data['ftc_middle_header_content'] ): ?>
                                <div class="custom_content"><?php echo do_shortcode(stripslashes($smof_data['ftc_middle_header_content'])); ?></div>
                            <?php endif; ?>
                            </div>
                            <div class="nav-right">
                                <?php if( $smof_data['ftc_enable_tiny_account'] ): ?>
                                    <div class="ftc-sb-account"><?php echo ftc_tiny_account(); ?></div>
                                <?php endif; ?>

                                <?php if( class_exists('YITH_WCWL') && $smof_data['ftc_enable_tiny_wishlist'] ): ?>
                                    <div class="ftc-my-wishlist"><?php echo ftc_tini_wishlist(); ?></div>
                                <?php endif; ?>
                                <?php if( $smof_data['ftc_enable_tiny_checkout'] ){ 
                           ftc_tini_checkout();
                         } ?>
                            </div>
                        </div>
                    </div>
                <div class="header-ftc header-<?php echo esc_attr($smof_data['ftc_header_layout']); ?>">
                    
                     <div class="container">
                            

                            <div class="logo-wrapper is-desktop"><?php ftc_theme_logo(); ?></div>
                            </div>
                    <div class="header-content <?php echo esc_attr(implode(' ', $header_classes)); ?>">
                               
                        <div class="container-fluid">
                            <div class="mobile-button">
                                <div class="mobile-nav">
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                             <div class="logo-wrapper is-mobile"><?php ftc_theme_mobile_logo(); ?></div>
                            <?php if( $smof_data['ftc_enable_search'] ): ?>
                                <div class="ftc-search-product search-shop-hidden hidden-xs"><?php ftc_get_search_form_by_category(); ?></div>
                            <?php endif; ?>
                            <?php if( $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                                <div class="ftc-shop-cart search-shop-hidden"><?php echo ftc_tiny_cart(); ?></div>
                            <?php endif; ?>
                            
                            
                            
                            <?php
                                if ( has_nav_menu( 'vertical' ) ) {
                                    ?>
                                    <div class="vertical-menu-wrapper">
                                        <div class="vertical-menu-heading"><?php echo ftc_get_vertical_menu_heading(); ?></div>
                                        <?php get_template_part( 'template-parts/navigation/navigation', 'vertical' ); ?>
                                    </div>
                                    <?php
                                }
                                ?>

                            <?php if( $smof_data['ftc_enable_search'] ): ?>
                                <div class="ftc-search-product search-shop-visible"><?php ftc_get_search_form_by_category(); ?></div>
                            <?php endif; ?>
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <div class="navigation-primary">
                                <div class="container">
                                        <?php get_template_part( 'template-parts/navigation/navigation', 'primary' ); ?>
                                  </div>
                                </div><!-- .navigation-top -->
                            <?php endif; ?>
                            <?php if( $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                                <div class="ftc-shop-cart search-shop-visible"><?php echo ftc_tiny_cart(); ?></div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
             </div>
         </header><!-- #masthead -->
     <?php endif; ?>

     <div class="site-content-contain">
      <div id="content" class="site-content">
