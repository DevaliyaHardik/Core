<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
	protected $media = null;
	protected $thumbName = null;
	protected $smallName = null;
	protected $baseName = null;
	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';

	public function __construct()
	{
		$this->setResourceClassName('Category_Resource');
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

	public function savePath($categoryData)
	{
		if(!array_key_exists('parent_id',$categoryData->getData())){
			$this->path = $this->category_id;
			$result = $this->save();
			
			throw new Exception("This is root category", 1);
		}

		$request = Ccc::getFront()->getRequest();
		if($request->getRequest('id')){
			$categoryId = $request->getRequest('id');
			$allPath = $this->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$categoryId%' ");
			foreach ($allPath as $path) {
				$finalPath = explode('/',$path->path);
				foreach ($finalPath as $subPath) {
					if($subPath == $categoryId){
						if(count($finalPath) != 1){
							array_shift($finalPath);
						}    
						break;
					}
					array_shift($finalPath);
				}
				if($path->parent_id){
					$parentPath = $this->load($path->parent_id);
					$path->path = $parentPath->path ."/".implode('/',$finalPath);
				}
				else{
					$path->path = $path->category_id;
				}
				$result = $path->save();
			}		
		}
		else{
			$categoryData->category_id = $this->category_id;
			$parentPath = $this->load($categoryData->parent_id);
			$categoryData->path = $parentPath->path."/". $this->category_id;
			$result = $categoryData->save();
		}
	}

	public function setMedia($media)
	{
		$this->media = $media;
		return $this;
	}

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media');
		if(!$this->category_id){
			return $mediaModel;
		}
		if($this->media && !$reload){
			return $this->media;
		}

		$media = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `category_id` = {$this->category_id}");
		if(!$media){
			return $mediaModel;
		}

		$this->setMedia($media);
		return $this->media;
	}

	public function getBase($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->base)
		{
			return $mediaModel;
		}
		if($this->baseName && !$reload)
		{
			return $this->baseName;
		}
		$baseName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->base}");
		if(!$baseName)
		{
			return $mediaModel;
		}
		$this->setBase($baseName);

		return $this->baseName;
	}
	public function setBase(Model_Category_Media $baseName)
	{
		$this->baseName =$baseName;
		return $this;
	}
	public function getSmall($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->small)
		{
			return $mediaModel;
		}
		if($this->smallName && !$reload)
		{
			return $this->smallName;
		}
		$smallName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->small}");
		if(!$smallName)
		{
			return $mediaModel;
		}
		$this->setSmall($smallName);

		return $this->smallName;
	}
	public function setSmall(Model_Category_Media $smallName)
	{
		$this->smallName =$smallName;
		return $this;
	}


	public function getThumb($reload = false)
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->thumb)
		{
			return $mediaModel;
		}
		if($this->thumbName && !$reload)
		{
			return $this->thumbName;
		}
		$thumbName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->thumb}");
		if(!$thumbName)
		{
			return $mediaModel;
		}
		$this->setThumb($thumbName);

		return $this->thumbName;
	}
	public function setThumb(Model_Category_Media $thumbName)
	{
		$this->thumbName =$thumbName;
		return $this;
	}
}

?>