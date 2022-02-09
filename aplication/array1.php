<?php
echo '<pre>';

$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];
//echo $data[0]['category];
$same = [0];
$same1 = [0];
$convert = [];
foreach($data as $data1){
	if(!in_array($data1['category'],$same)){
		$convert[$data1['category']] = [];
		array_push($same,$data1['category']);
	 }
	 if(!in_array($data1['attribute'],$same1)){
		 $convert[$data1['category']][$data1['attribute']] = [];
		 array_push($same1,$data1['attribute']);
	 }
	 $convert[$data1['category']][$data1['attribute']][$data1['option']] = $data1['option'];
}
/*for($i=0;$i<count($data);$i++){
    if(!in_array($data[$i]['category'],$same)){
       $convert[$data[$i]['category']] = [];
       array_push($same,$data[$i]['category']);
    }
    if(!in_array($data[$i]['attribute'],$same1)){
        $convert[$data[$i]['category']][$data[$i]['attribute']] = [];
		array_push($same1,$data[$i]['attribute']);
    }
    $convert[$data[$i]['category']][$data[$i]['attribute']][$data[$i]['option']] = $data[$i]['option'];

}
*/

print_r($convert);

/*$data = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];
*/

//$i = 1;
//echo count($array[$i]);exit();
//echo count($array['1']['1']);
$reverce = [];
$j = 0;
for($x=1;$x<=count($convert);$x++){
	for($y=1;$y<=count($convert[array_keys($convert)[$x-1]]);$y++){
		for($z=1;$z<=count($convert[array_keys($convert)[$x-1]][array_keys($convert[array_keys($convert)[$x-1]])[$y-1]]);$z++){
			$reverce[$j]['category'] = array_keys($convert)[$x-1];
			$reverce[$j]['attribute'] = array_keys($convert[array_keys($convert)[$x-1]])[$y-1];
			$reverce[$j]['option'] = array_keys($convert[array_keys($convert)[$x-1]][array_keys($convert[array_keys($convert)[$x-1]])[$y-1]])[$z-1];
			$j++;
		}
	}
}
print_r($reverce);


?>