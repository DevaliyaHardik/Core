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

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Index');
		$content->addChild($productGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$this->getMessage()->addMessage('product');
		$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productGrid,
				],
				[
					'element' => 'message',
					'content' => $messageBlock,
					'type' => 'success'
				]
			]
		];
		$this->randerJson($response);
	}

	public function addBlockAction()
	{
		$productModel = Ccc::getModel('Product');
		$product = $productModel;
		$media = Ccc::getModel('Product_Media');

		Ccc::register('product',$product);
		Ccc::register('media',$media);
		$this->getMessage()->addMessage('product Add');
		$productEdit = Ccc::getBlock('Product_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productEdit,
				],
				[
					'element' => 'message',
					'content' => $messageBlock,
					'type' => 'success'
				]
			]
		];
		$this->randerJson($response);
	}

	public function editBlockAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			if(!$productId){
				throw new Exception("Product data con not be fetch", 1);			
			}
			if(!(int)$productId){
				throw new Exception("Product data con not be fetch", 1);			
			}
	
			$product = $productModel->load($productId);
			if(!$product){
				throw new Exception("Product data con not be fetch", 1);			
			}
	
			$media = $product->getMedia();	
			Ccc::register('product',$product);
			Ccc::register('media',$media);
			$this->getMessage()->addMessage('product Edit');
			$productEdit = Ccc::getBlock('Product_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productEdit,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'success'
					]
				]
			];
			$this->randerJson($response);
			}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productGrid,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'error'
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function saveAction()
	{
		try {
			$product = null;
			$category = null;
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
			$type = $request->getPost('discountMethod');
			if($request->isPost()){
				$postData = $request->getPost('product');
				if($postData){
					if(!$postData){
						throw new Exception('Product data con not be updated', 1);			
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
				}
				if(array_key_exists('category',$request->getPost())){
					$categoryIds = $request->getPost('category');
					$product = $productModel;
					$product->product_id = $productId;
					$category = $product->saveCategories($categoryIds);
				}
				elseif(!array_key_exists('product',$request->getPost())){
					$categoryIds = $request->getPost('category');
					$product = $productModel;
					$product->product_id = $productId;
					$category = $product->saveCategories($categoryIds);
				}
				$this->getMessage()->addMessage('product Save Successfully');
				if($product){
					$url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $product->product_id,'tab'=>'category']);
				}
				if($category){
					$url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $product->product_id,'tab'=>'media']);
				}
				$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#indexContent',
							'content' => $productGrid,
							'url' => $url
						],
						[
							'element' => 'message',
							'content' => $messageBlock,
							'type' => 'success'
						]
					]
				];
				$this->randerJson($response);
			} 			
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productGrid,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'error'
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function deleteAction()
	{
		try {
			$productModel = Ccc::getModel('Product');
			$mediaModel = Ccc::getModel('Product_Media');
			$request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception('Product Data can not be Deleted', 1);			
			}
			$productId = $request->getRequest('id');

			$medias = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `product_id` = '$productId'");
			if($medias){
				foreach($medias as $media){
					unlink(Ccc::getBlock('Product_Grid')->getBaseUrl("Media/Product/"). $media->name);
				}	
			}
			$result = $productModel->load($productId)->delete();
			if(!$result){
				throw new Exception('Product Data can not be Deleted', 1);			
			}
			$this->getMessage()->addMessage('Product Data Delete Successfully');
			$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productGrid,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'success'
					]
				]
			];
			$this->randerJson($response);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $productGrid,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'error'
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function saveMediaAction()
	{
		try {
			$mediaModel = Ccc::getModel('Product_Media');
			$productModel = $mediaModel->getProduct();
			$request = $this->getRequest();
			$file = $request->getFile();
			$productId = $request->getRequest('id');
			if($request->isPost()){
				if($file){
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
							$this->getMessage()->addMessage('Product media not saved', Model_Core_Message::MESSAGE_ERROR);
							throw new Exception("Error Processing Request", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/product/").$fileName);
					}
					$this->getMessage()->addMessage('Product Media saved successfully');
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
							unlink(Ccc::getBlock('Admin_Grid')->getBaseUrl("Media/product/"). $media->name);

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
							if(array_key_exists('small',$postData['media'])){
								if($postData['media']['small'] == $remove){
									unset($postData['media']['small']);
								}
							}
						}
						$this->getMessage()->addMessage('Product Media removed');
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
						$this->getMessage()->addMessage('Product Gallery Sellected');
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
			$this->editBlockAction();
		}catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->editBlockAction();
		}	
	}

}

?>