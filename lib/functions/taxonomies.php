<?php
/**
 * Taxonomies
 *
 * This file registers any custom taxonomies
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


function aer_register_taxonomy() {

	$args = array (
		'label' => esc_html__( 'Classifications', 'text-domain' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Classifications', 'text-domain' ),
			'all_items' => esc_html__( 'All Classifications', 'text-domain' ),
			'edit_item' => esc_html__( 'Edit Classification', 'text-domain' ),
			'view_item' => esc_html__( 'View Classification', 'text-domain' ),
			'update_item' => esc_html__( 'Update Classification', 'text-domain' ),
			'add_new_item' => esc_html__( 'Add new Classification', 'text-domain' ),
			'new_item_name' => esc_html__( 'New Classification', 'text-domain' ),
			'parent_item' => esc_html__( 'Parent Classification', 'text-domain' ),
			'parent_item_colon' => esc_html__( 'Parent Classification:', 'text-domain' ),
			'search_items' => esc_html__( 'Search Classifications', 'text-domain' ),
			'popular_items' => esc_html__( 'Popular Classifications', 'text-domain' ),
			'separate_items_with_commas' => esc_html__( 'Separate Classifications with commas', 'text-domain' ),
			'add_or_remove_items' => esc_html__( 'Add or remove Classifications', 'text-domain' ),
			'choose_from_most_used' => esc_html__( 'Choose most used Classifications', 'text-domain' ),
			'not_found' => esc_html__( 'No Classifications found', 'text-domain' ),
			'name' => esc_html__( 'Classifications', 'text-domain' ),
			'singular_name' => esc_html__( 'Classification', 'text-domain' ),
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'query_var' => true,
		'sort' => false,
		'rewrite' => array(
			'with_front' => false,
		),
	);

	register_taxonomy( 'classification', array( 'writing-sample' ), $args );
}
add_action( 'init', 'aer_register_taxonomy', 0 );