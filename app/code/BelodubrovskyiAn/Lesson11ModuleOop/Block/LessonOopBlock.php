<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Block;

use BelodubrovskyiAn\Lesson11ModuleOop\Model\FileList;

class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    public $fileListGet;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        FileList $fileList
    ) {
        parent::__construct($context);
        $this->fileListGet = $fileList;
    }

    public function getFileListObject(): FileList
    {
        return $this->fileListGet;
    }
}
