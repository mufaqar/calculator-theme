<?php
/*
Template Name: Testing
*/
get_header();

?>

<?php




// $from_date = "Dec-15-2023";
// $to_date = "Dec-21-2023";
// $dol = "Jan-15-2024";
// $P4W = $dol - 28 days  //  DOL - 28 days
// $earning = 1800;

// $diff_from_to = $from_date-$to_date;

// $days = $P4W - $to_date ;


// echo $earning/$diff_from_to*$days;


Calc('Dec-15-2023','Dec-21-2023','Jan-15-2024',1800);

Calc('Dec-22-2023','Dec-28-2023','Jan-15-2024',2200);

Calc('Sep-10-2023','Sep-16-2023','Jan-15-2024',4000);

Calc('Nov-1-2023','Nov-15-2023','Jan-15-2024',500);

Calc('Jan-10-2024','Jan-25-2024','Jan-15-2024',2000);




?>


<?php wp_footer(); ?>

</body>

</html>