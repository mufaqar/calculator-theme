<div class="row gx-md-3 gy-4 mb-4">
    <?php


               $author_id = 1;  // Replace with the desired author ID
               $taxonomy = 'job_type';  // Replace with the name of your taxonomy
               $term_slug = 'pre-income';  // Replace with the slug of the term

                $args = array(
                    'post_type' => 'jobs',  // Replace with your custom post type
                    'posts_per_page' => -1,  // Retrieve all posts (use -1 for all, adjust as needed)
                    'author' => $author_id,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => $term_slug,
                        ),
                    ),
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();   
                        $pre_job_from_date = get_post_meta(get_the_ID(), 'pre_job_from_date', true);
                        $pre_job_to_date = get_post_meta(get_the_ID(), 'pre_job_to_date', true);                        
                        echo '<h3 class="fs-4 mb-4 lh-sm">PRE-ACCIDENT ' . get_the_title() ." [  From: " . $pre_job_from_date  ."  To: " . $pre_job_to_date .  ' ]</h3>';
                        echo get_template_part('forms/pre_jobs'); 
                        echo '<hr>';
                
                        
                    }
                    wp_reset_postdata();  // Restore global post data
                } else {
                    echo 'No posts found.';
                }

    ?>
</div>
