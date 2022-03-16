<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer_Address extends Model_Core_Row
{
	protected $customer = null;
	public function __construct()
	{
		$this->setResourceClassName('Customer_Address_Resource');
		parent::__construct();
	}

	public function setCustomer(Mode_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer($reload = false)
	{
		$customerModel = Ccc::getModel('Customer');
		if(!$this->customer_id){
			return $customerModel;
		}
		if($this->customer && !$reload){
			return $this->customer;
		}

		$customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customer_id` = {$this->customer_id}");
		if(!$customer){
			return $customerModel;
		}
		$this->setCustomer($customer);
		return $this->customer;
	}
}

?>