<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => esc_html__('Theme Options', 'charitus'),
  'menu_type'       => 'menu',
  'menu_slug'       => 'charitus-options',
  'ajax_save'       => false,
  'show_reset_all'  => false,
  'framework_title' => sprintf( '%s <small>%s</small>', esc_html__('Charitus ', 'charitus'), 'by XooThemes' ),
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();


// ------------------------------
// Pre Header Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'pre_header_settings',
  'title'       => esc_html__('Pre Header Settings', 'charitus'),
  'icon'        => 'cs-icon fa fa-arrows-h',

  // begin: fields
  'fields'      => array(
    array(
      'id'      => 'ch_need_pre_header',
      'type'    => 'switcher',
      'title'   => esc_html__('Need pre header?', 'charitus'),
      'desc'    => esc_html__('Enable or disable pre header bar. Default enable.', 'charitus'),
      'default' => true
    ),
    array(
      'id'      => 'ch_need_pre_header_mobile',
      'type'    => 'switcher',
      'title'   => esc_html__('Disable on mobile?', 'charitus'),
      'desc'    => esc_html__('Enable or disable pre header bar on mobile devices.', 'charitus'),
      'default' => true
    ),
    array(
      'id'       => 'ch_pre_header_left_content',
      'type'     => 'select',
      'title'    => esc_html__('Header left content', 'charitus'),
      'desc'     => esc_html__('Select a content type for header left.', 'charitus'),
      'options'  => array(
        'none'              => esc_html__('No Content', 'charitus'),
        'informations'      => esc_html__('Informations', 'charitus'),
        'menu'              => esc_html__('Menu', 'charitus'),
      ),
      'default'  => 'informations',
    ),
    array(
      'id'          => 'ch_pre_header_text',
      'type'        => 'text',
      'title'       => esc_html__('Header text', 'charitus'),
      'desc'        => esc_html__('Will be shown in the header top bar.', 'charitus'),
      'default'     => esc_html__('Have any question?', 'charitus'),
      'dependency'  => array( 'ch_pre_header_left_content', '==', 'informations' ),
    ),
    array(
      'id'          => 'ch_pre_header_phone',
      'type'        => 'text',
      'title'       => esc_html__('Phone number', 'charitus'),
      'desc'        => esc_html__('Will be shown in the header top bar.', 'charitus'),
      'default'     => esc_html__('0123456789', 'charitus'),
      'dependency'  => array( 'ch_pre_header_left_content', '==', 'informations' ),
    ),
    array(
      'id'          => 'ch_pre_header_email',
      'type'        => 'text',
      'title'       => esc_html__('Email address', 'charitus'),
      'desc'        => esc_html__('Will be shown in the header top bar.', 'charitus'),
      'default'     => esc_html__('admin@xoothemes.com', 'charitus'),
      'dependency'  => array( 'ch_pre_header_left_content', '==', 'informations' ),
    ),
    array(
      'id'          => 'ch_pre_header_left_menu',
      'type'        => 'select',
      'title'       => esc_html__('Header Left Menu', 'charitus'),
      'desc'        => esc_html__('Select a menu for header left.', 'charitus'),
      'options'     => 'menu',
      'dependency'  => array( 'ch_pre_header_left_content', '==', 'menu' ),
    ),
    array(
      'id'          => 'ch_pre_header_left_menu_campaign_creator',
      'type'        => 'select',
      'title'       => esc_html__('Header Left Menu for Campaign Creator', 'charitus'),
      'desc'        => esc_html__('Select a menu for header left. If campaign creator users login then this menu will be shown. User Role : campaign_creator', 'charitus'),
      'options'     => 'menu',
      'dependency'  => array( 'ch_pre_header_left_content', '==', 'menu' ),
    ),
    array(
      'id'       => 'ch_pre_header_right_content',
      'type'     => 'select',
      'title'    => esc_html__('Header right content', 'charitus'),
      'desc'     => esc_html__('Select a content type for header right.', 'charitus'),
      'options'  => array(
        'none'              => esc_html__('No Content', 'charitus'),
        'text'              => esc_html__('Plain Text', 'charitus'),
        'menu'              => esc_html__('Menu', 'charitus'),
        'social'            => esc_html__('Social Icons', 'charitus'),
        'conditional_pages'  => esc_html__('Selected Pages Link with condition', 'charitus'),
      ),
      'default'  => 'social',
    ),
    array(
      'id'          => 'ch_pre_header_right_text',
      'type'        => 'text',
      'title'       => esc_html__('Header Right Text', 'charitus'),
      'desc'        => esc_html__('Pre header right plain text.', 'charitus'),
      'dependency'  => array( 'ch_pre_header_right_content', '==', 'text' ),
    ),
    array(
      'id'          => 'ch_pre_header_right_menu',
      'type'        => 'select',
      'title'       => esc_html__('Header Right Menu', 'charitus'),
      'desc'        => esc_html__('Select a menu for header right.', 'charitus'),
      'options'     => 'menu',
      'dependency'  => array( 'ch_pre_header_right_content', '==', 'menu' ),
    ),
    array(
      'id'              => 'ch_pre_header_right_social_icons',
      'type'            => 'group',
      'title'           => esc_html__('Top Bar Right Social Icons', 'charitus'),
      'button_title'    => esc_html__('Add New', 'charitus'),
      'accordion_title' => esc_html__('Add New Social Network', 'charitus'),
      'dependency'      => array( 'ch_pre_header_right_content', '==', 'social' ),
      'fields'          => array(

        array(
          'id'      => 'icon',
          'type'    => 'icon',
          'title'   => esc_html__('Select an Icon', 'charitus'),
        ),

        array(
          'id'          => 'url',
          'type'        => 'text',
          'title'       => esc_html__('Social Network URL', 'charitus')
        ),

      ),
      'default' => array(

        array(
          'icon'  => 'fa fa-twitter',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-facebook',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-google-plus',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-linkedin',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-youtube-play',
          'url'   => '#',
        ),
        
      )
    ),
    array(
      'id'              => 'ch_pre_header_right_conditional_pages',
      'type'            => 'group',
      'title'           => esc_html__('Top Bar Right Conditional Pages', 'charitus'),
      'button_title'    => esc_html__('Add New', 'charitus'),
      'accordion_title' => esc_html__('Add New Page', 'charitus'),
      'dependency'      => array( 'ch_pre_header_right_content', '==', 'conditional_pages' ),
      'fields'          => array(

        array(
          'id'      => 'ch_select_conditional_page',
          'type'    => 'select',
          'title'   => esc_html__('Select a Page', 'charitus'),
          'options' => 'pages',
        ),
        array(
          'id'             => 'ch_select_condition',
          'type'           => 'select',
          'title'          => esc_html__('Show If', 'charitus'),
          'options'        => array(
            'always'         => esc_html__('Show always', 'charitus'),
            'login'          => esc_html__('If logged in', 'charitus'),
            'not_login'      => esc_html__('If not logged in', 'charitus'),
          ),
        ),

      ),
    ),
  )
);

// ------------------------------
// Header Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'header_settings',
  'title'       => esc_html__('Header Settings', 'charitus'),
  'icon'        => 'cs-icon fa fa-arrow-circle-up',

  // begin: fields
  'fields'      => array(
    array(
      'id'      => 'xt_header_bg',
      'type'    => 'color_picker',
      'title'   => esc_html__('Header background color', 'charitus'),
      'desc'    => esc_html__('Default #ffffff.', 'charitus'),
      'default' => '#ffffff',
      'rgba'    => true,
    ),
    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => sprintf( '<h3>%s</h3>', esc_html__('Default menu settings', 'charitus') ),
    ),
    array(
      'id'      => 'xt_default_menu_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Menu color', 'charitus'),
      'desc'    => esc_html__('Default #363636.', 'charitus'),
      'default' => '#363636',
      'rgba'    => true,
    ),
    array(
      'id'      => 'xt_default_menu_hover_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Menu hover color', 'charitus'),
      'desc'    => esc_html__('Default #3cb878.', 'charitus'),
      'default' => '#3cb878',
      'rgba'    => true,
    ),
    array(
      'id'      => 'xt_menu_hover_border',
      'type'    => 'switcher',
      'title'   => esc_html__('Menu hober border', 'charitus'),
      'default' => true,
      'desc'    => esc_html__('On menu hover show a border bellow the menu item. Default yes.', 'charitus'),
    ),
    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => sprintf( '<h3>%s</h3>', esc_html__('Dropdown or megamenu settings', 'charitus') ),
    ),
    array(
      'id'      => 'xt_dropdown_menu_bg',
      'type'    => 'color_picker',
      'title'   => esc_html__('Dropdown Background Color', 'charitus'),
      'desc'    => esc_html__('Dropdown or megamenu background color. Default #ffffff.', 'charitus'),
      'default' => '#ffffff',
      'rgba'    => true,
    ),
    array(
      'id'      => 'xt_dropdown_menu_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Dropdown Color', 'charitus'),
      'desc'    => esc_html__('Dropdown color. Default #363636.', 'charitus'),
      'default' => '#363636',
      'rgba'    => true,
    ),
    array(
      'id'      => 'xt_dropdown_menu_color_hover',
      'type'    => 'color_picker',
      'title'   => esc_html__('Dropdown Menu Hover Color', 'charitus'),
      'desc'    => esc_html__('Dropdown menu hover color. Default #3cb878.', 'charitus'),
      'default' => '#3cb878',
      'rgba'    => true,
    ),
     array(
      'id'      => 'xt_dropdown_menu_border_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Dropdown Border Color', 'charitus'),
      'desc'    => esc_html__('Dropdown menu border color. Default #eeeeee.', 'charitus'),
      'default' => '#eeeeee',
      'rgba'    => true,
    ),
    array(
      'id'        => 'xt_dropdown_menu_width',
      'type'      => 'slider',
      'default'   => 250,
      'title'     => esc_html__( 'Dropdown menu minimum width.', 'charitus' ),
      'desc'      => esc_html__('Default 250px.', 'charitus'),
      'options'   => array(
        'step'    => 1,
        'min'     => 0,
        'max'     => 500,
      )
    ),
  )
);


// ------------------------------
// Page Header Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'page_header_settings',
  'title'       => esc_html__('Page Header Settings', 'charitus'),
  'icon'        => 'cs-icon fa fa-window-minimize',

  // begin: fields
  'fields'      => array(
    array(
      'id'        => 'xt_page_header_bg',
      'type'      => 'image',
      'title'     => esc_html__('Page Header Background', 'charitus'),
      'desc'      => esc_html__('Page header background image.', 'charitus'),
      'add_title' => esc_html__('Add Image', 'charitus'),
    ),
    array(
      'id'      => 'xt_page_feature_img_header_bg',
      'type'    => 'switcher',
      'title'   => esc_html__('Use Page Feature Image', 'charitus'),
      'default' => true,
      'desc'    => esc_html__('If page, use page feature image as page background image. Default yes.', 'charitus'),
    ),
    array(
      'id'      => 'xt_page_header_bg_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Page header background color overlay', 'charitus'),
      'default' => 'rgba(0, 0, 0, 0.6)',
      'rgba'    => true,
    ),
    array(
      'id'        => 'xt_page_header_p_top',
      'type'      => 'slider',
      'default'   => 75,
      'title'     => esc_html__( 'Padding Top', 'charitus' ),
      'desc'      => esc_html__('Page header padding top. Default 75px.', 'charitus'),
      'options'   => array(
        'step'    => 1,
        'min'     => 5,
        'max'     => 200,
      )
    ),
    array(
      'id'        => 'xt_page_header_p_bottom',
      'type'      => 'slider',
      'default'   => 75,
      'title'     => esc_html__( 'Padding Bottom', 'charitus' ),
      'desc'      => esc_html__('Page header padding bottom. Default 75px.', 'charitus'),
      'options'   => array(
        'step'    => 1,
        'min'     => 5,
        'max'     => 200,
      )
    ),
    array(
      'id'      => 'xt_show_breadcrumb',
      'type'    => 'switcher',
      'title'   => esc_html__('Show Breadcrumb', 'charitus'),
      'desc'    => esc_html__('Show breadcrumb in page header. Default enable.', 'charitus'),
      'default' => true,
    ),
  )
);    

// ------------------------------
// Style Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'style_settings',
  'title'       => esc_html__('Style Settings', 'charitus'),
  'icon'        => 'fa fa-cogs',

  // begin: fields
  'fields'      => array(
    array(
      'id'        => 'body_font_size',
      'type'      => 'slider',
      'default'   => 16,
      'title'     => esc_html__( 'Font size', 'charitus' ),
      'desc'      => esc_html__('Body font size. Default 16px.', 'charitus'),
      'options'   => array(
        'step'    => 1,
        'min'     => 5,
        'max'     => 100,
      )
    ),
    array(
      'id'        => 'body_line_height',
      'type'      => 'slider',
      'default'   => 26,
      'title'     => esc_html__( 'Line Height', 'charitus' ),
      'desc'      => esc_html__('Body line height. Default 26px.', 'charitus'),
      'options'   => array(
        'step'    => 1,
        'min'     => 5,
        'max'     => 100,
      )
    ),
    array(
      'id'      => 'xt_body_bg',
      'type'    => 'color_picker',
      'title'   => esc_html__('Body Background', 'charitus'),
      'desc'    => esc_html__('Site body background color.', 'charitus'),
      'default' => '#ffffff',
    ),
    array(
      'id'      => 'xt_body_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Body color', 'charitus'),
      'desc'    => esc_html__('Site body color.', 'charitus'),
      'default' => '#363636',
    ),
    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => sprintf( '<h3>%s</h3>', esc_html__('Color Customization', 'charitus') ),
    ),
    array(
      'id'      => 'need_color_customizer',
      'type'    => 'switcher',
      'title'   => esc_html__('Need color customizer?', 'charitus'),
      'default' => false
    ),
    array(
      'id'         => 'xt_primary_color',
      'type'       => 'color_picker',
      'title'      => esc_html__('Theme Primary Color', 'charitus'),
      'default'    => '#3cb878',
      'dependency' => array( 'need_color_customizer', '==', 'true' )
    ),
    array(
      'id'         => 'xt_primary_color_dark',
      'type'       => 'color_picker',
      'title'      => esc_html__('Theme Primary Color Dark', 'charitus'),
      'default'    => '#36a56b',
      'dependency' => array( 'need_color_customizer', '==', 'true' )
    ),
    array(
      'id'         => 'xt_primary_color_light',
      'type'       => 'color_picker',
      'title'      => esc_html__('Theme Primary Color Light', 'charitus'),
      'default'    => 'rgba(60, 184, 120, 0.8)',
      'dependency' => array( 'need_color_customizer', '==', 'true' )
    ),
  ),
);


// ------------------------------
// Blog Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'blog_settings',
  'title'       => esc_html__('Blog Settings', 'charitus'),
  'icon'        => 'fa fa-rss',

  // begin: fields
  'fields'      => array(
    array(
      'id'          => 'feature_image_width',
      'type'        => 'number',
      'title'       => esc_html__('Blog Feature Image Width', 'charitus'),
      'desc'        => esc_html__('If you changed the image size, you have to regenerate thumbnails. You can use any regenerate thumbnails plugin for that.', 'charitus'),
      'default'     => 870,
      'after'       => ' <i class="cs-text-muted">(px)</i>',
    ),
    array(
      'id'      => 'feature_image_height',
      'type'    => 'number',
      'title'   => esc_html__('Blog Feature Image Height', 'charitus'),
      'default' => 580,
      'after'   => ' <i class="cs-text-muted">(px)</i>',
    ),
    array(
      'id'        => 'blog_layout',
      'type'      => 'image_select',
      'title'     => esc_html__('Blog Layout', 'charitus'),
      'desc'      => esc_html__('Choose a layout for your blog, It will also work on single, archive, search pages.', 'charitus'),
      'options'   => array(
        'full_width'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
        'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
        'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
      ),
      'radio'     => true,
      'default'   => 'right'
    ),
    array(
      'id'      => 'blog_author_bio',
      'type'    => 'switcher',
      'title'   => esc_html__('Author Bio', 'charitus'),
      'default' => true,
      'desc'    => esc_html__('Show author bio on single blog post. Default yes.', 'charitus'),
    ),
    array(
      'id'      => 'blog_post_nav',
      'type'    => 'switcher',
      'title'   => esc_html__('Post Nav', 'charitus'),
      'default' => true,
      'desc'    => esc_html__('Show next / prev nav on single blog post. Default yes.', 'charitus'),
    ),
  ),
);

// ------------------------------
// Charitable Settings
// ------------------------------


if ( class_exists( 'Charitable' ) ):

  $options[]   = array(
    'name'     => 'charitus_campaign_settigs',
    'title'    => esc_html__('Donation Settings', 'charitus'),
    'icon'     => 'fa fa-heart',
    'fields'   => array(

      array(
        'id'        => 'campaign_layout',
        'type'      => 'image_select',
        'title'     => esc_html__('Campaign Page Layout', 'charitus'),
        'desc'      => esc_html__('Choose a layout for your shop page, It will also work on few others Campaign pages.', 'charitus'),
        'options'   => array(
          'full_width'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
          'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
          'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
        ),
        'radio'     => true,
        'default'   => 'right'
      ),
      array(
        'id'          => 'campaign_page_title',
        'type'        => 'text',
        'title'       => esc_html__('Campaigns Page Text', 'charitus'),
        'default'     => esc_html__('Campaigns', 'charitus'),
      ),
      array(
        'id'          => 'donate_button_text',
        'type'        => 'text',
        'title'       => esc_html__('Donate Buttom Text', 'charitus'),
        'default'     => esc_html__('Donate', 'charitus'),
      ),
      array(
        'id'          => 'donate_button_text_expired',
        'type'        => 'text',
        'title'       => esc_html__('Donate Buttom Text Expired', 'charitus'),
        'default'     => esc_html__('Details', 'charitus'),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info',
        'content' => sprintf( '<h3>%s</h3>', esc_html__('Single Campaign Page Setting', 'charitus') ),
      ),
      array(
        'id'      => 'show_campaign_creation_date',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Creation Date', 'charitus'),
        'desc'    => esc_html__('You can show or hide the campaign creation date on single campaign page bellow the title inside the donation stats.', 'charitus'),
        'default' => true,
      ),
      array(
        'id'      => 'show_campaign_donation_count',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Donation Count', 'charitus'),
        'desc'    => esc_html__('You can show or hide the campaign donation count on single campaign page bellow the title inside the donation stats.', 'charitus'),
        'default' => true,
      ),
      array(
        'id'      => 'show_campaign_location',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Location', 'charitus'),
        'desc'    => esc_html__('You can show or hide the campaign location on single campaign page bellow the title inside the donation stats.', 'charitus'),
        'default' => true
      ),
      array(
        'id'      => 'show_campaign_donation_progress_bar',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Progress Bar', 'charitus'),
        'desc'    => esc_html__('You can show or hide the campaign donation progress bar on single campaign page bellow the title.', 'charitus'),
        'default' => true
      ),
      array(
        'id'      => 'show_campaign_tags_social_share',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Tags and Social Shareing', 'charitus'),
        'desc'    => esc_html__('You can show or hide the campaign tags and social sharing icons on single campaign page bellow the main content area.', 'charitus'),
        'default' => true
      ),
      array(
        'id'      => 'show_campaign_updates',
        'type'    => 'switcher',
        'title'   => esc_html__('Show Campaign Updates', 'charitus'),
        'desc'    => esc_html__('Campaign updates has a shortcode, you can use that to show the updates aywhere in the content area of campaign. If you enable this updates will be show bellow the content. [ Required charitable simple updates addon ]', 'charitus'),
        'default' => true
      ),
      array(
        'id'          => 'campaign_updates_title',
        'type'        => 'text',
        'title'       => esc_html__('Campaign Updates Title', 'charitus'),
        'default'     => esc_html__('Campaign Updates:', 'charitus'),
        'dependency'  => array( 'show_campaign_updates', '==', 'true' )
      ),
      array(
        'id'          => 'campaign_video_width',
        'type'        => 'number',
        'title'       => esc_html__('Campaign Video Width', 'charitus'),
        'desc'        => esc_html__('Required charitable campaign video addon.', 'charitus'),
        'default'     => 710,
      ),
    )
  );

endif;


// ------------------------------
// Events Settings
// ------------------------------


if ( class_exists( 'Tribe__Events__Main' ) ):

  $options[]   = array(
    'name'     => 'charitus_events_settigs',
    'title'    => esc_html__('Events Settings', 'charitus'),
    'icon'     => 'fa fa-calendar',
    'fields'   => array(

      array(
        'id'        => 'events_layout',
        'type'      => 'image_select',
        'title'     => esc_html__('Events Page Layout', 'charitus'),
        'desc'      => esc_html__('Choose a layout for your events page, It will also work on few others event pages.', 'charitus'),
        'options'   => array(
          'full_width'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
          'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
          'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
        ),
        'radio'     => true,
        'default'   => 'right'
      ),
    )
  );

endif;

// ------------------------------
// WooCommerce Settings
// ------------------------------


if ( class_exists( 'woocommerce' ) ):

  $options[]   = array(
    'name'     => 'ch_woocommerce_settigs',
    'title'    => esc_html__('WooCommerce Settings', 'charitus'),
    'icon'     => 'fa fa-shopping-cart',
    'fields'   => array(

      array(
        'id'        => 'ch_shop_layout',
        'type'      => 'image_select',
        'title'     => esc_html__('Shop Page Layout', 'charitus'),
        'desc'      => esc_html__('Choose a layout for your shop page, It will also work on few others WooCommerce pages.', 'charitus'),
        'options'   => array(
          'full_width'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
          'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
          'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
        ),
        'radio'     => true,
        'default'   => 'right'
      ),
      array(
        'id'        => 'ch_product_layout',
        'type'      => 'image_select',
        'title'     => esc_html__('Product Page Layout', 'charitus'),
        'desc'      => esc_html__('Choose a layout for your product page.', 'charitus'),
        'options'   => array(
          'full_width'  => esc_url( get_template_directory_uri().'/assets/images/admin/full-width.png' ),
          'left'        => esc_url( get_template_directory_uri().'/assets/images/admin/left.png' ),
          'right'       => esc_url( get_template_directory_uri().'/assets/images/admin/right.png' ),
        ),
        'radio'     => true,
        'default'   => 'right'
      ),
      array(
        'id'          => 'ch_shop_number_of_products',
        'type'        => 'number',
        'title'       => esc_html__('Shop number of products', 'charitus'),
        'desc'        => esc_html__('Number of products to show on the shop page, default 9 products.', 'charitus'),
        'default'     => 9,
        'after'       => ' Products',
      ),
      array(
        'id'       => 'ch_shop_loop_column',
        'type'     => 'select',
        'title'    => esc_html__('Product column', 'charitus'),
        'desc'     => esc_html__('Change number of products per row', 'charitus'),
        'options'  => array(
          '1'  => esc_html__('1 column', 'charitus'),
          '2'  => esc_html__('2 columns', 'charitus'),
          '3'  => esc_html__('3 columns', 'charitus'),
          '4'  => esc_html__('4 columns', 'charitus'),
          '5'  => esc_html__('5 columns', 'charitus'),
        ),
        'default'  => '3',
      ),
      array(
        'id'       => 'ch_related_per_page',
        'type'     => 'select',
        'title'    => esc_html__('Number of Related Products', 'charitus'),
        'desc'     => esc_html__('Change number of products related products to show', 'charitus'),
        'options'  => array(
          '1'  => esc_html__('1 Product', 'charitus'),
          '2'  => esc_html__('2 Products', 'charitus'),
          '3'  => esc_html__('3 Products', 'charitus'),
          '4'  => esc_html__('4 Products', 'charitus'),
          '5'  => esc_html__('5 Products', 'charitus'),
          '6'  => esc_html__('6 Products', 'charitus'),
          '7'  => esc_html__('7 Products', 'charitus'),
        ),
        'default'  => '3',
      ),
      array(
        'id'      => 'ch_need_woo_zoom',
        'type'    => 'switcher',
        'title'   => esc_html__('Need Image Zoom?', 'charitus'),
        'desc'    => esc_html__('Enable or disable image zooming. Default enable.', 'charitus'),
        'default' => true
      ),
      array(
        'id'      => 'ch_need_woo_lightbox',
        'type'    => 'switcher',
        'title'   => esc_html__('Need Image Lightbox?', 'charitus'),
        'desc'    => esc_html__('Enable or disable image lightbox. Default enable.', 'charitus'),
        'default' => true
      ),
      array(
        'id'      => 'ch_need_woo_lightbox_slider',
        'type'    => 'switcher',
        'title'   => esc_html__('Need Image Gallery LightBox Slider?', 'charitus'),
        'desc'    => esc_html__('Enable or disable image gallery lightbox slider. Default enable.', 'charitus'),
        'default' => true
      ),
    )
  );

endif;

// ------------------------------
// Footer Setting                  -
// ------------------------------

$options[]      = array(
  'name'        => 'footer_settings',
  'title'       => esc_html__('Footer Settings', 'charitus'),
  'icon'        => 'fa fa-chevron-circle-down',

  // begin: fields
  'fields'      => array(
    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => sprintf( '<h3>%s</h3>', esc_html__('Footer', 'charitus') ),
    ),
    array(
      'id'        => 'footer_top_space',
      'type'      => 'slider',
      'default'   => 70,
      'title'     => esc_html__( 'Footer top paddings', 'charitus' ),
      'options'   => array(
        'step'    => 1,
        'min'     => 0,
        'max'     => 300,
      )
    ),
    array(
      'id'        => 'footer_bottom_space',
      'type'      => 'slider',
      'default'   => 30,
      'title'     => esc_html__( 'Footer bottom paddings', 'charitus' ),
      'options'   => array(
        'step'    => 1,
        'min'     => 0,
        'max'     => 300,
      )
    ),
    array(
      'id'             => 'footer_widget_column',
      'type'           => 'select',
      'title'          => esc_html__('Footer Widgets Columns', 'charitus'),
      'options'        => array(
        '6'    => '2 Columns',
        '4'    => '3 Columns',
        '3'    => '4 Columns',
      ),
      'default'        => '3',
      'default_option' => esc_html__('Select an option', 'charitus'),
    ),
    array(
      'id'      => 'footer_background_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Footer Background Color', 'charitus'),
      'default' => '#2a2f36',
    ),
    array(
      'id'      => 'footer_content_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Footer widget Content Color', 'charitus'),
      'default' => '#ffffff',
    ),
    array(
      'id'      => 'footer_link_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Footer widget Link Color', 'charitus'),
      'default' => '#ffffff',
    ),
    array(
      'id'      => 'footer_link_hover_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Footer Link Hover Color', 'charitus'),
      'default' => '#3cb878',
    ),
    array(
      'type'    => 'notice',
      'class'   => 'info',
      'content' => sprintf( '<h3>%s</h3>', esc_html__('Bottom Bar', 'charitus') ),
    ),
    array(
      'id'      => 'need_footer_bottom_bar',
      'type'    => 'switcher',
      'title'   => esc_html__('Need Footer Bottom', 'charitus'),
      'default' => true
    ),
    array(
      'id'        => 'bottom_bar_top_bottom_space',
      'type'      => 'slider',
      'default'   => 15,
      'title'     => esc_html__( 'Footer top & bottom paddings', 'charitus' ),
      'options'   => array(
        'step'    => 1,
        'min'     => 0,
        'max'     => 100,
      )
    ),
    array(
      'id'         => 'footer_text',
      'type'       => 'textarea',
      'title'      => esc_html__('Footer Text', 'charitus'),
      'default'    => esc_html__('&copy; Copyright XooThemes 2017', 'charitus'),
      'sanitize'   => false,
      'attributes' => array(
          'style'    => 'min-height: 17px; line-height: 12px; padding: 10px 6px 0 6px;'
        ),
    ),
    array(
      'id'      => 'bottom_bar_border_color',
      'type'    => 'color_picker',
      'title'   => esc_html__('Foter Border Color', 'charitus'),
      'default' => '#4a4f55',
    ),
    array(
      'id'              => 'footer_bottom_bar_social_icons',
      'type'            => 'group',
      'title'           => esc_html__('Footer Social Icons', 'charitus'),
      'button_title'    => esc_html__('Add New', 'charitus'),
      'accordion_title' => esc_html__('Add New Social Network', 'charitus'),
      'dependency'      => array( 'need_footer_bottom_bar', '==', true ),
      'fields'          => array(

        array(
          'id'      => 'icon',
          'type'    => 'icon',
          'title'   => esc_html__('Select an Icon', 'charitus'),
        ),

        array(
          'id'          => 'url',
          'type'        => 'text',
          'title'       => esc_html__('Social Network URL', 'charitus')
        ),

      ),
      'default' => array(

        array(
          'icon'  => 'fa fa-twitter',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-facebook',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-google-plus',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-linkedin',
          'url'   => '#',
        ),
        array(
          'icon'  => 'fa fa-youtube-play',
          'url'   => '#',
        ),
        
      )
    ),
  ),
);


CSFramework::instance( $settings, $options );
