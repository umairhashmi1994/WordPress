<?php
/**
 * HTML output for a single campaign map marker.
 *
 * @package Charitable Geolocation/Templates
 * @author  Studio 164a
 * @since   1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

?>
<div class="charitable-campaign-map-marker">
	<h3><a href="{link}">{title}</a></h3>
	<div class="charitus-map-campaign-content-area">
		<img src="{thumbnail}" alt="{title}" />
		<div class="campaign-description"><?php echo wpautop( '{description}' ) ?></div>
	</div>
</div>
