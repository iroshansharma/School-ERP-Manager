<?php

if (!defined('ABSPATH')) {
    exit;
}



function manage_attendance_callback(){
    if (
    isset($_POST['action']) &&
    $_POST['action'] === 'delete' &&
    !empty($_POST['attendance'])
) {

    global $wpdb;

    $table = $wpdb->prefix . 'student_attendance';

    foreach ($_POST['attendance'] as $id) {

        $wpdb->delete(
            $table,
            array(
                'id' => intval($id)
            ),
            array('%d')
        );

    }

    echo '<div class="notice notice-success is-dismissible">
            <p>Selected attendance records deleted successfully.</p>
          </div>';
}

    if (
        isset($_GET['action']) &&
        $_GET['action'] === 'delete' &&
        isset($_GET['id'])
    ) {

        $attendance_id = intval($_GET['id']);

        check_admin_referer(
            'delete_attendance_' . $attendance_id
        );

        global $wpdb;

        $table = $wpdb->prefix . 'student_attendance';

        $wpdb->delete(
            $table,
            array(
                'id' => $attendance_id
            ),
            array('%d')
        );

        echo '<div class="notice notice-success">
                <p>Attendance Deleted.</p>
              </div>';
    }

    if(isset($_POST['update_attendance'])){

        check_admin_referer('attendance_update');

        global $wpdb;

        $table = $wpdb->prefix.'student_attendance';

        $wpdb->update(
            $table,
    array(
        'date'   => sanitize_text_field($_POST['attendance_date']),
        'status' => sanitize_text_field($_POST['status'])
    ),
    array(
        'id' => intval($_POST['attendance_id'])
    ),
    array('%s', '%s'),
    array('%d')
        );

        echo "<div class='notice notice-success'>
                <p>Attendance Updated.</p>
              </div>";
    }

    // Edit routing

    if(
        isset($_GET['action']) &&
        $_GET['action'] === 'edit' &&
        isset($_GET['id'])
    ){
        attendance_edit_form(intval($_GET['id']));
        return;
    }
    echo '<div class="wrap">';

    echo '<h1>Manage Attendance</h1>';

    $table = new Attendance_List_Table();

    $table->prepare_items();

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

function attendance_edit_form($id){

    global $wpdb;

    $table = $wpdb->prefix.'student_attendance';

    $record = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table WHERE id=%d",
            $id
        )
    );

    if(!$record){
        echo "<div class='notice notice-error'><p>Record not found.</p></div>";
        return;
    }

    ?>

    <div class="wrap">

    <h1>Edit Attendance</h1>

    <form method="post">

        <input
            type="hidden"
            name="attendance_id"
            value="<?php echo esc_attr($record->id); ?>">

        <input
            type="date"
            name="attendance_date"
            value="<?php echo esc_attr($record->date); ?>">

        <br><br>

        <select name="status">

            <option value="Present"
                <?php selected($record->status,'Present'); ?>>
                Present
            </option>

            <option value="Absent"
                <?php selected($record->status,'Absent'); ?>>
                Absent
            </option>

            <option value="Leave"
                <?php selected($record->status,'Leave'); ?>>
                Leave
            </option>

        </select>

        <br><br>

        <?php wp_nonce_field('attendance_update'); ?>

        <input
            type="submit"
            name="update_attendance"
            class="button button-primary"
            value="Update Attendance">

    </form>

    </div>

    <?php

}