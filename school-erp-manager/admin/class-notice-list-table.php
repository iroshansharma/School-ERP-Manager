<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Notice_List_Table extends WP_List_Table {

    public function get_columns() {

        return array(
            'cb'          => '<input type="checkbox">',
            'id'          => 'ID',
            'title'       => 'Title',
            'audience'    => 'Audience',
            'expiry_date' => 'Expiry Date',
            'important'   => 'Important',
            'action'      => 'Action'
        );
    }

    public function column_cb($item) {

        return sprintf(
            '<input type="checkbox" name="notice[]" value="%d">',
            $item->id
        );
    }



    public function get_bulk_actions() {

        return array(
            'delete' => 'Delete'
        );
    }


    public function prepare_items() {

    global $wpdb;

    $table = $wpdb->prefix . 'school_notices';

    $columns = $this->get_columns();

    $hidden = array();

    $sortable = $this->get_sortable_columns();

    $this->_column_headers = array(
        $columns,
        $hidden,
        $sortable
    );

    $per_page = 10;

    $current_page = $this->get_pagenum();

    $offset = ($current_page - 1) * $per_page;

    $total_items = $wpdb->get_var(
        "SELECT COUNT(*) FROM $table"
    );

    $this->items = $wpdb->get_results(

        $wpdb->prepare(

            "SELECT * FROM $table
             ORDER BY id DESC
             LIMIT %d OFFSET %d",

            $per_page,

            $offset

        )

    );

    $this->set_pagination_args(array(

        'total_items' => $total_items,

        'per_page' => $per_page,

        'total_pages' => ceil($total_items / $per_page)

    ));

    $search = '';

if (!empty($_REQUEST['s'])) {
    $search = sanitize_text_field($_REQUEST['s']);
}

$where = '';

if (!empty($search)) {

    $where = $wpdb->prepare(
        " WHERE title LIKE %s
           OR description LIKE %s
           OR audience LIKE %s ",
        '%' . $wpdb->esc_like($search) . '%',
        '%' . $wpdb->esc_like($search) . '%',
        '%' . $wpdb->esc_like($search) . '%'
    );
}

$total_items = $wpdb->get_var(
    "SELECT COUNT(*) FROM $table $where"
);

$this->items = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM $table
         $where
         ORDER BY id DESC
         LIMIT %d OFFSET %d",
        $per_page,
        $offset
    )
);



}
public function column_default($item, $column_name) {

    switch ($column_name) {

        case 'id':
            return $item->id;

        case 'title':
            return esc_html($item->title);

        case 'audience':
            return esc_html($item->audience);

        case 'expiry_date':
            return esc_html($item->expiry_date);

        case 'important':

            return $item->is_important
                ? '⭐ Yes'
                : 'No';

        case 'action':

            $edit_url = admin_url(
    'admin.php?page=manage-notices&action=edit&id=' . $item->id
);

$delete_url = wp_nonce_url(
    admin_url(
        'admin.php?page=manage-notices&action=delete&id=' . $item->id
    ),
    'delete_notice_' . $item->id
);

return sprintf(
    '<a href="%s">Edit</a> | <a href="%s" onclick="return confirm(\'Delete this notice?\')">Delete</a>',
    esc_url($edit_url),
    esc_url($delete_url)
);


        default:

            return '-';
    }
}


public function get_sortable_columns() {

    return array(

        'id' => array('id', true),

        'title' => array('title', false),

        'expiry_date' => array('expiry_date', false)

    );

}
}