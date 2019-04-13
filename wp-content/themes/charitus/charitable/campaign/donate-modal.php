<?php
/**
 * Displays the donate button to be displayed on campaign pages.
 *
 * @author  Studio 164a
 * @since   1.0.0
 * @version 1.3.2
 */

$campaign = $view_args['campaign'];

?>
<div class="campaign-donation">
	<a data-trigger-modal="charitable-donation-form-modal"
		class="donate-button button btn btn-fill btn-lg"
		href="<?php echo esc_url( charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ) ?>" 
		aria-label="<?php printf( esc_attr_x( 'Make a donation to %s', 'make a donation to campaign', 'charitus' ), esc_html( get_the_title( $campaign->ID ) ) ) ?>">
	<?php esc_html_e( 'Donate', 'charitus' ) ?>
	</a>
</div>
