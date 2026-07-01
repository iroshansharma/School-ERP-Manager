<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . '../admin/notice-page.php';
require_once plugin_dir_path(__FILE__) . '../admin/manage-notices.php';
require_once plugin_dir_path(__FILE__) . '../admin/class-notice-list-table.php';

function school_notice_menu(){

    add_menu_page(

        'Notice Board',

        'Notice Board',

        'manage_options',

        'notice-board',

        'notice_page_callback',

        'dashicons-megaphone',

        26

    );

    add_submenu_page(

        'notice-board',

        'Manage Notices',

        'Manage Notices',

        'manage_options',

        'manage-notices',

        'manage_notice_callback'

    );

}

add_action('admin_menu','school_notice_menu');

