<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Grid');
		$content->addChild($productGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$productModel = Ccc::getModel('Product');
		$product = $productModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$productEdit = Ccc::getBlock('Product_Edit')->addData('product',$product);
		$content->addChild($productEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
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

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$productEdit = Ccc::getBlock('Product_Edit')->addData('product',$product);
		$content->addChild($productEdit);

		$this->randerLayout();
	}

	public function saveAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('product');
				$categoryData = $request->getPost('category');
				if(!$postData){
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$productData = $productModel->setData($postData);
				if(!empty($productId)){
					$productData->product_id = $productId;
					$productData->updatedDate = date('Y-m-d h:i:s');
					$result = $productModel->save();
			
					if(!$result){
						$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
						throw new Exception("Error Processing Request", 1);			
					}
					$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
					$categoryProduct = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$productId' ");
					foreach($categoryProduct as $category){
						$categoryProductModel->load($category->entity_id)->delete();
					}
					foreach($categoryData as $category){
						$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
						$categoryProductModel->product_id = $productId;
						$categoryProductModel->category_id = $category;
						$categoryProductModel->save();
					}

					$this->getMessage()->addMessage('Your Data Updated Successfully');
				}else{
					$productData->createdDate = date('Y-m-d h:i:s');
					$result = $productModel->save();
					if(!$result){
						$this->getMessage()->addMessage('Your data con not be saved', Model_Core_Message::MESSAGE_ERROR);
						throw new Exception("Error Processing Request", 1);			
					}
					foreach($categoryData as $category){
						$categoryProductModel = Ccc::getModel('Product_CategoryProduct');
						$categoryProductModel->product_id = $result;
						$categoryProductModel->category_id = $category;
						$categoryProductModel->save();
					}
					$this->getMessage()->addMessage('Your Data Save Successfully');
				}		
				$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
			} 			
		}catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
		}		
	}

	public function deleteAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$mediaModel = Ccc::getModel('Product_Media');
			$request = $this->getRequest();
			if(!$request->getRequest('id')){
				$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$productId = $request->getRequest('id');

			$medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `product_id` = '$productId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
			}

			$result = $productModel->load($productId)->delete();
			if(!$result){
				$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
		} catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Product_Grid')->getUrl('grid','product',[],true));	
		}
	}


}

?>