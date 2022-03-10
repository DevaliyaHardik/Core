<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Product_Media extends Controller_Admin_Action{

	public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$mediaGrid = Ccc::getBlock('Product_Media_Grid');
		$content->addChild($mediaGrid);

		$this->randerLayout();
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
							$this->getMessage()->addMessage('Your media not saved', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/").$fileName);
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
								$this->getMessage()->addMessage('media not removed', Model_Core_Message::MESSAGE_ERROR);
								throw new Exception("Error Processing Request", 1);
							}
							unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
							
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
						$this->getMessage()->addMessage('Your Media removed');
					}
	
					if(array_key_exists('gallery',$postData['media'])){
						$mediaData->gallery = 2;
						$result = $mediaModel->save('product_id');
						$mediaData->gallery = 1;
						foreach ($postData['media']['gallery'] as $gallery) {
							$mediaData->media_id = $gallery;
							$result = $mediaModel->save();
							if(!$result){
								$this->getMessage()->addMessage('Gallery Added', Model_Core_Message::MESSAGE_ERROR);
								throw new Exception("Error Processing Request", 1);
							}
						}
						unset($mediaData->media_id);
						$this->getMessage()->addMessage('Your Gallery Sellected');
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
							$this->getMessage()->addMessage('Base set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($productData->base);
						$this->getMessage()->addMessage('Base set successfully');
					}
					if(array_key_exists('thumb',$postData['media'])){
						$productData->product_id = $productId;
						$productData->thumb = $postData['media']['thumb'];
						$result = $productModel->save();
						if(!$result){
							$this->getMessage()->addMessage('Thumb set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($productData->thumb);
						$this->getMessage()->addMessage('Thumb set successfully');
					}
					if(array_key_exists('small',$postData['media'])){
						$productData->product_id = $productId;
						$productData->small = $postData['media']['small'];
						$result = $productModel->save();
						if(!$result){
							$this->getMessage()->addMessage('Small set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($productData->small);
						$this->getMessage()->addMessage('Small set successfully');
					}
				}
			} 	
			$this->redirect('grid','product_media',['id' => $productId],true);	
			}catch (Exception $e) {
				$this->redirect('grid','product_media',['id' => $productId],true);	
			}
		
	}

}

?>