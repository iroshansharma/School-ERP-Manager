<?php

if (!defined('ABSPATH')) {
    exit;
}

function school_create_roles() {

    // Teacher Role
    add_role(
        'teacher',
        'Teacher',
        array(
            'read' => true,
            'edit_posts' => false,
            'upload_files' => false,
        )
    );

    // Student Role
    add_role(
        'student',
        'Student',
        array(
            'read' => true,
        )
    );

    // Teacher Capabilities
    $teacher = get_role('teacher');

    if ($teacher) {

        $teacher->add_cap('manage_attendance');

        $teacher->add_cap('read');

    }

    // Admin Capability
    $admin = get_role('administrator');

    if ($admin) {

        $admin->add_cap('manage_attendance');

    }

}