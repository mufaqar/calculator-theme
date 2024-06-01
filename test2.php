<?php
/*
Template Name: Test2
*/
get_header();

?>




<?php

$dol = 'Jan-15-2024';


// Retrieve posts by category
$args = array(
    'post_type' => 'jobs', // Change 'post' to your custom post type if needed
    'posts_per_page' => -1, // Retrieve all posts
    'job_type' => 'post-benefits',
);

$posts = get_posts($args);

// Loop through each post
foreach ($posts as $post) {
    setup_postdata($post);
    $post_id = $post->ID;

    // Get the paystubs meta data for the current post
    $paystubs_meta = get_post_meta($post_id, 'paystubs', true); // Replace 'paystubs_meta_key' with the actual meta key

    // Check if paystubs meta exists and is an array
    if (is_array($paystubs_meta)) {
        // Loop through each paystub
        foreach ($paystubs_meta as $paystub) {

            $from_date = $paystub['from_date'];
            $to_date = $paystub['to_date'];
            $gross_earnings = $paystub['gross_earnings'];
            $special_condition = $paystub['special_condition'];

            Calc($from_date,$to_date,$dol,$gross_earnings);
            

           
        }
    }
}

// Reset post data
wp_reset_postdata();
?>





<?php wp_footer(); ?>