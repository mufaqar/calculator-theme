<?php
/*
Template Name: Testing
*/

get_header();

?>


<?php
// The Query
$the_query = new WP_Query(array(
    'post_type' => 'jobs', // Change 'post' to whatever post type you want to retrieve
    'posts_per_page' => -1, // Retrieve all posts. You can change this number to limit the number of posts returned.
    'tax_query'      => array(
        array(
            'taxonomy' => 'job_type', // Custom taxonomy
            'field'    => 'slug',     // Use 'slug' or 'term_id' depending on how you are storing the value
            'terms'    => 'pre-income', // Slug of the term you want to retrieve posts for
        ),
    )
));

// The Loop
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        // Post content
        the_title('<h2>', '</h2>');
       

       // Output all 'earning' meta values
       $earning_meta = array();
       $meta_keys = get_post_meta(get_the_ID());
       foreach ($meta_keys as $key => $value) {
           if (strpos($key, 'earning') === 0) {
               $earning_meta[$key] = unserialize($value[0]);
           }
       }

       print "<pre>";

       print_r($earning_meta);

       // Output all 'earning' meta values
       echo '<p>Earning Meta:</p>';
       if (!empty($earning_meta)) {
           echo '<ul>';
           foreach ($earning_meta as $key => $value) {
               echo '<li>' . $key . ': ';
               echo 'From Date: ' . $value['from_date'] . ', ';
               echo 'To Date: ' . $value['to_date'] . ', ';
               echo 'Pre Comment: ' . $value['pre_comment'];
               echo '</li>';
           }
           echo '</ul>';
       } else {
           echo '<p>No earning meta found.</p>';
       }
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}
?>
