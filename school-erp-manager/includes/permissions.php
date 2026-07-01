<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
|--------------------------------------------------------------------------
| Role Check Functions
|--------------------------------------------------------------------------
*/

function school_is_admin() {
    return current_user_can('administrator');
}

function school_is_teacher() {
    return current_user_can('teacher');
}

function school_is_student() {
    return current_user_can('student');
}


/*
|--------------------------------------------------------------------------
| Permission Functions
|--------------------------------------------------------------------------
*/

function school_can_view_student_dashboard() {

    return (
        school_is_admin() ||
        school_is_teacher() ||
        school_is_student()
    );

}

function school_can_view_teacher_dashboard() {

    return (
        school_is_admin() ||
        school_is_teacher()
    );

}

function school_can_view_admin_dashboard() {

    return school_is_admin();

}

function school_can_manage_attendance() {

    return (
        school_is_admin() ||
        school_is_teacher()
    );

}

function school_can_manage_notices() {

    return (
        school_is_admin() ||
        school_is_teacher()
    );

}

function school_can_manage_students() {

    return school_is_admin();

}

function school_can_manage_teachers() {

    return school_is_admin();

}

function school_can_manage_settings() {

    return school_is_admin();

}