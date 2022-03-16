<?php
echo "<pre>";

$name = "hardik";//string variable
$age = 20;//integer variable

$student = array("moni","roni","hardi");//array variable
$students = array("name" => "hardi","age" => 15,"semester" => "5th");//assosiative array

class car{

}
$maruti = new car();//object variable

//for printing
echo $name ." ".$age;//string and integer print throught "echo"
echo "<br>";

print_r($student);//array is print throught "print_r()"; 
echo "<br>";

print_r($maruti);//also array is print throught "print_r()"
echo "<br>";

var_dump($students);//var_dum()used for show variable type and lenth of variable

?>