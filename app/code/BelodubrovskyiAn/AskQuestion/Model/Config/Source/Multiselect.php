<?php
namespace BelodubrovskyiAn\AskQuestion\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Multiselect
 * @package BelodubrovskyiAn\AskQuestion\Model\Config\Frontend\Form\Field
 */
class Multiselect implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray() :array
    {
        return [
            ['value' => 0, 'label' => __('First')],
            ['value' => 1, 'label' => __('Second')],
            ['value' => 2, 'label' => __('Third')],
            ['value' => 3, 'label' => __('Fourth')]
        ];
    }
}
