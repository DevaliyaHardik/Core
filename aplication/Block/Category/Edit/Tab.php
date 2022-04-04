<?php Ccc::loadClass('Block_Core_Edit_Tab');

class Block_Category_Edit_Tab extends Block_Core_Edit_Tab   
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentTab('personal');
    }

    public function prepareTabs()
    {
        $this->addTab([
            'title' => 'Personal Info',
            'block' => 'Category_Edit_Tabs_Personal',
            'url' => $this->getUrl(null,null,['tab' => 'personal'])
        ],'personal');
        $this->addTab([
            'title' => 'Media Info',
            'block' => 'Category_Edit_Tabs_Media',
            'url' => $this->getUrl(null,null,['tab' => 'media'])
        ],'media');
    }
}
