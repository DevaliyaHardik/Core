<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Media_Grid')->toHtml();
	}



	public function saveAction()
	{
		$request = $this->getRequest();
		$product_id = $request->getRequest('id');
		if($request->isPost()){
			$row = $request->getPost();
			try {
				$row['product_id'] = $product_id;
				$file = $request->getFile();
				$ext = explode('.',$file['name']['name']);
				$fileExt = end($ext);
				$row['name'] = prev($ext)."".date('Ymdhis').".".$fileExt;
				$row['name'] = str_replace(" ","_",$row['name']);
				$extension = array('jpg','jpeg','png');
				if(in_array($fileExt, $extension)){
					$add = Ccc::getModel('Product_Media');
					$result = $add->insert($row);
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}	
					move_uploaded_file($file['name']['tmp_name'],$this->getView()->getBaseUrl("Media/Product/").$row['name']);
				}

				$this->redirect($this->getView()->getUrl('product_media','grid'));	
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
		
	}

	public function editAction()
	{
		try{
			$request = $this->getRequest();
			$productId = $request->getRequest('id');

			$edit = Ccc::getModel('Product_Media');
			if(!$request->isPost()){
				throw new Exception("Invalid request.", 1);
			}
			$rows = $request->getPost();
			echo "<pre>";
			if(array_key_exists('media',$rows) && array_key_exists('base',$rows['media'])){
				$result = $edit->update(['base' => 2],$productId,'product_id');
				if($result){
					$base = $edit->update(['base' => 1],$rows['media']['base']);
				}
			}
			if(array_key_exists('media',$rows) && array_key_exists('thumb',$rows['media'])){
				$result = $edit->update(['thumb' => 2],$productId,'product_id');
				if($result){
					$thumb = $edit->update(['thumb' => 1],$rows['media']['thumb']);
					print_r($thumb);
				}
			}
			if(array_key_exists('media',$rows) && array_key_exists('small',$rows['media'])){
				$result = $edit->update(['small' => 2],$productId,'product_id');
				if($result){
					$small = $edit->update(['small' => 1],$rows['media']['small']);
					print_r($small);
				}
			}
			unset($rows['media']);
			foreach($rows as $row){
				if(array_key_exists('remove',$row)){
					$result = $edit->delete($row['image_id']);
					if(!$result){
						throw new Exception("Invalid request", 1);
					}
					unlink($this->getView()->getBaseUrl("Media/Product/"). $row['name']);
				}

				if(array_key_exists('gallery',$row)){
					$result = $edit->update(['gallery' => 1],$row['image_id']);
				}
				else{
					$result = $edit->update(['gallery' => 2],$row['image_id']);
				}
			}
			$this->redirect($this->getView()->getUrl('product_media','grid',['id' => $productId],true));	
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
	/*public function deleteAction()
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
	}*/

}

?>