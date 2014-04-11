<?php

/**
 * Clean up the header.
 *
 * @since 1.1.0
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
 * @since 1.1.0
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
 * @since 1.1.0
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
 * @since 1.1.0
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function wptat_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wptat_excerpt_length', 999 );

/**
 * Change excerpt more string.
 *
 * @since 1.1.0
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
function wptat_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wptat_excerpt_more' );

/**
 * Customize the contact information fields.
 *
 * @since 1.2.0
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
 */
function wptat_contactmethods( $user_contact ) {
	// Add Twitter
	if ( !isset( $user_contact['twitter'] ) )
		$user_contact['twitter'] = 'Twitter';

	// Add Twitter
	if ( !isset( $user_contact['facebook'] ) )
		$user_contact['facebook'] = 'Facebook';

	// Add Google+
	if ( !isset( $user_contact['gplus'] ) )
		$user_contact['gplus'] = 'Google+';

	// Remove user contact methods
	/* http://premium.wpmudev.org/blog/remove-aim-yahoo-and-jabber-fields-from-the-wordpress-profile-page/ */
	// unset($user_contact['jabber']);
	// unset($user_contact['aim']);
	// unset($user_contact['yim']);

	return $user_contact;
}
add_filter( 'user_contactmethods', 'wptat_contactmethods', 10, 1 );

/**
 * Change the link values so the logo links to your WordPress site.
 *
 * @since 1.2.0
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 */
function wptat_login_logo_url( $user_contact ) {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'wptat_login_logo_url' );

/**
 * Change the link title so the logo displays your WordPress title.
 *
 * @since 1.2.0
 * @link https://codex.wordpress.org/Customizing_the_Login_Form
 */
function wptat_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'wptat_login_logo_url_title' );

/**
 * Template tag for displaying title with or without link inside.
 *
 * @since 1.2.0
 * @link http://codex.wordpress.org/Function_Reference/the_title
 */
function wptat_the_title() {
	if ( is_single() )
		the_title( '<h1 class="post__title">', '</h1>' );
	else
		the_title( '<h1 class="post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
}

/**
 * Template tag for displaying title with or without link inside.
 *
 * @since 1.2.0
 * @link https://codex.wordpress.org/Function_Reference/post_class
 */
function wptat_post_class( $classes ) {
    if ( has_post_thumbnail() )
    	$classes[] = 'has-thumbnail';
    else
    	$classes[] = 'no-thumbnail';
    return $classes;
}
add_filter('post_class', 'wptat_post_class');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since 1.2.0
 * @link https://codex.wordpress.org/Function_Reference/body_class
 */
function wptat_body_class( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'multi-author-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'wptat_body_class' );