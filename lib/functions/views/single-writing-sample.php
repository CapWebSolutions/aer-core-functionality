<?php
/**
 * Writing Sample Post Type: Single View
 *
 * @package    AbbyERyan.com Writing Samples
 * @author     Cap Web Solutions
 * @copyright  2020 Matt Ryan
 *
 */

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

add_action( 'genesis_entry_header', 'aer_single_writing_sample_info', 10 );
function aer_single_writing_sample_info() {
	global $post;
	$prefix = '_aer-';
	$post_id = get_the_ID( $post->ID ); 
	$writing_sample_entry = '';

	$writing_sample_images = rwmb_meta( $prefix . 'sample-image', array( 'limit' => 1 ) );
	$writing_sample_image = reset( $writing_sample_images );

	// $writing_sample_content = get_the_excerpt( $post_id );
	// if ( empty($writing_sample_content) ) $writing_sample_content = get_post_meta( $post_id, $prefix . 'content', true );

	$writing_sample_type = get_post_meta( $post_id, $prefix . 'sample-type', true );
	$writing_sample_url = get_post_meta( $post_id, $prefix . 'sample-url', true ); 
	$writing_sample_document = get_post_meta( $post_id, $prefix . 'sample-document', true ); 
	$writing_sample_description = get_post_meta( $post_id, $prefix . 'sample-description', true ); 
	$writing_sample_publication = get_post_meta( $post_id, $prefix . 'publication', true );
	$writing_sample_terms = get_the_term_list( $post_id, 'category', '', ', ', '' );

	// echo '<img src="', $writing_sample_image['url'], '">';
	if( !empty( $writing_sample_type ) ) { 
		$writing_sample_entry .= sprintf('<div>Style of Sample: %s</div>', $writing_sample_type ); 
	}	
	// if( !empty( $writing_sample_url ) ) { 
	// 	$writing_sample_entry .= sprintf('Link to Sample: <a href="%s" target="_blank">%s</a>', $writing_sample_url, $writing_sample_url ); 
	// }
	if( !empty( $writing_sample_terms ) ) { 
		$writing_sample_entry .= sprintf('<div>Category: %s</div><br>', $writing_sample_terms ); 
	}
	if( !empty( $writing_sample_description ) ) { 
		$writing_sample_entry .= sprintf('<p>Description: %s</p>', $writing_sample_description ); 
	}

	// If ( $writing_sample_image['url'] ) $writing_sample_entry .= sprintf('<span class="alignleft writing-sample-image"><img src="%s"></span>', $writing_sample_image['url'] );

	// if( !empty( $writing_sample_document ) ) { 
	// 	$writing_sample_entry .= sprintf('Link to Sample: <a href="%s" target="_blank">%s</a>', $writing_sample_document, $writing_sample_url ); 
	// }

	printf( '<article class="writing-entry">%s</article>', $writing_sample_entry  );

}

genesis();