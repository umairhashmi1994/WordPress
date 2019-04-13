<?php
/**
 * The template for displaying WooCommerce pages.
 *
 * @package educationpress
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( apply_filters( 'charitus_content_area_class', 'col-md-8' ) ); ?>">
		<main id="main" class="site-main ch-woocommerce-page-content">

			<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
$ch_shop_layout = cs_get_option('ch_shop_layout');
$ch_product_layout = cs_get_option('ch_product_layout');

if( is_product() && $ch_product_layout != 'full_width' ){
	get_sidebar('woocommerce_product');
}elseif( !is_product() && $ch_shop_layout != 'full_width' ){
	get_sidebar('woocommerce_shop');
}

get_footer();