<?php



$date = new DateTime('F Y');
echo $date->format('F Y')."<br>";
for($i=12; $i>1; $i--) {
$date->modify('-1 month');
echo $date->format('F Y')."<br>";
}