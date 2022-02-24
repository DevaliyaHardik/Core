<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
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
		$product = $productModel->fetchRow("SELECT * FROM `product` WHERE `product_id` = '$productId'");
		if(!$product){
			throw new Exception("System is unable to fwetch recored", 1);
		}
		Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();
	}

	public function saveAction()
	{
		$request = $this->getRequest();
		if($request->isPost()){
			$row = $request->getPost('product');
			try {
				if(!$request->getPost('submit')){
					throw new Exception("Invalid Request", 1);	
				}
				if($request->getPost('submit') == "edit"){
					$product_id = $request->getRequest('id');
					$row['updatedDate'] = date('Y-m-d h:i:s');
					$edit = Ccc::getModel('Product');
					$result = $edit->update($row,$product_id);
			
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
				}else{
					$row['createdDate'] = date('Y-m-d h:i:s');
					$add = Ccc::getModel('Product');
					$result = $add->insert($row);
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
				}		
				$this->redirect($this->getView()->getUrl('product','grid'));	
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
		
	}

	public function deleteAction()
	{
		try {
			$request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception("Invalid Request", 1);
			}
			$product_id = $request->getRequest('id');
			$data = new Model_Core_Adapter();
			$result = $data->delete("DELETE FROM `product` WHERE `product_id` = $product_id");
			if(!$result){
				throw new Exception("System is unable to delete data.", 1);
			}
			$this->redirect("index.php?c=product&a=grid");
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