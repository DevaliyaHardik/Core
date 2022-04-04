<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Salesman_SalesmanCustomer extends Controller_Admin_Action{

    public function __construct()
	{
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function gridBlockAction()
	{
		$salesmanGrid = Ccc::getBlock("Salesman_SalesmanCustomer_Grid")->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanGrid,
					],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
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
            $salesmanGrid = Ccc::getBlock("Salesman_Grid")->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $salesmanGrid,
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

}

?>