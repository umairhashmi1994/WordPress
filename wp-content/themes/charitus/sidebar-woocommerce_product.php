<?php
/**
 * The sidebar containing the WooCommerce Single product page widget.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package educationpress
 */

$ch_shop_layout = cs_get_option('ch_shop_layout');

if ( ! is_active_sidebar( 'woocommerce_product' ) ) {
	return;
}
?>

<?php if( $ch_shop_layout != 'full_width' ):?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( apply_filters( 'charitus_widget_area_class', 'col-md-4' ) ); ?>">
		<?php dynamic_sidebar( 'woocommerce_product' ); ?>
	</aside><!-- #secondary -->
<?php endif;?>