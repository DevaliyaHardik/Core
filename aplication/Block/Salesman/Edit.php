<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesman_Edit extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/salesman/edit.php");
    }

    public function getSalesman()
    {
        $salesman = $this->getData('salesman');
		return $salesman;
    }
}

?>