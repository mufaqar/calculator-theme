<?php
/**
* Template Name: Calc
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/

// Input data (replace this with your array of data)

$jobs = [
    ['name' => 'Sebastian Sambor', 'from' => 'Jun-01-2020', 'to' => 'Jul-04-2020', 'gross_earning' => '3012.5'],
    ['name' => 'Sebastian Sambor', 'from' => 'Jul-05-2020', 'to' => 'Jul-31-2020', 'gross_earning' => '3201.5'],
    ['name' => 'Flatscapes Roof Systems', 'from' => 'Aug-01-2020', 'to' => 'Dec-15-2020', 'gross_earning' => '25410.28'],
    ['name' => 'EI Benefits', 'from' => 'Jan-31-2021', 'to' => 'Jun-26-2021', 'gross_earning' => '12495.0'],
    ['name' => 'Casual - Hutton Sheetmetal', 'from' => 'Aug-30-2021', 'to' => 'Aug-31-2021', 'gross_earning' => '300'],
    ['name' => 'Stybeck Roofing', 'from' => 'Nov-04-2021', 'to' => 'Nov-15-2021', 'gross_earning' => '1517'],
    ['name' => 'Conestoga Roofing', 'from' => 'Nov-29-2021', 'to' => 'Apr-29-2022', 'gross_earning' => '14914.99'],
    ['name' => 'Bek Roofing', 'from' => 'May-25-2022', 'to' => 'Jun-09-2022', 'gross_earning' => '3219.84'],
    ['name' => 'Casual - Peter Sommerfeld', 'from' => 'Jul-01-2022', 'to' => 'Jul-01-2022', 'gross_earning' => '400'],
    ['name' => 'Eileen Roofing', 'from' => 'Jul-04-2022', 'to' => 'Jul-31-2022', 'gross_earning' => '4059.99']
];


echo "<h2>Jobs entered by User</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Name</th><th>From</th><th>To</th><th>Gross Earning</th></tr>";

foreach ($jobs as $job) {
    echo "<tr>";
    echo "<td>{$job['name']}</td>";
    echo "<td>{$job['from']}</td>";
    echo "<td>{$job['to']}</td>";
    echo "<td>{$job['gross_earning']}</td>";
    echo "</tr>";
}

echo "</table>";


$date_of_lose = "Jun-23-2020";
$lastJob = end($jobs);
$ldate = new DateTime($date_of_lose);
$ldate->modify('+1 year');
$after_one_year_ldate = $ldate->format('M-d-Y'); 
$start_date_after_date_of_lose;

// Function to calculate the number of days between two dates
function calculateDays($fromDate, $toDate) {
    $from = DateTime::createFromFormat('M-d-Y', $fromDate);
    $to = DateTime::createFromFormat('M-d-Y', $toDate);
    $interval = $from->diff($to);
    return $interval->days + 1; // Add 1 to include the last day
}

function calculateTotalDays($from, $to) {
    // Convert the date strings into DateTime objects
    $date1 = new DateTime($from);
    $date2 = new DateTime($to);
    // Get the difference between the two dates
    $interval = $date1->diff($date2);
    // Return the total number of days
    return $interval->days;
}

// Initialize array to store result
$jobDurations = [];
// $pre_and_post_dol_meta = [];

foreach ($jobs as $job) {
    $days = calculateDays($job['from'], $job['to']);
    $jobDurations[] = [
        'job_title' => $job['name'],
        'from' => $job['from'],
        'to' => $job['to'],
        'total_days' => $days,
        'gross_earnings' => $job['gross_earning'],
        'pre_accident_income' => 0,
        'no_of_weeks' => $days/7,
    ];
}

// Define the 52-week period starting from "Jun-01-2020"
$startDate = DateTime::createFromFormat('M-d-Y', $jobs[0]['from']);
$endDate = clone $startDate;
$endDate->modify('+52 weeks'); // Calculate end date 52 weeks later

// Check if each job's start date falls within the 52-week range
foreach ($jobDurations as $index => $job) {
    $jobStartDate = DateTime::createFromFormat('M-d-Y', $job['from']);
    if ($jobStartDate >= $startDate && $jobStartDate <= $endDate) {
        // Here check Date of lose exist in 52 weeks date or not? and get the diffecrence of days
        $from_date = strtotime($job['from']);
        $to_date = strtotime($job['to']);
        $lose_date = strtotime($date_of_lose);
        $grossEarning = $job['gross_earnings'];
        $totalDaysOfJob = $job['total_days'];
        $oneY = strtotime($after_one_year_ldate);

        // Check if from date is greater the date of lose after one year !!!
        if($to_date < $oneY){
            if ($lose_date >= $from_date && $lose_date <= $to_date){
                // Get difference between DOL and JOb To date if exist in 52 weeks and DOL exist between From and To Date!!!!
                $daysDifference = calculateDays($date_of_lose, $job['to']) - 1;
                $earning_after_date_of_lose = $grossEarning/$totalDaysOfJob * $daysDifference;
                // Update $jobDurations Array 
                $jobDurations[$index]['pre_accident_income'] = $earning_after_date_of_lose;
            } else {
                // If no loss within the job period, set pre_accident_income to gross earnings
                $jobDurations[$index]['pre_accident_income'] = $grossEarning;
            }
        }else{
            // Create DateTime objects from the string dates
            $date1 = new DateTime($job['to']);
            $date2 = new DateTime($after_one_year_ldate);
            // Calculate the difference
            $interval = $date1->diff($date2);

            $per_day_earning = $jobDurations[$index]['gross_earnings'] / $jobDurations[$index]['total_days'];
            $remaningDays = $jobDurations[$index]['total_days'] - $interval->d;
            $jobDurations[$index]['pre_accident_income'] = $remaningDays * $per_day_earning;
            $jobDurations[$index]['total_days'] = $remaningDays;
        }
        
        
    } else {
        // Now Modify $jobDurations Array with anothe Array and calculate PRE and POST income 
        // After Date of lose !!!! and add EMPTY dates thats he will not work :)
        $date = DateTime::createFromFormat('M-d-Y', $date_of_lose);
        $date->modify('+1 day');
        $start_date_after_date_of_lose = $date->format('M-d-Y');

        $start = DateTime::createFromFormat('M-d-Y', $start_date_after_date_of_lose);
        $end = DateTime::createFromFormat('M-d-Y', $lastJob['to']);

        $interval = new DateInterval('P1D'); // 1-day interval
        $dateRange = new DatePeriod($start, $interval, $end);

        // To include the end date, we can add one more day to the $end and re-loop.
        $end->modify('+1 day');
        foreach (new DatePeriod($start, $interval, $end) as $d) {
            if ($job['from'] == $d->format('M-d-Y')) {
                for ($i = 0; $i < count($jobDurations); $i++) {
                    if ($jobDurations[$i]['pre_accident_income'] == 0) {
                        $jobDurations[$i]['pre_accident_income'] = $jobDurations[$i]['gross_earnings'];
                        break; // Exit the loop once the condition is met
                    }
                }
                break;
            }
        }

    }
}


$formattedJobs = [];
$date = new DateTime($date_of_lose);
$date->modify('+1 year');
$date = $date->format('M-d-Y'); 

for ($i = 0; $i < count($jobDurations); $i++) {
    // Add the current job to the result
    $formattedJobs[] = $jobDurations[$i];

    // Check if there is a next job and a gap between the jobs
    if (isset($jobDurations[$i + 1])) {
        $currentTo = strtotime($jobDurations[$i]['to']);
        $nextFrom = strtotime($jobDurations[$i + 1]['from']);
        
        if(strtotime($date) < $nextFrom ){
            // If there's a gap, insert a "No Job" period
            if ($nextFrom > strtotime('+1 day', $currentTo)) {
                $totalDays = calculateDays(date('M-d-Y', strtotime('+1 day', $currentTo)), date('M-d-Y', strtotime('-1 day', $nextFrom)));
                $formattedJobs[] = [
                    'job_title' => 'No Job',
                    'from' => date('M-d-Y', strtotime('+1 day', $currentTo)),
                    'to' => date('M-d-Y', strtotime('-1 day', $nextFrom)),
                    'total_days' => $totalDays,
                    'gross_earnings' => 0,
                    'pre_accident_income' => 0,
                    'no_of_weeks' => $totalDays/7,
                ];
            }
        }
    }
}

// Output the new array with gaps filled
// echo "Formatted Jobs";
// //print_r($formattedJobs);

// echo "<table border='1' cellpadding='10'>";
// echo "<tr><th>Name</th><th>From</th><th>To</th><th>Gross Earning</th><th>Days</th><th>Weeks</th></tr>";

// foreach ($formattedJobs as $job) {
//     echo "<tr>";
//     echo "<td>{$job['job_title']}</td>";
//     echo "<td>{$job['from']}</td>";
//     echo "<td>{$job['to']}</td>";
//     echo "<td>{$job['gross_earnings']}</td>";
//     echo "<td>{$job['total_days']}</td>";
//     echo "<td>{$job['no_of_weeks']}</td>";
//     echo "</tr>";
// }

// echo "</table>";

$startDate = strtotime($start_date_after_date_of_lose);
$endDate = strtotime($date);

$matchingObjects = [];
$totalPreAccidentIncome = 0;
$seventeen_percent;

foreach ($formattedJobs as $job) {
    $jobFrom = strtotime($job['from']);
    $jobTo = strtotime($job['to']);

    // Calculate total weeks
    $total_days = calculateTotalDays($date_of_lose, $date);
    $total_weeks = $total_days / 7;

    // Check if the job falls within the range
    if (($jobFrom >= $startDate && $jobFrom <= $endDate) || 
        ($jobTo >= $startDate && $jobTo <= $endDate) || 
        ($jobFrom <= $startDate && $jobTo >= $endDate)) {
        $totalPreAccidentIncome += sprintf("%.2f", $job['pre_accident_income']);
        $totalWeeks = sprintf("%.2f", $total_weeks);
        $grossWeeklyIncome = sprintf("%.2f", $totalPreAccidentIncome/$total_weeks);
        $seventeen_percent = sprintf("%.2f", $grossWeeklyIncome * 0.7);
    }else{
        $tw = $job['total_days']/7;
        $gvi = $job['pre_accident_income']/$tw;
        $_70per = $gvi * 0.7;
        $val = [
            "from" => $job['from'],
            "to" => $job['to'],
            "total_pre_accident_income" => $job['gross_earnings'],
            "total_weeks" => sprintf("%.2f", $tw),
            "gross_weekly_income" => sprintf("%.2f", $gvi),
            "70_per_weekly_income" => sprintf("%.2f", $_70per),
        ];
        $matchingObjects[] = $val;
    }
}

$valuesArray = [
    "from" => $start_date_after_date_of_lose,
    "to" => $date,
    "total_pre_accident_income" => $totalPreAccidentIncome,
    "total_weeks" => $totalWeeks,
    "gross_weekly_income" => $grossWeeklyIncome,
    "70_per_weekly_income" => $seventeen_percent,
];

array_unshift($matchingObjects, $valuesArray);


// Print matching objects
echo "<h2>A2 Emp Calculation :</h2>";
// print_r($matchingObjects);
// echo "</pre>";

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>From</th><th>To</th><th>Pre Acc Income</th><th>Weeks</th><th>gross_weekly_income</th><th>70%</th></tr>";

foreach ($matchingObjects as $job) {
    echo "<tr>";

    echo "<td>{$job['from']}</td>";
    echo "<td>{$job['to']}</td>";
    echo "<td>{$job['total_pre_accident_income']}</td>";
    echo "<td>{$job['total_weeks']}</td>";
    echo "<td>{$job['gross_weekly_income']}</td>";
    echo "<td>{$job['70_per_weekly_income']}</td>";
    echo "</tr>";
}

echo "</table>";



// PART 2
$Past_Income_Replacement_Benefits_Payable = [];

foreach ($matchingObjects as $job) {
    $from = $job['from'];
    $to = $job['to'];
    $_100_of_OIRA = 0.00;
    $PolicyMax = 400;
    $Weekly_IRBs_before_applying_post_accident_income = $PolicyMax;
    $_70_of_post_accident_income = $seventeen_percent;
    $Weekly_IRB_payable = max($Weekly_IRBs_before_applying_post_accident_income -  $job['70_per_weekly_income'], 0);
    $totalWeeks = $job['total_weeks'];

    $obj = [
        'from' => $from,
        'to' => $to,
        "Number_of_days" => calculateTotalDays($from, $to),
        "70%_of_Gross_weekly_income" => $job['70_per_weekly_income'],
        "100%_of_OIRA" => $_100_of_OIRA,
        "Total_before_applying_policy_max" => $job['70_per_weekly_income'] - $_100_of_OIRA,
        "Policy_Max" => $PolicyMax,
        "Policy_Max" => $PolicyMax,
        "Weekly_IRBs_before_applying_post_accident_income" => $Weekly_IRBs_before_applying_post_accident_income,
        "70%_of_post_accident_income" => $job['70_per_weekly_income'],
        "Weekly_IRB_payable" => $Weekly_IRB_payable,
        "Number_of_weeks_in_the_period" => $job['total_weeks'],
        "Past_IRBs_payable" => $Weekly_IRB_payable * $totalWeeks,

    ];

    $Past_Income_Replacement_Benefits_Payable[] = $obj;
}


//print_r($Past_Income_Replacement_Benefits_Payable);

// Displaying the result as an HTML table

echo "<h2>A3 - Past IRBs Payable Calucations </h2>";
echo "<table border='1' cellpadding='2'>";
echo "<tr>
        <th>From</th>
        <th>To</th>
        <th>Days</th>
        <th>70% of Gross Weekly Income</th>
        <th> OIRA</th>
        <th>Total  Policy Max</th>
        <th>Policy Max</th>
        <th>Weekly IRBs before Applying Post-Accident Income</th>
        <th>70% of Post-Accident Income</th>
        <th>Weekly IRB Payable</th>
        <th>Number of Weeks in the Period</th>
        <th>Past IRBs Payable</th>
      </tr>";


foreach ($Past_Income_Replacement_Benefits_Payable as $benefit) {
    echo "<tr>";
    echo "<td>{$benefit['from']}</td>";
    echo "<td>{$benefit['to']}</td>";
    echo "<td>{$benefit['Number_of_days']}</td>";
    echo "<td>{$benefit['70%_of_Gross_weekly_income']}</td>";
    echo "<td>{$benefit['100%_of_OIRA']}</td>";
    echo "<td>{$benefit['Total_before_applying_policy_max']}</td>";
    echo "<td>{$benefit['Policy_Max']}</td>";
    echo "<td>{$benefit['Weekly_IRBs_before_applying_post_accident_income']}</td>";
    echo "<td>{$benefit['70%_of_post_accident_income']}</td>";
    echo "<td>{$benefit['Weekly_IRB_payable']}</td>";
    echo "<td>{$benefit['Number_of_weeks_in_the_period']}</td>";
    echo "<td>{$benefit['Past_IRBs_payable']}</td>";
    echo "</tr>";
}

echo "</table>";
