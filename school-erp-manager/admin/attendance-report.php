<?php

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;

?>

<div class="wrap">

    <h1>Attendance Report</h1>

    <form method="get">

        <input
            type="hidden"
            name="page"
            value="attendance-report">

        <?php

        $students = get_posts(array(
            'post_type'      => 'students',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC'
        ));

        ?>

        <table class="form-table">

            <tr>

                <th>Student</th>

                <td>

                    <select name="student">

                        <option value="">All Students</option>

                        <?php

                        foreach ($students as $student) {

                            ?>

                            <option
                                value="<?php echo $student->ID; ?>"

                                <?php selected(
                                    isset($_GET['student']) ? $_GET['student'] : '',
                                    $student->ID
                                ); ?>

                            >

                                <?php echo esc_html($student->post_title); ?>

                            </option>

                            <?php

                        }

                        ?>

                    </select>

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <select name="status">

                        <option value="">All Status</option>

                        <option
                            value="Present"
                            <?php selected(
                                isset($_GET['status']) ? $_GET['status'] : '',
                                'Present'
                            ); ?>
                        >
                            Present
                        </option>

                        <option
                            value="Absent"
                            <?php selected(
                                isset($_GET['status']) ? $_GET['status'] : '',
                                'Absent'
                            ); ?>
                        >
                            Absent
                        </option>

                        <option
                            value="Leave"
                            <?php selected(
                                isset($_GET['status']) ? $_GET['status'] : '',
                                'Leave'
                            ); ?>
                        >
                            Leave
                        </option>

                    </select>

                </td>

            </tr>

            <tr>

                <th>From Date</th>

                <td>

                    <input
                        type="date"
                        name="from"

                        value="<?php echo isset($_GET['from'])
                            ? esc_attr($_GET['from'])
                            : ''; ?>">

                </td>

            </tr>

            <tr>

                <th>To Date</th>

                <td>

                    <input
                        type="date"
                        name="to"

                        value="<?php echo isset($_GET['to'])
                            ? esc_attr($_GET['to'])
                            : ''; ?>">

                </td>

            </tr>

        </table>

        <?php submit_button('Filter Report'); ?>

    </form>

    <hr>


    <?php

$table_name = $wpdb->prefix . 'student_attendance';

$query = "SELECT * FROM $table_name WHERE 1=1";

$params = array();

if (!empty($_GET['student'])) {

    $query .= " AND student_id = %d";

    $params[] = intval($_GET['student']);

}

if (!empty($_GET['status'])) {

    $query .= " AND status = %s";

    $params[] = sanitize_text_field($_GET['status']);

}

if (!empty($_GET['from'])) {

    $query .= " AND date >= %s";

    $params[] = sanitize_text_field($_GET['from']);

}

if (!empty($_GET['to'])) {

    $query .= " AND date <= %s";

    $params[] = sanitize_text_field($_GET['to']);

}

if (!empty($params)) {

    array_unshift($params, $query);

    $query = call_user_func_array(
        array($wpdb, 'prepare'),
        $params
    );

}

$results = $wpdb->get_results($query);

echo '<table class="widefat striped">';

echo '<thead>';

echo '<tr>';

echo '<th>ID</th>';
echo '<th>Student</th>';
echo '<th>Roll No.</th>';
echo '<th>Date</th>';
echo '<th>Status</th>';

echo '</tr>';

echo '</thead>';

echo '<tbody>';

foreach ($results as $row) {

    $student = get_post($row->student_id);

    $roll = get_post_meta(
        $row->student_id,
        'roll_number',
        true
    );

    echo '<tr>';

    echo '<td>' . $row->id . '</td>';

    echo '<td>' .
        ($student ? esc_html($student->post_title) : '-') .
        '</td>';

    echo '<td>' . esc_html($roll) . '</td>';

    echo '<td>' . esc_html($row->date) . '</td>';

    echo '<td>' . esc_html($row->status) . '</td>';

    echo '</tr>';

}

if (empty($results)) {

    echo '<tr>';

    echo '<td colspan="5">No attendance records found.</td>';

    echo '</tr>';

}

echo '</tbody>';

echo '</table>';
