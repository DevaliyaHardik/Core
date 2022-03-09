<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Salesman_SalesmanCustomer extends Controller_Admin_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock("Salesman_SalesmanCustomer_Grid");
		$content->addChild($salesmanGrid);
		
		$this->randerLayout();
	}

    public function saveAction()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = $this->getRequest();
        $salesmanId = $request->getRequest('id');
        if($request->isPost()){
            $customerData = $request->getPost('customer');
            $customerModel->salesman_id = $salesmanId;
            foreach($customerData as $customer){
                $customerModel->customer_id = $customer;
                $result = $customerModel->save(); 

                if(!$result){
                    $this->getMessage()->addMessage("Salesman NOT added");
                    throw new Exception("Error Processing Request", 1);
                }
            }
			$this->redirect('grid','Salesman_SalesmanCustomer');
        }
    }

}

?>