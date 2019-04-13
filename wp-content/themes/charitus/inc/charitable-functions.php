<?php

/**
 * Functions for customize the charitable plugin
 */

/**
 * Campaigns loop, after the main title.
 *
 * @see     charitable_template_campaign_description()
 * @see     charitable_template_campaign_progress_bar()
 * @see     charitable_template_campaign_loop_donation_stats()
 */



if( !function_exists('charitus_charitable_campaign_content_loop_content_customize') ){
	/**
	 * Customize cmapaign loop content
	 */
	
	function charitus_charitable_campaign_content_loop_content_customize(){

		// Remove defaults
		remove_action( 'charitable_campaign_content_loop_after', 'charitable_template_campaign_description', 4 );
		remove_action( 'charitable_campaign_content_loop_after', 'charitable_template_campaign_progress_bar', 6 );
		remove_action( 'charitable_campaign_content_loop_after', 'charitable_template_campaign_loop_donation_stats', 8 );

		// Adding custom
		add_action( 'charitable_campaign_content_loop_after', 'charitus_charitable_template_campaign_loop_donation_stats_print', 4 );
		add_action( 'charitable_campaign_content_loop_after', 'charitus_charitable_template_campaign_progress_bar', 6 );
		add_action( 'charitable_campaign_content_loop_after', 'charitus_charitable_template_campaign_short_description', 8 );
		add_action( 'charitable_campaign_content_loop_after', 'charitus_charitable_template_campaign_loop_more_link', 10 );

		// Remove location from the grid
		remove_action( 'charitable_campaign_content_loop_after', 'charitable_geolocation_template_campaign_loop_location', 2 );

		// Responsive inline style
		remove_action( 'charitable_campaign_loop_before', 'charitable_template_responsive_styles', 10, 2 );
		

	}
	add_action( 'template_redirect', 'charitus_charitable_campaign_content_loop_content_customize', 10 );
}


/**
 * Campaign Short Description
 */

if( !function_exists('charitus_charitable_template_campaign_short_description') ){
	function charitus_charitable_template_campaign_short_description(){
		echo wpautop( wp_trim_words( get_the_excerpt(), apply_filters( 'charitus_charitable_campaign_short_description_length', 20 ) ) );
	}
}


/**
 * Campaign progress bar
 */

if( !function_exists('charitus_charitable_template_campaign_progress_bar') ){
	function charitus_charitable_template_campaign_progress_bar( $campaign ){
		?>
		<div class="charitus-donation-progress-bar clearfix">
            <span class="progress-val"><?php echo esc_html( $campaign->get_percent_donated() ) ?></span>
            <div class="fund-process">
            	<?php charitable_template_campaign_progress_bar( $campaign ); ?>
            </div>
        </div>
		<?php
	}
}

/**
 * Campaign stats
 */

if( !function_exists('charitus_charitable_template_campaign_loop_donation_stats') ){
	function charitus_charitable_template_campaign_loop_donation_stats( $campaign ){

		$currency_helper = charitable_get_currency_helper();

		if ( $campaign->has_goal() ) {
			$ret = sprintf( _x( '<div class="ch-campaign-stats"><span class="ch-donation-raised">Donated: %s</span> <span class="ch-donation-goal">Goal: %s</span></div>', 'amount donated of goal', 'charitus' ),
				'<span class="amount main-color">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>',
				'<span class="goal-amount main-color">' . $currency_helper->get_monetary_amount( $campaign->get( 'goal' ) ) . '</span>'
			);
		} else {
			$ret = sprintf( _x( '<div class="ch-campaign-stats">%s donated</div>', 'amount donated', 'charitus' ),
				'<span class="amount main-color">' . $currency_helper->get_monetary_amount( $campaign->get_donated_amount() ) . '</span>'
			);
		}

		return apply_filters( 'charitus_donation_summary', $ret, $campaign );
	}
}

if( !function_exists('charitus_charitable_template_campaign_loop_donation_stats_print') ){
	function charitus_charitable_template_campaign_loop_donation_stats_print( $campaign ){
		echo charitus_charitable_template_campaign_loop_donation_stats( $campaign );
	}
}



/**
 * Campaign progress bar
 */

if( !function_exists('charitus_charitable_template_campaign_loop_more_link') ){
	function charitus_charitable_template_campaign_loop_more_link( $campaign ){
		if( $campaign->has_ended() ){
			printf( '<a class="btn btn-border btn-lg" href="%s">%s</a>', esc_url(get_the_permalink()), esc_html( charitus_cs_get_option( 'donate_button_text_expired', esc_html__( 'Details', 'charitus' ) ) ) );
		}
	}
}

/**
 * Show campaign update bellow the campaign summary
 */

if( !function_exists('charitus_get_campaign_update') ){
	function charitus_get_campaign_update(){

		global $post;
		$updates = get_post_meta( $post->ID, '_campaign_updates', true );
		$content = '';

		if( class_exists('Charitable_Simple_Updates') && $updates ){
			$content .= '<div class="charitus-campaign-updates shadow charitus-shadow-padding">';
			$content .= sprintf( '<h3 class="charitus-campaign-updates-title">%s</h3>', charitus_cs_get_option( 'campaign_updates_title', 'Campaign Updates:' ) );
			$content .= do_shortcode( '[campaign_updates]' );
			$content .= '</div>';
		}

		return $content;
	}
}


/**
 * Campaign video width
 */

if( !function_exists('charitus_campaign_video_width') ){
	function charitus_campaign_video_width( $args ){
		
		$args['width'] = charitus_cs_get_option( 'campaign_video_width', 710 );

		return $args;
	}
	add_filter( 'charitable_campaign_video_embed_args', 'charitus_campaign_video_width' );
}


/**
 * count number of donations for a campaign
 */

if(!function_exists('charitus_donation_meta_info')){
	function charitus_donation_meta_info( $campaign ){

		$count_campaign_donations = charitable_get_table( 'campaign_donations' )->get_donations_report( array( 'campaign_id' => $campaign->ID, 'status' => 'charitable-completed' ) );

		if( !empty($count_campaign_donations) ){
			$count_campaign_donations = count($count_campaign_donations);
		}else{
			$count_campaign_donations = '';
		}

		if( $count_campaign_donations == '' ){
			$count_campaign_donation_ending = esc_html__( 'No donation yet', 'charitus' );
		}elseif( $count_campaign_donations == 1 ){
			$count_campaign_donation_ending = esc_html__( ' Donation', 'charitus' );
		}else{
			$count_campaign_donation_ending = esc_html__( ' Donations', 'charitus' );
		}

		$campaignp_location = '';

		if( function_exists( 'charitable_geolocation_template_campaign_loop_location' ) ){
		
			$campaignp_location = get_post_meta( $campaign->ID, '_campaign_location', true );
		}

		?>
			<div class="charitus-campaign-meta">
				<?php if( cs_get_option('show_campaign_creation_date') == true ): ?><div class="campaign-creation-date"><i class="lnr lnr-calendar-full"></i> <?php echo esc_html( get_the_date( 'M Y' ) ); ?></div><?php endif;?>

				<?php if( cs_get_option('show_campaign_donation_count') == true ): ?><div class="campaign-donation-count"><i class="lnr lnr-heart"></i> <?php echo esc_html( $count_campaign_donations . apply_filters( 'charitus_campaign_donation_count_ending', $count_campaign_donation_ending, $count_campaign_donations ) ); ?></div><?php endif;?>

				<?php if( function_exists( 'charitable_geolocation_template_campaign_loop_location' ) && cs_get_option('show_campaign_location') == true && $campaignp_location != '' ): ?>
					<div class="campaign-location-wrapper"><i class="lnr lnr-map-marker"></i> <?php esc_html( charitable_geolocation_template_campaign_loop_location( $campaign ) ); ?></div>	
				<?php endif; ?>	

			</div>
		<?php
	}
}


/**
 * Campaign post type archive
 */

if(!function_exists('charitus_charitable_campaign_post_type_archive_enable')){
	add_filter( 'charitable_campaign_post_type', 'charitus_charitable_campaign_post_type_archive_enable' );

	function charitus_charitable_campaign_post_type_archive_enable( $args ){
		$args['has_archive'] = true;

		return $args;
	}
}

/**
 * Content area class for single campaign
 */

add_filter( 'charitus_content_area_class', 'charitus_campaign_content_area_class' );
if(!function_exists('charitus_campaign_content_area_class')){
	function charitus_campaign_content_area_class ( $class ) {

		global $post;

		if( is_singular( 'campaign' ) || is_post_type_archive('campaign') ){

			$campaign_layout = charitus_cs_get_option('campaign_layout', 'right');

			if( $campaign_layout == 'right' ){
				$class = 'col-md-8';
			}elseif ( $campaign_layout == 'left' ) {
				$class = 'col-md-8 col-md-push-4';
			}elseif( $campaign_layout = 'full_width' ){
				$class = 'col-md-12';
			}

		}

		if( charitus_charitable_is_page( 'donation_receipt_page' ) ){
			$class = 'col-md-12';
		}

		if( $post->post_name == 'charitable-ghost-forgot-password-page' ){
			$class = 'page_no_sidebar';
		}

		return $class;
	}
}


/**
 * Campaign Widget area class
 */

add_filter( 'charitus_widget_area_class', 'charitus_campaign_widget_area_class' );
if(!function_exists('charitus_campaign_widget_area_class')){
	function charitus_campaign_widget_area_class ( $class ) {
		
		if( is_singular( 'campaign' ) || is_post_type_archive('campaign') ){

			$campaign_layout = charitus_cs_get_option('campaign_layout', 'right');

			if( $campaign_layout == 'right' ){
				$class = 'col-md-4';
			}elseif ( $campaign_layout == 'left' ) {
				$class = 'col-md-4 col-md-pull-8';
			}elseif( $campaign_layout = 'full_width' ){
				$class = '';
			}

		}
		
		return $class;

	}
}

/**
 * Campaign Page Title
 */


add_filter( 'xt_theme_page_title', 'charitus_campaign_page_title' );

if(!function_exists('charitus_campaign_page_title')){
	function charitus_campaign_page_title( $title ){

		$campaign_page_title = charitus_cs_get_option( 'campaign_page_title', esc_html__('Campaigns', 'charitus') );

		if( is_singular( 'campaign' ) || is_post_type_archive('campaign') ){
			$title = esc_html( $campaign_page_title );
		}

		return $title;
	}
}