<?php
/**
* Template Name: Calculation-2
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/


// Adjusted weekly income to 70% of original
$seventy_per_of_Gross_weekly_income = 561.51;
$policy_max = 400;

// Date ranges with dynamic day calculation
$date_ranges = [
    ['from' => '30-Jun-21', 'to' => '29-Aug-21'],
    ['from' => '4-Nov-21', 'to' => '15-Nov-21'],
    ['from' => '16-Nov-21', 'to' => '28-Nov-21'],
    ['from' => '29-Nov-21', 'to' => '29-Apr-22'],
    ['from' => '30-Apr-22', 'to' => '24-May-22'],
    ['from' => '25-May-22', 'to' => '9-Jun-22'],
    ['from' => '10-Jun-22', 'to' => '30-Jun-22'],
    ['from' => '1-Jul-22', 'to' => '31-Jul-22'],
];

// 100% of OIRA deduction (SABS s. 7(1))
$oira_deduction = 0.00;  // $0.00 deduction


// Function to calculate the number of days between two dates
function calculateDays($from, $to) {
    $from_date = new DateTime($from);
    $to_date = new DateTime($to);
    $interval = $from_date->diff($to_date);
    return $interval->days + 1;  // Add 1 to include both start and end dates
}

// Start the table
echo '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; text-align: center;">';

// Header row (Post Accident)
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td></td>';
    }
    echo '<th colspan="1">Post Accident</th>';
}
echo '</tr>';

// From row
echo '<tr>';
$a=0;
foreach ($date_ranges as $range) {
    if($a === 0) {
        echo '<td style="text-align: left">From</td>';
        $a++;
    }
    echo '<td>' . $range['from'] . '</td>';
}
echo '</tr>';

// To row
echo '<tr>';
$a = 0;
foreach ($date_ranges as $range) {
    if($a === 0) {
        echo '<td style="text-align: left">To</td>';
        $a++;
    }
    echo '<td>' . $range['to'] . '</td>';
}
echo '</tr>';

// Number of Days row
echo '<tr>';
$a = 0;
foreach ($date_ranges as $range) {
    if($a === 0) {
        echo '<td style="text-align: left">Number of Days row</td>';
        $a++;
    }
    $days = calculateDays($range['from'], $range['to']);
    echo '<td>' . $days . '</td>';
}
echo '</tr>';

// 70% of Gross weekly income row
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">70% of Gross weekly income row</td>';
    }
    echo '<td>$' . $seventy_per_of_Gross_weekly_income . '</td>';
}
echo '</tr>';

// Empty row (for spacing)
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Empty row (for spacing)</td>';
    }
    echo '<td>&nbsp;</td>';
}
echo '</tr>';

// Less: 100% of OIRA row
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Less: 100% of OIRA row</td>';
    }
    echo '<td>$' . number_format($oira_deduction, 2) . '</td>';
}
echo '</tr>';

// Total before applying policy max row
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Total before applying policy max row</td>';
    }
    echo '<td>$' . $seventy_per_of_Gross_weekly_income . '</td>';
}
echo '</tr>';

// Policy Max
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Policy Max</td>';
    }
    echo '<td>$' . $policy_max . '</td>';
}
echo '</tr>';

// Weekly IRBs before applying post-accident income (Lesser of A and B)
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Weekly IRBs before applying post-accident income (Lesser of A and B)</td>';
    }
    echo '<td>$' . min($seventy_per_of_Gross_weekly_income, $policy_max) . '</td>';
}
echo '</tr>';

// Less: 70% of post-accident income - Appendix 2
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Less: 70% of post-accident income - Appendix 2</td>';
    }
    echo '<td> - </td>';
}
echo '</tr>';

// Weekly IRB Payable
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Weekly IRB Payable</td>';
    }
    echo '<td> - </td>';
}
echo '</tr>';

// Number of weeks in the period
echo '<tr>';
$a = 0;
foreach ($date_ranges as $range) {
    if($a === 0) {
        echo '<td style="text-align: left">Number of weeks in the period</td>';
        $a++;
    }
    $days = calculateDays($range['from'], $range['to']); // Assuming calculateDays returns the difference in days
    $weeks = $days / 7; // Convert days to weeks
    echo '<td>' . number_format($weeks, 2) . '</td>'; // Format the number of weeks to 2 decimal places
}
echo '</tr>';


// Past IRBs payable
echo '<tr>';
for ($i = 0; $i < count($date_ranges); $i++) {
    if($i === 0) {
        echo '<td style="text-align: left">Past IRBs payable</td>';
    }
    echo '<td> - </td>';
}
echo '</tr>';




// End the table
echo '</table>';


