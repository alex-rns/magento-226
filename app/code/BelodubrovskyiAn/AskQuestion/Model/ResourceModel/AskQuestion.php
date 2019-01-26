<?php
namespace BelodubrovskyiAn\AskQuestion\Model\ResourceModel;

/**
 * Class AskQuestion
 * @package BelodubrovskyiAn\AskQuestion\Model\ResourceModel
 */
class AskQuestion extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('belodubrovskyian_ask_question', 'question_id');
    }
}
