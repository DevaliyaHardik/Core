<?php Ccc::loadClass('Model_Core_Row_Resource');


class Model_Admin_Resource extends Model_Core_Row_Resource
{
	public function __construct()
	{
		$this->setTableName('admin')->setPrimaryKey('admin_id');
		parent::__construct();
	}

}


?>