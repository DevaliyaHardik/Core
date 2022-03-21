<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer_Price extends Model_Core_Row
{
	protected $customer = null;
	protected $salesman = null;
	public function __construct()
	{
		$this->setResourceClassName('Customer_Price_Resource');
		parent::__construct();
	}

	public function setCustomer(Model_Customer $customer)
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

	public function setSalesman(Model_Salesman $salsesman)
	{
		$this->salsesman = $salsesman;
		return $this;
	}

	public function getSalesman($reload = false)
	{
		$salsesmanModel = Ccc::getModel('Salesman');
		$customerModel = Ccc::getModel('Customer');
		if($this->salesman && !$reload){
			return $this->salesman;
		}
		$customer = $this->getCustomer($reload);
		if(!$customer->salesman_id){
			return $salsesmanModel;
		}
		$salesman = $customer->fetchRow("SELECT * FROM `salesman` WHERE `salesman_id` = {$this->customer->salesman_id}");
		if(!$salesman){
			return $salsesmanModel;
		}
		$this->setSalesman($salesman);
		return $this->salesman;
	}
}

?>