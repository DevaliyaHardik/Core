<?php Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row
{
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
}

?>