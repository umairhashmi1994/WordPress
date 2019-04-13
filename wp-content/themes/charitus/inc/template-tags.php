<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package charitus
 */

if ( ! function_exists( 'charitus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function charitus_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'charitus' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'charitus' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'charitus_categorized_blog' ) ){
	function charitus_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'charitus_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'charitus_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so charitus_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so charitus_categorized_blog should return false.
			return false;
		}
	}
}




if ( ! function_exists( 'charitus_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the read more link & post edit.
 */
function charitus_entry_footer() {

	if ( 'post' === get_post_type() && !is_single() ) {

		$permalink = get_permalink();
		printf( '<a class="btn btn-border btn-primary btn-lg xt-btn-primary" href="%1$s">' . esc_html( apply_filters( 'xt_post_read_more_text', esc_html__( 'Read More', 'charitus' ) ) ) . '</a>', esc_url( $permalink ) );

	}elseif( 'campaign' === get_post_type() && !is_single() && function_exists('charitable_template_campaign_loop_donate_link') ){

		$campaign = charitable_get_campaign( get_the_ID() );
		charitable_template_campaign_loop_donate_link( $campaign, array() );
		
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'charitus' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link pull-right">',
		'</span>'
	);
}
endif;




/**
 * Flush out the transients used in charitus_categorized_blog.
 */
if ( ! function_exists( 'charitus_category_transient_flusher' ) ){
	function charitus_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'charitus_categories' );
	}
}
add_action( 'edit_category', 'charitus_category_transient_flusher' );
add_action( 'save_post',     'charitus_category_transient_flusher' );
