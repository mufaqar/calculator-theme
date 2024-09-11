<?php
/*
Template Name: Map
*/
get_header();
?>

<link rel="stylesheet" href="https://skinandcancer.powerupbox.io/wp-content/themes/glacial-theme-2.1.1/style.css" />

<?php echo do_shortcode('[wpsl]')?>


<div class="anchor-buttons">
    <a href="#arizona" class="ui-button">Arizona</a>
    <a href="#central-california" class="ui-button">Central California</a>
    <a href="#nevada" class="ui-button">Nevada</a>
    <a href="#northern-california" class="ui-button">Northern California</a>
    <a href="#southern-california" class="ui-button">Southern California</a>
</div>

<?php

$args = array(
    'post_type' => 'location',
    'posts_per_page' => -1, 
);

$query = new WP_Query( $args );

// Start the custom loop
if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post(); 
        // Variables for dynamic content
        $location_name = get_the_title(); // Post title as location name
        $location_url = get_the_permalink(); // Post permalink
        $address = get_field('address'); // Assuming 'address' is a custom field for the location
        $appointment_url = get_field('appointment_url'); // Assuming this is a custom field
        $more_info_url = $location_url; // More info URL same as post permalink
        $featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); // Featured image URL
        
        // Fallback for featured image in case none is set
        if ( !$featured_image_url ) {
            $featured_image_url = 'https://skinandcancerinstitute.com/wp-content/uploads/location/default-image.jpg'; // Replace with your default image URL
        }
        ?>
        <div class="location-card">
            <a class="image-link" href="<?php echo esc_url( $location_url ); ?>">
                <div class="location-card-image">
                    <div class="location-logo">
                        <img src="https://skinandcancerinstitute.com/wp-content/themes/glacial-theme-2.1.1/images/logo-colored.png" alt="Skin and Cancer Institute logo">
                    </div>
                    <img src="<?php echo esc_url( $featured_image_url ); ?>" class="location-main-image wp-post-image" alt="<?php echo esc_attr( $location_name ); ?>">
                </div>
            </a>
            <div class="location-card__body">
                <h5 class="location-card__title">
                    <a href="<?php echo esc_url( $location_url ); ?>"><?php echo esc_html( $location_name ); ?></a>
                </h5>
                <h3 class="location-card__location-name">
                    <a href="<?php echo esc_url( $location_url ); ?>">
                        <?php echo esc_html( $location_name ); ?> Dermatology &amp; Skin Cancer
                    </a>
                </h3>
                <p><?php echo esc_html( $address ); ?></p>
                <div class="ui-button-set">
                    <a class="ui-button" href="<?php echo esc_url( $appointment_url ); ?>" target="_blank" rel="noopener nofollow" aria-label="Book Appointment - Opens in new tab">Book Appointment</a>
                    <a class="ui-button no-background" href="<?php echo esc_url( $more_info_url ); ?>">More Info</a>
                </div>
            </div>
        </div>
        <?php
    endwhile;
else : 
    ?>
    <p><?php esc_html_e( 'Sorry, no stores found.' ); ?></p>
    <?php
endif;

// Restore original post data
wp_reset_postdata(); 
?>


<?php wp_footer(); ?>