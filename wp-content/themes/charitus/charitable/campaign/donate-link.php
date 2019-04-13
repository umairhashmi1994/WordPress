<?php
/**
 * Displays the donate button to be displayed on campaign pages.
 *
 * Override this template by copying it to yourtheme/charitable/campaign/donate-link.php
 *
 * @author  Studio 164a
 * @since   1.0.0
 */

if ( ! array_key_exists( 'campaign', $view_args ) || ! is_a( $view_args['campaign'], 'Charitable_Campaign' ) ) :
	return;
endif;

$campaign = $view_args['campaign'];

if ( $campaign->has_ended() ) :
	return;
endif;

?>
<div class="campaign-donation">
	<a class="donate-button button btn btn-fill btn-lg" href="#charitable-donation-form" aria-label="<?php echo esc_attr( sprintf( esc_html_x( 'Make a donation to %s', 'make a donation to campaign', 'charitus' ), esc_html( get_the_title( $campaign->ID ) ) ) ) ?>"><?php esc_html_e( 'Donate', 'charitus' ) ?></a>
</div>
