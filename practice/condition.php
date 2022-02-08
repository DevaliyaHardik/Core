<?php

//we have two type of conditional statment if...else and switch

//if statment
$status = true;

if($status){
	echo "success";
}
else{
	echo "failed";
}
echo "<br>";

//if..elseif..else
$age = 17;
if($age > 18){
	echo "you can drive all vihical";
}
elseif($age>16 && $age < 18){
	echo "you can drive only without gire vihical";
}
else{
	echo "you can't drive any vihical";
}
echo "<br>";

//switch statment
$name = "hardik";
switch($name){
	case "uday":
		echo "hello uday";
		break;
	case "nimesh":
		echo "hello nimesh";
		break;
	case "hardik":
		echo "hello hardik";
		break;
	default:
		echo "you are not invited";
}

?> 