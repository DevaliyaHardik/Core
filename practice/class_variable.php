<?php

echo"<pre>";

class cricket{
    public $name = null;
    public $score = 0;

}

$rohit = new cricket();
$rohit->name = "rohit";
$rohit->score = 165;

print_r($rohit);
echo "<br>";

$rahul = $rohit;//in object addresh or location is assigned
print_r($rahul);

$rahul->name = "rahul";
echo "<br>";

print_r($rahul);
echo "<br>";

print_r($rohit);
?>