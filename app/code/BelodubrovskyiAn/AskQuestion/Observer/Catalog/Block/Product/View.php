<?php
namespace BelodubrovskyiAn\AskQuestion\Observer\Catalog\Block\Product;

use Magento\Framework\Event\Observer;

class View implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * View constructor.
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $actionName = $observer->getEvent()->getData('full_action_name');
        $product = $this->registry->registry('current_product');
        $layout = $observer->getEvent()->getData('layout');
        if ($product && $actionName === 'catalog_product_view' && $product->getAllowToAskQuestions()) {
            $layout->getUpdate()->addHandle('catalog_product_view_ask_question_tab');
        }
        return $this;
    }
}
