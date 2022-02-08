<?php 

echo "<pre>";

class Market{
	public $prize = null;

	public function setPrize($prize)
	{
		$this->prize = $prize;
		return $this;
	}

	public function getPrize()
	{
		return $this->prize;
	}
}

class Chiled extends Market {

}

$p1 = new Market();
$p1->setPrize(10.00);

print_r($p1->getPrize());
echo "<br>";

$p2 = new Chiled();
print_r($p2->getPrize());
?>