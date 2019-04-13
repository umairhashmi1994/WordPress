<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 * @var $xt_vc_column_theme_primary
 * @var $xt_vc_column_no_padding
 * @var $xt_vc_column_sm_no_padding
 */
$el_class = $width = $css = $offset = $xt_vc_column_theme_primary = $xt_vc_column_no_padding = $xt_vc_column_sm_no_padding = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

/* XT column theme primary */

if( $xt_vc_column_theme_primary == 'on' ){
    $css_classes[] = 'xt-vc-column-theme-primary';
}

/* XT column no padding */

if( $xt_vc_column_no_padding == 'on' ){
    $css_classes[] = 'xt-vc-column-no-padding';
}

/* XT column no padding */

if( $xt_vc_column_sm_no_padding == 'on' ){
    $css_classes[] = 'xt-vc-column-sm-no-padding';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
