<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Product extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Product');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Grid');
		$content->addChild($productGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$productModel = Ccc::getModel('Product');
		$product = $productModel;

		$content = $this->getLayout()->getContent();
		$productEdit = Ccc::getBlock('Product_Edit');
		$productEdit->product = $product;
		$content->addChild($productEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if(!$productId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$productId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$product = $productModel->load($productId);
			if(!$product){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$content = $this->getLayout()->getContent();
			$productEdit = Ccc::getBlock('Product_Edit');
			$productEdit->product = $product;
			$content->addChild($productEdit);
	
			$this->randerLayout();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}	
	}

	public function saveAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			$type = $request->getPost('discountMethod');
			if($request->isPost()){
				$postData = $request->getPost('product');
				$categoryIds = $request->getPost('category');
				if(!$postData){
					throw new Exception('Your data con not be updated', 1);			
				}
				$productData = $productModel->setData($postData);
				if($type == 1){
					$productData->discount = $productData->price * $productData->discount / 100;
				}
				if(!($productData->cost <= ($productData->price - $productData->discount) && $productData->price - $productData->discount <= $productData->price) || $productData->discount<0){
					throw new Exception("Invalid discount", 1);
				}
				if(!empty($productId)){
					$productData->product_id = $productId;
					$productData->updatedDate = date('Y-m-d h:i:s');
				}else{
					$productData->createdDate = date('Y-m-d h:i:s');
				}

				$product = $productModel->save();
				if(!$product){
					throw new Exception('product con not be saved', 1);			
				}

				$result = $product->saveCategories($categoryIds);
				$this->getMessage()->addMessage('product Save Successfully');
				$this->redirect('grid',null,['id' => null]);
			} 			
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','product',['id' => null]);
		}	
	}

	public function deleteAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$mediaModel = Ccc::getModel('Product_Media');
			$request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception('Your Data can not be Deleted', 1);			
			}
			$productId = $request->getRequest('id');

			$medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `product_id` = '$productId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
			}

			$result = $productModel->load($productId)->delete();
			if(!$result){
				throw new Exception('Your Data can not be Deleted', 1);			
			}
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->redirect('grid',null,['id' => null]);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer',['id' => null]);
		}	
	}
}

?>