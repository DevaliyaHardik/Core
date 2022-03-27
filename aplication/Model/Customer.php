	<?php Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row
{
	protected $bilingAddress;
	protected $shipingAddress;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName('Customer_Resource');
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

	public function getBilingAddress($reload = false)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		if(!$this->customer_id)
		{
			return $addressModel;
		}
		if($this->bilingAddress && !$reload)
		{
			return $this->bilingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customer_id` = {$this->customer_id} AND `biling` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBilingAddress($address);
		return $this->bilingAddress;
	}

	public function setBilingAddress(model_customer_address $address)
	{
		$this->bilingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Customer_Address');
		if(!$this->customer_id)
		{
			return $addressModel;
		}
		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customer_id` = {$this->customer_id} AND `shiping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShipingAddress($address);

		return $this->shipingAddress;
	}

	public function setShipingAddress(model_customer_address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

	public function callActionMethod($methodName)
	{
		if($methodName == 'getEditUrl()'){
			return $this->getEditUrl();
		}
		if($methodName == 'getDeleteUrl()'){
			return $this->getDeleteUrl();
		}
	}

	public function getEditUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('edit','customer',['id'=>$this->customer_id]);
	}

	public function getDeleteUrl()
	{
		return Ccc::getModel('Core_View')->getUrl('delete','customer',['id'=>$this->customer_id]);
	}
}

?>