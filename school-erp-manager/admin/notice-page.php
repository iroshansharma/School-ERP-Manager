<?php

if (!defined('ABSPATH')) {
    exit;
}


function notice_page_callback(){

    global $wpdb;

    $table = $wpdb->prefix . 'school_notices';

    if(isset($_POST['save_notice'])){

        $wpdb->insert(

            $table,

            array(

                'title' => sanitize_text_field($_POST['title']),

                'description' => wp_kses_post($_POST['description']),

                'audience' => sanitize_text_field($_POST['audience']),

                'attachment' => esc_url_raw($_POST['attachment']),

                'expiry_date' => sanitize_text_field($_POST['expiry_date']),

                'is_important' => isset($_POST['important']) ? 1 : 0

            )

        );

        echo '<div class="notice notice-success is-dismissible">

                <p>Notice Saved Successfully.</p>

              </div>';

    }

?>

<div class="wrap">

<h1>Add Notice</h1>

<form method="post">

<table class="form-table">
<tr>

<th>Notice Title</th>

<td>

<input

type="text"

name="title"

class="regular-text"

required>

</td>

</tr>
<tr>

<th>Description</th>

<td>

<textarea

name="description"

rows="6"

cols="60"></textarea>

</td>

</tr>
<tr>

<th>Audience</th>

<td>

<select name="audience">

<option value="All">All</option>

<option value="Teachers">Teachers</option>

<option value="Students">Students</option>

</select>

</td>

</tr>
<tr>

<th>Attachment</th>

<td>

<input

type="url"

name="attachment"

class="regular-text">

</td>

</tr>
<tr>

<th>Expiry Date</th>

<td>

<input

type="date"

name="expiry_date">

</td>

</tr>
<tr>

<th>Important</th>

<td>

<label>

<input

type="checkbox"

name="important">

Important Notice

</label>

</td>

</tr>
</table>

<input

type="submit"

name="save_notice"

class="button button-primary"

value="Save Notice">

</form>

</div>

<?php

}

function notice_edit_form($id){

    global $wpdb;

    $table = $wpdb->prefix.'school_notices';

    $notice = $wpdb->get_row(

        $wpdb->prepare(

            "SELECT * FROM $table WHERE id=%d",

            $id

        )

    );

    if(!$notice){

        echo "<div class='notice notice-error'>
                <p>Notice not found.</p>
              </div>";

        return;

    }

?>

<div class="wrap">

<h1>Edit Notice</h1>

<form method="post">

<input
type="hidden"
name="notice_id"
value="<?php echo esc_attr($notice->id); ?>">

<table class="form-table">

<tr>

<th>Title</th>

<td>

<input

type="text"

name="title"

class="regular-text"

value="<?php echo esc_attr($notice->title); ?>">

</td>

</tr>


<tr>

<th>Description</th>

<td>

<textarea

name="description"

rows="6"

cols="60"><?php echo esc_textarea($notice->description); ?></textarea>

</td>

</tr>

<tr>

<th>Audience</th>

<td>

<select name="audience">

<option value="All"
<?php selected($notice->audience,'All'); ?>>
All
</option>

<option value="Students"
<?php selected($notice->audience,'Students'); ?>>
Students
</option>

<option value="Teachers"
<?php selected($notice->audience,'Teachers'); ?>>
Teachers
</option>

</select>

</td>

</tr>

<tr>

<th>Audience</th>

<td>

<select name="audience">

<option value="All"
<?php selected($notice->audience,'All'); ?>>
All
</option>

<option value="Students"
<?php selected($notice->audience,'Students'); ?>>
Students
</option>

<option value="Teachers"
<?php selected($notice->audience,'Teachers'); ?>>
Teachers
</option>

</select>

</td>

</tr>

<tr>

<th>Attachment</th>

<td>

<input

type="url"

name="attachment"

class="regular-text"

value="<?php echo esc_attr($notice->attachment); ?>">

</td>

</tr>


<tr>

<th>Expiry Date</th>

<td>

<input

type="date"

name="expiry_date"

value="<?php echo esc_attr($notice->expiry_date); ?>">

</td>

</tr>


<tr>

<th>Important</th>

<td>

<label>

<input

type="checkbox"

name="important"

<?php checked($notice->is_important,1); ?>>

Important Notice

</label>

</td>

</tr>


</table>

<?php wp_nonce_field('update_notice'); ?>

<input

type="submit"

name="update_notice"

class="button button-primary"

value="Update Notice">

</form>

</div>

<?php

}