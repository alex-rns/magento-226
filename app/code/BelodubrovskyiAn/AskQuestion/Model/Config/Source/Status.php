<?php
namespace BelodubrovskyiAn\AskQuestion\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use BelodubrovskyiAn\AskQuestion\Model\AskQuestion;

class Status implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray() :array
    {
        return [
            [
                'label' => __('Answered'),
                'value' => AskQuestion::STATUS_PROCESSED,
            ],
            [
                'label' => __('Pending'),
                'value' => AskQuestion::STATUS_PENDING,
            ],
        ];
    }
}
