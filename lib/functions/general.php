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
 * load Writing Sample archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
// function aer_core_functionality_load_archive_template( $archive_template ) {
// 	if ( is_post_type_archive( 'writing-sample' ) ) {
// 		$archive_template = dirname( __FILE__ ) . '/views/archive-writing-sample.php';
// 	}
// 	return $archive_template;
// }

/**
 * load single writing-sample template
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
// function aer_core_functionality_load_single_template( $single_template ) {
// 	if ( is_singular( 'writing-sample' ) ) {
// 		$single_template = dirname( __FILE__ ) . '/views/single-writing-sample.php';
// 	}
// 	return $single_template;

// }

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