<?php
namespace BelodubrovskyiAn\AskQuestion\Plugin\Catalog\Model\ResourceModel\Product;

/**
 * Class Collection
 * @package BelodubrovskyiAn\AskQuestion\Plugin\Catalog\Model\ResourceModel\Product
 */
class Collection
{
    /**
     * @param \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\Collection $subject
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeLoad(\BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\Collection $subject)
    {
        $subject->addStoreFilter();
    }
}
