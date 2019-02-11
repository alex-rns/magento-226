<?php
namespace BelodubrovskyiAn\AskQuestion\Cron;

use BelodubrovskyiAn\AskQuestion\Model\AskQuestion;

class ChangeQuestionStatus
{
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
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion\CollectionFactory $collectionFactory
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
    }
    public function execute() :void
    {
        $collection = $this->collectionFactory->create();

        $collection->addFieldToFilter('status', AskQuestion::STATUS_PENDING)
                   ->addFieldToFilter('created_at', ['lt' => $this->getPointDateChange()]);
        echo "All questions with lifetime more than {$this->getDaysNumber()} days changed status to Answered \n";

        foreach ($collection as $item) {
            $item->setStatus(AskQuestion::STATUS_PROCESSED)->save();
        }
        $this->logger->warning('Cron job ChangeQuestionStatus completed!');
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
     * @return int
     */
    private function getDaysNumber()
    {
        return 3;
    }
}
