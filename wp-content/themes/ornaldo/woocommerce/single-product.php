<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $smof_data;

get_header( $smof_data['ftc_header_layout'] ); 

$extra_class = "";
$show_breadcrumb = true;
$page_column_class = ftc_page_layout_columns_class($smof_data['ftc_prod_layout']);
if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'type_2'){
 	$page_column_class['left_sidebar'] = false;
 	$page_column_class['right_sidebar'] = false;
	}

if($show_breadcrumb){
	$extra_class = 'show_breadcrumb';
}
$show_page_title = $smof_data['ftc_prod_title'];
ftc_breadcrumbs_title(true, $show_page_title, get_the_title());

?>
<div class="page-container <?php echo esc_attr($extra_class) ?>">

	<div id="main-content" class="container">
		<div class="row">
			 <?php if( $page_column_class['left_sidebar'] || $page_column_class['right_sidebar'] ): ?>
            <div class="button-sidebar" title="Filter">
                <i class="fa fa-sliders" ></i>
            </div>
        <?php endif; ?>
        
			<!-- Left Sidebar -->
			<?php if( $page_column_class['left_sidebar'] ): ?>
				<aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
					<?php if( is_active_sidebar($smof_data['ftc_prod_left_sidebar']) ): ?>
						<?php dynamic_sidebar( $smof_data['ftc_prod_left_sidebar'] ); ?>
					<?php endif; ?>
				</aside>
			<?php endif; ?>		
			<div id="primary" class="site-content <?php echo esc_attr($page_column_class['main_class']); ?>">
				<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		?>  
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
		<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
	<!-- Right Sidebar -->
	<?php if( $page_column_class['right_sidebar'] ): ?>
		<aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
			<?php if( is_active_sidebar($smof_data['ftc_prod_right_sidebar']) ): ?>
				<?php dynamic_sidebar( $smof_data['ftc_prod_right_sidebar'] ); ?>
			<?php endif; ?>
		</aside>
	<?php endif; ?>
</div>
<?php
    /**
     * woocommerce_after_main_content hook
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'ftc_after_single_product_summary' );
    ?>
    </div>
</div>
<?php get_footer( 'shop' ); ?>