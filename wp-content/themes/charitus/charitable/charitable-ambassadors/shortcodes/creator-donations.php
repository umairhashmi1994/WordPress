<?php
/**
 * The template used to display the donations received by the user.
 *
 * Override this template by copying it to yourtheme/charitable/charitable-ambassadors/shortcodes/creator-donations.php
 *
 * @author  Studio 164a
 * @since   1.1.0
 * @version 1.1.0
 */

$user = new Charitable_User( wp_get_current_user() );

$campaigns = $user->get_campaigns( array(
	'posts_per_page' => -1,
	'post_status' => array( 'future', 'publish' ),
	'fields' => 'ids',
) );

if ( ! $campaigns->have_posts() ) : ?>

	<p class="no-campaigns alert alert-warning"><?php esc_html_e( 'You have not created any campaigns yet.', 'charitus' ) ?></p>

<?php return;
endif;

$donations = charitable_get_table( 'campaign_donations' )->get_donations_report( array(
	'campaign_id' => $campaigns->posts,
	'orderby' => 'date',
	'order' => 'DESC',
) );

charitable_ambassadors_enqueue_styles();

/**
 * @hook    charitable_creator_donations_before
 */
do_action( 'charitable_creator_donations_before', $donations );

if ( empty( $donations ) ) : ?>

	<p><?php esc_html_e( 'You have not received any donations yet.', 'charitus' ) ?></p>

<?php else : ?>

	<table class="charitable-creator-donations table table-bordered">
		<thead>
			<tr>
				<th scope="col"><?php esc_html_e( 'Date', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Donor', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Campaign', 'charitus' ) ?></th>
				<th scope="col"><?php esc_html_e( 'Amount', 'charitus' ) ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $donations as $donation ) : ?>
			<tr>
				<td><?php echo esc_html( mysql2date( 'l, F j, Y', $donation->post_date ) ) ?></td>
				<td><?php echo esc_html( trim( "{$donation->first_name} {$donation->last_name}" ) ) ?></td>
				<td><?php echo esc_html( $donation->campaign_name ) ?></td>
				<td><?php echo charitable_format_money( $donation->amount ) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

<?php endif;

/**
 * @hook    charitable_creator_donations_after
 */
do_action( 'charitable_creator_donations_after', $donations );
