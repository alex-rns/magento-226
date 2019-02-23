<?php
namespace BelodubrovskyiAn\AskQuestion\Cron;

use BelodubrovskyiAn\AskQuestion\Model\AskQuestion;

class ChangeQuestionStatus
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * ChangeQuestionStatus constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->scopeConfig = $scopeConfig;
    }
    public function execute() :void
    {
        if ($this->getEnableFlag() == 1) {
            $collection = $this->collectionFactory->create();

            $collection->addFieldToFilter('status', AskQuestion::STATUS_PENDING)
                ->addFieldToFilter('created_at', ['lt' => $this->getPointDateChange()]);
            echo "All questions with lifetime more than {$this->getDaysNumber()} days changed status to Answered \n";

            foreach ($collection as $item) {
                $item->setStatus(AskQuestion::STATUS_PROCESSED)->save();
            }
            $this->logger->warning('Cron job ChangeQuestionStatus completed!');
        } else {
            $this->logger->warning('Cron job ChangeQuestionStatus is disabled.');
            echo 'Cron job ChangeQuestionStatus is disabled.';
        }
    }

    /**
     * @return false|string
     */
    private function getPointDateChange()
    {
        $currentDate = date('Y-m-d h:i:s');
        $timeInterval = strtotime('-' . $this->getDaysNumber() . ' day', strtotime($currentDate));
        return date('Y-m-d h:i:s', $timeInterval);
    }

    /**
     * @return mixed
     */
    private function getDaysNumber()
    {
        return $this->scopeConfig->getValue(
            'ask_question_options/cron/frequency',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES
        );
    }

    /**
     * @return mixed
     */
    private function getEnableFlag()
    {
        return $this->scopeConfig->getValue(
            'ask_question_options/cron/auto_confirming',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES
        );
    }
}
