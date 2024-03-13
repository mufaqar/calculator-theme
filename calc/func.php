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
