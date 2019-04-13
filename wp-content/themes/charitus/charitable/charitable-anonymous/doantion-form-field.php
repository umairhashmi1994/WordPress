<?php 
/**
 * Displays the checkbox to allow donors to remain anonymous on the donation form.
 *
 * Override this template by copying it to yourtheme/charitable/charitable-anonymous/doantion-form-field.php
 *
 * @author  Studio 164a
 * @package Charitable Anonymous/Templates/Donation Form
 * @since   1.1.0
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$ticked = isset( $_POST[ 'anonymous_donation' ] ) && $_POST[ 'anonymous_donation' ];
?>
<div id="charitable_field_anonymous_donation_wrapper" class="charitable-form-field charitable-form-field-checkbox">
	<label for="charitable_field_anonymous_donation">
	    <input id="charitable_field_anonymous_donation" type="checkbox" name="anonymous_donation" value="1" <?php checked( $ticked ) ?> />
	    <?php esc_html_e( 'I would like to make my donation anonymously.', 'charitus' ) ?>
    </label>
</div>