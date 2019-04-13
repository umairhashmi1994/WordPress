<?php 
/**
 * Displays the donation details.
 *
 * Override this template by copying it to yourtheme/charitable/donation-receipt/details.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Donation Receipt
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * @var     Charitable_Donation
 */
$donation = $view_args[ 'donation' ];

?>
<h3 class="charitable-header"><?php esc_html_e( 'Your Donation', 'charitus' ) ?></h3>
<table class="donation-details charitable-table table table-bordered">
    <thead>
        <tr>
            <th><?php esc_html_e( 'Campaign', 'charitus' ) ?></th>
            <th><?php esc_html_e( 'Total', 'charitus' ) ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ( $donation->get_campaign_donations() as $campaign_donation ) : ?>
        <tr>
            <td class="campaign-name"><?php                 
                echo esc_html( $campaign_donation->campaign_name ); 

                /**
                 * @hook charitable_donation_receipt_after_campaign_name
                 */
                do_action( 'charitable_donation_receipt_after_campaign_name', $campaign_donation, $donation );
                
                ?>
            </td>
            <td class="donation-amount"><?php echo charitable_format_money( $campaign_donation->amount ) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td><?php esc_html_e( 'Total', 'charitus' ) ?></td>
            <td><?php echo charitable_format_money( $donation->get_total_donation_amount() ) ?></td>
        </tr>
    </tfoot>
</table>