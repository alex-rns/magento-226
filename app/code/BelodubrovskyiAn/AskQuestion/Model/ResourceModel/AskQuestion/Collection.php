<?php
namespace BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion;

/**
 * Class Collection
 * @package BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \BelodubrovskyiAn\AskQuestion\Model\AskQuestion::class,
            \BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion::class
        );
    }
}
