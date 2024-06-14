<?php
/*
Template Name: Tables
*/
get_header();
?>


<?php


$earnings = calculate_earnings();
print "<pre>";
print_r($earnings);
print "</pre>";

$WeeklyIncome_4 = $earnings['WeeklyIncome_4'];

$startDate = '2024-02-22';
$endDate = '2024-03-20';

$weeklyRanges = getWeeklyDateRanges($startDate, $endDate);




?>



<table>
    <thead>
        <tr>
            <th></th>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <th> Post Accident</th>
            <?php endforeach; ?>

    </thead>
    <tbody>
        <tr>
            <td>From </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td><?php echo $range['start']; ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td>To Date</td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td><?php echo $range['end']; ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td>Number of Days</td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td><?php echo $range['days']; ?></td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td>Less: 100% of OIRA (SABS s. 7(1)) </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td><?php echo $WeeklyIncome_4;?> </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td> Total before applying policy max </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$0.00
            </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td> Policy Max
            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$696.25
            </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td> Weekly IRBs before applying post-accident income (Lesser of A and B)
            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$400.00
            </td>
            <?php endforeach; ?>


        <tr>
            <td> Less: 70% of post-accident income
            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$0.00
            </td>
            <?php endforeach; ?>
        </tr>


        <tr>
            <td> Less: 100% of collateral benefits from prior incident
            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$0.00
            </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td> Weekly IRB Payable

            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$400.00
            </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td>Number of weeks in the period


            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>1.00
            </td>
            <?php endforeach; ?>
        </tr>

        <tr>
            <td>Past IRBs payable

            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$400.00
            </td>
            <?php endforeach; ?>
        </tr>


        <tr>
            <td>Total past IRBs payable D + E + F + G = H


            </td>
            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$3,108.93
            </td>
            <?php endforeach; ?>
        </tr>



        <tr>
            <td>Interest

            </td>
            <td>0</td>

        </tr>

        <tr>
            <td>Past IRBs payable plus Interest H + I


            </td>
            <td>$3,108.93
            </td>

        </tr>

        <tr>
            <td> FUTURE WEEKLY IRB PAYABLE (after Mar-20-2024)


            </td>
            <td>$400.00
            </td>
        </tr>


        <tr>
            <td> IRBs Payable



            </td>

            <?php foreach ($weeklyRanges as $index => $range): ?>
            <td>$400.00
            </td>
            <?php endforeach; ?>
        </tr>











    </tbody>
</table>