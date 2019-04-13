<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package charitus
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( apply_filters( 'charitus_content_area_class', 'col-md-8' ) ); ?>">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if( get_post_type() == 'post' ){

				if( function_exists('charitus_post_tags_and_share_link') ){
					charitus_post_tags_and_share_link();
				}else{
					the_tags( '<div class="charitus-blog-tags-n-share shadow">' . esc_html__( 'Tags: ', 'charitus' ), ', ', '</div>' );
				}
			}
			
			if( get_post_type() == 'post' &&  cs_get_option('blog_author_bio') == 'on' ){
				charitus_get_author_bio();
			}

			if( get_post_type() == 'post' &&  cs_get_option('blog_post_nav') == 'on' ){
				printf( '<div class="shadow charitus-navigation-wrapper">%s</div>', get_the_post_navigation(array(
				    'prev_text'=>esc_html__( 'Previous', 'charitus' ),
				    'next_text'=>esc_html__( 'Next', 'charitus' ),
				)));
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
