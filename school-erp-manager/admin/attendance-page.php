<?php

if (!defined('ABSPATH')) {
    exit;
}

function attendance_page_callback(){

    global $wpdb;

    $table_name = $wpdb->prefix . 'student_attendance';

    if(isset($_POST['save_attendance'])){

        $wpdb->insert(

            $table_name,

            array(

                'student_id' => intval($_POST['student_id']),

                'date' => sanitize_text_field($_POST['attendance_date']),

                'status' => sanitize_text_field($_POST['status'])

            )

        );

        echo '<div class="notice notice-success"><p>Attendance Saved.</p></div>';

    }

    ?>

    <div class="wrap">

    <h1>Mark Attendance</h1>

    <form method="post">

    <?php

    $students = get_posts(array(

        'post_type'=>'students',

        'posts_per_page'=>-1

    ));

    ?>

    <select name="student_id">

    <?php

    foreach($students as $student){

        ?>

        <option value="<?php echo esc_attr($student->ID); ?>">

            <?php echo esc_html($student->post_title); ?>

        </option>

        <?php

    }

    ?>

    </select>

    <br><br>

    <input
        type="date"
        name="attendance_date"
        required>

    <br><br>

    <select name="status">

        <option>Present</option>

        <option>Absent</option>

        <option>Leave</option>

    </select>

    <br><br>

    <?php wp_nonce_field('save_attendance_nonce'); ?>

    <input
        type="submit"
        class="button button-primary"
        name="save_attendance"
        value="Save Attendance">

    </form>

    </div>

    <?php

}