<?php

if (!defined('ABSPATH')) {
    exit;
}
require_once plugin_dir_path(__FILE__) . '../admin/class-attendance-list-table.php';
require_once plugin_dir_path(__FILE__) . '../admin/attendance-page.php';
require_once plugin_dir_path(__FILE__) . '../admin/manage-attendance.php';

function attendance_report_callback() {

    require plugin_dir_path(__FILE__) . '../admin/attendance-report.php';

}

function school_attendance_menu(){

    add_menu_page(
        'Attendance',
        'Attendance',
        'manage_attendance',
        'attendance-manager',
        'attendance_page_callback',
        'dashicons-welcome-learn-more',
        25
    );

    add_submenu_page(
        'attendance-manager',
        'Manage Attendance',
        'Manage Attendance',
        'manage_attendance',
        'manage-attendance',
        'manage_attendance_callback'
    );

    add_submenu_page(
        'attendance-manager',
        'Attendance Report',
        'Attendance Report',
        'manage_attendance',
        'attendance-report',
        'attendance_report_callback'
    );


}

add_action(
    'admin_menu',
    'school_attendance_menu'
);