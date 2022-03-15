<?php Ccc::loadClass('Model_Core_Row');

class Model_Salesman extends Model_Core_Row
{
	protected $customer = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName('Salesman_Resource');
		parent::__construct();
	}

	public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses)) {
			return $statuses[$key];
		}
		return $statuses[self::STATUS_DEFAULT];
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