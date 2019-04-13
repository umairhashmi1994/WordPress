<?php


/**
 * Slider Post Type
 */

if ( ! function_exists('charitus_slider_post_type') ) {
	function charitus_slider_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Sliders', 'Post Type General Name', 'charitus' ),
			'singular_name'         => esc_html_x( 'Slider', 'Post Type Singular Name', 'charitus' ),
			'menu_name'             => esc_html__( 'Sliders', 'charitus' ),
			'name_admin_bar'        => esc_html__( 'Post Type', 'charitus' ),
			'archives'              => esc_html__( 'Slider Archives', 'charitus' ),
			'attributes'            => esc_html__( 'Slider Attributes', 'charitus' ),
			'parent_item_colon'     => esc_html__( 'Slider Item:', 'charitus' ),
			'all_items'             => esc_html__( 'All Sliders', 'charitus' ),
			'add_new_item'          => esc_html__( 'Add New Slider', 'charitus' ),
			'add_new'               => esc_html__( 'Add New Slider', 'charitus' ),
			'new_item'              => esc_html__( 'Add New Slider', 'charitus' ),
			'edit_item'             => esc_html__( 'Edit Slider', 'charitus' ),
			'update_item'           => esc_html__( 'Update Slider', 'charitus' ),
			'view_item'             => esc_html__( 'View Slider', 'charitus' ),
			'view_items'            => esc_html__( 'View Sliders', 'charitus' ),
			'search_items'          => esc_html__( 'Search Slider', 'charitus' ),
			'not_found'             => esc_html__( 'No Slider Found', 'charitus' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'charitus' ),
			'featured_image'        => esc_html__( 'Slider Image', 'charitus' ),
			'set_featured_image'    => esc_html__( 'Set Slider image', 'charitus' ),
			'remove_featured_image' => esc_html__( 'Remove Slider image', 'charitus' ),
			'use_featured_image'    => esc_html__( 'Use as Slider featured image', 'charitus' ),
			'insert_into_item'      => esc_html__( 'Insert into item', 'charitus' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'charitus' ),
			'items_list'            => esc_html__( 'Items list', 'charitus' ),
			'items_list_navigation' => esc_html__( 'Items list navigation', 'charitus' ),
			'filter_items_list'     => esc_html__( 'Filter items list', 'charitus' ),
		);
		$args = array(
			'label'                 => esc_html__( 'Slider', 'charitus' ),
			'description'           => esc_html__( 'Charitus Slider', 'charitus' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-slides',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'charitus_slider', $args );

	}
	add_action( 'init', 'charitus_slider_post_type', 0 );
}


/**
 * Testimonial Post Type
 */

if ( ! function_exists('charitus_testimonial_post_type') ) {
	function charitus_testimonial_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Testimonials', 'Post Type General Name', 'charitus' ),
			'singular_name'         => esc_html_x( 'Testimonial', 'Post Type Singular Name', 'charitus' ),
			'menu_name'             => esc_html__( 'Testimonial', 'charitus' ),
			'name_admin_bar'        => esc_html__( 'Testimonial', 'charitus' ),
			'archives'              => esc_html__( 'Testimonial Archives', 'charitus' ),
			'attributes'            => esc_html__( 'Testimonial Attributes', 'charitus' ),
			'parent_item_colon'     => esc_html__( 'Testimonial item:', 'charitus' ),
			'all_items'             => esc_html__( 'All Testimonials', 'charitus' ),
			'add_new_item'          => esc_html__( 'Add New Testimonial', 'charitus' ),
			'add_new'               => esc_html__( 'Add Testimonial', 'charitus' ),
			'new_item'              => esc_html__( 'New Testimonial', 'charitus' ),
			'edit_item'             => esc_html__( 'Edit Testimonial', 'charitus' ),
			'update_item'           => esc_html__( 'Update Testimonial', 'charitus' ),
			'view_item'             => esc_html__( 'View Testimonial', 'charitus' ),
			'view_items'            => esc_html__( 'View Testimonials', 'charitus' ),
			'search_items'          => esc_html__( 'Search Testimonial', 'charitus' ),
			'not_found'             => esc_html__( 'Not found', 'charitus' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'charitus' ),
			'featured_image'        => esc_html__( 'Featured Image', 'charitus' ),
			'set_featured_image'    => esc_html__( 'Set testimonial featured image', 'charitus' ),
			'remove_featured_image' => esc_html__( 'Remove testimonial featured image', 'charitus' ),
			'use_featured_image'    => esc_html__( 'Use as Testimonial featured image', 'charitus' ),
			'insert_into_item'      => esc_html__( 'Insert into item', 'charitus' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Testimonial', 'charitus' ),
			'items_list'            => esc_html__( 'Testimonial list', 'charitus' ),
			'items_list_navigation' => esc_html__( 'Testimonials list navigation', 'charitus' ),
			'filter_items_list'     => esc_html__( 'Filter Testimonials list', 'charitus' ),
		);
		$args = array(
			'label'                 => esc_html__( 'Testimonial', 'charitus' ),
			'description'           => esc_html__( 'Charitus Testimonial', 'charitus' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-id-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'charitus_testimonial', $args );

	}
	add_action( 'init', 'charitus_testimonial_post_type', 0 );
}



if ( ! function_exists('charitus_volunteers_post_type') ) {
	function charitus_volunteers_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Volunteers', 'Post Type General Name', 'charitus' ),
			'singular_name'         => esc_html_x( 'Volunteer', 'Post Type Singular Name', 'charitus' ),
			'menu_name'             => esc_html__( 'Volunteer', 'charitus' ),
			'name_admin_bar'        => esc_html__( 'Volunteer', 'charitus' ),
			'archives'              => esc_html__( 'Volunteer Archives', 'charitus' ),
			'attributes'            => esc_html__( 'Volunteer Attributes', 'charitus' ),
			'parent_item_colon'     => esc_html__( 'Parent Volunteer:', 'charitus' ),
			'all_items'             => esc_html__( 'All Volunteers', 'charitus' ),
			'add_new_item'          => esc_html__( 'Add New Volunteer', 'charitus' ),
			'add_new'               => esc_html__( 'Add New Volunteer', 'charitus' ),
			'new_item'              => esc_html__( 'New Volunteer', 'charitus' ),
			'edit_item'             => esc_html__( 'Edit Volunteer', 'charitus' ),
			'update_item'           => esc_html__( 'Update Volunteer', 'charitus' ),
			'view_item'             => esc_html__( 'View Volunteer', 'charitus' ),
			'view_items'            => esc_html__( 'View Volunteers', 'charitus' ),
			'search_items'          => esc_html__( 'Search Volunteer', 'charitus' ),
			'not_found'             => esc_html__( 'Not found', 'charitus' ),
			'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'charitus' ),
			'featured_image'        => esc_html__( 'Volunteer Featured Image', 'charitus' ),
			'set_featured_image'    => esc_html__( 'Set Volunteer featured image', 'charitus' ),
			'remove_featured_image' => esc_html__( 'Remove Volunteer featured image', 'charitus' ),
			'use_featured_image'    => esc_html__( 'Use as Volunteer featured image', 'charitus' ),
			'insert_into_item'      => esc_html__( 'Insert into Volunteer', 'charitus' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this Volunteer', 'charitus' ),
			'items_list'            => esc_html__( 'Volunteers list', 'charitus' ),
			'items_list_navigation' => esc_html__( 'Volunteer list navigation', 'charitus' ),
			'filter_items_list'     => esc_html__( 'Filter Volunteers list', 'charitus' ),
		);
		$args = array(
			'label'                 => esc_html__( 'Volunteer', 'charitus' ),
			'description'           => esc_html__( 'Volunteer Description', 'charitus' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-networking',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'charitus_volanteers', $args );

	}
	add_action( 'init', 'charitus_volunteers_post_type', 0 );
}