<?php
/**
 * The template used to display the login form. Provided here primarily as a way to make
 * it easier to override using theme templates.
 *
 * Override this template by copying it to yourtheme/charitable/shortcodes/login.php
 *
 * @author  Eric Daams
 * @package Charitable/Templates/Account
 * @since   1.0.0
 * @version 1.4.2
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$login_form_args = array_key_exists( 'login_form_args', $view_args ) ? $view_args['login_form_args'] : array();

?>
<div class="row">
	<div class="charitable-login-form col-md-6 col-md-offset-3">
		<div class="charitable-login-form-inner shadow charitus-shadow-padding">
			<?php

			/**
			 * @hook    charitable_login_form_before
			 */
			do_action( 'charitable_login_form_before' );

			wp_login_form( $login_form_args );

			?>
			<p>
				<?php if ( array_key_exists( 'registration_link', $view_args ) && $view_args['registration_link'] ) : ?>
					<a href="<?php echo esc_url( $view_args['registration_link'] ) ?>"><?php echo esc_html( $view_args['registration_link_text'] ) ?></a>&nbsp;|&nbsp;
				<?php endif ?>
				<a href="<?php echo esc_url( charitable_get_permalink( 'forgot_password_page' ) ) ?>"><?php esc_html_e( 'Forgot Password', 'charitus' ) ?></a>
			</p>
			<?php

			/**
			 * @hook    charitable_login_form_after
			 */
			do_action( 'charitable_login_form_after' )

			?>
		</div>
	</div>
</div>