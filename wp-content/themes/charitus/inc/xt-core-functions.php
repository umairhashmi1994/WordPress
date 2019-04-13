<?php

/**
 * XooThemes Core Functions for WordPress themes
 * Author : XooThemes
 */


/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */


if ( ! function_exists( 'charitus_main_fonts_url' ) ) {

	function charitus_main_fonts_url() {
	    $fonts_url = '';
	    $fonts     = array();
	    $subsets   = '';

	    if ( 'off' !== esc_html_x( 'on', 'Roboto font: on or off', 'charitus' ) ) {
	        $fonts[] = 'Roboto:300,400,400i,500,700,900';
	    }

	    if ( 'off' !== esc_html_x( 'on', 'Khula font: on or off', 'charitus' ) ) {
	        $fonts[] = 'Khula:300,400,600,700,800';
	    }

	    if ( $fonts ) {
	        $fonts_url = add_query_arg( array(
	            'family' => urlencode( implode( '|', $fonts ) ),
	            'subset' => urlencode( $subsets ),
	        ), 'https://fonts.googleapis.com/css' );
	    }

	    return $fonts_url;
	}
}


/**
 * Enqueue Google Fonts styles
 */

add_action( 'wp_enqueue_scripts', 'charitus_enqueue_google_fonts' );

if( !function_exists('charitus_enqueue_google_fonts') ){
	function charitus_enqueue_google_fonts() {

	    wp_enqueue_style( 'educationpress-main-fonts', charitus_main_fonts_url(), array(), null );

	}
}


/**
 * Get Sidebars for CS framework
 */

if( !function_exists('charitus_sidebars_list_on_option') ){
	function charitus_sidebars_list_on_option(){
		$result = array();

        foreach( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $result[ esc_attr( $sidebar['id'] ) ] = esc_html( $sidebar['name'] );      
        }
        
        unset($result['footer-widgets']);

        return $result;
	}
}


/**
 * Get CS Customize value with default value
 * 
 * $id : (string) (Required) customize feild id
 * 
 * $default_value : (string) (Optional) customize feild default falue
 */

if( !function_exists('charitus_cs_get_customize_option') ){
	function charitus_cs_get_customize_option ( $id, $default_value = null ){

		$value = cs_get_customize_option( $id );

		if( $value == null &&  $default_value != null ){
			$value = $default_value;
		}

        return $value;
	}
}


/**
 * Get CS Option value with default value
 * 
 * $id : (string) (Required) option feild id
 * 
 * $default_value : (string) (Optional) option feild default falue
 */

if( !function_exists('charitus_cs_get_option') ){
	function charitus_cs_get_option ( $id, $default_value = null ){

		$value = cs_get_option( $id );

		if( $value == null &&  $default_value != null ){
			$value = $default_value;
		}

        return $value;
	}
}

/**
 * Get CS Meta value
 * 
 * $meta_section : (string) (Required) metabox section key
 * 
 * $meta_field : (string) (Required) metabox field key
 * 
 * $default_value : (string) (Optional) metabox default falue
 * 
 * $single : (bool) (Optional) Whether to return a single value. Default value: true

 * $id : int (Optional) Loop post id. Default value: null
 */

if( !function_exists('charitus_get_post_meta') ){
	function charitus_get_post_meta ( $meta_section, $meta_field, $default_value = null, $single = true, $id = null  ){

		if( !is_search() && !is_404() ){
			if( $id ){
				$values = get_post_meta( $id, $meta_section, true );
			}else{
				global $wp_query;
				$id = $wp_query->post->ID;
				$values = get_post_meta( $id, $meta_section, true );
			}

			$value = $default_value;

			if( isset($values) && is_array($values) ){
				if ( array_key_exists( $meta_field, $values ) ) {
		            $value = $values[$meta_field];
		        }
			}
		}else{
			$value = $default_value;
		}	

        return $value;
	}
}

/**
 * XT Get attachment meta
 */

if( !function_exists('charitus_wp_get_attachment') ){
	function charitus_wp_get_attachment( $attachment_id ) {

	    $attachment = get_post( $attachment_id );
	    return array(
	        'alt' 			=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	        'caption' 		=> $attachment->post_excerpt,
	        'description' 	=> $attachment->post_content,
	        'href' 			=> get_permalink( $attachment->ID ),
	        'src' 			=> $attachment->guid,
	        'title' 		=> $attachment->post_title
	    );
	}	
}


/**
 * is Blog
 */

if(!function_exists('charitus_is_blog')){
	function charitus_is_blog () {
		global  $post;
		$posttype = get_post_type($post );
		return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
	}
}


/**
 * is Search has result
 */

if( !function_exists('charitus_is_search_has_results') ){
	function charitus_is_search_has_results() {
		return 0 != $GLOBALS['wp_query']->found_posts;
	}
}


/**
 * Checks whether we are currently looking at the given page.
 *
 * Example usage:
 *
 * - charitus_charitable_is_page( 'campaign_donation_page' );
 * - charitus_charitable_is_page( 'login_page' );
 * - charitus_charitable_is_page( 'registration_page' );
 * - charitus_charitable_is_page( 'profile_page' );
 * - charitus_charitable_is_page( 'donation_receipt_page' );
 * - charitus_charitable_is_page( 'donation_cancel_page' );
 *
 * @param   string  $page
 * @param 	array 	$args 		Optional array of arguments.
 * @return  boolean
 * @since   1.0.0
 */
if(!function_exists('charitus_charitable_is_page')){
	function charitus_charitable_is_page( $page, $args = array() ) {
		return apply_filters( 'charitable_is_page_' . $page, false, $args );
	}
}


/**
 * Page Layout setup
 */

add_filter( 'charitus_container_class', 'charitus_page_layout_setup' );

if( !function_exists('charitus_page_layout_setup') ){
	function charitus_page_layout_setup( $class ){

		if ( is_page() ){
			$page_layout = charitus_get_post_meta( '_xt_page_side_options', 'page_layout', 'grid', true );

            if( $page_layout && $page_layout == 'grid' ){
            	$class = 'container';
            }else {
            	$class = 'fullwidth_page';
            }
		}

		return $class;
	}
}


/**
 * Content area class
 */

add_filter( 'charitus_content_area_class', 'charitus_contet_area_class' );
if(!function_exists('charitus_contet_area_class')){
	function charitus_contet_area_class ( $class ) {

		if( charitus_is_blog() ){

			$blog_layout = cs_get_option('blog_layout');

			if( $blog_layout == 'right' ){
				$class = 'col-md-8';
			}elseif ( $blog_layout == 'left' ) {
				$class = 'col-md-8 col-md-push-4';
			}elseif( $blog_layout = 'full_width' ){
				$class = 'col-md-12';
			}

		}

		if( is_page() ){

			$page_sidebar_position = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_position', 'no_sidebar', true );

			if( $page_sidebar_position == 'right' ){
				$class = 'col-md-8';
			}elseif ( $page_sidebar_position == 'left' ) {
				$class = 'col-md-8 col-md-push-4';
			}elseif( $page_sidebar_position = 'no_sidebar' ){
				$class = 'page_no_sidebar';
			}

		}

		return $class;
	}
}


/**
 * Widget area class
 */

add_filter( 'charitus_widget_area_class', 'charitus_widget_area_class' );
if(!function_exists('charitus_widget_area_class')){
	function charitus_widget_area_class ( $class ) {
		
		if( charitus_is_blog() ){

			$blog_layout = cs_get_option('blog_layout');

			if( $blog_layout == 'right' ){
				$class = 'col-md-4';
			}elseif ( $blog_layout == 'left' ) {
				$class = 'col-md-4 col-md-pull-8';
			}elseif( $blog_layout = 'full_width' ){
				$class = '';
			}

		}


		if( is_page() ){
			$page_sidebar_position = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_position', 'no_sidebar', true );

			if( $page_sidebar_position == 'right' ){
				$class = 'col-md-4';
			}elseif ( $page_sidebar_position == 'left' ) {
				$class = 'col-md-4 col-md-pull-8';
			}elseif( $page_sidebar_position = 'no_sidebar' ){
				$class = '';
			}
		}
		
		return $class;

	}
}


/**
 * Before Content
 */

add_action( 'charitus_before_content', 'charitus_before_main_content' );

if( !function_exists('charitus_before_main_content') ){
	function charitus_before_main_content(){
		$x_class = '';

		if( charitus_is_blog() == true || is_post_type_archive() == true || is_singular() == true || is_404() == true || is_search() == true || charitus_charitable_is_page( 'donation_receipt_page' ) || is_tax( 'campaign_category' ) || is_tax( 'campaign_tag' ) ){
			$x_class = ' row';
		}

		if( is_singular('page') ){
			$x_class = '';
		}
		?>
			<div class="charitus-main-content-inner<?php echo esc_attr( apply_filters( 'charitus_main_content_inner', $x_class ) ); ?>">
		<?php
	}
}


/**
 * After Content
 */

add_action( 'charitus_after_content', 'charitus_after_main_content' );

if( !function_exists('charitus_after_main_content') ){
	function charitus_after_main_content(){
		?>
			</div>
		<?php
	}
}


/**
 * Page main content inner class
 */

add_filter( 'charitus_main_content_inner', 'charitus_page_main_content_inner_class' );

if( !function_exists('charitus_page_main_content_inner_class') ){
	function charitus_page_main_content_inner_class( $class ){
		if ( is_page() ){
			$page_sidebar_position = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_position', 'no_sidebar', true );

			if( $page_sidebar_position != 'no_sidebar' ){
				$class = ' row';
			}
		}
		return $class;
	}
}


/**
 * Footer Bottom Bar
 */

add_action( 'charitus_footer_bottom_bar', 'charitus_footer_bottom_bar' );

if(!function_exists('charitus_footer_bottom_bar')){
	function charitus_footer_bottom_bar(){
		
		$need_footer_bottom_bar = cs_get_option('need_footer_bottom_bar');
		$footer_text = cs_get_option('footer_text');
		$footer_bottom_bar_social_icons = charitus_cs_get_option( 'footer_bottom_bar_social_icons', '' );

		if( $need_footer_bottom_bar == 'on' ):
			if( $footer_text || !empty( $footer_bottom_bar_social_icons ) ):
				?>
				<div class="<?php echo esc_attr( apply_filters( 'charitus_footer_site_info_container_class', 'container' ) ); ?>">
					<div class="row ch-footer-bottom-bar">
						<div class="copyright">
		                   <div class="col-md-6 col-sm-6 col-xs-12 social">
		                   		<?php if( !empty($footer_bottom_bar_social_icons) ): ?>
			                       	<ul>
										<?php 
											foreach ($footer_bottom_bar_social_icons as $icon) {
												printf( '<li><a href="%s"><i class="%s"></i></a></li>', esc_url( $icon['url'] ), esc_attr( $icon['icon'] ) );
											}
										?>
			                       	</ul>
		                       <?php endif; ?>
		                   </div>
							<?php if ( $footer_text ):?>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="coptyright-content">
										<?php echo wpautop( $footer_text ); ?>
									</div>
								</div>
							<?php endif;?>
						</div>
					</div>
				</div>			
				<?php
			endif;
		endif;
	}
}


/**
 * Theme main header
 */

add_action( 'charitus_theme_main_header', 'charitus_theme_main_header_setup' );

if( !function_exists('charitus_theme_main_header_setup') ){
	function charitus_theme_main_header_setup(){
		$header_transparent = '';
		if( is_page() ){
			$header_transparent = charitus_get_post_meta( '_xt_page_side_options', 'header_transparent', '', true );
		}
		$header_type = charitus_cs_get_option( 'header_type', 'default' );
		$xt_menu_hover_border = cs_get_option( 'xt_menu_hover_border' );
		$classes = array();

		if( $header_transparent && is_page() ){
			$classes[] = 'header-transparent';
		}elseif( $header_type == 'transparent' ){
			$classes[] = 'header-transparent';
			$classes[] = 'global-header-transparent';
		}

		if( $xt_menu_hover_border == true ){
			$classes[] = 'xt-menu-hover-border';
		}

		$classes = array_unique($classes);
		$classes = implode (" ", $classes);

		?>
		<header id="masthead" class="site-header-type-default site-header navbar navbar-default nav-scroll xt-navbar<?php echo esc_attr( $classes ? ' '.$classes : '' ); ?>">
			<?php do_action( 'charitus_pre_header_bar' ); ?>
			<div class="site-header-wrapper">
				<div class="charitus-navigation">
					<div class="<?php echo esc_attr( apply_filters( 'charitus_site_header_container_class', 'container' ) ); ?>">
						<div class="site-header-inner clearfix">
							<div class="site-branding navbar-header">
								<?php do_action( 'charitus_logo_setup' ); ?>
							</div><!-- .site-branding -->

							<div class="xt-main-menu collapse navbar-collapse" id="js-navbar-menu">
								<?php 
									wp_nav_menu( array(
								        'menu'              => 'primary',
								        'theme_location'    => 'primary',
								        'depth'             => 4,
								        'container'       	=>  false,
								        'container_id'      => 'js-navbar-menu',
								        'menu_class'        => 'nav navbar-nav navbar-right',
                    					'menu_id'      	    => 'navbar-nav',
								        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								        'walker'            => new wp_bootstrap_navwalker())
								    );
								?>
							</div>
							<!-- Mobile Menu-->
						    <div class="ch-mobile-menu menu-spacing visible-xs">
						        <div class="mobile-menu-area visible-xs visible-sm">
						            <div class="mobile-menu">
						            <?php wp_nav_menu(array(
						                'menu'            =>  'primary',
						                'theme_location'  =>  'primary',
						                'depth'           =>   4,
						                'container'       =>  'nav',   
						                'container_id'    => 'mobile-menu-active',
						            ) ); ?> 
						            </div>  
						        </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="ch-mobile-menu-location"></div>
		</header><!-- #masthead -->
		<?php
	}
}



/**
 * Logo Setup
 */

add_action( 'charitus_logo_setup','charitus_logo_setup_function' );

if( !function_exists('charitus_logo_setup_function') ){
    function charitus_logo_setup_function(){
    	?>
        <div class="logo-wrapper" itemscope itemtype="http://schema.org/Brand">
            <?php 
            	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                    the_custom_logo();
                }else{
                    printf( '<h1 class="site-title"><a href="%s" rel="home">%s</a></h1>', esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );
                }
            ?> 
        </div>
        <?php
    }
}

/**
 * Pre Header
 */

add_action( 'charitus_pre_header_bar', 'charitus_pre_header_bar_setup' );

if(!function_exists('charitus_pre_header_bar_setup')){
	function charitus_pre_header_bar_setup(){
		$ch_need_pre_header = cs_get_option( 'ch_need_pre_header' );
		$ch_need_pre_header_mobile = cs_get_option( 'ch_need_pre_header_mobile' );
		$ch_pre_header_text = charitus_cs_get_option( 'ch_pre_header_text' );
		$ch_pre_header_phone = charitus_cs_get_option( 'ch_pre_header_phone' );
		$ch_pre_header_email = charitus_cs_get_option( 'ch_pre_header_email' );
		$ch_pre_header_email = sanitize_email( $ch_pre_header_email );
		$ch_pre_header_right_content = charitus_cs_get_option( 'ch_pre_header_right_content', 'social' );
		$ch_pre_header_right_menu = charitus_cs_get_option( 'ch_pre_header_right_menu', '' );
		$ch_pre_header_right_text = charitus_cs_get_option( 'ch_pre_header_right_text', '' );
		$ch_pre_header_right_social_icons = charitus_cs_get_option( 'ch_pre_header_right_social_icons', '' );
		$conditional_pages = charitus_cs_get_option( 'ch_pre_header_right_conditional_pages', '' );

		$ch_pre_header_left_content = charitus_cs_get_option( 'ch_pre_header_left_content', 'informations' );
		$ch_pre_header_left_menu = charitus_cs_get_option( 'ch_pre_header_left_menu', '' );
		$user = wp_get_current_user();
		if( is_user_logged_in() && array_intersect( array( 'campaign_creator' ) , $user->roles ) ){
			$ch_pre_header_left_menu = charitus_cs_get_option( 'ch_pre_header_left_menu_campaign_creator', '' );
		}

		if( $ch_need_pre_header ):
			?>
			<div class="ch-pre-header<?php echo esc_attr( $ch_need_pre_header_mobile == true ? ' ch-pre-header-mobile-disable' : '' ); ?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-8 col-sm-7 ch-pre-header-item-left">
							<?php 
								switch ( $ch_pre_header_left_content ) {
									case 'informations':
										if( $ch_pre_header_text || $ch_pre_header_phone || $ch_pre_header_email ){
											
											if( $ch_pre_header_text ){
												printf( '<span>%s</span>', esc_html($ch_pre_header_text, 'charitus') );
											}
										
											if( $ch_pre_header_phone ){
												printf( '<span class="ch-top-bar-mobile"><i class="lnr lnr-phone-handset"></i><a href="%s">%s</a></span>', 'tel:' . esc_attr( $ch_pre_header_phone ), esc_html( $ch_pre_header_phone, 'charitus' ) );
											}
										
											if( $ch_pre_header_email ){
												printf( '<span class="ch-top-bar-email"><i class="lnr lnr-envelope"></i><a href="%s">%s</a></span>', 'mailto:' . antispambot( $ch_pre_header_email, 1 ), antispambot( $ch_pre_header_email ) );
											}
										}
									break;

									case 'menu':

										wp_nav_menu( array(
										    'menu'              => $ch_pre_header_left_menu,
										    'depth'             => 1,
										    'container'         => 'div',
										    'container_class'	=> 'ch-pre-header-menu',
										    'fallback_cb'		=> false
										));

									break;
								}	
							?>			
							
						</div>
						<div class="col-lg-6 col-md-4 col-sm-5 ch-pre-header-item-right text-right">
							<?php 
								switch ($ch_pre_header_right_content) {
									case 'menu':
											wp_nav_menu( array(
											    'menu'              => $ch_pre_header_right_menu,
											    'depth'             => 1,
											    'container'         => 'div',
										    	'container_class'	=> 'ch-pre-header-menu',
											    'fallback_cb'		=> false
											));
										break;
									
									case 'text':
										printf( '<span class="ch-pre-header-right-text">%s</span>', esc_html( $ch_pre_header_right_text, 'charitus') );
										break;

									case 'social':
										?>
										<ul class="ch-pre-header-right-social">
											<?php 
												foreach ($ch_pre_header_right_social_icons as $icon) {
													printf( '<li><a href="%s"><i class="%s"></i></a></li>', esc_url( $icon['url'] ), esc_attr( $icon['icon'] ) );
												}
											?>
										</ul>
										<?php
										break;

									case 'conditional_pages':
										?>
										<ul class="ch-pre-header-conditional-pages">
											<?php 
												foreach ( $conditional_pages as $conditional_page ) {
													if( $conditional_page['ch_select_condition'] == 'login' && is_user_logged_in() ){
														printf( '<li><a class="btn btn-fill" href="%s">%s</a></li>', esc_url( get_the_permalink( $conditional_page['ch_select_conditional_page'] ) ), esc_html( get_the_title($conditional_page['ch_select_conditional_page']) ) );
													}elseif( $conditional_page['ch_select_condition'] == 'not_login' && !is_user_logged_in() ){
														printf( '<li><a class="btn btn-fill" href="%s">%s</a></li>', esc_url( get_the_permalink( $conditional_page['ch_select_conditional_page'] ) ), esc_html( get_the_title($conditional_page['ch_select_conditional_page']) ) );
													}elseif( $conditional_page['ch_select_condition'] == 'always' ){
														printf( '<li><a class="btn btn-fill" href="%s">%s</a></li>', esc_url( get_the_permalink( $conditional_page['ch_select_conditional_page'] ) ), esc_html( get_the_title($conditional_page['ch_select_conditional_page']) ) );
													}
												}
											?>
										</ul>
										<?php
										break;
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
}


/**
 * Page Title
 */

add_action( 'charitus_after_header', 'charitus_page_title' );

if( !function_exists('charitus_page_title') ){
	function charitus_page_title(){

		global $post;

		$title = get_the_title();

		if( is_search() ){
			if( charitus_is_search_has_results() ){
				$title = esc_html__( 'Search result', 'charitus' );
			}else{
				$title = esc_html__( 'Nothing Found', 'charitus' );
			}
		}elseif( is_archive() ){
			$title = get_the_archive_title();
		}

		if( is_page() ){
			$need_page_title = charitus_get_post_meta( '_xt_page_side_options', 'need_page_title', true, true );
		}else{
			$need_page_title = false;
		}

		if( is_home() ){
			$title = apply_filters( 'xt_blog_page_title', esc_html__( 'Blog','charitus' ) );
		}

		if( is_404() ){
			$title = apply_filters( 'xt_not_found_page_title', esc_html__( '404','charitus' ) );
		}

		if( charitus_is_blog() ){
			$title = apply_filters( 'xt_blog_page_title', esc_html__( 'Blog','charitus' ) );
		}

		$title = apply_filters( 'xt_theme_page_title', $title );

		$xt_show_breadcrumb = cs_get_option( 'xt_show_breadcrumb' );
		

		if( is_page() && $need_page_title != false || is_singular( 'post' ) || is_singular( 'product' ) || is_singular( 'campaign' ) || is_singular( 'tribe_events' ) || is_archive() || is_home() || is_search() || is_404() || charitus_charitable_is_page('donation_receipt_page') || $post->post_name == 'charitable-ghost-forgot-password-page' ){
			?>
				<div class="xt-page-title-area">
					<div class="xt-page-title-overlay"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-6">		
								<div class="xt-page-title">
									<h1 class="entry-title"><?php echo esc_html( $title ); ?></h1>
								</div>
							</div>
							<?php if( $xt_show_breadcrumb == true ): ?>
								<div class="col-md-6 col-sm-6 xt-breadcrumb-wrapper">
									<?php do_action( 'charitus_breadcrumb' );?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
		}
	}
}

// the_post_thumbnail('charitus-blog-thumb', array('class' => 'img-responsive', 'alt' => get_the_title() ) ); 
			

/**
 * Setup breadcrumb
 */

add_action( 'charitus_breadcrumb', 'charitus_breadcrumb_setup', 10 );

if( !function_exists('charitus_breadcrumb_setup') ){
	function charitus_breadcrumb_setup( $args = array() ){

		if( function_exists('breadcrumb_trail') && !is_front_page() ){
			$args = wp_parse_args( $args, apply_filters( 'charitus_breadcrumb_defaults', array() ) );
			breadcrumb_trail( $args );
		}

	}
}

/**
 * Breadcrumb $args
 */


add_filter( 'charitus_breadcrumb_defaults', 'charitus_breadcrumb_args' );

if( !function_exists('charitus_breadcrumb_args') ){
	function charitus_breadcrumb_args( $args = array() ){

		$args = array(
		        'container'       => 'nav',
		        'before'          => '<div class="xt-breadcrumb">',
		        'after'           => '</div>',
		        'show_on_front'   => true,
		        'network'         => false,
		        'show_title'      => true,
		        'show_browse'     => false,
		        'echo'            => true,

		        'post_taxonomy' => array(
		            'post'  			=> 'post_tag',
		            'post'  			=> 'category',
		            'tribe_events'  	=> 'tribe_events_cat',
		        ),

		        'labels' => array(
		            'browse'              => '',
		            'aria_label'          => esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'charitus' ),
		            'home'                => esc_html__( 'Home',                                  'charitus' ),
		            'error_404'           => esc_html__( '404 Not Found',                         'charitus' ),
		            'archives'            => esc_html__( 'Archives',                              'charitus' ),
		            'search'              => esc_html__( 'Search results for &#8220;%s&#8221;',   'charitus' ),
		            'paged'               => esc_html__( 'Page %s',                               'charitus' ),
		            'archive_minute'      => esc_html__( 'Minute %s',                             'charitus' ),
		            'archive_week'        => esc_html__( 'Week %s',                               'charitus' ),
		            'archive_minute_hour' => '%s',
		            'archive_hour'        => '%s',
		            'archive_day'         => '%s',
		            'archive_month'       => '%s',
		            'archive_year'        => '%s',
		        )
		);

		return $args;
	}
}


/**
 * Link Pages Bootstrap
 * @author toscha
 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
 * @param  array $args
 * @return void
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 */

if( !function_exists('charitus_bootstrap_link_pages') ):
	function charitus_bootstrap_link_pages( $args = array () ) {
	    $defaults = array(
			'before' 			=> '<nav class="xt_theme_paignation"><ul class="pager">',
			'after' 			=> '</ul></nav>',
			'before_link' 		=> '<li>',
			'after_link' 		=> '</li>',
			'current_before' 	=> '<li class="active">',
			'current_after' 	=> '</li>',
	        'link_before' 		=> '',
	        'link_after'  		=> '',
	        'pagelink'    		=> '%',
	        'echo'        		=> 1
	    );
	    $r = wp_parse_args( $args, $defaults );
	    $r = apply_filters( 'wp_link_pages_args', $r );
	    extract( $r, EXTR_SKIP );
	    global $page, $numpages, $multipage, $more, $pagenow;
	    if ( ! $multipage )
	    {
	        return;
	    }
	    $output = $before;
	    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
	    {
	        $j       = str_replace( '%', $i, $pagelink );
	        $output .= ' ';
	        if ( $i != $page || ( ! $more && 1 == $page ) )
	        {
	            $output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
	        }
	        else
	        {
	            $output .= "{$current_before}{$link_before}<a>{$j}</a>{$link_after}{$current_after}";
	        }
	    }
	    print $output . $after;
	}
endif;


/**
 * WordPress Bootstrap pagination
 */

if( !function_exists('charitus_wp_numeric_pagination') ):
    function charitus_wp_numeric_pagination( $args = array() ) {
        
        $defaults = array(
            'range'           => 4,
            'custom_query'    => FALSE,
            'previous_string' => '<i class="fa fa-angle-left"></i>',
            'next_string'     => '<i class="fa fa-angle-right"></i>',
            'before_output'   => '<nav class="xt_theme_paignation"><ul class="pager">',
            'after_output'    => '</ul></nav>'
        );
        
        $args = wp_parse_args( 
            $args, 
            apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
        );
        
        $args['range'] = (int) $args['range'] - 1;
        if ( !$args['custom_query'] )
            $args['custom_query'] = @$GLOBALS['wp_query'];
        $count = (int) $args['custom_query']->max_num_pages;
        $page  = intval( get_query_var( 'paged' ) );
        $ceil  = ceil( $args['range'] / 2 );
        
        if ( $count <= 1 )
            return FALSE;
        
        if ( !$page )
            $page = 1;
        
        if ( $count > $args['range'] ) {
            if ( $page <= $args['range'] ) {
                $min = 1;
                $max = $args['range'] + 1;
            } elseif ( $page >= ($count - $ceil) ) {
                $min = $count - $args['range'];
                $max = $count;
            } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
                $min = $page - $ceil;
                $max = $page + $ceil;
            }
        } else {
            $min = 1;
            $max = $count;
        }
        
        $echo = '';
        $previous = intval($page) - 1;
        $previous = esc_attr( get_pagenum_link($previous) );
        
        if ( $previous && (1 != $page) )
        	$echo .= sprintf ( '<li><a href="%s" title="%s">%s</a></li>', esc_url( $previous ), esc_html__( 'previous', 'charitus' ), $args['previous_string'] );
        
        if ( !empty($min) && !empty($max) ) {
            for( $i = $min; $i <= $max; $i++ ) {
                if ($page == $i) {
                    $echo .= sprintf ( '<li class="active"><span class="active">%s</span></li>', esc_html( str_pad( (int)$i, 2, '0', STR_PAD_LEFT ) ) );
                } else {
                    $echo .= sprintf( '<li><a href="%s">%002d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
                }
            }
        }
        
        $next = intval($page) + 1;
        $next = esc_attr( get_pagenum_link($next) );
        if ($next && ($count != $page) )
        	$echo .= sprintf ( '<li><a href="%s" title="%s">%s</a></li>', esc_url( $next ), esc_html__( 'next', 'charitus' ), $args['next_string'] );
        
        if ( isset($echo) )
            echo wp_kses_post( $args['before_output'] . $echo . $args['after_output'] );
    }
endif;


/**
 *  Author bio
 */

if ( ! function_exists( 'charitus_get_author_bio' ) ) :
function charitus_get_author_bio() {
	$description = get_the_author_meta( 'description' );

	if( $description != '' ){
	    ?>
	    <div class="xt-author-bio shadow">
	    	<div class="row">
		        <div class="charitus-author-avatar col-sm-3">
		            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 320 ); ?>
		        </div>
		        <div class="charitus-author-comment col-sm-9">
		            <h3 class="charitus-author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h3>
		            <?php echo wpautop( esc_html( get_the_author_meta( 'description' ) ) ); ?>
		            <?php printf( '<a class="btn btn-border btn-primary xt-btn-primary" href="%s">%s%s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), apply_filters( 'charitus_author_all_post_btn_text', esc_html__( 'All Posts by ', 'charitus' ) ), esc_html( get_the_author_meta( 'display_name' ) ) ); ?>
		        </div>
	        </div>
	    </div>
	    <?php
	}
}
endif;


/**
 * Comment list walker
 */

/**
 * A custom WordPress comment walker class to implement the Bootstrap 3 Media object in wordpress comment list.
 *
 * @package     WP Bootstrap Comment Walker
 * @version     1.0.0
 * @author      Edi Amin <to.ediamin@gmail.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link        https://github.com/ediamin/wp-bootstrap-comment-walker
 */

if( !class_exists('charitus_Bootstrap_Comment_Walker') ){
	class charitus_Bootstrap_Comment_Walker extends Walker_Comment {
		/**
		 * Output a comment in the HTML5 format.
		 *
		 * @access protected
		 * @since 1.0.0
		 *
		 * @see wp_list_comments()
		 *
		 * @param object $comment Comment to display.
		 * @param int    $depth   Depth of comment.
		 * @param array  $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {
			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
			?>		
			<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '' ); ?>>
				<div class="xt-media comment-body">
					<?php if ( 0 != $args['avatar_size'] ): ?>
						<div class="charitus-media-left">
							<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="xt-media-object">
								<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="charitus-media-body">
						<h4 class="charitus-media-heading">
							<?php echo get_comment_author_link(); ?>
						</h4><!-- .xt-media-heading -->
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
								<time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
									<?php printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'charitus' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( esc_html__( 'Edit', 'charitus' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation label label-info"><?php esc_html_e( 'Your comment is awaiting moderation.', 'charitus' ); ?></p>
						<?php endif; ?>				

						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
						
						<?php
							comment_reply_link( array_merge( $args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="reply-link"><i class="fa fa-reply" aria-hidden="true"></i>',
								'after'     => '</div>'
							) ) );	
						?>
					</div>	
				</div>	
			<?php
		}	
	}
}



/**
 * Page Body Class
 */

add_filter('body_class', 'charitus_get_post_meta_page_body_classes');

if(!function_exists('charitus_get_post_meta_page_body_classes')){
	function charitus_get_post_meta_page_body_classes($classes) {

		if( is_page() ){
			$page_layout = charitus_get_post_meta( '_xt_page_side_options', 'page_layout', 'grid', true );
			$need_page_title = charitus_get_post_meta( '_xt_page_side_options', 'need_page_title', true, true );
			$page_sidebar_enable = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_enable', false, true );
			$page_sidebar_position = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_position', 'no_sidebar', true );

			if( $page_layout && $page_layout == 'grid' ){
				$classes[] = 'xt-page-layout-grid';
			}
			elseif( $page_layout && $page_layout == 'full_screen' ) {
				$classes[] = 'xt-page-layout-full-width';
			}

			if( $need_page_title && $need_page_title = true ){
				$classes[] = 'xt-has-page-title';
			}else{
				$classes[] = 'xt-no-page-title';
			}

			if( $page_sidebar_enable && $page_sidebar_enable = true ){
				$classes[] = 'xt-has-page-sidebar';
			}else{
				$classes[] = 'xt-no-page-sidebar';
			}

			if( $page_sidebar_position && $page_sidebar_position == 'left' ){
				$classes[] = 'xt-page-left-sidebar';
			}
			elseif( $page_sidebar_position && $page_sidebar_position == 'right' ) {
				$classes[] = 'xt-page-right-sidebar';
			}
		}

		if( charitus_charitable_is_page( 'donation_receipt_page' ) ){
			$classes[] = 'xt-page-layout-grid';
		}
		
		if( charitus_charitable_is_page('campaign_donation_page') ){
			$classes[] = 'xt-campaign-layout-grid';
		}

		return $classes;
	}
}



/**
 * Required Plugins
 */
add_action( 'tgmpa_register', 'charitus_register_required_plugins' );
if(!function_exists('charitus_register_required_plugins')){
	function charitus_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'Visual Composer', 'charitus' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/lib/plugins/visual-composer.zip',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Charitus CPT and Shortcode', 'charitus' ),
				'slug'               => 'xt-charitus-cpt-shortcodes',
				'source'             => get_template_directory() . '/lib/plugins/xt-charitus-cpt-shortcodes.zip',
				'required'           => true,
				'version'            => '1.0',
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Charitable Visual Composer ShortCodes', 'charitus' ),
				'slug'               => 'charitable-vc-shortcodes',
				'source'             => get_template_directory() . '/lib/plugins/charitable-vc-shortcodes.zip',
				'required'           => true,
				'version'            => '1.0',
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'      => esc_html__( 'Charitable Donation Plugin', 'charitus' ),
				'slug'      => 'charitable',
				'required'  => true,
			),
			array(
				'name'      => esc_html__( 'WooCommerce', 'charitus' ),
				'slug'      => 'woocommerce',
				'required'  => false,
			),
			array(
				'name'      => esc_html__( 'The Events Calendar', 'charitus' ),
				'slug'      => 'the-events-calendar',
				'required'  => false,
			),
			array(
				'name'      => esc_html__( 'Contact Form 7', 'charitus' ),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'      => esc_html__( 'One Click Demo Import', 'charitus' ),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),
		);

		$config = array(
			'id'           => 'charitus',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );
	}
}


/**
 * Demo Installer
 * 
 * Using the plugin : https://wordpress.org/plugins/one-click-demo-import/
 *
 * Documentation : http://proteusthemes.github.io/one-click-demo-import/
 */

if(!function_exists('charitus_import_theme_demo_files')){
	function charitus_import_theme_demo_files() {
	  return array(
	    array(
	      'import_file_name'             => esc_html__( 'Demo Import', 'charitus' ),
	      'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/demo-data/demo-content.xml',
	      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/demo-data/widgets.json',
	      'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'lib/demo-data/customizer.dat',
	      'import_notice'                => esc_html__( 'After importing the demo data, please follow this theme documentation step by step.', 'charitus' ),
	    )
	  );
	}
}

add_filter( 'pt-ocdi/import_files', 'charitus_import_theme_demo_files' );


/**
 *  page footer wrapper class
 *  action located at content-page.php
 */

add_action( 'charitus_page_footer_wrapper_class', 'charitus_page_footer_wrapper_class_setup' );

if(!function_exists('charitus_page_footer_wrapper_class_setup')){
 	function charitus_page_footer_wrapper_class_setup(){

 		$class = '';

		if ( is_page() ){
			$page_layout = charitus_get_post_meta( '_xt_page_side_options', 'page_layout', 'grid', true );

			if( $page_layout && $page_layout == 'grid' ){
				$class = '';
			}else {
				$class = ' container';
			}
		}

		echo esc_attr( $class );
	}
}



/**
 * Excerpt more
 */

if(!function_exists('charitus_excerpt_more')){
	function charitus_excerpt_more( $more ) {
	    return '&#8230;';
	}
}
add_filter( 'excerpt_more', 'charitus_excerpt_more' );



/**
 * Post Type column post ID
 */


add_action( 'init', 'charitus_adding_post_id_columns_to_our_post_types' );

if(!function_exists('charitus_adding_post_id_columns_to_our_post_types')){
	function charitus_adding_post_id_columns_to_our_post_types(){
		$post_types = array( 'charitus_slider', 'charitus_gallery', 'charitus_testimonial', 'charitus_volanteers' );

		foreach( $post_types as $post_type ) {
			add_action( 'manage_' . $post_type . '_posts_custom_column', 'charitus_cutom_columns_content', 10, 2 );
			add_filter( 'manage_' . $post_type . '_posts_columns', 'charitus_cutom_columns_head', 20 );        
		}
	}
}

if(!function_exists('charitus_cutom_columns_head')){
	function charitus_cutom_columns_head( $columns ) {

	    $columns['xt_post_id'] = esc_html__( 'ID', 'charitus' );

	    return $columns;

	}
}

if(!function_exists('charitus_cutom_columns_content')){
	function charitus_cutom_columns_content( $column_name, $id ) {

	    if ( 'xt_post_id' == $column_name ) {

	        echo esc_attr( $id );

	    }

	}
} 


/**
 * Show Resize images
 * 
 * $thumb_id : thumbnail id, integer
 * $width : image width, integer
 * $height : image height, integer
 * $crop : image crop, boolean, default - true
 * $alt : image alt, string
 */


if(!function_exists('charitus_get_aq_resize_thumbnail')){
	function charitus_get_aq_resize_thumbnail( $width, $height, $thumb_id = null, $crop = null, $alt = null ){
		if( $thumb_id == null ){
			$thumb_id = get_post_thumbnail_id();
		}
		if( $crop == null ){
			$crop = true;
		}
		if( $alt != null ){
			$alt = get_the_title();
		}
		
		$img_url = wp_get_attachment_url( $thumb_id, 'full' );
		$resize_img_url = charitus_aq_resize( $img_url, $width, $height, $crop );

		if( $resize_img_url ){
			return sprintf( '<img src="%s"'.( $alt ? ' alt="%s"' : '' ).'>', esc_url( $resize_img_url ), esc_html( $alt ) );
		}

	}
}