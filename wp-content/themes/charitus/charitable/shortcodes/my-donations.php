<?php
/**
 * Displays a table of the user's donations, with links to the donation receipts.
 *
 * Override this template by copying it to yourtheme/charitable/shortcodes/my-donations.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Account
 * @since   1.4.0
 * @version 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$donations = $view_args['donations'];

/**
 * @hook    charitable_my_donations_before
 */
do_action( 'charitable_my_donations_before', $donations );

if ( empty( $donations ) ) : ?>

	<p><?php esc_html_e( 'You have not made any donations yet.', 'charitus' ) ?></p>

<?php else : ?>

	<table class="charitable-creator-donations table table-bordered">
		<thead>
			<tr>
				<th scope="col"><?php esc_html_e( 'Date', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Campaign', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Amount', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Receipt', 'charitus' ) ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $donations as $donation ) : ?>
			<tr>
				<td><?php echo esc_html( mysql2date( 'F j, Y', get_post_field( 'post_date', $donation->ID ) ) ) ?></td>
				<td><?php echo esc_html( $donation->campaigns ) ?></td>
				<td><?php echo charitable_format_money( $donation->amount ) ?></td>
				<td><a href="<?php echo esc_url( charitable_get_permalink( 'donation_receipt_page', array( 'donation_id' => $donation->ID ) ) ) ?>"><?php esc_html_e( 'View Receipt', 'charitus' ) ?></a></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

<?php endif;

/**
 * @hook    charitable_my_donations_after
 */
do_action( 'charitable_my_donations_after', $donations );
