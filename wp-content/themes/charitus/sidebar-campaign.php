<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package charitus
 */

$campaign_layout = cs_get_option('campaign_layout');

if ( ! is_active_sidebar( 'campaign' ) ) {
	return;
}
?>

<?php if( $campaign_layout != 'full_width' ):?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( apply_filters( 'charitus_widget_area_class', 'col-md-4' ) ); ?>">
		<?php dynamic_sidebar( 'campaign' ); ?>
	</aside><!-- #secondary -->
<?php endif;?>