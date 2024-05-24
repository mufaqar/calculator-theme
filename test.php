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




function Calc($to, $from, $dol, $earing) {

$from_date = new DateTime($to);
$to_date = new DateTime($from);
$dol = new DateTime($dol);
$earning = $earing;


$P4W_F = (clone $dol)->modify('-28 days');
$P4W = $P4W_F->format('M-d-Y');

echo $P4W . "<br/>";

// Calculate the proportional earning
$diff_from_to = $from_date->diff($to_date)->days + 1; 
$diff_sp = $from_date->diff($dol)->days + 1; 
$days = $P4W_F->diff($to_date)->days + 1;


$first = new DateTime(''. $P4W .'');


if($days >= 28 && $diff_sp >= 28){
   $days = 0;
}



if ($to_date >= $first && $to_date <= $dol) {
    echo "Yes" ;
} else {
    echo "No" ."<br>";
    if( $diff_sp <= 28 ) {
        $days = $diff_sp;
    }
}



echo $days ."<br>";



$calculated_earning = ($earning / $diff_from_to) * $days;

echo $calculated_earning , "<hr/>";

}

?>


<?php wp_footer(); ?>

</body>

</html>