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
           if (strpos($key, 'paystub') === 0) {
               $earning_meta[$key] = unserialize($value[0]);
           }
       }

       print "<pre>";
       //print_r ( $earning_meta );

  
       $dateOfLoss = 'Jan-15-2024';
       $fourWeeksPrior = calculateDateFourWeeksPrior($dateOfLoss);  
       $fiftyTwoWeeksPrior = calculateDateFiftyTwoWeeksPrior($dateOfLoss);  

      
       echo '<table border="1" width="900">';
       echo '<tr><th>Date Range</th><th>4 Weeks</th><th>52 Weeks</th></tr>';
       echo '<tr><th></th><th>'.$fourWeeksPrior.'</th><th>'.$fiftyTwoWeeksPrior.'</th></tr>';

       echo '<tr><th>DOL</th><th>'.$dateOfLoss.'</th><th>'.$dateOfLoss.'</th></tr>';


    
       
       
       // Initialize sums
       $sum_4_weeks = 0;
       $sum_52_weeks = 0;
       
       foreach ($earning_meta as $key => $value) {
        echo '<tr>';
        
        // Calculate durations
        $from_date = $value['from_date'];
        $to_date = $value['to_date'];
        $duration = calculateDaysBetweenDates($from_date, $to_date);
        $duration_exist = calculateOrigianlDaysBetweenDates($dateOfLoss, $to_date);
        
       

        if (isDateInRange($from_date, $to_date, $dateOfLoss)) {

            echo '<td>' . $from_date . ' to ' . $to_date . ' (' . $duration . " days- Propoted Days" . $duration_exist .' )</td>';
           

        }
        else {
            echo '<td>' . $from_date . ' to ' . $to_date . ' (' . $duration  .' days)</td>';

        }
        
        if (isset($value['4_weeks']) && $value['4_weeks'] === 'on') {
            // Calculate earning for 4 weeks based on duration
            $earning_4_weeks = round($value['earning'] / $duration * 4);
            echo '<td>' . $earning_4_weeks . '</td>';
            // Accumulate sum for 4 weeks
            $sum_4_weeks += $earning_4_weeks;
        } else {
            echo '<td> 0 </td>';
        }
        
        if (isset($value['52_weeks']) && $value['52_weeks'] === 'on') {
            // Calculate earning for 52 weeks
         
            // Accumulate sum for 52 weeks
            if (isDateInRange($from_date, $to_date, $dateOfLoss)) {
               
             
         
              
                echo '<td>{' .  ($value['earning']  * $duration_exist )/ $duration . '}</td>';
            } else {
                $sum_52_weeks += $value['earning'];
                echo '<td>' . $sum_52_weeks . '</td>';
            }
        } else {
            echo '<td>0</td>';
        }
        
        echo '</tr>';
    }
    
       
       // Display sums in a separate row
       echo '<tr><td><b>Total</b></td><td>' . round($sum_4_weeks) . '</td><td>' . round($sum_52_weeks) . '</td></tr>';
       
       echo '</table>';
       
     


    //  print_r($earning_meta);
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}
?>