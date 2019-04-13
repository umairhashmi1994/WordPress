<?php 
/**
 * Displays the checkbox to allow donors to opt in to the newsletter on the donation form.
 *
 * Override this template by copying it to yourtheme/charitable/charitable-newsletter-connect/donation-form-field.php
 *
 * @author  Studio 164a
 * @package Charitable Newsletter Connect/Templates/Donation Form
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$ticked = isset( $_POST[ 'newsletter_opt_in' ] ) && $_POST[ 'newsletter_opt_in' ];

?>
<div id="charitable_field_newsletter_opt_in_wrapper" class="charitable-form-field charitable-form-field-checkbox">
    <label for="charitable_field_newsletter_opt_in">
    	<input id="charitable_field_newsletter_opt_in" type="checkbox" name="newsletter_opt_in" value="1" <?php checked( $ticked ) ?> />
    	<?php echo esc_html( $view_args[ 'label' ] ) ?>
    </label>
</div>
