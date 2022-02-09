<?php
echo '<pre>';

$data = [

	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];

$same = [0];
$same1 = [0];
$same2 = [0];
$same3 = [0];
$same4 = [0];
$same5 = [0];
$convert = [];
foreach($data as $data1){
	if(!in_array($data1['category'],$same)){
		$convert['category'][$data1['category']] = [];
		array_push($same,$data1['category']);
	 }
	if(!in_array($data1['categoryname'],$same1)){
    	$convert['category'][$data1['category']]['name'] = $data1['categoryname'];
		array_push($same1,$data1['categoryname']);
	}
    if(!in_array($data1['attribute'],$same2)){
        $convert['category'][$data1['category']]['attribute'][$data1['attribute']] = [];
        array_push($same2,$data1['attribute']);
    }
    if(!in_array($data1['attributename'],$same3)){
        $convert['category'][$data1['category']]['attribute'][$data1['attribute']]['name'] = $data1['attributename'];
        array_push($same3,$data1['attributename']);
    }
    if(!in_array($data1['option'],$same4)){
        $convert['category'][$data1['category']]['attribute'][$data1['attribute']]['option'][$data1['option']] = [];
        array_push($same4,$data1['option']);
    }
    if(!in_array($data1['optionname'],$same5)){
        $convert['category'][$data1['category']]['attribute'][$data1['attribute']]['option'][$data1['option']]['name'] = $data1['optionname'];
        array_push($same5,$data1['option']);
    }

}
echo "tree structure";

print_r($convert);

/*$data = [
	'category'=> [
		'1'=>[
			'name' => 'c1',
			'attribute'=>[
				'1' => [
					'name'=>'a1',
					'option' => [
						'1'=>[
							'name' => 'o1'
						],
						'2'=>[
							'name' => 'o2'
						]
					]
				],
				'2' => [
					'name'=>'a2',
					'option' => [
						'3'=>[
							'name' => 'o3'
						],
						'4'=>[
							'name' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'name' => 'c2',
			'attribute'=>[
				'3' => [
					'name'=>'a3',
					'option' => [
						'5'=>[
							'name' => 'o5'
						],
						'6'=>[
							'name' => 'o6'
						]
					]
				],
				'4' => [
					'name'=>'a4',
					'option' => [
						'7'=>[
							'name' => 'o7'
						],
						'8'=>[
							'name' => 'o8'
						]
					]
				]
			]
		]
	]
];*/
//echo count($convert['category']);exit;
$reverce = [];
$j = 0;
for($x=0;$x<count($convert['category']);$x++){
    for($y=0;$y<count($convert['category'][array_keys($convert['category'])[$x]]['attribute']);$y++){
        for($z=0;$z<count($convert['category'][array_keys($convert['category'])[$x]]['attribute'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y]]['option']);$z++){
           $reverce[$j]['category'] = array_keys($convert['category'])[$x];
		   $reverce[$j]['categoryname'] = $convert['category'][array_keys($convert['category'])[$x]]['name'];
		   $reverce[$j]['attribute'] = array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y];
		   $reverce[$j]['attributename'] = $convert['category'][array_keys($convert['category'])[$x]]['attribute'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y]]['name'];
		   $reverce[$j]['option'] = array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y]]['option'])[$z];
		   $reverce[$j]['optionname'] = $convert['category'][array_keys($convert['category'])[$x]]['attribute'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y]]['option'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'][array_keys($convert['category'][array_keys($convert['category'])[$x]]['attribute'])[$y]]['option'])[$z]]['name'];
		   $j++;
        }
    }
}
echo "normal structure";
print_r($reverce);
?>