<?php
/**
 * Displays the donate button to be displayed on campaign pages.
 *
 * Override this template by copying it to yourtheme/charitable/campaign-loop/donate-modal.php
 *
 * @author  Studio 164a
 * @since   1.2.3
 * @version 1.3.2
 */

$campaign = $view_args['campaign'];

?>
<div class="campaign-donation">
	<a data-trigger-modal="charitable-donation-form-modal-loop"
		data-campaign-id="<?php echo esc_attr( $campaign->ID ) ?>"
		class="donate-button button btn btn-fill btn-lg" 
		href="<?php echo esc_url( charitable_get_permalink( 'campaign_donation_page', array( 'campaign_id' => $campaign->ID ) ) ) ?>" 
		aria-label="<?php echo esc_attr( sprintf( esc_html_x( 'Make a donation to %s', 'make a donation to campaign', 'charitus' ), esc_html( get_the_title( $campaign->ID ) ) ) ) ?>">
		<?php esc_html_e( 'Donate', 'charitus' ) ?>
	</a>
</div>
