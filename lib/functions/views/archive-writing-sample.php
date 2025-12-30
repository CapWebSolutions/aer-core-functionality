<?php
/**
 * Writing Sample Post Type: Archive/Taxonomy View
 *
 * @package    AbbyERyan.com Writings
 * @author     Cap Web Solutions
 * @copyright  2020 Matt Ryan
 *
 */

function aer_archive_writing_sample_info() {
	global $post;
	$prefix = '_aer-';
	$post_id = get_the_ID( $post->ID ); 
	$writing_sample_entry = '';

	$writing_sample_images = rwmb_meta( $prefix . 'sample-image', array( 'limit' => 1, 'sizes' => 'thumbnail' ) );
	$writing_sample_image = reset( $writing_sample_images );
// var_dump($writing_sample_image);
	$writing_sample_document_links = rwmb_meta( $prefix . 'sample-document', array( 'limit' => 1 ) );

	$writing_sample_document_link = reset( $writing_sample_document_links );

	$writing_sample_type = get_post_meta( $post_id, $prefix . 'sample-type', true );
	$writing_sample_url = get_post_meta( $post_id, $prefix . 'sample-url', true ); 
	// $writing_sample_document = get_post_meta( $post_id, $prefix . 'sample-document', true ); 

	$writing_sample_description = get_post_meta( $post_id, $prefix . 'sample-description', true );
	$writing_sample_excerpt = get_the_excerpt( $post_id );
	$writing_sample_content = get_the_content( '', true, $post_id );

	$writing_sample_publication = get_post_meta( $post_id, $prefix . 'publication', true );
	$writing_sample_terms = get_the_term_list( $post_id, 'category', '', ', ', '' );

	if( !empty( $writing_sample_url ) ) { 
		$writing_sample_entry .= sprintf('Link: <a href="%s" target="_blank">%s</a>', $writing_sample_url, $writing_sample_url ); 
	}

	If ( $writing_sample_image['url'] ) $writing_sample_entry = sprintf('<span class="alignright writing-sample-image"><img src="%s"></span>', $writing_sample_image['url'] );
	$writing_sample_entry  .= sprintf('<div>Type: %s</div>', $writing_sample_type ); 
	$writing_sample_entry .= sprintf('<div>Category: %s</div>', $writing_sample_terms );
	// $writing_sample_entry .= sprintf('<p>%s</p>', $writing_sample_content );
	$writing_sample_entry .= sprintf('<p class="writing-sample-description">%s</p>', $writing_sample_description );
	// $writing_sample_entry .= sprintf('<div class="writing-sample-pub">Publication: %s</div>', $writing_sample_publication );
	// $writing_sample_entry .= sprintf('<a href="%s" >Download %s</a>', $writing_sample_document_link['url'], $writing_sample_document_link['title'] ); 
	$writing_sample_entry .= sprintf('<p class="more-link-wrap"><a href="%s" class="more-link button text">Continue Reading<span class="screen-reader-text">about </span></a></p>', get_permalink( $post_id ) ); 
	

	printf( '<article class="writing-entry">%s</article>', $writing_sample_entry  );
}
