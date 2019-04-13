<?php
/**
 * The template for displaying campaign content within loops.
 *
 * Override this template by copying it to yourtheme/charitable/campaign-loop/campaign.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Campaign
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$campaign = charitable_get_current_campaign();

?>
<li id="campaign-<?php echo esc_attr( get_the_ID() ) ?>" <?php post_class( array( 'ch-causes' ) ) ?>>
<?php
	/**
	 * @hook charitable_campaign_content_loop_before
	 */
	do_action( 'charitable_campaign_content_loop_before', $campaign, $view_args );

	?>
	
	<a href="<?php esc_url( get_the_permalink()); ?>">
		<?php
			/**
			 * @hook charitable_campaign_content_loop_before_title
			 */
			do_action( 'charitable_campaign_content_loop_before_title', $campaign, $view_args );
		?>
	</a>

	<div class="cause-inner-content">
		<a class="campaign-title" href="<?php esc_url( get_the_permalink()); ?>">
			<?php the_title( '<h3>', '</h3>' ); ?>

			<?php
				/**
				 * @hook charitable_campaign_content_loop_after_title
				 */
				do_action( 'charitable_campaign_content_loop_after_title', $campaign, $view_args );
			?>
		</a>

		<?php

			/**
			 * @hook charitable_campaign_content_loop_after
			 */
			do_action( 'charitable_campaign_content_loop_after', $campaign, $view_args );
		?>
	</div>
</li>
