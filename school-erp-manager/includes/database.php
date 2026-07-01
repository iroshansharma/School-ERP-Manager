<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function school_create_database(){

    global $wpdb;

    $table = $wpdb->prefix.'student_attendance';

    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table(

        id mediumint(9) NOT NULL AUTO_INCREMENT,

        student_id mediumint(9) NOT NULL,

        date date NOT NULL,

        status varchar(20) NOT NULL,

        created_at datetime DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY(id)

    ) $charset;";

    require_once ABSPATH.'wp-admin/includes/upgrade.php';

    dbDelta($sql);

}

function school_notice_table() {

    global $wpdb;

    $table = $wpdb->prefix . 'school_notices';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (

        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        description LONGTEXT,
        audience VARCHAR(50),
        attachment VARCHAR(255),
        expiry_date DATE,
        is_important TINYINT(1) DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

        PRIMARY KEY (id)

    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta($sql);
}