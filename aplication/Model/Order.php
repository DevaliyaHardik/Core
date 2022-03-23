<?php Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row
{
	protected $bilingAdress;
	protected $shipingAddress;
	protected $items;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName("Order_Resource");
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
		$addressModel = Ccc::getModel('Order_Address');
		if(!$this->order_id)
		{
			return $addressModel;
		}
		if($this->bilingAddress && !$reload)
		{
			return $this->bilingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `order_address` WHERE `order_id` = {$this->order_id} AND `biling` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setBilingAddress($address);

		return $this->bilingAddress;
	}

	public function setBilingAddress(Model_Order_Address $address)
	{
		$this->bilingAddress = $address;
		return $this;
	}

	public function getShipingAddress($reload = false)
	{

		$addressModel = Ccc::getModel('Order_Address');
		if(!$this->order_id)
		{
			return $addressModel;
		}
		if($this->shipingAddress && !$reload)
		{
			return $this->shipingAddress;
		}
		$address=$addressModel->fetchRow("SELECT * FROM `order_address` WHERE `order_id` = {$this->order_id} AND `shiping` = 1");
		if(!$address)
		{
			return $addressModel;
		}
		$this->setShipingAddress($address);

		return $this->shipingAddress;
	}

	public function setShipingAddress(Model_Order_Address $address)
	{
		$this->shipingAddress = $address;
		return $this;
	}

	public function getItems($reload = false)
	{

		$itemModel = Ccc::getModel('Order_Item');
		if(!$this->order_id)
		{
			return $itemModel;
		}
		if($this->items && !$reload)
		{
			return $this->items;
		}
		$items=$itemModel->fetchAll("SELECT * FROM `order_item` WHERE `order_id` = {$this->order_id}");
		if(!$items)
		{
			return $itemModel;
		}
		$this->setItems($items);
		return $this->items;
	}

	public function setItems($items)
	{
		$this->items = $items;
		return $this;
	}
}

?>