<?php
/*
Plugin Name: School ERP Manager
Description: Complete School ERP System
Version: 2.0
Author: Roshan Sharma
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Includes
require_once plugin_dir_path(__FILE__) . 'includes/activation.php';
require_once plugin_dir_path(__FILE__) . 'includes/database.php';
require_once plugin_dir_path(__FILE__) . 'includes/roles.php';
require_once plugin_dir_path(__FILE__) . 'includes/permissions.php';
require_once plugin_dir_path(__FILE__) . 'includes/pages.php';
require_once plugin_dir_path(__FILE__) . 'includes/notices.php';
require_once plugin_dir_path(__FILE__) . 'includes/attendance.php';
require_once plugin_dir_path(__FILE__) . 'includes/redirects.php';
register_activation_hook( __FILE__, 'school_erp_activate' );