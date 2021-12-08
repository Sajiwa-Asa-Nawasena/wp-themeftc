<?php
/**
 * The header for our theme
 *
 * @subpackage Clothing Store
 * @since 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'clothing-store' ); ?></a>
	
	<div id="page" class="site">
		<div id="header">
			<div class="wrap_figure">
				<div class="top_bar py-2 text-center text-lg-left text-md-left">
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 align-self-center text-md-center text-lg-left">
								<?php if( get_theme_mod('clothing_store_top_phone') != '' ){ ?>
									<span><i class="fas fa-phone-volume mr-3"></i><?php esc_html_e('HOTLINE','clothing-store'); ?> <?php echo esc_html(get_theme_mod('clothing_store_top_phone','')); ?></span>
								<?php }?>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 align-self-center text-md-center text-lg-left">
								<?php if( get_theme_mod('clothing_store_top_text') != '' ){ ?>
									<span><?php echo esc_html(get_theme_mod('clothing_store_top_text','')); ?></span>
								<?php }?>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 align-self-center text-md-right">
								<?php if( get_theme_mod('clothing_store_facebook') != ''){ ?>
									<a href="<?php echo esc_url(get_theme_mod('clothing_store_facebook','')); ?>"><i class="fab fa-facebook-f mr-3"></i></a>
								<?php }?>
								<?php if( get_theme_mod('clothing_store_twitter') != ''){ ?>
									<a href="<?php echo esc_url(get_theme_mod('clothing_store_twitter','')); ?>"><i class="fab fa-twitter mr-3"></i></a>
								<?php }?>
								<?php if( get_theme_mod('clothing_store_youtube') != ''){ ?>
									<a href="<?php echo esc_url(get_theme_mod('clothing_store_youtube','')); ?>"><i class="fab fa-youtube mr-3"></i></a>
								<?php }?>
								<?php if( get_theme_mod('clothing_store_instagram') != ''){ ?>
									<a href="<?php echo esc_url(get_theme_mod('clothing_store_instagram','')); ?>"><i class="fab fa-instagram mr-3"></i></a>
								<?php }?>
								<?php
									if ( class_exists( 'WooCommerce' ) ) { ?>
									<?php if ( is_user_logged_in() ) { ?>
										<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="mr-3 mx-md-3"><i class="fas fa-user mr-3"></i><?php esc_html_e( 'MY ACCOUNT','clothing-store');?></a>
									<?php } else { ?> 
										<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="mr-3 mx-md-3"><i class="fas fa-sign-out-alt mr-3"></i><?php esc_html_e( 'LOGIN / REGISTER','clothing-store');?></a>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="menu_header py-3">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 align-self-center">
								<div class="logo text-center text-md-left text-sm-left py-3 py-md-0">
							        <?php if ( has_custom_logo() ) : ?>
					            		<?php the_custom_logo(); ?>
						            <?php endif; ?>
					              	<?php $blog_info = get_bloginfo( 'name' ); ?>
						                <?php if ( ! empty( $blog_info ) ) : ?>
						                  	<?php if ( is_front_page() && is_home() ) : ?>
						                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						                  	<?php else : ?>
					                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					                  		<?php endif; ?>
						                <?php endif; ?>
						                <?php
					                  		$description = get_bloginfo( 'description', 'display' );
						                  	if ( $description || is_customize_preview() ) :
						                ?>
					                  	<p class="site-description">
					                    	<?php echo esc_html($description); ?>
					                  	</p>
					              	<?php endif; ?>
							    </div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 pl-0 pt-md-3 pt-lg-3 align-self-center">
								<div class="product-search">
									<?php
									if ( class_exists( 'WooCommerce' ) ) { ?>
										<?php get_product_search_form(); ?>
									<?php }?>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 pl-0 align-self-center text-center mt-2 mt-md-0 text-md-right">
								<?php
									if ( class_exists( 'WooCommerce' ) ) { ?>
									<?php global $woocommerce; ?>
									<a href="<?php echo wc_get_cart_url() ?>" class="header-cart"><i class="fas fa-shopping-cart"></i> <?php esc_html_e('CART','clothing-store'); ?> <span>( <?php echo $woocommerce->cart->cart_contents_count ?></span> )</a>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
				<div class="menu_header_box py-2">
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-9 align-self-center">
								<?php dynamic_sidebar( 'product-cat' ); ?>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-3 align-self-center">
								<?php if(has_nav_menu('primary')){?>
									<div class="toggle-menu gb_menu text-md-right">
										<button onclick="clothing_store_gb_Menu_open()" class="gb_toggle p-2"><i class="fas fa-ellipsis-h"></i><p class="mb-0"><?php esc_html_e('Menu','clothing-store'); ?></p></button>
									</div>
								<?php }?>
				   				<?php get_template_part('template-parts/navigation/navigation'); ?>
			   				</div>
			   			</div>
					</div>
				</div>
			</div>
		</div>


