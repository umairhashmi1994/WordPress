<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package charitus
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( apply_filters( 'charitus_content_area_class', 'col-md-8' ) ); ?>">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

if( is_page() ){
	$page_sidebar_enable = charitus_get_post_meta( '_xt_page_side_options', 'page_sidebar_enable', false, true );
	if( $page_sidebar_enable == true ){
		get_sidebar();
	}
}

if( charitus_charitable_is_page('campaign_donation_page') ){
	get_sidebar('campaign');
}

if( is_singular('tribe_events') || is_post_type_archive('tribe_events') ){
	get_sidebar('events');
}

get_footer();
