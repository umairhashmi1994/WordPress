<?php

/**
 * The Events Calendar Functions
 *
 * Author: Xoo Themes
 * Since : 1.0
 */


/**
 * Events Content area class
 */

add_filter( 'charitus_content_area_class', 'charitus_tec_contet_area_class' );

if(!function_exists('charitus_tec_contet_area_class')){
	function charitus_tec_contet_area_class ( $class ) {

		if( is_singular('tribe_events') || is_post_type_archive('tribe_events') ){

			$events_layout = charitus_cs_get_option('events_layout', 'right');

			if( $events_layout == 'right' ){
				$class = 'col-md-9';
			}elseif ( $events_layout == 'left' ) {
				$class = 'col-md-9 col-md-push-3';
			}elseif( $events_layout = 'full_width' ){
				$class = 'col-md-12';
			}

		}

		return $class;
	}
}

/**
 * Events Widget area class
 */

add_filter( 'charitus_widget_area_class', 'charitus_events_widget_area_class' );
if(!function_exists('charitus_events_widget_area_class')){
	function charitus_events_widget_area_class ( $class ) {
		
		if( is_singular('tribe_events') || is_post_type_archive('tribe_events') ){

			$events_layout = charitus_cs_get_option('events_layout', 'right');

			if( $events_layout == 'right' ){
				$class = 'col-md-3';
			}elseif ( $events_layout == 'left' ) {
				$class = 'col-md-3 col-md-pull-9';
			}elseif( $events_layout = 'full_width' ){
				$class = '';
			}

		}
		
		return $class;

	}
}

/**
 * Page Body Class
 */

add_filter('body_class', 'charitus_event_page_body_classes');

if(!function_exists('charitus_event_page_body_classes')){
	function charitus_event_page_body_classes( $classes ) {

		$events_layout = charitus_cs_get_option('events_layout', 'right');

		if( is_singular('tribe_events') || is_post_type_archive('tribe_events') ){
			if( $events_layout == 'right' ){
				$classes[] = 'xt-events-right-sidebar';
			}elseif ( $events_layout == 'left' ) {
				$classes[] = 'xt-events-left-sidebar';
			}elseif( $events_layout = 'full_width' ){
				$classes[] = 'xt-events-no-sidebar';
			}
		}

		return $classes;
	}
}

/**
 * TEC Page Title
 */


add_filter( 'xt_theme_page_title', 'charitus_tec_page_title' );

if(!function_exists('charitus_tec_page_title')){
	function charitus_tec_page_title( $title ){
		if( is_post_type_archive('tribe_events') || is_singular( 'tribe_events' )){
			$title = esc_html__( 'Events', 'charitus' );
		}

		return $title;
	}
}

/**
 * Event template before
 */

add_action( 'tribe_events_before_template', 'charitus_tribe_events_before_template' );
function charitus_tribe_events_before_template(){
	echo "<div class='shadow charitus-shadow-padding'>";
}

/**
 * Event template after
 */

add_action( 'tribe_events_after_template', 'charitus_tribe_events_after_template' );
function charitus_tribe_events_after_template(){
	echo "</div>";
}
