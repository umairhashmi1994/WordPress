<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package charitus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('ch-blog'); ?>>
	<div class="blog-inner item shadow">
	<?php if( has_post_thumbnail() && get_the_post_thumbnail_url() ) : ?>
		<div class="blog-banner">
			<?php
				if( is_single() ){
					the_post_thumbnail('charitus-blog-thumb', array('class' => 'img-responsive', 'alt' => get_the_title() ) );
				}else{
					printf( '<a href="%s">%s</a>', get_the_permalink(), get_the_post_thumbnail( get_the_id(), 'charitus-blog-thumb', array( 'class' => 'img-responsive', 'alt' => get_the_title() ) ) );
				}
			?>
			<span class="date"><?php echo get_the_date( 'd M' ); ?></span>
		</div>
	<?php endif; ?>	

		<div class="blog-content">
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php charitus_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					if( is_single() ){
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'charitus' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );
					}else{
						the_excerpt();
					}

					if( function_exists('charitus_bootstrap_link_pages') ){
						charitus_bootstrap_link_pages( array(
							'before' => '<nav class="xt_theme_paignation xt-theme-page-links">' . esc_html__( 'Pages:', 'charitus' ) . '<ul class="pager">',
							'after'  => '</ul></nav>',
						) );
					}else{
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'charitus' ),
							'after'  => '</div>',
						) );
					}
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer clearfix">
				<?php charitus_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
