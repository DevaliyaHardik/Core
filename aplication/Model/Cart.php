<?php Ccc::loadClass('Model_Core_Row');

class Model_Cart extends Model_Core_Row
{
	protected $item;
	protected $bilingAdress;
	protected $shipingAddress;
	protected $customer;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName("Cart_Resource");
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
		$addressModel = Ccc::getModel('Cart_Address');
		if(!$this->cart_id)
		{
			return $addressModel;
		}
		if($this->bilingAddress && !$reload)
		{
			return $this->bilingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cart_id` = {$this->cart_id} AND `biling` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBilingAddress($address);

		return $this->bilingAddress;
	}

	public function setBilingAddress(model_cart_address $address)
	{
		$this->bilingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Cart_Address');
		if(!$this->cart_id)
		{
			return $addressModel;
		}
		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cart_id` = {$this->cart_id} AND `shiping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShipingAddress($address);

		return $this->shipingAddress;
	}

	public function setShipingAddress(Model_Cart_Address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

	public function getItem($reload = false)
	{

		$itemModel = Ccc::getModel('Cart_Item');
		if(!$this->cart_id)
		{
			return $itemModel;
		}
		if($this->item && !$reload)
		{
			return $this->item;
		}
		$item=$itemModel->fetchRow("SELECT * FROM `cart_item` WHERE `cart_id` = {$this->cart_id}");
		if(!$item)
		{
			return $itemModel;
		}
		$this->setItem($item);

		return $this->item;
	}

	public function setItem(Model_Cart_Item $item)
	{
		$this->item = $item;
		return $this;
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

}

?>