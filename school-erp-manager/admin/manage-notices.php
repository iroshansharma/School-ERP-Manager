<?php

if (!defined('ABSPATH')) {
    exit;
}

function manage_notice_callback() {

    global $wpdb;

    $table = $wpdb->prefix . 'school_notices';

    /*
    ======================================
    BULK DELETE
    ======================================
    */

    $action = '';

    if (isset($_POST['action']) && $_POST['action'] != '-1') {

        $action = sanitize_text_field($_POST['action']);

    } elseif (isset($_POST['action2']) && $_POST['action2'] != '-1') {

        $action = sanitize_text_field($_POST['action2']);

    }

    if ($action == 'delete' && !empty($_POST['notice'])) {

        foreach ($_POST['notice'] as $id) {

            $wpdb->delete(
                $table,
                array(
                    'id' => intval($id)
                ),
                array('%d')
            );

        }

        echo '<div class="notice notice-success is-dismissible">
                <p>Selected notices deleted successfully.</p>
              </div>';

    }


    /*
    ======================================
    UPDATE NOTICE
    ======================================
    */

    if (isset($_POST['update_notice'])) {

        check_admin_referer('update_notice');

        $wpdb->update(

            $table,

            array(

                'title' => sanitize_text_field($_POST['title']),

                'description' => wp_kses_post($_POST['description']),

                'audience' => sanitize_text_field($_POST['audience']),

                'attachment' => esc_url_raw($_POST['attachment']),

                'expiry_date' => sanitize_text_field($_POST['expiry_date']),

                'is_important' => isset($_POST['important']) ? 1 : 0

            ),

            array(

                'id' => intval($_POST['notice_id'])

            ),

            array(

                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d'

            ),

            array('%d')

        );

        echo '<div class="notice notice-success is-dismissible">
                <p>Notice Updated Successfully.</p>
              </div>';

    }


    /*
    ======================================
    SINGLE DELETE
    ======================================
    */

    if (

        isset($_GET['action']) &&
        $_GET['action'] == 'delete' &&
        isset($_GET['id'])

    ) {

        $notice_id = intval($_GET['id']);

        check_admin_referer(
            'delete_notice_' . $notice_id
        );

        $wpdb->delete(

            $table,

            array(
                'id' => $notice_id
            ),

            array('%d')

        );

        echo '<div class="notice notice-success is-dismissible">
                <p>Notice Deleted Successfully.</p>
              </div>';

    }


    /*
    ======================================
    EDIT ROUTING
    ======================================
    */

    if (

        isset($_GET['action']) &&
        $_GET['action'] == 'edit' &&
        isset($_GET['id'])

    ) {

        notice_edit_form(
            intval($_GET['id'])
        );

        return;

    }

    /*
    ======================================
    PART 2 STARTS FROM HERE
    ======================================
    */
    echo '<div class="wrap">';

    echo '<h1 class="wp-heading-inline">Manage Notices</h1>';

    echo '<hr class="wp-header-end">';

    $list_table = new Notice_List_Table();

    $list_table->prepare_items();

?>

<form method="post">

    <input
        type="hidden"
        name="page"
        value="manage-notices">

    <?php

    $list_table->search_box(
        'Search Notice',
        'notice-search'
    );

    $list_table->display();

    ?>

</form>

<?php

    echo '</div>';

}


