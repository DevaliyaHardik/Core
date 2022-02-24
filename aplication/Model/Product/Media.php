<?php Ccc::loadClass('Model_Core_Table');

class Model_Product_Media extends Model_Core_Table
{
	public function __construct()
	{
		$this->setTableName('media')->setPrimaryKey('image_id');
	}

}

?>