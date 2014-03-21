<?php

/**
 * Clean up the header.
 *
 * @since 1.0.0
 * @link https://gist.github.com/scottlyttle/4701366
 */
function wptat_clean_up_header() {
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
}
add_action('init', 'wptat_clean_up_header');

/**
 * Replace the standard WordPress logo with our logo
 *
 * @since 1.0.0
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
 */
function wptat_custom_login_logo() {
	echo '<style type="text/css">
	.login h1 a {
		/* 64x64 */
		background-image:url(' . plugins_url( 'img/login.png' , __DIR__ ) . ') !important;
	}
</style>';
}
add_action('login_head', 'wptat_custom_login_logo');

/**
 * Display message on the WordPress Log In page.
 *
 * @since 1.0.0
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/login_message
 */
function wptat_the_login_message( $message ) {
    if ( empty($message) ){
        return '<p class="message">' . __('Welcome to this site. Please log in to continue.', 'wp-tips-and-triks') . '</p>';
    } else {
        return $message;
    }
}
add_filter( 'login_message', 'wptat_the_login_message' );

/**
 * Set custom excerpt length.
 *
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function wptat_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wptat_excerpt_length', 999 );

/**
 * Change excerpt more string.
 *
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function wptat_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wptat_excerpt_more' );
