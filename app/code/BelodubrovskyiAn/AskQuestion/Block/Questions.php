<?php
namespace BelodubrovskyiAn\AskQuestion\Block;

use BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\Collection;

class Questions extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * Questions constructor.
     * @param \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory $collectionFactory
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory $collectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
    }

    /**
     * @param null $limit
     * @return Collection
     */
    public function getQuestions($limit = null): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->getSelect()->order('created_at DESC');
        if ($limit = $limit ? $limit : $this->getData('limit')) {
            $collection->setPageSize($limit);
        }
        return $collection;
    }
}
