<?php

if (!defined('ABSPATH')) {
    exit;
}

function school_login_redirect($redirect_to, $request, $user) {

    if (!isset($user->roles) || !is_array($user->roles)) {

        return $redirect_to;

    }

    if (in_array('administrator', $user->roles)) {

        return home_url('/admin-dashboard');

    }

    if (in_array('teacher', $user->roles)) {

        return home_url('/teacher-dashboard');

    }

    if (in_array('student', $user->roles)) {

        return home_url('/student-dashboard');

    }

    return $redirect_to;

}

add_filter(
    'login_redirect',
    'school_login_redirect',
    10,
    3
);