<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package educationpress
 */

get_header(); ?>
	<div id="primary" class="content-area <?php echo esc_attr( apply_filters( 'charitus_content_area_class', 'col-md-8' ) ); ?>">
		<main id="main" class="site-main">

			<section class="error-404 not-found shadow charitus-shadow-padding clearfix">
				<header class="ch-page-header">
					<h1 class="page-title"><?php esc_html_e( '404 Not Found', 'charitus' ) ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'The page you are looking for no longer exists. Perhaps you can return
					back to the site\'s homepage and see if you can find what you are looking for. Or, you can try finding
					it with the information below.', 'charitus' ); ?></p>
					<div class="ch-back-top-home-btn">
						<a class="btn btn-fill btn-lg" href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( 'Back to home', 'charitus' ) ?></a>
					</div>
				</div><!-- .page-content -->

				<div class="ch-404-search-form">
					<?php get_search_form(); ?>
				</div>

				<div class="ch-404-additional-info row">

					<div class="col-md-6 ch-404-additional-info-item">
						<?php the_widget( 'WP_Widget_Recent_Posts', '', 'before_title=<h2 class="widget-title">' ); ?>
					</div>

					<?php
						// Only show the widget if site has multiple categories.
						if ( charitus_categorized_blog() ) :
					?>

						<div class="col-md-6 ch-404-additional-info-item">
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'charitus' ); ?></h2>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 5,
									) );
								?>
								</ul>
							</div><!-- .widget -->
						</div><!-- .widget -->

					<?php endif; ?>
				</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
