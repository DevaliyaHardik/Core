<?php Ccc::loadClass('Model_Core_Response'); ?>
<?php

class Controller_Core_Front{
    protected $response = null;
    protected $request = null;

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        if(!$this->request){
            $request = Ccc::getModel('Core_Request');
            $this->setRequest($request);
        }
        return $this->request;
    }

    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse()
    {
        if(!$this->response)
        {
            $response = new Model_Core_Response();
            $this->setResponse($response);
        }
        return $this->response;
    }

    public function init()
    {
        $request = $this->getRequest();
        $actionName = $request->getActionName();
        $controllerName = $request->getControllerName();
        $controllerClassName = 'Controller_'.$controllerName;
        $controllerClassName = $this->prepareClassName($controllerClassName);
        Ccc::loadClass($controllerClassName);
        $controller = new $controllerClassName();
        $controller->$actionName();
    }

    public function prepareClassName($className)
    {
        $className = ucwords($className,"_");
        return $className;
    }
}

?>
