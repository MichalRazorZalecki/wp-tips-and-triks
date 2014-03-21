<?php
/**
* WP Tips and Triks
*
* WP Tips and Triks collects useful tips and triks for WordPress programmers.
*
* @package WP Tips and Triks
* @author Michał Załęcki <michal@zalecki.pl>
* @license GPL-2.0+
* @link http://example.com
* @copyright 2014 Michał Załęcki
*
* @wordpress-plugin
* Plugin Name: WP Tips and Triks
* Plugin URI: @TODO
* Description: WP Tips and Triks collects useful tips and triks for WordPress programmers.
* Version: 1.0.0
* Author: Michał Załecki
* Author URI: http://michal.zalecki.pl
* Text Domain: wp-tips-and-triks
* License: GPL-2.0+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Domain Path: /languages
* GitHub Plugin URI: https://github.com/MichalRazorZalecki/wp-tips-and-triks/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) )
	die;

/**
 * Include tips and triks.
 */
require_once( plugin_dir_path( __FILE__ ) . 'include/tips-and-triks.php' );