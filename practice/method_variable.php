<?php

echo "<pre>";

class fruits{

    public $name = null;
    protected $prize = 0;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setPrize($prize)
    {
        if(gettype($prize) == "integer"){
            $this->prize = $prize;
            return $this;
        }
        else{
            return;
        }
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrize()
    {
        return $this->prize;
    }
}

$apple = new fruits();

print_r($apple);
echo "<br>";

$apple->setName("apple");
$apple->setprize(100);

print_r($apple);
echo "<br>";

$banana = $apple;
print_r($banana);

$apple->setName("banana")->setPrize(25);//if we write return in the class method then only we use this type of mathon call
print_r($banana);
echo "<br>";

print_r($apple);

?>