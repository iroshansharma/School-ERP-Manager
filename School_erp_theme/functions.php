	<?php
	function schoolerp(){
		wp_enqueue_style(  
			'main-style',
			get_stylesheet_uri()
		);
	}

	add_action(
		'wp_enqueue_scripts',
		'schoolerp'
	);

	function addlogo(){
		add_theme_support('custom-logo');
		add_theme_support('post-thumbnails');
	}
	
	add_action(
		'after_setup_theme',
		'addlogo'
	);
	function addnav(){
		register_nav_menu('Create','Assign');
		register_sidebar('sidebar-widget');
		register_sidebar('sidebar-widget2');
		register_sidebar('sidebar-widget3');
	}
		
	add_action(
		'after_setup_theme',
		'addnav'
	);
	function heroheader($wp_customize){
	
		$wp_customize->add_section(
		'hero_section',
		array(
			'title'=>'Hero Section',
			'priority' => 30,
			'description' => 'Hero Section Settings'
		)	
		);
		$wp_customize->add_setting('hero_heading');
		$wp_customize->add_control(
		'hero_heading',
		array(
			'label'=>'Hero Heading',
			'section' => 'hero_section',
			'type' => 'text'
		)	
		);
		$wp_customize->add_setting('hero_paragraph');
		$wp_customize->add_control(
			'hero_paragraph',
			array(
				'label'=>'Hero Paragraph',
				'section'=> 'hero_section',
				'type'=>'text'
			)
		);

		$wp_customize->add_setting('hero_button_txt');
		$wp_customize->add_control(
			'hero_button_txt',
			array(
				'label'=>'Apply Button Text',
				'section'=>'hero_section',
				'type'=>'text'
			)
		);

		$wp_customize->add_setting('hero_button_url');
		$wp_customize->add_control(
			'hero_button_url',
			array(
				'label'=>'Apply Button Url',
				'section'=>'hero_section',
				'type'=>'url'
			)
		);

	}

	add_action('customize_register','heroheader');

	function bodysection($wp_customize){
		$wp_customize->add_section(
			'body_section',
			array(
				'title'=>'Body Section',
				'priority'=>'30',
				'description'=>'this is a body section'
			)
		);

		$wp_customize->add_setting('about');
		$wp_customize->add_control(
			'about',
			array(
				'label'=>'About us',
				'section'=>'body_section',
				'type'=>'text'
			)
		);

		$wp_customize->add_setting('desc');
		$wp_customize->add_control(
			'desc',
			array(
				'label'=>'Description',
				'section'=>'body_section',
				'type'=>'text'
			)
		);

		$wp_customize->add_setting('about_button_txt');
		$wp_customize->add_control(
			'about_button_txt',
			array(
				'label' => 'About Button Text',
				'section' => 'body_section',
				'type' => 'text'
			)
		);

		$wp_customize->add_setting('about_button_url');
		$wp_customize->add_control(
			'about_button_url',
			array(
				'label' => 'About Button Url',
				'section' => 'body_section',
				'type' => 'url'
			)
		);
	}

	add_action('customize_register','bodysection');

	function headersection($wp_customize){
		$wp_customize->add_section(
			'header_section',
			array(
				'title'=>'header section',
				'priority'=>'30',
				'description'=>'this is a header section'
			)
		);

		$wp_customize->add_setting('header');
		$wp_customize->add_control(
			'header',
			array(
				'label'=>'Head',
				'section'=>'header_section',
				'type'=>'text'
			)
		);
	}

	add_action('customize_register','headersection');

	function footersection($wp_customize){
		$wp_customize->add_section(
			'footer_section',
			array(
				'title'=>'footer section',
				'priority'=>'30',
				'description'=>'this is a footer section'
			)
		);

		$wp_customize->add_setting('footer');
		$wp_customize->add_control(
			'footer',
			array(
				'label'=>'Footer',
				'section'=>'footer_section',
				'type'=>'text'
			)
		);
	}

	add_action('customize_register','footersection');
	
	function studentscpt() {
		$labels = array(
			'name' => 'student',
			'singular_name' => 'student',
			'menu_name' => 'students'
		);
		$args = array(
			'labels' => $labels, 
			'public' => true, // Visible on front-end
			'publicly_queryable' => true, 
			'has_archive' => true, // Enables archive page
			'show_in_rest' => true,  // Enables Gutenberg editor
			'taxonomies' => array('class','house'),
			'supports' => array('title','editor','thumbnail')
		);
		register_post_type('students',$args);
	}

	add_action('init','studentscpt');

	function classcpt() {
		$args = array(
			'label' => 'Classes',
			'public' => true, 
			'hierarchical' => true,
			'show_in_rest' => true
		);

		register_taxonomy(
			'class',
			'students',
			$args
		);
	}

	add_action('init','classcpt');

	function housecpt() {
		$args = array(
			'label' => 'House',
			'public' => true, // Visible on front-end
			'hierarchical' => true,
			'show_in_rest' => true // Enables Gutenberg editor
		);

		register_taxonomy(
			'house',
			'students',
			$args
		);
	}

	add_action('init','housecpt');

	function student_meta_box(){
		
		add_meta_box(
			'student_details', //id
			'Student Details',      //title
			'student_meta_callback', //callable
			'students',  //link
			'normal',    //context
			'default'    //priority
		);
	}

	add_action('add_meta_boxes','student_meta_box');

	function student_meta_callback($post){
		
		$roll = get_post_meta($post->ID,'roll_number',true);
		 $section = get_post_meta($post->ID,'section',true);
		?>

			<label>Roll Number</label>
				<input type="text"
				name="roll_number"
				value="<?php echo esc_attr($roll); ?>"
				style="width:100%;">

			<label>Section</label>
				<input type="text" 
				name="section"
				value="<?php echo esc_attr($section); ?>"
				style="width:100%;">
		<?php
	}

	function save_student_details($post_id){
		if(isset($_POST['roll_number'])){
			update_post_meta(
				$post_id,
				'roll_number',

	sanitize_text_field($_POST['roll_number'])
			);
		}

		if(isset($_POST['section'])){
			update_post_meta(
				$post_id,
				'section',

	sanitize_text_field($_POST['section'])
			);
		}
	}


	add_action('save_post','save_student_details');


function api_test_shortcode(){

    $response = wp_remote_get(
        'https://jsonplaceholder.typicode.com/posts/1'
    );

	//check the error and get response
    if(is_wp_error($response)){
        return $response->get_error_message();
    }

    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body,true);

    return '<h3>'.$data['title'].'</h3>
            <p>'.$data['body'].'</p>';
}

add_shortcode('api_test','api_test_shortcode');



function create_student_cpt($user_id){
	$user = get_userdata($user_id);
	if(in_array('student', $user->roles)){
		
		$post_id = wp_insert_post(array(
				'post_type'   => 'students',
				'post_title'  => $user->display_name,
				'post_status' => 'publish'
		));

		update_post_meta(
			$post_id,
			'user_id',
			$user_id
		 );
	}
}

add_action('user_register', 'create_student_cpt');


	function student_dashboard_callback(){

		if ( ! is_user_logged_in() ) {
        return "<h2>Please login first.</h2>";
    }

    if ( ! current_user_can('student') ) {
        return "<h2>Access Denied</h2>";
    }

    $current_user = get_current_user_id();

    // Find Student CPT linked with logged-in user
    $student = get_posts(array(
        'post_type'      => 'students',
        'posts_per_page' => 1,
        'meta_key'       => 'user_id',
        'meta_value'     => $current_user
    ));

    if(empty($student)){
        return "<h2>Student Profile Not Found.</h2>";
    }

    $post_id = $student[0]->ID;

    $name    = get_the_title($post_id);
    $roll    = get_post_meta($post_id,'roll_number',true);
    $section = get_post_meta($post_id,'section',true);

    global $wpdb;

    $table_name = $wpdb->prefix . 'student_attendance';

    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE student_id=%d ORDER BY date DESC",
            $post_id
        )
    );

	$present = $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name
         WHERE student_id=%d
         AND status='Present'",
         $post_id
    )
);

	$absent = $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name
         WHERE student_id=%d
         AND status='Absent'",
         $post_id
    )
);

	$leave = $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name
         WHERE student_id=%d
         AND status='Leave'",
         $post_id
    )
);

$total = $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name
         WHERE student_id=%d",
         $post_id
    )
);

    $output = '';

    $output .= '<p><strong>Name:</strong> '.$name.'</p>';
    $output .= '<p><strong>Roll Number:</strong> '.$roll.'</p>';
    $output .= '<p><strong>Section:</strong> '.$section.'</p>';

    $output .= '<h3>Attendance</h3>';

    $output .= '<table border="1" cellpadding="10">';

    $output .= '<tr>
                    <th>Date</th>
                    <th>Status</th>
                </tr>';

    foreach($results as $row){

        $output .= '<tr>';
        $output .= '<td>'.$row->date.'</td>';
        $output .= '<td>'.$row->status.'</td>';
        $output .= '</tr>';

    }

    $output .= '</table>';

	$output .= "<h3>Attendance Summary</h3>";

	$output .= "<p>Present : $present</p>";

	$output .= "<p>Absent : $absent</p>";

	$output .= "<p>Leave : $leave</p>";

	$output .= "<p>Total : $total</p>";

	$output .= '<div class="student-notices">';

	$output .= '<h3>📢 Latest Notices</h3>';

	$output .= do_shortcode('[school_notices]');

	$output .= '</div>';
	$output .= '<a href="'.site_url('/school-notices/').'">
Show All Notices
</a>';

    return $output;

	}

	add_shortcode(
		'student_dashboard',
		'student_dashboard_callback'
	);
	

function teacher_dashboard_callback(){
	// return "<h2>Teacher Dashboard</h2>";
	if ( ! is_user_logged_in() ) {
        return "<h2>Please login first.</h2>";
    }

    if ( ! current_user_can('teacher') ) {
        return "<h2>Access Denied</h2>";
    }
	 global $wpdb;

    $output = "";

    $current_user = wp_get_current_user();

    $output .= "<h2>Welcome, ".$current_user->display_name."</h2>";

    // Total Students
    $total_students = wp_count_posts('students')->publish;

    $output .= "<h3>Total Students : ".$total_students."</h3>";

    // Attendance Table
    $table_name = $wpdb->prefix . 'student_attendance';

    $today = date('Y-m-d');

    // Today's Attendance
    $today_attendance = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE date=%s",
            $today
        )
    );

    // Present
    $present = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
            WHERE date=%s
            AND status=%s",
            $today,
            'Present'
        )
    );

    // Absent
    $absent = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
            WHERE date=%s
            AND status=%s",
            $today,
            'Absent'
        )
    );

    // Leave
    $leave = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
            WHERE date=%s
            AND status=%s",
            $today,
            'Leave'
        )
    );

    $output .= "<hr>";

    $output .= "<h3>Today's Attendance</h3>";

    $output .= "<p>Total : ".$today_attendance."</p>";

    $output .= "<p>Present : ".$present."</p>";

    $output .= "<p>Absent : ".$absent."</p>";

    $output .= "<p>Leave : ".$leave."</p>";

    $output .= "<hr>";

    $output .= '<a class="button button-primary" href="'.admin_url('admin.php?page=attendance-manager').'">Mark Attendance</a> ';

    $output .= '<a class="button" href="'.admin_url('admin.php?page=manage-attendance').'">Manage Attendance</a> ';

    $output .= '<a class="button" href="'.admin_url('admin.php?page=attendance-report').'">Attendance Report</a>';

	$output .= "<hr>";
$output .= "<h3>Latest Notices</h3>";

$notice_query = new WP_Query(array(
    'post_type'      => 'notice',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC'
));

if($notice_query->have_posts()){

    while($notice_query->have_posts()){

        $notice_query->the_post();

        $output .= "<div style='margin-bottom:15px;'>";

        $output .= "<strong>".get_the_title()."</strong><br>";

        $output .= wp_trim_words(get_the_content(),20);

        $output .= "<br>";

        $output .= "<a href='".get_permalink()."'>Read More</a>";

        $output .= "</div>";

    }

    wp_reset_postdata();

}else{

    $output .= "No Notices Found.";

}

    return $output;
}

add_shortcode(
    'teacher_dashboard',
    'teacher_dashboard_callback'
);

function admin_dashboard_callback(){
	if ( ! is_user_logged_in() ) {
        return "<h2>Please login first.</h2>";
    }

    if ( ! current_user_can('administrator') ) {
        return "<h2>Access Denied</h2>";
    }
	global $wpdb;

    $output = "";

    $current_user = wp_get_current_user();

    $table_name = $wpdb->prefix . 'student_attendance';

    $today = date('Y-m-d');

    // Total Students (CPT)
    $total_students = wp_count_posts('students')->publish;

    // Total Teachers
    $total_teachers = count(
        get_users(array(
            'role' => 'teacher'
        ))
    );

    // Total Student Users
    $total_student_users = count(
        get_users(array(
            'role' => 'student'
        ))
    );

    // Total Notices
    $notice_table = $wpdb->prefix . 'school_notices';

$total_notices = $wpdb->get_var(
    $wpdb->prepare(
        "SELECT COUNT(*)
         FROM $notice_table
         WHERE expiry_date >= %s",
        current_time('Y-m-d')
    )
);

    // Today's Attendance
    $today_attendance = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE date=%s",
            $today
        )
    );

    // Present
    $present = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
             WHERE date=%s
             AND status=%s",
            $today,
            'Present'
        )
    );

    // Absent
    $absent = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
             WHERE date=%s
             AND status=%s",
            $today,
            'Absent'
        )
    );

    // Leave
    $leave = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name
             WHERE date=%s
             AND status=%s",
            $today,
            'Leave'
        )
    );

    // Welcome
    $output .= "<h3>Welcome, ".$current_user->display_name."</h3>";

    $output .= "<hr>";

    // Statistics
    $output .= "<h2>Statistics</h2>";

    $output .= "<p><strong>Total Students (CPT):</strong> ".$total_students."</p>";

    $output .= "<p><strong>Total Student Users:</strong> ".$total_student_users."</p>";

    $output .= "<p><strong>Total Teachers:</strong> ".$total_teachers."</p>";

    $output .= "<p><strong>Total Notices:</strong> ".$total_notices."</p>";

    $output .= "<hr>";

    // Today's Attendance
    $output .= "<h2>Today's Attendance</h2>";

    $output .= "<p><strong>Total:</strong> ".$today_attendance."</p>";

    $output .= "<p><strong>Present:</strong> ".$present."</p>";

    $output .= "<p><strong>Absent:</strong> ".$absent."</p>";

    $output .= "<p><strong>Leave:</strong> ".$leave."</p>";

    $output .= "<hr>";

    // Quick Actions
    $output .= "<h2>Quick Actions</h2>";

    $output .= '<p>';

    $output .= '<a class="button button-primary" href="'.admin_url('admin.php?page=attendance-manager').'">Mark Attendance</a> ';

    $output .= '<a class="button" href="'.admin_url('admin.php?page=manage-attendance').'">Manage Attendance</a> ';

    $output .= '<a class="button" href="'.admin_url('admin.php?page=attendance-report').'">Attendance Report</a>';

    $output .= '</p>';

    return $output;
}

add_shortcode(
	'admin_dashboard',
	'admin_dashboard_callback'
);

function school_notice_board_shortcode() {

    global $wpdb;

    $table = $wpdb->prefix . 'school_notices';

    $today = current_time('Y-m-d');

$notices = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT *
         FROM $table
         WHERE expiry_date >= %s
         ORDER BY is_important DESC, id DESC",
        $today
    )
);

    ob_start();

    echo '<div class="school-notice-board">';

    echo '<h2>📢 Notice Board</h2>';

    if (empty($notices)) {

        echo '<p>No notices available.</p>';

    } else {

        foreach ($notices as $notice) {

            echo '<div class="notice-item">';

            if ($notice->is_important) {
                echo '<span class="notice-badge">Important</span>';
            }

            echo '<h3>' . esc_html($notice->title) . '</h3>';

            echo '<p>' . esc_html($notice->description) . '</p>';

            echo '<small>📅 ' . date('d M Y', strtotime($notice->expiry_date)) . '</small>';

            echo '</div>';
        }

    }

    echo '</div>';

    return ob_get_clean();
}

add_shortcode('school_notices', 'school_notice_board_shortcode');