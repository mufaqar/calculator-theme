<?php
/**
* Template Name: Calculation
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/



function generateWeeks($from_date, $to_date, $pre_accident_income, $accidental_date) {
    $start = DateTime::createFromFormat('d-M-y', $from_date);
    $end = DateTime::createFromFormat('d-M-y', $to_date);
    $accident = DateTime::createFromFormat('d-M-y', $accidental_date);
    $weeks = [];
    $week_number = 1;

    // Iterate from start date to end date in weekly intervals
    while ($start <= $end) {
        // Week start date
        $week_start = clone $start;

        // Add 6 days to get the week end date
        $week_end = clone $start;
        $week_end->modify('+6 days');

        // If the week end date exceeds the end date, set it to the end date
        if ($week_end > $end) {
            $week_end = $end;
        }

        // Determine if the week is after the accidental date
        if ($week_start > $accident) {
            // Calculate 70% of pre-accident income for post-accident weeks
            $post_accident_income = $pre_accident_income * 0.70;
        } else {
            $post_accident_income = null;
        }

        // IRB Payable (D - E - F)
        $weekly_irb_payable = 0;

        // Calculate 1% interest on IRB Payable, compounded (simplified to weekly calculation)
        $interest_to_date = 0;

        // Calculate balance (G + H)
        $balance = 0;

        // Add to weeks array with all necessary columns
        $weeks[] = [
            'week_number' => $week_number++,
            'from' => $week_start->format('d-M-y'),
            'to' => $week_end->format('d-M-y'),
            'pre_accident_income' => $pre_accident_income,
            '70%_of_gross_weekly_post_accident_income' => $post_accident_income,
            '100%_of_post_accident_other_income' => null,
            'weekly_irb_payable' => $weekly_irb_payable,
            'interest_to_date' => $interest_to_date,
            'balance' => $balance
        ];

        // Move start to the next day after the current week's end
        $start->modify('+7 days');
    }

    return $weeks;
}

$from_date = "23-Jun-21";
$to_date = "26-Jul-22"; // You can adjust this to your desired range
$pre_accident_income = 400; // Value for pre-accident income
$accidental_date = "18-Jan-22"; // Date of accident

$weeks = generateWeeks($from_date, $to_date, $pre_accident_income, $accidental_date);

// Display the table
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Week</th>
        <th>Date From</th>
        <th>Date To</th>
        <th>Weekly IRB Entitlement</th>
        <th>70% of Gross Weekly Post-Accident Income</th>
        <th>100% of Post-Accident Other Income Replacement Assistance</th>
        <th>Weekly IRB Payable</th>
        <th>Interest to Date, O. Reg. 236/14, s. 1</th>
        <th>Balance</th>
      </tr>";

// Loop through each week and output the table rows
foreach ($weeks as $week) {
    echo "<tr>";
    echo "<td>" . $week['week_number'] . "</td>";
    echo "<td>" . $week['from'] . "</td>";
    echo "<td>" . $week['to'] . "</td>";
    echo "<td>" . ($week['pre_accident_income'] !== null ? "$" . number_format($week['pre_accident_income'], 2) : "-") . "</td>";
    echo "<td>" . ($week['70%_of_gross_weekly_post_accident_income'] !== null ? "$" . number_format($week['70%_of_gross_weekly_post_accident_income'], 2) : "-") . "</td>";
    echo "<td>" . ($week['100%_of_post_accident_other_income'] !== null ? "$" . number_format($week['100%_of_post_accident_other_income'], 2) : "-") . "</td>";
    echo "<td>" . "$" . number_format($week['weekly_irb_payable'], 2) . "</td>";
    echo "<td>" . "$" . number_format($week['interest_to_date'], 2) . "</td>";
    echo "<td>" . "$" . number_format($week['balance'], 2) . "</td>";
    echo "</tr>";
}

echo "</table>";



