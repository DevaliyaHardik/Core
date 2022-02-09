<?php Ccc::loadFile("Model/Core/Adapter.php"); ?>
<?php

class Ccc{
    
    public static function loadFile($path)
    {
        require_once(getcwd().DIRECTORY_SEPARATOR.$path);
    }

    public static function loadClass($className)
    {
        $path = str_replace("_","/",$className).'.php';
        Ccc::loadFile($path);
    }

    public static function init()
    {
        $actionName = (isset($_GET['a'])) ? $_GET['a'].'Action' : 'errorAction';
        $controllerName = (isset($_GET['c']))? ucfirst($_GET['c']) : 'Customer';
        $controllerClassName = 'Controller_'.$controllerName;
        Ccc::loadClass($controllerClassName);
        $controller = new $controllerClassName();
        $controller->$actionName();
    }
}

Ccc::init();
?>