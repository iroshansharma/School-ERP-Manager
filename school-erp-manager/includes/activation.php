<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function school_erp_activate(){

    school_create_roles();

    school_create_database();

    school_create_pages();

    school_notice_table();

}

