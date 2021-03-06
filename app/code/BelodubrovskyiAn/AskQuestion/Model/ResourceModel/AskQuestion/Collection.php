<?php
namespace BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion;

/**
 * Class Collection
 * @package BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var string
     */
    protected $_eventPrefix = 'belodubrovskyi_askquestion_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'askquestion_collection';

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

    protected function _construct()
    {
        $this->_init(
            \BelodubrovskyiAn\AskQuestion\Model\AskQuestion::class,
            \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion::class
        );
    }

    /**
     * @param int $storeId
     * @return Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function addStoreFilter(int $storeId = 0)
    {
        if (!$storeId) {
            $storeId = (int) $this->storeManager->getStore()->getId();
        }
        $this->addFieldToFilter('store_id', $storeId);
        return $this;
    }
}
