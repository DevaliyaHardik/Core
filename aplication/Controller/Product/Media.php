<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('product_Media_Grid')->toHtml();
	}



	public function saveAction()
	{
		try {
			$mediaModel = Ccc::getModel('Product_Media');
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if($request->isPost()){
				if(!$request->getPost()){
					$mediaData = $mediaModel;
					$mediaData->product_id = $productId;
					$file = $request->getFile();
					$ext = explode('.',$file['name']['name']);
					$fileExt = end($ext);
					$fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
					$fileName = str_replace(" ","_",$fileName);
					$mediaData->name = $fileName;
					$extension = array('jpg','jpeg','png');
					if(in_array($fileExt, $extension)){
						$result = $mediaModel->save();
						if(!$result){
							throw new Exception("System is unable to save your data.", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],$this->getView()->getBaseUrl("Media/Product/").$fileName);
					}
				}
				else{
					$mediaData = $mediaModel;
					$productData = $productModel;
					$mediaData->product_id = $productId;
					$postData = $request->getPost();
					if(array_key_exists('remove',$postData['media'])){
						foreach($postData['media']['remove'] as $remove){
							$media = $mediaModel->load($remove);
							$result = $media->delete();
							if(!$result){
								throw new Exception("Invalid request", 1);
							}
							unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
							
							if($postData['media']['base'] == $remove){
								unset($postData['media']['base']);
							}
							if($postData['media']['thumb'] == $remove){
								unset($postData['media']['thumb']);
							}
							if($postData['media']['small'] == $remove){
								unset($postData['media']['small']);
							}

						}
					}
	
					if(array_key_exists('gallery',$postData['media'])){
						$mediaData->gallery = 2;
						$result = $mediaModel->save('product_id');
						$mediaData->gallery = 1;
						foreach ($postData['media']['gallery'] as $gallery) {
							$mediaData->media_id = $gallery;
							$result = $mediaModel->save();
							if(!$result){
								throw new Exception("Invalid request", 1);
							}
						}
						unset($mediaData->media_id);
					}
					else{
						$mediaData->gallery = 2;
						$result = $mediaModel->save('product_id');
					}
					unset($mediaData->gallery);

					if(array_key_exists('base',$postData['media'])){
						$productData->product_id = $productId;
						$productData->base = $postData['media']['base'];
						$result = $productModel->save();
						if(!$result){
							throw new Exception("System is unabel to set base", 1);
						}
						unset($productData->base);
					}
					if(array_key_exists('thumb',$postData['media'])){
						$productData->product_id = $productId;
						$productData->thumb = $postData['media']['thumb'];
						$result = $productModel->save();
						if(!$result){
							throw new Exception("System is unabel to set thumb", 1);
						}
						unset($productData->thumb);
					}
					if(array_key_exists('small',$postData['media'])){
						$productData->product_id = $productId;
						$productData->small = $postData['media']['small'];
						$result = $productModel->save();
						if(!$result){
							throw new Exception("System is unabel to set small", 1);
						}
						unset($productData->small);
					}
				}
			} 	
			$this->redirect($this->getView()->getUrl('grid','product_media',['id' => $productId],true));	
			}catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

}

?>