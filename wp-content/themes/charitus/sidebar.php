<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package charitus
 */

$blog_layout = cs_get_option('blog_layout');

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<?php if( $blog_layout != 'full_width' ):?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( apply_filters( 'charitus_widget_area_class', 'col-md-4' ) ); ?>">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
<?php endif;?>