<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <?php global $smof_data; ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
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
    <div id="page" class="site">
        <?php if( !is_page_template('page-blank.php') ): ?>
            <header id="masthead" class="site-header">   
                <div class="header-ftc header-<?php echo esc_attr($smof_data['ftc_header_layout']); ?>">
                <div class="header-nav">
                    <div class="header-after">
                            <?php if( $smof_data['ftc_header_language'] ): ?>
                                <div class="header-language">
                                <img src="/wp-content/themes/ornaldo/assets/images/england-flag.png" alt="#">
                            <?php ftc_wpml_language_selector(); ?></div>
                            <?php endif; ?>
                            <?php if( $smof_data['ftc_header_currency'] ): ?>
                                <div class="header-currency"><?php ftc_woocommerce_multilingual_currency_switcher(); ?></div>
                            <?php endif; ?>  
                            <?php if( $smof_data['ftc_enable_tiny_account'] ): ?>
                                <div class="ftc-sb-account"><?php echo ftc_tiny_account(); ?></div>
                            <?php endif; ?>
                            <?php if( $smof_data['ftc_enable_tiny_checkout'] ){ 
                            ftc_tini_checkout();
                            } ?>

                            <?php if( class_exists('YITH_WCWL') && $smof_data['ftc_enable_tiny_wishlist'] ): ?>
                                <div class="ftc-my-wishlist"><?php echo ftc_tini_wishlist(); ?></div>
                            <?php endif; ?> 
                            <?php if( $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                                <div class="ftc-shop-cart "><?php echo ftc_tiny_cart(); ?></div>
                            <?php endif; ?> 
                    </div>  
                </div>

                <div class="header-content <?php echo esc_attr(implode(' ', $header_classes)); ?>">
                <div class="mobile-button">
                        <div class="mobile-nav">
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                    <div class="nav-left1">
                            <div class="logo-wrapper is-desktop"><?php ftc_theme_logo(); ?></div>
                            <div class="logo-wrapper is-mobile"><?php ftc_theme_mobile_logo(); ?></div>
                    </div>
                    <div class="nav-center1">  
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="navigation-primary">
                            <div class="">
                                    <?php get_template_part( 'template-parts/navigation/navigation', 'primary' ); ?>
                            </div>
                            </div><!-- .navigation-top -->
                        <?php endif; ?>
                    </div>
                    <div class="nav-right1">
                        <?php if( $smof_data['ftc_enable_search'] ): ?>
                            <div class="ftc-search-product "><?php ftc_get_search_form_by_category(); ?></div>
                        <?php endif; ?>    
                        <?php if( $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                                <div class="ftc-shop-cart "><?php echo ftc_tiny_cart(); ?></div>
                            <?php endif; ?>   
                    </div>
                </div>
                    
            </div>
         </header><!-- #masthead -->
     <?php endif; ?>

     <div class="site-content-contain">
      <div id="content" class="site-content">
