<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options              = array();

/**
 * Header
 */

$options[]            = array(
  'name'              => 'ch_header_options',
  'title'             => esc_html__('Header', 'charitus'),
  'sections'          => array(
    array(
      'name'          => 'pre_header_section',
      'title'         => esc_html__('Pre Header Bar Settings', 'charitus'),
      'settings'      => array(  
        array(
          'name'          => 'pre_header_top_space',
          'default'       => 12,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 12 px.', 'charitus'),
              'title'     => esc_html__('Pre header bar top space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'pre_header_bottom_space',
          'default'       => 12,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 12 px.', 'charitus'),
              'title'     => esc_html__('Pre header bar bottom space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
      )
    ),
    array(
      'name'          => 'header_section',
      'title'         => esc_html__('Header Settings', 'charitus'),
      'settings'      => array(  
        array(
          'name'          => 'header_top_space',
          'default'       => 15,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 15 px.', 'charitus'),
              'title'     => esc_html__('Header top space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'header_bottom_space',
          'default'       => 15,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 15 px.', 'charitus'),
              'title'     => esc_html__('Header bottom space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
      )
    ),
    array(
      'name'          => 'logo_section',
      'title'         => esc_html__('Logo Settings', 'charitus'),
      'settings'      => array(  
        array(
          'name'          => 'logo_top_space',
          'default'       => 0,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 0 px.', 'charitus'),
              'title'     => esc_html__('Logo top space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'logo_bottom_space',
          'default'       => 0,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 0 px.', 'charitus'),
              'title'     => esc_html__('Logo bottom space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
      )
    ),
    array(
      'name'          => 'menu_section',
      'title'         => esc_html__('Menu Settings', 'charitus'),
      'settings'      => array(
        array(
          'name'          => 'menu_top_space',
          'default'       => 3,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 3 px.', 'charitus'),
              'title'     => esc_html__('Menu item top space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'menu_bottom_space',
          'default'       => 4,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 4 px.', 'charitus'),
              'title'     => esc_html__('Menu item bottom space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'menu_left_space',
          'default'       => 22,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 22 px.', 'charitus'),
              'title'     => esc_html__('Menu item left space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
        array(
          'name'          => 'menu_right_space',
          'default'       => 22,
          'control'       => array(
            'type'        => 'cs_field',
            'options'     => array(
              'type'      => 'slider',
              'desc'      => esc_html__('Default 42 px.', 'charitus'),
              'title'     => esc_html__('Menu item right space', 'charitus'),
              'step'    => 1,
              'min'     => 1,
              'max'     => 100,
            ),
          ),
        ),
      )
    ),

  ),    
);

CSFramework_Customize::instance( $options );
