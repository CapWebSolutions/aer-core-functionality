<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/aer-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2020, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function aer_register_core_post_type() {

$args = array (
	'label' => esc_html__( 'Writing Samples', 'abbyeryan' ),
	'labels' => array(
		'menu_name' => esc_html__( 'Writing Samples', 'abbyeryan' ),
		'name_admin_bar' => esc_html__( 'Writing Sample', 'abbyeryan' ),
		'add_new' => esc_html__( 'Add new', 'abbyeryan' ),
		'add_new_item' => esc_html__( 'Add new Writing Sample', 'abbyeryan' ),
		'new_item' => esc_html__( 'New Writing Sample', 'abbyeryan' ),
		'edit_item' => esc_html__( 'Edit Writing Sample', 'abbyeryan' ),
		'view_item' => esc_html__( 'View Writing Sample', 'abbyeryan' ),
		'update_item' => esc_html__( 'Update Writing Sample', 'abbyeryan' ),
		'all_items' => esc_html__( 'All Writing Samples', 'abbyeryan' ),
		'search_items' => esc_html__( 'Search Writing Samples', 'abbyeryan' ),
		'parent_item_colon' => esc_html__( 'Parent Writing Sample', 'abbyeryan' ),
		'not_found' => esc_html__( 'No Writing Samples found', 'abbyeryan' ),
		'not_found_in_trash' => esc_html__( 'No Writing Samples found in Trash', 'abbyeryan' ),
		'name' => esc_html__( 'Writing Samples', 'abbyeryan' ),
		'singular_name' => esc_html__( 'Writing Sample', 'abbyeryan' ),
	),
	'public' => true,
	'description' => 'Writing Sample',
	'exclude_from_search' => false,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_nav_menus' => true,
	'show_in_menu' => true,
	'show_in_admin_bar' => true,
	'show_in_rest' => true,
	'menu_position' => 6,
	'menu_icon' => 'dashicons-welcome-write-blog',
	'capability_type' => 'post',
	'hierarchical' => false,
	'has_archive' => true,
	'query_var' => true,
	'can_export' => true,
	'rewrite_no_front' => false,
	'supports' => array(
		'title',
		'editor',
		// 'thumbnail',
		// 'excerpt',
		'genesis-cpt-archives-settings',
	),
	'taxonomies' => array(
		'category',
		'post_tag',
	),
	'rewrite' => true,
);

register_post_type( 'writing-sample', $args );
}
add_action( 'init', 'aer_register_core_post_type' );