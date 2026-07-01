<?php

if (!defined('ABSPATH')) {
    exit;
}

function school_create_pages() {

    $pages = array(

        array(
            'title'   => 'Student Dashboard',
            'slug'    => 'student-dashboard',
            'content' => '[student_dashboard]'
        ),

        array(
            'title'   => 'Teacher Dashboard',
            'slug'    => 'teacher-dashboard',
            'content' => '[teacher_dashboard]'
        ),

        array(
            'title'   => 'Admin Dashboard',
            'slug'    => 'admin-dashboard',
            'content' => '[admin_dashboard]'
        ),

        array(
            'title'   => 'School Notices',
            'slug'    => 'school-notices',
            'content' => '[school_notices]'
        )

    );

    foreach ($pages as $page) {

        if (!get_page_by_path($page['slug'])) {

            wp_insert_post(array(

                'post_title'   => $page['title'],

                'post_name'    => $page['slug'],

                'post_content' => $page['content'],

                'post_status'  => 'publish',

                'post_type'    => 'page'

            ));

        }

    }

}