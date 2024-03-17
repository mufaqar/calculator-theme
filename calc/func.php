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