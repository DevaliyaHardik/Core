<?php Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row
{
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
		if(!$categoryIds){
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
}

?>