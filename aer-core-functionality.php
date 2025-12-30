<?php
/**
 * Plugin Name: AbbyERyan.com  Core Functionality
 * Plugin URI: https://github.com/CapWebSolutions/aer-core-functionality
 * Description: This contains all this site's core functionality so that it is theme independent. 
 * Version: 2.0.0
 * Author: Cap Web Solutions
 * Author URI: https://capwebsolutions.com
 * Github Plugin URI: https://github.com/CapWebSolutions/aer-core-functionality/

 *
 * @package      Core_Functionality
 * @since        1.0.0
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

  // Exit if accessed directly.
  defined( 'ABSPATH' ) || exit;

  // Plugin Directory. Set constant so we know where we are installed.
  $plugin_url = plugin_dir_url( __FILE__ );
  define( 'CORE_FUNCTION_URL', $plugin_url );
  define( 'CORE_FUNCTION_DIR', plugin_dir_path( __FILE__ ) );

// General. This should always be used. 
// include_once( CORE_FUNCTION_DIR . '/lib/functions/general.php' );

// Define needed Custom Post Types.
include_once( CORE_FUNCTION_DIR . '/lib/functions/post-types.php' );

// Define Custom Meta boxes.
include_once( CORE_FUNCTION_DIR . '/lib/functions/metaboxes.php' );

// Set up templates for new post type
// add_filter( 'archive_template', 'aer_core_functionality_load_archive_template' );
// add_filter( 'single_template', 'aer_core_functionality_load_single_template' );