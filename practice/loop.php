<?php

//we have four type of loop for,while,do while,foreach

//for loop
for($i=0;$i<10;$i++){
	echo $i.",";
}
echo "<br>";

//while loop
$j = 1;
while($j<=10){
	echo $j.",";
	$j++;
}
echo "<br>";

//do while
$k = 0;
//do while loop perform action at least one time if condition is alradey wrong
do{
	echo $k.",";
	$j++;
}while($k<0);
echo "<br>";

//foreach loop
$car_prize = array("maruti" => 100000,"tata" => 1000000,"bugadi" => 14000000);

foreach($car_prize as $key => $value){
	echo $key."s prize is ".$value;
	echo "<br>";
}
?>