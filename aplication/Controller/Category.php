<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
class Controller_Category extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Category');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$categoryIndex = Ccc::getBlock('Category_Index');
		$content->addChild($categoryIndex);
		

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryGrid,
					],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

    public function addBlockAction()
	{
		$category = Ccc::getModel('Category');
		$media = $category->getMedia();

		Ccc::register('category',$category);
		Ccc::register('media',$media);
		$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryEdit,
					],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

    public function editBlockAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$request = $this->getRequest();
			$categoryId = $request->getRequest('id');
			if(!$categoryId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$categoryId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$category = $categoryModel->load($categoryId);
			if(!$category){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$media = $category->getMedia();
	
			Ccc::register('category',$category);
			Ccc::register('media',$media);

			$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $categoryEdit,
						],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);	
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $categoryEdit,
						],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function saveAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
			$categoryId = $request->getRequest('id');
			if($request->isPost()){
                $postData = $request->getPost('category');
				$categoryData = $categoryModel->setData($postData);
				if(!empty($categoryId)){
					$categoryData->category_id = $categoryId;
                    $categoryData->updatedDate = date('y-m-d h:m:s');
				}
				else{
					$categoryData->createdDate = date('y-m-d h:m:s');
					if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);
					}
				}
				$category = $categoryModel->save();
				if(!$category){
					throw new Exception('Your data con not be updated', 1);			
				}
				$category->savePath($categoryData);
				$this->getMessage()->addMessage('Your Data Updated Successfully');
				$categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $category->category_id,'tab'=>'media']);
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#adminMessage',
							'content' => $messageBlock
						],
						[
							'element' => '#indexContent',
							'content' => $categoryGrid,
							'url' => $url
						]
					]
				];
				$this->randerJson($response);
			}
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}	
	}

	public function deleteAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception('Your Data can not be Deleted', 1);			
			}
		    $categoryId = $request->getRequest('id');
			
			$medias = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$categoryId'");
			if($medias){
				foreach($medias as $media){
					unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $media->name);
				}
			}
		    $result = $categoryModel->load($categoryId)->delete();
		    if(!$result){
				throw new Exception('Your Data can not Deleted', 1);			
		    }
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->gridBlockAction();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}	
	}

	public function saveMediaAction()
	{
		try {
			$mediaModel = Ccc::getModel('Category_Media');
			$categoryModel = $mediaModel->getCategory();
			$request = $this->getRequest();
			$file = $request->getFile();
			$categoryId = $request->getRequest('id');
			if($request->isPost()){
				if($file){
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
							$this->getMessage()->addMessage('Your media not saved', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/category/").$fileName);
					}
					$this->getMessage()->addMessage('Your Media saved successfully');
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
								$this->getMessage()->addMessage('media not removed', Model_Core_Message::MESSAGE_ERROR);
								throw new Exception("Error Processing Request", 1);
							}
							unlink(Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/category/"). $media->name);

							if(array_key_exists('base',$postData['media'])){
								if($postData['media']['base'] == $remove){
									unset($postData['media']['base']);
								}	
							}
							if(array_key_exists('thumb',$postData['media'])){
								if($postData['media']['thumb'] == $remove){
									unset($postData['media']['thumb']);
								}
							}
							if(array_key_exists('thumb',$postData['media'])){
								if($postData['media']['small'] == $remove){
									unset($postData['media']['small']);
								}
							}
						}
						$this->getMessage()->addMessage('Your Media removed');
					}
	
					if(array_key_exists('gallery',$postData['media'])){
						$mediaData->gallery = 2;
						$result = $mediaModel->save('category_id');
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
						$result = $mediaModel->save('category_id');
					}
					unset($mediaData->gallery);
					if(array_key_exists('base',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->base = $postData['media']['base'];
						$result = $categoryModel->save();
						if(!$result){
							$this->getMessage()->addMessage('Base set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($categoryData->base);
						$this->getMessage()->addMessage('Base set successfully');
					}
					if(array_key_exists('thumb',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->thumb = $postData['media']['thumb'];
						$result = $categoryModel->save();
						if(!$result){
							$this->getMessage()->addMessage('Thumb set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($categoryData->thumb);
						$this->getMessage()->addMessage('Thumb set successfully');
					}
					if(array_key_exists('small',$postData['media'])){
						$categoryData->category_id = $categoryId;
						$categoryData->small = $postData['media']['small'];
						$result = $categoryModel->save();
						if(!$result){
							$this->getMessage()->addMessage('Small set successfully', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}
						unset($categoryData->small);
						$this->getMessage()->addMessage('Small set successfully');
					}
				}
			} 	
			$this->editBlockAction();
		}catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->editBlockAction();
			}	
	}

}

?>