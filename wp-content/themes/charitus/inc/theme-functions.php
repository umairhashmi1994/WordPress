<?php

/**
 * charitus
 * Author : XooThemes
 */

/**
 * Adding Custom Styles
 */

/**
 * Add Inline custom css
 */

if(!function_exists('charitus_add_inline_styles')){
	function charitus_add_inline_styles() {
	
	    $body_color = charitus_cs_get_option( 'xt_body_color', '#363636' );
	    $body_bg = charitus_cs_get_option( 'xt_body_bg', '#ffffff' );
	    $body_font_size = charitus_cs_get_option( 'body_font_size', 16 );
	    $body_line_height = charitus_cs_get_option( 'body_line_height', 26 );

	    $xt_header_bg = charitus_cs_get_option( 'xt_header_bg', '#ffffff' );
	    $xt_default_menu_color = charitus_cs_get_option( 'xt_default_menu_color', '#363636' );
	    $xt_default_menu_hover_color = charitus_cs_get_option( 'xt_default_menu_hover_color', '#3cb878' );
	    $xt_dropdown_menu_color = charitus_cs_get_option( 'xt_dropdown_menu_color', '#363636' );
	    $xt_dropdown_menu_color_hover = charitus_cs_get_option( 'xt_dropdown_menu_color_hover', '#3cb878' );
	    $xt_dropdown_menu_bg = charitus_cs_get_option( 'xt_dropdown_menu_bg', '#ffffff' );
	    $xt_dropdown_menu_border_color = charitus_cs_get_option( 'xt_dropdown_menu_border_color', '#eeeeee' );
	    $xt_dropdown_menu_width = charitus_cs_get_option( 'xt_dropdown_menu_width', 250 );

	    $xt_page_header_bg = charitus_cs_get_option( 'xt_page_header_bg' );
	    $xt_page_feature_img_header_bg = cs_get_option( 'xt_page_feature_img_header_bg' );

	    if( $xt_page_header_bg ){
	    	$xt_page_header_bg = wp_get_attachment_image_src( $xt_page_header_bg, 'full' );
	    	$xt_page_header_bg = $xt_page_header_bg[0];
	    }
	    if( is_page() && has_post_thumbnail() && $xt_page_feature_img_header_bg ){
			$xt_page_header_bg = get_the_post_thumbnail_url( get_the_id(), 'full' );
	    }

	    $xt_page_header_bg_color = charitus_cs_get_option( 'xt_page_header_bg_color', 'rgba(0, 0, 0, 0.6)' );
	    $xt_page_header_p_top = charitus_cs_get_option( 'xt_page_header_p_top', 26 );
	    $xt_page_header_p_bottom = charitus_cs_get_option( 'xt_page_header_p_bottom', 26 );

	    $footer_top_space = charitus_cs_get_option( 'footer_top_space', 70 );
	    $footer_bottom_space = charitus_cs_get_option( 'footer_bottom_space', 30 );
	    $footer_background_color = charitus_cs_get_option( 'footer_background_color', '#2a2f36' );
	    $footer_content_color = charitus_cs_get_option( 'footer_content_color', '#ffffff' );
	    $footer_link_color = charitus_cs_get_option( 'footer_link_color', '#ffffff' );
	    $footer_link_hover_color = charitus_cs_get_option( 'footer_link_hover_color', '#ffffff' );
	    $bottom_bar_top_bottom_space = charitus_cs_get_option( 'bottom_bar_top_bottom_space', 15 );
	    $bottom_bar_border_color = charitus_cs_get_option( 'bottom_bar_border_color', '#4a4f55' );

	    /* Customizer Settings */
	    $pre_header_top_space = charitus_cs_get_customize_option( 'pre_header_top_space', 12 );
	    $pre_header_bottom_space = charitus_cs_get_customize_option( 'pre_header_bottom_space', 12 );
	    $header_top_space = charitus_cs_get_customize_option( 'header_top_space', 15 );
	    $header_bottom_space = charitus_cs_get_customize_option( 'header_bottom_space', 15 );
	    $logo_top_space = charitus_cs_get_customize_option( 'logo_top_space', 0 );
	    $logo_bottom_space = charitus_cs_get_customize_option( 'logo_bottom_space', 0 );
	    $menu_top_space = charitus_cs_get_customize_option( 'menu_top_space', 3 );
	    $menu_bottom_space = charitus_cs_get_customize_option( 'menu_bottom_space', 4 );
	    $menu_left_space = charitus_cs_get_customize_option( 'menu_left_space', 22 );
	    $menu_right_space = charitus_cs_get_customize_option( 'menu_right_space', 22 );

	    $custom_css = '';

	    $need_color_customizer = cs_get_option( 'need_color_customizer' );
		$xt_primary_color = cs_get_option( 'xt_primary_color' );
		$xt_primary_color_dark = cs_get_option( 'xt_primary_color_dark' );
		$xt_primary_color_light = cs_get_option( 'xt_primary_color_light' );

		if( $need_color_customizer == true ){

			$custom_css .= "a.xt-btn-primary:hover,
				.ch-blog.sticky .blog-content:before,
				.pager li.active>span,
				.woocommerce-pagination li.active > span,
				.btn.btn-fill,
				.btn-border:hover,
				.btn-base,
				.ch-event .owl-prev,
				.charitus-donation-causes-slider .owl-prev,
				.main-color-bg, 
				.navbar-nav > li > a:hover:before,
				.navbar-nav > li > a:focus:before,
				.navbar-nav li.active a:before,
				.blog-content .entry-footer a:focus,
				.blog-content .entry-footer a:active,
				.ch-pagination .pagination > .active > a,
				.ch-pagination .pagination > .active > a:focus,
				.ch-pagination .pagination > .active > a:hover,
				.ch-pagination .pagination > .active > span,
				.ch-pagination .pagination > .active > span:focus,
				.ch-pagination .pagination > .active > span:hover,
				.mean-container .mean-nav ul li a.mean-expand,
				.mean-container .mean-nav ul li a.mean-expand:hover,
				.ch-blog .blog-banner .date,
				.features-inner .features-content,
				.ch-event .owl-next,
				.charitus-donation-causes-slider .owl-next,
				.comment-respond .form-submit input[type=submit],
				.search-form .search-submit,
				.post-password-form input[type=submit],
				.button.button-primary,
				.button.button-secondary,
				.vc_row.xt_vc_row-background-primary,
				.post-password-form input[type=submit],
				.ch-causes .campaign-progress-bar .bar,
				.ch-event .event-banner .charitus-event-price,
				body .campaign-progress-bar .bar, body .donate-button, body #charitable-donation-amount-form .donation-amount.selected,
				#tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a,
				#tribe-events-content .tribe-events-tooltip h4,
				.tribe-events-list .tribe-events-event-cost span,
				.xt-page-layout-full-width .charitable-user-campaigns .charitable-campaign .charitus-campaign-status,
				.ch-pre-header,
				.ch-campaign-ajax-search-result-area li a:hover,
				.woocommerce span.onsale,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce div.product div.images .woocommerce-product-gallery__trigger,
				.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
				.woocommerce-MyAccount-navigation ul li a,
				.vc_tta-container .vc_tta-accordion.xt-vc-tta-accordion-theme-default .vc_tta-panel.vc_active .vc_tta-panel-heading,
				.vc_tta-container .vc_tta-accordion.xt-vc-tta-accordion-theme-default.vc_tta.vc_general .vc_tta-panel .vc_tta-panel-heading:hover,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current {background-color:{$xt_primary_color}}";

			$custom_css .= ".btn.btn-fill:hover,
				.btn.btn-fill:focus, 
				.comment-respond .form-submit input[type=submit]:hover,
				.button.button-primary:hover,
				.button.button-secondary:hover,
				.post-password-form input[type=submit]:hover,
				body .charitus-donation-causes .donate-button.btn.btn-fill:hover,
				.woocommerce #respond input#submit:hover, 
				.woocommerce a.button:hover, 
				.woocommerce button.button:hover, 
				.woocommerce input.button:hover,
				.woocommerce-MyAccount-navigation ul li a:hover,
				.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {background-color:{$xt_primary_color_dark}}";

			$custom_css .= ".ch-grid .ch-grid-item figure:hover figcaption {background-color:{$xt_primary_color_light}}";
					
			$custom_css .= ".main-color,
				.xt_vc_row-color-white .charitus-donation-cause-item .cause-inner .main-color,
				.ch-footer .footer-content ul li a:hover,
				.ch-footer .ch-widget-list ul li a:hover,
				.edit-link a.post-edit-link:hover,
				.edit-link a.post-edit-link:focus,
				.edit-link a.post-edit-link:active,
				.blog_widget ul li a:hover,
				.ch-sidebar a:hover,
				.copyright .social ul li:hover a,
				.copyright .coptyright-content a:hover,
				.ch-client-testimonial .item blockquote h3,
				.ch-client .contact-form .section-title h2 span,
				.ch-client-testimonial .item blockquote p:before,
				.ch-client-testimonial .item blockquote p:after,
				.ch-client .contact-form .section-title h2 span,
				.navbar-nav > li > a:hover:before,
				.navbar-nav > li > a:focus:before,
				.navbar-nav > li > a:hover,
				.navbar-nav > li > a:focus,
				.navbar-nav li.active a:before,
				.navbar-default .navbar-nav>li>a:hover,
				.navbar-default .navbar-nav>.active>a,
				.navbar-nav li.active a, 
				.navbar-nav li.current-menu-item a,
				.navbar-nav > li > .dropdown-menu li.current-menu-item a,
				.navbar-nav li.current_page_item a,
				.navbar-default .navbar-nav>.active>a:hover,
				.navbar-nav li.active a:hover, 
				.navbar-nav li.current-menu-item a:hover,
				.navbar-default .navbar-nav li.current-menu-parent > a,
				.header-slider .slide-tablecell h1,
				.features-inner .each-details i:before,
				.section-title h2 span,
				.navbar-nav > li > .dropdown-menu li a:hover,
				a:focus, a:hover,
				.charitus-blog-tags-n-share a:hover,
				.blog-content blockquote,
				.comment a,
				.comment-edit-link,
				.comment a:hover,
				.comment-edit-link:hover,
				.campaign-donation-stats .amount,
				.campaign-donation-stats .goal-amount,
				.ch-donation-stats-item i,
				#charitable-donation-form .donation-amounts .donation-amount.suggested-donation-amount.selected > label:before,
				.widget_charitable_donate_widget #charitable-donation-amount-form .donation-amounts .donation-amount.suggested-donation-amount.selected label:before,
				body .charitable-donation-form .recurring-donation .recurring-donation-option.selected > label,
				body .campaign-raised .amount, body .campaign-figures .amount, body .donors-count, body .time-left, body .charitable-form-field a:not(.button), body .charitable-form-fields .charitable-fieldset a:not(.button) {color:{$xt_primary_color}}";


			$custom_css .= ".comment-form input[type='text']:focus, 
				.comment-form input[type='url']:focus, 
				.comment-form input[type='email']:focus, 
				.comment-form input[type='email']:focus, 
				.comment-form textarea:focus,
				.post-password-form input[type='password']:focus,
				a.xt-btn-primary,
				.nav-previous a, .nav-next a,
				a.xt-btn-primary:hover,
				.blog_widget select:focus,
				.ch-causes .cause-inner-content .btn,
				.ch-event .event-content .btn,
				.ch-pagination .pagination li a,
				.ch-blog .blog-content .btn,
				.navbar-nav > li > a.sign-up, 
				input[type='submit'].btn-border,
				input[type='submit'].btn-border:hover,
				input[type='submit'].btn-border:focus,
				.form-control:focus,
				input[type='text']:focus, 
				input[type='email']:focus,
				input[type='password']:focus,
				input[type='number']:focus,
				input[type='url']:focus,
				textarea:focus,
				.search-form input[type=search]:active,
				.search-form input[type=search]:focus,
				.xt_vc_row-color-white .ch-campaign-search .btn.btn-fill,
				.widget.widget_tag_cloud a, .widget.widget_product_tag_cloud a,
				.mean-container .mean-nav ul li,
				.button.button-secondary, .button.button-secondary:hover,
				.button.button-primary, .button.button-primary:hover,
				.widget_charitable_donate_widget #charitable-donation-amount-form .donation-amounts .donation-amount.suggested-donation-amount.selected,
				.widget_charitable_donate_widget #charitable-donation-amount-form .donation-amounts .donation-amount.suggested-donation-amount:hover,
				body #charitable-donation-form .donation-amount.selected,
				#charitable-donation-form .donation-amounts .donation-amount.suggested-donation-amount.selected,
				#charitable-donation-form .donation-amounts .donation-amount.suggested-donation-amount:hover,
				.tribe-events-list .tribe-events-event-cost span,
				.ch-campaign-search .btn,
				.widget_product_search .search-field:focus,
				.pager li>a, .pager li>span,
				.woocommerce-pagination li > a, .woocommerce-pagination li > span,
				.woocommerce .ch-woocommerce-shop-filter-wrapper .woocommerce-ordering select:focus, .woocommerce div.product form.cart .variations select:focus,
				.vc_tta-container .vc_tta-accordion.xt-vc-tta-accordion-theme-default .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:before,
				.select2-container--default .select2-search--dropdown .select2-search__field:focus {border-color:{$xt_primary_color}}";

			$custom_css .= ".woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce-MyAccount-navigation ul li a,
				.btn.btn-fill {border-color:{$xt_primary_color_dark}}";

			$custom_css .= ".ch-client-testimonial #quote-carousel .carousel-indicators li {border-color:{$xt_primary_color_light}}";	

		}

	    $custom_css .= "
			body {
				color: {$body_color};
				background: {$body_bg};
				line-height: {$body_line_height}px;
				font-size: {$body_font_size}px;
			}
		    ";

		$custom_css .= "
			.navbar.site-header-type-default {
				background: {$xt_header_bg};
			}
		    ";

		$custom_css .= "
			.navbar-default .navbar-nav li a {
				color: {$xt_default_menu_color};
			}
			.navbar-default .navbar-nav li a:hover {
				color: {$xt_default_menu_hover_color};
			}
			.navbar-nav > li > .dropdown-menu li a {
				color: {$xt_dropdown_menu_color};
			}
			.navbar-nav > li > .dropdown-menu li a:hover {
				color: {$xt_dropdown_menu_color_hover};
			}
			.navbar-nav > li .dropdown-menu {
				background: {$xt_dropdown_menu_bg};
			}
			.navbar-nav > li > .dropdown-menu li {
				border-bottom-color: {$xt_dropdown_menu_border_color};
			}
			.navbar-nav > li .dropdown-menu {
			    min-width: {$xt_dropdown_menu_width}px;
			}
		    ";

		if( $xt_page_header_bg ){
			$custom_css .= "
				.xt-page-title-area {
					background-image: url( $xt_page_header_bg );
				}
			    ";
		}
		$custom_css .= "
			.xt-page-title-area .xt-page-title-overlay {
				background: {$xt_page_header_bg_color};
			}
			.xt-page-title-area {
				padding-top: {$xt_page_header_p_top}px;
				padding-bottom: {$xt_page_header_p_bottom}px;
			}
		    ";

		$custom_css .= "
			.site-footer-inner {
			  padding: {$footer_top_space}px 0 {$footer_bottom_space}px;
			}
			.footer-bg.site-footer {
			    background-color: {$footer_background_color};
			    color: {$footer_content_color};
			}
			.ch-footer .footer-content ul li a,
			.ch-footer .ch-widget-list ul li a {
				color: {$footer_link_color};
			}
			.ch-footer .footer-content ul li a:hover,
			.ch-footer .ch-widget-list ul li a:hover {
				color: {$footer_link_hover_color};
			}
			.ch-footer-bottom-bar {
				padding: {$bottom_bar_top_bottom_space}px 0;
			}
			.site-footer .ch-hr {
			    border-color: {$bottom_bar_border_color};
			}
		    ";

		$custom_css .= "
			.ch-pre-header {
			    padding: {$pre_header_top_space}px 0 {$pre_header_bottom_space}px;
			}
			.site-header-wrapper {
			    padding: {$header_top_space}px 0 {$header_bottom_space}px;
			}
			.charitus-navigation .navbar-nav > li > a {
				padding: {$menu_top_space}px 0 {$menu_bottom_space}px;
			}
			.charitus-navigation .navbar-nav > li {
				padding: 0 {$menu_right_space}px 0 {$menu_left_space}px;
			}
		    ";

		if( $logo_top_space ){
			$custom_css .= "
			.site-branding.navbar-header {
				margin-top: {$logo_top_space}px;
			}
		    ";
		} 

		if( $logo_bottom_space ){
			$custom_css .= "
			.site-branding.navbar-header {
				margin-bottom: {$logo_bottom_space}px;
			}
		    ";
		}     

		$custom_css = apply_filters( 'xt_theme_custom_css', $custom_css );    

	    wp_add_inline_style( 'charitus-custom-style', $custom_css );

	}
}
add_action( 'wp_enqueue_scripts', 'charitus_add_inline_styles' );


