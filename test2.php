<?php
/*
Template Name: Test2
*/
get_header();
?>

<?php



// Retrieve posts by category
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
        echo "DOL : " . $dol . "<br/>";

        $paystubs_meta = get_post_meta($post_id, 'paystubs', true);
        // print "<pre>";
        // print_r($paystubs_meta);
        // print "</pre>";
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
           
        }    
                $week4Earning_arr[] = array_sum($week_4arr);
                $week52Earning_arr[] = array_sum($week_52arr);

            // Print the accumulated results
        echo "4Week Earnings: " . implode(", ", $week_4arr) . "<br/>";
        echo "52Week Earnings: " . implode(", ", $week_52arr) . "<br/>";

        echo array_sum($week_4arr). "<br/>";
        echo array_sum($week_52arr). "<br/>";


        echo "<hr/>";
    }
   
    
} 

 $FW4 = array_sum($week4Earning_arr);
 $FW52 = array_sum($week52Earning_arr);
$WeeklyIRB_4 =  ($FW4/4*0.7);
$WeeklyIRB_52 =  ($FW52/52*0.7);

echo $WeeklyIRB_4 ."<br/>";
echo $WeeklyIRB_52










?>

<?php
// Sample array of jobs with start and end dates
$jobs = [
    ["title" => "Job 1", "start_date" => "2023-06-01", "end_date" => "2023-06-05"],
    ["title" => "Job 2", "start_date" => "2023-06-03", "end_date" => "2023-06-10"],
    ["title" => "Job 3", "start_date" => "2023-06-07", "end_date" => "2023-06-12"],
];

// Function to calculate the number of days between two dates
function calculateDuration($start_date, $end_date) {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    return $interval->days;
}

// Calculate durations
$durations = [];
$total_duration = 0;
foreach ($jobs as $job) {
    $duration = calculateDuration($job['start_date'], $job['end_date']);
    $durations[] = $duration;
    $total_duration += $duration;
}



?>


<style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot {
            font-weight: bold;
        }
    </style>

    <title>Jobs Table</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tfoot {
            font-weight: bold;
        }
    </style>
</head>
<body>


<table>
    <thead>
        <tr>
            <th></th>
            <?php foreach ($jobs as $job): ?>
                <th><?php echo htmlspecialchars($job['title']); ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Start Date</th>
            <?php foreach ($jobs as $job): ?>
                <td><?php echo htmlspecialchars($job['start_date']); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th>End Date</th>
            <?php foreach ($jobs as $job): ?>
                <td><?php echo htmlspecialchars($job['end_date']); ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th>Number of Days</th>
            <?php foreach ($durations as $duration): ?>
                <td><?php echo $duration; ?></td>
            <?php endforeach; ?>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td colspan="<?php echo count($jobs); ?>"><?php echo $total_duration; ?></td>
        </tr>
    </tfoot>
</table>



<?php wp_footer(); ?>
