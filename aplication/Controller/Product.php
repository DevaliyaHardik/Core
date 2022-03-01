<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		$productModel = Ccc::getModel('Product');
		$product = $productModel;
		Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();
	}

	public function editAction()
	{
		$productModel = Ccc::getModel('Product');
		$request = $this->getRequest();
		$productId = $request->getRequest('id');
		if(!$productId){
			throw new Exception("Id is invalid", 1);
		}
		if(!(int)$productId){
			throw new Exception("invalid request", 1);
		}

		$product = $productModel->load($productId);
		if(!$product){
			throw new Exception("System is unable to fwetch recored", 1);
		}
		Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();
	}

	public function saveAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('product');
				if(!$postData){
					throw new Exception("Invalid request.", 1);
				}
				$productData = $productModel->setData($postData);
				if(!empty($productId)){
					$productData->product_id = $productId;
					$productData->updatedDate = date('Y-m-d h:i:s');
					$result = $productModel->save();
			
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
				}else{
					$productData->createdDate = date('Y-m-d h:i:s');
					$result = $productModel->save();
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
				}		
				$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
			} 			
		}catch (Exception $e) {
			echo $e->getMessage();
		}		
	}

	public function deleteAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$mediaModel = Ccc::getModel('Product_Media');
			$request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception("Invalid Request", 1);
			}
			$productId = $request->getRequest('id');

			$medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `product_id` = '$productId'");
			foreach($medias as $media){
				unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
			}

			$result = $productModel->load($productId)->delete();
			if(!$result){
				throw new Exception("System is unable to delete data.", 1);
			}
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function errorAction()
	{
		echo "error";
	}

	public function redirect($location)
	{
		header("location: $location");
	}

}

?>