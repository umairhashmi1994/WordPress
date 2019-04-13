<?php
/**
 * Displays the donation summary.
 *
 * Override this template by copying it to yourtheme/charitable/donation-receipt/summary.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Donation Receipt
 * @since   1.0.0
 * @version 1.4.7
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * @var     Charitable_Donation
 */
$donation = $view_args['donation'];

?>
<dl class="donation-summary row">
	<dt class="col-sm-3 donation-id"><?php esc_html_e( 'Donation Number:', 'charitus' ) ?></dt>
	<dd class="col-sm-9 donation-summary-value"><?php echo esc_html( $donation->get_number() ) ?></dd>
	<dt class="col-sm-3 donation-date"><?php esc_html_e( 'Date:', 'charitus' ) ?></dt>
	<dd class="col-sm-9 donation-summary-value"><?php echo esc_html( $donation->get_date() ) ?></dd>
	<dt class="col-sm-3 donation-total"> <?php esc_html_e( 'Total:', 'charitus' ) ?></dt>
	<dd class="col-sm-9 donation-summary-value"><?php echo charitable_format_money( $donation->get_total_donation_amount() ) ?></dd>
	<dt class="col-sm-3 donation-method"><?php esc_html_e( 'Payment Method:', 'charitus' ) ?></dt>
	<dd class="col-sm-9 donation-summary-value"><?php echo esc_html( $donation->get_gateway_label() ) ?></dd>
</dl>
