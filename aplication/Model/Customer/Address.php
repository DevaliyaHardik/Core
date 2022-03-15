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
		$customerModal = Ccc::getModel('Customer');
		if(!$this->customer_id){
			return $customerModal;
		}
		if($this->customer && !$reload){
			return $this->customer;
		}

		$customer = $customerModal->fetchRow("SELECT * FROM `customer` WHERE `customer_id` = {$this->customer_id}");
		if(!$customer){
			return $customerModal;
		}
		$this->setCustomer($customer);
		return $this->customer;
	}
}

?>