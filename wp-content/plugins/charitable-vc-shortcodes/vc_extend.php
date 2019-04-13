<?php
/*
Plugin Name: Charitable Visual Composer ShortCodes
Plugin URI: http://xoothemes.com/
Description: Extend Visual Composer for Charitable donation plugins shortcodes.
Version: 1.0
Author: XooThemes
Author URI: http://xoothemes.com/
License: GPLv2 or later
Textdomain: charitable-visual-composer-shortcodes
*/


// don't load directly
if (!defined('ABSPATH')) die('-1');

if( !class_exists('XT_Charitable_VC_Addon_Class') ){
  class XT_Charitable_VC_Addon_Class {

      function __construct() {
        add_action( 'init', array( $this, 'integrateWithVC' ) );
      }
   
      public function integrateWithVC() {

          if ( ! defined( 'WPB_VC_VERSION' ) ) {
              add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
              return;
          }

          if ( ! class_exists( 'Charitable' ) ) {
              add_action('admin_notices', array( $this, 'show_Charitable_install_Notice' ));
              return;
          }
   
          /**
           * Donation Campaign
           */
          
          vc_map( array(          
            'name'            => esc_html__( 'Donation Campaign', 'charitable-visual-composer-shortcodes' ),
            'base'            => 'campaigns',
            'icon'            => plugins_url('assets/charitable-icon.jpg', __FILE__),
            'category'        => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
            'wrapper_class'   => 'clearfix',
            'description'     => esc_html__( 'Charitable plugin donation Campaign.', 'charitable-visual-composer-shortcodes' ),
            'params'          => array(
              array(
                'type'         => 'checkbox',
                'heading'      => esc_html__( 'Include cause that have expired', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'include_inactive',
                'description'  => esc_html__( 'Default no, Check this to enable.', 'charitable-visual-composer-shortcodes' ),
                'value'        => array( esc_html__( 'Yes', 'charitable-visual-composer-shortcodes' ) => 'true' ),
              ),
              array(
                'type'         => 'numberfield',
                'heading'      => esc_html__( 'Number of campaigns', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'number',
                'value'        => '-1',
                'description'  => esc_html__( 'Number of campaigns to show. Default -1, it will show all', 'charitable-visual-composer-shortcodes' ),
                'admin_label'  => true,
              ),
              array(
                'type'      => 'numberfield',
                'heading'     => esc_html__( 'Columns', 'charitable-visual-composer-shortcodes' ),
                'param_name'  => 'columns',
                'description'   => esc_html__( 'Choose how many columns you want to display the campaigns in. Supports any number between 1 and 4', 'charitable-visual-composer-shortcodes' ),
                'admin_label'   => true,
                'std'       => 3,
              ),
              array(
                'type'      => 'dropdown',
                'heading'     => esc_html__( 'Order by', 'charitable-visual-composer-shortcodes' ),
                'param_name'  => 'orderby',
                'value'     => array(
                  esc_html__( 'Menu Order', 'charitable-visual-composer-shortcodes' )    => 'menu_order',
                  esc_html__( 'Title', 'charitable-visual-composer-shortcodes' )       => 'title',
                  esc_html__( 'ID', 'charitable-visual-composer-shortcodes' )        => 'ID',
                  esc_html__( 'Last modified', 'charitable-visual-composer-shortcodes' )   => 'modified',
                  esc_html__( 'Random', 'charitable-visual-composer-shortcodes' )      => 'rand',
                  esc_html__( 'Post Date', 'charitable-visual-composer-shortcodes' )     => 'post_date',
                  esc_html__( 'Popular', 'charitable-visual-composer-shortcodes' )     => 'popular',
                  esc_html__( 'Ending', 'charitable-visual-composer-shortcodes' )      => 'ending',
                ),
                'std'       => 'post_date',
                'description'   => esc_html__( 'The order in which campaigns are displayed. Options include post_date, popular and ending', 'charitable-visual-composer-shortcodes' ),
                'admin_label'   => true,
              ),
              array(
                'type'      => 'dropdown',
                'heading'     => esc_html__( 'Order', 'charitable-visual-composer-shortcodes' ),
                'param_name'  => 'order',
                'value'     => array(
                  esc_html__( 'Ascending', 'charitable-visual-composer-shortcodes' )   => 'ASC',
                  esc_html__( 'Descending', 'charitable-visual-composer-shortcodes' )  => 'DESC',
                ),
                'description' => esc_html__( 'Change the direction in which campaigns are ordered. Accepts DESC or ASC. Defaults to DESC.', 'charitable-visual-composer-shortcodes' ),
                'admin_label'   => true,
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Cause Creator', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'creator',
                'description'  => esc_html__( 'Only show causes created by a certain user. Comma separated user IDs.', 'charitable-visual-composer-shortcodes' ),
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Categories', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'category',
                'description'  => esc_html__( 'Only show campaigns within certain categories.', 'charitable-visual-composer-shortcodes' ),
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Campaigns ids', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'id',
                'description'  => esc_html__( 'Show specific campaigns. You can provide a single number or multiple IDs as a comma separated list.', 'charitable-visual-composer-shortcodes' ),
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Campaigns ids to exclude', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'exclude',
                'description'  => esc_html__( 'Exclude specific campaigns by their ID. Pass multiple IDs as a comma separated list to exclude more than one.', 'charitable-visual-composer-shortcodes' ),
              ),
              array(
                'type'         => 'checkbox',
                'heading'      => esc_html__( 'Responsive', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'responsive',
                'description'  => esc_html__( 'Scale campaigns to a single-column layout on smaller screens. Default enable. Check to disable.', 'charitable-visual-composer-shortcodes' ),
                'value'        => array( esc_html__( 'Off', 'charitable-visual-composer-shortcodes' ) => 'flase' ),
              ),
              array(
                'type'         => 'checkbox',
                'heading'      => esc_html__( 'Map', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'map',
                'description'  => esc_html__( 'Display campaigns on a map. Defaults to Off. [ Campaigns Geolocation required. ]', 'charitable-visual-composer-shortcodes' ),
                'value'        => array( esc_html__( 'On', 'charitable-visual-composer-shortcodes' ) => 'true' ),
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Map Width', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'width',
                'description'  => esc_html__( 'Set how wide you want your map to be. This must be passed as a valid CSS width (400px, 100%, etc). Defaults to 100%.', 'charitable-visual-composer-shortcodes' ),
                'dependency'   => array(
                  'element' => 'map',
                  'value'   => 'true',
                ),
                'std'        => '100%',
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Map Height', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'height',
                'description'  => esc_html__( 'Set how high you want your map to be. This must be passed as a valid CSS height. Defaults to 500px.', 'charitable-visual-composer-shortcodes' ),
                'dependency'   => array(
                  'element' => 'map',
                  'value'   => 'true',
                ),
                'std'        => '500px',
              ),
              array(
                'type'         => 'textfield',
                'heading'      => esc_html__( 'Map Zoom', 'charitable-visual-composer-shortcodes' ),
                'param_name'   => 'zoom',
                'description'  => esc_html__( 'Set the initial zoom level you would like your map to display at. Defaults to auto, with the zoom level based on the pins that have been added to the map.', 'charitable-visual-composer-shortcodes' ),
                'dependency'   => array(
                  'element' => 'map',
                  'value'   => 'true',
                ),
                'std'        => 'auto',
              ),
            ),
          ));


        /**
         * Charitable Login
         */

        vc_map( array(          
          'name'            => esc_html__( 'Charitable Login', 'charitable-visual-composer-shortcodes' ),
          'base'            => 'charitable_login',
          'icon'            => plugins_url('assets/charitable-icon.jpg', __FILE__),
          'category'        => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
          'wrapper_class'   => 'clearfix',
          'description'     => esc_html__( 'Charitable plugin login form.', 'charitable-visual-composer-shortcodes' ),
          'params'          => array(
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Logged in Message', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'logged_in_message',
              'description'  => esc_html__( 'You can optionally set the message that will be displayed to users when they are already logged in.', 'charitable-visual-composer-shortcodes' ),
              'value'        => esc_html__( 'You are already logged in!', 'charitable-visual-composer-shortcodes' ),
            ),
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Registration link text', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'registration_link_text',
              'description'  => esc_html__( 'You can also customize the text used for the link to the registration page.  Set 0 to disable.', 'charitable-visual-composer-shortcodes' ),
              'value'        => esc_html__( 'Register', 'charitable-visual-composer-shortcodes' ),
            ),
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Logging Redirect', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'redirect',
              'description'  => esc_html__( 'It is also possible to change the default page that people are redirected to after logging in.', 'charitable-visual-composer-shortcodes' ),
            ),
          ),
        ));

        /**
         * Charitable Registration
         */

        vc_map( array(          
          'name'            => esc_html__( 'Charitable Registration', 'charitable-visual-composer-shortcodes' ),
          'base'            => 'charitable_registration',
          'icon'            => plugins_url('assets/charitable-icon.jpg', __FILE__),
          'category'        => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
          'wrapper_class'   => 'clearfix',
          'description'     => esc_html__( 'Charitable plugin registration form.', 'charitable-visual-composer-shortcodes' ),
          'params'          => array(
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Logged in Message', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'logged_in_message',
              'description'  => esc_html__( 'You can optionally set the message that will be displayed to users when they are already logged in.', 'charitable-visual-composer-shortcodes' ),
              'value'        => esc_html__( 'You are already logged in!', 'charitable-visual-composer-shortcodes' ),
            ),
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Login Link Text', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'login_link_text',
              'description'  => esc_html__( 'You can also customize the text used for the link to the login page. Set 0 to disable.', 'charitable-visual-composer-shortcodes' ),
              'value'        => esc_html__( 'Signed up already? Login instead.', 'charitable-visual-composer-shortcodes' ),
            ),
            array(
              'type'         => 'textfield',
              'heading'      => esc_html__( 'Registration Redirect', 'charitable-visual-composer-shortcodes' ),
              'param_name'   => 'redirect',
              'description'  => esc_html__( 'By default, the user is redirected to the Profile page after registration or, if the Profile page has not been set up (see below), to the homepage. You can provide a default page for users to be redirected to.', 'charitable-visual-composer-shortcodes' ),
            ),
          ),
        ));

        /**
         * Charitable Profile
         */

        vc_map( array(          
          'name'                  => esc_html__( 'Profile', 'charitable-visual-composer-shortcodes' ),
          'base'                  => 'charitable_profile',
          'icon'                  => plugins_url('assets/charitable-icon.jpg', __FILE__),
          'category'              => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
          'wrapper_class'         => 'clearfix',
          'description'           => esc_html__( 'Charitable plugin profile form.', 'charitable-visual-composer-shortcodes' ),
          'params'                => array(
          ),
          'show_settings_on_create'   => false,
        ));


        /**
         * Donations Table
         */

        vc_map( array(          
          'name'                  => esc_html__( 'Donations Table', 'charitable-visual-composer-shortcodes' ),
          'base'                  => 'charitable_my_donations',
          'icon'                  => plugins_url('assets/charitable-icon.jpg', __FILE__),
          'category'              => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
          'wrapper_class'         => 'clearfix',
          'description'           => esc_html__( 'Charitable plugin donations table.', 'charitable-visual-composer-shortcodes' ),
          'params'                => array(
          ),
          'show_settings_on_create'   => false,
        ));

        /**
         * Charitable Ambassadors [ FrontEnd Campaign Submission ]
         */
        
        if ( is_plugin_active( 'charitable-ambassadors/charitable-ambassadors.php' ) ) {
          vc_map( array(          
            'name'                      => esc_html__( 'FrontEnd Campaign Submission', 'charitable-visual-composer-shortcodes' ),
            'base'                      => 'charitable_submit_campaign',
            'icon'                      => plugins_url('assets/charitable-icon.jpg', __FILE__),
            'category'                  => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
            'wrapper_class'             => 'clearfix',
            'description'               => esc_html__( 'Charitable Ambassadors [ FrontEnd Campaign Submission ].', 'charitable-visual-composer-shortcodes' ),
            'show_settings_on_create'   => false,
          ));
        }

        /**
         * Charitable Ambassadors [ My Campaigns ]
         */
        
        if ( is_plugin_active( 'charitable-ambassadors/charitable-ambassadors.php' ) ) {
          vc_map( array(          
            'name'                      => esc_html__( 'My Campaigns', 'charitable-visual-composer-shortcodes' ),
            'base'                      => 'charitable_my_campaigns',
            'icon'                      => plugins_url('assets/charitable-icon.jpg', __FILE__),
            'category'                  => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
            'wrapper_class'             => 'clearfix',
            'description'               => esc_html__( 'Charitable Ambassadors [ My Campaigns ].', 'charitable-visual-composer-shortcodes' ),
            'show_settings_on_create'   => false,
          ));
        }


        /**
         * Charitable Ambassadors [ My Donations Received Page ]
         */
        
        if ( is_plugin_active( 'charitable-ambassadors/charitable-ambassadors.php' ) ) {
          vc_map( array(          
            'name'                      => esc_html__( 'My Donations Received Page', 'charitable-visual-composer-shortcodes' ),
            'base'                      => 'charitable_creator_donations',
            'icon'                      => plugins_url('assets/charitable-icon.jpg', __FILE__),
            'category'                  => esc_html__( 'Charitable', 'charitable-visual-composer-shortcodes' ),
            'wrapper_class'             => 'clearfix',
            'description'               => esc_html__( 'Charitable Ambassadors [ My Donations Received Page ].', 'charitable-visual-composer-shortcodes' ),
            'show_settings_on_create'   => false,
          ));
        }

      }


      /**
       * Show notice if this plugin is activated but Visual Composer is not
       */
      
      public function showVcVersionNotice() {
          $plugin_data = get_plugin_data(__FILE__);
          echo '
          <div class="updated">
            <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'charitable-visual-composer-shortcodes'), $plugin_data['Name']).'</p>
          </div>';
      }

      /**
       * Show notice if this plugin is activated but Charitable is not
       */
      
      public function show_Charitable_install_Notice() {
          $plugin_data = get_plugin_data(__FILE__);
          echo '
          <div class="updated">
            <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="https://wordpress.org/plugins/charitable/" target="_blank">Charitable</a></strong> plugin to be installed and activated on your site.', 'charitable-visual-composer-shortcodes'), $plugin_data['Name']).'</p>
          </div>';
      }
  }
}

new XT_Charitable_VC_Addon_Class();