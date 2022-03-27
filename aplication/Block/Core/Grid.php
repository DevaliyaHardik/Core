<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Admin_Grid_Collection');
Ccc::loadClass('Block_Customer_Grid_Collection');


class Block_Core_Grid extends Block_Core_Template  
{
    protected $collection = null; 
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('view/core/grid.php');
    }

    public function getGridUrl()
    {
        return $this->getUrl('save');
    }

    public function getCollection()
    {
        if($this->collection)
        {
            return $this->collection;
        }
        $className =  get_class($this).'_Collection';
        $object = new $className();
        $object->setGrid($this);
        $this->setCollection($object);
        return $object;
    }

    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function getCollectionContent()
    {
        $collections = $this->getCollection()->getSelectedCollection();
        $object = Ccc::getBlock($collections['block']);
        return $object;
    }
}
