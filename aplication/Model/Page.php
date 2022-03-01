<?php Ccc::loadClass('Model_Core_Row');

class Model_Page extends Model_Core_Row
{
	public function __construct()
	{
		$this->setResourceClassName("Page_Resource");
		parent::__construct();
	}

}

?>