</div><!-- #content -->
<?php if( !is_page_template('page-blank.php') ): ?>
<footer id="colophon" class="site-footer">
	<?php
	if ( is_active_sidebar( 'footer-top' ) || is_active_sidebar( 'footer-middle' ) || is_active_sidebar( 'footer-bottom' ) ) :		
		if ( is_active_sidebar( 'footer-top' ) ) { ?>
		<div class="widget-column footer-top">
			<div class="container">
				<?php dynamic_sidebar( 'footer-top' ); ?>
			</div>
		</div>
		<?php }
		if ( is_active_sidebar( 'footer-middle' ) ) { ?>
		<div class="widget-column footer-middle">
			<div class="container">
				<?php dynamic_sidebar( 'footer-middle' ); ?>
			</div>
		</div>
		<?php }
		if ( is_active_sidebar( 'footer-bottom' ) ) { ?>
		<div class="widget-column footer-bottom">
			<div class="container">
				<?php dynamic_sidebar( 'footer-bottom' ); ?>
			</div>
		</div>
		<?php } ?>

	<?php endif; ?>
</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- .site-content-contain -->
</div><!-- #page -->
<div class="ftc-close-popup"></div>
<?php
global $smof_data, $woocommerce;
if ( isset($smof_data['ftc_mobile_layout']) && $smof_data['ftc_mobile_layout']):
    ?>
    <div class="footer-mobile">
        <div class="mobile-home">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <i class="fa fa-home"></i>
                <?php esc_html_e('Home', 'ornaldo'); ?>
            </a>
        </div>
        <div class="mobile-view-cart">
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                <i class="fa fa-shopping-cart"></i>
                <?php esc_html_e('Cart', 'ornaldo'); ?>
                <?php echo ftc_cart_subtotal(); ?>
            </a>
        </div>
        <div class="mobile-wishlist">
            <?php if (class_exists('YITH_WCWL')): ?>
                <div class="ftc-my-wishlist"><?php echo wp_kses_post(ftc_tini_wishlist()); ?></div>
            <?php endif; ?>

        </div>
        <div class="mobile-account">
            <?php
            $_user_logged = is_user_logged_in();
            ob_start();
            ?>
            <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"
             title="<?php echo esc_html_e('Login', 'ornaldo'); ?>">
             <i class="fa fa-user"></i>
             <?php if ($_user_logged): ?>
                <?php echo esc_html_e('Account', 'ornaldo'); ?>
            <?php endif; ?>
            <?php if (!$_user_logged): ?>
                <?php echo esc_html_e('Login', 'ornaldo'); ?>
            <?php endif; ?>
        </a>
    </div>
</div>
<?php endif; ?>
<?php 
global $smof_data, $ftc_page_datas;
if( ( !wp_is_mobile() && $smof_data['ftc_back_to_top_button'] ) || ( wp_is_mobile() && $smof_data['ftc_back_to_top_button_on_mobile'] ) ): 
	?>
	<div id="to-top" class="scroll-button">
		<a class="scroll-button" href="javascript:void(0)" title="<?php echo esc_html_e('Back to Top', 'ornaldo'); ?>"><?php echo esc_html_e('Back to Top', 'ornaldo'); ?></a>
	</div>
<?php endif; ?>
<?php if($ftc_page_datas['ftc_page_enable_popup'] == 1 && (isset($smof_data['ftc_enable_popup']) && $smof_data['ftc_enable_popup']) && is_active_sidebar('popup-newletter')) : ?>
	<?php ftc_popup_newsletter(); ?>
<?php endif;  ?>
<?php wp_footer(); ?>

</body>
</html>
