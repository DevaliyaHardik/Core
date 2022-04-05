<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Vendor extends Controller_Admin_Action{

    public function __construct()
	{
        $this->setTitle('Vendor');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

    public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$vendorGrid = Ccc::getBlock('Vendor_Index');
		$content->addChild($vendorGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
        $this->getMessage()->addMessage('Vendor');
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorGrid
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
        $vendorModel = Ccc::getModel('Vendor');
        $vendor = $vendorModel;
        $address = $vendorModel;

        Ccc::register('vendor',$vendor);
        Ccc::register('address',$address);
        $this->getMessage()->addMessage('Vendor Add');
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorEdit
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
            $vendorModel = Ccc::getModel('Vendor');
            $addressModel = Ccc::getModel('Vendor_Address');
            $request = $this->getRequest();
            $vendorId = $request->getRequest('id');
            if(!$vendorId){
				throw new Exception("Vendor data con not be fetch", 1);			
			}
			if(!(int)$salvendorIdesmanId){
				throw new Exception("Vendor data con not be fetch", 1);			
			}
            $vendor = $vendorModel->load($vendorId);
            $address = $vendor->getAddress();
			if(!$vendor){
				throw new Exception("Vendor data con not be fetch", 1);			
			}    
            Ccc::register('vendor',$vendor);
            Ccc::register('address',$address);
            $this->getMessage()->addMessage('Vendor Edit');
            $vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $vendorEdit
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
            $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $vendorGrid
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

    public function saveVendor()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = $this->getRequest();
        $vendorId = $request->getRequest('id');
        if($request->isPost()){
            if(!$request->getPost('vendor')){
                throw new Exception('Vendor data con not be updated', 1);
            }
            $postData = $request->getPost('vendor');
            $vendorData = $vendorModel->setData($postData);

            if(!empty($vendorId)){
                $vendorData->vendor_id = $vendorId;
                $vendorData->updatedDate = date('Y-m-d h:i:s');
            }
            else{
                $vendorData->createdDate = date('Y-m-d h:i:s');
            }
            $vendor = $vendorModel->save();
            if(!$vendor){
                throw new Exception('Vendor data con not be saved', 1);
            }
            $this->getMessage()->addMessage('Vendor Data Save Successfully');

            return $vendor;
        }
    }

    public function saveAddress($vendor = null)
    {
        $request = $this->getRequest();
        $vendorId = $request->getRequest('id');
		if(!$vendor){
			$vendor = Ccc::getModel('Vendor')->load($vendorId);
		}
        $address = $vendor->getAddress();
        if($request->isPost()){
            $postData = $request->getPost('address');
            if(!$address->address_id)
            {
                unset($address->address_id);
            }
            if($postData){
                $address->setData($postData);
            }
            $address->vendor_id=$vendor->vendor_id;
            $result = $address->save();
            if(!$result){
                throw new Exception('Vendor data con not be saved', 1);
            }
            $this->getMessage()->addMessage('Vendor Data Save Successfully');

            return $result;
        }
    }

    public function saveAction()
    {
		try {
            $vendor = null;
            $url = null;

            $request = $this->getRequest();
            if($request->getPost('vendor')){
                $vendor = $this->savevendor();
                if(!$vendor){
                    throw new Exception('Vendor data con not be inserted', 1);			
                }
                $address = $this->saveAddress($vendor);
            }
            if($request->getPost('address')){
                $address = $this->saveAddress();
                if(!$address){
                    throw new Exception('Vendor data con not be updated', 1);			
                }
            }

            $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            if($vendor){
                $url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $vendor->vendor_id,'tab'=>'address']);
            }
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => 'message',
                        'content' => $messageBlock,
                        'type' => 'success'
                    ],
                    [
                        'element' => '#indexContent',
                        'content' => $vendorGrid,
                        'url' => $url
                    ]
                ]
            ];
            $this->randerJson($response);
        }catch (Exception $e){
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $vendorGrid
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
        $request = $this->getRequest();
        $vendorModel = Ccc::getModel('Vendor');
        if(!$request->isPost()){
            try {
				if(!$request->getRequest('id')){
                    throw new Exception('Vendor Data can not be Deleted', 1);
				}
				$vendorId=$request->getRequest('id');
				$result = $vendorModel->load($vendorId)->delete();
				if(!$result){
                    throw new Exception('Vendor Data can not be Deleted', 1);
				}
				$this->getMessage()->addMessage('Vendor Data Delete Successfully');
                $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
                $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
                $response = [
                    'status' => 'success',
                    'elements' => [
                        [
                            'element' => '#indexContent',
                            'content' => $vendorGrid
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
                $vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
                $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
                $response = [
                    'status' => 'success',
                    'elements' => [
                        [
                            'element' => '#indexContent',
                            'content' => $vendorGrid
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
    }

}