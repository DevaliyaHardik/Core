<?php Ccc::loadClass('Model_Core_Row');

class Model_Salesman extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName('Salesman_Resource');
		parent::__construct();
	}

}

?>