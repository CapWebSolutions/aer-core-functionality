<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/starter-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Don't Update Plugin
 *
 * @since 1.0.0
 *
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array  $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function be_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) ) {
		return $r; // Not a plugin update request. Bail immediately.
	}
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'be_core_functionality_hidden', 5, 2 );

// Enqueue / register needed scripts & styles
add_action( 'wp_enqueue_scripts', 'capweb_enqueue_needed_scripts', PHP_INT_MAX );
// add_action( 'admin_enqueue_scripts', 'CORE_FUNCTION_enqueue_needed_scripts' );
/**
 * Enqueue Needed Scripts
 * @since 1.0.0
 *
 * Enqueue scripts and styles needed by core functionality.
 *
 * @author Matt Ryan
 *
 * @param void
 * @return void
 */
function capweb_enqueue_needed_scripts() {
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/73b396df58.css' );
	wp_enqueue_style( 'aer-core-functionality', CORE_FUNCTION_URL . 'assets/css/core-functionality.css', array(), '1.0.0', true );
}


// Use shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Add Genesis theme support for WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );

// Remove theme and plugin editor links
add_action( 'admin_init','cws_hide_editor_and_tools' );
function cws_hide_editor_and_tools() {
	remove_submenu_page( 'themes.php','theme-editor.php' );
	remove_submenu_page( 'plugins.php','plugin-editor.php' );
}

// Add the filter and function, returning the widget title only if the first character is not "!"
// Author: Stephen Cronin
// Author URI: http://www.scratch99.com/
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else 
		return ( $widget_title );
}
/*
 * Prevent the Jetpack publicize connections from being auto-selected,
 * so you need to manually select them if you’d like to publicize something.
 * Source: http://jetpack.me/2013/10/15/ever-accidentally-publicize-a-post-that-you-didnt/
 */
add_filter( 'publicize_checkbox_default', '__return_false' );

// Re-enable links manager. Source: http://codex.wordpress.org/Links_Manager
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * Remove Menu Items
 *
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 */
function be_remove_menus() {
	global $menu;
	$restricted = array( __( 'Links' ) );
	// Example:
	// $restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end( $menu );
	while ( prev( $menu ) ) {
		$value = explode( ' ',$menu[ key( $menu ) ][0] );
		if ( in_array( $value[0] != null?$value[0]:'' , $restricted ) ) {unset( $menu[ key( $menu ) ] );}
	}
}
add_action( 'admin_menu', 'be_remove_menus' );

/**
 * Customize Admin Bar Items
 *
 * @since 1.0.0
 * @link http://wp-snippets.com/addremove-wp-admin-bar-links/
 */
function be_admin_bar_items() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'new-link', 'new-content' );
}
add_action( 'wp_before_admin_bar_render', 'be_admin_bar_items' );


/**
 * Customize Menu Order
 *
 * @since 1.0.0
 *
 * @param array $menu_ord. Current order.
 * @return array $menu_ord. New order.
 */
function be_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) { return true;
	}
	return array(
		'index.php', // this represents the dashboard link
		'edit.php?post_type=page', // the page tab
		'edit.php', // the posts tab
		'edit-comments.php', // the comments tab
		'upload.php', // the media manager
	);
}
add_filter( 'custom_menu_order', 'be_custom_menu_order' );
add_filter( 'menu_order', 'be_custom_menu_order' );

// Disable WPSEO columns on edit screen
add_filter( 'wpseo_use_page_analysis', '__return_false' );

//
// Force  IE to NOT use compatibility mode
// Ref: https://www.nutsandboltsmedia.com/how-to-create-a-custom-functionality-plugin-and-why-you-need-one/
add_filter( 'wp_headers', 'wsm_keep_ie_modern' );
function wsm_keep_ie_modern( $headers ) {
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
		$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
	}
		return $headers;
}
//
// * Customize search form input box text
// * Ref: https://my.studiopress.com/snippets/search-form/
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	// return esc_attr( 'Search my blog...' );
	return esc_attr( 'Search ' . get_bloginfo( $show = '', 'display' ) );
	get_permalink();
}

// We will make use of widget_title filter to 
//dynamically replace custom tags with html tags

add_filter( 'widget_title', 'accept_html_widget_title' );
function accept_html_widget_title( $mytitle ) { 

  // The sequence of String Replacement is important!!
  
	$mytitle = str_replace( '[link', '<a', $mytitle );
	$mytitle = str_replace( '[/link]', '</a>', $mytitle );
    $mytitle = str_replace( ']', '>', $mytitle );

	return $mytitle;
}

/**
 * AbbyERyan.com Writing Sample Post Type
 *
 * @package    Simple_Listing_Post_Type
 * @author     Robin Cornett <hello@robincornett.com>
 * @copyright  2020 Matt Ryan
 *
 */


 /**
 * load Writing Sample archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function aer_core_functionality_load_archive_template( $archive_template ) {
	if ( is_post_type_archive( 'writing-sample' ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/archive-writing-sample.php';
	}
	return $archive_template;
}

/**
 * load single writing-sample template
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
function aer_core_functionality_load_single_template( $single_template ) {
	if ( is_singular( 'writing-sample' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-writing-sample.php';
	}
	return $single_template;

}

/**
 * Template Parts with Display Posts Shortcode
 * @author Bill Erickson
 * @see https://www.billerickson.net/template-parts-with-display-posts-shortcode
 *
 * @param string $output, current output of post
 * @param array $original_atts, original attributes passed to shortcode
 * @return string $output
 */
function be_dps_template_part( $output, $original_atts ) {

	// Return early if our "layout" attribute is not specified
	if( empty( $original_atts['layout'] ) )
		return $output;
	ob_start();
	get_template_part( 'partials/dps', $original_atts['layout'] );
	$new_output = ob_get_clean();
	if( !empty( $new_output ) )
		$output = $new_output;
	return $output;
}
add_action( 'display_posts_shortcode_output', 'be_dps_template_part', 10, 2 );