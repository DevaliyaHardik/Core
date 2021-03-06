<?php Ccc::loadClass("Model_Core_Adapter"); ?>
<?php
date_default_timezone_set("Asia/Kolkata");

class Ccc{
    public static $front = null;
   
    public static function register($key, $value)
    {
        $GLOBALS[$key] = $value;
    }

    public static function getRegistry($key)
    {
        if(array_key_exists($key, $GLOBALS))
        {
            return $GLOBALS[$key];
        }
        return null;
    }
    public static function unregister($key)
    {
        if(array_key_exists($key, $GLOBALS))
        {
            unset($GLOBALS[$key]);
        }
    }

    public static function getConfig($key)
    {
        if(!($config = self::getRegistry('config')))
        {
            $config = Ccc::loadFile('etc/config.php');
            self::register('config', $config);
        }
        if(array_key_exists($key, self::getRegistry('config')))
        {
            return $config[$key];
        }
        return null;
    }

    public static function loadFile($path)
    {
        return require_once(getcwd().DIRECTORY_SEPARATOR.$path);
    }

    public static function loadClass($className)
    {
        $path = str_replace("_","/",$className).'.php';
        Ccc::loadFile($path);
    }

    public static function init()
    {
        self::getFront()->init();
    }

    public static function setFront($front)
    {
       self::$front = $front;
    }

    public static function getFront()
    {
        if(!self::$front){
            Ccc::loadClass('Controller_Core_Front');
            $front = new Controller_Core_Front();
            self::setFront($front);
        }
        return self::$front;
    }

    public static function getModel($className)
    {
        $className = 'Model_'.$className;
        self::loadClass($className);
        return new $className;
    }

    public static function getBlock($className)
    {
        $className = 'Block_'.$className;
        self::loadClass($className);
        return new $className;
    }

    public static function getPath($subPath = null)
    {
        if($subPath){
            if(!defined('DS')){
                define('DS', DIRECTORY_SEPARATOR);
            }
            return getcwd().DS.$subPath;
        }
        return getcwd();
    }
    public static function getBaseUrl($subUrl = null)
    {
        if($subUrl){
            return self::getConfig('baseUrl').$subUrl;
        }
        return self::getConfig('baseUrl');
    }
}

Ccc::init();
?>