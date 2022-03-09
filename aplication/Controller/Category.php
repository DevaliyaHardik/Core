<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
class Controller_Category extends Controller_Admin_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$categoryGrid = Ccc::getBlock('Category_Grid');
		$content->addChild($categoryGrid);

		$this->randerLayout();
	}

    public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$categoryEdit = Ccc::getBlock('Category_Edit')->addData('category',$category);
		$content->addChild($categoryEdit);

		$this->randerLayout();
	}

    public function editAction()
	{
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

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$categoryEdit = Ccc::getBlock('Category_Edit')->addData('category',$category);
		$content->addChild($categoryEdit);

		$this->randerLayout();
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
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$category->savePath($categoryData);
				$this->getMessage()->addMessage('Your Data Updated Successfully');
				$this->redirect('grid','category',[],true);
			}
		} catch (Exception $e) {
			$this->redirect('grid','category',[],true);
		}
	}

	public function deleteAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
		    $categoryId = $request->getRequest('id');
			
			$medias = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$categoryId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $media->name);
			}
		    $result = $categoryModel->load($categoryId)->delete();
		    if(!$result){
				$this->getMessage()->addMessage('Your Data can not Deleted', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
		    }
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->redirect('grid','category',[],true);
		} catch (Exception $e) {
			$this->redirect('grid','category',[],true);
		}
	}

}

?>