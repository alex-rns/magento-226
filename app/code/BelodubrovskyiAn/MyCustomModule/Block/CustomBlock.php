<?php
namespace BelodubrovskyiAn\MyCustomModule\Block;
class CustomBlock extends \Magento\Framework\View\Element\Template
{
    const LESSON3_TEMPLATE = "BelodubrovskyiAn_MyCustomModule::lesson/myhomework_test_prepare_layout.phtml";
    /**
     * add custom template
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate(self::LESSON3_TEMPLATE);
        return $this;
    }
    public function getUrlToJsonResponse() {
        return $this->getUrl('home_work/jsonresponse/indexjson');
    }
}