<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package charitus
 */

get_header(); ?>

	<?php
		$post_type = false;
		if( isset($_GET['post_type']) ){
			$post_type = $_GET['post_type'];
		}
	?>
	<section id="primary" class="content-area <?php echo esc_attr( apply_filters( 'charitus_content_area_class', 'col-md-8' ) ); ?>">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				if( $post_type && $post_type == 'campaign' ){
					get_template_part( 'template-parts/content', 'campaign' );
				}else{
					get_template_part( 'template-parts/content', 'search' );
				}

			endwhile;

			charitus_wp_numeric_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php

if( charitus_charitable_is_page('campaign_donation_page') || is_post_type_archive( 'campaign' )){
	get_sidebar('campaign');
}else{
	get_sidebar();
}
get_footer();
