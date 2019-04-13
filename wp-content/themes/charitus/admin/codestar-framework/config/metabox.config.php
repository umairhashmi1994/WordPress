<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();


// -----------------------------------------
// Page Side Metabox Options               -
// -----------------------------------------

$options[]    = array(
  'id'        => '_xt_page_side_options',
  'title'     => esc_html__('Page Settings', 'charitus'),
  'post_type' => 'page',
  'context'   => 'side',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => '_ep_page_side_options_fields',
      'fields' => array(

        array(
          'id'        => 'page_layout',
          'type'      => 'image_select',
          'title'     => esc_html__('Page Layout', 'charitus' ),
          'help'      => esc_html__('Default box layout, You can also select full screen layout.', 'charitus'),
          'options'   => array(
            'full_screen' => esc_url( get_template_directory_uri().'/assets/images/admin/full-width-page.png' ),
            'grid'        => esc_url( get_template_directory_uri().'/assets/images/admin/box-layout-page.png' ),
          ),
          'default'    => 'grid',
        ),
        array(
          'id'      => 'need_page_title',
          'type'    => 'switcher',
          'title'   => esc_html__('Need Page Title ?', 'charitus'),
          'help'    => esc_html__('Page title settings avaiable on theme option.', 'charitus'),
          'default' => true,
        ),
        array(
          'id'          => 'need_pre_header',
          'title'       => esc_html__('Need Pre Header', 'charitus' ),
          'type'        => 'switcher',
          'help'        => esc_html__('Pre header (Header top bar) can be enable or disable for this page.', 'charitus'),
          'default'     => true,
        ),
        array(
          'id'          => 'page_sidebar_enable',
          'title'       => esc_html__('Need Sidebar?', 'charitus' ),
          'type'        => 'switcher',
          'help'        => esc_html__('Set off, if you don\'t need sidebar on this page.', 'charitus'),
          'default'     => false,
        ),
        array(
          'id'          => 'page_sidebar_position',
          'type'        => 'image_select',
          'title'       => esc_html__('Page Sidebar Position', 'charitus' ),
          'desc'        => esc_html__('Options: Left, Right or No Sidebar.', 'charitus' ),
          'options'     => array(
            'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
            'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
            'no_sidebar'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
          ),
          'default'     => 'no_sidebar',
          'dependency'  => array( 'page_sidebar_enable', '!=', '' ),
        ),
        array(
          'id'          => 'page_choose_sidebar',
          'type'        => 'select',
          'title'       => esc_html__('Select a sidebar for this plage.', 'charitus' ),
          'help'        => esc_html__('Go to theme option for generating new sidebars.', 'charitus' ),
          'options'     => charitus_sidebars_list_on_option(),
          'default'     => 'sidebar-1',
          'dependency'  => array( 'page_sidebar_position_no_sidebar', '!=', 'true' ),
        ),
      ),
    ),

  ),
);


// -----------------------------------------
// Sider Metabox Options               -
// -----------------------------------------

$options[]    = array(
  'id'        => '_xt_sider_options',
  'title'     => esc_html__('Slider Options', 'charitus'),
  'post_type' => 'charitus_slider',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'xt_slider_options_fields',
      'fields' => array(

        array(
          'id'      => 'slider_btn_text', 
          'type'    => 'text',
          'title'   => esc_html__('Slider Button Text', 'charitus'),
          'desc'    => esc_html__('Add your slider button text', 'charitus'),
          'default' => esc_html__('START NOW', 'charitus'),
        ),
        array(
          'id'      => 'slider_btn_url', 
          'type'    => 'text',
          'title'   => esc_html__('Slider Button URL', 'charitus'),
          'desc'    => esc_html__('Add your slider button url', 'charitus'),
          'default' => 'https://xoothemes.com/'
        ),
      ),
    ),

  ),
);



// -----------------------------------------
// Testimonial Metabox Options               -
// -----------------------------------------

$options[]    = array(
  'id'        => '_xt_testimonial_options',
  'title'     => esc_html__('Testimonial Options', 'charitus'),
  'post_type' => 'charitus_testimonial',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'xt_testimonial_options_fields',
      'fields' => array(

        array(
          'id'      => 'testimonial_designation', 
          'type'    => 'text',
          'title'   => esc_html__('Client\'s Designation', 'charitus'),
          'desc'    => esc_html__('Add your client\'s designation', 'charitus'),
        ),

      ),
    ),

  ),
);



// -----------------------------------------
// VOLANTEERS Metabox Options               -
// -----------------------------------------

$options[]    = array(
  'id'        => '_xt_volanteer_options',
  'title'     => esc_html__('Volanteer\'s Options', 'charitus'),
  'post_type' => 'charitus_volanteers',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    array(
      'name'   => 'xt_volanteer_options_fields',
      'fields' => array(
        array(
          'id'              => 'volanteer_all_social_icons',
          'type'            => 'group',
          'title'           => esc_html__('Volanteer\'s Social Icons', 'charitus'),
          'button_title'    => esc_html__('Add New Social Icon', 'charitus'),
          'accordion_title' => esc_html__('Add New Social Network', 'charitus'),
          'fields'          => array(
            array(
              'id'      => 'volanteer_social_icons',
              'type'    => 'icon',
              'title'   => esc_html__('Select an Icon', 'charitus'),
            ),
            array(
              'id'          => 'volanteer_social_icons_url',
              'type'        => 'text',
              'title'       => esc_html__('Social Network URL', 'charitus')
            ),
          ),
          'default' => array(
            array(
              'volanteer_social_icons'       => 'fa fa-twitter',
              'volanteer_social_icons_url'   => '#',
            ),
            array(
              'volanteer_social_icons'       => 'fa fa-facebook',
              'volanteer_social_icons_url'   => '#',
            ),
            array(
              'volanteer_social_icons'       => 'fa fa-linkedin',
              'volanteer_social_icons_url'   => '#',
            ),           
          )
        ),
      ),
    ),
  ),
);



CSFramework_Metabox::instance( $options );
