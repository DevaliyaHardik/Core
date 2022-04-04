<?php Ccc::loadClass('Model_Core_Row');

class Model_Category_Media extends Model_Core_Row
{
	protected $mediaPath = 'Media/Category/';
	protected $category = null;
	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
		parent::__construct();
	}

	public function setCategory(Model_Category $category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategory($reload = false)
	{
		$categoryModal = Ccc::getModel('Category');
		if(!$this->category_id){
			return $categoryModal;
		}
		if($this->category && !$reload){
			return $this->category;
		}
		$category = $categoryModal->fetchRow("SELECT * FROM `category` WHERE `category_id` = {$this->category_id}");
		if(!$category){
			return $categoryModal;
		}
		$this->setCategory($category);
		return $this->category;
	}

	public function getImagePath()
    {
		if($this->name){
			return Ccc::getBaseUrl($this->mediaPath.$this->name);
		}
		return null;
    }
}

?>