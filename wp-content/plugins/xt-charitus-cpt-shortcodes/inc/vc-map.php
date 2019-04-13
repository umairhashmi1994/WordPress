<?php

/**
 * Theme : charitus
 *
 * Visual Composer Custom Functionss
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Education iocn script
 */

add_action( 'vc_base_register_front_css', 'charitus_iconpicker_base_register_css' );
add_action( 'vc_base_register_admin_css', 'charitus_iconpicker_base_register_css' );

if ( ! function_exists( 'charitus_iconpicker_base_register_css' ) ){
	function charitus_iconpicker_base_register_css() {
		wp_enqueue_style( 'charitus-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon.css', array(), '1.0' );
	}
}

add_action( 'vc_enqueue_font_icon_element', 'charitus_add_custom_icons_to_vc' );

if ( ! function_exists( 'charitus_add_custom_icons_to_vc' ) ){
	function charitus_add_custom_icons_to_vc( $font ){
		wp_enqueue_style( 'charitus-flaticon' );
	}
}


/**
 * Education iocn collection
 */

add_filter( 'vc_iconpicker-type-charitus_flaticon', 'charitus_vc_iconpicker_type_education' );

if ( ! function_exists( 'charitus_vc_iconpicker_type_education' ) ){
	function charitus_vc_iconpicker_type_education( $icons ) {

		$charitus_flaticon = array(
			array( 'fa flaticon-fire' 					=> 'Fire' ),
			array( 'fa flaticon-trophy' 				=> 'Trophy' ),
			array( 'fa flaticon-signs' 					=> 'Signs' ),
			array( 'fa flaticon-present' 				=> 'present' ),
			array( 'fa flaticon-summer' 				=> 'summer' ),
			array( 'fa flaticon-weather' 				=> 'weather' ),
			array( 'fa flaticon-internet' 				=> 'internet' ),
			array( 'fa flaticon-food' 					=> 'food' ),
			array( 'fa flaticon-book' 					=> 'book' ),
			array( 'fa flaticon-graphic' 				=> 'graphic' ),
			array( 'fa flaticon-profile' 				=> 'profile' ),
			array( 'fa flaticon-money' 					=> 'money' ),
			array( 'fa flaticon-rocket-launch' 			=> 'rocket-launch' ),
			array( 'fa flaticon-mail' 					=> 'mail' ),
			array( 'fa flaticon-phone-call' 			=> 'phone-call' ),
			array( 'fa flaticon-envelope' 				=> 'envelope' ),
			array( 'fa flaticon-location' 				=> 'location' ),
			array( 'fa flaticon-calendar' 				=> 'calendar' ),
			array( 'fa flaticon-placeholder' 			=> 'placeholder' ),
			array( 'fa flaticon-list' 					=> 'list' ),
			array( 'fa flaticon-020-list' 				=> '020-list' ),
		);

		$input = array_merge( $icons, $charitus_flaticon );

		return $input;
	}
}


/**
 * New Params to vc Shortcodes
 */

add_action( 'vc_after_init', 'charitus_vc_add_new_params' );

if ( ! function_exists( 'charitus_vc_add_new_params' ) ){
	function charitus_vc_add_new_params() {
	    
	    /* For VC row */

	    $vc_row_new_params = array(
	       
	        array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Parallax Overlay Color', 'charitus' ),
				'param_name' 	=> 'xt_bg_overlay_color',
				'value' 		=> 'rgba(63,70,87,0.7)',
				'description'	=> esc_html__( 'Parallax image or video background overlay color', 'charitus' ),
				'dependency' 	=> array(
					'element' 	=> 'parallax',
					'not_empty' => true,
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Row Color', 'charitus' ),
				'param_name' 	=> 'xt_row_color',
				'value' 		=> array(
					esc_html__( 'Default', 'charitus' ) 	=> 'default',
					esc_html__( 'White', 'charitus' ) 		=> 'white',
				),
				'description' 	=> esc_html__( 'Row text color.', 'charitus' ),
				'admin_label' 	=> true,
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Text align', 'charitus' ),
				'param_name' 	=> 'xt_row_text_align',
				'value' 		=> array(
					esc_html__( 'Default', 'charitus' ) 		=> '',
					esc_html__( 'Left', 'charitus' ) 			=> 'left',
					esc_html__( 'Right', 'charitus' ) 		=> 'right',
					esc_html__( 'Center', 'charitus' ) 		=> 'center',
				),
				'description' 	=> esc_html__( 'Row text align.', 'charitus' ),
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Theme primary color background', 'charitus' ),
				'param_name' 	=> 'xt_row_bg_primary',
				'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
				'description' 	=> esc_html__( 'If checked this row background color will be themes primary color.', 'charitus' ),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Padding Bottom', 'charitus' ),
				'param_name' 	=> 'xt_row_padding_bottom',
				'value' 		=> array(
					esc_html__( 'Default', 'charitus' ) 		=> '',	
					esc_html__( 'Medium', 'charitus' ) 		=> 'medium',
					esc_html__( 'Large', 'charitus' ) 		=> 'large',
				),
				'description' 	=> esc_html__( 'Row padding bottom.', 'charitus' ),
			),
	     
	    );
	     
	    vc_add_params( 'vc_row', $vc_row_new_params );


	    /* For VC btn */

	    $vc_btn_new_param = array(
			'type' 			=> 'checkbox',
			'heading' 		=> esc_html__( 'Theme primary button', 'charitus' ),
			'param_name' 	=> 'xt_vc_btn_theme_primary',
			'value'        	=> array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
			'description' 	=> esc_html__( 'If checked this button background color & style will be themes primary button type.', 'charitus' ),
		);

		vc_add_param( 'vc_btn', $vc_btn_new_param );


		/**
		 *  For VC Accordion
		 */

		$vc_accordion_new_param = array(
			'type' 			=> 'checkbox',
			'heading' 		=> esc_html__( 'Theme primary accordion', 'charitus' ),
			'param_name' 	=> 'xt_vc_accordion_theme_primary',
			'value'        	=> array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
			'description' 	=> esc_html__( 'If checked this accordion style will be themes primary accordion type.', 'charitus' ),
		);

		vc_add_param( 'vc_tta_accordion', $vc_accordion_new_param );


		/**
		 *  VC progress bar Theme Primary
		 */

		$vc_progress_bar_new_param = array(
			'type' 			=> 'checkbox',
			'heading' 		=> esc_html__( 'Theme primary progress bar', 'charitus' ),
			'param_name' 	=> 'xt_vc_progress_bar_primary',
			'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
			'description' 	=> esc_html__( 'If checked this progress bar style will be themes primary type.', 'charitus' ),
		);

		vc_add_param( 'vc_progress_bar', $vc_progress_bar_new_param );


		/**
		 *  For VC Column
		 */

		$vc_column_new_params = array(
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Theme primary Style', 'charitus' ),
				'param_name' 	=> 'xt_vc_column_theme_primary',
				'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
				'description' 	=> esc_html__( 'If checked this column style will be themes primary column type. White background, box shadow and border radius.', 'charitus' ),
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Column No Padding', 'charitus' ),
				'param_name' 	=> 'xt_vc_column_no_padding',
				'value'        	=> array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
				'description' 	=> esc_html__( 'If checked this column will be forced for no padding.', 'charitus' ),
			),
			array(
				'type' 			=> 'checkbox',
				'heading' 		=> esc_html__( 'Small Screen No Padding', 'charitus' ),
				'param_name' 	=> 'xt_vc_column_sm_no_padding',
				'value'        	=> array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
				'std'        	=> 'on',
				'description' 	=> esc_html__( 'If checked this column will be forced for no padding on small screen.', 'charitus' ),
			)
		);

		vc_add_params('vc_column', $vc_column_new_params);
	}


	/**
	 * Disable Front end 
	 */

	vc_disable_frontend();


	/**
	 * Visual Composer set as theme
	 */

	add_action( 'vc_before_init', 'charitus_vc_set_ss_theme' );

	function charitus_vc_set_ss_theme() {
		vc_set_as_theme();
	}


	/**
	 * Remove VC mata TAG
	 */

	add_action('init', 'charitus_remove_vc_meta', 100);

	function charitus_remove_vc_meta() {
		if( function_exists( 'visual_composer' ) ){
			remove_action('wp_head', array(visual_composer(), 'addMetaData'));
		}
	}

	/**
	 * Theme VC shortcode map
	 */

	if ( ! class_exists( 'XT_VC_Elements_Class' ) ) {

	   /**
	    * Theme VC element Class
	    *
	    * @since   1.0
	    */

	   	class XT_VC_Elements_Class {


			/**
			* Constructor, checks for Visual Composer and defines hooks
			*
			* @since   1.0
			*/

			function __construct() {
				add_action( 'after_setup_theme', array( $this, 'vc_init' ), 1 );
			}

	        public function vc_init() {
	            if ( ! defined( 'WPB_VC_VERSION' ) ) {
	                return;
	            }
	            if ( version_compare( WPB_VC_VERSION, '4.2', '<' ) ) {
	            	add_action( 'after_setup_theme', array( $this, 'vc_shortcodes_map' ) );
	            } else {
	            	add_action( 'vc_after_mapping', array( $this, 'vc_shortcodes_map' ) );
	            }

	            vc_add_shortcode_param( 'numberfield', array( $this, 'wpat_number_param_settings_field' ) );
	        }

	        /**
	         * VC Params Number
	         */

			public function wpat_number_param_settings_field( $settings, $value ) {
				return '<div class="number_param_block">'
				.'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
				esc_attr( $settings['param_name'] ) . ' ' .
				esc_attr( $settings['type'] ) . '_field" type="number" value="' . esc_attr( $value ) . '" />' .
				'</div>';
			}



	        /**
	         * Shortcode Map
	         */
	        
	      	public function vc_shortcodes_map() {

		        /* Check if Visual Composer is installed */

				if ( ! defined( 'WPB_VC_VERSION' ) || ! function_exists( 'vc_add_param' ) ) {
					return;
				}


				/**
				 * Section Title ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Section Title', 'charitus' ),
					'base'            => 'charitus_section_title',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Section title and sub-title.', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Title first part', 'charitus' ),
							'param_name' 	=> 'title_first_part',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Title last part', 'charitus' ),
							'param_name' 	=> 'title_second_part',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Sub Title', 'charitus' ),
							'param_name' 	=> 'charitus_subtitle',
						),
						array(
							'type'      	=> 'dropdown',
							'heading'   	=> esc_html__( 'Title Align', 'charitus' ),
							'value'     	=> array(
								esc_html__( 'Center', 'charitus' ) 		=> 'center',
								esc_html__( 'Left', 'charitus' ) 		=> 'left',
								esc_html__( 'Right', 'charitus' ) 		=> 'right',
							),
							'std'			=> 'center',
							'param_name'   	=> 'title_align',
							'description'  	=> esc_html__( 'Select text align for title.', 'charitus' ),
						),
						array(
							'type'      	=> 'dropdown',
							'heading'   	=> esc_html__( 'Title Margin Bottom', 'charitus' ),
							'value'     	=> array(
								esc_html__( 'Small', 'charitus' ) 		=> 'small',
								esc_html__( 'Medium', 'charitus' ) 		=> 'medium',
								esc_html__( 'Large', 'charitus' ) 		=> 'large',
							),
							'std'			=> 'medium',
							'param_name'   	=> 'margin_bottom',
							'description'  	=> esc_html__( 'Default: Medium.', 'charitus' ),
						),
					)
				) );


				/**
				 * Clients Logo
				 */
				
				vc_map( array(          
					'name'            => esc_html__( 'Clients Logo', 'charitus' ),
					'base'            => 'charitus_client_logo',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'Clearfix',
					'description'     => esc_html__( 'Clients logo grid.', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Image Size', 'charitus' ),
							'param_name' 	=> 'image_size_type',
							'value' 		=> array(
								esc_html__( 'Default', 'charitus' ) 		=> 'default',
								esc_html__( 'Custom Size', 'charitus' ) 	=> 'custom',
							),
							'description' 	=> esc_html__( 'Image size, If use use custom image size, make sure you upload larger image then the define size here.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Image Width', 'charitus' ),
							'param_name'   => 'image_width',
							'value'        => 450,
							'description'  => esc_html__( 'Image width. Default 450', 'charitus' ),
							'admin_label'  => true,
							'dependency'   => array(
								'element' => 'image_size_type',
								'value'   => 'custom',
							),
						),
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Image Height', 'charitus' ),
							'param_name'   => 'image_height',
							'value'        => 450,
							'description'  => esc_html__( 'Image height. Default 450', 'charitus' ),
							'admin_label'  => true,
							'dependency'   => array(
								'element' => 'image_size_type',
								'value'   => 'custom',
							),
						),
						array(
			                'type' 			=> 'param_group',
			                'value' 		=> '',
			                'heading' 		=> esc_html__( 'Logo Images', 'charitus' ),
			                'param_name' 	=> 'logo_images',
			                'params' 		=> array(
			                	array(
				                  'type'         => 'attach_image',
				                  'heading'      => esc_html__( 'Logo image', 'charitus' ),
				                  'param_name'   => 'logo_img',
				                  'description'  => esc_html__( 'Upload a image / logo here.', 'charitus' ),
				               	),
			                    array(
			                        'type' 			=> 'textfield',
			                        'value' 		=> '',
			                        'heading' 		=> esc_html__( 'Logo URL', 'charitus' ),
			                        'param_name' 	=> 'logo_url',
			                    )
			                )
			            )
					)
				));


				/**
				 * Donate ShortCode
				 */
				
				vc_map( array(          
					'name'            => esc_html__( 'Main Feature', 'charitus' ),
					'base'            => 'charitus_features',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Main feature, with icon, title, content and button. ', 'charitus' ),
					'params'          => array(
						array(
							'type'      => 'dropdown',
							'heading'   => esc_html__( 'Icon library', 'charitus' ),
							'value'     => array(
								esc_html__( 'Font Awesome', 'charitus' ) 				=> 'icon',
								esc_html__( 'Charitus Icons', 'charitus' )  			=> 'charitus_flaticon',
							),
							'param_name'   => 'icon_type',
							'description'  => esc_html__( 'Select icon library.', 'charitus' ),
						),
	                    array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'icon',
							'settings'     => array(
								'emptyIcon'    => false,
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'icon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'charitus_flaticon',
							'settings'     => array(
								'emptyIcon' => false,
								'type'      => 'charitus_flaticon',
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'charitus_flaticon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
	                        'type' 			=> 'textfield',
	                        'heading' 		=> esc_html__( 'Heading', 'charitus' ),
	                        'param_name' 	=> 'title',
	                        'admin_label' 	=> true,
	                    ),
						array(
	                        'type' 			=> 'textfield',
	                        'heading' 		=> esc_html__( 'Content', 'charitus' ),
	                        'param_name' 	=> 'donate_content',
	                    ),
						array(
	                        'type' 			=> 'textfield',
	                        'heading' 		=> esc_html__( 'Maximum Content Word', 'charitus' ),
	                        'param_name' 	=> 'content_word_count',
	                        'admin_label' 	=> true,
	                    ),
						array(
	                        'type' 			=> 'textfield',
	                        'heading' 		=> esc_html__( 'Button Text', 'charitus' ),
	                        'param_name' 	=> 'btn_text',
	                        'admin_label' 	=> true,
	                    ),
						array(
	                        'type' 			=> 'textfield',
	                        'heading' 		=> esc_html__( 'Button Link URL', 'charitus' ),
	                        'param_name' 	=> 'btn_url',
	                        'admin_label' 	=> true,
	                    ),
					)
				) );

				/**
				 * Mission ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Feature 2', 'charitus' ),
					'base'            => 'charitus_mission',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Feature with icon, title, content and link.', 'charitus' ),
					'params'          => array(
						array(
							'type'      => 'dropdown',
							'heading'   => esc_html__( 'Icon library', 'charitus' ),
							'value'     => array(
								esc_html__( 'Font Awesome', 'charitus' ) 				=> 'icon',
								esc_html__( 'Charitus Icons', 'charitus' )  			=> 'charitus_flaticon',
							),
							'param_name'   => 'icon_type',
							'description'  => esc_html__( 'Select icon library.', 'charitus' ),
						),
	                    array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'icon',
							'settings'     => array(
								'emptyIcon'    => false,
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'icon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'charitus_flaticon',
							'settings'     => array(
								'emptyIcon' => false,
								'type'      => 'charitus_flaticon',
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'charitus_flaticon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Heading', 'charitus' ),
							'param_name' 	=> 'title',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Content', 'charitus' ),
							'param_name' 	=> 'action_content',
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button Text', 'charitus' ),
							'param_name' 	=> 'btn_text',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button Link URL', 'charitus' ),
							'param_name' 	=> 'btn_url',
							'admin_label' 	=> true
						),
					)
				) );


				/**
				 * Call To Action ShortCode
				 */
				
				vc_map( array(          
					'name'            => esc_html__( 'Call To Action', 'charitus' ),
					'base'            => 'charitus_call_to_action',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Call To Action Settings', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Heading', 'charitus' ),
							'param_name' 	=> 'title',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Content', 'charitus' ),
							'param_name' 	=> 'action_content',
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button Text', 'charitus' ),
							'param_name' 	=> 'btn_text',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button URL', 'charitus' ),
							'param_name' 	=> 'btn_url',
							'admin_label' 	=> true
						),
					)
				) );

				/**
				 * volunteer  Call To Action ShortCode
				 */
				
				vc_map( array(          
					'name'            => esc_html__( 'Volunteer Call To Action', 'charitus' ),
					'base'            => 'volunteer_call_to_action',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Volunteer Call To Action Settings', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Heading', 'charitus' ),
							'param_name' 	=> 'title',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Content', 'charitus' ),
							'param_name' 	=> 'action_content',
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button Text', 'charitus' ),
							'param_name' 	=> 'btn_text',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Button URL', 'charitus' ),
							'param_name' 	=> 'btn_url',
							'admin_label' 	=> true
						),
					)
				) );


				/**
				 * Stats ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Stats', 'charitus' ),
					'base'            => 'charitus_stats',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Stats with amount, title and icon.', 'charitus' ),
					'params'          => array(
						array(
							'type'      => 'dropdown',
							'heading'   => esc_html__( 'Icon library', 'charitus' ),
							'value'     => array(
								esc_html__( 'Font Awesome', 'charitus' ) 				=> 'icon',
								esc_html__( 'Charitus Icons', 'charitus' )  			=> 'charitus_flaticon',
							),
							'param_name'   => 'icon_type',
							'description'  => esc_html__( 'Select icon library.', 'charitus' ),
						),
	                    array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'icon',
							'settings'     => array(
								'emptyIcon'    => false,
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'icon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
							'type'         => 'iconpicker',
							'heading'      => esc_html__( 'Icon', 'charitus' ),
							'param_name'   => 'charitus_flaticon',
							'settings'     => array(
								'emptyIcon' => false,
								'type'      => 'charitus_flaticon',
								'iconsPerPage' => 200,
							),
							'dependency'   => array(
								'element'   => 'icon_type',
								'value'     => 'charitus_flaticon',
							),
							'description'  => esc_html__( 'Select icon from library.', 'charitus' ),
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Number', 'charitus' ),
							'param_name' 	=> 'number',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Title', 'charitus' ),
							'param_name' 	=> 'title',
							'admin_label' 	=> true
						),
					)
				) );


				/**
				 * Contact Icon ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Contact Icon', 'charitus' ),
					'base'            => 'contact_icon_scode',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Contact Icon Settings', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'iconpicker',
							'heading' 		=> esc_html__( 'Choose Icon', 'charitus' ),
							'param_name' 	=> 'icon',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Heading', 'charitus' ),
							'param_name' 	=> 'title',
							'admin_label' 	=> true
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Content', 'charitus' ),
							'param_name' 	=> 'action_content',
							'admin_label' 	=> true
						),
					)
				) );


				/**
				 * Slider ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Main Slider', 'charitus' ),
					'base'            => 'charitus_main_slider',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Theme main slider', 'charitus' ),
					'params'          => array(
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Number of Sliders', 'charitus' ),
							'param_name'   => 'post',
							'value'        => '-1',
							'description'  => esc_html__( 'Number of Sliders to show. Default -1, it will show all', 'charitus' ),
							'admin_label'  => true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order by', 'charitus' ),
							'param_name' 	=> 'orderby',
							'value' 		=> array(
								esc_html__( 'Menu Order', 'charitus' ) 	  => 'menu_order',
								esc_html__( 'Date', 'charitus' ) 	      => 'date',
								esc_html__( 'Title', 'charitus' ) 		  => 'title',
								esc_html__( 'ID', 'charitus' ) 			  => 'ID',
								esc_html__( 'Last modified', 'charitus' ) => 'modified',
								esc_html__( 'Random', 'charitus' ) 		  => 'rand',
							),
							'description' 	=> esc_html__( 'Sliders orderby.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order', 'charitus' ),
							'param_name' 	=> 'order',
							'value'			=> array(
								esc_html__( 'Ascending', 'charitus' ) 	=> 'ASC',
								esc_html__( 'Descending', 'charitus' ) 	=> 'DESC',
							),
							'description'	=> esc_html__( 'Sliders order.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type' 			=> 'checkbox',
							'heading' 		=> esc_html__( 'Slider Loop', 'charitus' ),
							'param_name' 	=> 'loop',
							'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'description' 	=> esc_html__( 'Check this if you need the loop for this slider.', 'charitus' ),
							'std'        	=> 'on',
						),
						array(
							'type' 			=> 'checkbox',
							'heading' 		=> esc_html__( 'Slider Autoplay', 'charitus' ),
							'param_name' 	=> 'autoplay',
							'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'description' 	=> esc_html__( 'Check this if you need the autoplay for this slider.', 'charitus' ),
							'std'        	=> 'on',
						),
						array(
							'type' 			=> 'checkbox',
							'heading' 		=> esc_html__( 'Slider Navigation', 'charitus' ),
							'param_name' 	=> 'navigation',
							'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'description' 	=> esc_html__( 'Check this if you need the navigation for this slider.', 'charitus' ),
							'std'        	=> 'on',
						),
						array(
							'type' 			=> 'checkbox',
							'heading' 		=> esc_html__( 'Slider Pagination', 'charitus' ),
							'param_name' 	=> 'pagination',
							'value'         => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'description' 	=> esc_html__( 'Check this if you need the pagination for this slider.', 'charitus' ),
							'std'        	=> 'on',
						),
						array(
							'type'         => 'textfield',
							'heading'      => esc_html__( 'Specific Slide', 'charitus' ),
							'param_name'   => 'post_in_ids',
							'value'        => '',
							'description'  => esc_html__( 'You can put comma separated slider post id for showing those specific slides only.', 'charitus' ),
							'admin_label'  => true,
						),
						array(
							'type'         => 'textfield',
							'heading'      => esc_html__( 'Specific Slide Exclude', 'charitus' ),
							'param_name'   => 'post_not_in_ids',
							'value'        => '',
							'description'  => esc_html__( 'You can put comma separated slider post id for excluding those specific slides.', 'charitus' ),
							'admin_label'  => true,
						),
					)
				) );


				/**
				 * Volunteers ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Volunteers', 'charitus' ),
					'base'            => 'charitus_volunteer',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Volanteers grid. Add Volunteer to the Volunteers post type.', 'charitus' ),
					'params'          => array(
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Number of Volanteers', 'charitus' ),
							'param_name'   => 'post',
							'value'        => '-1',
							'description'  => esc_html__( 'Number of Volanteers to show. Default -1, it will show all', 'charitus' ),
							'admin_label'  => true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order by', 'charitus' ),
							'param_name' 	=> 'orderby',
							'value' 		=> array(
								esc_html__( 'Menu Order', 'charitus' ) 	  => 'menu_order',
								esc_html__( 'Date', 'charitus' ) 	      => 'date',
								esc_html__( 'Title', 'charitus' ) 		  => 'title',
								esc_html__( 'ID', 'charitus' ) 			  => 'ID',
								esc_html__( 'Last modified', 'charitus' ) => 'modified',
								esc_html__( 'Random', 'charitus' ) 		  => 'rand',
							),
							'description' 	=> esc_html__( 'Volunteers orderby.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order', 'charitus' ),
							'param_name' 	=> 'order',
							'value'			=> array(
								esc_html__( 'Ascending', 'charitus' ) 	=> 'ASC',
								esc_html__( 'Descending', 'charitus' ) 	=> 'DESC',
							),
							'description'	=> esc_html__( 'Volunteers order.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Columns', 'charitus' ),
							'param_name' 	=> 'column',
							'value' 		=> array(
								esc_html__( 'Select grid columns', 'charitus' ) 	=> '',
								esc_html__( '6 Columns', 'charitus' ) 			=> 6,
								esc_html__( '4 Columns', 'charitus' ) 			=> 4,
								esc_html__( '3 Columns', 'charitus' ) 			=> 3,
								esc_html__( '2 Columns', 'charitus' ) 			=> 2,
								esc_html__( '1 Column', 'charitus' ) 			=> 1,
							),
							'description' 	=> esc_html__( 'Default 3 columns', 'charitus' ),
							'admin_label' 	=> true,
							'std' 			=> 4,
						),
					)
				) );


				/**
				 * Testimonial ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Testimonial', 'charitus' ),
					'base'            => 'charitus_testimonial',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Testimonial Settings', 'charitus' ),
					'params'          => array(
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Number of Testimonials', 'charitus' ),
							'param_name'   => 'post',
							'value'        => '-1',
							'description'  => esc_html__( 'Number of Testimonials to show. Default -1, it will show all', 'charitus' ),
							'admin_label'  => true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order by', 'charitus' ),
							'param_name' 	=> 'orderby',
							'value' 		=> array(
								esc_html__( 'Menu Order', 'charitus' ) 	  => 'menu_order',
								esc_html__( 'Date', 'charitus' ) 	      => 'date',
								esc_html__( 'Title', 'charitus' ) 		  => 'title',
								esc_html__( 'ID', 'charitus' ) 			  => 'ID',
								esc_html__( 'Last modified', 'charitus' ) => 'modified',
								esc_html__( 'Random', 'charitus' ) 		  => 'rand',
							),
							'description' 	=> esc_html__( 'Testimonials orderby.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order', 'charitus' ),
							'param_name' 	=> 'order',
							'value'			=> array(
								esc_html__( 'Ascending', 'charitus' ) 	=> 'ASC',
								esc_html__( 'Descending', 'charitus' ) 	=> 'DESC',
							),
							'description'	=> esc_html__( 'Testimonials order.', 'charitus' ),
							'admin_label' 	=> true,
						),
					)
				) );


				/**
				 * Gallery ShortCode
				 */
				
				vc_map( array(        
					'name'            => esc_html__( 'Gallery', 'charitus' ),
					'base'            => 'charitus_gallery',
					'icon'            => 'xt-vc-icon',
					'category'        => esc_html__( 'Charitus', 'charitus' ),
					'wrapper_class'   => 'clearfix',
					'description'     => esc_html__( 'Gallery Settings', 'charitus' ),
					'params'          => array(
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Gallery columns', 'charitus' ),
							'param_name' 	=> 'column',
							'value' 		=> array(
								esc_html__( 'Select grid columns', 'charitus' ) 	=> '',
								esc_html__( '6 Columns', 'charitus' ) 			=> 6,
								esc_html__( '4 Columns', 'charitus' ) 			=> 4,
								esc_html__( '3 Columns', 'charitus' ) 			=> 3,
								esc_html__( '2 Columns', 'charitus' ) 			=> 2,
								esc_html__( '1 Column', 'charitus' ) 			=> 1,
							),
							'description' 	=> esc_html__( 'Default 3 columns', 'charitus' ),
							'admin_label' 	=> true,
							'std' 			=> 3,
						),
						array(
							'type' 			=> 'attach_images',
							'heading' 		=> esc_html__( 'Images', 'charitus' ),
							'param_name' 	=> 'images',
							'value' 		=> '',
							'description' 	=> esc_html__( 'Select images from media library.', 'charitus' ),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Image Size', 'charitus' ),
							'param_name' 	=> 'image_size_type',
							'value' 		=> array(
								esc_html__( 'Default', 'charitus' ) 		=> 'default',
								esc_html__( 'Custom Size', 'charitus' ) 	=> 'custom',
							),
							'description' 	=> esc_html__( 'Image size, If use use custom image size, make sure you upload larger image then the define size here.', 'charitus' ),
							'admin_label' 	=> true,
						),
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Image Width', 'charitus' ),
							'param_name'   => 'image_width',
							'value'        => 640,
							'description'  => esc_html__( 'Image width. Default 640', 'charitus' ),
							'admin_label'  => true,
							'dependency'   => array(
								'element' => 'image_size_type',
								'value'   => 'custom',
							),
						),
						array(
							'type'         => 'numberfield',
							'heading'      => esc_html__( 'Image Height', 'charitus' ),
							'param_name'   => 'image_height',
							'value'        => 426,
							'description'  => esc_html__( 'Image height. Default 426', 'charitus' ),
							'admin_label'  => true,
							'dependency'   => array(
								'element' => 'image_size_type',
								'value'   => 'custom',
							),
						),
						array(
							'type'         => 'checkbox',
							'heading'      => esc_html__( 'Show gallery title', 'charitus' ),
							'param_name'   => 'show_title',
							'description'  => esc_html__( 'Enable or disable the gallery title.', 'charitus' ),
							'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'std'          => 'on',
							'group' 	   => esc_html__( 'Content settings', 'charitus' ),
						),
						array(
							'type'         => 'checkbox',
							'heading'      => esc_html__( 'Show gallery description', 'charitus' ),
							'param_name'   => 'show_description',
							'description'  => esc_html__( 'Enable or disable the gallery description.', 'charitus' ),
							'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
							'std'          => 'on',
							'group' 	   => esc_html__( 'Content settings', 'charitus' ),
						),
					)
				) );


				/**
				 * Donation Causes
				 */

				if( charitus_plugin_active( 'charitable/charitable.php' ) ){
					vc_map( array(          
						'name'            => esc_html__( 'Donation Causes', 'charitus' ),
						'base'            => 'charitus_donation_causes',
						'icon'            => 'xt-vc-icon',
						'category'        => esc_html__( 'Charitus', 'charitus' ),
						'wrapper_class'   => 'clearfix',
						'description'     => esc_html__( 'Donation cause grid / list / slider.', 'charitus' ),
						'params'          => array(
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Content type', 'charitus' ),
								'param_name' 	=> 'type',
								'value' 		=> array(
									esc_html__( 'Grid', 'charitus' ) 		=> 'grid',
									esc_html__( 'Slider', 'charitus' ) 		=> 'slider',
									esc_html__( 'List', 'charitus' ) 		=> 'list',
								),
								'description' 	=> esc_html__( 'Cause content type. Grid / list / slider.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Include cause that have expired', 'charitus' ),
								'param_name'   => 'include_inactive',
								'description'  => esc_html__( 'Default no, Check this to enable.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Image Size', 'charitus' ),
								'param_name' 	=> 'image_size_type',
								'value' 		=> array(
									esc_html__( 'Default', 'charitus' ) 		=> 'default',
									esc_html__( 'Custom Size', 'charitus' ) 	=> 'custom',
								),
								'description' 	=> esc_html__( 'Image size, If use use custom image size, make sure you upload larger image then the define size here.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Image Width', 'charitus' ),
								'param_name'   => 'image_width',
								'value'        => 450,
								'description'  => esc_html__( 'Cause image width. Default 450', 'charitus' ),
								'admin_label'  => true,
								'dependency'   => array(
									'element' => 'image_size_type',
									'value'   => 'custom',
								),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Image Height', 'charitus' ),
								'param_name'   => 'image_height',
								'value'        => 450,
								'description'  => esc_html__( 'Cause image height. Default 450', 'charitus' ),
								'admin_label'  => true,
								'dependency'   => array(
									'element' => 'image_size_type',
									'value'   => 'custom',
								),
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Cause grid columns', 'charitus' ),
								'param_name' 	=> 'column',
								'value' 		=> array(
									esc_html__( 'Select grid columns', 'charitus' ) 	=> '',
									esc_html__( '6 Columns', 'charitus' ) 			=> 6,
									esc_html__( '4 Columns', 'charitus' ) 			=> 4,
									esc_html__( '3 Columns', 'charitus' ) 			=> 3,
									esc_html__( '2 Columns', 'charitus' ) 			=> 2,
									esc_html__( '1 Column', 'charitus' ) 			=> 1,
								),
								'description' 	=> esc_html__( 'Default 3 columns', 'charitus' ),
								'admin_label' 	=> true,
								'std' 			=> 3,
								'dependency'    => array(
									'element' => 'type',
									'value'   => 'grid',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider auto play', 'charitus' ),
								'param_name'   => 'autoplay',
								'description'  => esc_html__( 'Default yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'std' 	   	   => 'true',
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider navigation', 'charitus' ),
								'param_name'   => 'navigation',
								'description'  => esc_html__( 'Default yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'std' 	   	   => 'true',
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider pagination', 'charitus' ),
								'param_name'   => 'pagination',
								'description'  => esc_html__( 'Default no.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider Loop', 'charitus' ),
								'param_name'   => 'loop',
								'description'  => esc_html__( 'Default yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'std' 	   	   => 'true',
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns default', 'charitus' ),
								'param_name'   => 'items',
								'value'        => '3',
								'description'  => esc_html__( 'Number of slider columns in default screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns desktop small', 'charitus' ),
								'param_name'   => 'desktopsmall',
								'value'        => '3',
								'description'  => esc_html__( 'Number of slider columns in desktop small screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns tablet', 'charitus' ),
								'param_name'   => 'tablet',
								'value'        => '2',
								'description'  => esc_html__( 'Number of slider columns in tablet screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns mobile', 'charitus' ),
								'param_name'   => 'mobile',
								'value'        => '1',
								'description'  => esc_html__( 'Number of slider columns in mobile screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Number of Cause', 'charitus' ),
								'param_name'   => 'post',
								'value'        => '-1',
								'description'  => esc_html__( 'Number of Cause to show. Default -1, it will show all', 'charitus' ),
								'admin_label'  => true,
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Order by', 'charitus' ),
								'param_name' 	=> 'orderby',
								'value' 		=> array(
									esc_html__( 'Date', 'charitus' ) 			=> 'date',
									esc_html__( 'Menu Order', 'charitus' ) 		=> 'menu_order',
									esc_html__( 'Title', 'charitus' ) 			=> 'title',
									esc_html__( 'ID', 'charitus' ) 				=> 'ID',
									esc_html__( 'Last modified', 'charitus' ) 	=> 'modified',
									esc_html__( 'Random', 'charitus' ) 			=> 'rand',
								),
								'description' 	=> esc_html__( 'Cause orderby.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Order', 'charitus' ),
								'param_name' 	=> 'order',
								'value'			=> array(
									esc_html__( 'Ascending', 'charitus' ) 	=> 'ASC',
									esc_html__( 'Descending', 'charitus' ) 	=> 'DESC',
								),
								'description'	=> esc_html__( 'Cause order.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Cause Creator', 'charitus' ),
								'param_name'   => 'creator',
								'description'  => esc_html__( 'Only show causes created by a certain user. Comma separated user IDs.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Cause categories', 'charitus' ),
								'param_name'   => 'causes_categories',
								'description'  => esc_html__( 'Comma separated Cause categories id. It will show Causes form this categories only.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Cause tags', 'charitus' ),
								'param_name'   => 'causes_tags',
								'description'  => esc_html__( 'Comma separated Cause tags id. It will show Causes form this tags only.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Cause ids', 'charitus' ),
								'param_name'   => 'post_in',
								'description'  => esc_html__( 'Comma separated Cause id. It will show this selected Causes only.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Cause ids to exclude', 'charitus' ),
								'param_name'   => 'post_not_in',
								'description'  => esc_html__( 'Comma separated Cause ids to exclude.', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Cause short description', 'charitus' ),
								'param_name'   => 'cause_excerpt',
								'description'  => esc_html__( 'Enable or disable the short description.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Cause excerpt length', 'charitus' ),
								'param_name'   => 'excerpt_length',
								'value'        => 20,
								'description'  => esc_html__( 'Default 20 words.', 'charitus' ),
								'dependency'   => array(
									'element' => 'cause_excerpt',
									'value'   => 'on',
								),
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show cause donate button', 'charitus' ),
								'param_name'   => 'donate_btn',
								'description'  => esc_html__( 'Default yes, Check this to disable.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'		   => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show cause stats', 'charitus' ),
								'param_name'   => 'cause_stats',
								'description'  => esc_html__( 'Default yes, Check this to disable.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'		   => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show progress bar', 'charitus' ),
								'param_name'   => 'cause_progress_bar',
								'description'  => esc_html__( 'Default yes, Check this to disable.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'		   => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
						),
					));
				}


				/**
				 * Campaign Search
				 */

				if( charitus_plugin_active( 'charitable/charitable.php' ) ){
					vc_map( array(          
						'name'            => esc_html__( 'Campaign Search', 'charitus' ),
						'base'            => 'charitus_campaign_search',
						'icon'            => 'xt-vc-icon',
						'category'        => esc_html__( 'Charitus', 'charitus' ),
						'wrapper_class'   => 'clearfix',
						'description'     => esc_html__( 'Ajax search box for searching campaigns.', 'charitus' ),
						'params'          => array(
							array(
			                  'type'         => 'attach_image',
			                  'heading'      => esc_html__( 'Logo image', 'charitus' ),
			                  'param_name'   => 'before_search_img',
			                  'description'  => esc_html__( 'You can upload a image / logo here, it will show on top of the search box.', 'charitus' ),
			               	),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Title text', 'charitus' ),
								'param_name'   => 'before_search_title',
								'description'  => esc_html__( 'Title text, It will show on top of the search box.', 'charitus' ),
								'std'  		   => esc_html__( 'Search Campaigns', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Subtitle text', 'charitus' ),
								'param_name'   => 'before_search_subtitle',
								'description'  => esc_html__( 'Subtitle text, It will show on top of the search box.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Search placeholder', 'charitus' ),
								'param_name'   => 'placeholder',
								'description'  => esc_html__( 'Search box placeholder text.', 'charitus' ),
								'std'  		   => esc_html__( 'Search...', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Donation Statics', 'charitus' ),
								'param_name'   => 'after_search_stats',
								'description'  => esc_html__( 'Show donation statics bellow the search box. Default: Yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Count', 'charitus' ),
								'param_name'   => 'show_campaign_count',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'dependency'   => array(
									'element' => 'after_search_stats',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Donated Amount', 'charitus' ),
								'param_name'   => 'show_campaign_donated_amount',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'dependency'   => array(
									'element' => 'after_search_stats',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Donors Count', 'charitus' ),
								'param_name'   => 'show_campaign_donors_count',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'dependency'   => array(
									'element' => 'after_search_stats',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Extra class', 'charitus' ),
								'param_name'   => 'x_class',
								'description'  => esc_html__( 'Extra css class.', 'charitus' ),
							),
						)
					));
				}

				/**
				 * Campaign stats [ Real Data ]
				 */

				if( charitus_plugin_active( 'charitable/charitable.php' ) ){
					vc_map( array(          
						'name'            => esc_html__( 'Campaign Stats', 'charitus' ),
						'base'            => 'charitus_donation_stats',
						'icon'            => 'xt-vc-icon',
						'category'        => esc_html__( 'Charitus', 'charitus' ),
						'wrapper_class'   => 'clearfix',
						'description'     => esc_html__( 'Charitable campaigns statics.', 'charitus' ),
						'params'          => array(
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Columns', 'charitus' ),
								'param_name' 	=> 'column',
								'value' 		=> array(
									esc_html__( '6 Columns', 'charitus' ) 			=> 6,
									esc_html__( '4 Columns', 'charitus' ) 			=> 4,
									esc_html__( '3 Columns', 'charitus' ) 			=> 3,
									esc_html__( '2 Columns', 'charitus' ) 			=> 2,
									esc_html__( '1 Column', 'charitus' ) 			=> 1,
								),
								'description' 	=> esc_html__( 'Default 3 columns', 'charitus' ),
								'admin_label' 	=> true,
								'std' 			=> 3,
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Count', 'charitus' ),
								'param_name'   => 'show_campaign_count',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Campaigns Text Singular', 'charitus' ),
								'param_name'   => 'campaigns_text_singular',
								'description'  => esc_html__( 'Campaigns text for singular number.', 'charitus' ),
								'std'  		   => esc_html__( 'Campaign', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_campaign_count',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Campaigns Text Plural', 'charitus' ),
								'param_name'   => 'campaigns_text_plural',
								'description'  => esc_html__( 'Campaigns text for plural number.', 'charitus' ),
								'std'  		   => esc_html__( 'Campaigns', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_campaign_count',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Donated Amount', 'charitus' ),
								'param_name'   => 'show_campaign_donated_amount',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Donated Text', 'charitus' ),
								'param_name'   => 'donated_text',
								'std'  		   => esc_html__( 'Donated', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_campaign_donated_amount',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show Campaign Donor Count', 'charitus' ),
								'param_name'   => 'show_campaign_donors_count',
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Donor Text Singular', 'charitus' ),
								'param_name'   => 'donor_text_singular',
								'description'  => esc_html__( 'Donor text for singular number.', 'charitus' ),
								'std'  		   => esc_html__( 'Donor', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_campaign_donors_count',
									'value'   => 'on',
								),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Donor Text Plural', 'charitus' ),
								'param_name'   => 'donor_text_plural',
								'description'  => esc_html__( 'Donor text for plural number.', 'charitus' ),
								'std'  		   => esc_html__( 'Donors', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_campaign_donors_count',
									'value'   => 'on',
								),
							),
						)
					));
				}


				/**
				 * Event Grid / slider
				 */

				if ( class_exists( 'Tribe__Events__Main' ) ) {

					vc_map( array(          
						'name'            => esc_html__( 'Events', 'charitus' ),
						'base'            => 'charitus_events',
						'icon'            => 'xt-vc-icon',
						'category'        => esc_html__( 'Charitus', 'charitus' ),
						'wrapper_class'   => 'clearfix',
						'description'     => esc_html__( 'Events Grid / slider.', 'charitus' ),
						'params'          => array(
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Content type', 'charitus' ),
								'param_name' 	=> 'type',
								'value' 		=> array(
									esc_html__( 'Grid', 'charitus' ) 		=> 'grid',
									esc_html__( 'Slider', 'charitus' ) 		=> 'slider',
								),
								'description' 	=> esc_html__( 'Events content type. Grid / slider.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Image Size', 'charitus' ),
								'param_name' 	=> 'image_size_type',
								'value' 		=> array(
									esc_html__( 'Default', 'charitus' ) 		=> 'default',
									esc_html__( 'Custom Size', 'charitus' ) 	=> 'custom',
								),
								'description' 	=> esc_html__( 'Image size, If use use custom image size, make sure you upload larger image then the define size here.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Image Width', 'charitus' ),
								'param_name'   => 'image_width',
								'value'        => 450,
								'description'  => esc_html__( 'Events image width. Default 450', 'charitus' ),
								'admin_label'  => true,
								'dependency'   => array(
									'element' => 'image_size_type',
									'value'   => 'custom',
								),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Image Height', 'charitus' ),
								'param_name'   => 'image_height',
								'value'        => 450,
								'description'  => esc_html__( 'Events image height. Default 450', 'charitus' ),
								'admin_label'  => true,
								'dependency'   => array(
									'element' => 'image_size_type',
									'value'   => 'custom',
								),
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Events grid columns', 'charitus' ),
								'param_name' 	=> 'column',
								'value' 		=> array(
									esc_html__( 'Select grid columns', 'charitus' ) 	=> '',
									esc_html__( '6 Columns', 'charitus' ) 			=> 6,
									esc_html__( '4 Columns', 'charitus' ) 			=> 4,
									esc_html__( '3 Columns', 'charitus' ) 			=> 3,
									esc_html__( '2 Columns', 'charitus' ) 			=> 2,
									esc_html__( '1 Column', 'charitus' ) 			=> 1,
								),
								'description' 	=> esc_html__( 'Default 4 columns', 'charitus' ),
								'admin_label' 	=> true,
								'std' 			=> 3,
								'dependency'    => array(
									'element' => 'type',
									'value'   => 'grid',
								),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider auto play', 'charitus' ),
								'param_name'   => 'autoplay',
								'description'  => esc_html__( 'Default yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'std' 	   	   => 'true',
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider navigation', 'charitus' ),
								'param_name'   => 'navigation',
								'description'  => esc_html__( 'Default yes.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'std' 	   	   => 'true',
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider pagination', 'charitus' ),
								'param_name'   => 'pagination',
								'description'  => esc_html__( 'Default no.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Slider loop', 'charitus' ),
								'param_name'   => 'loop',
								'description'  => esc_html__( 'Default no.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'true' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns default', 'charitus' ),
								'param_name'   => 'items',
								'value'        => '3',
								'description'  => esc_html__( 'Number of slider columns in default screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns desktop small', 'charitus' ),
								'param_name'   => 'desktopsmall',
								'value'        => '3',
								'description'  => esc_html__( 'Number of slider columns in desktop small screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns tablet', 'charitus' ),
								'param_name'   => 'tablet',
								'value'        => '2',
								'description'  => esc_html__( 'Number of slider columns in tablet screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Slider columns mobile', 'charitus' ),
								'param_name'   => 'mobile',
								'value'        => '1',
								'description'  => esc_html__( 'Number of slider columns in mobile screen.', 'charitus' ),
								'dependency'   => array(
									'element' => 'type',
									'value'   => 'slider',
								),
								'group' 	   => esc_html__( 'Slider settings', 'charitus' ),
							),
							array(
								'type'         => 'numberfield',
								'heading'      => esc_html__( 'Number of events', 'charitus' ),
								'param_name'   => 'post',
								'value'        => '-1',
								'description'  => esc_html__( 'Number of events to show. Default -1, it will show all', 'charitus' ),
								'admin_label'  => true,
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Order by', 'charitus' ),
								'param_name' 	=> 'orderby',
								'value' 		=> array(
									esc_html__( 'Menu Order', 'charitus' ) 	=> 'menu_order',
									esc_html__( 'Date', 'charitus' ) 			=> 'date',
									esc_html__( 'Title', 'charitus' ) 		=> 'title',
									esc_html__( 'ID', 'charitus' ) 			=> 'ID',
									esc_html__( 'Last modified', 'charitus' ) => 'modified',
									esc_html__( 'Random', 'charitus' ) 		=> 'rand',
								),
								'description' 	=> esc_html__( 'Events orderby.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type' 			=> 'dropdown',
								'heading' 		=> esc_html__( 'Order', 'charitus' ),
								'param_name' 	=> 'order',
								'value'			=> array(
									esc_html__( 'Ascending', 'charitus' ) 	=> 'ASC',
									esc_html__( 'Descending', 'charitus' ) 	=> 'DESC',
								),
								'description'	=> esc_html__( 'Events order.', 'charitus' ),
								'admin_label' 	=> true,
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Events categories', 'charitus' ),
								'param_name'   => 'event_categories',
								'description'  => esc_html__( 'Comma separated event categories id. It will show events form this categories only.', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Events ids', 'charitus' ),
								'param_name'   => 'event_ids',
								'description'  => esc_html__( 'Comma separated events id. It will show this selected events only.', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show events short description', 'charitus' ),
								'param_name'   => 'show_excerpt',
								'description'  => esc_html__( 'Default on.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show events cost', 'charitus' ),
								'param_name'   => 'show_cost',
								'description'  => esc_html__( 'Default on.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'checkbox',
								'heading'      => esc_html__( 'Show events details button', 'charitus' ),
								'param_name'   => 'show_details_btn',
								'description'  => esc_html__( 'Default on.', 'charitus' ),
								'value'        => array( esc_html__( 'Yes', 'charitus' ) => 'on' ),
								'std'          => 'on',
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
							array(
								'type'         => 'textfield',
								'heading'      => esc_html__( 'Events details button text', 'charitus' ),
								'param_name'   => 'details_btn_text',
								'description'  => esc_html__( 'Default: Details.', 'charitus' ),
								'dependency'   => array(
									'element' => 'show_details_btn',
									'value'   => 'on',
								),
								'std' 	   	   => esc_html__( 'Details', 'charitus' ),
								'group' 	   => esc_html__( 'Content settings', 'charitus' ),
							),
						),
					));
				}
				

	      	}
	   	}

	   new XT_VC_Elements_Class();
	}
}	