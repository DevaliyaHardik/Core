	<?php Ccc::loadClass('Model_Core_Row');

class Model_Vendor extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Vendor_Resource');
		parent::__construct();
	}

}

?>