<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
	protected $media = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');
		parent::__construct();
	}

	public function saveCategories($categoryIds)
	{
		if(!$this->product_id){
			throw new Exception("Invalid Request.", 1);
		}
		if(!$categoryIds || !array_key_exists('exists',$categoryIds)){
			$categoryIds['exists'] = [];
		}
		$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
		$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = {$this->product_id} ");
		foreach($categoryProduct as $category){
			if(!in_array($category->category_id,$categoryIds['exists'])){
				$categoryProductModel->load($category->entity_id)->delete();
			}
		}
		if(array_key_exists('new',$categoryIds)){
			foreach($categoryIds['new'] as $categoryId){
				$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
				$categoryProductModel->product_id = $this->product_id;
				$categoryProductModel->category_id = $categoryId;
				$categoryProductModel->save();
			}
		}
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

	public function setMedia(Model_Product_Media $media)
	{
		$this->media = $media;
		return $this;
	}

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media');
		if(!$this->product_id){
			return $mediaModel;
		}
		if($this->media && !$reload){
			return $this->media;
		}

		$media = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `product_id` = {$this->product_id}");
		if(!$media){
			return $mediaModel;
		}

		$this->setMedia($media);
		return $this->media;
	}

	public function getBase()
	{
		$mediaModel = Ccc::getModel('product_Media'); 
		if(!$this->base)
		{
			return $mediaModel;
		}
		$baseName = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `media_id` = {$this->base}");
		if(!$baseName)
		{
			return $mediaModel;
		}

		return $baseName;
	}

	public function getSmall($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->small)
		{
			return $mediaModel;
		}
		$smallName = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `media_id` = {$this->small}");
		if(!$smallName)
		{
			return $mediaModel;
		}

		return $smallName;
	}

	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->thumb)
		{
			return $mediaModel;
		}
		$thumbName = $mediaModel->fetchRow("SELECT * FROM `product_media` WHERE `media_id` = {$this->thumb}");
		if(!$thumbName)
		{
			return $mediaModel;
		}

		return $thumbName;
	}

}

?>