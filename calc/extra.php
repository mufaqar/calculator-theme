<?php

function calculate_earnings() {
    // Define arguments to retrieve posts
    $args = array(
        'post_type' => 'jobs', // Change 'post' to your custom post type if needed
        'posts_per_page' => -1, // Retrieve all posts
        'job_type' => 'pre-income',
    );

    $jobs_query = new WP_Query($args);

    $week4Earning_arr = [];
    $week52Earning_arr = [];

    if ($jobs_query->have_posts()) {
        while ($jobs_query->have_posts()) {
            $jobs_query->the_post();
            $post_id = get_the_ID();
            $dol = 'Jan-15-2024';
           // echo "DOL : " . $dol . "<br/>";

            $paystubs_meta = get_post_meta($post_id, 'paystubs', true);
            if (is_array($paystubs_meta)) {
                $week_4arr = [];
                $week_52arr = [];
                foreach ($paystubs_meta as $paystub) {
                    $from_date = $paystub['from_date'];
                    $to_date = $paystub['to_date'];
                    $gross_earnings = $paystub['gross_earnings'];
                    $special_condition = $paystub['special_condition'];
                    $results = Calc($from_date, $to_date, $dol, $gross_earnings);
                    $week_4arr[] = $results['4Week'];
                    $week_52arr[] = $results['52Week'];
                }

                $week4Earning_arr[] = array_sum($week_4arr);
                $week52Earning_arr[] = array_sum($week_52arr);

               
                // echo "4Week Earnings: " . implode(", ", $week_4arr) . "<br/>";
                // echo "52Week Earnings: " . implode(", ", $week_52arr) . "<br/>";
                // echo array_sum($week_4arr) . "<br/>";
                // echo array_sum($week_52arr) . "<br/>";
                // echo "<hr/>";
            }
        }
    }

    $FW4 = array_sum($week4Earning_arr);
    $FW52 = array_sum($week52Earning_arr);
    $WeeklyIRB_4 = ($FW4 / 4 * 0.7);
    $WeeklyIRB_52 = ($FW52 / 52 * 0.7);

   // echo $WeeklyIRB_4 . "<br/>";
   // echo $WeeklyIRB_52;

    return array(
        'WeeklyIncome_4' => $WeeklyIRB_4,
        'WeeklyIncome_52' => $WeeklyIRB_52
    );
}