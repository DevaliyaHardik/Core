<?php 
echo "<pre>";
$info = [
	"1" => [
		"1" => [
			"1" => [1,2,3,4],
			"2" => [1,2,3,4]
		],
		"2" => [
			"1" => [1,2,3,4],
			"2" => [1,2,3,4]
		]
	],
	"2" => [
		"1" => [
			"1" => [1,2,'mango',4],
			"2" => [1,2,3,4]
		],
		"2" => [
			"1" => [1,2,3,4],
			"2" => [1,2,3,'orange']
		]
	]
];

echo $info['2']['1']['1'][2];

$info['2']['1']['1'][1] = 'gavava';

print_r($info);
?>