<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Jobs.
	 */

	$labels = [
		"name" => esc_html__( "Jobs", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Job", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Jobs", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "jobs", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "custom-fields", "author" ],
		"show_in_graphql" => false,
	];

	register_post_type( "jobs", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_taxes_job_type() {

	/**
	 * Taxonomy: Types.
	 */

	$labels = [
		"name" => esc_html__( "Types", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Type", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Types", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'job_type', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "job_type",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "job_type", [ "jobs" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_job_type' );


function save_custom_array($post_id, $custom_array) {
    // Generate a unique identifier
    $unique_key = uniqid();
    // Serialize the array
    $serialized_array = serialize($custom_array);

    // Save the serialized array to post meta with the unique key
    update_post_meta($post_id, 'custom_array_' . $unique_key, $serialized_array);
	echo "done";
}


function calculateDaysBetweenDates($startDateString, $endDateString) {
    // Create DateTime objects from the input date strings
    $startDate = DateTime::createFromFormat('M-d-Y', $startDateString);
    $endDate = DateTime::createFromFormat('M-d-Y', $endDateString);

    // Calculate the difference between the dates
    $interval = $startDate->diff($endDate);

    // Get the difference in days
    $daysDifference = $interval->days +1;

    // Return the difference in days
    return $daysDifference;
}

function calculateOrigianlDaysBetweenDates($startDateString, $endDateString) {
    // Create DateTime objects from the input date strings
    $startDate = DateTime::createFromFormat('M-d-Y', $startDateString);
    $endDate = DateTime::createFromFormat('M-d-Y', $endDateString);

    // Calculate the difference between the dates
    $interval = $startDate->diff($endDate);

    // Get the difference in days
    $daysDifference = $interval->days ;

    // Return the difference in days
    return $daysDifference;
}



function calculateDateFourWeeksPrior($dateString) {
    // Create a DateTime object from the input date string
    $dateTime = DateTime::createFromFormat('M-d-Y', $dateString);

    // Subtract 4 weeks
    $dateTime->modify('-4 weeks');

    // Get the resulting date
    $resultDate = $dateTime->format('M-d-Y');

    // Return the resulting date
    return $resultDate;
}


function calculateDateFiftyTwoWeeksPrior($dateString) {
    // Create a DateTime object from the input date string
    $dateTime = DateTime::createFromFormat('M-d-Y', $dateString);

    // Subtract 52 weeks (1 year)
    $dateTime->modify('-52 weeks');

    // Get the resulting date
    $resultDate = $dateTime->format('M-d-Y');

    // Return the resulting date
    return $resultDate;
}


function isDateInRange($start_date, $end_date, $check_date) {
    $start_datetime = DateTime::createFromFormat('M-d-Y', $start_date);
    $end_datetime = DateTime::createFromFormat('M-d-Y', $end_date);
    $check_datetime = DateTime::createFromFormat('M-d-Y', $check_date);

    return ($check_datetime >= $start_datetime && $check_datetime <= $end_datetime);
}

function getDaysDifference($start_date, $check_date) {
    $start_datetime = DateTime::createFromFormat('M-d-Y', $start_date);
    $check_datetime = DateTime::createFromFormat('M-d-Y', $check_date);

    $interval = $start_datetime->diff($check_datetime);
    return $interval->days + 1; // Add 1 to include the start date
}



function get_prejob_meta($post_id) {
    $all_meta = get_post_meta($post_id);
    $prejob_meta = array();
    foreach ($all_meta as $key => $value) {
        if (strpos($key, 'prejob_') === 0) {
			$prejob_meta[$key] = maybe_unserialize($value[0]);
        }
    }
    return $prejob_meta;
}


function get_prejob_meta_html($post_id) {
    // Get all post meta
    $all_meta = get_post_meta($post_id);

    // Initialize an array to hold prejob meta
    $prejob_meta = array();

    // Loop through all meta and filter keys that start with 'prejob_'
    foreach ($all_meta as $key => $value) {
        if (strpos($key, 'prejob_') === 0) {
            // Unserialize the value and store it in the prejob_meta array
            $prejob_meta[$key] = maybe_unserialize($value[0]); // Assuming single values for each meta key
        }
    }

    // Initialize an empty string to hold the HTML
    $html_output = '';
	$html_output .= '';

    // Loop through the prejob_meta array and generate HTML for each entry
    foreach ($prejob_meta as $key => $data) {
        $from_date = isset($data['from_date']) ? esc_attr($data['from_date']) : '';
        $to_date = isset($data['to_date']) ? esc_attr($data['to_date']) : '';
        $earning = isset($data['earning']) ? esc_attr($data['earning']) : '';
        $comt = isset($data['comt']) ? esc_attr($data['comt']) : '';

        $html_output .= '
        <div class="stub row gx-md-3 gy-4 align-items-center">
            <div class="col-md-3">
                <label for="pre_from_date">From Date </label>
                <input type="text" name="f_date[]" value="' . $from_date . '" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker">
            </div>
            <div class="col-md-3">
                <label for="pre_from_date">To Date </label>
                <input type="text" name="t_date[]" value="' . $to_date . '" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker">
            </div>
            <div class="col-md-3">
                <label for="pre_from_date">Gross Earnings </label>
                <input type="text" name="g_earning[]" value="' . $earning . '" placeholder="Gross Earnings" class="form-control fs-6 fw-normal">
            </div>
            <div class="col-md-2">
                <label for="pre_from_date">Special Condition </label>
                <input type="text" name="sp[]" value="' . $comt . '" placeholder="Special Condition" class="form-control fs-6 fw-normal">
            </div>
            <img class="remove-row col-md-1 rm_btn" src="' . get_template_directory_uri() . '/images/cross.png" width="48" height="48" />
        </div>';
    }

    return $html_output;
}


