<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WP_List_Table')) {

    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

}

class Attendance_List_Table extends WP_List_Table {
    public function column_cb($item){

    return sprintf(
        '<input type="checkbox" name="attendance[]" value="%d" />',
        $item->id
    );

}

    public function get_columns(){

    return array(

        'cb' => '<input type="checkbox" />',

        'id' => 'ID',

        'student' => 'Student',

        'roll' => 'Roll Number',

        'date' => 'Date',

        'status' => 'Status',

        'action' => 'Action'

    );

}

public function get_bulk_actions(){

    return array(

        'delete' => 'Delete'

    );
}


public function prepare_items() {

    global $wpdb;

    $table = $wpdb->prefix . 'student_attendance';

    // Columns
    $columns  = $this->get_columns();
    $hidden   = array();
    $sortable = $this->get_sortable_columns();

    $this->_column_headers = array(
        $columns,
        $hidden,
        $sortable
    );

    // Pagination
    $per_page = 10;

    $current_page = $this->get_pagenum();

    $offset = ($current_page - 1) * $per_page;

    // Total Records
    $total_items = $wpdb->get_var(
        "SELECT COUNT(*) FROM $table"
    );

    // Fetch Records
    $order_by = isset($_GET['orderby'])
    ? sanitize_key($_GET['orderby'])
    : 'id';

$allowed_columns = array(
    'id',
    'date',
    'status'
);

if (!in_array($order_by, $allowed_columns, true)) {
    $order_by = 'id';
}

$order = (isset($_GET['order']) && strtolower($_GET['order']) === 'asc')
    ? 'ASC'
    : 'DESC';

$query = "SELECT * FROM $table
          ORDER BY $order_by $order
          LIMIT %d OFFSET %d";

$this->items = $wpdb->get_results(
    $wpdb->prepare(
        $query,
        $per_page,
        $offset
    )
);

    // Pagination Settings
    $this->set_pagination_args(array(
        'total_items' => $total_items,
        'per_page'    => $per_page,
        'total_pages' => ceil($total_items / $per_page),
    ));
}
public function column_default($item, $column_name) {

    switch ($column_name) {

        case 'id':
            return $item->id;

        case 'student':
            $student = get_post($item->student_id);
            return $student ? esc_html($student->post_title) : '-';

        case 'roll':
            return get_post_meta($item->student_id, 'roll_number', true);

        case 'date':
            return esc_html($item->date);

        case 'status':
            return esc_html($item->status);

        case 'action':

            $edit_url = admin_url(
                'admin.php?page=manage-attendance&action=edit&id=' . $item->id
            );

            $delete_url = wp_nonce_url(
    admin_url(
        'admin.php?page=manage-attendance&action=delete&id=' . $item->id
    ),
    'delete_attendance_' . $item->id
);

$edit_url = admin_url(
    'admin.php?page=manage-attendance&action=edit&id=' . $item->id
);

return sprintf(
    '<a href="%s">Edit</a> | <a href="%s" onclick="return confirm(\'Delete this record?\')">Delete</a>',
    esc_url($edit_url),
    esc_url($delete_url)
);
    }
}


function manage_attendance_callback(){

    echo '<div class="wrap">';
    echo '<h1>Manage Attendance</h1>';

    $table = new Attendance_List_Table();

    $table->prepare_items();


   // Bulk Delete
    $action = $table->current_action();

    if ($action === 'delete' && !empty($_POST['attendance'])) {

        global $wpdb;

        $table_name = $wpdb->prefix . 'student_attendance';

        foreach ($_POST['attendance'] as $id) {

            $wpdb->delete(
                $table_name,
                array(
                    'id' => intval($id)
                ),
                array('%d')
            );

        }

        echo '<div class="notice notice-success">
                <p>Selected attendance deleted successfully.</p>
              </div>';

        // Reload updated data
        $table->prepare_items();
    }

    ?>

    <form method="post">

        <input
            type="hidden"
            name="page"
            value="manage-attendance">

        <?php

        $table->search_box(
            'Search Attendance',
            'attendance-search'
        );

        $table->display();

        ?>

    </form>

    <?php

    echo '</div>';
}
}
