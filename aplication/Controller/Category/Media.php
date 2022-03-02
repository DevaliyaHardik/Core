<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Category_Media extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$mediaGrid = Ccc::getBlock('Category_Media_Grid');
		$content->addChild($mediaGrid);

		$this->randerLayout();
	}



	public function saveAction()
	{
		try {
			$mediaModel = Ccc::getModel('Category_Media');
			$categoryModel = Ccc::getModel('Category');
			$request = $this->getRequest();
			$categoryId = $request->getRequest('id');
			if($request->isPost()){
				if(!$request->getPost()){
					$mediaData = $mediaModel;
					$mediaData->category_id = $categoryId;
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
						move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/category/").$fileName);
					}
				}
				else{
					$mediaData = $mediaModel;
					$categoryData = $categoryModel;
					$mediaData->category_id = $categoryId;
					$postData = $request->getPost();
					if(array_key_exists('remove',$postData['media'])){
						foreach($postData['media']['remove'] as $remove){
							$media = $mediaModel->load($remove);
							$result = $media->delete();
							if(!$result){
								throw new Exception("Invalid request", 1);
							}
							unlink(Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/category/"). $media->name);

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
						$result = $mediaModel->save('category_id');
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
						$result = $mediaModel->save('category_id');
					}
					unset($mediaData->gallery);

					if(array_key_exists('base',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->base = $postData['media']['base'];
						$result = $categoryModel->save();
						if(!$result){
							throw new Exception("System is unabel to set base", 1);
						}
						unset($categoryData->base);
					}
					if(array_key_exists('thumb',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->thumb = $postData['media']['thumb'];
						$result = $categoryModel->save();
						if(!$result){
							throw new Exception("System is unabel to set thumb", 1);
						}
						unset($categoryData->thumb);
					}
					if(array_key_exists('small',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->small = $postData['media']['small'];
						$result = $categoryModel->save();
						if(!$result){
							throw new Exception("System is unabel to set small", 1);
						}
						unset($categoryData->small);
					}
				}
			} 	
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid','category_media',['id' => $categoryId],true));	
			}catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

}

?>