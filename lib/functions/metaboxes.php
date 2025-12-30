<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function aer_writing_samples_get_meta_box( $meta_boxes ) {
	$prefix = '_aer-';

	$meta_boxes[] = array(
		'id' => 'writingsample',
		'title' => esc_html__( 'Writing Sample Detail', 'abbyeryan' ),
		'post_types' => array('post', 'writing-sample'),
		'context' => 'advanced',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'sample-type',
				'type' => 'text',
				'name' => esc_html__( 'Type', 'abbyeryan' ),
				'desc' => esc_html__( 'Type of Writing Sample', 'abbyeryan' ),
			),
			array(
				'id' => $prefix . 'sample-url',
				'type' => 'url',
				'name' => esc_html__( 'Sample URL', 'abbyeryan' ),
				'desc' => esc_html__( 'Live Link to Writing Sample', 'abbyeryan' ),
			),

			array(
				'id' => $prefix . 'sample-description',
				'type' => 'textarea',
				'name' => esc_html__( 'Description', 'abbyeryan' ),
				'desc' => esc_html__( 'Description of this writing sample', 'abbyeryan' ),
				'rows' => 5,
			),
			array(
				'id' => $prefix . 'publication',
				'type' => 'text',
				'name' => esc_html__( 'Publication', 'abbyeryan' ),
				'desc' => esc_html__( 'Name of Publication in which Sample Appeared', 'abbyeryan' ),
			),
			array(
				'id' => $prefix . 'sample-document',
				'type' => 'file_advanced',
				'name' => esc_html__( 'Document', 'abbyeryan' ),
				'desc' => esc_html__( 'Document from Media Library', 'abbyeryan' ),
				'max_file_uploads' => 1,
			),
			array(
				'id' => $prefix . 'sample-image',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Image of Writing Sample', 'abbyeryan' ),
				'desc' => esc_html__( 'Image from Media Library', 'abbyeryan' ),

			),
		),
	);
 
	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'aer_writing_samples_get_meta_box' );