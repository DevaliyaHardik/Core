<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
	protected $media = null;
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
			
			return true;
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

		$media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = {$this->category_id}");
		if(!$media){
			return $mediaModel;
		}

		$this->setMedia($media);
		return $this->media;
	}

	public function getBase()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->base)
		{
			return $mediaModel;
		}
		$baseName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->base}");
		if(!$baseName)
		{
			return $mediaModel;
		}

		return $baseName;
	}

	public function getSmall()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->small)
		{
			return $mediaModel;
		}
		$smallName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->small}");
		if(!$smallName)
		{
			return $mediaModel;
		}

		return $smallName;
	}

	public function getThumb()
	{
		$mediaModel = Ccc::getModel('Category_Media'); 
		if(!$this->thumb)
		{
			return $mediaModel;
		}
		$thumbName = $mediaModel->fetchRow("SELECT * FROM `category_media` WHERE `media_id` = {$this->thumb}");
		if(!$thumbName)
		{
			return $mediaModel;
		}

		return $thumbName;
	}

	public function getPath()
    {
		$categoryId = $this->category_id;
		$path = $this->path;
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `category_id` = '$path1' ");
            if($path1 != $categoryId){
                $finalPath .= $category->name ."=>";
            }else{
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }
}

?>