<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php
class Controller_Category extends Controller_Core_Action{

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
			$this->getMessage()->addMessage('Your data con not be fetch');
        }
        if(!(int)$categoryId){
			$this->getMessage()->addMessage('Your data con not be fetch');
        }
        $category = $categoryModel->load($categoryId);
        if(!$category){
			$this->getMessage()->addMessage('Your data con not be fetch');
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
					if(!$postData['parent_id']){
						$categoryData->parent_id = NULL;
					}
					$result = $categoryModel->save();
					if(!$result){
						$this->getMessage()->addMessage('Your data con not be updated');
					}
					
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$categoryId%' ");
                    foreach ($allPath as $path) {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) {
                            if($subPath == $categoryId){
                                if(count($finalPath) != 1){
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
						if($path->parent_id){
							$parentPath = $categoryModel->load($path->parent_id);
							$path->path = $parentPath->path ."/".implode('/',$finalPath);
						}
						else{
							$path->path = $path->category_id;
						}
                        $result = $path->save();
                    }
					$this->getMessage()->addMessage('Your Data Updated Successfully');
				}
				else{
					$categoryData->createdDate = date('y-m-d h:m:s');
					if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);
                        $insertId = $categoryModel->save();
                        if(!$insertId){
							$this->getMessage()->addMessage('Your data con not be saved');
                        }
						$categoryData->resetData();
                        $categoryData->path = $insertId;
						$categoryData->category_id = $insertId;
						$result = $categoryModel->save();
					}
					else{
                        $insertId = $categoryModel->save();
                        if(!$insertId){
							$this->getMessage()->addMessage('Your data con not be saved');
                        }
						$categoryData->category_id = $insertId;
                        $parentPath = $categoryModel->load($categoryData->parent_id);
                        $categoryData->path = $parentPath->path."/". $insertId;
						$result = $categoryData->save();
					}
					if(!$result){
						$this->getMessage()->addMessage('Your data con not be saved');
					}
					$this->getMessage()->addMessage('Your Data Save Successfully');
				}
				$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid','category',[],true));
			}
		} catch (Exception $e) {
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid','category',[],true));
		}
	}

	public function deleteAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				$this->getMessage()->addMessage('Your Data can not be Deleted');
			}
		    $categoryId = $request->getRequest('id');
			
			$medias = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$categoryId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $media->name);
			}
		    $result = $categoryModel->load($categoryId)->delete();
		    if(!$result){
				$this->getMessage()->addMessage('Your Data can not Deleted');
		    }
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid','category',[],true));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}

?>