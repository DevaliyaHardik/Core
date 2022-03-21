<?php Ccc::loadClass('Model_Core_Row');

class Model_Order_Item extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Order_Item_Resource');
		parent::__construct();
	}
}

?>