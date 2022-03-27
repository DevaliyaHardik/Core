<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Grid_Collection extends Block_Core_Template   
{
    protected $collections = [];
    protected $grid = null;
    protected $currentCollection = null;

    public function __construct()
    {
        $this->setTemplate('view/core/grid/collection.php');
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        return $this;
    }

    public function getSelectedCollection()
    {
        $collectionKey = Ccc::getModel('Core_Request')->getRequest('tab');
        $collection = $this->getCollection($collectionKey);
        if(!$collection)
        {
            return $this->getCollection($this->currentCollection);
        }
        $this->setCurrentCollection($collection);
        return $collection;
    }

    public function setGrid($grid)
    {
        $this->grid = $grid;
        return $this;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    public function setCurrentCollection($currentCollection = null)
    {
        $collectionKey = Ccc::getModel('Core_Request')->getRequest('collection');
        $collection = $this->getCollection($collectionKey);
        if(!$collection)
        {
            $this->currentCollection = $currentCollection;
        }
        else
        {
            $this->currentCollection = $collectionKey;
        }
        return $this;
    }

    public function getCurrentCollection()
    {
        return $this->currentCollection;
    }

    /*public function setTabs($tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }*/

    public function getCollections()
    {
        return $this->collections;
    }

    public function addCollection($collection, $key)
    {
        $this->collections[$key] = $collection;
        return $this;
    }

    public function getCollection($key)
    {
        if(array_key_exists($key,$this->collections))
        {
            return $this->collections[$key];
        }
        return null;

    }
    public function removeCollection($key)
    {
        if(array_key_exists($key,$this->collections))
        {
            unset($this->collections[$key]);
        }
        return $this;
    }
}
