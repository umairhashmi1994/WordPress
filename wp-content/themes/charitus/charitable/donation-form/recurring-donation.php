<?php
/**
 * The template used to display the recurring donation amount inputs.
 *
 * @author  Kathy Darling
 * @since   1.0.0
 * @version 1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! isset( $view_args[ 'form' ] ) ) {
	return;
}

/**
 * @var Charitable_Donation_Form
 */
$form = $view_args[ 'form' ];
$campaign = $form->get_campaign();

$donation = charitable_get_session()->get_donation_by_campaign( $campaign->ID );
$is_recurring   = is_array( $donation ) && isset( $donation['donation_period'] ) && 'month' == $donation['donation_period'] ? true : false;

/**
 * @hook    charitable_donation_form_before_recurring_donation_option
 */
do_action( 'charitable_donation_form_before_recurring_donation_option', $view_args[ 'form' ] ); ?>

<?php if ( charitable_recurring_campaign_supports_one_time_donations( $campaign ) ) : ?>
    <ul class="recurring-donation recurring-donation-options">    
    	<li class="one-time-donation recurring-donation-option">
    		<label for="recurring-form-<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() );?>-once">
    			<input id="recurring-form-<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() );?>-once" type="radio" data-form_id="<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() ); ?>" name="recurring_donation" value="once" <?php echo checked( $is_recurring );?>>
    			<?php esc_html_e( 'One Time Donation', 'charitus' );?>
            </label>    
    	</li>    
        <li class="monthly-donation recurring-donation-option">
            <label for="recurring-form-<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() );?>-recurring">
            	<input id="recurring-form-<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() );?>-recurring" type="radio" data-form_id="<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() ); ?>"  name="recurring_donation" value="month" <?php echo checked( $is_recurring );?>>
            	<?php esc_html_e( 'Monthly Donation', 'charitus' );?>
            </label>    
        </li>
    </ul>
<?php else : ?>
    <input id="recurring-form-<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() );?>-recurring" type="hidden" data-form_id="<?php echo esc_attr( $view_args[ 'form' ]->get_form_identifier() ); ?>"  name="recurring_donation" value="month" />
<?php endif ?>

<?php 
/**
 * @hook    charitable_donation_form_after_recurring_donation_option
 */
do_action( 'charitable_donation_form_after_recurring_donation_option', $view_args[ 'form' ]); ?>