<?php
/**
 * Displays footer site info
 *
 * @subpackage Clothing Store
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info py-4 text-center">
	<?php
		echo esc_html( get_theme_mod( 'clothing_store_footer_text' ) );
        printf(
            /* translators: %s: Clothing Store WordPress Theme. */
            esc_html__( ' %s ', 'clothing-store' ),
            '<p>Clothing Store WordPress Theme</p>'
        );
	?>
</div>